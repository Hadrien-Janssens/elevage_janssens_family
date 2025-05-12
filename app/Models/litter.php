<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Image;

class Litter extends Model
{
    protected $fillable = [
        'name',
        'mother_id',
        'father_id',
        'birth_date',
        'image_path',
        'description',
    ];

    public function kittens()
    {
        return $this->hasMany(Kitten::class);
    }

    public function mother()
    {
        return $this->belongsTo(Cat::class, 'mother_id');
    }

    public function father()
    {
        return $this->belongsTo(Cat::class, 'father_id');
    }

    public function images()
    {
        return $this->hasMany(ImagesLitters::class);
    }
}
