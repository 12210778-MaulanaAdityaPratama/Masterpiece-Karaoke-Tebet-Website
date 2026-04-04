@extends('layouts.admin')
@section('title', 'Galeri')

@push('styles')
<style>
    /* ── Filter Tabs ── */
    .tab-bar { display: flex; gap: .5rem; margin-bottom: 1.75rem; flex-wrap: wrap; }
    .tab-pill {
        padding: .4rem 1.1rem; border-radius: 50px;
        font-size: .68rem; letter-spacing: .15em; text-transform: uppercase;
        border: 1px solid var(--border); color: var(--text-dim);
        transition: all .2s; text-decoration: none; display: inline-flex; align-items: center; gap: .4rem;
    }
    .tab-pill:hover { border-color: var(--neon-purp); color: var(--text); }
    .tab-pill.active { background: var(--neon-purp); border-color: var(--neon-purp); color: #fff; }
    .tab-pill.active-pink { background: var(--neon-pink); border-color: var(--neon-pink); color: #fff; }
    .cnt-badge {
        display: inline-block; min-width: 18px; text-align: center;
        background: rgba(255,255,255,.18); border-radius: 50px;
        font-size: .6rem; padding: .05rem .4rem;
    }

    /* ── Grid ── */
    .gal-admin-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
        gap: 1.25rem;
    }

    .gal-card {
        background: var(--bg-card); border: 1px solid var(--border);
        border-radius: 10px; overflow: hidden;
        transition: transform .2s, box-shadow .2s;
        display: flex; flex-direction: column;
    }
    .gal-card:hover { transform: translateY(-3px); box-shadow: 0 0 18px rgba(155,48,255,.2); }

    .gal-card-img {
        width: 100%; height: 180px; object-fit: cover; display: block;
    }
    .gal-card-body { padding: .9rem 1rem; flex: 1; display: flex; flex-direction: column; gap: .35rem; }
    .gal-name  { font-size: .8rem; font-weight: 500; color: var(--text); }
    .gal-cap   { font-size: .72rem; color: var(--text-dim); flex: 1; }
    .gal-date  { font-size: .62rem; color: var(--text-muted); }

    .status-pill {
        display: inline-block; border-radius: 50px;
        font-size: .6rem; letter-spacing: .1em; text-transform: uppercase;
        padding: .18rem .65rem; font-weight: 600;
    }
    .s-pending  { background: rgba(255,209,102,.12); color: var(--gold);     border: 1px solid rgba(255,209,102,.3); }
    .s-approved { background: rgba(0,229,255,.1);   color: var(--neon-cyan); border: 1px solid rgba(0,229,255,.3); }
    .s-rejected { background: rgba(255,45,120,.1);  color: var(--neon-pink); border: 1px solid var(--border-pink); }

    .gal-actions { display: flex; gap: .45rem; flex-wrap: wrap; margin-top: .5rem; }
    .btn-approve { background: rgba(0,229,255,.12);  color: var(--neon-cyan); border: 1px solid rgba(0,229,255,.3);  font-size:.65rem; padding:.35rem .7rem; }
    .btn-reject  { background: rgba(255,209,102,.1); color: var(--gold);      border: 1px solid rgba(255,209,102,.3); font-size:.65rem; padding:.35rem .7rem; }
    .btn-approve:hover { background: rgba(0,229,255,.25); }
    .btn-reject:hover  { background: rgba(255,209,102,.25); }

    /* ── Empty ── */
    .gal-empty { text-align: center; padding: 5rem 2rem; color: var(--text-dim); }
    .gal-empty .icon { font-size: 3rem; margin-bottom: .75rem; }
</style>
@endpush

@section('content')

<div class="page-header flex-between">
    <div>
        <h1 class="page-title">Manajemen <span>Galeri</span></h1>
        <p class="page-sub">Review dan approve foto kiriman pengunjung</p>
    </div>
    <a href="{{ route('gallery.index') }}" target="_blank" class="btn btn-outline">↗ &ensp;Lihat Galeri Publik</a>
</div>

{{-- Filter Tabs --}}
<div class="tab-bar">
    <a href="{{ route('admin.gallery.index', ['status' => 'pending']) }}"
       class="tab-pill {{ $status === 'pending'  ? 'active' : '' }}">
        ⏳ Pending <span class="cnt-badge">{{ $counts['pending'] }}</span>
    </a>
    <a href="{{ route('admin.gallery.index', ['status' => 'approved']) }}"
       class="tab-pill {{ $status === 'approved' ? 'active' : '' }}">
        ✅ Approved <span class="cnt-badge">{{ $counts['approved'] }}</span>
    </a>
    <a href="{{ route('admin.gallery.index', ['status' => 'rejected']) }}"
       class="tab-pill {{ $status === 'rejected' ? 'active' : '' }}">
        ❌ Rejected <span class="cnt-badge">{{ $counts['rejected'] }}</span>
    </a>
</div>

{{-- Grid --}}
@if($photos->count())
    <div class="gal-admin-grid">
        @foreach($photos as $photo)
            <div class="gal-card">
                <img class="gal-card-img"
                     src="{{ Storage::url($photo->image_path) }}"
                     alt="{{ $photo->caption ?? 'Foto' }}">
                <div class="gal-card-body">
                    <div class="gal-name">👤 {{ $photo->submitter_name }}</div>
                    <div class="gal-cap">{{ $photo->caption ?: '—' }}</div>
                    <div class="gal-date">📅 {{ $photo->created_at->format('d M Y, H:i') }}</div>
                    <span class="status-pill s-{{ $photo->status }}">
                        @if($photo->status === 'pending') Pending
                        @elseif($photo->status === 'approved') Approved
                        @else Rejected
                        @endif
                    </span>

                    <div class="gal-actions">
                        @if($photo->status !== 'approved')
                            <form method="POST" action="{{ route('admin.gallery.approve', $photo) }}">
                                @csrf @method('PATCH')
                                <button type="submit" class="btn btn-approve">✓ Approve</button>
                            </form>
                        @endif
                        @if($photo->status !== 'rejected')
                            <form method="POST" action="{{ route('admin.gallery.reject', $photo) }}">
                                @csrf @method('PATCH')
                                <button type="submit" class="btn btn-reject">✗ Reject</button>
                            </form>
                        @endif
                        <form method="POST" action="{{ route('admin.gallery.destroy', $photo) }}"
                              onsubmit="return confirm('Hapus foto ini secara permanen?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger">🗑 Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@else
    <div class="gal-empty">
        <div class="icon">📭</div>
        <p>Tidak ada foto dengan status <strong>{{ ucfirst($status) }}</strong>.</p>
    </div>
@endif

@endsection
