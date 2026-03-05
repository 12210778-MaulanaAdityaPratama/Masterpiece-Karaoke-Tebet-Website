<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'type', 'capacity_min', 'capacity_max',
        'price_weekday', 'price_weekend', 'description',
        'image', 'facilities', 'is_available', 'sort_order',
    ];

    protected $casts = [
        'is_available' => 'boolean',
        'facilities'   => 'array',
        'price_weekday'=> 'decimal:2',
        'price_weekend'=> 'decimal:2',
    ];

    public function getTypeLabel(): string
    {
        return match($this->type) {
            'small'  => 'Small',
            'medium' => 'Medium',
            'large'  => 'Large',
            'vip'    => 'VIP',
            default  => ucfirst($this->type),
        };
    }

    public function getCapacityLabel(): string
    {
        return $this->capacity_min . '–' . $this->capacity_max . ' orang';
    }

    public function getFormattedWeekdayAttribute(): string
    {
        return 'Rp ' . number_format($this->price_weekday, 0, ',', '.');
    }

    public function getFormattedWeekendAttribute(): string
    {
        return 'Rp ' . number_format($this->price_weekend, 0, ',', '.');
    }

    public function getImageUrlAttribute(): string
    {
        if ($this->image && file_exists(public_path('storage/' . $this->image))) {
            return asset('storage/' . $this->image);
        }
        return asset('images/room-placeholder.jpg');
    }
}
