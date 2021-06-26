<?php

namespace Database\Factories;

use App\Models\categorie_annonce;
use Illuminate\Database\Eloquent\Factories\Factory;

class categorie_annonceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = categorie_annonce::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nom' => $this->faker->text(12)
        ];
    }
}
