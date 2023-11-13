<?php

namespace Database\Factories\Projects;

use App\Models\Projects\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Project::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->catchPhrase,
            'direction' => $this->faker->address,
            'description' => $this->faker->text(200),
            'start' => $this->faker->date(),
            'end' => $this->faker->date(),
            'isOtherProject' => $this->faker->boolean,
        ];
    }
}
