<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(),
            'author' => $this->faker->firstName(),
            'content' => $this->faker->paragraph(5), 
            'thumbnail' => $this->faker->imageUrl(),
            'data' => $this->faker->dateTime(),
            'category_id' => rand(1, 10)
        ];
    }
}
