<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnnoncesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('annonces', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->string('type_annonce');
            $table->dateTime('date_annonce');
            $table->string('pays');
            $table->string('ville');
            $table->string('adresse');
            $table->string('localisation_geo');
            $table->float('superficie');
            $table->float('prix');
            $table->integer('nombre_chambre');
            $table->integer('nombre_bain');
            $table->integer('nombre_salon');
            $table->text('description');
            $table->string('etage');
            $table->string('etat_bien');
            $table->string('special');
            $table->boolean('meuble');
            $table->foreignId('person_id');
            $table->foreignId('categorie_annonce_id');
            $table->timestamps();
            $table->foreign('person_id')->references('id')->on('persons');
            $table->foreign('categorie_annonce_id')->references('id')->on('categorie_annonces');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('annonces');
    }
}
