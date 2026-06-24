<x-app-layout>
    <x-slot name="header"><h1 class="h3 mb-0">Dashboard Admin</h1></x-slot>
    <div class="row g-3 mb-4">
        @foreach($stats as $label => $value)
            <div class="col-sm-6 col-xl">
                <div class="card stat-card"><div class="card-body">
                    <div class="text-muted small">{{ $label }}</div>
                    <div class="display-6 fw-semibold">{{ $value }}</div>
                </div></div>
            </div>
        @endforeach
    </div>
    <div class="card border-0 shadow-sm"><div class="card-body">
        <h2 class="h5">Grafik Jumlah Jadwal per Mata Kuliah</h2>
        <canvas id="statsChart" height="90"></canvas>
    </div></div>
    @push('scripts')
        <script>
            new Chart(document.getElementById('statsChart'), {
                type: 'bar',
                data: { labels: @json($chartLabels), datasets: [{ label: 'Jumlah Jadwal', data: @json($chartData), backgroundColor: '#2f80ed' }] },
                options: { responsive: true, scales: { y: { beginAtZero: true, ticks: { precision: 0 } } } }
            });
        </script>
    @endpush
</x-app-layout>
