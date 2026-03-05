<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TierInclude extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'package_tier_id', 'item_name', 'quantity', 'sort_order',
    ];

    public function tier()
    {
        return $this->belongsTo(PackageTier::class, 'package_tier_id');
    }
}
