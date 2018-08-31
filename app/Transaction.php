<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;

class Transaction extends \Eloquent implements Authenticatable
{
    use AuthenticableTrait;
    protected $fillable = [
        "id", "account_id", "description", "amount", "date", "previous_balance", "current_balance", "account_name", "type"];

    public function tags()
    {
        return $this->belongsToMany('App\Tag');
    }
    
}