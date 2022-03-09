<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Computer extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'sort',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
