<x-app-layout>
    <x-slot name="header"><h1 class="h3 mb-0">Detail Mahasiswa</h1><a class="btn btn-outline-secondary" href="{{ route('admin.mahasiswa.index') }}">Kembali</a></x-slot>
    <div class="row g-3"><div class="col-lg-4"><div class="card border-0 shadow-sm"><div class="card-body text-center">
        @if($mahasiswa->foto)<img class="rounded-circle mb-3" width="120" height="120" src="{{ asset('storage/'.$mahasiswa->foto) }}">@endif
        <h2 class="h5">{{ $mahasiswa->nama_mahasiswa }}</h2><p class="text-muted">{{ $mahasiswa->npm }}</p>
    </div></div></div><div class="col-lg-8"><div class="card border-0 shadow-sm"><div class="card-body">
        <p><strong>Email:</strong> {{ $mahasiswa->user->email }}</p><p><strong>Jurusan:</strong> {{ $mahasiswa->jurusan }}</p><p><strong>Semester:</strong> {{ $mahasiswa->semester }}</p><p><strong>No Telp:</strong> {{ $mahasiswa->no_telp }}</p><p><strong>Alamat:</strong> {{ $mahasiswa->alamat }}</p>
        <h3 class="h6">KRS</h3><ul class="list-group">@forelse($mahasiswa->krs as $item)<li class="list-group-item">{{ $item->jadwal->mataKuliah->nama_mk }} ({{ $item->jadwal->mataKuliah->sks }} SKS)</li>@empty<li class="list-group-item text-muted">Belum mengambil KRS.</li>@endforelse</ul>
    </div></div></div></div>
</x-app-layout>
