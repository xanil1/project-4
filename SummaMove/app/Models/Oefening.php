<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Oefening extends Model
{
    protected $table = 'oefening';
    public $timestamps = false;

    protected $fillable = [
        'name',
        'description',
        'description_en',
        'image'
    ];
}
