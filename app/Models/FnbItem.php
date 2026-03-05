<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FnbItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'fnb_category_id', 'name', 'description',
        'price', 'image', 'is_available', 'badge', 'sort_order',
    ];

    protected $casts = [
        'is_available' => 'boolean',
        'price'        => 'decimal:2',
    ];

    public function category()
    {
        return $this->belongsTo(FnbCategory::class, 'fnb_category_id');
    }

    public function getFormattedPriceAttribute(): string
    {
        return 'Rp ' . number_format($this->price, 0, ',', '.');
    }

    public function getImageUrlAttribute(): string
    {
        if ($this->image && file_exists(public_path('storage/' . $this->image))) {
            return asset('storage/' . $this->image);
        }
        return asset('images/fnb-placeholder.jpg');
    }
}
