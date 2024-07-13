<?php

namespace App\Listeners;

use App\Events\SeriesCreated as SeriesCreatedEvent;
use App\Mail\SeriesCreated;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

// ShouldQueue para colocar na fila
class EmailUsersAboutSeriesCreated implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct(
    )
    {}

    /**
     * Handle the event.
     * Quando este listener for executado ele receberá o evento
     * @param SeriesCreatedEvent $event
     * @return void
     */
    public function handle(SeriesCreatedEvent $event)
    {

        $userList = User::all();
        foreach ($userList as $index => $user){
            // Vamos criar o email
            $email = new SeriesCreated(
                $event->seriesName,
                $event->serieId,
                $event->seriesSeasonsQty,
                $event->seriesEpisodesPerSeason,
            );

            // Vamos utilizar a facade Mail
            //Mail::to($user)->send($email);

            // Para colocar o envio de email na fila
            //Mail::to($user)->queue($email);

            // Vamos criar $now para aguardar o tempo entre os jobs
            $when = now()->addSeconds($index * 5);

            // Podemos utilizar later para ter performance na fila
            Mail::to($user)->later($when, $email);
        }
    }
}
