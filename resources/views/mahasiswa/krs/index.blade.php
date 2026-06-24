<x-app-layout>
    <x-slot name="header"><h1 class="h3 mb-0">Kartu Rencana Studi</h1><a class="btn btn-outline-primary" href="{{ route('mahasiswa.krs.print') }}"><i class="bi bi-printer"></i> Cetak / PDF</a></x-slot>
    <div class="row g-3 mb-4">
        <div class="col-lg-8"><div class="card border-0 shadow-sm"><div class="card-body">
            <h2 class="h5">KRS Dipilih</h2>
            <div class="table-responsive"><table class="table align-middle">
                <thead><tr><th>Kode</th><th>Mata Kuliah</th><th>SKS</th><th>Jadwal</th><th></th></tr></thead>
                <tbody>@forelse($krs as $item)<tr><td>{{ $item->jadwal->mataKuliah->kode_mk }}</td><td>{{ $item->jadwal->mataKuliah->nama_mk }}</td><td>{{ $item->jadwal->mataKuliah->sks }}</td><td>{{ $item->jadwal->hari }} {{ substr($item->jadwal->jam_mulai,0,5) }}</td><td><form method="POST" action="{{ route('mahasiswa.krs.destroy', $item) }}">@csrf @method('DELETE')<button class="btn btn-sm btn-outline-danger">Hapus</button></form></td></tr>@empty<tr><td colspan="5" class="text-center text-muted">Belum ada mata kuliah.</td></tr>@endforelse</tbody>
            </table></div>
        </div></div></div>
        <div class="col-lg-4"><div class="card stat-card"><div class="card-body"><div class="text-muted">Total SKS</div><div class="display-5 fw-semibold">{{ $totalSks }}</div></div></div></div>
    </div>
    <div class="card border-0 shadow-sm"><div class="card-body">
        <h2 class="h5">Mata Kuliah Tersedia</h2>
        <x-partials.search />
        <div class="table-responsive"><table class="table table-hover align-middle"><thead><tr><th>Mata Kuliah</th><th>Dosen</th><th>Hari/Jam</th><th>Kelas</th><th></th></tr></thead><tbody>
            @forelse($jadwals as $jadwal)<tr><td>{{ $jadwal->mataKuliah->kode_mk }} - {{ $jadwal->mataKuliah->nama_mk }} <span class="badge bg-secondary">{{ $jadwal->mataKuliah->sks }} SKS</span></td><td>{{ $jadwal->dosen->nama_dosen }}</td><td>{{ $jadwal->hari }} {{ substr($jadwal->jam_mulai,0,5) }} - {{ substr($jadwal->jam_selesai,0,5) }}</td><td>{{ $jadwal->kelas }}</td><td><form method="POST" action="{{ route('mahasiswa.krs.store') }}">@csrf<input type="hidden" name="jadwal_id" value="{{ $jadwal->id }}"><button class="btn btn-sm btn-primary">Ambil</button></form></td></tr>@empty<tr><td colspan="5" class="text-center text-muted">Tidak ada jadwal tersedia.</td></tr>@endforelse
        </tbody></table></div>{{ $jadwals->links() }}
    </div></div>
</x-app-layout>
