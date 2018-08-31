<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;

class User extends \Eloquent implements Authenticatable
{
    use AuthenticableTrait;
    protected $fillable = [
        "username", "email", "gender", "password", "language_id", "currency_id", "recive_mail_notify", "dob", "maretial_status", "emplyment_id", "place", "account_status", "deleted_at", "photo"];
}