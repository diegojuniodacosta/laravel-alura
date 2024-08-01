<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SeriesFormRequest;
use App\Models\Series;
use App\Repositories\SeriesRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class SeriesController extends Controller
{
    public function __construct(
        protected SeriesRepository $repository
    )
    {}

    public function index(Request $request)
    {
        // Criando a $query
        $query = Series::query();

        if($request->has('nome')){
            $query->where('nome', $request->nome);
        }

        return $query->paginate(5);
    }

    public function store(SeriesFormRequest $request)
    {
        $serie = $this->repository->add($request);

        // 201 = série criada
        return response()->json($serie, 201);
    }

    public function show(int $series)
    {
        $seriesModel = Series::with('seasons.episodes')->find($series);
        if ($seriesModel === null){
            return response()->json(['message' => 'Series not found'], 404);
        }

        return $seriesModel;
    }

    public function update(Series $series, SeriesFormRequest $request)
    {
        $series->fill($request->all());

        $series->links;

        $series->save();

        return $series;
    }

    public function destroy(int $series)
    {
        Series::destroy($series);

        return response()->noContent();
    }
}
