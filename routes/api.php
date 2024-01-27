<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChambreController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PavillonController;
use App\Http\Controllers\ReclamationController;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;

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

// Route::middleware('auth')->get('/user', function (Request $request) {
//     $user = auth()->user();
//     $userRole = Role::where("id",$user->roles_id )->first();
//     return response()->json($userRole->nomRole);
// });

Route::middleware(['auth:api','admin'])->group(function(){
//Ajouter étudiant cas social
Route::post('/ajoutEtudiant', '\App\Http\Controllers\UserController@ajoutEtudiantCasSocial');
//Ajouter un profil utilisateur
Route::post('/ajoutProfil', '\App\Http\Controllers\UserController@ajoutProfil');
//Modifier l'status d' un profil utilisateur
Route::put('/modifierProfil/{id}', '\App\Http\Controllers\UserController@ModifierProfil');
//Pavillon
Route::get('pavillons', '\App\Http\Controllers\PavillonController@index');
Route::post('pavillon/create', '\App\Http\Controllers\PavillonController@store');
Route::put('pavillon/update/{id}', '\App\Http\Controllers\PavillonController@update');
Route::get('pavillon/read/{id}', '\App\Http\Controllers\PavillonController@show');
Route::get('pavillon/delete/{id}', '\App\Http\Controllers\PavillonController@destroy');
//Lister les etudiants par mérites
Route::get('/listesEtudiantsMerites','\App\Http\Controllers\UserController@listesEtudiantsMerites');
//Liste les étudiants par cas social
Route::get('/listesEtudiantsCasSocial','\App\Http\Controllers\UserController@listesEtudiantsCasSocial');
//Liste en detail un etudiant
Route::get('/detailEtudiant/{id}','\App\Http\Controllers\UserController@detailEtudiant');
});

Route::middleware(['auth:api','role'])->group(function(){
//Ajouter un étudiant
Route::post('ajoutEtudiants', '\App\Http\Controllers\UserController@ajoutEtudiantMerite');
//Modifier un étudiant
Route::put('ModifierEtudiantsMerites', '\App\Http\Controllers\UserController@modifierEtudiantMerite');
//Lister les étudiants par mérite
Route::get('/listesEtudiantsMerites','\App\Http\Controllers\UserController@listesEtudiantsMerites');


//Lister les étudiants par mérite
Route::get('/detailEtudiant{id}','\App\Http\Controllers\UserController@detailEtudiant');

});

Route::middleware(['auth:api','profil'])->group(function(){
 //Chambre
Route::get('chambres', '\App\Http\Controllers\ChambreController@index');
Route::post('chambre/create', '\App\Http\Controllers\ChambreController@store');
Route::put('chambre/update/{id}', '\App\Http\Controllers\ChambreController@update');
Route::get('chambre/read/{id}', '\App\Http\Controllers\ChambreController@show');
Route::delete('chambre/delete/{id}', '\App\Http\Controllers\ChambreController@destroy');
//Lister un/les reclamation(s)
Route::get('listerDesReclamations', '\App\Http\Controllers\ReclamationController@index');
Route::get('detailReclamation/read/{id}', '\App\Http\Controllers\ReclamationController@show');

//Traitement à faire
Route::get('traiterReclamation/read/{id}', '\App\Http\Controllers\ReclamationController@traiterReclamation');

});

Route::middleware(['auth:api','etudiant'])->group(function(){
//Reclamations
Route::post('faireReclamations', '\App\Http\Controllers\ReclamationController@store');
Route::delete('reclamations/delete/{id}', '\App\Http\Controllers\ReclamationController@destroy');
});



Route::group(['middleware' => 'api','prefix' => 'auth'], function ($router) {
Route::post('login', '\App\Http\Controllers\AuthController@login');
Route::post('logout', '\App\Http\Controllers\AuthController@logout');
Route::post('refresh', '\App\Http\Controllers\AuthController@refresh');
Route::post('me', '\App\Http\Controllers\AuthController@me');
});
//Utilisateur connecté
Route::get('me', '\App\Http\Controllers\AuthController@me');



