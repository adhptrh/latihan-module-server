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

        $userVoted = Vote::where("user_id",$user->id)->get();

        $polls = Poll::with(["choices"])->deadline()->get()->toArray();

        for ($i=0;$i<count($polls);$i++) {
            $result = $this->getPollResult($polls[$i]["id"]);
            $polls[$i]["result"] = $result;
            $polls[$i]["creator"] = User::find($polls[$i]["created_by"])->username;
        }

        if ($user->role == "admin" || $userVoted) {
            return response()->json($polls);
        }
    }

    public function getAPoll($pollId) {


        $result = $this->getPollResult($pollId);
        $user = auth()->user();

        $userVoted = Vote::where("user_id",$user->id)->get();
        $response = Poll::with("choices")->where("id",$pollId)->deadline()->count();
        if (!$response) {
            return response()->json([]);
        }


        $response = $response[0]->toArray();

        $response["result"] = $result;
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

        $countres = DB::select("SELECT choices.id as choice_id,votes.user_id,choice,votes.division_id,count(votes.id) as count from choices inner join votes on choices.id=votes.choice_id where choices.poll_id=? group by votes.user_id,choices.id,choice,votes.division_id;",[$pollId]);

        $divisionsVoted = [];
        $grouped = [];
        $result = [];

        foreach ($countres as $div) {
            if (!in_array($div->division_id,$divisionsVoted)) {
                array_push($divisionsVoted,$div->division_id);
                $grouped[$div->division_id]["winner"] = [];
            }
        }

        foreach ($divisionsVoted as $div) {
            foreach($countres as $divv) {
                if ($div == $divv->division_id) {
                    array_push($grouped[$div]["winner"], $divv);
                }
            }
        }

        foreach ($grouped as $k=>$v) {
            $grouped[$k]["rawpoint"] = 1/count($grouped[$k]["winner"]);
        }

        foreach ($grouped as $k=>$v) {
            foreach ($v["winner"] as $kk=>$vv) {
                try {
                    $result[$vv->choice_id]["point"] += $v["rawpoint"];
                } catch (Exception $e) {
                    $result[$vv->choice_id] = [
                        "point"=>$v["rawpoint"],
                        "id"=>$vv->choice_id,
                        "choice"=>$vv->choice
                    ];
                }
            }
        }

        $finalResult = [];

        foreach ($result as $k=>$v) {
            $dividedBy = 0;
            foreach ($result as $kk=>$vv) {
                $dividedBy += $vv["point"];
            }
            array_push($finalResult, [
                "id"=>$result[$k]["id"],
                "choice"=>$result[$k]["choice"],
                "point"=>$result[$k]["point"]/($dividedBy)*100
            ]);
        }

        return $finalResult;
    }

}
