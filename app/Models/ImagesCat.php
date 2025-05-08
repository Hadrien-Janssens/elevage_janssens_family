<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImagesCat extends Model
{
    protected $fillable = [
        'cat_id',
        'image_path',
    ];

    public function cat()
    {
        return $this->belongsTo(Cat::class);
    }
}
