<?php

namespace App\Http\Controllers;

use App\Models\Choice;
use App\Models\Poll;
use App\Models\User;
use App\Models\Vote;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Expr;

class PollController extends Controller
{

    public function createPoll() 
    {
        $val = Validator::make(request()->all(),[
            "title"=>"required",
            "description"=>"required",
            "deadline"=>"required",
            "choices.*"=>"distinct",
        ]);

        if ($val->fails()) {
            return response()->json(["message"=>"The given data was invalid."],422);
        }

        DB::beginTransaction();

        try {
            $poll = new Poll();
            $poll->title = request("title");
            $poll->description = request("description");
            $poll->created_by = auth()->user()->id;
            $poll->deadline = request("deadline");
            $poll->save();

            $choices = request("choices");
            foreach ($choices as $cho) {
                $choice = new Choice(["choice"=>$cho]);
                $poll->choices()->save($choice);
            }

            DB::commit();
    
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(["message"=>$e],422);
        }

        return response()->json($poll);
    }

    public function getAllPoll() {
        $user = auth()->user();

        $polls = Poll::with(["choices"])->get()->toArray();

        for ($i=0;$i<count($polls);$i++) {
			$today = date("Y-m-d H:i:s");
			$date = $polls[$i]["deadline"];
            $userVoted = Vote::where("user_id",$user->id)->where("poll_id",$polls[$i]["id"])->get();
			if ($date < $today || $user->role == "admin" || count($userVoted) > 0) {
				$result = $this->getPollResult($polls[$i]["id"]);
				$polls[$i]["result"] = $result;
			}
            $polls[$i]["creator"] = User::find($polls[$i]["created_by"])->username;
        }

        return response()->json($polls);
    }

    public function getAPoll($pollId) {


        $result = $this->getPollResult($pollId);
        $user = auth()->user();

        $userVoted = Vote::where("user_id",$user->id)->where("poll_id",$pollId)->get();
        $response = Poll::with("choices")->where("id",$pollId)->get();
        if (count($response) < 1) {
            return response()->json([]);
        }

        $response = $response[0]->toArray();

        $today = date("Y-m-d H:i:s");
        $date = $response["deadline"];
        if ($date < $today || $user->role == "admin" || count($userVoted) > 0) {
            $response["result"] = $result;
        }
        $response["creator"] = User::find($response["created_by"])->username;


        if ($user->role == "admin" || $userVoted) {
            return response()->json($response);
        }
    }

    public function deletePoll($pollId) {
        $poll = Poll::find($pollId);
        if ($poll) {
            $poll->delete();
        } else {
            return response()->json(["message"=>"poll not found"],422);
        }
        return response()->json(["message"=>"poll deleted"]);
    }

    public function getPollResult($pollId) {
        $divisions = DB::select("select votes.division_id from choices inner join votes on votes.choice_id = choices.id where choices.poll_id = ? group by votes.division_id", [$pollId]);

        $result = [];
        $dividedBy = 0;
        $finalResult = [];

        foreach (Choice::where("poll_id",$pollId)->get() as $k=>$v) {
            array_push($finalResult,[
                "choice_id"=>$v->id,
                 "choice"=>$v->choice,
                 "point"=>0]);
        }

        foreach ($divisions as $division) {
            $res = DB::select("SELECT * FROM ( SELECT votes.choice_id,count(votes.id) as vote_count FROM votes WHERE poll_id = ? and division_id = ? GROUP BY votes.choice_id ) as a JOIN ( SELECT MAX(a.vote_count) as max_vote FROM ( SELECT votes.choice_id, votes.division_id,count(votes.id) as vote_count FROM votes WHERE poll_id = ? and division_id = ? GROUP BY votes.choice_id, votes.division_id ) as a ) as b WHERE a.vote_count = b.max_vote",[$pollId,$division->division_id,$pollId,$division->division_id]);
            foreach ($res as $ress) {
                try {
                    $result[$ress->choice_id]["rpoint"] += 1/count($res);
                } catch (Exception $e) {
                    $result[$ress->choice_id]["rpoint"] = 1/count($res);
                }
            }
        }

        foreach ($result as $v) {
            $dividedBy += $v["rpoint"];
        }

        foreach ($result as $k=>$v) {
            foreach ($finalResult as $kk=>$vv) {
                if ($vv['choice_id'] == $k) {
                    $finalResult[$kk]["point"]=floatval(number_format($result[$k]["rpoint"]/$dividedBy*100,2));
                }
            }
        }
        return $finalResult;
    }

}
