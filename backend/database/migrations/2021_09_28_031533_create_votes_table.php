<?php

use App\Models\User;
use App\Models\Vote;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('votes', function (Blueprint $table) {
            $table->bigInteger("id",true);
            $table->bigInteger("choice_id");
            $table->bigInteger("user_id");
            $table->bigInteger("poll_id");
            $table->bigInteger("division_id");
            $table->timestamps();

            $table->foreign("choice_id")->references("id")->on("choices")->onDelete("cascade");
            $table->foreign("user_id")->references("id")->on("users")->onDelete("cascade");
            $table->foreign("poll_id")->references("id")->on("polls")->onDelete("cascade");
            $table->foreign("division_id")->references("id")->on("divisions")->onDelete("cascade");
        });

        $vote = new Vote();
        $vote->choice_id = 2;
        $vote->user_id = 7;
        $vote->poll_id = 1;
        $vote->division_id = 1;
        $vote->save();

        /* $vote = new Vote();
        $vote->choice_id = 2;
        $vote->user_id = 8;
        $vote->poll_id = 1;
        $vote->division_id = 1;
        $vote->save();

        $vote = new Vote();
        $vote->choice_id = 1;
        $vote->user_id = 9;
        $vote->poll_id = 1;
        $vote->division_id = 1;
        $vote->save(); */

        $vote = new Vote();
        $vote->choice_id = 1;
        $vote->user_id = 4;
        $vote->poll_id = 1;
        $vote->division_id = 2;
        $vote->save();

        $vote = new Vote();
        $vote->choice_id = 2;
        $vote->user_id = 5;
        $vote->poll_id = 1;
        $vote->division_id = 2;
        $vote->save();

        $vote = new Vote();
        $vote->choice_id = 3;
        $vote->user_id = 6;
        $vote->poll_id = 1;
        $vote->division_id = 2;
        $vote->save();

        $vote = new Vote();
        $vote->choice_id = 1;
        $vote->user_id = 2;
        $vote->poll_id = 1;
        $vote->division_id = 3;
        $vote->save();

        $vote = new Vote();
        $vote->choice_id = 2;
        $vote->user_id = 2;
        $vote->poll_id = 1;
        $vote->division_id = 3;
        $vote->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('votes');
    }
}
