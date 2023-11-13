<?php

namespace Database\Factories\Authors;

use App\Models\Authors\Author;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Author>
 */
class AuthorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Author::class;
    
    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User::factory(), // Esto creará un User y usará su ID.
            'name' => $this->faker->name,
            'biography' => $this->faker->text,
            'date_of_birth' => $this->faker->date(),
            'place_of_birth' => $this->faker->city,
        ];
    }
}
