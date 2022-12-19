<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('programming_language');
            $table->unsignedBigInteger('team_id');
            $table->unsignedBigInteger('leader_id');
            $table->string('github_repository');
            $table->string('image')->nullable();
            $table->tinyInteger('status');
            $table->timestamps();

            $table->foreign('team_id')->references('id')->on('teams');
            $table->foreign('leader_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
};
