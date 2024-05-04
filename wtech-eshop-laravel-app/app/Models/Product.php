<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['name', 'description', 'price', 'count', 'category', 'brand'];

    public function images()
    {
        return $this->hasMany('App\Models\Image');
    }

    public function parameters()
    {
        return $this->hasMany('App\Models\Parameter');
    }



}