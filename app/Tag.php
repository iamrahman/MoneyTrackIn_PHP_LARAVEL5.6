<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;

class Tag extends \Eloquent implements Authenticatable
{
    use AuthenticableTrait;
    protected $fillable = ["id", "name", "user_id","expenditures"];

    public function transactions()
    {
        return $this->belongsToMany('App\Transaction');
    }
}