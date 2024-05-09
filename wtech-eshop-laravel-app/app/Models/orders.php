<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class orders extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['user_id', 'time_ordered', 'state', 'firstname', 'lastname', 'transport','street_name','zip_code','phone_number','payment'];
}
