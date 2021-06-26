<?php

namespace Database\Factories;

use App\Models\Person;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PersonFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Person::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nom' => $this->faker->name(),
            'prenoms' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'numero' => rand(0000000,99999999),
            'type' => 'annonceur',
            'password' => Str::random(4),
        ];
    }
}
