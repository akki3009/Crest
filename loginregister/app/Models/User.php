<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table = 'users';

    public $timestamps = false;

    protected $fillable =[
        'name',
        'email',
        'password',
    ];
}
