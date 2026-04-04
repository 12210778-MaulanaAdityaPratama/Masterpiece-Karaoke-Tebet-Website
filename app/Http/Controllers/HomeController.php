<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Package;
use App\Models\FnbCategory;
use App\Models\GalleryPhoto;

class HomeController extends Controller
{
    public function index()
    {
        $rooms = Room::where('is_available', true)
            ->orderBy('sort_order')
            ->get();

        $packages = Package::where('is_active', true)
            ->with('activeTiers.includes')
            ->orderBy('sort_order')
            ->get();

        $fnbCategories = FnbCategory::where('is_active', true)
            ->with('activeItems')
            ->orderBy('sort_order')
            ->get();

        // 6 foto terbaru untuk preview galeri di homepage
        $galleryPreview = GalleryPhoto::approved()->latest()->take(6)->get();

        return view('public.home', compact('rooms', 'packages', 'fnbCategories', 'galleryPreview'));
    }

}
