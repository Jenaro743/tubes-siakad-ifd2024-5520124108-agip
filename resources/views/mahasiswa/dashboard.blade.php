<x-app-layout>
    <x-slot name="header"><h1 class="h3 mb-0">Dashboard Mahasiswa</h1></x-slot>
    <div class="row g-3 mb-4">
        <div class="col-lg-8"><div class="card border-0 shadow-sm"><div class="card-body">
            <h2 class="h5">Profil Mahasiswa</h2>
            <dl class="row mb-0">
                <dt class="col-sm-3">NPM</dt><dd class="col-sm-9">{{ $mahasiswa->npm }}</dd>
                <dt class="col-sm-3">Nama</dt><dd class="col-sm-9">{{ $mahasiswa->nama_mahasiswa }}</dd>
                <dt class="col-sm-3">Jurusan</dt><dd class="col-sm-9">{{ $mahasiswa->jurusan }}</dd>
                <dt class="col-sm-3">Semester</dt><dd class="col-sm-9">{{ $mahasiswa->semester }}</dd>
            </dl>
        </div></div></div>
        <div class="col-lg-4"><div class="card stat-card"><div class="card-body">
            <div class="text-muted">Total SKS Diambil</div><div class="display-4 fw-semibold">{{ $totalSks }}</div>
        </div></div></div>
    </div>
    <div class="card border-0 shadow-sm"><div class="card-body">
        <h2 class="h5">Jadwal Hari Ini</h2>
        <div class="table-responsive"><table class="table table-striped">
            <thead><tr><th>Mata Kuliah</th><th>Dosen</th><th>Jam</th><th>Ruang</th></tr></thead>
            <tbody>
                @forelse($jadwalHariIni as $item)
                    <tr><td>{{ $item->jadwal->mataKuliah->nama_mk }}</td><td>{{ $item->jadwal->dosen->nama_dosen }}</td><td>{{ substr($item->jadwal->jam_mulai,0,5) }} - {{ substr($item->jadwal->jam_selesai,0,5) }}</td><td>{{ $item->jadwal->ruangan }}</td></tr>
                @empty
                    <tr><td colspan="4" class="text-center text-muted">Tidak ada jadwal hari ini.</td></tr>
                @endforelse
            </tbody>
        </table></div>
    </div></div>
</x-app-layout>
