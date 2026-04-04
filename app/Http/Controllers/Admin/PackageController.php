<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Package;
use App\Models\PackageTier;
use App\Models\TierInclude;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PackageController extends Controller
{
    // ── Packages ─────────────────────────────────────────────────────────────

    public function index()
    {
        $packages = Package::withCount('tiers')->orderBy('sort_order')->get();
        return view('admin.packages.index', compact('packages'));
    }

    public function create()
    {
        return view('admin.packages.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'           => 'required|string|max:255',
            'description'    => 'nullable|string',
            'duration_hours' => 'required|integer|min:1',
            'image'          => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'sort_order'     => 'nullable|integer|min:0',
        ]);

        $data['is_active']  = $request->has('is_active');
        $data['sort_order'] = $request->input('sort_order', 0);

        if ($request->hasFile('image')) {
            $data['image'] = (new \App\Services\ImageOptimizerService)->uploadAndCompress($request->file('image'), 'packages');
        }

        Package::create($data);

        return redirect()->route('admin.packages.index')
            ->with('success', 'Paket berhasil ditambahkan. Sekarang tambahkan tier-nya.');
    }

    public function edit(Package $package)
    {
        $package->load('tiers.includes');
        return view('admin.packages.edit', compact('package'));
    }

    public function update(Request $request, Package $package)
    {
        $data = $request->validate([
            'name'           => 'required|string|max:255',
            'description'    => 'nullable|string',
            'duration_hours' => 'required|integer|min:1',
            'image'          => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            '   sort_order'     => 'nullable|integer|min:0',
        ]);

        $data['is_active']  = $request->has('is_active');
        $data['sort_order'] = $request->input('sort_order', 0);

        if ($request->hasFile('image')) {
            if ($package->image) Storage::disk('public')->delete($package->image);
            $data['image'] = (new \App\Services\ImageOptimizerService)->uploadAndCompress($request->file('image'), 'packages');
        }

        $package->update($data);

        return redirect()->route('admin.packages.index')
            ->with('success', 'Paket berhasil diperbarui.');
    }

    public function destroy(Package $package)
    {
        $package->delete();
        return redirect()->route('admin.packages.index')
            ->with('success', 'Paket berhasil dihapus.');
    }

    // ── Tiers ─────────────────────────────────────────────────────────────────

    public function createTier(Package $package)
    {
        return view('admin.packages.create_tier', compact('package'));
    }

    public function storeTier(Request $request, Package $package)
    {
        $data = $request->validate([
            'name'       => 'required|string|max:100',
            'color'      => 'required|string|max:7',
            'price'      => 'required|numeric|min:0',
            'badge'      => 'nullable|string|max:50',
            'sort_order' => 'nullable|integer|min:0',
            // items
            'items'              => 'nullable|array',
            'items.*.item_name'  => 'required|string|max:100',
            'items.*.quantity'   => 'required|string|max:50',
        ]);

        $tier = $package->tiers()->create([
            'name'         => $data['name'],
            'color'        => $data['color'],
            'price'        => $data['price'],
            'badge'        => $data['badge'] ?? null,
            'is_available' => $request->has('is_available'),
            'sort_order'   => $request->input('sort_order', 0),
        ]);

        $this->syncIncludes($tier, $request->input('items', []));

        return redirect()->route('admin.packages.edit', $package)
            ->with('success', "Tier {$tier->name} berhasil ditambahkan.");
    }

    public function editTier(Package $package, PackageTier $tier)
    {
        $tier->load('includes');
        return view('admin.packages.edit_tier', compact('package', 'tier'));
    }

    public function updateTier(Request $request, Package $package, PackageTier $tier)
    {
        $data = $request->validate([
            'name'       => 'required|string|max:100',
            'color'      => 'required|string|max:7',
            'price'      => 'required|numeric|min:0',
            'badge'      => 'nullable|string|max:50',
            'sort_order' => 'nullable|integer|min:0',
            'items'              => 'nullable|array',
            'items.*.item_name'  => 'required|string|max:100',
            'items.*.quantity'   => 'required|string|max:50',
        ]);

        $tier->update([
            'name'         => $data['name'],
            'color'        => $data['color'],
            'price'        => $data['price'],
            'badge'        => $data['badge'] ?? null,
            'is_available' => $request->has('is_available'),
            'sort_order'   => $request->input('sort_order', 0),
        ]);

        $this->syncIncludes($tier, $request->input('items', []));

        return redirect()->route('admin.packages.edit', $package)
            ->with('success', "Tier {$tier->name} berhasil diperbarui.");
    }

    public function destroyTier(Package $package, PackageTier $tier)
    {
        $tier->delete();
        return redirect()->route('admin.packages.edit', $package)
            ->with('success', 'Tier berhasil dihapus.');
    }

    // ── Helpers ───────────────────────────────────────────────────────────────

    private function syncIncludes(PackageTier $tier, array $items): void
    {
        $tier->includes()->delete();

        foreach ($items as $i => $item) {
            if (empty(trim($item['item_name'] ?? ''))) continue;

            TierInclude::create([
                'package_tier_id' => $tier->id,
                'item_name'       => $item['item_name'],
                'quantity'        => $item['quantity'],
                'sort_order'      => $i,
            ]);
        }
    }
}
