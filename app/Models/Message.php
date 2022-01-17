<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

        protected $fillable = [
        'mid', 'name', 'email', 'subject', 'message', 'is_read', 'status', 'message_token'
    ];
}
