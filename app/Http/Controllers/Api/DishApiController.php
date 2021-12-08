<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ExtraFunc as ExtraFunc;
use App\Http\Controllers\Controller;
use App\Models\Dish;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DishApiController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if ($request->isMethod('get')) {
            $dishes = Dish::where('status', 1)->get([
                'dish_name', 'dish_slug', 'dish_category', 'dish_price', 'dish_description', 
            ]);

            if ($dishes) {
                return ExtraFunc::formatted_response(["status" => true, "data" => $dishes]);
            } else {
                return ExtraFunc::formatted_response(["status" => true, "msg" => "Something went wrong"]);
            }

        }

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

        $dish = Dish::create([
            'dish_name' => $data['dish_name'],
            'dish_price' => $data['dish_price'],
            'dish_category' => $data['dish_category'],
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
