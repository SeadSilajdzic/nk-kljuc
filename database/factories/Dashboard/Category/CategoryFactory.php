<?php

namespace Database\Factories\Dashboard\Category;

use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->words(rand(1, 2), true)
        ];
    }
}
