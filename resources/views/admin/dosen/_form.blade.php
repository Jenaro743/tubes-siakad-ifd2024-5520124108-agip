@csrf
<div class="row g-3">
    <div class="col-md-6"><label class="form-label">NIDN</label><input class="form-control @error('nidn') is-invalid @enderror" name="nidn" value="{{ old('nidn', $dosen->nidn) }}" required>@error('nidn')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
    <div class="col-md-6"><label class="form-label">Nama Dosen</label><input class="form-control @error('nama_dosen') is-invalid @enderror" name="nama_dosen" value="{{ old('nama_dosen', $dosen->nama_dosen) }}" required>@error('nama_dosen')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
    <div class="col-md-6"><label class="form-label">Email</label><input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $dosen->email) }}" required>@error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
    <div class="col-md-6"><label class="form-label">No Telp</label><input class="form-control @error('no_telp') is-invalid @enderror" name="no_telp" value="{{ old('no_telp', $dosen->no_telp) }}" required>@error('no_telp')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
    <div class="col-12"><label class="form-label">Alamat</label><textarea class="form-control @error('alamat') is-invalid @enderror" name="alamat" required>{{ old('alamat', $dosen->alamat) }}</textarea>@error('alamat')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
</div>
<div class="mt-4 d-flex gap-2"><button class="btn btn-primary"><i class="bi bi-save"></i> Simpan</button><a class="btn btn-outline-secondary" href="{{ route('admin.dosen.index') }}">Batal</a></div>
