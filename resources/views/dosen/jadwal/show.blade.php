<x-app-layout>
    <x-slot name="header"><h1 class="h3 mb-0">Detail Jadwal Mengajar</h1><a class="btn btn-outline-secondary" href="{{ route('dosen.jadwal.index') }}">Kembali</a></x-slot>
    <div class="card border-0 shadow-sm"><div class="card-body">
        <h2 class="h5">{{ $jadwal->mataKuliah->nama_mk }}</h2>
        <p><strong>Hari:</strong> {{ $jadwal->hari }}</p>
        <p><strong>Jam:</strong> {{ substr($jadwal->jam_mulai,0,5) }} - {{ substr($jadwal->jam_selesai,0,5) }}</p>
        <p><strong>Kelas:</strong> {{ $jadwal->kelas }}</p>
        <p><strong>Ruangan:</strong> {{ $jadwal->ruangan }}</p>
        <p><strong>Mahasiswa Terdaftar:</strong></p>
        <ul class="list-group">
            @forelse($jadwal->krs as $item)
                <li class="list-group-item">{{ $item->mahasiswa->npm }} - {{ $item->mahasiswa->nama_mahasiswa }}</li>
            @empty
                <li class="list-group-item text-muted">Belum ada mahasiswa yang mengambil.</li>
            @endforelse
        </ul>
    </div></div>
</x-app-layout>
