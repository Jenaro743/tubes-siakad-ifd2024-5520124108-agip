<x-app-layout>
    <x-slot name="header"><h1 class="h3 mb-0">Profil Mahasiswa</h1></x-slot>
    <div class="card border-0 shadow-sm"><div class="card-body">
        <form method="POST" enctype="multipart/form-data" action="{{ route('mahasiswa.profile.update') }}">
            @csrf @method('PATCH')
            <div class="row g-3">
                <div class="col-md-8"><label class="form-label">Nama</label><input class="form-control" name="nama_mahasiswa" value="{{ old('nama_mahasiswa', $mahasiswa->nama_mahasiswa) }}" required></div>
                <div class="col-md-4"><label class="form-label">NPM</label><input class="form-control" value="{{ $mahasiswa->npm }}" disabled></div>
                <div class="col-md-6"><label class="form-label">Jurusan</label><input class="form-control" name="jurusan" value="{{ old('jurusan', $mahasiswa->jurusan) }}" required></div>
                <div class="col-md-3"><label class="form-label">Semester</label><input type="number" class="form-control" name="semester" value="{{ old('semester', $mahasiswa->semester) }}" required></div>
                <div class="col-md-3"><label class="form-label">No Telp</label><input class="form-control" name="no_telp" value="{{ old('no_telp', $mahasiswa->no_telp) }}" required></div>
                <div class="col-md-6"><label class="form-label">Foto Profil</label><input type="file" class="form-control" name="foto" accept="image/*"></div>
                <div class="col-12"><label class="form-label">Alamat</label><textarea class="form-control" name="alamat" required>{{ old('alamat', $mahasiswa->alamat) }}</textarea></div>
            </div>
            <button class="btn btn-primary mt-4"><i class="bi bi-save"></i> Simpan Profil</button>
        </form>
    </div></div>
</x-app-layout>
