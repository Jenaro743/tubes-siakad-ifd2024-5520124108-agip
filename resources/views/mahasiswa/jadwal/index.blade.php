<x-app-layout>
    <x-slot name="header"><h1 class="h3 mb-0">Jadwal Perkuliahan</h1></x-slot>
    <form class="row g-2 mb-3" method="GET"><div class="col-md-3"><select name="hari" class="form-select"><option value="">Semua Hari</option>@foreach($hariList as $hari)<option @selected(request('hari')==$hari)>{{ $hari }}</option>@endforeach</select></div><div class="col-md-auto"><button class="btn btn-dark">Filter</button></div></form>
    <div class="card border-0 shadow-sm"><div class="table-responsive"><table class="table table-hover align-middle mb-0"><thead class="table-light"><tr><th>Mata Kuliah</th><th>Dosen</th><th>Hari</th><th>Jam</th><th>Kelas</th><th>Ruangan</th></tr></thead><tbody>
        @forelse($krs as $item)<tr><td>{{ $item->jadwal->mataKuliah->nama_mk }}</td><td>{{ $item->jadwal->dosen->nama_dosen }}</td><td>{{ $item->jadwal->hari }}</td><td>{{ substr($item->jadwal->jam_mulai,0,5) }} - {{ substr($item->jadwal->jam_selesai,0,5) }}</td><td>{{ $item->jadwal->kelas }}</td><td>{{ $item->jadwal->ruangan }}</td></tr>@empty<tr><td colspan="6" class="text-center text-muted">Belum ada jadwal KRS.</td></tr>@endforelse
    </tbody></table></div></div>
</x-app-layout>
