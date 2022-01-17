<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Dish;

use App\Models\DishCategory;
use Illuminate\Http\Request;
use App\Helpers\ExtraFunc as ExtraFunc;

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
            'satisfied' => 0,
        ]);

        // return $booking->id;

        $booking->update([
            'bid' => $booking->id,
        ]);

        return redirect()->back()->with('success', 'Your booking was successfully');
    }

    public function store_message(Request $request)
    {
        $data = request()->validate([
            'name' => 'required',
            'email' => 'required',
            'subject' => 'required',
            'message' => 'required',
        ]);

        $token = ExtraFunc::gentoken(20);

        $message = Message::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'subject' => $data['subject'],
            'message' => $data['message'],
            'message_token' => $token,
            'is_read' => 0,
            'status' => 1,
        ]);

        // return $message->id;

        $message->update([
            'mid' => $message->id,
        ]);

        return redirect()->back()->with('message_success', 'Message has been sent successfully');
    }
}
