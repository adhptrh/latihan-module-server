<?php

namespace App\Http\Controllers;

use App\Models\Choice;
use App\Models\Poll;
use App\Models\Vote;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

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

        if ($user->role == "admin" || $userVoted) {
            return response()->json(Poll::with(["users:username","choices"])->deadline()->get()->toArray());
        }
    }

    public function getAPoll($pollId) {
        return response()->json(Poll::with("choices")->where("id",$pollId)->get());
    }

}
