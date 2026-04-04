<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login — Masterpiece Signature Karaoke</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Outfit:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --bg:        #080810;
            --bg-2:      #0D0D1A;
            --bg-card:   #0F0F1E;
            --neon-pink: #FF2D78;
            --neon-purp: #9B30FF;
            --neon-cyan: #00E5FF;
            --text:      #F0EEF8;
            --text-dim:  #7B78A0;
            --text-muted:#2E2C45;
            --border:    rgba(155,48,255,0.2);
            --ff-display:'Bebas Neue', sans-serif;
            --ff-body:   'Outfit', sans-serif;
        }

        html, body {
            height: 100%;
            background: var(--bg);
            font-family: var(--ff-body);
            font-weight: 300;
            color: var(--text);
            overflow: hidden;
        }

        /* ── Animated background ── */
        .bg-wrap {
            position: fixed; inset: 0; z-index: 0;
            background: var(--bg);
        }
        .bg-orb {
            position: absolute; border-radius: 50%;
            filter: blur(100px); animation: drift 10s ease-in-out infinite alternate;
        }
        .bg-orb-1 {
            width: 600px; height: 600px;
            background: rgba(155,48,255,0.12);
            top: -200px; left: -150px;
        }
        .bg-orb-2 {
            width: 500px; height: 500px;
            background: rgba(255,45,120,0.09);
            bottom: -150px; right: -100px;
            animation-delay: -5s;
        }
        .bg-orb-3 {
            width: 300px; height: 300px;
            background: rgba(0,229,255,0.05);
            top: 50%; left: 50%;
            transform: translate(-50%, -50%);
            animation-delay: -3s;
        }
        @keyframes drift {
            from { transform: translate(0,0) scale(1); }
            to   { transform: translate(40px, 30px) scale(1.1); }
        }

        /* Grid lines */
        .bg-grid {
            position: fixed; inset: 0; z-index: 0;
            background-image:
                linear-gradient(rgba(155,48,255,0.035) 1px, transparent 1px),
                linear-gradient(90deg, rgba(155,48,255,0.035) 1px, transparent 1px);
            background-size: 50px 50px;
        }

        /* ── Layout ── */
        .page {
            position: relative; z-index: 1;
            min-height: 100vh;
            display: flex;
        }

        /* Left panel — branding */
        .left-panel {
            flex: 1;
            display: flex; flex-direction: column;
            align-items: center; justify-content: center;
            padding: 3rem;
            border-right: 1px solid rgba(155,48,255,0.12);
            position: relative;
            animation: fadeLeft .9s ease both;
        }
        @keyframes fadeLeft {
            from { opacity:0; transform: translateX(-30px); }
            to   { opacity:1; transform: translateX(0); }
        }

        .left-logo {
            max-width: 320px; width: 100%;
            margin-bottom: 2.5rem;
            filter: drop-shadow(0 0 40px rgba(255,45,120,0.25));
        }
        .left-tagline {
            font-family: var(--ff-display);
            font-size: 1rem; letter-spacing: 0.4em;
            text-transform: uppercase;
            color: var(--text-dim);
            text-align: center;
            margin-bottom: 3rem;
        }

        /* Vertical stats */
        .left-stats {
            display: flex; flex-direction: column; gap: 1.25rem;
            width: 100%; max-width: 280px;
        }
        .left-stat {
            display: flex; align-items: center;
            gap: 1rem; padding: 0.85rem 1.25rem;
            border: 1px solid rgba(155,48,255,0.12);
            background: rgba(15,15,30,0.6);
        }
        .left-stat-icon { font-size: 1.2rem; }
        .left-stat-label {
            font-size: 0.62rem; letter-spacing: 0.22em; text-transform: uppercase;
            color: var(--text-muted); display: block; margin-bottom: 0.15rem;
        }
        .left-stat-val {
            font-family: var(--ff-display); font-size: 0.95rem;
            letter-spacing: 0.08em; color: var(--text);
        }

        /* Neon vertical line accent */
        .left-panel::after {
            content: '';
            position: absolute; right: -1px; top: 20%; bottom: 20%;
            width: 1px;
            background: linear-gradient(to bottom, transparent, var(--neon-purp), transparent);
        }

        /* Right panel — login form */
        .right-panel {
            width: 480px; flex-shrink: 0;
            display: flex; flex-direction: column;
            align-items: center; justify-content: center;
            padding: 3rem 3.5rem;
            animation: fadeRight .9s .1s ease both;
        }
        @keyframes fadeRight {
            from { opacity:0; transform: translateX(30px); }
            to   { opacity:1; transform: translateX(0); }
        }

        .form-eyebrow {
            font-size: 0.65rem; letter-spacing: 0.38em; text-transform: uppercase;
            color: var(--neon-pink); margin-bottom: 0.6rem;
            display: flex; align-items: center; gap: 0.75rem;
        }
        .form-eyebrow::before, .form-eyebrow::after {
            content: ''; flex: 1; height: 1px;
            background: linear-gradient(to right, transparent, rgba(255,45,120,0.4));
        }
        .form-eyebrow::after {
            background: linear-gradient(to left, transparent, rgba(255,45,120,0.4));
        }

        .form-title {
            font-family: var(--ff-display);
            font-size: 2.8rem; letter-spacing: 0.08em;
            color: var(--text); text-align: center;
            line-height: 1; margin-bottom: 0.5rem;
        }
        .form-title span { color: var(--neon-pink); }

        .form-sub {
            font-size: 0.78rem; color: var(--text-muted);
            text-align: center; margin-bottom: 2.5rem;
            letter-spacing: 0.08em;
        }

        /* ── Flash messages ── */
        .flash {
            width: 100%; padding: 0.85rem 1.1rem;
            margin-bottom: 1.5rem;
            font-size: 0.8rem;
            border-left: 2px solid;
            animation: fadeUp .4s ease both;
        }
        .flash-error {
            background: rgba(255,45,120,0.08);
            border-color: var(--neon-pink);
            color: var(--neon-pink);
        }
        .flash-success {
            background: rgba(80,184,120,0.08);
            border-color: #50B878;
            color: #50B878;
        }
        @keyframes fadeUp {
            from { opacity:0; transform:translateY(10px); }
            to   { opacity:1; transform:translateY(0); }
        }

        /* ── Form fields ── */
        .form-wrap { width: 100%; }

        .field { margin-bottom: 1.25rem; position: relative; }

        .field label {
            display: block;
            font-size: 0.62rem; letter-spacing: 0.25em; text-transform: uppercase;
            color: var(--text-dim); margin-bottom: 0.5rem;
        }

        .field-inner {
            position: relative; display: flex; align-items: center;
        }

        .field-icon {
            position: absolute; left: 1rem;
            font-size: 0.9rem; opacity: 0.4;
            pointer-events: none; z-index: 1;
        }

        .field input {
            width: 100%; padding: 0.85rem 1rem 0.85rem 2.75rem;
            background: rgba(15,15,30,0.8);
            border: 1px solid rgba(155,48,255,0.2);
            color: var(--text);
            font-family: var(--ff-body); font-size: 0.875rem;
            outline: none; transition: border .25s, box-shadow .25s;
            -webkit-appearance: none;
        }
        .field input::placeholder { color: var(--text-muted); }
        .field input:focus {
            border-color: rgba(155,48,255,0.6);
            box-shadow: 0 0 0 3px rgba(155,48,255,0.08);
        }
        .field input:focus ~ .field-glow {
            opacity: 1;
        }
        .field-glow {
            position: absolute; bottom: 0; left: 0; right: 0; height: 1px;
            background: linear-gradient(90deg, transparent, var(--neon-purp), transparent);
            opacity: 0; transition: opacity .25s;
            pointer-events: none;
        }

        /* Remember me */
        .field-row {
            display: flex; align-items: center;
            justify-content: space-between;
            margin-bottom: 1.75rem;
        }
        .checkbox-label {
            display: flex; align-items: center; gap: 0.5rem;
            font-size: 0.78rem; color: var(--text-dim); cursor: pointer;
        }
        .checkbox-label input[type=checkbox] {
            width: 15px; height: 15px;
            accent-color: var(--neon-pink); cursor: pointer;
        }
        .forgot-link {
            font-size: 0.72rem; color: var(--text-muted);
            text-decoration: none; letter-spacing: 0.05em;
            transition: color .2s;
        }
        .forgot-link:hover { color: var(--neon-pink); }

        /* Submit button */
        .btn-login {
            width: 100%; padding: 1rem;
            background: var(--neon-pink);
            border: none; cursor: pointer;
            font-family: var(--ff-display);
            font-size: 1.1rem; letter-spacing: 0.22em;
            color: white;
            box-shadow: 0 0 30px rgba(255,45,120,0.35);
            transition: all .25s; position: relative; overflow: hidden;
        }
        .btn-login::before {
            content: '';
            position: absolute; inset: 0;
            background: linear-gradient(135deg, rgba(255,255,255,0.1), transparent);
            opacity: 0; transition: opacity .25s;
        }
        .btn-login:hover {
            background: #ff4d8a;
            box-shadow: 0 0 50px rgba(255,45,120,0.55);
            transform: translateY(-1px);
        }
        .btn-login:hover::before { opacity: 1; }
        .btn-login:active { transform: translateY(0); }

        /* Back link */
        .back-link {
            display: flex; align-items: center; gap: 0.5rem;
            margin-top: 2rem;
            font-size: 0.7rem; letter-spacing: 0.18em; text-transform: uppercase;
            color: var(--text-muted); text-decoration: none;
            transition: color .2s;
        }
        .back-link:hover { color: var(--text); }
        .back-link::before { content: '←'; }

        /* ── Responsive ── */
        @media(max-width: 900px) {
            .left-panel { display: none; }
            .right-panel { width: 100%; padding: 2rem 1.5rem; }
        }
    </style>
</head>
<body>

<div class="bg-wrap">
    <div class="bg-orb bg-orb-1"></div>
    <div class="bg-orb bg-orb-2"></div>
    <div class="bg-orb bg-orb-3"></div>
</div>
<div class="bg-grid"></div>

<div class="page">

    {{-- ── Left branding panel ── --}}
    <div class="left-panel">
        <img src="{{ asset('images/logo.png') }}"
             alt="Masterpiece Signature Karaoke"
             class="left-logo">

        <p class="left-tagline">Admin Dashboard</p>

        <div class="left-stats">
            <div class="left-stat">
                <span class="left-stat-icon">🎤</span>
                <div>
                    <span class="left-stat-label">Lokasi</span>
                    <span class="left-stat-val">Tebet, Jakarta Selatan</span>
                </div>
            </div>
            <div class="left-stat">
                <span class="left-stat-icon">🕐</span>
                <div>
                    <span class="left-stat-label">Jam Buka</span>
                    <span class="left-stat-val">13.00 – 02.00 WIB</span>
                </div>
            </div>
            <div class="left-stat">
                <span class="left-stat-icon">📞</span>
                <div>
                    <span class="left-stat-label">WhatsApp</span>
                    <a class="left-stat-val" href="https://wa.me/6287770851998">087770851998</a>
                </div>
            </div>
        </div>
    </div>

    {{-- ── Right form panel ── --}}
    <div class="right-panel">

        <div class="form-eyebrow">Admin Access</div>
        <h1 class="form-title">SELAMAT<br><span>DATANG</span></h1>
        <p class="form-sub">Masuk ke panel admin Masterpiece</p>

        {{-- Flash messages --}}
        @if(session('message'))
            <div class="flash flash-error">⚠ &ensp;{{ session('message') }}</div>
        @endif

        @if(session('status'))
            <div class="flash flash-success">✓ &ensp;{{ session('status') }}</div>
        @endif

        <div class="form-wrap">
            <form method="POST" action="{{ route('login') }}">
                @csrf

                {{-- Email --}}
                <div class="field">
                    <label for="email">Email</label>
                    <div class="field-inner">
                        <span class="field-icon">✉</span>
                        <input type="email" id="email" name="email"
                               value="{{ old('email') }}"
                               placeholder="admin@masterpiece.com"
                               required autofocus autocomplete="email">
                        <div class="field-glow"></div>
                    </div>
                    @error('email')
                        <p style="font-size:.72rem;color:var(--neon-pink);margin-top:.4rem;">⚠ {{ $message }}</p>
                    @enderror
                </div>

                {{-- Password --}}
                <div class="field">
                    <label for="password">Password</label>
                    <div class="field-inner">
                        <span class="field-icon">🔒</span>
                        <input type="password" id="password" name="password"
                               placeholder="••••••••"
                               required autocomplete="current-password">
                        <div class="field-glow"></div>
                    </div>
                    @error('password')
                        <p style="font-size:.72rem;color:var(--neon-pink);margin-top:.4rem;">⚠ {{ $message }}</p>
                    @enderror
                </div>

                {{-- Remember + Forgot --}}
                <div class="field-row">
                    <label class="checkbox-label">
                        <input type="checkbox" name="remember">
                        Ingat saya
                    </label>
                    @if(Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="forgot-link">
                            Lupa password?
                        </a>
                    @endif
                </div>

                <button type="submit" class="btn-login">MASUK →</button>
            </form>

            <a href="{{ route('home') }}" class="back-link">
                Kembali ke Website
            </a>
        </div>

    </div>
</div>

</body>
</html>
