<?php

namespace App\Listeners;

use App\Events\SeriesCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

// Implementando ShouldQueue para colocar a execução dos listener na fila
class LogSeriesCreated implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param SeriesCreated $event
     * @return void
     */
    public function handle(SeriesCreated $event)
    {
        Log::info("Série { $event->seriesName } criada com sucesso");
    }
}
