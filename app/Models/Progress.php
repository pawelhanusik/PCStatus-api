<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Progress extends StatusModel
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'computer_id',
        'title',
        'progress',
        'progress_max',
        'message',
    ];
}
