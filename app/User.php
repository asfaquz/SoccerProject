<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;


class User extends \Eloquent implements AuthenticatableContract
{
    use Authenticatable;
    protected $table = 'user';
}
