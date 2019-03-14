<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goals', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('company_name')->nullable();
            $table->string('priority');
            $table->string('goal');
            $table->dateTime('commit_at')->nullable();
            $table->string('why')->nullable();
            $table->string('how')->nullable();
            $table->string('what')->nullable();
            $table->string('target')->nullable();
            $table->string('market')->nullable();
            $table->string('competitor')->nullable();
            $table->string('schedule')->nullable();
            $table->string('nextaction')->nullable();
            $table->string('goal_img')->nullable();
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
        Schema::dropIfExists('goals');
    }
}
