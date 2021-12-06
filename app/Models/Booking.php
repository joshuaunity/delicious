<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'bid', 'name', 'email', 'phone', 'people_num', 
        'message', 'booking_date', 'booking_time', 
        'status', 'booking_token',
    ];
}
