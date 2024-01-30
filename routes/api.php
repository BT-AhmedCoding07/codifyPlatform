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

//Role Admin
Route::middleware(['auth:api','admin'])->group(function(){
//Ajouter étudiant cas social
Route::post('/ajoutEtudiant/CasSocial', '\App\Http\Controllers\UserController@ajoutEtudiantCasSocial');
//Ajouter un profil utilisateur
Route::post('/AjouterUtilisateur', '\App\Http\Controllers\UserController@ajoutProfil');
//Ajouter un role
Route::post('/AjouterRole', '\App\Http\Controllers\UserController@ajoutRole');

//Modifier l'status d' un profil utilisateur
Route::put('/modifierProfil/{id}', '\App\Http\Controllers\UserController@ModifierProfil');
//Lister les Pavillon
Route::get('/pavillons', '\App\Http\Controllers\PavillonController@index');
//Ajouter un pavillon
Route::post('/pavillon/create', '\App\Http\Controllers\PavillonController@store');
//Modifier un pavillon
Route::put('/pavillon/update/{id}', '\App\Http\Controllers\PavillonController@update');
//Detail un pavillon
Route::get('/pavillon/read/{id}', '\App\Http\Controllers\PavillonController@show');
//Supprimer un pavillon
Route::delete('/pavillon/delete/{id}', '\App\Http\Controllers\PavillonController@destroy');
//Lister les etudiants par mérites
Route::get('/listesEtudiantsMerites','\App\Http\Controllers\UserController@listesEtudiantsMerites');
//Liste les étudiants par cas social
Route::get('/listesEtudiantsCasSocial','\App\Http\Controllers\UserController@listesEtudiantsCasSocial');
//Lister les étudiants par mérite
Route::get('/listesEtudiantsCasSocial','\App\Http\Controllers\UserController@listesEtudiantsCasSocial');
//Liste  detail d'un etudiant
Route::get('/detailEtudiant/CasSocial/{id}','\App\Http\Controllers\UserController@detailEtudiantCasSocial');
//Lister detail d'un étudiant
Route::get('/detailEtudiant/Merite/{id}','\App\Http\Controllers\UserController@detailEtudiantMerite');
//Lister les profils
Route::get('/Utilisateurs','\App\Http\Controllers\UserController@listesProfils');
//Valider un étudiant non attribuer
Route::put('/ValiderEtudiant/update/{id}','\App\Http\Controllers\UserController@validerEtudiant');
});
//Role = Chef de Service Pédagogique
Route::middleware(['auth:api','role'])->group(function(){
//Ajouter un étudiant
Route::post('/ajoutEtudiant/Merite', '\App\Http\Controllers\UserController@ajoutEtudiantMerite');
//Modifier un étudiant
Route::put('/ModifierEtudiantsMerites', '\App\Http\Controllers\UserController@modifierEtudiantMerite');
// //Lister les étudiants par mérite
Route::get('/listesEtudiantsMerites','\App\Http\Controllers\UserController@listesEtudiantsMerites');
//Lister detail d'un etudiant
Route::get('/detailEtudiant/Merite/{id}','\App\Http\Controllers\UserController@detailEtudiantMerite');
//Validation mail
Route::get('/Validation/{email}','\App\Http\Controllers\UserController@SendMailValidation');
});
//Role = Chef de pavillon
Route::middleware(['auth:api','profil'])->group(function(){
 //Lister les Chambre
Route::get('/chambres', '\App\Http\Controllers\ChambreController@index');
//Ajouter une chambre
Route::post('/chambre/create', '\App\Http\Controllers\ChambreController@store');
//Modifier une chambre
Route::put('/chambre/update/{id}', '\App\Http\Controllers\ChambreController@update');
//Detail chambre
Route::get('/chambre/read/{id}', '\App\Http\Controllers\ChambreController@show');
//Supprimer une chambre
Route::delete('/chambre/delete/{id}', '\App\Http\Controllers\ChambreController@destroy');
//Lister les reclamation(s)
Route::get('/listerDesReclamations', '\App\Http\Controllers\ReclamationController@index');
//Detail une reclamation
Route::get('/detailReclamation/read/{id}', '\App\Http\Controllers\ReclamationController@show');
//Traiter une réclamation
Route::put('/traiterReclamation/{id}', '\App\Http\Controllers\ReclamationController@traiterUneReclamation');
});
//Etudiant
Route::middleware(['auth:api','etudiant'])->group(function(){
//Faire une reclamation
Route::post('/faireReclamations', '\App\Http\Controllers\ReclamationController@store');
//Supprimer une reclamation
Route::delete('/SupprimerReclamation/delete/{id}', '\App\Http\Controllers\ReclamationController@destroy');
});

Route::group(['middleware' => 'api', 'prefix' => 'auth'], function ($router) {
//Login User
Route::post('login', '\App\Http\Controllers\AuthController@login');
//Logout User
Route::post('logout', '\App\Http\Controllers\AuthController@logout');
//Rafraichir Utilisateur
Route::post('refresh', '\App\Http\Controllers\AuthController@refresh');
//Utilisateur Connecter
Route::post('me', '\App\Http\Controllers\AuthController@me');
});
//Utilisateur connecté
Route::get('me', '\App\Http\Controllers\AuthController@me');



