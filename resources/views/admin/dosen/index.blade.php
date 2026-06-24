<x-app-layout>
    <x-slot name="header"><h1 class="h3 mb-0">Data Dosen</h1><div><a class="btn btn-outline-success" href="{{ route('admin.dosen.export') }}"><i class="bi bi-file-earmark-spreadsheet"></i> Export</a> <a class="btn btn-primary" href="{{ route('admin.dosen.create') }}"><i class="bi bi-plus-circle"></i> Tambah</a></div></x-slot>
    <x-partials.search />
    <div class="card border-0 shadow-sm"><div class="table-responsive"><table class="table table-hover align-middle mb-0">
        <thead class="table-light"><tr><th>NIDN</th><th>Nama</th><th>Email</th><th>No Telp</th><th width="130">Aksi</th></tr></thead>
        <tbody>@forelse($dosens as $dosen)<tr><td>{{ $dosen->nidn }}</td><td>{{ $dosen->nama_dosen }}</td><td>{{ $dosen->email }}</td><td>{{ $dosen->no_telp }}</td><td>@include('partials.actions', ['show'=>route('admin.dosen.show',$dosen), 'edit'=>route('admin.dosen.edit',$dosen), 'delete'=>route('admin.dosen.destroy',$dosen)])</td></tr>@empty<tr><td colspan="5" class="text-center text-muted">Data kosong.</td></tr>@endforelse</tbody>
    </table></div></div><div class="mt-3">{{ $dosens->links() }}</div>
</x-app-layout>
