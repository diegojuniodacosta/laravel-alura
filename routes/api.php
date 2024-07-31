<?php

use App\Http\Controllers\Api\SeriesController;
use App\Models\Series;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//--------------------------------------------------------------------------

// Criando rotas de APIs
// Neste arquivo api.php as rotas ja tem o prefixo api/
// Assim a rota abaixo é 'api/series'

// Rota que retorna todas as series
// Route::get('/series', [SeriesController::class, 'index']);

// Rota para inserir uma nova série
// Route::post('/series', [SeriesController::class, 'store']);

// Criando todas rotas para SeriesController utilizando api
Route::apiResource('/series', SeriesController::class);
