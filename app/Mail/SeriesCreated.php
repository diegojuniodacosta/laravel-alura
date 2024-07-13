<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SeriesCreated extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(
        public string   $nomeSerie,
        public int      $idSerie,
        public int      $qtdTemporadas,
        public int      $episodiosPorTemporada,
    )
    {
        $this->subject = "Serie $this->nomeSerie criada";
    }


    public function build()
    {
        return $this->markdown('mail.series-created')
            ->with([
                'nomeSerie'             => $this->nomeSerie,
                'idSerie'               => $this->idSerie,
                'qtdTemporadas'         => $this->qtdTemporadas,
                'episodiosPorTemporada' => $this->episodiosPorTemporada,
            ]);
    }
}
