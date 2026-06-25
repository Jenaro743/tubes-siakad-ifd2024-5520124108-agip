<?php

namespace Database\Seeders;

use App\Models\Dosen;
use App\Models\Jadwal;
use App\Models\Mahasiswa;
use App\Models\MataKuliah;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            ['name' => 'Administrator', 'password' => Hash::make('12345678'), 'role' => 'admin', 'email_verified_at' => now()]
        );

        $dosens = collect(range(1, 10))->map(function ($i) {
            $dosen = Dosen::updateOrCreate(
                ['nidn' => '10203040'.str_pad($i, 2, '0', STR_PAD_LEFT)],
                [
                    'nama_dosen' => fake()->name(),
                    'email' => 'dosen'.$i.'@siakad.test',
                    'no_telp' => '08123'.str_pad((string) $i, 7, '0', STR_PAD_LEFT),
                    'alamat' => fake()->address(),
                ]
            );

            User::updateOrCreate(
                ['email' => $dosen->email],
                ['name' => $dosen->nama_dosen, 'password' => Hash::make('12345678'), 'role' => 'dosen', 'email_verified_at' => now()]
            );

            return $dosen;
        });

        $jurusan = ['Teknik Informatika', 'Sistem Informasi', 'Manajemen Informatika'];
        collect(range(1, 20))->each(function ($i) use ($jurusan) {
            $user = User::updateOrCreate(
                ['email' => 'mahasiswa'.$i.'@siakad.test'],
                ['name' => 'Mahasiswa '.$i, 'password' => Hash::make('12345678'), 'role' => 'mahasiswa', 'email_verified_at' => now()]
            );

            Mahasiswa::updateOrCreate(
                ['npm' => '23100'.str_pad((string) $i, 3, '0', STR_PAD_LEFT)],
                [
                    'user_id' => $user->id,
                    'nama_mahasiswa' => $user->name,
                    'jurusan' => $jurusan[array_rand($jurusan)],
                    'semester' => rand(1, 8),
                    'alamat' => fake()->address(),
                    'no_telp' => '08570'.str_pad((string) $i, 7, '0', STR_PAD_LEFT),
                ]
            );
        });

        $mkNames = [
            'Algoritma dan Pemrograman', 'Basis Data', 'Pemrograman Web', 'Jaringan Komputer',
            'Sistem Operasi', 'Rekayasa Perangkat Lunak', 'Struktur Data', 'Kecerdasan Buatan',
            'Analisis Sistem', 'Interaksi Manusia Komputer', 'Keamanan Informasi',
            'Data Mining', 'Cloud Computing', 'Manajemen Proyek TI', 'Mobile Programming',
        ];

        $mataKuliahs = collect($mkNames)->values()->map(fn ($nama, $i) => MataKuliah::updateOrCreate(
            ['kode_mk' => 'IF'.str_pad((string) ($i + 101), 3, '0', STR_PAD_LEFT)],
            ['nama_mk' => $nama, 'sks' => rand(2, 4), 'semester' => ($i % 8) + 1]
        ));

        $hari = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
        collect(range(1, 20))->each(function ($i) use ($dosens, $mataKuliahs, $hari) {
            $startHour = 7 + ($i % 8);
            Jadwal::updateOrCreate(
                [
                    'mata_kuliah_id' => $mataKuliahs->random()->id,
                    'kelas' => chr(64 + (($i % 4) + 1)),
                ],
                [
                    'dosen_id' => $dosens->random()->id,
                    'hari' => $hari[$i % count($hari)],
                    'jam_mulai' => sprintf('%02d:00:00', $startHour),
                    'jam_selesai' => sprintf('%02d:40:00', $startHour + 1),
                    'ruangan' => 'R'.(100 + $i),
                ]
            );
        });
    }
}
