<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SeriesFormRequest;
use App\Models\Series;
use App\Repositories\SeriesRepository;
use Illuminate\Database\Eloquent\Collection;

class SeriesController extends Controller
{
    public function __construct(
        protected SeriesRepository $repository
    )
    {}

    public function index(): Collection
    {
        return Series::all();
    }

    public function store(SeriesFormRequest $request)
    {
        $serie = $this->repository->add($request);

        // 201 = série criada
        return response()->json($serie, 201);
    }

    public function show(Series $series): Series
    {
        return $series;
    }

    public function update(Series $series, SeriesFormRequest $request)
    {
        $series->fill($request->all());
        $series->save();

        return $series;
    }

    public function destroy(int $series)
    {
        Series::destroy($series);

        return response()->noContent();
    }
}
