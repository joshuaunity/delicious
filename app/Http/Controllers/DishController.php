<?php

namespace App\Http\Controllers;

use App\Helpers\ExtraFunc as ExtraFunc;
use App\Models\Dish;
use App\Models\DishCategory;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DishController extends Controller
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
        // all category seprate
        // all dish seperate
        // 
        // ->where('cid', $sale->cid)->pluck('category_name')[0]
        
        $dishes = Dish::all()->where('status', 1)->sortByDesc('created_at');



        
        $dishcategories = DishCategory::all()->where('status', 1);

        $sales = Sale::all()->where('status', 1)->sortByDesc('created_at');

        // $cat_salad = Sale::all()->where('status', 1)->where('dish_category', 'salads')->sum('salads');
        $cat_salad = Sale::all()->where('status', 1);

        // return $cat_salad;

        return view('admin.dishes', compact('dishes', 'dishcategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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
            'cid' => 'required',
            'dish_name' => 'required',
            'dish_price' => 'required|numeric|min:2|max:200',
            'dish_description' => 'required',
        ]);

        $token = ExtraFunc::gentoken(20);
        $slug = Str::slug($data['dish_name'], '-');

        $dish = Dish::create([
            'cid' => $data['cid'],
            'dish_name' => $data['dish_name'],
            'dish_price' => $data['dish_price'],
            'dish_description' => $data['dish_description'],
            'dish_slug' => $slug,
            'dish_token' => $token,
            'status' => 1,
        ]);

        // return $dish->id;

        $dish->update([
            'did' => $dish->id,
        ]);

        return redirect()->back()->with('success', 'Dish has been created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Dish  $dish
     * @return \Illuminate\Http\Response
     */
    public function show(Dish $dish)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Dish  $dish
     * @return \Illuminate\Http\Response
     */
    public function edit(Dish $dish)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Dish  $dish
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dish $dish)
    {
        $data = request()->validate([
            'dish_name' => 'required',
            'dish_price' => 'required|numeric|min:2|max:200',
            'dish_category' => 'required',
            'dish_description' => 'required',
        ]);

        $slug = Str::slug($data['dish_name'], '-');

        $dish->update([
            'dish_name' => $data['dish_name'],
            'dish_price' => $data['dish_price'],
            'dish_category' => $data['dish_category'],
            'dish_description' => $data['dish_description'],
            'dish_slug' => $slug,
        ]);

        return redirect()->back()->with('editsuccess', 'Dish has been edited successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Dish  $dish
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dish $dish)
    {
        $dish->update([
            'status' => 0,
        ]);

        return redirect()->back()->with('delete', 'Dish has been deleted');

    }
}
