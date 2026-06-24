<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MataKuliahRequest;
use App\Models\MataKuliah;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class MataKuliahController extends Controller
{
    public function index(Request $request)
    {
        $mataKuliahs = MataKuliah::query()
            ->when($request->search, fn ($q, $s) => $q->where('kode_mk', 'like', "%{$s}%")->orWhere('nama_mk', 'like', "%{$s}%"))
            ->when($request->semester, fn ($q, $s) => $q->where('semester', $s))
            ->orderBy('semester')->paginate(10)->withQueryString();

        return view('admin.mata-kuliah.index', compact('mataKuliahs'));
    }

    public function create()
    {
        return view('admin.mata-kuliah.create', ['mataKuliah' => new MataKuliah()]);
    }

    public function store(MataKuliahRequest $request)
    {
        MataKuliah::create($request->validated());

        return to_route('admin.mata-kuliah.index')->with('success', 'Mata kuliah berhasil ditambahkan.');
    }

    public function show(MataKuliah $mataKuliah)
    {
        $mataKuliah->load('jadwals.dosen');

        return view('admin.mata-kuliah.show', compact('mataKuliah'));
    }

    public function edit(MataKuliah $mataKuliah)
    {
        return view('admin.mata-kuliah.edit', compact('mataKuliah'));
    }

    public function update(MataKuliahRequest $request, MataKuliah $mataKuliah)
    {
        $mataKuliah->update($request->validated());

        return to_route('admin.mata-kuliah.index')->with('success', 'Mata kuliah berhasil diperbarui.');
    }

    public function destroy(MataKuliah $mataKuliah)
    {
        $mataKuliah->delete();

        return back()->with('success', 'Mata kuliah berhasil dihapus.');
    }

    public function export(): StreamedResponse
    {
        return response()->streamDownload(function () {
            $out = fopen('php://output', 'w');
            fputcsv($out, ['Kode', 'Nama', 'SKS', 'Semester']);
            MataKuliah::orderBy('semester')->each(fn ($m) => fputcsv($out, [$m->kode_mk, $m->nama_mk, $m->sks, $m->semester]));
            fclose($out);
        }, 'data-mata-kuliah.csv', ['Content-Type' => 'text/csv']);
    }
}
