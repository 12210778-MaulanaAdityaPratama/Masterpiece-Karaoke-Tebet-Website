<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class GalleryPhoto extends Model
{
    protected $fillable = [
        'submitter_name',
        'caption',
        'image_path',
        'status',
    ];

    /** Hanya foto yang sudah diapprove */
    public function scopeApproved(Builder $query): Builder
    {
        return $query->where('status', 'approved');
    }

    /** Foto yang masih pending */
    public function scopePending(Builder $query): Builder
    {
        return $query->where('status', 'pending');
    }
}
