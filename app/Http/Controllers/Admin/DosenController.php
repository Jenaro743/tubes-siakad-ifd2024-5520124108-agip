<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\DosenRequest;
use App\Models\Dosen;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class DosenController extends Controller
{
    public function index(Request $request)
    {
        $dosens = Dosen::query()
            ->when($request->search, fn ($q, $s) => $q->where('nidn', 'like', "%{$s}%")->orWhere('nama_dosen', 'like', "%{$s}%")->orWhere('email', 'like', "%{$s}%"))
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.dosen.index', compact('dosens'));
    }

    public function create()
    {
        return view('admin.dosen.create', ['dosen' => new Dosen()]);
    }

    public function store(DosenRequest $request)
    {
        Dosen::create($request->validated());

        return to_route('admin.dosen.index')->with('success', 'Data dosen berhasil ditambahkan.');
    }

    public function show(Dosen $dosen)
    {
        $dosen->load('jadwals.mataKuliah');

        return view('admin.dosen.show', compact('dosen'));
    }

    public function edit(Dosen $dosen)
    {
        return view('admin.dosen.edit', compact('dosen'));
    }

    public function update(DosenRequest $request, Dosen $dosen)
    {
        $dosen->update($request->validated());

        return to_route('admin.dosen.index')->with('success', 'Data dosen berhasil diperbarui.');
    }

    public function destroy(Dosen $dosen)
    {
        $dosen->delete();

        return back()->with('success', 'Data dosen berhasil dihapus.');
    }

    public function export(): StreamedResponse
    {
        return response()->streamDownload(function () {
            $out = fopen('php://output', 'w');
            fputcsv($out, ['NIDN', 'Nama', 'Email', 'No Telp', 'Alamat']);
            Dosen::orderBy('nama_dosen')->each(fn ($d) => fputcsv($out, [$d->nidn, $d->nama_dosen, $d->email, $d->no_telp, $d->alamat]));
            fclose($out);
        }, 'data-dosen.csv', ['Content-Type' => 'text/csv']);
    }
}
