{{--
    Partial: Packages section dengan dropdown tier
    Include di home.blade.php:  @include('public.partials.packages', ['packages' => $packages])
    Atau langsung paste ke dalam home.blade.php di section #packages
--}}

@push('styles')
<style>
/* ══════════════════════════════════════════════
   PACKAGES SECTION — TIER DROPDOWN
══════════════════════════════════════════════ */
.pkg-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 1.75rem;
    margin-top: 3rem;
}

/* ── Kartu Paket ── */
.pkg-card {
    background: var(--bg-card);
    border: 1px solid var(--border-pink);
    display: flex; flex-direction: column;
    position: relative; overflow: hidden;
    transition: border-color .3s, transform .3s, box-shadow .3s;
}
.pkg-card:hover {
    border-color: rgba(255,45,120,0.5);
    transform: translateY(-4px);
    box-shadow: 0 16px 40px rgba(255,45,120,0.12);
}
.pkg-card::before {
    content: '';
    position: absolute; top: 0; left: 0; right: 0; height: 2px;
    background: linear-gradient(90deg, transparent, var(--neon-pink), transparent);
    opacity: 0; transition: opacity .3s;
}
.pkg-card:hover::before { opacity: 1; }

/* ── Header paket ── */
.pkg-header {
    padding: 1.6rem 1.75rem 1.2rem;
    border-bottom: 1px solid rgba(255,255,255,0.05);
}
.pkg-name {
    font-family: var(--ff-display);
    font-size: 1.8rem; letter-spacing: 0.07em; color: var(--text);
    margin-bottom: 0.3rem;
}
.pkg-meta {
    font-size: 0.75rem; color: var(--text-dim);
    display: flex; align-items: center; gap: 0.5rem;
}
.pkg-duration-chip {
    display: inline-flex; align-items: center; gap: 0.3rem;
    font-size: 0.65rem; letter-spacing: 0.15em; text-transform: uppercase;
    color: var(--neon-pink);
    border: 1px solid rgba(255,45,120,0.3);
    padding: 0.2em 0.7em;
}

/* ── Dropdown tier selector ── */
.tier-selector {
    padding: 1.25rem 1.75rem;
    border-bottom: 1px solid rgba(255,255,255,0.05);
}
.tier-selector-label {
    font-size: 0.6rem; letter-spacing: 0.28em; text-transform: uppercase;
    color: var(--text-muted); display: block; margin-bottom: 0.6rem;
}
.tier-tabs {
    display: flex; gap: 0.5rem; flex-wrap: wrap;
}
.tier-tab {
    display: flex; align-items: center; gap: 0.4rem;
    padding: 0.45rem 1rem;
    border: 1px solid rgba(255,255,255,0.08);
    background: transparent; cursor: pointer;
    font-family: var(--ff-display); font-size: 1rem;
    letter-spacing: 0.1em;
    color: var(--text-dim); transition: all .2s;
    position: relative;
}
.tier-tab .tier-dot {
    width: 8px; height: 8px; border-radius: 50%;
    flex-shrink: 0;
}
.tier-tab:hover { color: var(--text); border-color: rgba(255,255,255,0.2); }
.tier-tab.active {
    color: var(--text);
    border-color: currentColor;
    background: rgba(255,255,255,0.04);
}
/* warna border mengikuti warna tier saat active — diset lewat JS */

/* ── Konten tier (isi & harga) ── */
.tier-panels { position: relative; }
.tier-panel {
    display: none;
    padding: 1.25rem 1.75rem 0;
    flex: 1;
}
.tier-panel.active { display: block; }

/* Badge tier */
.tier-badge-row {
    display: flex; align-items: center; gap: 0.75rem;
    margin-bottom: 0.75rem;
}
.tier-name-badge {
    font-family: var(--ff-display);
    font-size: 1.35rem; letter-spacing: 0.1em;
    padding: 0.1em 0.6em;
    /* warna bg & text diset inline dari PHP */
}
.tier-badge-label {
    font-size: 0.6rem; letter-spacing: 0.2em; text-transform: uppercase;
    color: var(--neon-pink);
    border: 1px solid rgba(255,45,120,0.35);
    padding: 0.22em 0.7em;
}

/* Daftar isi tier */
.tier-includes {
    margin-bottom: 0;
}
.tier-include-row {
    display: flex; align-items: center; justify-content: space-between;
    padding: 0.5rem 0;
    border-bottom: 1px solid rgba(255,255,255,0.04);
    gap: 1rem;
}
.tier-include-row:last-child { border-bottom: none; }
.tier-include-name { font-size: 0.84rem; color: var(--text); }
.tier-include-qty  {
    font-size: 0.78rem; color: var(--text-dim);
    white-space: nowrap;
    font-style: italic;
}

/* ── Footer harga ── */
.pkg-footer {
    padding: 1.25rem 1.75rem;
    border-top: 1px solid rgba(255,255,255,0.05);
    display: flex; align-items: center; justify-content: space-between;
    background: rgba(255,45,120,0.03);
    margin-top: auto;
}
.tier-price-wrap { min-height: 2.5rem; }
.tier-price {
    font-family: var(--ff-display);
    font-size: 2rem; letter-spacing: 0.04em;
    line-height: 1;
    /* warna diset lewat JS sesuai tier aktif */
}
.tier-price-sub {
    font-size: 0.65rem; letter-spacing: 0.12em;
    color: var(--text-muted); margin-top: 0.15rem;
}

.btn-book {
    font-family: var(--ff-body); font-size: 0.72rem;
    letter-spacing: 0.18em; text-transform: uppercase;
    padding: 0.6rem 1.2rem; text-decoration: none;
    background: transparent;
    border: 1px solid rgba(255,45,120,0.4);
    color: var(--neon-pink); cursor: pointer;
    transition: all .2s; white-space: nowrap;
    display: inline-block;
}
.btn-book:hover {
    background: var(--neon-pink); color: white;
    box-shadow: 0 0 20px rgba(255,45,120,0.4);
}

@media(max-width:768px){
    .pkg-grid { grid-template-columns: 1fr; }
    .tier-tabs { gap: 0.35rem; }
    .tier-tab { padding: 0.4rem 0.75rem; font-size: 0.9rem; }
}
</style>
@endpush

{{-- ══ PACKAGES SECTION ══ --}}
<section class="section" id="packages">
    <div class="container">
        <span class="sec-tag">Special Offers</span>
        <h2 class="sec-title">Paket <span>Karaoke</span></h2>
        <p style="margin-top:.75rem;font-size:.85rem;color:var(--text-dim);max-width:500px;">
            Pilih tier yang sesuai budget Anda. Setiap paket sudah termasuk sewa room dan berbagai item pilihan.
        </p>

        @if($packages->isEmpty())
            <div style="text-align:center;padding:4rem;color:var(--text-dim);margin-top:2rem;border:1px solid var(--border);">
                Paket sedang disiapkan. Hubungi kami untuk info lebih lanjut.
            </div>
        @else
        <div class="pkg-grid">
            @foreach($packages as $pkg)
            @php $firstTier = $pkg->activeTiers->first(); @endphp
            @if(!$firstTier) @continue @endif

            <div class="pkg-card" id="pkg-{{ $pkg->id }}">

                {{-- Header --}}
                <div class="pkg-header">
                    <div class="pkg-name">{{ $pkg->name }}</div>
                    <div class="pkg-meta">
                        @if($pkg->description)
                            <span>{{ $pkg->description }}</span>
                            &nbsp;·&nbsp;
                        @endif
                        <span class="pkg-duration-chip">⏱ {{ $pkg->duration_hours }} Jam</span>
                    </div>
                </div>

                {{-- Tier tab selector --}}
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

                {{-- Tier panels --}}
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

                {{-- Footer harga --}}
                <div class="pkg-footer">
                    <div class="tier-price-wrap">
                        <div class="tier-price" id="price-{{ $pkg->id }}"
                             style="color:{{ $firstTier->color }}">
                            {{ $firstTier->formatted_price }}
                        </div>
                        <div class="tier-price-sub">/ paket</div>
                    </div>
                    <a href="https://wa.me/6287770851998?text=Halo+Masterpiece,+saya+ingin+booking+{{ urlencode($pkg->name) }}"
                       target="_blank" class="btn-book">
                        Book &rarr;
                    </a>
                </div>

            </div>
            @endforeach
        </div>
        @endif

        <p style="margin-top:2rem;font-size:.72rem;color:var(--text-muted);text-align:center;">
            * Syarat dan ketentuan berlaku &nbsp;·&nbsp; Harga belum termasuk pajak &nbsp;·&nbsp; Berlaku mulai jam 13.00 s/d 16.00
        </p>
    </div>
</section>

@push('scripts')
<script>
function switchTier(btn, panelId) {
    // Cari parent card
    const card = btn.closest('.pkg-card');
    const pkgId = card.id.replace('pkg-', '');

    // Reset semua tab di card ini
    card.querySelectorAll('.tier-tab').forEach(t => {
        t.classList.remove('active');
        t.style.borderColor = '';
        t.style.color = '';
    });

    // Aktifkan tab yang diklik
    btn.classList.add('active');
    const color = btn.dataset.color;
    btn.style.borderColor = color;
    btn.style.color = color;

    // Sembunyikan semua panel di card ini
    card.querySelectorAll('.tier-panel').forEach(p => p.classList.remove('active'));

    // Tampilkan panel yang sesuai
    document.getElementById(panelId).classList.add('active');

    // Update harga di footer
    const priceEl = document.getElementById('price-' + pkgId);
    if (priceEl) {
        priceEl.textContent = btn.dataset.price;
        priceEl.style.color = color;
    }
}
</script>
@endpush
