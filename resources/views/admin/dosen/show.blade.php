<x-app-layout>
    <x-slot name="header"><h1 class="h3 mb-0">Detail Dosen</h1><a class="btn btn-outline-secondary" href="{{ route('admin.dosen.index') }}">Kembali</a></x-slot>
    <div class="card border-0 shadow-sm"><div class="card-body">
        <h2 class="h5">{{ $dosen->nama_dosen }}</h2>
        <p class="mb-1"><strong>NIDN:</strong> {{ $dosen->nidn }}</p><p class="mb-1"><strong>Email:</strong> {{ $dosen->email }}</p><p class="mb-1"><strong>No Telp:</strong> {{ $dosen->no_telp }}</p><p><strong>Alamat:</strong> {{ $dosen->alamat }}</p>
        <h3 class="h6 mt-4">Jadwal Mengajar</h3>
        <ul class="list-group">@forelse($dosen->jadwals as $jadwal)<li class="list-group-item">{{ $jadwal->mataKuliah->nama_mk }} - {{ $jadwal->hari }} {{ substr($jadwal->jam_mulai,0,5) }}</li>@empty<li class="list-group-item text-muted">Belum ada jadwal.</li>@endforelse</ul>
    </div></div>
</x-app-layout>
