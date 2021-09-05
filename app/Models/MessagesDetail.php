<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MessagesDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
        'messages_id',
        'sender_id'
    ];
}
