<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Notification extends StatusModel
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'computer_id',
        'title',
        'message',
    ];
}
