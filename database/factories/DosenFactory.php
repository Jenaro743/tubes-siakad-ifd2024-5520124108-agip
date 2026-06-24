<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class DosenFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nidn' => fake()->unique()->numerify('##########'),
            'nama_dosen' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'no_telp' => fake()->phoneNumber(),
            'alamat' => fake()->address(),
        ];
    }
}
