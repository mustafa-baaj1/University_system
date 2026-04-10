<?php

namespace Database\Factories;

use App\Models\Department;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Program>
 */
class programFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $types = ["phd" , "masters" , "bchelors"];
        return [
            "name"=>$this->faker->words(2,true),
            "type"=>$this->faker->randomElement($types),
            "department_id"=> Department::factory(),

        ];
    }
}
