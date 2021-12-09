<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ExtraFunc as ExtraFunc;
use App\Http\Controllers\Controller;
use App\Models\Sale;
use Illuminate\Http\Request;

class SaleApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->isMethod('post')) {

            $data = request()->validate([
                'did' => 'required',
                'cid' => 'required',
                'gender' => 'required',
            ]);

            $token = ExtraFunc::gentoken(20);

            $sale = Sale::create([
                'did' => $data['did'],
                'cid' => $data['cid'],
                'gender' => $data['gender'],
                'sale_token' => $token,
                'status' => 1,
            ]);

            $sale->update([
                'sid' => $sale->id,
            ]);

            if ($sale) {
                return ExtraFunc::formatted_response(["status" => true, "msg" => "Sale has been added successfully"]);
            } else {
                return ExtraFunc::formatted_response(["status" => true, "msg" => "Something went wrong"]);
            }

        }

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
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sale $sale)
    {
        //
    }
}
