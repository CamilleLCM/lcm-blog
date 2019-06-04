<?php

namespace App\Models;

use App\Models\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
class User extends Authenticatable
{
    protected $table = 'users';

    protected $fillable = [
        'name', 'password','email'
    ];
}
