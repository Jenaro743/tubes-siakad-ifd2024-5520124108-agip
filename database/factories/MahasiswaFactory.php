<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class MahasiswaFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'npm' => fake()->unique()->numerify('########'),
            'nama_mahasiswa' => fake()->name(),
            'jurusan' => fake()->randomElement(['Teknik Informatika', 'Sistem Informasi']),
            'semester' => fake()->numberBetween(1, 8),
            'alamat' => fake()->address(),
            'no_telp' => fake()->phoneNumber(),
        ];
    }
}
