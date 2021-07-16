<?php

namespace Database\Factories;

use App\Models\annonce;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class AnnonceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = annonce::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'titre' => $this->faker->text(12),
            'type_annonce' => rand(0,1) == 0 ?  "Vente" : "Location",
            'pays' => "Maroc",
            'ville' => 'Casablanca',
            'adresse' => $this->faker->text(22),
            'localisation_geo' => rand(0.1,1000000) ,
            'superficie' => rand(1,10000),
            'prix' => rand(0.1,100000),
            'nombre_chambre' => rand(0,10),
            'nombre_bain' => rand(0,3),
            'nombre_salon'=> rand(0,5),
            'description'=> $this->faker->text(255),
            'etage'=> rand(0,5),
            'etat_bien'=> $this->faker->text(15),
            'special'=> $this->faker->text(10),
            'meuble'=> rand(0,1),
            'user_id' => 5,
            'categorie_annonce_id' => rand(1,5)
        ];
    }
}
