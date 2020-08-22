<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserTypes extends Model
{
    public function users()
    {
        return $this->hasMany(Users::class);
    }

    protected $table = 'user_types';

    protected $fillable = [
        'id',
        'description',
    ];
}