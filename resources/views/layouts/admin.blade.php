<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin · @yield('title', 'Masterpiece')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Outfit:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        :root {
            --bg:        #080810; --bg-2: #0D0D1A; --bg-card: #0F0F1E;
            --neon-pink: #FF2D78; --neon-purp: #9B30FF; --neon-cyan: #00E5FF;
            --gold:      #FFD166;
            --text:      #F0EEF8; --text-dim: #7B78A0; --text-muted: #2E2C45;
            --border:    rgba(155,48,255,0.15); --border-pink: rgba(255,45,120,0.2);
            --red:       #E05555; --green: #50B878;
            --ff-display:'Bebas Neue', sans-serif;
            --ff-body:   'Outfit', sans-serif;
            --sidebar-w: 230px;
        }
        body { display: flex; min-height: 100vh; background: var(--bg); font-family: var(--ff-body); font-weight: 300; color: var(--text); }
        ::-webkit-scrollbar { width: 4px; } ::-webkit-scrollbar-track { background: var(--bg-2); } ::-webkit-scrollbar-thumb { background: var(--neon-purp); }

        /* Sidebar */
        .sidebar { width: var(--sidebar-w); background: var(--bg-2); border-right: 1px solid var(--border); position: fixed; top: 0; left: 0; height: 100vh; overflow-y: auto; display: flex; flex-direction: column; }
        .sidebar-brand { padding: 1.5rem; border-bottom: 1px solid var(--border); }
        .sidebar-brand-text { font-family: var(--ff-display); font-size: 1.3rem; letter-spacing: 0.1em; color: var(--text); }
        .sidebar-brand-text span { color: var(--neon-pink); }
        .sidebar-brand-sub { font-size: 0.62rem; letter-spacing: 0.2em; text-transform: uppercase; color: var(--text-muted); margin-top: 0.2rem; }
        .sidebar-section { padding: 1.25rem 0 0.5rem; }
        .sidebar-label { font-size: 0.58rem; letter-spacing: 0.3em; text-transform: uppercase; color: var(--text-muted); padding: 0 1.25rem; margin-bottom: 0.3rem; display: block; }
        .sidebar a { display: flex; align-items: center; gap: 0.6rem; padding: 0.6rem 1.25rem; font-size: 0.75rem; letter-spacing: 0.1em; text-transform: uppercase; color: var(--text-dim); text-decoration: none; transition: all .2s; border-left: 2px solid transparent; }
        .sidebar a:hover { color: var(--text); background: rgba(155,48,255,0.06); }
        .sidebar a.active { color: var(--neon-pink); border-left-color: var(--neon-pink); background: rgba(255,45,120,0.06); }
        .sidebar-bottom { margin-top: auto; padding: 1.25rem; border-top: 1px solid var(--border); }
        .sidebar-bottom a { font-size: 0.72rem; color: var(--text-muted); text-decoration: none; padding: 0.4rem 0; transition: color .2s; display: block; }
        .sidebar-bottom a:hover { color: var(--text); }
        .sidebar-bottom form button { background: none; border: none; cursor: pointer; font-family: var(--ff-body); font-size: 0.72rem; letter-spacing: 0.1em; text-transform: uppercase; color: var(--text-muted); padding: 0.4rem 0; text-align: left; width: 100%; transition: color .2s; }
        .sidebar-bottom form button:hover { color: var(--red); }

        /* Main */
        .main { margin-left: var(--sidebar-w); flex: 1; padding: 2.5rem; background: var(--bg); }
        .page-header { margin-bottom: 2rem; }
        .page-title { font-family: var(--ff-display); font-size: 2rem; letter-spacing: 0.08em; color: var(--text); }
        .page-title span { color: var(--neon-pink); }
        .page-sub { font-size: 0.8rem; color: var(--text-dim); margin-top: 0.2rem; }

        /* Panel */
        .panel { background: var(--bg-card); border: 1px solid var(--border); overflow: hidden; margin-bottom: 1.5rem; }

        /* Table */
        table { width: 100%; border-collapse: collapse; }
        th { font-size: 0.62rem; letter-spacing: 0.25em; text-transform: uppercase; color: var(--text-muted); padding: 1rem 1.25rem; border-bottom: 1px solid var(--border); text-align: left; font-weight: 400; background: var(--bg-2); }
        td { padding: 0.9rem 1.25rem; border-bottom: 1px solid rgba(255,255,255,0.03); font-size: 0.85rem; vertical-align: middle; }
        tr:last-child td { border-bottom: none; }
        tr:hover td { background: rgba(155,48,255,0.03); }

        /* Buttons */
        .btn { display: inline-block; padding: 0.55rem 1.3rem; font-family: var(--ff-body); font-size: 0.72rem; letter-spacing: 0.15em; text-transform: uppercase; text-decoration: none; cursor: pointer; border: none; transition: all .2s; }
        .btn-primary { background: var(--neon-pink); color: #fff; }
        .btn-primary:hover { background: #ff5090; box-shadow: 0 0 20px rgba(255,45,120,0.4); }
        .btn-outline { background: transparent; border: 1px solid var(--border); color: var(--text-dim); }
        .btn-outline:hover { border-color: var(--neon-purp); color: var(--neon-purp); }
        .btn-danger { background: transparent; border: 1px solid rgba(224,85,85,0.25); color: var(--red); font-size: 0.68rem; padding: 0.4rem 0.85rem; }
        .btn-danger:hover { background: var(--red); color: white; }
        .btn-sm { padding: 0.4rem 0.85rem; font-size: 0.68rem; }

        /* Forms */
        .form-group { margin-bottom: 1.25rem; }
        label { display: block; font-size: 0.65rem; letter-spacing: 0.2em; text-transform: uppercase; color: var(--text-dim); margin-bottom: 0.45rem; }
        input[type=text], input[type=number], input[type=email], input[type=password], textarea, select { width: 100%; padding: 0.75rem 1rem; background: var(--bg-2); border: 1px solid var(--border); color: var(--text); font-family: var(--ff-body); font-size: 0.875rem; outline: none; transition: border .2s; appearance: none; }
        input:focus, textarea:focus, select:focus { border-color: rgba(155,48,255,0.5); }
        input::placeholder, textarea::placeholder { color: var(--text-muted); }
        textarea { resize: vertical; min-height: 100px; }
        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 1.25rem; }
        .form-check { display: flex; align-items: center; gap: 0.6rem; cursor: pointer; font-size: 0.82rem; color: var(--text-dim); }
        input[type=checkbox] { width: 15px; height: 15px; accent-color: var(--neon-pink); cursor: pointer; }

        /* Alert */
        .alert { padding: 0.9rem 1.5rem; margin-bottom: 1.5rem; border-left: 2px solid var(--neon-pink); background: rgba(255,45,120,0.07); font-size: 0.82rem; color: var(--neon-pink); }
        .alert-err { border-color: var(--red); background: rgba(224,85,85,0.07); color: var(--red); }

        /* Pills */
        .pill { display: inline-block; padding: 0.2em 0.75em; font-size: 0.62rem; letter-spacing: 0.12em; text-transform: uppercase; }
        .pill-green { background: rgba(80,184,120,0.12); color: var(--green); }
        .pill-red   { background: rgba(224,85,85,0.12); color: var(--red); }
        .pill-purp  { background: rgba(155,48,255,0.12); color: var(--neon-purp); border: 1px solid var(--border); }
        .pill-pink  { background: rgba(255,45,120,0.12); color: var(--neon-pink); }
        .pill-cyan  { background: rgba(0,229,255,0.10); color: var(--neon-cyan); }
        .pill-gold  { background: rgba(255,209,102,0.10); color: var(--gold); }

        /* Helpers */
        .flex-between { display: flex; align-items: center; justify-content: space-between; }
        .actions { display: flex; gap: 0.5rem; align-items: center; }
        .form-panel { background: var(--bg-card); border: 1px solid var(--border); padding: 2rem; }
        .form-footer { display: flex; gap: 0.75rem; padding-top: 1.5rem; margin-top: 0.5rem; border-top: 1px solid var(--border); }

        @media(max-width:768px) { .sidebar { transform: translateX(-100%); } .main { margin-left: 0; padding: 1.25rem; } .form-row { grid-template-columns: 1fr; } }
    </style>
    @stack('styles')
</head>
<body>

<aside class="sidebar">
    <div class="sidebar-brand">
        <div class="sidebar-brand-text">MASTER<span>PIECE</span></div>
        <div class="sidebar-brand-sub">Admin Panel</div>
    </div>

    <div class="sidebar-section">
        <span class="sidebar-label">Kelola</span>
        <a href="{{ route('admin.reservations.index')}}" class="{{ request()->routeIs('admin.reservations*') ? 'active' : '' }}">📅 &ensp;Reservasi</a>
        <a href="{{ route('admin.rooms.index') }}"    class="{{ request()->routeIs('admin.rooms*')    ? 'active' : '' }}">🎤 &ensp;Rooms</a>
        <a href="{{ route('admin.packages.index') }}" class="{{ request()->routeIs('admin.packages*') ? 'active' : '' }}">📦 &ensp;Paket</a>
        <a href="{{ route('admin.fnb.items') }}"      class="{{ request()->routeIs('admin.fnb.items*')? 'active' : '' }}">🍱 &ensp;Menu F&amp;B</a>
        <a href="{{ route('admin.fnb.categories') }}" class="{{ request()->routeIs('admin.fnb.cat*')  ? 'active' : '' }}">📂 &ensp;Kategori F&amp;B</a>
        <a href="{{ route('admin.gallery.index') }}"  class="{{ request()->routeIs('admin.gallery*')  ? 'active' : '' }}">📷 &ensp;Galeri</a>
    </div>

    <div class="sidebar-bottom">
        <a href="{{ route('home') }}">↗ &ensp;Lihat Website</a>
        <form method="POST" action="{{ route('logout') }}" style="margin-top:.5rem;">
            @csrf <button type="submit">Logout</button>
        </form>
    </div>
</aside>

<main class="main">
    @if(session('success'))
        <div class="alert">✓ &ensp;{{ session('success') }}</div>
    @endif

    @yield('content')
</main>
@stack('scripts')
</body>
</html>
