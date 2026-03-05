@extends('layouts.admin')
@section('title', 'Menu F&B')
@section('content')
<div class="page-header flex-between">
    <div>
        <h1 class="page-title">Menu <span>F&amp;B</span></h1>
        <p class="page-sub">Kelola daftar makanan dan minuman</p>
    </div>
    <a href="{{ route('admin.fnb.items.create') }}" class="btn btn-primary">+ Tambah Item</a>
</div>
<div class="panel">
    <table>
        <thead>
            <tr><th>Nama</th><th>Kategori</th><th>Harga</th><th>Badge</th><th>Status</th><th>Aksi</th></tr>
        </thead>
        <tbody>
            @forelse($items as $item)
            <tr>
                <td style="color:var(--text);">{{ $item->name }}</td>
                <td>
                    @if($item->category)
                        <span style="color:var(--text-dim);font-size:.82rem;">{{ $item->category->icon }} {{ $item->category->name }}</span>
                    @endif
                </td>
                <td style="color:var(--neon-purp);font-family:var(--ff-display);letter-spacing:.05em;">{{ $item->formatted_price }}</td>
                <td>
                    @if($item->badge)<span class="pill pill-pink">{{ $item->badge }}</span>
                    @else<span style="color:var(--text-muted);">—</span>@endif
                </td>
                <td>
                    @if($item->is_available)<span class="pill pill-green">Tersedia</span>
                    @else<span class="pill pill-red">Habis</span>@endif
                </td>
                <td>
                    <div class="actions">
                        <a href="{{ route('admin.fnb.items.edit', $item) }}" class="btn btn-outline btn-sm">Edit</a>
                        <form method="POST" action="{{ route('admin.fnb.items.destroy', $item) }}" onsubmit="return confirm('Hapus item ini?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger">Hapus</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="6" style="text-align:center;padding:3rem;color:var(--text-dim);">
                Belum ada item F&B. <a href="{{ route('admin.fnb.items.create') }}" style="color:var(--neon-pink);">Tambah sekarang →</a>
            </td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
