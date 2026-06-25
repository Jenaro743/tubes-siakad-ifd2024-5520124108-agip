<x-app-layout>
    <x-slot name="header"><h1 class="h3 mb-0">Jadwal Mengajar</h1></x-slot>
    <div class="card border-0 shadow-sm"><div class="card-body">
        <div class="table-responsive"><table class="table table-hover align-middle mb-0">
            <thead class="table-light"><tr><th>Mata Kuliah</th><th>Hari</th><th>Jam</th><th>Kelas</th><th>Ruangan</th><th></th></tr></thead>
            <tbody>
                @forelse($jadwals as $jadwal)
                    <tr>
                        <td>{{ $jadwal->mataKuliah->nama_mk }}</td>
                        <td>{{ $jadwal->hari }}</td>
                        <td>{{ substr($jadwal->jam_mulai,0,5) }} - {{ substr($jadwal->jam_selesai,0,5) }}</td>
                        <td>{{ $jadwal->kelas }}</td>
                        <td>{{ $jadwal->ruangan }}</td>
                        <td><a class="btn btn-sm btn-outline-primary" href="{{ route('dosen.jadwal.show', $jadwal) }}">Detail</a></td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="text-center text-muted">Belum ada jadwal mengajar.</td></tr>
                @endforelse
            </tbody>
        </table></div>
        <div class="mt-3">{{ $jadwals->links() }}</div>
    </div></div>
</x-app-layout>
