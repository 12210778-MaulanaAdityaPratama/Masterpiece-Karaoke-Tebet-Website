@extends('layouts.app')
@section('title', 'Masterpiece Signature Karaoke – Tebet')

@push('styles')
<style>
/* ══════════════════════════════════════════════
   HERO
══════════════════════════════════════════════ */

/* Tier */
.pkg-duration-chip { display:inline-flex;align-items:center;gap:.3rem;font-size:.65rem;letter-spacing:.15em;text-transform:uppercase;color:var(--neon-pink);border:1px solid rgba(255,45,120,0.3);padding:.2em .7em; }
.tier-selector { padding:1.25rem 1.75rem;border-bottom:1px solid rgba(255,255,255,0.05); }
.tier-selector-label { font-size:.6rem;letter-spacing:.28em;text-transform:uppercase;color:var(--text-muted);display:block;margin-bottom:.6rem; }
.tier-tabs { display:flex;gap:.5rem;flex-wrap:wrap; }
.tier-tab { display:flex;align-items:center;gap:.4rem;padding:.45rem 1rem;border:1px solid rgba(255,255,255,0.08);background:transparent;cursor:pointer;font-family:var(--ff-display);font-size:1rem;letter-spacing:.1em;color:var(--text-dim);transition:all .2s; }
.tier-tab .tier-dot { width:8px;height:8px;border-radius:50%;flex-shrink:0; }
.tier-tab.active { color:var(--text);background:rgba(255,255,255,0.04); }
.tier-panels { position:relative; }
.tier-panel { display:none;padding:1.25rem 1.75rem 0; }
.tier-panel.active { display:block; }
.tier-badge-row { display:flex;align-items:center;gap:.75rem;margin-bottom:.75rem; }
.tier-name-badge { font-family:var(--ff-display);font-size:1.35rem;letter-spacing:.1em;padding:.1em .6em; }
.tier-badge-label { font-size:.6rem;letter-spacing:.2em;text-transform:uppercase;color:var(--neon-pink);border:1px solid rgba(255,45,120,0.35);padding:.22em .7em; }
.tier-include-row { display:flex;align-items:center;justify-content:space-between;padding:.5rem 0;border-bottom:1px solid rgba(255,255,255,0.04);gap:1rem; }
.tier-include-row:last-child { border-bottom:none; }
.tier-include-name { font-size:.84rem;color:var(--text); }
.tier-include-qty { font-size:.78rem;color:var(--text-dim);white-space:nowrap;font-style:italic; }
.tier-price { font-family:var(--ff-display);font-size:2rem;letter-spacing:.04em;line-height:1; }
.pkg-card:hover img { opacity: 1; transform: scale(1.03); }
@keyframes fadeIn {
    from { opacity:0; }
    to   { opacity:1; }
}
.pkg-card:hover .zoom-hint { opacity: 1 !important; }
.hero {
    position: relative; min-height: 100vh;
    display: flex; flex-direction: column;
    align-items: center; justify-content: center;
    text-align: center; overflow: hidden;
    padding: 6rem 2rem 4rem;
}
.hero-bg {
    position: absolute; inset: 0;
    background:
        radial-gradient(ellipse at 20% 50%, rgba(155,48,255,0.18) 0%, transparent 55%),
        radial-gradient(ellipse at 80% 30%, rgba(255,45,120,0.14) 0%, transparent 50%),
        radial-gradient(ellipse at 50% 100%, rgba(0,229,255,0.06) 0%, transparent 60%),
        var(--bg);
}
/* Animated spotlight orbs */
.hero-orb {
    position: absolute; border-radius: 50%;
    filter: blur(80px); animation: orb-drift 8s ease-in-out infinite alternate;
}
.hero-orb-1 {
    width: 400px; height: 400px;
    background: rgba(155,48,255,0.12);
    top: -100px; left: -100px;
    animation-delay: 0s;
}
.hero-orb-2 {
    width: 300px; height: 300px;
    background: rgba(255,45,120,0.10);
    top: 40%; right: -80px;
    animation-delay: -3s;
}
.hero-orb-3 {
    width: 250px; height: 250px;
    background: rgba(0,229,255,0.06);
    bottom: 0; left: 30%;
    animation-delay: -5s;
}
@keyframes orb-drift {
    from { transform: translate(0, 0) scale(1); }
    to   { transform: translate(30px, 20px) scale(1.1); }
}
/* Grid lines overlay */
.hero-grid {
    position: absolute; inset: 0;
    background-image:
        linear-gradient(rgba(155,48,255,0.04) 1px, transparent 1px),
        linear-gradient(90deg, rgba(155,48,255,0.04) 1px, transparent 1px);
    background-size: 50px 50px;
}

.hero-content { position: relative; z-index: 1; max-width: 900px; }

.hero-badge {
    display: inline-flex; align-items: center; gap: 0.5rem;
    font-size: 0.68rem; letter-spacing: 0.35em; text-transform: uppercase;
    color: var(--neon-pink);
    border: 1px solid rgba(255,45,120,0.3);
    padding: 0.4em 1.1em; margin-bottom: 2rem;
    animation: fadeUp 1s ease both;
}
.hero-badge::before, .hero-badge::after {
    content: '✦'; font-size: 0.5rem;
}

.hero-title {
    font-family: var(--ff-display);
    font-size: clamp(3.5rem, 11vw, 9rem);
    letter-spacing: 0.05em; line-height: 0.95;
    color: var(--text); margin-bottom: 0.2rem;
    animation: fadeUp 1s .1s ease both;
}
.hero-title .pink  { color: var(--neon-pink); text-shadow: var(--glow-pink); }
.hero-title .purp  { color: var(--neon-purp); text-shadow: var(--glow-purp); }
.hero-subtitle-line {
    font-family: var(--ff-display);
    font-size: clamp(1.1rem, 3vw, 2rem);
    letter-spacing: 0.25em; color: var(--text-dim);
    margin-bottom: 2.5rem;
    animation: fadeUp 1s .2s ease both;
}
.hero-desc {
    font-size: 0.9rem; color: var(--text-dim);
    max-width: 480px; margin: 0 auto 3rem;
    animation: fadeUp 1s .3s ease both;
}
.hero-cta-row {
    display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;
    animation: fadeUp 1s .4s ease both;
}
.btn-neon {
    display: inline-block;
    font-family: var(--ff-body); font-size: 0.78rem;
    letter-spacing: 0.2em; text-transform: uppercase;
    padding: 0.85rem 2rem; text-decoration: none;
    transition: all .25s; cursor: pointer; border: none;
}
.btn-neon-pink {
    background: var(--neon-pink); color: #fff;
    box-shadow: 0 0 25px rgba(255,45,120,0.4);
}
.btn-neon-pink:hover {
    background: #ff5090;
    box-shadow: 0 0 40px rgba(255,45,120,0.6);
    transform: translateY(-2px);
}
.btn-neon-outline {
    background: transparent;
    border: 1px solid rgba(155,48,255,0.5); color: var(--neon-purp);
}
.btn-neon-outline:hover {
    background: rgba(155,48,255,0.1);
    border-color: var(--neon-purp);
    box-shadow: var(--glow-purp);
    transform: translateY(-2px);
}

/* Hours badge strip */
.hero-info-strip {
    position: absolute; bottom: 0; left: 0; right: 0;
    background: rgba(15,15,30,0.9);
    border-top: 1px solid var(--border);
    backdrop-filter: blur(10px);
    display: flex; justify-content: center; gap: 0;
    z-index: 1;
}
.hero-info-item {
    padding: 1rem 2.5rem;
    border-right: 1px solid var(--border);
    text-align: center;
}
.hero-info-item:last-child { border-right: none; }
.hero-info-label {
    font-size: 0.6rem; letter-spacing: 0.25em; text-transform: uppercase;
    color: var(--text-muted); display: block; margin-bottom: 0.2rem;
}
.hero-info-val {
    font-family: var(--ff-display); font-size: 1rem;
    letter-spacing: 0.1em; color: var(--text);
}
.hero-info-val span { color: var(--neon-pink); }

@keyframes fadeUp {
    from { opacity: 0; transform: translateY(28px); }
    to   { opacity: 1; transform: translateY(0); }
}

/* ══════════════════════════════════════════════
   ROOMS
══════════════════════════════════════════════ */
.section { padding: 5rem 0; }

.type-badge {
    font-size: 0.6rem; letter-spacing: 0.22em; text-transform: uppercase;
    padding: 0.25em 0.8em;
    border: 1px solid;
}
.type-small  { color: var(--neon-cyan);  border-color: rgba(0,229,255,0.4); }
.type-medium { color: var(--neon-purp);  border-color: rgba(155,48,255,0.4); }
.type-large  { color: var(--gold);       border-color: rgba(255,209,102,0.4); }
.type-vip    { color: var(--neon-pink);  border-color: rgba(255,45,120,0.5); background: rgba(255,45,120,0.08); }

.rooms-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 1.5rem; margin-top: 3rem;
}
.room-card {
    background: var(--bg-card);
    border: 1px solid var(--border);
    overflow: hidden; position: relative;
    transition: border-color .3s, transform .3s, box-shadow .3s;
}
.room-card:hover {
    border-color: rgba(155,48,255,0.5);
    transform: translateY(-5px);
    box-shadow: 0 15px 40px rgba(155,48,255,0.12);
}
.room-img-wrap {
    height: 180px; overflow: hidden; position: relative;
    background: linear-gradient(135deg, #0f0f1e, #1a1a2e);
    display: flex; align-items: center; justify-content: center;
}
.room-img-wrap img { width: 100%; height: 100%; object-fit: cover; opacity: 0.75; transition: opacity .3s; }
.room-card:hover .room-img-wrap img { opacity: 0.95; }
.room-img-placeholder {
    font-family: var(--ff-display); font-size: 3.5rem; letter-spacing: 0.05em;
    color: var(--neon-purp); opacity: 0.3;
}
.room-type-chip {
    position: absolute; top: 0.75rem; left: 0.75rem;
}
.room-body { padding: 1.4rem 1.5rem 1.75rem; }
.room-name {
    font-family: var(--ff-display); font-size: 1.5rem; letter-spacing: 0.06em;
    color: var(--text); margin: 0.6rem 0 0.4rem;
}
.room-cap {
    font-size: 0.75rem; color: var(--text-dim); margin-bottom: 1rem;
    display: flex; align-items: center; gap: 0.4rem;
}
.room-cap::before { content: '👥'; font-size: 0.85rem; }

.price-table { width: 100%; border-collapse: collapse; margin-bottom: 1rem; }
.price-table td { padding: 0.45rem 0; font-size: 0.82rem; }
.price-table td:first-child { color: var(--text-dim); }
.price-table td:last-child {
    font-family: var(--ff-display); font-size: 1.05rem;
    letter-spacing: 0.05em; text-align: right;
}
.price-table .weekday td:last-child { color: var(--neon-purp); }
.price-table .weekend td:last-child { color: var(--neon-pink); }
.price-table tr { border-bottom: 1px solid rgba(255,255,255,0.04); }
.price-table tr:last-child { border-bottom: none; }

.facilities-list {
    display: flex; flex-wrap: wrap; gap: 0.35rem; margin-top: 0.75rem;
}
.fac-chip {
    font-size: 0.65rem; padding: 0.2em 0.6em;
    background: rgba(155,48,255,0.08);
    border: 1px solid rgba(155,48,255,0.15);
    color: var(--text-dim); letter-spacing: 0.05em;
}

/* ══════════════════════════════════════════════
   PACKAGES
══════════════════════════════════════════════ */
.pkg-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(270px, 1fr));
    gap: 1.5rem; margin-top: 3rem;
}
.pkg-card {
    background: var(--bg-card);
    border: 1px solid var(--border-pink);
    position: relative; overflow: hidden;
    display: flex; flex-direction: column;
    transition: border-color .3s, transform .3s, box-shadow .3s;
}
.pkg-card.featured {
    border-color: rgba(255,45,120,0.45);
    box-shadow: 0 0 30px rgba(255,45,120,0.08);
}
.pkg-card:hover {
    border-color: rgba(255,45,120,0.65);
    transform: translateY(-5px);
    box-shadow: 0 15px 40px rgba(255,45,120,0.15);
}
/* Neon top bar */
.pkg-card::before {
    content: '';
    position: absolute; top: 0; left: 0; right: 0; height: 2px;
    background: linear-gradient(90deg, transparent, var(--neon-pink), transparent);
    opacity: 0; transition: opacity .3s;
}
.pkg-card.featured::before, .pkg-card:hover::before { opacity: 1; }

.pkg-badge-strip {
    background: rgba(255,45,120,0.12);
    border-bottom: 1px solid rgba(255,45,120,0.2);
    padding: 0.5rem 1.5rem;
    font-size: 0.62rem; letter-spacing: 0.25em; text-transform: uppercase;
    color: var(--neon-pink);
    display: flex; align-items: center; gap: 0.5rem;
}
.pkg-badge-strip::before { content: '★'; }

.pkg-header { padding: 1.5rem 1.5rem 1rem; }
.pkg-name {
    font-family: var(--ff-display); font-size: 1.7rem;
    letter-spacing: 0.06em; color: var(--text);
    margin-bottom: 0.4rem;
}
.pkg-meta {
    display: flex; gap: 1rem; font-size: 0.72rem;
    color: var(--text-dim); margin-bottom: 0.75rem; flex-wrap: wrap;
}
.pkg-meta span { display: flex; align-items: center; gap: 0.3rem; }
.pkg-desc { font-size: 0.8rem; color: var(--text-dim); line-height: 1.65; }

.pkg-includes {
    padding: 0 1.5rem 1.5rem; flex: 1;
}
.pkg-includes-label {
    font-size: 0.6rem; letter-spacing: 0.3em; text-transform: uppercase;
    color: var(--text-muted); margin-bottom: 0.75rem; display: block;
}
.pkg-include-item {
    display: flex; align-items: center; gap: 0.6rem;
    font-size: 0.82rem; color: var(--text-dim);
    padding: 0.4rem 0;
    border-bottom: 1px solid rgba(255,255,255,0.04);
}
.pkg-include-item:last-child { border-bottom: none; }
.pkg-include-item::before {
    content: '✓'; color: var(--neon-pink);
    font-size: 0.75rem; flex-shrink: 0; font-weight: 600;
}

.pkg-footer {
    padding: 1.25rem 1.5rem;
    border-top: 1px solid rgba(255,255,255,0.05);
    background: rgba(255,45,120,0.03);
    display: flex; align-items: center; justify-content: space-between;
}
.pkg-price {
    font-family: var(--ff-display); font-size: 1.9rem;
    letter-spacing: 0.04em; color: var(--neon-pink);
    line-height: 1;
}
.pkg-price-sub {
    font-size: 0.68rem; color: var(--text-muted);
    letter-spacing: 0.1em; margin-top: 0.2rem;
}
.btn-book {
    font-family: var(--ff-body); font-size: 0.72rem;
    letter-spacing: 0.18em; text-transform: uppercase;
    padding: 0.6rem 1.2rem; text-decoration: none;
    background: transparent;
    border: 1px solid rgba(255,45,120,0.4);
    color: var(--neon-pink); cursor: pointer;
    transition: all .2s; white-space: nowrap;
}
.btn-book:hover {
    background: var(--neon-pink); color: white;
    box-shadow: var(--glow-pink);
}

/* ══════════════════════════════════════════════
   F&B MENU
══════════════════════════════════════════════ */
.fnb-tabs {
    display: flex; gap: 0; flex-wrap: wrap;
    margin: 2.5rem 0 0;
    border-bottom: 1px solid var(--border);
}
.fnb-tab {
    font-size: 0.75rem; letter-spacing: 0.15em; text-transform: uppercase;
    padding: 0.75rem 1.5rem; cursor: pointer;
    color: var(--text-dim); background: none; border: none;
    font-family: var(--ff-body);
    border-bottom: 2px solid transparent;
    transition: all .2s; margin-bottom: -1px;
    display: flex; align-items: center; gap: 0.4rem;
}
.fnb-tab.active { color: var(--neon-pink); border-bottom-color: var(--neon-pink); }
.fnb-tab:hover:not(.active) { color: var(--text); }
.fnb-tab .tab-icon { font-size: 1rem; }

.fnb-panel { display: none; padding: 2rem 0; }
.fnb-panel.active { display: block; }

.fnb-list { display: flex; flex-direction: column; }
.fnb-item {
    display: grid; grid-template-columns: 1fr auto;
    align-items: center; gap: 1.5rem;
    padding: 1rem 0;
    border-bottom: 1px solid rgba(255,255,255,0.04);
    transition: padding .2s;
}
.fnb-item:last-child { border-bottom: none; }
.fnb-item:hover { padding-left: 0.75rem; }
.fnb-item-name {
    font-size: 0.92rem; color: var(--text); margin-bottom: 0.15rem;
    display: flex; align-items: center; gap: 0.6rem;
}
.fnb-item-desc { font-size: 0.77rem; color: var(--text-dim); }
.fnb-item-price {
    font-family: var(--ff-display); font-size: 1.1rem;
    letter-spacing: 0.06em; color: var(--neon-purp);
    white-space: nowrap;
}
.fnb-badge {
    font-size: 0.58rem; letter-spacing: 0.15em; text-transform: uppercase;
    padding: 0.2em 0.6em;
    border: 1px solid rgba(255,45,120,0.4); color: var(--neon-pink);
}
.fnb-item.unavail { opacity: 0.35; }

/* ══════════════════════════════════════════════
   INFO SECTION
══════════════════════════════════════════════ */
.info-grid {
    display: grid; grid-template-columns: 1fr 1fr;
    gap: 1.5rem; margin-top: 3rem;
}
.info-card {
    background: var(--bg-card);
    border: 1px solid var(--border);
    padding: 2rem;
}
.info-card-title {
    font-family: var(--ff-display); font-size: 1.2rem;
    letter-spacing: 0.1em; color: var(--neon-purp);
    margin-bottom: 1.25rem;
    display: flex; align-items: center; gap: 0.6rem;
}
.info-row {
    display: flex; justify-content: space-between;
    padding: 0.6rem 0;
    border-bottom: 1px solid rgba(255,255,255,0.04);
    font-size: 0.85rem;
}
.info-row:last-child { border-bottom: none; }
.info-row .label { color: var(--text-dim); }
.info-row .val   { color: var(--text); font-weight: 500; }
.info-row .val.hot { color: var(--neon-pink); }

@media(max-width: 768px){
    .rooms-grid, .pkg-grid { grid-template-columns: 1fr; }
    .info-grid { grid-template-columns: 1fr; }
    .hero-info-strip { flex-direction: column; }
    .hero-info-item { flex: none; border-right: none; border-bottom: 1px solid var(--border); padding: 0.75rem 2rem; }
    .hero-info-item:last-child { border-bottom: none; }
    .fnb-tabs { overflow-x: auto; }
    
    .info-row { flex-direction: column; align-items: flex-start; gap: 0.4rem; padding: 0.8rem 0; }
    .info-row .val { text-align: left; }
}

@media(min-width: 992px) {
    .fnb-list {
        display: grid;
        grid-template-columns: 1fr 1fr;
        column-gap: 4rem;
        align-items: start;
    }
}

.fnb-item.hidden { display: none; }
.btn-fnb-more {
    display: block;
    margin: 2.5rem auto 0;
    font-family: var(--ff-body);
    font-size: 0.72rem;
    letter-spacing: 0.2em;
    text-transform: uppercase;
    color: var(--neon-pink);
    background: transparent;
    border: 1px solid rgba(255,45,120,0.4);
    padding: 0.8rem 2.2rem;
    cursor: pointer;
    transition: all .25s;
}
.btn-fnb-more:hover {
    background: rgba(255,45,120,0.1);
    box-shadow: 0 0 20px rgba(255,45,120,0.2);
    border-color: var(--neon-pink);
}

/* ══════════════════════════════════════════════
   GALLERY PREVIEW
══════════════════════════════════════════════ */
.gal-preview-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 1rem;
    margin-top: 2.5rem;
}
@media(max-width:768px){ .gal-preview-grid { grid-template-columns: repeat(2,1fr); } }
@media(max-width:480px){ .gal-preview-grid { grid-template-columns: 1fr; } }

.gal-prev-item {
    position: relative; border-radius: 10px; overflow: hidden;
    aspect-ratio: 4/3;
    border: 1px solid var(--border);
    cursor: pointer;
    transition: transform .25s, box-shadow .25s;
}
.gal-prev-item:hover {
    transform: translateY(-4px);
    box-shadow: 0 0 20px rgba(155,48,255,0.3);
}
.gal-prev-item img {
    width: 100%; height: 100%;
    object-fit: cover;
    transition: transform .35s;
}
.gal-prev-item:hover img { transform: scale(1.06); }
.gal-prev-overlay {
    position: absolute; inset: 0;
    background: linear-gradient(to top, rgba(0,0,0,.7) 0%, transparent 55%);
    opacity: 0; transition: opacity .25s;
    display: flex; align-items: flex-end; padding: .75rem;
}
.gal-prev-item:hover .gal-prev-overlay { opacity: 1; }
.gal-prev-caption {
    font-size: .72rem; color: #fff;
    white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
}

.gal-see-all {
    display: inline-flex; align-items: center; gap: .5rem;
    margin-top: 2.25rem;
    font-size: .78rem; letter-spacing: .2em; text-transform: uppercase;
    color: var(--neon-purp);
    border: 1px solid rgba(155,48,255,0.4);
    padding: .65rem 1.75rem;
    text-decoration: none;
    transition: all .2s;
}
.gal-see-all:hover {
    background: rgba(155,48,255,0.1);
    box-shadow: 0 0 20px rgba(155,48,255,0.3);
    border-color: var(--neon-purp);
    transform: translateY(-2px);
}
.gal-empty-mini {
    text-align: center;
    padding: 3rem 2rem;
    color: var(--text-muted);
    font-size: .85rem;
    border: 1px dashed var(--border);
    border-radius: 10px;
    margin-top: 2rem;
}
/* ══════════════════════════════════════════════
   BOOKING FORM
══════════════════════════════════════════════ */
.book-section {
    background: var(--bg-card);
    border: 1px solid var(--border-pink);
    border-radius: 14px;
    padding: 3rem;
    max-width: 800px;
    margin: 4rem auto 0;
    position: relative;
    overflow: hidden;
}
.book-section::before {
    content: ''; position: absolute; top: 0; left: 0; right: 0; height: 3px;
    background: linear-gradient(90deg, var(--neon-pink), var(--neon-purp));
}
.book-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 1.25rem; }
.book-full { grid-column: 1 / -1; }
.book-group label {
    display: block; font-size: .65rem; letter-spacing: .2em;
    text-transform: uppercase; color: var(--text-dim); margin-bottom: .4rem;
}
.book-group input, .book-group select, .book-group textarea {
    width: 100%; background: rgba(255,255,255,.04);
    border: 1px solid var(--border); border-radius: 8px;
    color: var(--text); font-family: var(--ff-body); font-size: .9rem;
    padding: .75rem 1rem; transition: border .2s; outline: none; appearance: none;
}
/* custom select arrow */
.book-group select {
    background-image: url("data:image/svg+xml;charset=US-ASCII,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%22292.4%22%20height%3D%22292.4%22%3E%3Cpath%20fill%3D%22%237B78A0%22%20d%3D%22M287%2069.4a17.6%2017.6%200%200%200-13-5.4H18.4c-5%200-9.3%201.8-12.9%205.4A17.6%2017.6%200%200%200%200%2082.2c0%205%201.8%209.3%205.4%2012.9l128%20127.9c3.6%203.6%207.8%205.4%2012.8%205.4s9.2-1.8%2012.8-5.4L287%2095c3.5-3.5%205.4-7.8%205.4-12.8%200-5-1.9-9.2-5.5-12.8z%22%2F%3E%3C%2Fsvg%3E");
    background-repeat: no-repeat; background-position: right 1rem top 50%; background-size: .65rem auto;
}
.book-group input:focus, .book-group select:focus, .book-group textarea:focus { border-color: var(--neon-pink); }
.book-group .err { font-size: .7rem; color: var(--neon-pink); margin-top: .3rem; }
.btn-submit-book {
    width: 100%; display: flex; align-items: center; justify-content: center; gap: .5rem;
    background: linear-gradient(135deg, var(--neon-pink), var(--neon-purp));
    color: #fff; border: none; border-radius: 8px;
    padding: 1rem; font-family: var(--ff-body); font-size: .85rem; letter-spacing: .2em;
    text-transform: uppercase; cursor: pointer; transition: transform .2s, box-shadow .2s;
    margin-top: 1rem;
}
.btn-submit-book:hover { transform: translateY(-2px); box-shadow: 0 0 25px rgba(255,45,120,.4); }
@media(max-width:768px){ .book-grid { grid-template-columns: 1fr; } .book-section { padding: 2rem 1.5rem; } }
</style>
@endpush

@section('content')

{{-- ══ HERO ══ --}}
<section class="hero">
    <div class="hero-bg">
        <div class="hero-orb hero-orb-1"></div>
        <div class="hero-orb hero-orb-2"></div>
        <div class="hero-orb hero-orb-3"></div>
    </div>
    <div class="hero-grid"></div>

    <div class="hero-content">
        <div class="hero-badge">Masterpiece · Tebet · Jakarta Selatan</div>
        <img src="{{ asset('images/logo.png') }}" 
     alt="Masterpiece Signature Karaoke"
     style="display:block; max-width: 480px; width: 85%; margin: 0 auto 1.5rem;
            filter: drop-shadow(0 0 30px rgba(255,45,120,0.3));
            animation: fadeUp 1s .1s ease both;">
        <p class="hero-subtitle-line">KARAOKE &amp; LOUNGE</p>
        <p class="hero-desc">
            Nikmati pengalaman karaoke terbaik bersama keluarga dan sahabat.
            Room premium, audio berkualitas, dan suasana yang tak terlupakan.
        </p>
        <div class="hero-cta-row">
            <a href="#packages" class="btn-neon btn-neon-pink">Lihat Paket</a>
            <a href="#rooms"    class="btn-neon btn-neon-outline">Pilih Room</a>
        </div>
    </div>
    

    <div class="hero-info-strip">
        <div class="hero-info-item">
            <span class="hero-info-label">Buka</span>
            <span class="hero-info-val">Setiap Hari</span>
        </div>
        <div class="hero-info-item">
            <span class="hero-info-label">Jam Operasional</span>
            <span class="hero-info-val"><span>13.00</span> – 03.00 WIB</span>
        </div>
        <div class="hero-info-item">
            <span class="hero-info-label">Lokasi</span>
            <span class="hero-info-val">Jl. Prof. DR. Soepomo No.30, RT.13/RW.2, Tebet, Kota Jakarta Selatan</span>
        </div>
        <div class="hero-info-item">
            <span class="hero-info-label">Reservasi</span>
            <span class="hero-info-val">WhatsApp : 087770851998 / Walk-in</span>
        </div>
    </div>
</section>

<div class="neon-line"></div>

{{-- ══ ROOMS ══ --}}
<section class="section" id="rooms">
    <div class="container">
        <span class="sec-tag">Price List</span>
        <h2 class="sec-title">Pilihan <span>Room</span></h2>
        <p style="margin-top:.75rem;font-size:.85rem;color:var(--text-dim);max-width:500px;">
            Semua harga per jam. Weekday: Minggu–Rabu. Weekend: Kamis–Sabtu &amp; Hari Libur.
        </p>

        <div class="rooms-grid">
            @foreach($rooms as $room)
            <div class="room-card">
                <div class="room-img-wrap">
                    @if($room->image)
                        <img src="{{ $room->image_url }}" alt="{{ $room->name }}">
                    @else
                        <div class="room-img-placeholder">{{ strtoupper($room->type) }}</div>
                    @endif
                    <div class="room-type-chip">
                        <span class="type-badge type-{{ $room->type }}">{{ $room->getTypeLabel() }}</span>
                    </div>
                </div>
                <div class="room-body">
                    <div class="room-name">{{ $room->name }}</div>
                    <div class="room-cap">{{ $room->getCapacityLabel() }}</div>

                    <table class="price-table">
                        <tr class="weekday">
                            <td>Weekday / jam</td>
                            <td>{{ $room->formatted_weekday }}</td>
                        </tr>
                        <tr class="weekend">
                            <td>Weekend / jam</td>
                            <td>{{ $room->formatted_weekend }}</td>
                        </tr>
                    </table>

                    @if($room->description)
                        <p style="font-size:.78rem;color:var(--text-dim);margin-bottom:.75rem;line-height:1.6;">
                            {{ $room->description }}
                        </p>
                    @endif

                    @if(!empty($room->facilities))
                        <div class="facilities-list">
                            @foreach($room->facilities as $fac)
                                <span class="fac-chip">{{ $fac }}</span>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<div class="neon-line"></div>

{{-- ══ PACKAGES ══ --}}
<section class="section" id="packages">
    <div class="container">
        <span class="sec-tag">Special Offers</span>
        <h2 class="sec-title">Paket <span>Karaoke</span></h2>
        <p style="margin-top:.75rem;font-size:.85rem;color:var(--text-dim);max-width:500px;">
            Pilih tier yang sesuai budget Anda. Setiap paket sudah termasuk sewa room dan berbagai item pilihan.
        </p>

        <div class="pkg-grid">
            @foreach($packages as $pkg)
            @php $firstTier = $pkg->activeTiers->first(); @endphp
            @if(!$firstTier) @continue @endif

            <div class="pkg-card" id="pkg-{{ $pkg->id }}">
                {{-- ← GAMBAR PAKET --}}
           @if($pkg->image_url)
<div style="width:100%;height:200px;overflow:hidden;position:relative;cursor:pointer;"
     onclick="openLightbox('{{ $pkg->image_url }}', '{{ $pkg->name }}')">
    <img src="{{ $pkg->image_url }}" alt="{{ $pkg->name }}"
         style="width:100%;height:100%;object-fit:cover;opacity:.85;
                transition:opacity .3s,transform .3s;">
    <div style="position:absolute;bottom:0;left:0;right:0;height:60px;
                background:linear-gradient(transparent, var(--bg-card));"></div>
    {{-- Zoom icon hint --}}
    <div style="position:absolute;top:.75rem;right:.75rem;
                background:rgba(0,0,0,0.5);
                border:1px solid rgba(255,255,255,0.15);
                padding:.3rem .5rem;font-size:.7rem;color:rgba(255,255,255,0.6);
                backdrop-filter:blur(4px);">
        🔍
    </div>
</div>
@endif
                <div class="pkg-header">
                    <div class="pkg-name">{{ $pkg->name }}</div>
                    <div class="pkg-meta">
                        @if($pkg->description)<span>{{ $pkg->description }}</span>&nbsp;·&nbsp;@endif
                        <span class="pkg-duration-chip">⏱ {{ $pkg->duration_hours }} Jam</span>
                    </div>
                </div>

                <div class="tier-selector">
                    <span class="tier-selector-label">Pilih Tier</span>
                    <div class="tier-tabs">
                        @foreach($pkg->activeTiers as $i => $tier)
                        <button
                            class="tier-tab {{ $i === 0 ? 'active' : '' }}"
                            onclick="switchTier(this, 'tier-{{ $pkg->id }}-{{ $tier->id }}')"
                            data-color="{{ $tier->color }}"
                            data-price="{{ $tier->formatted_price }}"
                            style="{{ $i === 0 ? 'border-color:'.$tier->color.';color:'.$tier->color : '' }}"
                        >
                            <span class="tier-dot" style="background:{{ $tier->color }};"></span>
                            {{ $tier->name }}
                        </button>
                        @endforeach
                    </div>
                </div>

                <div class="tier-panels">
                    @foreach($pkg->activeTiers as $i => $tier)
                    <div class="tier-panel {{ $i === 0 ? 'active' : '' }}"
                         id="tier-{{ $pkg->id }}-{{ $tier->id }}">
                        <div class="tier-badge-row">
                            <span class="tier-name-badge"
                                  style="background:{{ $tier->color }}20;color:{{ $tier->color }};border:1px solid {{ $tier->color }}50;">
                                {{ $tier->name }}
                            </span>
                            @if($tier->badge)
                                <span class="tier-badge-label">{{ $tier->badge }}</span>
                            @endif
                        </div>
                        <div class="tier-includes">
                            @foreach($tier->includes as $inc)
                            <div class="tier-include-row">
                                <span class="tier-include-name">
                                    <span style="color:{{ $tier->color }};margin-right:.4rem;">✓</span>
                                    {{ $inc->item_name }}
                                </span>
                                <span class="tier-include-qty">{{ $inc->quantity }}</span>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="pkg-footer">
                    <div>
                        <div class="tier-price" id="price-{{ $pkg->id }}"
                             style="color:{{ $firstTier->color }}">
                            {{ $firstTier->formatted_price }}
                        </div>
                        <div class="pkg-price-sub">/ paket</div>
                    </div>
                    <a href="#booking"
                        class="btn-book">Book Now &rarr;</a>
                </div>
            </div>
            @endforeach
        </div>

        <p style="margin-top:2rem;font-size:.72rem;color:var(--text-muted);text-align:center;">
            * Syarat dan ketentuan berlaku &nbsp;·&nbsp; Harga belum termasuk pajak &nbsp;·&nbsp;
        </p>
    </div>
</section>

<div class="neon-line"></div>

<div class="neon-line"></div>

{{-- ══ F&B ══ --}}
<section class="section" id="fnb">
    <div class="container">
        <span class="sec-tag">Food &amp; Beverage</span>
        <h2 class="sec-title">Menu <span>F&amp;B</span></h2>
        <p style="margin-top:.75rem;font-size:.85rem;color:var(--text-dim);max-width:500px;">
            Nikmati berbagai pilihan makanan dan minuman selama sesi karaoke Anda.
        </p>

        {{-- Tabs --}}
        <div class="fnb-tabs" id="fnb-tabs">
            @foreach($fnbCategories as $i => $cat)
                <button class="fnb-tab {{ $i === 0 ? 'active' : '' }}"
                        data-tab="cat-{{ $cat->id }}"
                        onclick="switchTab(this, 'cat-{{ $cat->id }}')">
                    @if($cat->icon)<span class="tab-icon">{{ $cat->icon }}</span>@endif
                    {{ $cat->name }}
                </button>
            @endforeach
        </div>

        {{-- Panels --}}
        @foreach($fnbCategories as $i => $cat)
        <div class="fnb-panel {{ $i === 0 ? 'active' : '' }}" id="cat-{{ $cat->id }}">
            <div class="fnb-list">
                @foreach($cat->activeItems as $idx => $item)
                <div class="fnb-item {{ !$item->is_available ? 'unavail' : '' }} {{ $idx >= 10 ? 'hidden' : '' }}">
                    <div>
                        <div class="fnb-item-name">
                            {{ $item->name }}
                            @if($item->badge)
                                <span class="fnb-badge">{{ $item->badge }}</span>
                            @endif
                        </div>
                        @if($item->description)
                            <div class="fnb-item-desc">{{ $item->description }}</div>
                        @endif
                    </div>
                    <div class="fnb-item-price">{{ $item->formatted_price }}</div>
                </div>
                @endforeach
            </div>

            @if($cat->activeItems->count() > 10)
                <button class="btn-fnb-more" onclick="toggleFnbItems(this, 'cat-{{ $cat->id }}')">
                    Lihat Semua (+{{ $cat->activeItems->count() - 10 }})
                </button>
            @endif
        </div>
        @endforeach
    </div>
</section>

<div class="neon-line"></div>

{{-- ══ BOOKING SECTION ══ --}}
<section class="section" id="booking">
    <div class="container">
        <div style="text-align:center; margin-bottom:2rem;">
            <span class="sec-tag">Reservasi Online</span>
            <h2 class="sec-title">Book <span>Sekarang</span></h2>
            <p style="margin-top:.5rem; font-size:.85rem; color:var(--text-dim);">
                Kehabisan room? Booking dari sekarang untuk memastikan ketersediaan ruangan.
            </p>
        </div>

        <div class="book-section">
            <form method="POST" action="{{ route('booking.submit') }}">
                @csrf
                <div class="book-grid">
                    <div class="book-group">
                        <label>Nama Lengkap *</label>
                        <input type="text" name="customer_name" value="{{ old('customer_name') }}" required placeholder="Masukkan nama Anda">
                        @error('customer_name') <span class="err">{{ $message }}</span> @enderror
                    </div>
                    
                    <div class="book-group">
                        <label>Nomor WhatsApp *</label>
                        <input type="text" name="phone_number" value="{{ old('phone_number') }}" required placeholder="08xxx...">
                        @error('phone_number') <span class="err">{{ $message }}</span> @enderror
                    </div>

                    <div class="book-group">
                        <label>Pilih Room *</label>
                        <select name="room_id" required>
                            <option value="" hidden>-- Pilih Room (Gold s/d Solitaire) --</option>
                            @foreach($rooms as $r)
                                @if(stripos($r->name, 'Bronze') === false && stripos($r->name, 'Silver') === false)
                                <option value="{{ $r->id }}" {{ old('room_id') == $r->id ? 'selected' : '' }}>
                                    Room {{ $r->name }} ({{ $r->getCapacityLabel() }})
                                </option>
                                @endif
                            @endforeach
                        </select>
                        <p style="font-size:0.75rem; color:var(--neon-pink); margin-top:0.4rem;">
                            <i>*Note: Reservasi Room minimal berlaku untuk 7 orang.</i>
                        </p>
                        @error('room_id') <span class="err">{{ $message }}</span> @enderror
                    </div>

                    <div class="book-group">
                        <label>Pilih Paket (Opsional)</label>
                        <select name="package_id">
                            <option value="">-- Tanpa Paket / Reguler --</option>
                            @foreach($packages as $p)
                                <option value="{{ $p->id }}" {{ old('package_id') == $p->id ? 'selected' : '' }}>
                                    Paket {{ $p->name }} ({{ $p->duration_hours }} Jam)
                                </option>
                            @endforeach
                        </select>
                        @error('package_id') <span class="err">{{ $message }}</span> @enderror
                    </div>

                    <div class="book-group">
                        <label>Durasi (Jam) *</label>
                        <input type="number" name="duration_hours" min="1" max="12" value="{{ old('duration_hours', 2) }}" required>
                        @error('duration_hours') <span class="err">{{ $message }}</span> @enderror
                    </div>

                    <div class="book-group">
                        <label>Tanggal *</label>
                        <input type="date" name="booking_date" id="booking_date" value="{{ old('booking_date') }}" required>
                        @error('booking_date') <span class="err">{{ $message }}</span> @enderror
                    </div>

                    <div class="book-group">
                        <label>Jam Datang *</label>
                        <select name="booking_time" required>
                            <option value="" hidden>Pilih Jam</option>
                            @for($h = 13; $h <= 23; $h++)
                                <option value="{{ sprintf('%02d:00', $h) }}" {{ old('booking_time') == sprintf('%02d:00', $h) ? 'selected' : '' }}>{{ sprintf('%02d:00', $h) }}</option>
                                <option value="{{ sprintf('%02d:30', $h) }}" {{ old('booking_time') == sprintf('%02d:30', $h) ? 'selected' : '' }}>{{ sprintf('%02d:30', $h) }}</option>
                            @endfor
                            <option value="00:00" {{ old('booking_time') == '00:00' ? 'selected' : '' }}>00:00</option>
                            <option value="00:30" {{ old('booking_time') == '00:30' ? 'selected' : '' }}>00:30</option>
                            <option value="01:00" {{ old('booking_time') == '01:00' ? 'selected' : '' }}>01:00</option>
                            <option value="01:30" {{ old('booking_time') == '01:30' ? 'selected' : '' }}>01:30</option>
                            <option value="02:00" {{ old('booking_time') == '02:00' ? 'selected' : '' }}>02:00</option>
                        </select>
                        @error('booking_time') <span class="err">{{ $message }}</span> @enderror
                    </div>

                    <div class="book-group book-full">
                        <label>Catatan Tambahan (Opsional)</label>
                        <textarea name="notes" placeholder="Misal: Mohon disiapkan dekor ulang tahun...">{{ old('notes') }}</textarea>
                        @error('notes') <span class="err">{{ $message }}</span> @enderror
                    </div>

                    <div class="book-group book-full">
                        <button type="submit" class="btn-submit-book">
                            Kirim ke WhatsApp 
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg" style="margin-left:.25rem;"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 0 0-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413Z"/></svg>
                        </button>
                        <p style="font-size:.7rem; color:var(--text-muted); text-align:center; margin-top:.5rem;">
                            Anda akan dialihkan ke WhatsApp untuk konfirmasi pesanan dengan admin kami.
                        </p>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>



<div class="neon-line"></div>

{{-- ══ GALLERY PREVIEW ══ --}}
<section class="section" id="galeri">
    <div class="container">
        <span class="sec-tag">✦ Momen Pelanggan</span>
        <h2 class="sec-title">Gale<span>ri</span></h2>
        <p style="margin-top:.75rem;font-size:.85rem;color:var(--text-dim);max-width:500px;">
            Abadikan momentmu di Masterpiece dan bagikan kepada kami!
        </p>

        @if($galleryPreview->count())
            <div class="gal-preview-grid">
                @foreach($galleryPreview as $photo)
                    <div class="gal-prev-item"
                         onclick="openLightbox('{{ Storage::url($photo->image_path) }}', '{{ addslashes($photo->caption ?? $photo->submitter_name) }}')">
                        <img src="{{ Storage::url($photo->image_path) }}"
                             alt="{{ $photo->caption ?? 'Foto galeri' }}" loading="lazy">
                        <div class="gal-prev-overlay">
                            <span class="gal-prev-caption">
                                {{ $photo->caption ?: $photo->submitter_name }}
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>

            <div style="text-align:center;">
                <a href="{{ route('gallery.index') }}" class="gal-see-all">
                    Lihat Semua Foto &rarr;
                </a>
            </div>
        @else
            <div class="gal-empty-mini">
                <p style="font-size:2rem;margin-bottom:.75rem;">📷</p>
                <p>Belum ada foto — jadilah yang pertama mengirim!</p>
                <a href="{{ route('gallery.index') }}" class="gal-see-all" style="margin-top:1.25rem;">Kirim Foto &rarr;</a>
            </div>
        @endif
    </div>
</section>

<div class="neon-line"></div>

{{-- ══ INFO ══ --}}
<section class="section" id="info">
    <div class="container">
        <span class="sec-tag">Informasi</span>
        <h2 class="sec-title">Info & <span>Lokasi</span></h2>

        <div class="info-grid">
            <div class="info-card">
                <div class="info-card-title">🕐 Jam Operasional</div>
                <div class="info-row"><span class="label">Minggu – Rabu</span><span class="val">13.00 – 02.00 WIB</span></div>
                <div class="info-row"><span class="label">Kamis-Sabtu(Weekend)</span><span class="val">13.00 – 03.00 WIB</span></div>
                <div class="info-row"><span class="label">Hari Libur</span><span class="val hot">Mengikuti jadwal weekend</span></div>
            </div>

            <div class="info-card">
                <div class="info-card-title">📍 Lokasi & Kontak</div>
                <div class="info-row"><span class="label">Alamat</span><span class="val">Jl. Prof. DR. Soepomo No.30, RT.13/RW.2, Tebet, Kota Jakarta Selatan</span></div>
                <div class="info-row"><span class="label">WhatsApp</span><span class="val hot">+62 877-7085-1998</span></div>
                <div class="info-row"><span class="label">Instagram</span><span class="val">@masterpiece.tebet</span></div>
                <div class="info-row"><span class="label">Parkir</span><span class="val">Tersedia (Motor & Mobil)</span></div>
                <div class="info-row"><span class="label">Pembayaran</span><span class="val">Cash, Transfer, QRIS, Debit</span></div>
            </div>

            <div class="info-card">
                <div class="info-card-title">📋 Ketentuan Booking</div>
                <div class="info-row"><span class="label">Minimal sewa</span><span class="val">1 jam</span></div>
                <div class="info-row"><span class="label">DP booking</span><span class="val">50% dari total</span></div>
                <div class="info-row"><span class="label">Batas check-in</span><span class="val">15 menit dari jam booking</span></div>
                <div class="info-row"><span class="label">Overtime</span><span class="val">Bayar per jam normal</span></div>
            </div>

            <div class="info-card">
                <div class="info-card-title">🎤 Fasilitas Umum</div>
                <div class="info-row"><span class="label">Lagu</span><span class="val">100.000+ lagu (update rutin)</span></div>
                <div class="info-row"><span class="label">Bahasa lagu</span><span class="val">Indo, Inggris, Korea, Jepang</span></div>
                <div class="info-row"><span class="label">WiFi</span><span class="val">Free High-Speed WiFi</span></div>
                <div class="info-row"><span class="label">Toilet</span><span class="val">Tersedia, bersih</span></div>
            </div>
        </div>
    </div>
</section>


{{-- LIGHTBOX --}}
<div id="lightbox"
     onclick="closeLightbox()"
     style="display:none; position:fixed; inset:0; z-index:9999;
            background:rgba(0,0,0,0.92); backdrop-filter:blur(8px);
            align-items:center; justify-content:center; cursor:zoom-out;
            animation:fadeIn .2s ease;">

    <div style="position:relative; max-width:90vw; max-height:90vh;"
         onclick="event.stopPropagation()">

        {{-- Close button --}}
        <button onclick="closeLightbox()"
                style="position:absolute; top:-1rem; right:-1rem; z-index:1;
                       width:36px; height:36px;
                       background:var(--neon-pink); border:none; cursor:pointer;
                       font-size:1rem; color:white;
                       display:flex; align-items:center; justify-content:center;">
            ✕
        </button>

        <img id="lightbox-img" src="" alt=""
             style="max-width:90vw; max-height:85vh;
                    object-fit:contain; display:block;
                    box-shadow:0 0 60px rgba(255,45,120,0.2);
                    border:1px solid rgba(255,255,255,0.08);">

        <p id="lightbox-caption"
           style="text-align:center; margin-top:.75rem;
                  font-family:var(--ff-display); font-size:1.2rem;
                  letter-spacing:.1em; color:var(--text-dim);">
        </p>
    </div>
</div>

@endsection

@push('scripts')
<script>
    function switchTier(btn, panelId) {
    const card = btn.closest('.pkg-card');
    const pkgId = card.id.replace('pkg-', '');
    card.querySelectorAll('.tier-tab').forEach(t => {
        t.classList.remove('active');
        t.style.borderColor = '';
        t.style.color = '';
    });
    btn.classList.add('active');
    const color = btn.dataset.color;
    btn.style.borderColor = color;
    btn.style.color = color;
    card.querySelectorAll('.tier-panel').forEach(p => p.classList.remove('active'));
    document.getElementById(panelId).classList.add('active');
    const priceEl = document.getElementById('price-' + pkgId);
    if (priceEl) {
        priceEl.textContent = btn.dataset.price;
        priceEl.style.color = color;
    }
}
function openLightbox(src, caption) {
    const lb = document.getElementById('lightbox');
    document.getElementById('lightbox-img').src = src;
    document.getElementById('lightbox-caption').textContent = caption;
    lb.style.display = 'flex';
    document.body.style.overflow = 'hidden';
}

function closeLightbox() {
    document.getElementById('lightbox').style.display = 'none';
    document.body.style.overflow = '';
}

// Tutup dengan tombol ESC
document.addEventListener('keydown', e => {
    if (e.key === 'Escape') closeLightbox();
});
function switchTab(btn, tabId) {
    document.querySelectorAll('.fnb-tab').forEach(t => t.classList.remove('active'));
    document.querySelectorAll('.fnb-panel').forEach(p => p.classList.remove('active'));
    btn.classList.add('active');
    document.getElementById(tabId).classList.add('active');
}

function toggleFnbItems(btn, panelId) {
    const items = document.querySelectorAll('#' + panelId + ' .fnb-item.hidden');
    const allItems = document.querySelectorAll('#' + panelId + ' .fnb-item');
    const isExpanding = btn.textContent.includes('Lihat Semua');

    if (isExpanding) {
        items.forEach(item => {
            item.classList.remove('hidden');
            item.style.opacity = '0';
            item.style.transform = 'translateY(10px)';
            setTimeout(() => {
                item.style.transition = 'all .3s ease';
                item.style.opacity = '1';
                item.style.transform = 'translateY(0)';
            }, 10);
        });
        btn.textContent = 'Tutup Menu';
    } else {
        allItems.forEach((item, idx) => {
            if (idx >= 10) {
                item.classList.add('hidden');
            }
        });
        btn.textContent = 'Lihat Semua (+' + (allItems.length - 10) + ')';
        // Scroll back to top of tabs if closing
        document.getElementById('fnb').scrollIntoView({ behavior: 'smooth' });
    }
}

// Smooth scroll untuk anchor links pada navbar
document.querySelectorAll('.nav-links a').forEach(a => {
    a.addEventListener('click', e => {
        // Ambil ID section dari href (misal: http://.../#rooms -> rooms)
        const url = new URL(a.href);
        if(url.hash && document.querySelector(url.hash)) {
            e.preventDefault();
            document.querySelector(url.hash).scrollIntoView({ behavior: 'smooth', block: 'start' });
            // Update URL tanpa reload
            history.pushState(null, null, url.hash);
        }
    });
});

// Scroll Spy menggunakan Intersection Observer
document.addEventListener("DOMContentLoaded", () => {
    const sections = document.querySelectorAll("section[id]");
    const navLinks = document.querySelectorAll(".nav-links a");

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const id = entry.target.getAttribute("id");
                
                // Hapus class active dari semua
                navLinks.forEach(link => link.classList.remove("active"));
                
                // Tambahkan class active ke link yang sesuai
                navLinks.forEach(link => {
                    if (link.getAttribute("href").includes("#" + id)) {
                        link.classList.add("active");
                    }
                });
            }
        });
    }, {
        rootMargin: "-20% 0px -60% 0px", // Posisikan area deteksi di sekitar tengah atas layer
        threshold: 0
    });

    sections.forEach(section => observer.observe(section));
});
</script>
@endpush
