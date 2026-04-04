<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Masterpiece Signature Karaoke Terdekat')</title>
    
    {{-- SEO & Meta Tags Defaults --}}
    <meta name="description" content="@yield('meta_description', 'Booking ruangan karaoke eksklusif, nikmati lagu terbaru dengan sound system premium di Masterpiece Signature Karaoke Tebet.')">
    <meta name="keywords" content="karaoke terdekat, masterpiece karaoke, karaoke jakarta selatan, karaoke tebet, booking karaoke, tempat nongkrong, signature karaoke">
    <meta name="author" content="Masterpiece Signature">

    {{-- Open Graph / Facebook / WhatsApp --}}
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('meta_title', 'Masterpiece Signature Karaoke - Tebet Raya')">
    <meta property="og:description" content="@yield('meta_description', 'Booking ruangan karaoke eksklusif dengan fasilitas premium di Masterpiece Signature Karaoke Tebet. Dapatkan penawaran terbaik hari ini!')">
    <meta property="og:image" content="@yield('meta_image', asset('img/og-masterpiece.jpg'))">
    <meta property="og:site_name" content="Masterpiece Karaoke">

    {{-- Twitter --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('meta_title', 'Masterpiece Signature Karaoke - Tebet Raya')">
    <meta name="twitter:description" content="@yield('meta_description', 'Booking ruangan karaoke eksklusif dengan fasilitas premium.')">
    <meta name="twitter:image" content="@yield('meta_image', asset('img/og-masterpiece.jpg'))">

    @stack('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Outfit:wght@300;400;500;600&display=swap" rel="stylesheet">

    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --bg:        #000000;
            --bg-2:      #0a0a0a;
            --bg-card:   #111111;
            --bg-glass:  rgba(0,0,0,0.85);
            --neon-pink: #FF2D78;
            --neon-purp: #9B30FF;
            --neon-cyan: #00E5FF;
            --gold:      #FFD166;
            --text:      #D4AF37;
            --text-dim:  #A6872B;
            --text-muted:#735D1D;
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
    display: flex;
    align-items: center;
    text-decoration: none;
}
.nav-brand img:hover {
    filter: drop-shadow(0 0 12px rgba(255,45,120,0.5));
}
        .nav-links { display: flex; align-items: center; gap: 0.25rem; }
        .nav-links a {
            font-size: 0.72rem; letter-spacing: 0.18em; text-transform: uppercase;
            color: var(--text-dim); text-decoration: none;
            padding: 0.45rem 0.9rem; transition: all .2s;
            border-bottom: 2px solid transparent;
        }
        .nav-links a:hover, .nav-links a.active { 
            color: var(--text); 
            border-bottom-color: var(--text);
        }
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

        @media(max-width:768px) {
            .hero-title { font-size: 3.5rem; }
            .nav-links { display: none; }
            .section { padding: 4rem 0; }
        }

        /* ── Floating WA ── */
        .float-wa {
            position: fixed;
            bottom: 30px;
            right: 30px;
            background-color: #25d366;
            color: #FFF;
            border-radius: 50px;
            text-align: center;
            font-size: 30px;
            box-shadow: 0 4px 15px rgba(37,211,102,0.4);
            z-index: 9999;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 60px;
            height: 60px;
            text-decoration: none;
            transition: all 0.3s ease;
            animation: pulse-wa 2s infinite;
        }
        .float-wa:hover {
            transform: scale(1.1);
            color: #FFF;
        }
        @keyframes pulse-wa {
            0% { box-shadow: 0 0 0 0 rgba(37,211,102, 0.7); }
            70% { box-shadow: 0 0 0 15px rgba(37,211,102, 0); }
            100% { box-shadow: 0 0 0 0 rgba(37,211,102, 0); }
        }

        /* ── Floating IG ── */
        .float-ig {
            position: fixed;
            bottom: 100px; /* Above WhatsApp */
            right: 30px;
            background: linear-gradient(45deg, #f09433 0%, #e6683c 25%, #dc2743 50%, #cc2366 75%, #bc1888 100%);
            color: #FFF;
            border-radius: 50px;
            text-align: center;
            box-shadow: 0 4px 15px rgba(220,39,67,0.4);
            z-index: 9999;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 60px;
            height: 60px;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        .float-ig:hover {
            transform: scale(1.1);
            color: #FFF;
        }
    </style>
    @stack('styles')
</head>
<body>

<nav class="nav">
<a href="{{ route('home') }}" class="nav-brand">
    <img src="{{ asset('images/logo.png') }}" 
         alt="Masterpiece Signature Karaoke"
         style="height: 44px; width: auto; 
                filter: drop-shadow(0 0 8px rgba(255,45,120,0.2));
                transition: filter .2s;">
</a>    <div class="nav-links">
        <a href="{{ route('home') }}#rooms"    class="">Rooms</a>
        <a href="{{ route('home') }}#packages" class="">Paket</a>
        <a href="{{ route('home') }}#fnb"      class="">F&amp;B</a>
        <a href="{{ route('home') }}#booking"  class="">Reservasi</a>
        <a href="{{ route('home') }}#galeri"   class="">Galeri</a>
        <a href="{{ route('home') }}#info"     class="">Info</a>
        @auth
            <a href="{{ route('admin.rooms.index') }}">Admin</a>
            <form method="POST" action="{{ route('logout') }}" style="display:inline">
                @csrf <button type="submit">Logout</button>
            </form>
        @endauth
    </div>
</nav>

@if(session('success'))
    <div class="flash">✓ &nbsp;{{ session('success') }}</div>
@endif

@yield('content')

<footer class="footer">
    <img src="{{ asset('images/logo.png') }}"
     alt="Masterpiece Signature Karaoke"
     style="height: 60px; width: auto;
            filter: drop-shadow(0 0 12px rgba(255,45,120,0.25));
            display: block; margin: 0 auto 3rem ;">
        {{-- Peta Lokasi --}}
{{-- Peta Lokasi --}}
<div style="width:100%; max-width:700px; margin:0 auto 2rem;">
    <p style="font-size:.6rem;letter-spacing:.28em;text-transform:uppercase;
              color:var(--text-muted);text-align:center;margin-bottom:.85rem;">
        📍 Lokasi Kami
    </p>
    <div style="position:relative;width:100%;height:220px;
                border:1px solid rgba(155,48,255,0.2);
                overflow:hidden;">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d500!2d106.77264690399166!3d-6.233277326850771!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f3945de9de67%3A0xa26d30fb3812e6a2!2sMasterpiece%20Family%20Karaoke%20%26%20Lounge%20Tebet!5e0!3m2!1sid!2sus!4v1774559215138!5m2!1sid!2sus"
            width="100%" height="100%"
            style="border:0;
                   filter:none;
                   display:block;"
            allowfullscreen="" loading="lazy"
            referrerpolicy="no-referrer-when-downgrade">
        </iframe>
        <div style="position:absolute;inset:0;
                    background:rgba(8,8,16,0.15);
                    pointer-events:none;">
        </div>
    </div>
   
</div>
    <p>Jl. Prof. DR. Soepomo No.30, RT.13/RW.2, Tebet, Kota Jakarta Selatan &nbsp;·&nbsp; Buka setiap hari 13.00 – 03.00 WIB</p>
    <p style="margin-top:1.5rem;">
        &copy; {{ date('Y') }} Masterpiece Signature Karaoke Tebet <br>
        <span style="font-size: 0.8em; color: var(--text-muted); display: inline-block; margin-top: 0.5rem;">
            Developed by <a href="https://github.com/12210778-MaulanaAdityaPratama" target="_blank" style="color: var(--neon-pink); text-decoration: none;">servantin</a>
        </span>
    </p>
</footer>

<a href="https://instagram.com/masterpiece.tebet" target="_blank" class="float-ig" title="Follow Kami di Instagram">
    <svg width="32" height="32" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
        <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm3.98-10.169a1.44 1.44 0 100-2.881 1.44 1.44 0 000 2.881z"/>
    </svg>
</a>

<a href="https://wa.me/6287770851998?text=Halo%20Masterpiece%20Tebet,%20saya%20ingin%20bertanya..." target="_blank" class="float-wa" title="Hubungi Kami via WhatsApp">
    <svg width="35" height="35" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 0 0-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413Z"/>
    </svg>
</a>

@stack('scripts')
</body>
</html>
