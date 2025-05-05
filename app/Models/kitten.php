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
        'description',
        'price',
        'gender',
        'vaccination',
        'chip',
        'sterilization',
        'publication_at',
        'is_adopted',
        'is_booked',
        'body_color_id',
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
        return $this->hasMany(Images_Kitten::class);
    }
}
