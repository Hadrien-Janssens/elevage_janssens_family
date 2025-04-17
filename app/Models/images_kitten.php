<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Images_kitten extends Model
{
    protected $fillable = [
        'kitten_id',
        'image_path',
    ];

    public function kitten()
    {
        return $this->belongsTo(Kitten::class);
    }
}
