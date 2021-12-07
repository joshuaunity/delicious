<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use App\Models\DishCategory;
use Illuminate\Http\Request;

class LinksController extends Controller
{
    public function index()
    {
        $dishes = Dish::all()->where('status', 1)->sortByDesc('created_at');
        $dishcategories = DishCategory::all()->where('status', 1)->sortByDesc('created_at');
        return view('index', compact('dishes', 'dishcategories'));
    }

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
}
