<?php

class UserTypes
{
    public $timestamps = false;

    protected $table = 'user_types';

    protected $fillable = [
        'id',
        'description',
    ];
}