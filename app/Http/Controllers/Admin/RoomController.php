<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::orderBy('sort_order')->get();
        return view('admin.rooms.index', compact('rooms'));
    }

    public function create()
    {
        return view('admin.rooms.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'           => 'required|string|max:255',
            'type'           => 'required|in:small,medium,large,vip',
            'capacity_min'   => 'required|integer|min:1',
            'capacity_max'   => 'required|integer|min:1',
            'price_weekday'  => 'required|numeric|min:0',
            'price_weekend'  => 'required|numeric|min:0',
            'description'    => 'nullable|string',
            'image'          => 'nullable|image|mimes:jpg,jpeg,png,webp|max:3072',
            'facilities'     => 'nullable|string',
            'sort_order'     => 'integer|min:0',
        ]);

        $data['is_available'] = $request->has('is_available');
        $data['facilities']   = $this->parseFacilities($request->input('facilities', ''));

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('rooms', 'public');
        }

        Room::create($data);

        return redirect()->route('admin.rooms.index')
            ->with('success', 'Room berhasil ditambahkan.');
    }

    public function edit(Room $room)
    {
        return view('admin.rooms.edit', compact('room'));
    }

    public function update(Request $request, Room $room)
    {
        $data = $request->validate([
            'name'          => 'required|string|max:255',
            'type'          => 'required|in:small,medium,large,vip',
            'capacity_min'  => 'required|integer|min:1',
            'capacity_max'  => 'required|integer|min:1',
            'price_weekday' => 'required|numeric|min:0',
            'price_weekend' => 'required|numeric|min:0',
            'description'   => 'nullable|string',
            'image'         => 'nullable|image|mimes:jpg,jpeg,png,webp|max:3072',
            'facilities'    => 'nullable|string',
            'sort_order'    => 'integer|min:0',
        ]);

        $data['is_available'] = $request->has('is_available');
        $data['facilities']   = $this->parseFacilities($request->input('facilities', ''));

        if ($request->hasFile('image')) {
            if ($room->image) Storage::disk('public')->delete($room->image);
            $data['image'] = $request->file('image')->store('rooms', 'public');
        }

        $room->update($data);

        return redirect()->route('admin.rooms.index')
            ->with('success', 'Room berhasil diperbarui.');
    }

    public function destroy(Room $room)
    {
        if ($room->image) Storage::disk('public')->delete($room->image);
        $room->delete();

        return redirect()->route('admin.rooms.index')
            ->with('success', 'Room berhasil dihapus.');
    }

    private function parseFacilities(string $input): array
    {
        return array_values(array_filter(
            array_map('trim', explode(',', $input))
        ));
    }
}
