<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use App\Helpers\ExtraFunc as ExtraFunc;

class BookingController extends Controller
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
        $data = request()->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'people_num' => 'required',
            'message' => 'required',
            'booking_date' => 'required|date',
            'booking_time' => 'required|date_format:H:i',
        ]);

        $token = ExtraFunc::gentoken(20);

        $booking = Booking::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'people_num' => $data['people_num'],
            'message' => $data['message'],
            'booking_date' => $data['booking_date'],
            'booking_time' => $data['booking_time'],
            'booking_token' => $token,
            'status' => 1,
        ]);

        // return $booking->id;

        $booking->update([
            'bid' => $booking->id,
        ]);

        return redirect()->back()->with('success', 'Your booking was successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function show(Booking $booking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function edit(Booking $booking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Booking $booking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function destroy(Booking $booking)
    {
        //
    }
}
