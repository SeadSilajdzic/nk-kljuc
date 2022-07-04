<?php

namespace Database\Factories\Dashboard\Post;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->sentence(7);
        return [
            'user_id' => rand(1, 3),
            'title' => $title,
            'slug' => Str::slug($title),
            'subtitle' => $this->faker->sentence(12),
            'short_description' => $this->faker->sentences(2, true),
            'description' => $this->faker->paragraphs(4, true),
            'status' => rand(0, 1),
        ];
    }
}
