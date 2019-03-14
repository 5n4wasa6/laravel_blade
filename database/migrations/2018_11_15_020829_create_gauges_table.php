<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGaugesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gauges', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_id')->nullable();
            
            $table->datetime('activity_at')->nullable();
            $table->string('act_title');
            $table->string('appeal')->nullable();
            $table->string('nextaction')->nullable();
            $table->string('free')->nullable();
            $table->string('activity_img')->nullable();
            
            $table->string('language')->nullable();
            $table->integer('denominator')->nullable();
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
        Schema::dropIfExists('gauges');
    }
}
