<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BoxController;
use App\Http\Controllers\NoteController;


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

Route::get('/api', function () {
    return response()->json([
        'message' => 'Hello'
    ]);
});



#Voir la liste des établissements
Route::get('/list', [BoxController::class, 'getAll']);

#Ajouter des établissements
Route::post('/box', [BoxController::class, 'create']);

Route::get('/box', [BoxController::class, 'getAll']);

#Supprimer des établissements
Route::delete('/list/{id}', [BoxController::class, 'delete']);

#Ajouter des commentaires à n'importe quel établissement
Route::post('/box/{id}/note', [NoteController::class, 'create']);

#Supprimer des commentaires
Route::delete('/note/{id}', [NoteController::class, 'delete']);

Route::get('/note', [NoteController::class, 'getAll']);

#Voir un établissement et ses commentaires(fiche établissement)
Route::get('/fiche/{id}', [BoxController::class, 'getByID']);


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
