<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    public function index(Request $request)
    {
        $mahasiswa = $request->user()->mahasiswa;
        abort_unless($mahasiswa, 403);

        $krs = $mahasiswa->krs()
            ->with('jadwal.mataKuliah', 'jadwal.dosen')
            ->whereHas('jadwal', fn ($q) => $q->when($request->hari, fn ($qq, $hari) => $qq->where('hari', $hari)))
            ->get()
            ->sortBy([fn ($a, $b) => strcmp($a->jadwal->hari, $b->jadwal->hari), fn ($a, $b) => strcmp($a->jadwal->jam_mulai, $b->jadwal->jam_mulai)]);

        return view('mahasiswa.jadwal.index', [
            'krs' => $krs,
            'hariList' => ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'],
        ]);
    }
}
