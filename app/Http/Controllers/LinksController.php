<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dish;
use App\Models\DishCategory;

class LinksController extends Controller
{
    public function index()
    {
        $dishes = Dish::all()->where('status', 1)->sortByDesc('created_at');
        $dishcategories = DishCategory::all()->where('status', 1)->sortByDesc('created_at');
        return view('index', compact('dishes', 'dishcategories'));
    }
}
