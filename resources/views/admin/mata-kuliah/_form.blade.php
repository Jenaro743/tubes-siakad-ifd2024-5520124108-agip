@csrf
<div class="row g-3">
    <div class="col-md-6"><label class="form-label">Kode MK</label><input class="form-control @error('kode_mk') is-invalid @enderror" name="kode_mk" value="{{ old('kode_mk', $mataKuliah->kode_mk) }}" required>@error('kode_mk')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
    <div class="col-md-6"><label class="form-label">Nama MK</label><input class="form-control @error('nama_mk') is-invalid @enderror" name="nama_mk" value="{{ old('nama_mk', $mataKuliah->nama_mk) }}" required>@error('nama_mk')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
    <div class="col-md-3"><label class="form-label">SKS</label><input type="number" class="form-control @error('sks') is-invalid @enderror" name="sks" value="{{ old('sks', $mataKuliah->sks) }}" required>@error('sks')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
    <div class="col-md-3"><label class="form-label">Semester</label><input type="number" class="form-control @error('semester') is-invalid @enderror" name="semester" value="{{ old('semester', $mataKuliah->semester) }}" required>@error('semester')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
</div>
<div class="mt-4 d-flex gap-2"><button class="btn btn-primary"><i class="bi bi-save"></i> Simpan</button><a class="btn btn-outline-secondary" href="{{ route('admin.mata-kuliah.index') }}">Batal</a></div>
