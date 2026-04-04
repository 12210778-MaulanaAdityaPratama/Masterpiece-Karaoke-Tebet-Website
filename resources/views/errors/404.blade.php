@extends('layouts.app')

@section('title', '404 - Halaman Tidak Ditemukan')

@section('content')
<div class="container" style="min-height: 60vh; display: flex; align-items: center; justify-content: center; text-align: center; padding: 4rem 1rem;">
    <div>
        <h1 style="font-family: var(--ff-display); font-size: 8rem; color: var(--neon-pink); line-height: 1; margin-bottom: 1rem; text-shadow: var(--glow-pink);">404</h1>
        <h2 style="font-family: var(--ff-body); font-size: 1.5rem; color: var(--text); margin-bottom: 1.5rem;">Halaman Tidak Ditemukan</h2>
        <p style="color: var(--text-dim); margin-bottom: 2.5rem; max-width: 450px; margin-left: auto; margin-right: auto; line-height: 1.6;">
            Maaf, halaman yang Anda cari tidak dapat ditemukan. Mungkin halaman tersebut telah dihapus atau Anda salah memasukkan URL.
        </p>
        <a href="{{ route('home') }}" style="display: inline-block; padding: 0.8rem 2rem; background: var(--border-pink); border: 1px solid var(--neon-pink); color: var(--neon-pink); text-decoration: none; text-transform: uppercase; letter-spacing: 0.2em; font-size: 0.85rem; transition: all 0.3s; box-shadow: var(--glow-pink);">
            Kembali ke Beranda
        </a>
    </div>
</div>
@endsection
