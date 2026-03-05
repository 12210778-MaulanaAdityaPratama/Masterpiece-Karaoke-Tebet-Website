<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FnbCategory;
use App\Models\FnbItem;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class FnbController extends Controller
{
    // ── Categories ───────────────────────────────────────────────────────────

    public function categories()
    {
        $categories = FnbCategory::withCount('items')->orderBy('sort_order')->get();
        return view('admin.menus.categories', compact('categories'));
    }

    public function storeCategory(Request $request)
    {
        $data = $request->validate([
            'name'       => 'required|string|max:100',
            'icon'       => 'nullable|string|max:10',
            'is_active'  => 'boolean',
            'sort_order' => 'integer|min:0',
        ]);
        $data['slug']      = Str::slug($data['name']);
        $data['is_active'] = $request->has('is_active');

        FnbCategory::create($data);
        return redirect()->route('admin.fnb.categories')
            ->with('success', 'Kategori F&B ditambahkan.');
    }

    public function destroyCategory(FnbCategory $fnbCategory)
    {
        $fnbCategory->delete();
        return redirect()->route('admin.fnb.categories')
            ->with('success', 'Kategori dihapus.');
    }

    // ── Items ────────────────────────────────────────────────────────────────

    public function items()
    {
        $items      = FnbItem::with('category')->orderBy('fnb_category_id')->orderBy('sort_order')->get();
        $categories = FnbCategory::where('is_active', true)->orderBy('sort_order')->get();
        return view('admin.menus.items', compact('items', 'categories'));
    }

    public function createItem()
    {
        $categories = FnbCategory::where('is_active', true)->orderBy('sort_order')->get();
        return view('admin.menus.create_item', compact('categories'));
    }

    public function storeItem(Request $request)
    {
        $data = $request->validate([
            'fnb_category_id' => 'required|exists:fnb_categories,id',
            'name'            => 'required|string|max:255',
            'description'     => 'nullable|string',
            'price'           => 'required|numeric|min:0',
            'image'           => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'badge'           => 'nullable|string|max:50',
            'sort_order'      => 'integer|min:0',
        ]);

        $data['is_available'] = $request->has('is_available');

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('fnb', 'public');
        }

        FnbItem::create($data);
        return redirect()->route('admin.fnb.items')
            ->with('success', 'Item F&B ditambahkan.');
    }

    public function editItem(FnbItem $fnbItem)
    {
        $categories = FnbCategory::where('is_active', true)->orderBy('sort_order')->get();
        return view('admin.menus.edit_item', compact('fnbItem', 'categories'));
    }

    public function updateItem(Request $request, FnbItem $fnbItem)
    {
        $data = $request->validate([
            'fnb_category_id' => 'required|exists:fnb_categories,id',
            'name'            => 'required|string|max:255',
            'description'     => 'nullable|string',
            'price'           => 'required|numeric|min:0',
            'image'           => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'badge'           => 'nullable|string|max:50',
            'sort_order'      => 'integer|min:0',
        ]);

        $data['is_available'] = $request->has('is_available');

        if ($request->hasFile('image')) {
            if ($fnbItem->image) Storage::disk('public')->delete($fnbItem->image);
            $data['image'] = $request->file('image')->store('fnb', 'public');
        }

        $fnbItem->update($data);
        return redirect()->route('admin.fnb.items')
            ->with('success', 'Item F&B diperbarui.');
    }

    public function destroyItem(FnbItem $fnbItem)
    {
        if ($fnbItem->image) Storage::disk('public')->delete($fnbItem->image);
        $fnbItem->delete();
        return redirect()->route('admin.fnb.items')
            ->with('success', 'Item dihapus.');
    }
}
