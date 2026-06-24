<x-app-layout>
    <x-slot name="header"><h1 class="h3 mb-0">Data Mata Kuliah</h1><div><a class="btn btn-outline-success" href="{{ route('admin.mata-kuliah.export') }}">Export</a> <a class="btn btn-primary" href="{{ route('admin.mata-kuliah.create') }}">Tambah</a></div></x-slot>
    <x-partials.search><div class="col-md-2"><input type="number" class="form-control" name="semester" value="{{ request('semester') }}" placeholder="Semester"></div></x-partials.search>
    <div class="card border-0 shadow-sm"><div class="table-responsive"><table class="table table-hover align-middle mb-0"><thead class="table-light"><tr><th>Kode</th><th>Nama</th><th>SKS</th><th>Semester</th><th width="130">Aksi</th></tr></thead><tbody>
        @forelse($mataKuliahs as $mk)<tr><td>{{ $mk->kode_mk }}</td><td>{{ $mk->nama_mk }}</td><td>{{ $mk->sks }}</td><td>{{ $mk->semester }}</td><td>@include('partials.actions', ['show'=>route('admin.mata-kuliah.show',$mk), 'edit'=>route('admin.mata-kuliah.edit',$mk), 'delete'=>route('admin.mata-kuliah.destroy',$mk)])</td></tr>@empty<tr><td colspan="5" class="text-center text-muted">Data kosong.</td></tr>@endforelse
    </tbody></table></div></div><div class="mt-3">{{ $mataKuliahs->links() }}</div>
</x-app-layout>
