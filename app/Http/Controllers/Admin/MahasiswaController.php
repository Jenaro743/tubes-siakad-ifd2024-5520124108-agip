<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MahasiswaRequest;
use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class MahasiswaController extends Controller
{
    public function index(Request $request)
    {
        $mahasiswas = Mahasiswa::with('user')
            ->when($request->search, fn ($q, $s) => $q->where('npm', 'like', "%{$s}%")->orWhere('nama_mahasiswa', 'like', "%{$s}%")->orWhere('jurusan', 'like', "%{$s}%"))
            ->when($request->semester, fn ($q, $s) => $q->where('semester', $s))
            ->latest()->paginate(10)->withQueryString();

        return view('admin.mahasiswa.index', compact('mahasiswas'));
    }

    public function create()
    {
        return view('admin.mahasiswa.create', ['mahasiswa' => new Mahasiswa()]);
    }

    public function store(MahasiswaRequest $request)
    {
        DB::transaction(function () use ($request) {
            $data = $request->validated();
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'role' => 'mahasiswa',
            ]);
            $data['user_id'] = $user->id;
            if ($request->hasFile('foto')) {
                $data['foto'] = $request->file('foto')->store('mahasiswa', 'public');
            }
            Mahasiswa::create($data);
        });

        return to_route('admin.mahasiswa.index')->with('success', 'Data mahasiswa berhasil ditambahkan.');
    }

    public function show(Mahasiswa $mahasiswa)
    {
        $mahasiswa->load('user', 'krs.jadwal.mataKuliah', 'krs.jadwal.dosen');

        return view('admin.mahasiswa.show', compact('mahasiswa'));
    }

    public function edit(Mahasiswa $mahasiswa)
    {
        $mahasiswa->load('user');

        return view('admin.mahasiswa.edit', compact('mahasiswa'));
    }

    public function update(MahasiswaRequest $request, Mahasiswa $mahasiswa)
    {
        DB::transaction(function () use ($request, $mahasiswa) {
            $data = $request->validated();
            $mahasiswa->user->update([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => filled($data['password'] ?? null) ? Hash::make($data['password']) : $mahasiswa->user->password,
            ]);
            if ($request->hasFile('foto')) {
                if ($mahasiswa->foto) {
                    Storage::disk('public')->delete($mahasiswa->foto);
                }
                $data['foto'] = $request->file('foto')->store('mahasiswa', 'public');
            }
            $mahasiswa->update($data);
        });

        return to_route('admin.mahasiswa.index')->with('success', 'Data mahasiswa berhasil diperbarui.');
    }

    public function destroy(Mahasiswa $mahasiswa)
    {
        if ($mahasiswa->foto) {
            Storage::disk('public')->delete($mahasiswa->foto);
        }
        $mahasiswa->user()->delete();

        return back()->with('success', 'Data mahasiswa berhasil dihapus.');
    }

    public function export(): StreamedResponse
    {
        return response()->streamDownload(function () {
            $out = fopen('php://output', 'w');
            fputcsv($out, ['NPM', 'Nama', 'Jurusan', 'Semester', 'Email', 'No Telp']);
            Mahasiswa::with('user')->orderBy('nama_mahasiswa')->each(fn ($m) => fputcsv($out, [$m->npm, $m->nama_mahasiswa, $m->jurusan, $m->semester, $m->user->email, $m->no_telp]));
            fclose($out);
        }, 'data-mahasiswa.csv', ['Content-Type' => 'text/csv']);
    }
}
