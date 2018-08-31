<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;

class Account extends \Eloquent implements Authenticatable
{
    use AuthenticableTrait;
    protected $fillable = ["id", "user_id", "name", "currency_id", "initial_balance", "current_balance"];
}