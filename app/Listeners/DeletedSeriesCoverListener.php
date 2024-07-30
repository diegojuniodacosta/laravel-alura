<?php

namespace App\Listeners;

use App\Events\SeriesDeleted;
use Illuminate\Support\Facades\Storage;

class DeletedSeriesCoverListener
{
    public function __construct()
    {}

    public function handle(SeriesDeleted $event): void
    {
        Storage::disk('public')->delete($event->seriesCover);
    }
}
