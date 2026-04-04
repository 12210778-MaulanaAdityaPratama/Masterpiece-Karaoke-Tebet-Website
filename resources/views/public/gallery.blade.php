@extends('layouts.app')

@section('title', 'Galeri Pengunjung')

@section('meta_title', 'Galeri Pelanggan - Masterpiece Signature Karaoke')
@section('meta_description', 'Lihat momen-momen seru dan keseruan bernyanyi pengunjung setia kami di Masterpiece Signature Karaoke Tebet. Abadikan momen bahagiamu!')

@push('styles')
<style>
    /* ── Gallery Hero ── */
    .gal-hero {
        text-align: center;
        padding: 4rem 2rem 2rem;
    }
    .gal-hero .sec-tag { display: block; margin-bottom: .5rem; }

    /* ── Photo Grid ── */
    .gal-grid {
        columns: 3;
        column-gap: 1rem;
        padding: 2rem 0 4rem;
    }
    @media(max-width:900px){ .gal-grid { columns: 2; } }
    @media(max-width:560px){ .gal-grid { columns: 1; } }

    .gal-card {
        break-inside: avoid;
        margin-bottom: 1rem;
        border-radius: 10px;
        overflow: hidden;
        position: relative;
        cursor: pointer;
        border: 1px solid var(--border);
        transition: transform .25s, box-shadow .25s;
    }
    .gal-card:hover {
        transform: translateY(-4px);
        box-shadow: var(--glow-purp);
    }
    .gal-card img {
        width: 100%;
        display: block;
        object-fit: cover;
    }
    .gal-card-overlay {
        position: absolute; inset: 0;
        background: linear-gradient(to top, rgba(0,0,0,.75) 0%, transparent 55%);
        opacity: 0;
        transition: opacity .25s;
        display: flex; align-items: flex-end;
        padding: 1rem;
    }
    .gal-card:hover .gal-card-overlay { opacity: 1; }
    .gal-card-meta { color: #fff; }
    .gal-card-meta strong { display: block; font-size: .82rem; letter-spacing: .1em; }
    .gal-card-meta span  { font-size: .72rem; color: #ccc; }

    .gal-empty {
        text-align: center;
        padding: 4rem 2rem;
        color: var(--text-muted);
        font-size: .9rem;
    }

    /* ── Submit Form ── */
    .submit-section {
        background: var(--bg-card);
        border: 1px solid var(--border-pink);
        border-radius: 14px;
        padding: 2.5rem;
        max-width: 600px;
        margin: 0 auto 5rem;
    }
    .submit-section h2 {
        font-family: var(--ff-display);
        font-size: 1.8rem;
        letter-spacing: .06em;
        color: var(--text);
        margin-bottom: .25rem;
    }
    .submit-section p.sub {
        font-size: .8rem;
        color: var(--text-muted);
        margin-bottom: 1.75rem;
    }

    .form-group { margin-bottom: 1.2rem; }
    .form-group label {
        display: block;
        font-size: .72rem;
        letter-spacing: .18em;
        text-transform: uppercase;
        color: var(--text-dim);
        margin-bottom: .4rem;
    }
    .form-group input[type="text"],
    .form-group textarea {
        width: 100%;
        background: rgba(255,255,255,.04);
        border: 1px solid var(--border);
        border-radius: 8px;
        color: var(--text);
        font-family: var(--ff-body);
        font-size: .9rem;
        padding: .65rem 1rem;
        transition: border-color .2s;
        outline: none;
    }
    .form-group input:focus,
    .form-group textarea:focus {
        border-color: var(--neon-purp);
    }
    .form-group textarea { min-height: 80px; resize: vertical; }

    /* Custom file input */
    .file-drop {
        border: 2px dashed var(--border-pink);
        border-radius: 10px;
        padding: 2rem;
        text-align: center;
        cursor: pointer;
        transition: border-color .2s, background .2s;
        position: relative;
    }
    .file-drop:hover { border-color: var(--neon-pink); background: rgba(255,45,120,.04); }
    .file-drop input[type="file"] {
        position: absolute; inset: 0;
        opacity: 0; cursor: pointer; width: 100%; height: 100%;
    }
    .file-drop-icon { font-size: 2rem; margin-bottom: .5rem; }
    .file-drop p { font-size: .8rem; color: var(--text-dim); margin: 0; }
    .file-drop p strong { color: var(--neon-pink); }
    #file-name { font-size: .75rem; color: var(--text-muted); margin-top: .5rem; }

    .btn-submit {
        display: inline-block;
        background: linear-gradient(135deg, var(--neon-pink), var(--neon-purp));
        color: #fff;
        border: none;
        border-radius: 8px;
        padding: .75rem 2rem;
        font-family: var(--ff-body);
        font-size: .82rem;
        letter-spacing: .2em;
        text-transform: uppercase;
        cursor: pointer;
        transition: opacity .2s, transform .2s;
        margin-top: .5rem;
    }
    .btn-submit:hover { opacity: .85; transform: translateY(-2px); }

    .err { font-size: .75rem; color: var(--neon-pink); margin-top: .35rem; }

    /* ── Lightbox ── */
    .lightbox {
        display: none; position: fixed; inset: 0; z-index: 999;
        background: rgba(0,0,0,.92);
        align-items: center; justify-content: center;
        flex-direction: column;
        padding: 2rem;
    }
    .lightbox.open { display: flex; }
    .lightbox img {
        max-width: 90vw; max-height: 80vh;
        border-radius: 10px;
        box-shadow: 0 0 40px rgba(155,48,255,.4);
    }
    .lightbox-close {
        position: absolute; top: 1.25rem; right: 1.5rem;
        font-size: 2rem; color: #fff; cursor: pointer; line-height: 1;
    }
    .lightbox-caption {
        margin-top: 1rem; font-size: .85rem; color: #ccc; text-align: center;
    }
</style>
@endpush

@section('content')
<div class="container">

    {{-- Hero --}}
    <div class="gal-hero">
        <span class="sec-tag">✦ Momen Bersama Kami</span>
        <h1 class="sec-title">Gale<span>ri</span></h1>
        <p style="color:var(--text-dim);font-size:.88rem;margin-top:.75rem;max-width:500px;margin-inline:auto;">
            Kiriman foto dari pelanggan setia Masterpiece Karaoke. Abadikan momentmu bersama kami!
        </p>
    </div>

    <div class="neon-line" style="margin-bottom:2.5rem;"></div>

    {{-- Flash message --}}
    @if(session('success'))
        <div class="flash" style="border-radius:8px;margin-bottom:2rem;">✓ &nbsp;{{ session('success') }}</div>
    @endif

    {{-- Photo Grid --}}
    @if($photos->count())
        <div class="gal-grid">
            @foreach($photos as $photo)
                <div class="gal-card" onclick="openLightbox('{{ Storage::url($photo->image_path) }}','{{ addslashes($photo->caption ?? '') }}','{{ addslashes($photo->submitter_name) }}')">
                    <img src="{{ Storage::url($photo->image_path) }}" alt="{{ $photo->caption ?? 'Foto galeri' }}" loading="lazy">
                    <div class="gal-card-overlay">
                        <div class="gal-card-meta">
                            <strong>{{ $photo->submitter_name }}</strong>
                            @if($photo->caption)
                                <span>{{ $photo->caption }}</span>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="gal-empty">
            <p style="font-size:3rem;margin-bottom:1rem;">📷</p>
            <p>Belum ada foto di galeri. Jadilah yang pertama mengirim!</p>
        </div>
    @endif

    <div class="neon-line" style="margin-bottom:3rem;"></div>

    {{-- Submit Form --}}
    <div class="submit-section">
        <h2>Kirim <span style="color:var(--neon-pink)">Fotomu</span></h2>
        <p class="sub">Foto kamu akan muncul di galeri setelah disetujui admin.</p>

        <form method="POST" action="{{ route('gallery.submit') }}" enctype="multipart/form-data" id="gallery-form">
            @csrf

            <div class="form-group">
                <label>Namamu (opsional)</label>
                <input type="text" name="submitter_name" value="{{ old('submitter_name') }}"
                       placeholder="Cth: Budi, atau kosongkan untuk Anonim">
                @error('submitter_name')<div class="err">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label>Caption (opsional)</label>
                <textarea name="caption" placeholder="Ceritakan momenmu…">{{ old('caption') }}</textarea>
                @error('caption')<div class="err">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label>Pilih Foto *</label>
                <div class="file-drop" id="file-drop-zone">
                    <input type="file" name="image" accept="image/jpeg,image/png,image/webp"
                           id="image-input" onchange="updateFileName(this)">
                    <div class="file-drop-icon">📸</div>
                    <p><strong>Klik untuk pilih foto</strong> atau seret ke sini</p>
                    <p>Format: JPG, PNG, WebP · Maks 5 MB</p>
                    <div id="file-name"></div>
                </div>
                @error('image')<div class="err">{{ $message }}</div>@enderror
            </div>

            <button type="submit" class="btn-submit">✦ Kirim Foto</button>
        </form>
    </div>

</div>

{{-- Lightbox --}}
<div class="lightbox" id="lightbox" onclick="closeLightbox()">
    <span class="lightbox-close" id="lb-close">&times;</span>
    <img id="lb-img" src="" alt="">
    <div class="lightbox-caption" id="lb-caption"></div>
</div>
@endsection

@push('scripts')
<script>
function openLightbox(src, caption, name) {
    document.getElementById('lb-img').src = src;
    const capEl = document.getElementById('lb-caption');
    capEl.textContent = caption ? `${caption} — ${name}` : name;
    document.getElementById('lightbox').classList.add('open');
}
function closeLightbox() {
    document.getElementById('lightbox').classList.remove('open');
}
document.addEventListener('keydown', e => { if(e.key === 'Escape') closeLightbox(); });

function updateFileName(input) {
    const nameEl = document.getElementById('file-name');
    nameEl.textContent = input.files.length ? '📎 ' + input.files[0].name : '';
}
</script>
@endpush
