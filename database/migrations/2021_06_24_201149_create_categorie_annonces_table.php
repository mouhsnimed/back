<?php

use App\Models\categorie_annonce;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategorieAnnoncesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categorie_annonces', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->timestamps();
        });


        $data =  array(
            [
                'name' => 'Duplex',
            ],
            [
                'name' => 'Maison',
            ],
            [
                'name' => 'Villa',
            ],
            [
                'name' => 'Studio',
            ],
        );
        foreach ($data as $datum){
            $category = new categorie_annonce(); //The Category is the model for your migration
            $category->nom =$datum['name'];
            $category->save();
        }

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categorie_annonces');
    }
}
