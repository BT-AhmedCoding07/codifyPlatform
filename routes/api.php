<?php

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ChambreController;
use App\Http\Controllers\PavillonController;
use App\Http\Controllers\PayementController;
use App\Http\Controllers\ReclamationController;

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

/**
 * *********************************[Administration ]******************************
 */


//Role Admin
Route::middleware(['auth:api','admin'])->group(function(){
/**************************[Gestion des utilisateurs]**********************************/
//Ajouter un role
Route::post('/AjouterRole', '\App\Http\Controllers\UserController@ajoutRole');
//Ajouter un profil utilisateur
Route::post('/AjouterUtilisateur', '\App\Http\Controllers\UserController@ajoutProfil');
//Modifier l'status d' un profil utilisateur
Route::put('/modifierProfil/{id}', '\App\Http\Controllers\UserController@ModifierProfil');
//Lister les profils
Route::get('/Utilisateurs','\App\Http\Controllers\UserController@listesProfils');
//Lister un profil chef de pavillon
Route::get('/Utilisateurs/ChefPavillon/{id}','\App\Http\Controllers\UserController@detailProfilUtilisateurPavillon');
//Lister un profil chef pedagogique
Route::get('/Utilisateurs/ChefPedagogique/{id}','\App\Http\Controllers\UserController@detailProfilUtilisateurPedagogique');
//Lister un profil delegue
Route::get('/Utilisateurs/delegue/{id}','\App\Http\Controllers\UserController@detailProfilUtilisateurDelegue');

/**************************[Gestion des étudiants cas social ]**********************************/
//Liste les étudiants par cas social
Route::get('/listesEtudiantsCasSocial','\App\Http\Controllers\UserController@listesEtudiantsCasSocial');
//Lister  detail d'un etudiant
Route::get('/detailEtudiant/CasSocial/{id}','\App\Http\Controllers\UserController@detailEtudiantCasSocial');
/* Gestion des etudiants mérites */
//Lister les etudiants par mérites
Route::get('/admin/listesEtudiantsMerites','\App\Http\Controllers\UserController@listesEtudiantsMerites');
//Lister detail d'un étudiant
Route::get('/admin/detailEtudiant/Merite/{id}','\App\Http\Controllers\UserController@detailEtudiantMerite');
/* Gestion des pavillons */
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
/* Gestion des chambres */
//Lister les Chambre
Route::get('/admin/chambres', '\App\Http\Controllers\ChambreController@index');
//Ajouter une chambre
Route::post('/admin/chambre/create/{pavillon}', '\App\Http\Controllers\ChambreController@store');
//Modifier une chambre
Route::put('/admin/chambre/update/{id}', '\App\Http\Controllers\ChambreController@update');
//Detail chambre
Route::get('/admin/chambre/read/{id}', '\App\Http\Controllers\ChambreController@show');
//Supprimer une chambre
Route::delete('/admin/chambre/delete/{id}', '\App\Http\Controllers\ChambreController@destroy');
/**Gestion de validation des codifications */
//Valider un étudiant non attribuer
Route::put('/ValiderEtudiant/update/{id}','\App\Http\Controllers\UserController@validerEtudiant');
//Lister les etudiants payer
Route::get('/ListesDesPayements','\App\Http\Controllers\PayementController@listesPayments');
//
});
/**
 * Perspectives :
 *Modifier un étudiant par mérite
 *Route::put('/ModifierEtudiantsMerites', '\App\Http\Controllers\UserController@modifierEtudiantMerite');
 *Modifier un étudiant cas social
 *Route::put('/ModifierEtudiantsCasSocial', '\App\Http\Controllers\UserController@modifierEtudiantCasSocial');
*/

/**
 * *********************************[Chef de Service Pédagogique]******************************
 */
Route::middleware(['auth:api','role'])->group(function(){
/**Gestion des étudiants par mérite */
//Ajouter un étudiant
Route::post('/ajoutEtudiant/Merite', '\App\Http\Controllers\UserController@ajoutEtudiantMerite');
// //Lister les étudiants par mérite
Route::get('/listesEtudiantsMerites','\App\Http\Controllers\UserController@listesEtudiantsMerites');
//Lister detail d'un etudiant
Route::get('/detailEtudiant/Merite/{id}','\App\Http\Controllers\UserController@detailEtudiantMerite');
});
/**
 * *********************************[Délégué]******************************
*/
Route::middleware(['auth:api','delegue'])->group(function(){
    /**Gestion des étudiants de cas social */
    //Ajouter étudiant cas social
Route::post('/ajoutEtudiant/CasSocial', '\App\Http\Controllers\UserController@ajoutEtudiantCasSocial');
//Lister les étudiants par mérite
//Liste les étudiants par cas social
Route::get('/delegues/listesEtudiantsCasSocial','\App\Http\Controllers\UserController@listesEtudiantsCasSocial');
//Lister  detail d'un etudiant
Route::get('/delegues/detailEtudiant/CasSocial/{id}','\App\Http\Controllers\UserController@detailEtudiantCasSocial');

});

/**

 * *********************************[Chef Pavillon]******************************
 */
//Role = Chef de pavillon
Route::middleware(['auth:api','profil'])->group(function(){
/**Gestion des chambres */
//Lister les Chambre
Route::get('/chambres', '\App\Http\Controllers\ChambreController@index');
//Modifier une chambre
Route::put('/chambre/update/{id}', '\App\Http\Controllers\ChambreController@update');
//Detail chambre
Route::get('/chambre/{id}', '\App\Http\Controllers\ChambreController@show');
/**
 * *********************************[Gestion des réclamations des Etudiants]******************************
 */
//Lister les reclamation(s)
Route::get('/listerDesReclamations', '\App\Http\Controllers\ReclamationController@index');
//Detail une reclamation
Route::get('/detailReclamation/read/{id}', '\App\Http\Controllers\ReclamationController@show');
//Modifier l'status d'une réclamation ou traité une réclamation
Route::put('/traiterReclamation/{id}', '\App\Http\Controllers\ReclamationController@traiterUneReclamation');
//Supprimer une reclamation
Route::delete('/SupprimerReclamation/delete/{id}', '\App\Http\Controllers\ReclamationController@destroy');


});
/**
 * *********************************[Etudiant]******************************
 */
//Etudiant
Route::middleware(['auth:api','etudiant'])->group(function(){
//Faire une reclamation
Route::post('/faireReclamations', '\App\Http\Controllers\ReclamationController@faireReclamation');
//Historique réclamation
Route::get('/historiquesReclamations', '\App\Http\Controllers\ReclamationController@historiqueReclamation');

//Faire un paiement
Route::get('/FairePayement','\App\Http\Controllers\PayementController@fairePayement');
//Historique de payement
Route::get('/HistoriquePayement', '\App\Http\Controllers\PayementController@historiquePayement');
});
/**
 * *********************************[Authentification]******************************
 */
Route::group(['middleware' => 'api', 'prefix' => 'auth'], function ($router) {
//Login User
Route::post('/login', '\App\Http\Controllers\AuthController@login');
//Logout User
Route::post('/logout', '\App\Http\Controllers\AuthController@logout');
//Rafraichir Utilisateur
Route::post('/refresh', '\App\Http\Controllers\AuthController@refresh');
//Utilisateur Connecter
Route::post('/me', '\App\Http\Controllers\AuthController@me');
//Utilisateur connecté
Route::get('/me', '\App\Http\Controllers\AuthController@me');

});

/**
 * ********************************[Paiement]*************************************
 */

Route::get('payment', [PayementController::class, 'index'])->name('payment.index');
Route::post('/checkout', [PayementController::class, 'payment'])->name('payment.submit');
Route::get('ipn', [PayementController::class, 'ipn'])->name('paytech-ipn');
Route::get('payment-success/{code}', [PayementController::class, 'success'])->name('payment.success');
Route::get('payment/{code}/success', [PayementController::class, 'paymentSuccessView'])->name('payment.success.view');
Route::get('payment-cancel', [PayementController::class, 'cancel'])->name('paytech.cancel');
