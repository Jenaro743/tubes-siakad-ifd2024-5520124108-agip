@csrf
<div class="row g-3">
    <div class="col-md-6"><label class="form-label">Nama User</label><input class="form-control" name="name" value="{{ old('name', $mahasiswa->user->name ?? $mahasiswa->nama_mahasiswa) }}" required></div>
    <div class="col-md-6"><label class="form-label">Email Login</label><input type="email" class="form-control" name="email" value="{{ old('email', $mahasiswa->user->email ?? '') }}" required></div>
    <div class="col-md-6"><label class="form-label">Password {{ $mahasiswa->exists ? '(kosongkan jika tetap)' : '' }}</label><input type="password" class="form-control" name="password" {{ $mahasiswa->exists ? '' : 'required' }}></div>
    <div class="col-md-6"><label class="form-label">NPM</label><input class="form-control" name="npm" value="{{ old('npm', $mahasiswa->npm) }}" required></div>
    <div class="col-md-6"><label class="form-label">Nama Mahasiswa</label><input class="form-control" name="nama_mahasiswa" value="{{ old('nama_mahasiswa', $mahasiswa->nama_mahasiswa) }}" required></div>
    <div class="col-md-6"><label class="form-label">Jurusan</label><input class="form-control" name="jurusan" value="{{ old('jurusan', $mahasiswa->jurusan) }}" required></div>
    <div class="col-md-3"><label class="form-label">Semester</label><input type="number" class="form-control" name="semester" value="{{ old('semester', $mahasiswa->semester) }}" required></div>
    <div class="col-md-5"><label class="form-label">No Telp</label><input class="form-control" name="no_telp" value="{{ old('no_telp', $mahasiswa->no_telp) }}" required></div>
    <div class="col-md-4"><label class="form-label">Foto</label><input type="file" class="form-control" name="foto" accept="image/*"></div>
    <div class="col-12"><label class="form-label">Alamat</label><textarea class="form-control" name="alamat" required>{{ old('alamat', $mahasiswa->alamat) }}</textarea></div>
</div>
<div class="mt-4 d-flex gap-2"><button class="btn btn-primary"><i class="bi bi-save"></i> Simpan</button><a class="btn btn-outline-secondary" href="{{ route('admin.mahasiswa.index') }}">Batal</a></div>
