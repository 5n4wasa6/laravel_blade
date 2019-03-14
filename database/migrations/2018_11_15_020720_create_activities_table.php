<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->dateTime('activity_at')->nullable();
            $table->string('subject');
            $table->string('title');
            $table->string('appeal')->nullable();
            $table->string('nextaction')->nullable();
            $table->string('free')->nullable();
            $table->string('activity_img')->nullable();
            $table->integer('language')->nullable();
            $table->integer('coin')->nullable();
            $table->integer('level')->nullable();
            $table->integer('exp')->nullable();
            $table->integer('ttl')->nullable();
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
        Schema::dropIfExists('activities');
    }
}
