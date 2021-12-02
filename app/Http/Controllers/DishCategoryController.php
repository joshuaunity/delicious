<?php

namespace App\Http\Controllers;

use App\Models\DishCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Helpers\ExtraFunc as ExtraFunc;

class DishCategoryController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = DishCategory::all()->where('status', 1)->sortByDesc('created_at');
        return view('admin.dishcategories' , compact('categories')); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = request()->validate([
            'category_name' => 'required',
        ]);

        $token = ExtraFunc::gentoken(20);
        $slug = Str::slug($data['category_name'], '-');

        DishCategory::create([
            'category_name' => $data['category_name'],
            'category_slug' => $slug,
            'category_token' => $token,
            'status' => 1,
        ]);

        return redirect()->back()->with('success', 'Category has been created successfully');
    }
}
