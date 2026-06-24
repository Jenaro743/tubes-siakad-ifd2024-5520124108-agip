<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\JadwalRequest;
use App\Models\Dosen;
use App\Models\Jadwal;
use App\Models\MataKuliah;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class JadwalController extends Controller
{
    public function index(Request $request)
    {
        $jadwals = Jadwal::with('dosen', 'mataKuliah')
            ->when($request->search, fn ($q, $s) => $q->where('hari', 'like', "%{$s}%")->orWhere('kelas', 'like', "%{$s}%")->orWhere('ruangan', 'like', "%{$s}%")->orWhereHas('mataKuliah', fn ($m) => $m->where('nama_mk', 'like', "%{$s}%")))
            ->when($request->hari, fn ($q, $h) => $q->where('hari', $h))
            ->orderByRaw("FIELD(hari, 'Senin','Selasa','Rabu','Kamis','Jumat','Sabtu')")
            ->orderBy('jam_mulai')->paginate(10)->withQueryString();

        return view('admin.jadwal.index', compact('jadwals'));
    }

    public function create()
    {
        return view('admin.jadwal.create', $this->formData(new Jadwal()));
    }

    public function store(JadwalRequest $request)
    {
        Jadwal::create($request->validated());

        return to_route('admin.jadwal.index')->with('success', 'Jadwal berhasil ditambahkan.');
    }

    public function show(Jadwal $jadwal)
    {
        $jadwal->load('dosen', 'mataKuliah', 'krs.mahasiswa');

        return view('admin.jadwal.show', compact('jadwal'));
    }

    public function edit(Jadwal $jadwal)
    {
        return view('admin.jadwal.edit', $this->formData($jadwal));
    }

    public function update(JadwalRequest $request, Jadwal $jadwal)
    {
        $jadwal->update($request->validated());

        return to_route('admin.jadwal.index')->with('success', 'Jadwal berhasil diperbarui.');
    }

    public function destroy(Jadwal $jadwal)
    {
        $jadwal->delete();

        return back()->with('success', 'Jadwal berhasil dihapus.');
    }

    public function export(): StreamedResponse
    {
        return response()->streamDownload(function () {
            $out = fopen('php://output', 'w');
            fputcsv($out, ['Mata Kuliah', 'Dosen', 'Hari', 'Jam', 'Kelas', 'Ruangan']);
            Jadwal::with('dosen', 'mataKuliah')->each(fn ($j) => fputcsv($out, [$j->mataKuliah->nama_mk, $j->dosen->nama_dosen, $j->hari, $j->jam_mulai.'-'.$j->jam_selesai, $j->kelas, $j->ruangan]));
            fclose($out);
        }, 'data-jadwal.csv', ['Content-Type' => 'text/csv']);
    }

    private function formData(Jadwal $jadwal): array
    {
        return [
            'jadwal' => $jadwal,
            'dosens' => Dosen::orderBy('nama_dosen')->get(),
            'mataKuliahs' => MataKuliah::orderBy('semester')->orderBy('nama_mk')->get(),
            'hariList' => ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'],
        ];
    }
}
