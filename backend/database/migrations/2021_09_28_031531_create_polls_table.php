<?php

use App\Models\Poll;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePollsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('polls', function (Blueprint $table) {
            $table->bigInteger("id",true);
            $table->string("title");
            $table->text("description");
            $table->datetime("deadline");
            $table->bigInteger("created_by");
            $table->timestamps();
            $table->softDeletes();

            $table->foreign("created_by")->references("id")->on("users")->onDelete("cascade");
        });

        $poll = new Poll();
        $poll->title="makan gratis tiap hari apa?";
        $poll->description="akan diadakan makan siang gratis tiap minggunya di hari tertentu antara senin/rabu/jumat";
        $poll->deadline="2021-12-12 12:00:00";
        $poll->created_by=1;
        $poll->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('polls');
    }
}
