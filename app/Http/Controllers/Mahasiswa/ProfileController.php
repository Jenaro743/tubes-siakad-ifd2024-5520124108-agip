<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Http\Requests\MahasiswaRequest;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function edit()
    {
        return view('mahasiswa.profile.edit', ['mahasiswa' => auth()->user()->mahasiswa]);
    }

    public function update(MahasiswaRequest $request)
    {
        $mahasiswa = $request->user()->mahasiswa;
        $data = $request->validated();
        if ($request->hasFile('foto')) {
            if ($mahasiswa->foto) {
                Storage::disk('public')->delete($mahasiswa->foto);
            }
            $data['foto'] = $request->file('foto')->store('mahasiswa', 'public');
        }
        $mahasiswa->update($data);
        $request->user()->update(['name' => $data['nama_mahasiswa']]);

        return back()->with('success', 'Profil berhasil diperbarui.');
    }
}
