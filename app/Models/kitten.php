<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kitten extends Model
{
    /** @use HasFactory<\Database\Factories\KittenFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'adopted',
        'bodycolor_id',
        'litter_id',
    ];

    public function litter()
    {
        return $this->belongsTo(Litter::class);
    }
    public function bodycolor()
    {
        return $this->belongsTo(Body_Color::class);
    }
    public function images()
    {
        return $this->hasMany(images_kitten::class);
    }
}
