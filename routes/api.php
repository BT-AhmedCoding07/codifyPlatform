<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BeneficiaireController;
use App\Http\Controllers\ChambreController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PavillonController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    // Route::post('login', 'AuthController@login');
    Route::post('login', '\App\Http\Controllers\AuthController@login');
    Route::post('logout', '\App\Http\Controllers\AuthController@logout');
    Route::post('refresh', '\App\Http\Controllers\AuthController@refresh');
    Route::post('me', '\App\Http\Controllers\AuthController@me');

});
//Ajouter un étudiant
Route::post('ajoutEtudiants', '\App\Http\Controllers\UserController@ajoutEtudiantMerite');
//Ajouter étudiant cas social
Route::post('ajoutEtudiants', '\App\Http\Controllers\UserController@ajoutEtudiantCasSocial');

//Ajouter un profil utilisateur
Route::post('ajoutProfil', '\App\Http\Controllers\UserController@ajoutProfil');

//Modifier l'status d' un profil utilisateur
Route::put('/modifierProfil/{id}', '\App\Http\Controllers\UserController@ModifierProfil');

//Pavillon
Route::controller(PavillonController::class)->group(function () {
    Route::get('pavillons', 'index');
    Route::post('pavillon/create', 'store');
    Route::put('pavillon/update/{id}', 'update');
    Route::get('pavillon/read/{id}', 'show');
    Route::delete('pavillon/delete/{id}', 'destroy');
});

//Chambre
Route::controller(ChambreController::class)->group(function () {
    Route::get('chambres', 'index');
    Route::post('chambre/create', 'store');
    Route::put('chambre/update/{id}', 'update');
    Route::get('chambre/read/{id}', 'show');
    Route::delete('chambre/delete/{id}', 'destroy');
});

//Beneficiaires
