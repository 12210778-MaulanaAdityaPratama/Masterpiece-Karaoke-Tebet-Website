<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Room;
use App\Models\Package;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    /**
     * Submit booking form
     */
    public function submit(Request $request)
    {
        $request->validate([
            'customer_name'  => 'required|string|max:100',
            'phone_number'   => 'required|string|max:20',
            'booking_date'   => 'required|date|after_or_equal:today',
            'booking_time'   => 'required',
            'duration_hours' => 'required|integer|min:1|max:12',
            'service_choice' => 'required|string', // Format: "room_1" atau "package_2"
            'notes'          => 'nullable|string|max:500',
        ]);

        // Parse service_choice
        $choiceParts = explode('_', $request->service_choice);
        $serviceType = $choiceParts[0]; // 'room' atau 'package'
        $serviceId   = isset($choiceParts[1]) ? (int)$choiceParts[1] : null;

        // Ambil nama layanan untuk teks WhatsApp
        $serviceName = 'Layanan Lainnya';
        if ($serviceType === 'room' && $serviceId) {
            $room = Room::find($serviceId);
            if ($room) $serviceName = 'Room ' . $room->name;
        } elseif ($serviceType === 'package' && $serviceId) {
            $package = Package::find($serviceId);
            if ($package) $serviceName = 'Paket ' . $package->name;
        }

        // 1. Simpan ke Database
        Reservation::create([
            'customer_name'  => $request->customer_name,
            'phone_number'   => $request->phone_number,
            'booking_date'   => $request->booking_date,
            'booking_time'   => $request->booking_time,
            'duration_hours' => $request->duration_hours,
            'service_type'   => $serviceType,
            'service_id'     => $serviceId,
            'notes'          => $request->notes,
            'status'         => 'pending'
        ]);

        // 2. Generate Teks WhatsApp
        $adminPhone = '6287770851998'; // Nomor WA Admin Masterpiece
        
        $text = "*Halo Masterpiece, saya ingin reservasi:*\n\n";
        $text .= "Nama: *" . $request->customer_name . "*\n";
        $text .= "No. HP: *" . $request->phone_number . "*\n";
        $text .= "Tanggal: *" . \Carbon\Carbon::parse($request->booking_date)->format('d M Y') . "*\n";
        $text .= "Jam: *" . $request->booking_time . " WIB*\n";
        $text .= "Durasi: *" . $request->duration_hours . " Jam*\n";
        $text .= "Pilihan: *" . $serviceName . "*\n";
        
        if ($request->notes) {
            $text .= "Catatan: " . $request->notes . "\n";
        }
        
        $text .= "\n*Mohon info ketersediaannya. Terima kasih.*";

        $waUrl = "https://wa.me/{$adminPhone}?text=" . urlencode($text);

        // 3. Redirect ke WhatsApp
        return redirect()->away($waUrl);
    }
}
