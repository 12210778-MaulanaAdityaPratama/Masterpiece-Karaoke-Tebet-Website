@extends('layouts.admin')
@section('title', 'Manajemen Reservasi')

@push('styles')
<style>
    /* ── Tab Filter ── */
    .tab-bar { display: flex; gap: .5rem; margin-bottom: 1.5rem; flex-wrap: wrap; }
    .tab-pill {
        padding: .4rem 1.1rem; border-radius: 50px;
        font-size: .68rem; letter-spacing: .15em; text-transform: uppercase;
        border: 1px solid var(--border); color: var(--text-dim);
        transition: all .2s; text-decoration: none; display: inline-flex; align-items: center; gap: .4rem;
    }
    .tab-pill:hover { border-color: var(--neon-purp); color: var(--text); }
    .tab-pill.active { background: var(--neon-purp); border-color: var(--neon-purp); color: #fff; }
    .cnt-badge {
        display: inline-block; min-width: 18px; text-align: center;
        background: rgba(255,255,255,.18); border-radius: 50px;
        font-size: .6rem; padding: .05rem .4rem;
    }

    /* ── Table Resv ── */
    .resv-meta { font-size: .75rem; color: var(--text-dim); margin-top: .2rem; }
    .resv-meta span { color: var(--text); font-weight: 500; }
    .resv-notes { font-size: .75rem; font-style: italic; color: var(--gold); margin-top: .4rem; }

    .status-form { display: flex; align-items: center; gap: .5rem; }
    .status-select {
        background: var(--bg-2); border: 1px solid var(--border);
        color: var(--text); font-family: var(--ff-body); font-size: .75rem;
        padding: .3rem .5rem; border-radius: 4px; outline: none;
    }
</style>
@endpush

@section('content')

<div class="page-header">
    <h1 class="page-title">Daftar <span>Reservasi</span></h1>
    <p class="page-sub">Kelola reservasi room dan paket dari pelanggan</p>
</div>

{{-- Filter Tabs --}}
<div class="tab-bar">
    <a href="{{ route('admin.reservations.index', ['status' => 'pending']) }}"
       class="tab-pill {{ $status === 'pending'  ? 'active' : '' }}">
        ⏳ Pending <span class="cnt-badge">{{ $counts['pending'] }}</span>
    </a>
    <a href="{{ route('admin.reservations.index', ['status' => 'confirmed']) }}"
       class="tab-pill {{ $status === 'confirmed' ? 'active' : '' }}">
        ✅ Confirmed <span class="cnt-badge">{{ $counts['confirmed'] }}</span>
    </a>
    <a href="{{ route('admin.reservations.index', ['status' => 'completed']) }}"
       class="tab-pill {{ $status === 'completed' ? 'active' : '' }}" style="{{ $status === 'completed' ? 'background:var(--green);border-color:var(--green);color:#fff;' : '' }}">
        🏁 Completed <span class="cnt-badge">{{ $counts['completed'] }}</span>
    </a>
    <a href="{{ route('admin.reservations.index', ['status' => 'cancelled']) }}"
       class="tab-pill {{ $status === 'cancelled' ? 'active' : '' }}" style="{{ $status === 'cancelled' ? 'background:var(--red);border-color:var(--red);color:#fff;' : '' }}">
        ❌ Cancelled <span class="cnt-badge">{{ $counts['cancelled'] }}</span>
    </a>
</div>

<div class="panel">
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Pelanggan</th>
                <th>Jadwal Reservasi</th>
                <th>Layanan Dipilih</th>
                <th>Waktu Submit</th>
                <th>Status & Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($reservations as $resv)
            <tr>
                <td style="color:var(--text-dim);">#{{ str_pad($resv->id, 4, '0', STR_PAD_LEFT) }}</td>
                <td>
                    <div style="font-size:.95rem;font-weight:500;">{{ $resv->customer_name }}</div>
                    <div class="resv-meta">📞 <a href="https://wa.me/{{ preg_replace('/^08/', '628', preg_replace('/[^0-9]/', '', $resv->phone_number)) }}" target="_blank" style="color:var(--neon-cyan);text-decoration:none;">{{ $resv->phone_number }}</a></div>
                </td>
                <td>
                    <div style="color:var(--neon-pink);font-family:var(--ff-display);font-size:1.1rem;letter-spacing:.05em;">
                        {{ $resv->booking_date->format('d M Y') }}
                    </div>
                    <div class="resv-meta">⏰ Jam: <span>{{ \Carbon\Carbon::parse($resv->booking_time)->format('H:i') }} WIB</span></div>
                    <div class="resv-meta">⏱ Durasi: <span>{{ $resv->duration_hours }} Jam</span></div>
                </td>
                <td>
                    @if($resv->service_type === 'room' && $resv->room)
                        <span class="pill pill-purp">Room: {{ $resv->room->name }}</span>
                    @elseif($resv->service_type === 'package' && $resv->package)
                        <span class="pill pill-pink">Paket: {{ $resv->package->name }}</span>
                    @else
                        <span class="pill pill-gold">Layanan Lain/Dihapus</span>
                    @endif
                    
                    @if($resv->notes)
                        <div class="resv-notes">"{{ Str::limit($resv->notes, 60) }}"</div>
                    @endif
                </td>
                <td style="color:var(--text-dim);font-size:.75rem;">
                    {{ $resv->created_at->format('d/m/Y H:i') }}
                </td>
                <td>
                    <form method="POST" action="{{ route('admin.reservations.updateStatus', $resv) }}" class="status-form">
                        @csrf @method('PATCH')
                        <select name="status" class="status-select" onchange="this.form.submit()">
                            <option value="pending"   {{ $resv->status === 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="confirmed" {{ $resv->status === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                            <option value="completed" {{ $resv->status === 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="cancelled" {{ $resv->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </form>
                    
                    @if($resv->status === 'cancelled')
                    <div style="margin-top:.5rem;">
                        <form method="POST" action="{{ route('admin.reservations.destroy', $resv) }}" onsubmit="return confirm('Hapus permanen booking ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </div>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align:center;padding:4rem 2rem;color:var(--text-dim);">
                    <div style="font-size:2.5rem;margin-bottom:.5rem;">📭</div>
                    Belum ada reservasi dengan status <strong>{{ ucfirst($status) }}</strong>.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
