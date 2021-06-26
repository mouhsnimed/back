<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentairesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commentaires', function (Blueprint $table) {
            $table->id();
            $table->text('message');
            $table->dateTime('date_commentaire');
            $table->string('pseudo');
            $table->string('email')->unique(); 
            $table->foreignId('illustration_id');           
            $table->timestamps();
            $table->foreign('illustration_id')->references('id')->on('illustrations');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('commentaires');
    }
}
