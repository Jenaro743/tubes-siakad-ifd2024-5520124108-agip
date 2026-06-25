<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center gap-3 w-100">
            <h1 class="h3 mb-0">Dashboard Dosen</h1>
            <a class="btn btn-outline-primary" href="{{ route('dosen.jadwal.index') }}">Lihat Seluruh Jadwal</a>
        </div>
    </x-slot>
    <div class="row g-3 mb-4">
        <div class="col-lg-8"><div class="card border-0 shadow-sm"><div class="card-body">
            <h2 class="h5">Profil Dosen</h2>
            <dl class="row mb-0">
                <dt class="col-sm-3">NIDN</dt><dd class="col-sm-9">{{ $dosen->nidn }}</dd>
                <dt class="col-sm-3">Nama</dt><dd class="col-sm-9">{{ $dosen->nama_dosen }}</dd>
                <dt class="col-sm-3">Email</dt><dd class="col-sm-9">{{ $dosen->email }}</dd>
                <dt class="col-sm-3">No Telp</dt><dd class="col-sm-9">{{ $dosen->no_telp }}</dd>
            </dl>
        </div></div></div>
    </div>
    <div class="card border-0 shadow-sm"><div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="h5 mb-0">Jadwal Mengajar</h2>
            <a class="btn btn-sm btn-outline-secondary" href="{{ route('dosen.jadwal.index') }}">Detail Jadwal</a>
        </div>
        <div class="table-responsive"><table class="table table-hover align-middle">
            <thead><tr><th>Mata Kuliah</th><th>Hari</th><th>Jam</th><th>Kelas</th><th>Ruangan</th></tr></thead>
            <tbody>
                @forelse($jadwals as $jadwal)
                    <tr>
                        <td>{{ $jadwal->mataKuliah->nama_mk }}</td>
                        <td>{{ $jadwal->hari }}</td>
                        <td>{{ substr($jadwal->jam_mulai, 0, 5) }} - {{ substr($jadwal->jam_selesai, 0, 5) }}</td>
                        <td>{{ $jadwal->kelas }}</td>
                        <td>{{ $jadwal->ruangan }}</td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="text-center text-muted">Belum ada jadwal mengajar.</td></tr>
                @endforelse
            </tbody>
        </table></div>
    </div></div>
</x-app-layout>
