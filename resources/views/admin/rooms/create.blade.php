@extends('layouts.admin')
@section('title', isset($room) ? 'Edit Room' : 'Tambah Room')
@section('content')

<div class="page-header">
    <h1 class="page-title">{{ isset($room) ? 'Edit' : 'Tambah' }} <span>Room</span></h1>
    <p class="page-sub">{{ isset($room) ? 'Perbarui detail: '.$room->name : 'Daftarkan room karaoke baru' }}</p>
</div>

<form method="POST"
      action="{{ isset($room) ? route('admin.rooms.update',$room) : route('admin.rooms.store') }}"
      enctype="multipart/form-data">
    @csrf @if(isset($room)) @method('PUT') @endif

    @if($errors->any())
        <div class="alert alert-err">@foreach($errors->all() as $e)<div>⚠ {{ $e }}</div>@endforeach</div>
    @endif

    <div style="display:grid;grid-template-columns:1fr 340px;gap:1.5rem;align-items:start;">
        <div>
            <div class="form-panel" style="margin-bottom:1.5rem;">
                <p style="font-size:.62rem;letter-spacing:.25em;text-transform:uppercase;color:var(--text-muted);margin-bottom:1.25rem;">Info Room</p>

                <div class="form-row">
                    <div class="form-group">
                        <label>Nama Room *</label>
                        <input type="text" name="name" value="{{ old('name',$room->name??'') }}" required placeholder="e.g. Room VIP Sakura">
                    </div>
                    <div class="form-group">
                        <label>Tipe *</label>
                        <select name="type" required>
                            @foreach(['small'=>'Small','medium'=>'Medium','large'=>'Large','vip'=>'VIP'] as $val=>$lbl)
                                <option value="{{ $val }}" {{ old('type',$room->type??'')==$val?'selected':'' }}>{{ $lbl }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Kapasitas Min (orang) *</label>
                        <input type="number" name="capacity_min" min="1" value="{{ old('capacity_min',$room->capacity_min??2) }}" required>
                    </div>
                    <div class="form-group">
                        <label>Kapasitas Max (orang) *</label>
                        <input type="number" name="capacity_max" min="1" value="{{ old('capacity_max',$room->capacity_max??6) }}" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Harga Weekday / Jam (Rp) *</label>
                        <input type="number" name="price_weekday" min="0" step="1000" value="{{ old('price_weekday',$room->price_weekday??'') }}" required placeholder="50000">
                    </div>
                    <div class="form-group">
                        <label>Harga Weekend / Jam (Rp) *</label>
                        <input type="number" name="price_weekend" min="0" step="1000" value="{{ old('price_weekend',$room->price_weekend??'') }}" required placeholder="70000">
                    </div>
                </div>

                <div class="form-group">
                    <label>Deskripsi</label>
                    <textarea name="description">{{ old('description',$room->description??'') }}</textarea>
                </div>

                <div class="form-group">
                    <label>Fasilitas (pisahkan dengan koma)</label>
                    <input type="text" name="facilities"
                           value="{{ old('facilities', isset($room) ? implode(', ', $room->facilities ?? []) : '') }}"
                           placeholder='LED TV 55", Sistem Audio Surround, AC, Sofa, Mic 4 buah'>
                    <p style="font-size:.72rem;color:var(--text-muted);margin-top:.35rem;">Contoh: LED TV 55", Sofa Premium, Mic 4 buah</p>
                </div>

                <div style="display:flex;gap:2rem;">
                    <label class="form-check">
                        <input type="checkbox" name="is_available" {{ old('is_available',$room->is_available??true)?'checked':'' }}>
                        Room Tersedia
                    </label>
                </div>
            </div>
        </div>

        <div>
            <div class="form-panel" style="margin-bottom:1rem;">
                <p style="font-size:.62rem;letter-spacing:.25em;text-transform:uppercase;color:var(--text-muted);margin-bottom:1rem;">Foto Room</p>
                @if(isset($room) && $room->image)
                    <img src="{{ $room->image_url }}" style="width:100%;height:160px;object-fit:cover;margin-bottom:1rem;border:1px solid var(--border);">
                @else
                    <div style="width:100%;height:130px;background:var(--bg-2);border:1px dashed var(--border);display:flex;align-items:center;justify-content:center;margin-bottom:1rem;font-family:var(--ff-display);font-size:1.5rem;color:var(--text-muted);letter-spacing:.1em;">FOTO ROOM</div>
                @endif
                <input type="file" name="image" accept="image/*" style="width:100%;padding:.5rem;background:var(--bg-2);border:1px solid var(--border);color:var(--text-dim);cursor:pointer;">
                @if(isset($room) && $room->image)
                    <p style="font-size:.72rem;color:var(--text-muted);margin-top:.35rem;">Upload baru untuk mengganti.</p>
                @endif
            </div>
            <div class="form-group">
                <label>Urutan Tampil</label>
                <input type="number" name="sort_order" min="0" value="{{ old('sort_order',$room->sort_order??0) }}">
            </div>
        </div>
    </div>

    <div class="form-footer">
        <button type="submit" class="btn btn-primary">{{ isset($room) ? 'Simpan Perubahan' : 'Tambah Room' }}</button>
        <a href="{{ route('admin.rooms.index') }}" class="btn btn-outline">Batal</a>
    </div>
</form>
@endsection
