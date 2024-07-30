<?php

namespace App\Observers;

use App\Models\LogObserver;
use App\Models\Series;

class SeriesCreatedObserver
{
    public function created(Series $series)
    {
        LogObserver::create([
            'event' => 'created',
            'data' => $series->toArray(),
        ]);
    }

    public function updated(Series $series)
    {
        LogObserver::create([
            'event' => 'updated',
            'data' => $series->toArray(),
        ]);
    }

    public function deleted(Series $series)
    {
        LogObserver::create([
            'event' => 'deleted',
            'data' => $series->toArray(),
        ]);
    }

}
