<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Episode extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['number'];

    /**
     * Mapeando watched como bool
     */
    protected $casts = [
      'watched' => 'boolean'
    ];

    public function season()
    {
        return $this->belongsTo(Season::class);
    }

}
