<?php

namespace Tests\Feature;

use App\Models\Dosen;
use App\Models\Jadwal;
use App\Models\Mahasiswa;
use App\Models\MataKuliah;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SiakadAccessTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_open_admin_dashboard(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $this->actingAs($admin)->get(route('dashboard'))->assertOk()->assertSee('Dashboard Admin');
    }

    public function test_mahasiswa_can_open_krs_page_and_admin_area_is_forbidden(): void
    {
        $user = User::factory()->create(['role' => 'mahasiswa']);
        Mahasiswa::create([
            'user_id' => $user->id,
            'npm' => '230001',
            'nama_mahasiswa' => 'Mahasiswa Test',
            'jurusan' => 'Teknik Informatika',
            'semester' => 3,
            'alamat' => 'Jl. Test',
            'no_telp' => '08123456789',
        ]);

        $this->actingAs($user)->get(route('mahasiswa.krs.index'))->assertOk()->assertSee('Kartu Rencana Studi');
        $this->actingAs($user)->get(route('admin.dosen.index'))->assertForbidden();
    }

    public function test_mahasiswa_cannot_take_same_schedule_twice(): void
    {
        $user = User::factory()->create(['role' => 'mahasiswa']);
        $mahasiswa = Mahasiswa::create([
            'user_id' => $user->id,
            'npm' => '230002',
            'nama_mahasiswa' => 'Mahasiswa KRS',
            'jurusan' => 'Sistem Informasi',
            'semester' => 2,
            'alamat' => 'Jl. KRS',
            'no_telp' => '08123456780',
        ]);
        $jadwal = Jadwal::create([
            'mata_kuliah_id' => MataKuliah::create(['kode_mk' => 'IF101', 'nama_mk' => 'Pemrograman Web', 'sks' => 3, 'semester' => 2])->id,
            'dosen_id' => Dosen::create(['nidn' => '1234567890', 'nama_dosen' => 'Dosen Test', 'email' => 'dosen@test.local', 'no_telp' => '0811', 'alamat' => 'Kampus'])->id,
            'hari' => 'Senin',
            'jam_mulai' => '08:00',
            'jam_selesai' => '09:40',
            'kelas' => 'A',
            'ruangan' => 'R101',
        ]);

        $this->actingAs($user)->post(route('mahasiswa.krs.store'), ['jadwal_id' => $jadwal->id])->assertRedirect();
        $this->actingAs($user)->post(route('mahasiswa.krs.store'), ['jadwal_id' => $jadwal->id])->assertSessionHasErrors('jadwal_id');
        $this->assertDatabaseCount('krs', 1);
        $this->assertDatabaseHas('krs', ['mahasiswa_id' => $mahasiswa->id, 'jadwal_id' => $jadwal->id]);
    }
}
