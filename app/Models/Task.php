<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends StatusModel
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'computer_id',
        'title',
        'status',
        'message',
    ];
}
