<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'SIAKAD') }}</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
        <style>
            body { background: #f6f8fb; }
            .sidebar { min-height: calc(100vh - 56px); background: #172033; }
            .sidebar a { color: #dbe4f3; text-decoration: none; border-radius: .5rem; display: block; padding: .65rem .85rem; }
            .sidebar a.active, .sidebar a:hover { background: #24324e; color: #fff; }
            .stat-card { border: 0; box-shadow: 0 10px 24px rgba(23, 32, 51, .08); }
            @media print { .no-print { display: none !important; } body { background: #fff; } }
        </style>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top no-print">
            <div class="container-fluid">
                <a class="navbar-brand fw-semibold" href="{{ route('dashboard') }}"><i class="bi bi-mortarboard"></i> SIAKAD</a>
                <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#topnav"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="topnav">
                    <div class="navbar-nav ms-auto align-items-lg-center gap-2">
                        <span class="navbar-text small">{{ auth()->user()->name ?? 'Guest' }}</span>
                        @auth
                            <form method="POST" action="{{ route('logout') }}">@csrf <button class="btn btn-outline-light btn-sm"><i class="bi bi-box-arrow-right"></i> Logout</button></form>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>
        <div class="container-fluid">
            <div class="row">
                @auth
                    <aside class="col-lg-2 sidebar p-3 no-print">
                        <div class="d-grid gap-1">
                            <a class="{{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}"><i class="bi bi-speedometer2"></i> Dashboard</a>
                            @if(auth()->user()->role === 'admin')
                                <a class="{{ request()->routeIs('admin.dosen.*') ? 'active' : '' }}" href="{{ route('admin.dosen.index') }}"><i class="bi bi-person-workspace"></i> Dosen</a>
                                <a class="{{ request()->routeIs('admin.mahasiswa.*') ? 'active' : '' }}" href="{{ route('admin.mahasiswa.index') }}"><i class="bi bi-people"></i> Mahasiswa</a>
                                <a class="{{ request()->routeIs('admin.mata-kuliah.*') ? 'active' : '' }}" href="{{ route('admin.mata-kuliah.index') }}"><i class="bi bi-journal-bookmark"></i> Mata Kuliah</a>
                                <a class="{{ request()->routeIs('admin.jadwal.*') ? 'active' : '' }}" href="{{ route('admin.jadwal.index') }}"><i class="bi bi-calendar-week"></i> Jadwal</a>
                            @elseif(auth()->user()->role === 'dosen')
                                {{-- <a class="{{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}"><i class="bi bi-speedometer2"></i> Dashboard</a> --}}
                                <a class="{{ request()->routeIs('dosen.jadwal.*') ? 'active' : '' }}" href="{{ route('dosen.jadwal.index') }}"><i class="bi bi-calendar3"></i> Jadwal Mengajar</a>
                            @else
                                <a class="{{ request()->routeIs('mahasiswa.krs.*') ? 'active' : '' }}" href="{{ route('mahasiswa.krs.index') }}"><i class="bi bi-card-checklist"></i> KRS Diambil <span class="badge bg-white text-dark ms-2">{{ auth()->user()->mahasiswa?->krs()->count() ?? 0 }}</span></a>
                                <a class="{{ request()->routeIs('mahasiswa.jadwal.*') ? 'active' : '' }}" href="{{ route('mahasiswa.jadwal.index') }}"><i class="bi bi-calendar3"></i> Jadwal</a>
                                <a class="{{ request()->routeIs('mahasiswa.profile.*') ? 'active' : '' }}" href="{{ route('mahasiswa.profile.edit') }}"><i class="bi bi-person-circle"></i> Profil</a>
                            @endif
                        </div>
                    </aside>
                @endauth
                <main class="{{ auth()->check() ? 'col-lg-10' : 'col-12' }} p-4">
                    @isset($header)<div class="d-flex justify-content-between align-items-center mb-4">{{ $header }}</div>@endisset
                    @if ($errors->any())
                        <div class="alert alert-danger"><strong>Validasi gagal.</strong> Periksa kembali isian form.</div>
                    @endif
                    {{ $slot }}
                </main>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        @if(session('success'))
            <script>Swal.fire({icon:'success', title:'Berhasil', text:@json(session('success')), timer:2200, showConfirmButton:false});</script>
        @endif
        @if(session('error'))
            <script>Swal.fire({icon:'error', title:'Gagal', text:@json(session('error'))});</script>
        @endif
        @stack('scripts')
    </body>
</html>
