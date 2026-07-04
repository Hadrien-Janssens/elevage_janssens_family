<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImagesKitten extends Model
{
    protected $fillable = [
        'kitten_id',
        'image_path',
        'order',
        'is_video'
    ];

    public function kitten()
    {
        return $this->belongsTo(Kitten::class);
    }

    public function litter()
    {
        return $this->belongsTo(Litter::class);
    }
}
