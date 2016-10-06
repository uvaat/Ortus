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
            $table->string('zip');

            $table->softDeletes();
            $table->timestamps();

        });

        Schema::create('squares', function (Blueprint $table) {

            $table->increments('id');
            $table->text('name');
            $table->float('lat');
            $table->float('lng');
            $table->string('openclose')->nullable();
            $table->string('phone')->nullable();
            $table->string('adress')->nullable();
            $table->text('description')->nullable();

            $table->integer('city_id')->unsigned();
            $table->foreign('city_id')
                ->references('id')
                ->on('cities')
                ->onDelete('cascade');

            $table->softDeletes();
            $table->timestamps();

        });

        Schema::create('equipment_types', function (Blueprint $table) {

            $table->increments('id');
            $table->text('name');

            $table->softDeletes();
            $table->timestamps();

        });

        Schema::create('equipments', function (Blueprint $table) {

            $table->increments('id');
            $table->text('name');
            $table->integer('equipment_type_id')->unsigned();
            $table->foreign('equipment_type_id')
                ->references('id')
                ->on('equipment_types')
                ->onDelete('cascade');

            $table->softDeletes();
            $table->timestamps();

        });

        Schema::create('equipments_squares', function (Blueprint $table) {

            $table->integer('equipment_id')->unsigned()->index();
            $table->integer('square_id')->unsigned()->index();

            $table->foreign('equipment_id')
                ->references('id')
                ->on('equipments')
                ->onDelete('cascade');

            $table->foreign('square_id')
                ->references('id')
                ->on('squares')
                ->onDelete('cascade');

        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('equipments_squares');
        Schema::dropIfExists('equipments');
        Schema::dropIfExists('equipment_types');
        Schema::dropIfExists('squares');
        Schema::dropIfExists('cities');
    }
}
