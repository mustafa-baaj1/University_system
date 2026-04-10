<?php

namespace Database\Factories;

use App\Models\Program;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class studentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "name"=>$this->faker->name(),
            "email"=>$this->faker->unique()->safeEmail(),
            "phone"=>$this->faker->phoneNumber(),
            "address"=>$this->faker->address(),
            "program_id"=> Program::factory(),

        ];
    }

}
