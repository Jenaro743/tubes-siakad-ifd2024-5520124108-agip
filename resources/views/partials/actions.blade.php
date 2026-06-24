<div class="d-flex gap-1">
    <a class="btn btn-sm btn-outline-info" href="{{ $show }}"><i class="bi bi-eye"></i></a>
    <a class="btn btn-sm btn-outline-warning" href="{{ $edit }}"><i class="bi bi-pencil"></i></a>
    <form method="POST" action="{{ $delete }}" onsubmit="return confirm('Hapus data ini?')">
        @csrf @method('DELETE')
        <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
    </form>
</div>
