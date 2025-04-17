<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Litter extends Model
{
    protected $fillable = [
        'name',
        'mother_id',
        'father_id',
        'birth_date',
    ];

    public function kittens()
    {
        return $this->hasMany(Kitten::class);
    }

    public function mother()
    {
        return $this->belongsTo(Cats::class, 'mother_id');
    }

    public function father()
    {
        return $this->belongsTo(Cats::class, 'father_id');
    }
}
