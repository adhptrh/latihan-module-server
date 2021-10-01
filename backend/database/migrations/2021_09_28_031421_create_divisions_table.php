<?php

use App\Models\Division;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDivisionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('divisions', function (Blueprint $table) {
            $table->bigInteger("id",true);
            $table->string("name");
            $table->timestamps();
        });

        $div = new Division();
        $div->name = "Payment";
        $div->save();

        $div = new Division();
        $div->name = "Procurement";
        $div->save();

        $div = new Division();
        $div->name = "IT";
        $div->save();

        $div = new Division();
        $div->name = "Finance";
        $div->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('divisions');
    }
}
