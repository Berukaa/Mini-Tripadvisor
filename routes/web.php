<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BoxController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

#Route pour afficher la liste des établissements sur la page d'accueil
Route::get('/', [BoxController::class, 'indexPost']);

#Route pour la page de création d'un établisesement
Route::get('/posts/create', [BoxController::class, 'createPost']);

#Route pour afficher le nouvel établissement créé
Route::post('/posts/create', [BoxController::class, 'store']);

#Route pour supprimer un établissement
Route::delete('/', [BoxController::class, 'destroy']);

#Route pour afficher la fiche d'un établissement
Route::get('/fiche/{box_id}', [BoxController::class, 'fiche']);


Route::get('/about', function () {
    return view('layouts.about');
});

Route::get('/contact', function () {
    return view('layouts.contact');
});
