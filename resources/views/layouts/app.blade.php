<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Masterpiece Signature Karaoke – Tebet')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Outfit:wght@300;400;500;600&display=swap" rel="stylesheet">

    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --bg:        #080810;
            --bg-2:      #0D0D1A;
            --bg-card:   #0F0F1E;
            --bg-glass:  rgba(15,15,30,0.85);
            --neon-pink: #FF2D78;
            --neon-purp: #9B30FF;
            --neon-cyan: #00E5FF;
            --gold:      #FFD166;
            --text:      #F0EEF8;
            --text-dim:  #7B78A0;
            --text-muted:#2E2C45;
            --border:    rgba(155,48,255,0.15);
            --border-pink: rgba(255,45,120,0.2);
            --ff-display:'Bebas Neue', sans-serif;
            --ff-body:   'Outfit', sans-serif;
            --glow-pink: 0 0 20px rgba(255,45,120,0.4);
            --glow-purp: 0 0 20px rgba(155,48,255,0.4);
        }

        html { scroll-behavior: smooth; }

        body {
            background: var(--bg);
            color: var(--text);
            font-family: var(--ff-body);
            font-weight: 300;
            line-height: 1.65;
            overflow-x: hidden;
        }

        ::-webkit-scrollbar { width: 5px; }
        ::-webkit-scrollbar-track { background: var(--bg-2); }
        ::-webkit-scrollbar-thumb { background: var(--neon-purp); border-radius: 3px; }

        /* ── Nav ── */
        .nav {
            position: sticky; top: 0; z-index: 100;
            background: rgba(8,8,16,0.92);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--border);
            height: 64px;
            display: flex; align-items: center; justify-content: space-between;
            padding: 0 2rem;
        }
        .nav-brand {
            font-family: var(--ff-display);
            font-size: 1.4rem; letter-spacing: 0.12em;
            color: var(--text); text-decoration: none; line-height: 1;
        }
        .nav-brand span { color: var(--neon-pink); }
        .nav-links { display: flex; align-items: center; gap: 0.25rem; }
        .nav-links a {
            font-size: 0.72rem; letter-spacing: 0.18em; text-transform: uppercase;
            color: var(--text-dim); text-decoration: none;
            padding: 0.45rem 0.9rem; transition: color .2s;
        }
        .nav-links a:hover, .nav-links a.active { color: var(--neon-pink); }
        .nav-links form button {
            background: none; border: none; cursor: pointer;
            font-family: var(--ff-body); font-size: 0.72rem;
            letter-spacing: 0.18em; text-transform: uppercase;
            color: var(--text-dim); padding: 0.45rem 0.9rem; transition: color .2s;
        }
        .nav-links form button:hover { color: #e05050; }

        /* ── Alert ── */
        .flash {
            padding: 0.85rem 2rem;
            background: rgba(255,45,120,0.08);
            border-left: 3px solid var(--neon-pink);
            font-size: 0.82rem; color: var(--neon-pink);
        }

        /* ── Container ── */
        .container { max-width: 1200px; margin: 0 auto; padding: 0 2rem; }

        /* ── Section heading ── */
        .sec-tag {
            font-size: 0.68rem; letter-spacing: 0.4em; text-transform: uppercase;
            color: var(--neon-pink); margin-bottom: 0.5rem; display: block;
        }
        .sec-title {
            font-family: var(--ff-display);
            font-size: clamp(2.2rem, 5vw, 3.5rem);
            letter-spacing: 0.06em; color: var(--text); line-height: 1;
        }
        .sec-title span { color: var(--neon-pink); }

        /* ── Divider ── */
        .neon-line {
            height: 1px; width: 100%;
            background: linear-gradient(90deg, transparent, var(--neon-purp), transparent);
            margin: 0;
        }

        /* ── Footer ── */
        .footer {
            margin-top: 5rem;
            background: var(--bg-2);
            border-top: 1px solid var(--border);
            padding: 3rem 2rem 2rem;
            text-align: center;
        }
        .footer-brand {
            font-family: var(--ff-display);
            font-size: 2rem; letter-spacing: 0.1em;
            margin-bottom: 0.5rem;
        }
        .footer-brand span { color: var(--neon-pink); }
        .footer p { font-size: 0.78rem; color: var(--text-muted); margin-top: 0.3rem; }

        @media(max-width:768px){
            .nav { padding: 0 1rem; }
            .container { padding: 0 1rem; }
            .nav-links a { padding: 0.4rem 0.5rem; font-size: 0.65rem; }
        }
    </style>
    @stack('styles')
</head>
<body>

<nav class="nav">
    <a href="{{ route('home') }}" class="nav-brand">MASTER<span>PIECE</span></a>
    <div class="nav-links">
        <a href="{{ route('home') }}#rooms"    class="">Rooms</a>
        <a href="{{ route('home') }}#packages" class="">Paket</a>
        <a href="{{ route('home') }}#fnb"      class="">F&amp;B</a>
        <a href="{{ route('home') }}#info"     class="">Info</a>
        @auth
            <a href="{{ route('admin.rooms.index') }}">Admin</a>
            <form method="POST" action="{{ route('logout') }}" style="display:inline">
                @csrf <button type="submit">Logout</button>
            </form>
        @else
            <a href="{{ route('login') }}">Admin</a>
        @endauth
    </div>
</nav>

@if(session('success'))
    <div class="flash">✓ &nbsp;{{ session('success') }}</div>
@endif

@yield('content')

<footer class="footer">
    <div class="footer-brand">MASTER<span>PIECE</span> SIGNATURE</div>
    <p>Jl. Tebet, Jakarta Selatan &nbsp;·&nbsp; Buka setiap hari 10.00 – 02.00 WIB</p>
    <p style="margin-top:1.5rem;">&copy; {{ date('Y') }} Masterpiece Signature Karaoke</p>
</footer>

@stack('scripts')
</body>
</html>
