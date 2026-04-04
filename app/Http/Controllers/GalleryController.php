<?php

namespace App\Http\Controllers;

use App\Models\GalleryPhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    /** Tampilkan galeri publik (hanya foto approved) */
    public function index()
    {
        $photos = GalleryPhoto::approved()
            ->latest()
            ->get();

        return view('public.gallery', compact('photos'));
    }

    /** Simpan kiriman foto dari tamu/user */
    public function submit(Request $request)
    {
        $request->validate([
            'submitter_name' => ['nullable', 'string', 'max:100'],
            'caption'        => ['nullable', 'string', 'max:255'],
            'image'          => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
        ], [
            'image.required' => 'Foto wajib dipilih.',
            'image.image'    => 'File harus berupa gambar.',
            'image.mimes'    => 'Format gambar harus jpg, png, atau webp.',
            'image.max'      => 'Ukuran foto maksimal 5 MB.',
        ]);

        $path = (new \App\Services\ImageOptimizerService)->uploadAndCompress($request->file('image'), 'gallery');

        GalleryPhoto::create([
            'submitter_name' => $request->submitter_name ?: 'Anonim',
            'caption'        => $request->caption,
            'image_path'     => $path,
            'status'         => 'pending',
        ]);

        return redirect()->route('gallery.index')
            ->with('success', 'Foto berhasil dikirim! Admin akan mereviewnya segera.');
    }
}
