<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cat extends Model
{
    /** @use HasFactory<\Database\Factories\CatsFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'birthday',
        'body_color',
        'description',
        'gender',
        'race',
    ];


    public function images()
    {
        return $this->hasMany(ImagesCat::class);
    }
}
