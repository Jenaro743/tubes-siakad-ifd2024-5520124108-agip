<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Http\Requests\KrsRequest;
use App\Models\Jadwal;
use App\Models\Krs;
use Illuminate\Http\Request;

class KrsController extends Controller
{
    public function index(Request $request)
    {
        $mahasiswa = $request->user()->mahasiswa;
        abort_unless($mahasiswa, 403);

        $krs = $mahasiswa->krs()->with('jadwal.mataKuliah', 'jadwal.dosen')->get();
        $takenIds = $krs->pluck('jadwal_id');
        $jadwals = Jadwal::with('mataKuliah', 'dosen')
            ->whereNotIn('id', $takenIds)
            ->when($request->search, fn ($q, $s) => $q->whereHas('mataKuliah', fn ($m) => $m->where('nama_mk', 'like', "%{$s}%")->orWhere('kode_mk', 'like', "%{$s}%")))
            ->orderByRaw("FIELD(hari, 'Senin','Selasa','Rabu','Kamis','Jumat','Sabtu')")
            ->orderBy('jam_mulai')->paginate(10)->withQueryString();

        return view('mahasiswa.krs.index', [
            'mahasiswa' => $mahasiswa,
            'krs' => $krs,
            'jadwals' => $jadwals,
            'totalSks' => $krs->sum(fn ($item) => $item->jadwal->mataKuliah->sks),
        ]);
    }

    public function store(KrsRequest $request)
    {
        Krs::create([
            'mahasiswa_id' => $request->user()->mahasiswa->id,
            'jadwal_id' => $request->validated('jadwal_id'),
        ]);

        return back()->with('success', 'Mata kuliah berhasil ditambahkan ke KRS.');
    }

    public function destroy(Request $request, Krs $kr)
    {
        abort_unless($kr->mahasiswa_id === $request->user()->mahasiswa?->id, 403);
        $kr->delete();

        return back()->with('success', 'Mata kuliah berhasil dihapus dari KRS.');
    }

    public function print(Request $request)
    {
        $mahasiswa = $request->user()->mahasiswa;
        $krs = $mahasiswa->krs()->with('jadwal.mataKuliah', 'jadwal.dosen')->get();

        return view('mahasiswa.krs.print', [
            'mahasiswa' => $mahasiswa,
            'krs' => $krs,
            'totalSks' => $krs->sum(fn ($item) => $item->jadwal->mataKuliah->sks),
        ]);
    }
}
