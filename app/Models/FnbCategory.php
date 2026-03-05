<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class FnbCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'icon', 'is_active', 'sort_order'];
    protected $casts    = ['is_active' => 'boolean'];

    protected static function boot()
    {
        parent::boot();
        static::creating(fn($m) => $m->slug ??= Str::slug($m->name));
    }

    public function items()
    {
        return $this->hasMany(FnbItem::class)->orderBy('sort_order');
    }

    public function activeItems()
    {
        return $this->hasMany(FnbItem::class)->where('is_available', true)->orderBy('sort_order');
    }
}
