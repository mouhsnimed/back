<?php

namespace Database\Factories;

use App\Models\Illustration;
use Illuminate\Database\Eloquent\Factories\Factory;

class IllustrationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Illustration::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $links = [
            'https://my.matterport.com/show/?m=5KnP4EGxb1z',
            'https://my.matterport.com/show/?m=bGUgumJN37b',
            'https://my.matterport.com/show/?m=HSb6rNm792q',
            'https://my.matterport.com/show/?m=As8NVy1khFX'
        ];

        return [
            'titre' => $this->faker->text(12),
            'type' => 'visite virtuelle',
            'date_creation' => $this->faker->date(),
            'chemin' => $links[rand(0,3)],
            'vote_like' => rand(0,1000),
            'vote_dislike' =>  rand(0,1000),
            'shooter_id' => 1
        ];
    }
}
