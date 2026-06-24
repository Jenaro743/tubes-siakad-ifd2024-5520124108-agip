<x-app-layout>
    <x-slot name="header"><h1 class="h3 mb-0">Data Mahasiswa</h1><div><a class="btn btn-outline-success" href="{{ route('admin.mahasiswa.export') }}">Export</a> <a class="btn btn-primary" href="{{ route('admin.mahasiswa.create') }}">Tambah</a></div></x-slot>
    <x-partials.search><div class="col-md-2"><input type="number" class="form-control" name="semester" value="{{ request('semester') }}" placeholder="Semester"></div></x-partials.search>
    <div class="card border-0 shadow-sm"><div class="table-responsive"><table class="table table-hover align-middle mb-0"><thead class="table-light"><tr><th>NPM</th><th>Nama</th><th>Jurusan</th><th>Semester</th><th>Email</th><th width="130">Aksi</th></tr></thead><tbody>
        @forelse($mahasiswas as $m)<tr><td>{{ $m->npm }}</td><td>{{ $m->nama_mahasiswa }}</td><td>{{ $m->jurusan }}</td><td>{{ $m->semester }}</td><td>{{ $m->user->email }}</td><td>@include('partials.actions', ['show'=>route('admin.mahasiswa.show',$m), 'edit'=>route('admin.mahasiswa.edit',$m), 'delete'=>route('admin.mahasiswa.destroy',$m)])</td></tr>@empty<tr><td colspan="6" class="text-center text-muted">Data kosong.</td></tr>@endforelse
    </tbody></table></div></div><div class="mt-3">{{ $mahasiswas->links() }}</div>
</x-app-layout>
