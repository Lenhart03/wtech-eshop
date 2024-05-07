<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;


class user extends Authenticatable
{
    use Notifiable;

    public $timestamps = false;
    protected $fillable = ['firstname',
                            'lastname',
                            'email',
                            'password',
                            'user_group',
                            ];
}
