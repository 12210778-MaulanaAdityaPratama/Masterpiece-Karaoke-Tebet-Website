@extends('layouts.admin')
@section('title', 'Rooms')
@section('content')
<div class="page-header flex-between">
    <div>
        <h1 class="page-title">Daftar <span>Room</span></h1>
        <p class="page-sub">Kelola room karaoke dan price list per jam</p>
    </div>
    <a href="{{ route('admin.rooms.create') }}" class="btn btn-primary">+ Tambah Room</a>
</div>
<div class="panel">
    <table>
        <thead>
            <tr>
                <th>Nama Room</th><th>Tipe</th><th>Kapasitas</th>
                <th>Weekday/jam</th><th>Weekend/jam</th><th>Status</th><th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($rooms as $room)
            <tr>
                <td style="font-family:var(--ff-display);font-size:1.05rem;letter-spacing:.05em;">{{ $room->name }}</td>
                <td>
                    <span class="pill {{ match($room->type){ 'small'=>'pill-cyan','medium'=>'pill-purp','large'=>'pill-gold','vip'=>'pill-pink',default=>'pill-purp' } }}">
                        {{ $room->getTypeLabel() }}
                    </span>
                </td>
                <td style="color:var(--text-dim);">{{ $room->getCapacityLabel() }}</td>
                <td style="color:var(--neon-purp);font-family:var(--ff-display);letter-spacing:.05em;">{{ $room->formatted_weekday }}</td>
                <td style="color:var(--neon-pink);font-family:var(--ff-display);letter-spacing:.05em;">{{ $room->formatted_weekend }}</td>
                <td>
                    @if($room->is_available)
                        <span class="pill pill-green">Tersedia</span>
                    @else
                        <span class="pill pill-red">Tutup</span>
                    @endif
                </td>
                <td>
                    <div class="actions">
                        <a href="{{ route('admin.rooms.edit', $room) }}" class="btn btn-outline btn-sm">Edit</a>
                        <form method="POST" action="{{ route('admin.rooms.destroy', $room) }}" onsubmit="return confirm('Hapus room ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="7" style="text-align:center;padding:3rem;color:var(--text-dim);">
                Belum ada room. <a href="{{ route('admin.rooms.create') }}" style="color:var(--neon-pink);">Tambah sekarang →</a>
            </td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
