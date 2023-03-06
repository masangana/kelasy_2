<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Personne>
 */
class PersonneFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nom' => fake()->lastName(),
            'postnom' => fake()->firstName(),
            'prenom' => fake()->firstName(),
            'sexe' => fake()->randomElement(['M', 'F']),
            'date_naissance' => fake()->dateTimeBetween('-50 years', '-18 years'),
            'lieu_naissance' => fake()->city(),
            'adresse' => fake()->address(),
            'telephone' => fake()->phoneNumber(),
            'email' => fake()->unique()->safeEmail(),
            'photo' => fake()->imageUrl(640, 480, 'people'),
            'user_id' => fake()->randomElement([11, 2, 3, 4, 5, 6, 7, 8, 9, 10]),
            'ecole_id' => 1,
        ];
    }
}
