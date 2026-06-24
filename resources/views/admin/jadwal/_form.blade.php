@csrf
<div class="row g-3">
    <div class="col-md-6"><label class="form-label">Mata Kuliah</label><select class="form-select" name="mata_kuliah_id" required><option value="">Pilih</option>@foreach($mataKuliahs as $mk)<option value="{{ $mk->id }}" @selected(old('mata_kuliah_id', $jadwal->mata_kuliah_id)==$mk->id)>{{ $mk->kode_mk }} - {{ $mk->nama_mk }}</option>@endforeach</select></div>
    <div class="col-md-6"><label class="form-label">Dosen</label><select class="form-select" name="dosen_id" required><option value="">Pilih</option>@foreach($dosens as $dosen)<option value="{{ $dosen->id }}" @selected(old('dosen_id', $jadwal->dosen_id)==$dosen->id)>{{ $dosen->nama_dosen }}</option>@endforeach</select></div>
    <div class="col-md-3"><label class="form-label">Hari</label><select class="form-select" name="hari" required>@foreach($hariList as $hari)<option value="{{ $hari }}" @selected(old('hari', $jadwal->hari)==$hari)>{{ $hari }}</option>@endforeach</select></div>
    <div class="col-md-3"><label class="form-label">Jam Mulai</label><input type="time" class="form-control" name="jam_mulai" value="{{ old('jam_mulai', substr($jadwal->jam_mulai ?? '',0,5)) }}" required></div>
    <div class="col-md-3"><label class="form-label">Jam Selesai</label><input type="time" class="form-control" name="jam_selesai" value="{{ old('jam_selesai', substr($jadwal->jam_selesai ?? '',0,5)) }}" required></div>
    <div class="col-md-3"><label class="form-label">Kelas</label><input class="form-control" name="kelas" value="{{ old('kelas', $jadwal->kelas) }}" required></div>
    <div class="col-md-4"><label class="form-label">Ruangan</label><input class="form-control" name="ruangan" value="{{ old('ruangan', $jadwal->ruangan) }}" required></div>
</div>
<div class="mt-4 d-flex gap-2"><button class="btn btn-primary"><i class="bi bi-save"></i> Simpan</button><a class="btn btn-outline-secondary" href="{{ route('admin.jadwal.index') }}">Batal</a></div>
