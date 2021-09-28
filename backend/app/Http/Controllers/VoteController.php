<?php

namespace App\Http\Controllers;

use App\Models\Vote;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Lcobucci\JWT\Signer\Hmac;

class VoteController extends Controller
{
    public function vote($pollId,$choiceId)
    {

        
        $user = auth()->user();
        
        $test = Vote::where("user_id",$user->id)->where("poll_id",$pollId)->get();
        if (count($test)) {
            return response()->json(["message"=>"already voted"],422);
        }

        DB::beginTransaction();

        try {

            $vote = new Vote();
            $vote->poll_id = $pollId;
            $vote->choice_id = $choiceId;
            $vote->user_id = $user->id;
            $vote->division_id = $user->division_id;
            $vote->save();

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(["message"=>$e],422);
        }
        

        return $vote;
    }
}

/* 
select users.division_id,choices.id,choices.choice,max(rest) from users inner join votes on users.id=votes.user_id inner join choices on votes.choice_id=choices.id inner join (
SELECT division_id,choice_id,count(choice_id) as rest FROM votes LEFT JOIN choices ON choices.id = votes.choice_id WHERE choices.poll_id = 20 group by 1,2) as rank on votes.division_id=rank.division_id
and votes.choice_id=rank.choice_id group by 1;

*/
