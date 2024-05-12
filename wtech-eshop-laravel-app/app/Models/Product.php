<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['name', 'description', 'price', 'count', 'search_keys', 'brand', 'category'];

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function parameters()
    {
        return $this->hasMany('App\Models\Parameter');
    }



}
