<?php

namespace App\Http\Controllers;

use App\Helpers\ExtraFunc as ExtraFunc;
use App\Models\DishCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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
        return view('admin.dishcategories', compact('categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DishCategory  $dishCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DishCategory $category)
    {
        $data = request()->validate([
            'category_name' => 'required',
        ]);

        $slug = Str::slug($data['category_name'], '-');

        $category->update([
            'category_name' => $data['category_name'],
            'category_slug' => $slug,
        ]);

        return redirect()->back()->with('editsuccess', 'Category has been created successfully');

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

        $category = DishCategory::create([
            'category_name' => $data['category_name'],
            'category_slug' => $slug,
            'category_token' => $token,
            'status' => 1,
        ]);

        // return $category->id;

        $category->update([
            'cid' => $category->id,
        ]);

        return redirect()->back()->with('success', 'Category has been created successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DishCategory  $dishCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, DishCategory $category)
    {

        $category->update([
            'status' => 0,
        ]);

        return redirect()->back()->with('delete', 'Dish category has been deleted');

    }
}
