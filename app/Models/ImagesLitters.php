<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImagesLitters extends Model
{
    protected $fillable = [
        'litter_id',
        'image_path',
    ];

    public function litter()
    {
        return $this->belongsTo(Litter::class);
    }
}
