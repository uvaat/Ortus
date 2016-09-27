<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSquaresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {   

        Schema::create('cities', function (Blueprint $table) {

            $table->increments('id');
            $table->string('name');
            $table->timestamps();

        });

        Schema::create('squares', function (Blueprint $table) {

            $table->increments('id');
            $table->text('name');
            $table->float('lat');
            $table->float('lng');

            $table->integer('city_id')->unsigned();
            $table->foreign('city_id')
                ->references('id')
                ->on('cities')
                ->onDelete('cascade');

            $table->softDeletes();
            $table->timestamps();

        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('squares');
        Schema::dropIfExists('cities');
    }
}
