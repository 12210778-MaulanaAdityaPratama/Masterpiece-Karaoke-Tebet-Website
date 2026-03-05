@extends('layouts.admin')
@section('title', 'Tambah Paket')
@section('content')

<div class="page-header">
    <h1 class="page-title">Tambah <span>Paket</span></h1>
    <p class="page-sub">Setelah simpan, Anda bisa menambahkan tier (Bronze, Silver, Gold)</p>
</div>

<form method="POST" action="{{ route('admin.packages.store') }}" style="max-width:600px;" enctype="multipart/form-data">
    @csrf

    @if($errors->any())
        <div class="alert alert-err">
            @foreach($errors->all() as $e)<div>⚠ {{ $e }}</div>@endforeach
        </div>
    @endif

    <div class="form-panel">
        <div class="form-group">
            <label>Nama Paket *</label>
            <input type="text" name="name" value="{{ old('name') }}" required
                   placeholder="e.g. Paket Hemat, Paket Family">
        </div>

        <div class="form-group">
            <label>Deskripsi / Subtitle</label>
            <input type="text" name="description" value="{{ old('description') }}"
                   placeholder="e.g. Free Room 2 Jam">
        </div>
        {{-- Tambah field foto di dalam form-panel, setelah field description --}}
        <div class="form-group">
            <label>Foto Paket</label>
            @if(isset($package) && $package->image_url)
                <img src="{{ $package->image_url }}"
                    style="width:100%;height:180px;object-fit:cover;display:block;
                            margin-bottom:.75rem;border:1px solid var(--border);">
            @endif
            <input type="file" name="image" accept="image/*"
                style="width:100%;padding:.5rem;background:var(--bg-2);
                        border:1px solid var(--border);color:var(--text-dim);cursor:pointer;">
            @if(isset($package) && $package->image)
                <p style="font-size:.7rem;color:var(--text-muted);margin-top:.3rem;">
                    Kosongkan jika tidak ingin ganti foto.
                </p>
            @endif
        </div>

        <div class="form-row">
            <div class="form-group">
                <label>Durasi Room (jam) *</label>
                <input type="number" name="duration_hours" min="1"
                       value="{{ old('duration_hours', 2) }}" required>
            </div>
            <div class="form-group">
                <label>Urutan Tampil</label>
                <input type="number" name="sort_order" min="0"
                       value="{{ old('sort_order', 0) }}">
            </div>
        </div>

        <label class="form-check">
            <input type="checkbox" name="is_active" checked>
            Paket Aktif
        </label>
    </div>

    <div class="form-footer">
        <button type="submit" class="btn btn-primary">Simpan & Tambah Tier →</button>
        <a href="{{ route('admin.packages.index') }}" class="btn btn-outline">Batal</a>
    </div>
</form>
@endsection
