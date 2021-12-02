<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DishCategory extends Model
{
    use HasFactory;

    
    protected $fillable = [
        'cid', 'category_name', 'category_slug', 'status', 'category_token'
    ];
}
