<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    /** List semua reservasi */
    public function index(Request $request)
    {
        $status = $request->query('status', 'pending');
        $allowed = ['pending', 'confirmed', 'completed', 'cancelled'];
        if (!in_array($status, $allowed)) $status = 'pending';

        $reservations = Reservation::with(['room', 'package'])
            ->where('status', $status)
            ->latest()
            ->get();

        $counts = [
            'pending'   => Reservation::where('status', 'pending')->count(),
            'confirmed' => Reservation::where('status', 'confirmed')->count(),
            'completed' => Reservation::where('status', 'completed')->count(),
            'cancelled' => Reservation::where('status', 'cancelled')->count(),
        ];

        return view('admin.reservations.index', compact('reservations', 'status', 'counts'));
    }

    /** Update status reservasi */
    public function updateStatus(Request $request, Reservation $reservation)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,completed,cancelled'
        ]);

        $reservation->update(['status' => $request->status]);

        return back()->with('success', 'Status reservasi berhasil diperbarui.');
    }

    /** Hapus reservasi */
    public function destroy(Reservation $reservation)
    {
        $reservation->delete();

        return back()->with('success', 'Reservasi berhasil dihapus permanen.');
    }
}
