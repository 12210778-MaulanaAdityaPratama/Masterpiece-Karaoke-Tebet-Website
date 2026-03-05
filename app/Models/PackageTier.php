<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PackageTier extends Model
{
    use HasFactory;

    protected $fillable = [
        'package_id', 'name', 'color', 'price',
        'badge', 'is_available', 'sort_order',
    ];

    protected $casts = [
        'is_available' => 'boolean',
        'price'        => 'decimal:2',
    ];

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function includes()
    {
        return $this->hasMany(TierInclude::class)->orderBy('sort_order');
    }

    public function getFormattedPriceAttribute(): string
    {
        return 'Rp ' . number_format($this->price, 0, ',', '.');
    }

    // Warna teks kontras otomatis berdasarkan background color
    public function getTextColorAttribute(): string
    {
        $hex = ltrim($this->color, '#');
        $r = hexdec(substr($hex, 0, 2));
        $g = hexdec(substr($hex, 2, 2));
        $b = hexdec(substr($hex, 4, 2));
        $luminance = (0.299 * $r + 0.587 * $g + 0.114 * $b) / 255;
        return $luminance > 0.5 ? '#000000' : '#ffffff';
    }
}
