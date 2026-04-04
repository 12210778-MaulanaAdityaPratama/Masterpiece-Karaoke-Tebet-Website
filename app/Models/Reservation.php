<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reservation extends Model
{
    protected $fillable = [
        'customer_name',
        'phone_number',
        'booking_date',
        'booking_time',
        'duration_hours',
        'service_type',
        'service_id',
        'notes',
        'status',
    ];

    protected $casts = [
        'booking_date' => 'date',
        // time cast not strictly required, but useful
    ];

    /**
     * Get the room associated with the reservation if service_type = 'room'
     */
    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class, 'service_id');
    }

    /**
     * Get the package associated with the reservation if service_type = 'package'
     */
    public function package(): BelongsTo
    {
        return $this->belongsTo(Package::class, 'service_id');
    }
}
