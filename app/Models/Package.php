<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Package extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'duration_hours', 'image', 'is_active', 'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function tiers()
    {
        return $this->hasMany(PackageTier::class)->orderBy('sort_order');
    }

    public function activeTiers()
    {
        return $this->hasMany(PackageTier::class)
            ->where('is_available', true)
            ->orderBy('sort_order');
    }
    public function getImageUrlAttribute(): ?string
    {
        if ($this->image) {
            return asset('storage/' . $this->image);
        }
        return null;
    }
}
