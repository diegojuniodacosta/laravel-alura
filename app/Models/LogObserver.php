<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogObserver extends Model
{
    use HasFactory;

    protected $table = 'log_observer';
    protected $fillable = [
        'event',
        'data'
    ];

    protected $casts = [
        'data' => 'array',
    ];
}
