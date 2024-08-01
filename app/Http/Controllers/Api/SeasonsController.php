<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Series;

class SeasonsController extends Controller
{
    /** Busca as temporadas a partir do id de uma série */
    public function getSeasons(Series $series)
    {
        return $series->seasons;
    }
}
