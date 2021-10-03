<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigInteger("id",true);
            $table->string('username');
            $table->string('password');
            $table->string('role');
            $table->bigInteger('division_id');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign("division_id")->references("id")->on("divisions")->onDelete("cascade");
 
        });

        $user = new User();
        $user->username = "admin";
        $user->password = Hash::make("admin");
        $user->role = "admin";
        $user->division_id = 1;
        $user->save();

        $user = new User();
        $user->username = "it1";
        $user->password = Hash::make("user");
        $user->role = "user";
        $user->division_id = 3;
        $user->save();

        $user = new User();
        $user->username = "it2";
        $user->password = Hash::make("user");
        $user->role = "user";
        $user->division_id = 3;
        $user->save();

        $user = new User();
        $user->username = "procurement1";
        $user->password = Hash::make("user");
        $user->role = "user";
        $user->division_id = 2;
        $user->save();

        $user = new User();
        $user->username = "procurement2";
        $user->password = Hash::make("user");
        $user->role = "user";
        $user->division_id = 2;
        $user->save();

        $user = new User();
        $user->username = "procurement3";
        $user->password = Hash::make("user");
        $user->role = "user";
        $user->division_id = 2;
        $user->save();

        $user = new User();
        $user->username = "payment1";
        $user->password = Hash::make("user");
        $user->role = "user";
        $user->division_id = 1;
        $user->save();

        /* $user = new User();
        $user->username = "payment2";
        $user->password = Hash::make("user");
        $user->role = "user";
        $user->division_id = 1;
        $user->save(); */

        /* $user = new User();
        $user->username = "payment3";
        $user->password = Hash::make("user");
        $user->role = "user";
        $user->division_id = 1;
        $user->save(); */
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
