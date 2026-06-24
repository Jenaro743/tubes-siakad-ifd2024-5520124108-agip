<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'SIAKAD') }}</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    </head>
    <body class="bg-light">
        <div class="container min-vh-100 d-flex align-items-center justify-content-center py-5">
            <div class="card border-0 shadow-sm" style="max-width: 430px; width: 100%;">
                <div class="card-body p-4">
                    <div class="text-center mb-4">
                        <div class="display-5 text-primary"><i class="bi bi-mortarboard"></i></div>
                        <h1 class="h4 mb-1">SIAKAD</h1>
                        <p class="text-muted mb-0">Sistem Informasi Akademik</p>
                    </div>
                {{ $slot }}
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
