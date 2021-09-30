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

        $polls = Poll::with(["users:username","choices"])->deadline()->get()->toArray();

        for ($i=0;$i<count($polls);$i++) {
            $result = $this->getPollResult($polls[$i]["id"]);
            $polls[$i]["result"] = $result;
        }

        if ($user->role == "admin" || $userVoted) {
            return response()->json($polls);
        }
    }

    public function getAPoll($pollId) {
        $result = $this->getPollResult($pollId);

        $response = Poll::with("choices")->where("id",$pollId)->get()[0]->toArray();
        array_push($response,$result);

        return response()->json($response);
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


        $max = [];

        foreach ($countres as $divote) {
            try {
                if ($divote->count > $max["div".$divote->division_id]["count"]) {
                    $max["div".$divote->division_id] = [
                        "count"=>$divote->count,
                        "point"=>1,
                        "user_id"=>$divote->user_id,
                        "dupe"=>[],
                        "choice"=>$divote->choice_id
                    ];
                }
            } catch (Exception $e) {
                $max["div".$divote->division_id] = [
                    "count"=>$divote->count,
                    "user_id"=>$divote->user_id,
                    "point"=>1,
                    "dupe"=>[],
                    "choice"=>$divote->choice_id
                ];
            }
        }

        
        foreach ($countres as $divote) {
            if ($max["div".$divote->division_id]["count"] == $divote->count && $max["div".$divote->division_id]["choice"] != $divote->choice_id) {
                array_push($max["div".$divote->division_id]["dupe"], $divote);
            }
        }

        foreach ($max as $m=>$v) {
            if (count($v["dupe"]) > 0) {
                $max[$m]["point"] = 1/(count($max[$m]["dupe"])+1);
            }
        }

        return $max;
    }

}
