<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MataKuliahFactory extends Factory
{
    public function definition(): array
    {
        return [
            'kode_mk' => fake()->unique()->bothify('MK###'),
            'nama_mk' => fake()->words(3, true),
            'sks' => fake()->numberBetween(2, 4),
            'semester' => fake()->numberBetween(1, 8),
        ];
    }
}
