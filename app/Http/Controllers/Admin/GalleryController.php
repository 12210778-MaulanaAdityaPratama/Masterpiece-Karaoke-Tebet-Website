<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GalleryPhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    /** List semua foto (dengan filter status) */
    public function index(Request $request)
    {
        $status = $request->query('status', 'pending');
        $allowedStatuses = ['pending', 'approved', 'rejected'];

        if (!in_array($status, $allowedStatuses)) {
            $status = 'pending';
        }

        $photos = GalleryPhoto::where('status', $status)
            ->latest()
            ->get();

        $counts = [
            'pending'  => GalleryPhoto::where('status', 'pending')->count(),
            'approved' => GalleryPhoto::where('status', 'approved')->count(),
            'rejected' => GalleryPhoto::where('status', 'rejected')->count(),
        ];

        return view('admin.gallery.index', compact('photos', 'status', 'counts'));
    }

    /** Approve foto */
    public function approve(GalleryPhoto $photo)
    {
        $photo->update(['status' => 'approved']);

        return back()->with('success', 'Foto berhasil disetujui dan kini tampil di galeri.');
    }

    /** Reject foto */
    public function reject(GalleryPhoto $photo)
    {
        $photo->update(['status' => 'rejected']);

        return back()->with('success', 'Foto telah ditolak.');
    }

    /** Hapus foto (dari DB & storage) */
    public function destroy(GalleryPhoto $photo)
    {
        Storage::disk('public')->delete($photo->image_path);
        $photo->delete();

        return back()->with('success', 'Foto berhasil dihapus.');
    }
}
