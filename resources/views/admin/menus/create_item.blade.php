@extends('layouts.admin')
@section('title', isset($fnbItem) ? 'Edit Item F&B' : 'Tambah Item F&B')
@section('content')

<div class="page-header">
    <h1 class="page-title">{{ isset($fnbItem) ? 'Edit' : 'Tambah' }} <span>Item F&amp;B</span></h1>
</div>

<form method="POST"
      action="{{ isset($fnbItem) ? route('admin.fnb.items.update',$fnbItem) : route('admin.fnb.items.store') }}"
      enctype="multipart/form-data"
      style="max-width:660px;">
    @csrf @if(isset($fnbItem)) @method('PUT') @endif

    @if($errors->any())
        <div class="alert alert-err">@foreach($errors->all() as $e)<div>⚠ {{ $e }}</div>@endforeach</div>
    @endif

    <div class="form-panel">
        <div class="form-row">
            <div class="form-group">
                <label>Kategori *</label>
                <select name="fnb_category_id" required>
                    <option value="">— Pilih Kategori —</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ old('fnb_category_id',$fnbItem->fnb_category_id??'')==$cat->id?'selected':'' }}>
                            {{ $cat->icon }} {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Nama Item *</label>
                <input type="text" name="name" value="{{ old('name',$fnbItem->name??'') }}" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group">
                <label>Harga (Rp) *</label>
                <input type="number" name="price" min="0" step="500" value="{{ old('price',$fnbItem->price??'') }}" required>
            </div>
            <div class="form-group">
                <label>Badge</label>
                <input type="text" name="badge" value="{{ old('badge',$fnbItem->badge??'') }}" placeholder="Recommended, Spicy 🌶, Best Seller…">
            </div>
        </div>
        <div class="form-group">
            <label>Deskripsi (opsional)</label>
            <textarea name="description" style="min-height:70px;">{{ old('description',$fnbItem->description??'') }}</textarea>
        </div>
        <div class="form-row">
            <div class="form-group">
                <label>Foto</label>
                @if(isset($fnbItem) && $fnbItem->image)
                    <img src="{{ $fnbItem->image_url }}" style="width:80px;height:60px;object-fit:cover;display:block;margin-bottom:.5rem;border:1px solid var(--border);">
                @endif
                <input type="file" name="image" accept="image/*" style="padding:.5rem;width:100%;background:var(--bg-2);border:1px solid var(--border);color:var(--text-dim);cursor:pointer;">
            </div>
            <div class="form-group">
                <label>Urutan Tampil</label>
                <input type="number" name="sort_order" min="0" value="{{ old('sort_order',$fnbItem->sort_order??0) }}">
            </div>
        </div>
        <label class="form-check">
            <input type="checkbox" name="is_available" {{ old('is_available',$fnbItem->is_available??true)?'checked':'' }}>
            Item Tersedia
        </label>
    </div>

    <div class="form-footer">
        <button type="submit" class="btn btn-primary">{{ isset($fnbItem) ? 'Simpan' : 'Tambah Item' }}</button>
        <a href="{{ route('admin.fnb.items') }}" class="btn btn-outline">Batal</a>
    </div>
</form>
@endsection
