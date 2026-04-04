<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Format;

class ImageOptimizerService
{
    /**
     * @var ImageManager
     */
    protected $manager;

    public function __construct()
    {
        // Inisialisasi ImageManager menggunakan driver GD
        $this->manager = new ImageManager(new Driver());
    }

    /**
     * Memproses file upload: scale down > convert webp > simpan
     *
     * @param UploadedFile $file       File dari request
     * @param string       $directory  Folder di disk public (misal: 'gallery')
     * @param int          $maxWidth   Maksimum lebar gambar (px)
     * @param int          $quality    Kualitas WebP (0-100)
     * @return string                  Path file yang tersimpan
     */
    public function uploadAndCompress(UploadedFile $file, string $directory, int $maxWidth = 1200, int $quality = 80): string
    {
        // 1. Baca gambar dengan Intervention Image v4
        $image = $this->manager->decode($file->getRealPath());

        // 2. Jika lebar gambar melebihi $maxWidth, kecilkan secara proporsional
        if ($image->width() > $maxWidth) {
            $image->scaleDown(width: $maxWidth);
        }

        // 3. Konversi format ke WebP
        $encodedImage = $image->encodeUsingFormat(Format::WEBP, quality: $quality);

        // 4. Generate nama file unik (.webp)
        $filename = Str::random(40) . '.webp';
        $path = $directory . '/' . $filename;

        // 5. Simpan ke Storage public
        Storage::disk('public')->put($path, (string) $encodedImage);

        return $path;
    }
}
