<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShoppingCart extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['user_id', 'product_id', 'quantity'];
    protected $table = 'shopping_cart';
}
