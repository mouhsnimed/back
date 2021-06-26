<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactAnnoncesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_annonces', function (Blueprint $table) {
            $table->id();
            $table->text('message');
            $table->dateTime('dateContact');
            $table->string('pseudo');
            $table->string('email')->unique();
            $table->string('Numero');
            $table->foreignId('annonce_id');
            $table->foreign('annonce_id')->references('id')->on('annonces');
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
        Schema::dropIfExists('contact_annonces');
    }
}
