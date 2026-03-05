@extends('layouts.admin')
@section('title', 'Kategori F&B')
@section('content')
<div class="page-header">
    <h1 class="page-title">Kategori <span>F&amp;B</span></h1>
    <p class="page-sub">Kelola kategori menu makanan dan minuman</p>
</div>

<div style="display:grid;grid-template-columns:1fr 380px;gap:1.5rem;align-items:start;">
    {{-- List --}}
    <div class="panel">
        <table>
            <thead><tr><th>Ikon</th><th>Nama Kategori</th><th>Jumlah Item</th><th>Status</th><th>Aksi</th></tr></thead>
            <tbody>
                @forelse($categories as $cat)
                <tr>
                    <td style="font-size:1.3rem;">{{ $cat->icon }}</td>
                    <td style="color:var(--text);">{{ $cat->name }}</td>
                    <td><span class="pill pill-purp">{{ $cat->items_count }} item</span></td>
                    <td>
                        @if($cat->is_active)<span class="pill pill-green">Aktif</span>
                        @else<span class="pill pill-red">Nonaktif</span>@endif
                    </td>
                    <td>
                        <form method="POST" action="{{ route('admin.fnb.categories.destroy',$cat) }}" onsubmit="return confirm('Hapus kategori ini?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" style="text-align:center;padding:2rem;color:var(--text-dim);">Belum ada kategori.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Add form --}}
    <div class="form-panel">
        <p style="font-size:.62rem;letter-spacing:.25em;text-transform:uppercase;color:var(--text-muted);margin-bottom:1.25rem;">Tambah Kategori Baru</p>
        @if(session('success'))
            <div class="alert" style="margin-bottom:1rem;">✓ {{ session('success') }}</div>
        @endif
        <form method="POST" action="{{ route('admin.fnb.categories.store') }}">
            @csrf
            @if($errors->any())
                <div class="alert alert-err" style="margin-bottom:1rem;">@foreach($errors->all() as $e)<div>⚠ {{ $e }}</div>@endforeach</div>
            @endif
            <div class="form-group">
                <label>Nama Kategori *</label>
                <input type="text" name="name" value="{{ old('name') }}" required placeholder="e.g. Minuman, Makanan Berat">
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Ikon (emoji)</label>
                    <input type="text" name="icon" value="{{ old('icon') }}" placeholder="🍱" maxlength="10">
                </div>
                <div class="form-group">
                    <label>Urutan</label>
                    <input type="number" name="sort_order" min="0" value="{{ old('sort_order',0) }}">
                </div>
            </div>
            <label class="form-check" style="margin-bottom:1.25rem;">
                <input type="checkbox" name="is_active" {{ old('is_active',true)?'checked':'' }}>
                Aktifkan kategori
            </label>
            <button type="submit" class="btn btn-primary" style="width:100%;">Tambah Kategori</button>
        </form>
    </div>
</div>
@endsection
