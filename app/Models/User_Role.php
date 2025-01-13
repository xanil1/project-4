<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_Role extends Model
{
    protected $table = 'role_user';

    protected $fillable = [
        'role_id', 'user_id'
    ];

    public function Role()
    {
        return $this->belongsTo(Role::class);
    }
}
