<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;

class Users extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable;

    protected $table = 'users';

    protected $fillable = [
        'name',
        'email',
        'user_types_id',
        'password',
        'cpf_cnpj'
    ];

    protected $hidden = [
        'password',
        'cpf_cnpj'
    ];

    protected $appends = ['user_type'];

    public function userTypes()
    {
        $this->hasOne(UserTypes::class);
    }

    public function getUserTypeAttribute()
    {
        return UserTypes::where('id', $this->user_types_id)->first();
    }
}
