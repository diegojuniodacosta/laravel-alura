<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Episode;
use App\Models\Series;
use Illuminate\Http\Request;

class EpisodesController extends Controller
{
    /**
     * Busca os episódios da série a partir da temporada
     */
    public function getEpisodes(Series $series)
    {
        return $series->episodes;
    }

    /**
     * Marca o episódio como assistido
     */
    public function watchedEpisode(Episode $episode, Request $request)
    {
        $episode->watched = $request->watched;
        $episode->save();

        return $episode;
    }
}
