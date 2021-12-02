<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Helpers\ExtraFunc as ExtraFunc;


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
        $dishes = Dish::all()->where('status', 1)->sortByDesc('created_at');
        // if (count($dishes) > 0) { 
        //     dd("data found");
        // } else{
        //     dd("no data");
        // }

        return view('admin.dishes' , compact('dishes')); 
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
            'dish_name' => 'required',
            'dish_price' => 'required|numeric|min:2|max:200',
            'dish_category' => 'required',
            'dish_description' => 'required',
        ]);

        $token = ExtraFunc::gentoken(20);
        $slug = Str::slug($data['dish_name'], '-');

        Dish::create([
            'dish_name' => $data['dish_name'],
            'dish_price' => $data['dish_price'],
            'dish_category' => $data['dish_category'],
            'dish_description' => $data['dish_description'],
            'dish_slug' => $slug,
            'dish_token' => $token,
            'status' => 1,
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
        //
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
