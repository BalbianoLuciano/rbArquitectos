<?php

namespace Database\Factories\Company;

use App\Models\Company\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Company::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->company,
            'direction' => $this->faker->address,
            'description' => $this->faker->text(200),
        ];
    }
}
