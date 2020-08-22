<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserTypes extends Model
{
    public $timestamps = false;

    protected $table = 'user_types';

    protected $fillable = [
        'id',
        'description',
    ];
}