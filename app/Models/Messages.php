<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\MessageDetail;

class Messages extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_one',
        'user_two'
    ];

    public function details()
    {
        return $this->hasOne(MessageDetail::class);
    }
}
