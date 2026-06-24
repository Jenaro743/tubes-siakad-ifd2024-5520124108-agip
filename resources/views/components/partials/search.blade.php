<form class="row g-2 mb-3" method="GET">
    <div class="col-md-5"><input class="form-control" name="search" value="{{ request('search') }}" placeholder="Cari data..."></div>
    {{ $slot ?? '' }}
    <div class="col-md-auto"><button class="btn btn-dark"><i class="bi bi-search"></i> Cari</button></div>
    <div class="col-md-auto"><a class="btn btn-outline-secondary" href="{{ url()->current() }}">Reset</a></div>
</form>
