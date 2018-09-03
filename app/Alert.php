<?php 
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;

class Alert extends \Eloquent implements Authenticatable
{
    use AuthenticableTrait;
    protected $fillable = ["id", "user_id", "notification"];
}