<?php

namespace App\Jobs;

use App\Models\LogObserver;
use App\Models\Series;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SeriesUpdatedJob
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        public Series $series
    )
    {}

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        LogObserver::create([
            'event' => 'updatedJob',
            'data' => $this->series->toArray(),
        ]);
    }
}
