<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    public function index(Request $request)
    {
        $jadwals = Jadwal::with('mataKuliah')
            ->whereHas('dosen', fn ($q) => $q->where('email', $request->user()->email))
            ->orderByRaw("FIELD(hari, 'Senin','Selasa','Rabu','Kamis','Jumat','Sabtu')")
            ->orderBy('jam_mulai')
            ->paginate(10)
            ->withQueryString();

        return view('dosen.jadwal.index', compact('jadwals'));
    }

    public function show(Jadwal $jadwal)
    {
        abort_unless($jadwal->dosen->email === auth()->user()->email, 403);

        return view('dosen.jadwal.show', compact('jadwal'));
    }
}
