<?php 
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;

class Periodic extends \Eloquent implements Authenticatable
{
    use AuthenticableTrait;
    protected $fillable = ["id", "user_id", "account_name", "tags", "duration", "duration_left"];
}