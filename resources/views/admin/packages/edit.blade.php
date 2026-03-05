@extends('layouts.admin')
@section('title', 'Edit Paket — '.$package->name)
@section('content')

<div class="page-header flex-between">
    <div>
        <h1 class="page-title">{{ $package->name }} <span style="color:var(--text-dim);font-size:1.2rem;">— Kelola Tier</span></h1>
        <p class="page-sub">{{ $package->description }} · {{ $package->duration_hours }} jam</p>
    </div>
    <div class="actions">
        <a href="{{ route('admin.packages.tiers.create', $package) }}" class="btn btn-primary">+ Tambah Tier</a>
        <a href="{{ route('admin.packages.index') }}" class="btn btn-outline">← Kembali</a>
    </div>
</div>

{{-- Edit info paket --}}
<div style="margin-bottom:1.5rem;">
    <details>
        <summary style="cursor:pointer;font-size:.72rem;letter-spacing:.2em;text-transform:uppercase;color:var(--text-dim);padding:.6rem 0;user-select:none;">
            ✎ &ensp;Edit Info Paket
        </summary>
        <div class="form-panel" style="margin-top:.75rem;max-width:600px;">
            <form method="POST" action="{{ route('admin.packages.update', $package) }}" enctype="multipart/form-data">
                @csrf @method('PUT')
                @if($errors->any())
                    <div class="alert alert-err" style="margin-bottom:1rem;">
                        @foreach($errors->all() as $e)<div>⚠ {{ $e }}</div>@endforeach
                    </div>
                @endif
                <div class="form-group">
                    <label>Nama Paket</label>
                    <input type="text" name="name" value="{{ old('name', $package->name) }}" required>
                </div>
                <div class="form-group">
                    <label>Deskripsi / Subtitle</label>
                    <input type="text" name="description" value="{{ old('description', $package->description) }}">
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
                        <label>Durasi (jam)</label>
                        <input type="number" name="duration_hours" min="1"
                               value="{{ old('duration_hours', $package->duration_hours) }}" required>
                    </div>
                    <div class="form-group">
                        <label>Urutan</label>
                        <input type="number" name="sort_order" min="0"
                               value="{{ old('sort_order', $package->sort_order) }}">
                    </div>
                </div>
                <div style="display:flex;align-items:center;justify-content:space-between;margin-top:.5rem;">
                    <label class="form-check">
                        <input type="checkbox" name="is_active" {{ $package->is_active ? 'checked' : '' }}>
                        Paket Aktif
                    </label>
                    <button type="submit" class="btn btn-outline btn-sm">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </details>
</div>

{{-- Tier list --}}
@if($package->tiers->isEmpty())
    <div style="text-align:center;padding:3rem 2rem;border:1px dashed rgba(155,48,255,0.2);color:var(--text-dim);">
        <p style="font-family:var(--ff-display);font-size:1.5rem;margin-bottom:.75rem;color:var(--text);">Belum ada tier</p>
        <p style="font-size:.82rem;margin-bottom:1.5rem;">Tambahkan tier Bronze, Silver, Gold, dsb untuk paket ini.</p>
        <a href="{{ route('admin.packages.tiers.create', $package) }}" class="btn btn-primary">
            + Tambah Tier Pertama
        </a>
    </div>
@else
    <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(300px,1fr));gap:1.25rem;">
        @foreach($package->tiers as $tier)
        <div style="background:var(--bg-card);border:1px solid var(--border);overflow:hidden;">

            {{-- Tier header --}}
            <div style="padding:1.25rem 1.5rem;border-bottom:1px solid var(--border);
                        background:{{ $tier->color }}12;
                        border-top:3px solid {{ $tier->color }};">
                <div style="display:flex;align-items:center;justify-content:space-between;">
                    <div style="display:flex;align-items:center;gap:.75rem;">
                        <span style="font-family:var(--ff-display);font-size:1.5rem;
                                     letter-spacing:.08em;color:{{ $tier->color }};">
                            {{ $tier->name }}
                        </span>
                        @if($tier->badge)
                            <span class="pill pill-pink" style="font-size:.55rem;">{{ $tier->badge }}</span>
                        @endif
                    </div>
                    @if(!$tier->is_available)
                        <span class="pill pill-red">Nonaktif</span>
                    @endif
                </div>
                <div style="font-family:var(--ff-display);font-size:1.6rem;
                             letter-spacing:.04em;color:var(--text);margin-top:.3rem;">
                    {{ $tier->formatted_price }}
                </div>
            </div>

            {{-- Includes list --}}
            <div style="padding:1rem 1.5rem;">
                @if($tier->includes->isEmpty())
                    <p style="font-size:.78rem;color:var(--text-muted);font-style:italic;">Belum ada item</p>
                @else
                    @foreach($tier->includes as $inc)
                    <div style="display:flex;justify-content:space-between;
                                padding:.4rem 0;border-bottom:1px solid rgba(255,255,255,.04);
                                font-size:.82rem;">
                        <span style="color:var(--text);">
                            <span style="color:{{ $tier->color }};margin-right:.35rem;">✓</span>
                            {{ $inc->item_name }}
                        </span>
                        <span style="color:var(--text-dim);font-style:italic;">{{ $inc->quantity }}</span>
                    </div>
                    @endforeach
                @endif
            </div>

            {{-- Actions --}}
            <div style="padding:.85rem 1.5rem;border-top:1px solid rgba(255,255,255,.04);
                        display:flex;gap:.5rem;">
                <a href="{{ route('admin.packages.tiers.edit', [$package, $tier]) }}"
                   class="btn btn-outline btn-sm" style="flex:1;text-align:center;">Edit</a>
                <form method="POST"
                      action="{{ route('admin.packages.tiers.destroy', [$package, $tier]) }}"
                      onsubmit="return confirm('Hapus tier {{ $tier->name }}?')">
                    @csrf @method('DELETE')
                    <button class="btn btn-danger">Hapus</button>
                </form>
            </div>

        </div>
        @endforeach
    </div>
@endif

@endsection
