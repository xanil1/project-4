<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Oefening extends Model
{
    protected $table = 'oefening';

    protected $fillable = [
        'name',
        'description',
        'image'
    ];
}
