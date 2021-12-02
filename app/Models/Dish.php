<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
    use HasFactory;

    protected $fillable = [
        'dish_name', 'dish_slug', 'dish_price', 
        'dish_description', 'dish_category', 'status', 
        'dish_token'
    ];
}
