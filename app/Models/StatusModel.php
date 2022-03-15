<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

abstract class StatusModel extends Model
{
    protected $hidden = [
        'created_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function computer()
    {
        return $this->belongsTo(Computer::class);
    }
}
