<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Package;
use App\Models\FnbCategory;

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

        return view('public.home', compact('rooms', 'packages', 'fnbCategories'));
    }

}
