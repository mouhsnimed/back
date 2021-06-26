<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIllustrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('illustrations', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->string('type');
            $table->string('chemin');
            $table->dateTime('date_creation');
            $table->integer('vote_like');
            $table->integer('vote_dislike');
            $table->foreignId('shooter_id');
            $table->timestamps();
            $table->foreign('shooter_id')->references('id')->on('shooters');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('illustrations');
    }
}
