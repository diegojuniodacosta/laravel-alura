<?php

namespace App\Http\Controllers;

use App\Events\EventsUtils;
use App\Events\SeriesDeleted;
use App\Http\Requests\SeriesFormRequest;
use App\Jobs\SeriesDeletedJob;
use App\Jobs\SeriesUpdatedJob;
use App\Mail\SeriesCreated;
use App\Mail\SeriesCreated2;
use App\Models\Series;
use App\Models\User;
use App\Repositories\SeriesRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class SeriesController extends Controller
{
    public function __construct(private SeriesRepository $repository)
    {
        $this->middleware('auth')->except('index');
    }

    public function index(Request $request)
    {
        $series = Series::all();
        $mensagemSucesso = session('mensagem.sucesso');

        return view('series.index')->with('series', $series)
            ->with('mensagemSucesso', $mensagemSucesso);
    }

    public function create()
    {
        return view('series.create');
    }

    public function store(SeriesFormRequest $request)
    {
        // Para armazenar o arquivo em um local temporário, podemos utilizar o método store()
        // Foi salvo no diretório storage/app/public
        if ($request->file('cover') !== null) {
            $coverPath = $request->file('cover')
                ->store('series_cover', 'public');
            $request->coverPath = $coverPath;
        }

        $serie = $this->repository->add($request);

        // Podemos utilizar, seria a mesma coisa e nao ia utilizar event($seriesCreatedEvent)
        // \App\Events\SeriesCreated::dispatch(
        // $serie->nome,
        // $serie->id,
        // $request->seasonsQty,
        // $request->episodesPerSeason,
        //);


        // Instanciando o evento
        $seriesCreatedEvent = new \App\Events\SeriesCreated(
            $serie->nome,
            $serie->id,
            $request->seasonsQty,
            $request->episodesPerSeason,
        );
        // Vamos enviar o evento
        // Utilizando o método event
        event($seriesCreatedEvent);

        return to_route('series.index')
            ->with('mensagem.sucesso', "Série '{$serie->nome}' adicionada com sucesso");
    }


    public function destroy(Series $series)
    {
        // Dispara o evento para deleção do arquivo (Trabalhando com Listener)
        /*if (isset($series->cover)){
            SeriesDeleted::dispatch($series->cover);
        }*/

        // Dispara o evento para deleção do arquivo (Trabalhando com Job)
        if (isset($series->cover)){
            SeriesDeletedJob::dispatch($series->cover);
        }


        $series->delete();

        return to_route('series.index')
            ->with('mensagem.sucesso', "Série '{$series->nome}' removida com sucesso");
    }

    public function edit(Series $series)
    {
        return view('series.edit')->with('serie', $series);
    }

    public function update(Series $series, SeriesFormRequest $request)
    {
        $series->fill($request->all());
        $seriesSave = $series->save();

        if ($seriesSave){
            SeriesUpdatedJob::dispatch($series);
        }

        return to_route('series.index')
            ->with('mensagem.sucesso', "Série '{$series->nome}' atualizada com sucesso");
    }
}
