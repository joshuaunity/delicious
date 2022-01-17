<?php

namespace App\Http\Controllers;

use App\Helpers\ExtraFunc as ExtraFunc;
use App\Models\Dish;
use App\Models\DishCategory;
use App\Models\Sale;
use Illuminate\Http\Request;
use Response;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dishes = Dish::all();

        $dish_categories = DishCategory::all();

        $sales = Sale::all()->where('status', 1)->sortByDesc('created_at');

        return view('admin.sales', compact('sales', 'dishes', 'dish_categories'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dishes = Dish::inRandomOrder()->first();
        $cid = DishCategory::where('category_name', $dishes->dish_category)
            ->pluck('cid')[0];
        $genders = array('male', 'female');
        $gender_key = array_rand($genders);
        $ages = array(16, 17, 18, 19, 20, 21);
        $gender_key = array_rand($genders);

        $token = ExtraFunc::gentoken(20);

        $sale = Sale::create([
            'did' => $dishes->did,
            'cid' => $cid,
            'gender' => $genders[$gender_key],
            'age' => rand(15, 90),
            'location' => null,
            'sale_token' => $token,
            'status' => 1,
        ]);

        $sale->update([
            'sid' => $sale->id,
        ]);

        // return Response::json($sale);

        return response()->json($sale);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function show(Sale $sale)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function edit(Sale $sale)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sale $sale)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sale $sale)
    {
        $sale->update([
            'status' => 0,
        ]);

        return redirect()->back()->with('delete', 'Sale has been revoked');

    }
}
