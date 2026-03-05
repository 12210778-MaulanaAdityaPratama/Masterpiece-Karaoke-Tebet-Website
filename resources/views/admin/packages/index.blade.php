@extends('layouts.admin')
@section('title', 'Paket')
@section('content')

<div class="page-header flex-between">
    <div>
        <h1 class="page-title">Paket <span>Karaoke</span></h1>
        <p class="page-sub">Klik paket untuk manage tier Bronze / Silver / Gold</p>
    </div>
    <a href="{{ route('admin.packages.create') }}" class="btn btn-primary">+ Tambah Paket</a>
</div>

<div class="panel">
    <table>
        <thead>
            <tr>
                <th>Nama Paket</th>
                <th>Deskripsi</th>
                <th>Durasi</th>
                <th>Tier</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($packages as $pkg)
            <tr>
                <td style="font-family:var(--ff-display);font-size:1.1rem;letter-spacing:.05em;">
                    {{ $pkg->name }}
                </td>
                <td style="color:var(--text-dim);font-size:.82rem;">
                    {{ $pkg->description ?? '—' }}
                </td>
                <td style="color:var(--text-dim);">{{ $pkg->duration_hours }} jam</td>
                <td>
                    <span class="pill pill-purp">{{ $pkg->tiers_count }} tier</span>
                </td>
                <td>
                    @if($pkg->is_active)
                        <span class="pill pill-green">Aktif</span>
                    @else
                        <span class="pill pill-red">Nonaktif</span>
                    @endif
                </td>
                <td>
                    <div class="actions">
                        <a href="{{ route('admin.packages.edit', $pkg) }}"
                           class="btn btn-primary btn-sm">Kelola Tier</a>
                        <a href="{{ route('admin.packages.edit', $pkg) }}"
                           class="btn btn-outline btn-sm">Edit</a>
                        <form method="POST" action="{{ route('admin.packages.destroy', $pkg) }}"
                              onsubmit="return confirm('Hapus paket dan semua tier-nya?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger">Hapus</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align:center;padding:3rem;color:var(--text-dim);">
                    Belum ada paket.
                    <a href="{{ route('admin.packages.create') }}" style="color:var(--neon-pink);">
                        Buat sekarang →
                    </a>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
