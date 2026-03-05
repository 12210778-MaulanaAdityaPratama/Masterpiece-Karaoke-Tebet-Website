@extends('layouts.admin')
@section('title', isset($tier) ? 'Edit Tier' : 'Tambah Tier')

@push('styles')
<style>
.include-row {
    display: grid;
    grid-template-columns: 1fr 160px auto;
    gap: .75rem; align-items: end;
    padding: .65rem;
    background: var(--bg-2);
    border: 1px solid var(--border);
    margin-bottom: .4rem;
}
.include-row .rm-btn {
    background: transparent;
    border: 1px solid rgba(192,88,88,.3);
    color: #c05858; padding: .5rem .8rem;
    cursor: pointer; font-size: .75rem;
    font-family: var(--ff-body);
    transition: all .2s; height: fit-content;
}
.include-row .rm-btn:hover { background:#c05858;color:white;border-color:#c05858; }
.color-preview {
    width: 36px; height: 36px; border: 1px solid var(--border);
    border-radius: 2px; flex-shrink: 0; cursor: pointer;
}
</style>
@endpush

@section('content')

<div class="page-header">
    <h1 class="page-title">
        {{ isset($tier) ? 'Edit Tier' : 'Tambah Tier' }}
        <span>— {{ $package->name }}</span>
    </h1>
    <p class="page-sub">
        {{ isset($tier) ? 'Perbarui tier: '.$tier->name : 'Tambah tier baru (Bronze, Silver, Gold, Platinum, dll)' }}
    </p>
</div>

<form method="POST"
      action="{{ isset($tier)
          ? route('admin.packages.tiers.update', [$package, $tier])
          : route('admin.packages.tiers.store', $package) }}"
      style="max-width:700px;">
    @csrf
    @if(isset($tier)) @method('PUT') @endif

    @if($errors->any())
        <div class="alert alert-err">
            @foreach($errors->all() as $e)<div>⚠ {{ $e }}</div>@endforeach
        </div>
    @endif

    {{-- Tier info --}}
    <div class="form-panel" style="margin-bottom:1.5rem;">
        <p style="font-size:.62rem;letter-spacing:.25em;text-transform:uppercase;
                  color:var(--text-muted);margin-bottom:1.25rem;">Info Tier</p>

        <div class="form-row">
            <div class="form-group">
                <label>Nama Tier *</label>
                <input type="text" name="name"
                       value="{{ old('name', $tier->name ?? '') }}" required
                       placeholder="Bronze / Silver / Gold / Platinum">
            </div>
            <div class="form-group">
                <label>Badge (opsional)</label>
                <input type="text" name="badge"
                       value="{{ old('badge', $tier->badge ?? '') }}"
                       placeholder="Best Seller, Recommended…">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label>Harga (Rp) *</label>
                <input type="number" name="price" min="0" step="1000"
                       value="{{ old('price', $tier->price ?? '') }}" required>
            </div>
            <div class="form-group">
                <label>Warna Tier *</label>
                <div style="display:flex;gap:.75rem;align-items:center;">
                    <input type="color" id="colorPicker"
                           value="{{ old('color', $tier->color ?? '#CD7F32') }}"
                           oninput="document.getElementById('colorHex').value=this.value"
                           style="width:48px;height:42px;padding:2px;background:var(--bg-2);
                                  border:1px solid var(--border);cursor:pointer;">
                    <input type="text" id="colorHex" name="color"
                           value="{{ old('color', $tier->color ?? '#CD7F32') }}"
                           oninput="document.getElementById('colorPicker').value=this.value"
                           maxlength="7" placeholder="#CD7F32"
                           style="flex:1;">
                </div>
                <p style="font-size:.7rem;color:var(--text-muted);margin-top:.35rem;">
                    Saran: Bronze #CD7F32 · Silver #A8A9AD · Gold #FFD700 · Platinum #E5E4E2
                </p>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label>Urutan Tampil</label>
                <input type="number" name="sort_order" min="0"
                       value="{{ old('sort_order', $tier->sort_order ?? 0) }}">
            </div>
            <div class="form-group" style="display:flex;align-items:flex-end;padding-bottom:.3rem;">
                <label class="form-check">
                    <input type="checkbox" name="is_available"
                           {{ old('is_available', $tier->is_available ?? true) ? 'checked' : '' }}>
                    Tier Aktif / Tersedia
                </label>
            </div>
        </div>
    </div>

    {{-- Includes --}}
    <div class="form-panel">
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1.25rem;">
            <p style="font-size:.62rem;letter-spacing:.25em;text-transform:uppercase;color:var(--text-muted);">
                Item yang Termasuk
            </p>
            <button type="button" id="add-row" class="btn btn-outline btn-sm">+ Tambah Item</button>
        </div>

        {{-- Column header --}}
        <div style="display:grid;grid-template-columns:1fr 160px auto;gap:.75rem;
                    margin-bottom:.4rem;padding:0 .65rem;">
            <span style="font-size:.6rem;letter-spacing:.2em;text-transform:uppercase;color:var(--text-muted);">Nama Item</span>
            <span style="font-size:.6rem;letter-spacing:.2em;text-transform:uppercase;color:var(--text-muted);">Jumlah/Satuan</span>
            <span style="width:54px;display:block;"></span>
        </div>

        <div id="includes-container">
            @php
                $existingItems = old('items',
                    isset($tier) ? $tier->includes->map(fn($i) => [
                        'item_name' => $i->item_name,
                        'quantity'  => $i->quantity,
                    ])->toArray() : []
                );
            @endphp

            @if(count($existingItems) === 0)
                <div id="empty-hint" style="text-align:center;padding:1.5rem;
                     border:1px dashed rgba(155,48,255,.2);font-size:.8rem;color:var(--text-muted);">
                    Klik "+ Tambah Item" untuk mulai
                </div>
            @else
                @foreach($existingItems as $idx => $it)
                <div class="include-row">
                    <input type="text" name="items[{{ $idx }}][item_name]"
                           value="{{ $it['item_name'] }}" required
                           placeholder="e.g. Ice Lemon Tea">
                    <input type="text" name="items[{{ $idx }}][quantity]"
                           value="{{ $it['quantity'] }}" required
                           placeholder="e.g. 1 Pitcher">
                    <button type="button" class="rm-btn" onclick="removeRow(this)">✕</button>
                </div>
                @endforeach
            @endif
        </div>
    </div>

    <div class="form-footer">
        <button type="submit" class="btn btn-primary">
            {{ isset($tier) ? 'Simpan Perubahan' : 'Tambah Tier' }}
        </button>
        <a href="{{ route('admin.packages.edit', $package) }}" class="btn btn-outline">Batal</a>
    </div>
</form>

@endsection

@push('scripts')
<script>
let idx = {{ count($existingItems ?? []) }};

document.getElementById('add-row').addEventListener('click', function () {
    const hint = document.getElementById('empty-hint');
    if (hint) hint.remove();

    const row = document.createElement('div');
    row.className = 'include-row';
    row.innerHTML = `
        <input type="text" name="items[${idx}][item_name]" required placeholder="e.g. Ice Lemon Tea">
        <input type="text" name="items[${idx}][quantity]"  required placeholder="e.g. 1 Pitcher">
        <button type="button" class="rm-btn" onclick="removeRow(this)">✕</button>
    `;
    document.getElementById('includes-container').appendChild(row);
    row.querySelector('input').focus();
    idx++;
});

function removeRow(btn) {
    btn.closest('.include-row').remove();
    const c = document.getElementById('includes-container');
    if (!c.querySelector('.include-row')) {
        const hint = document.createElement('div');
        hint.id = 'empty-hint';
        hint.style.cssText = 'text-align:center;padding:1.5rem;border:1px dashed rgba(155,48,255,.2);font-size:.8rem;color:var(--text-muted)';
        hint.textContent = 'Klik "+ Tambah Item" untuk mulai';
        c.appendChild(hint);
    }
}
</script>
@endpush
