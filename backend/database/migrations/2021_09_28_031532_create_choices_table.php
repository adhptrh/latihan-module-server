<?php

use App\Models\Choice;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('choices', function (Blueprint $table) {
            $table->bigInteger("id",true);
            $table->string("choice");
            $table->bigInteger("poll_id");
            $table->timestamps();

            $table->foreign("poll_id")->references("id")->on("polls")->onDelete("cascade");
        });

        $choice = new Choice();
        $choice->choice="Senin";
        $choice->poll_id=1;
        $choice->save();

        $choice = new Choice();
        $choice->choice="Rabu";
        $choice->poll_id=1;
        $choice->save();

        $choice = new Choice();
        $choice->choice="Jumat";
        $choice->poll_id=1;
        $choice->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('choices');
    }
}
