<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Statut;
use App\Models\Chambre;
use App\Models\Etudiant;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserController extends Controller
{
    //Ajout d'un etudiant type = mérite
    public function ajoutEtudiantMerite(Request $request)
    {
        // dd($request->all());
        try {
            $request->validate([
                'nom' => 'required|string|max:255',
                'prenom' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:6',
                'roles_id' => 'integer', Rule::exists('roles','id'),
                'telephone' => 'nullable|numeric|unique:users|regex:/^[0-9]{9}$/',
                'photo_profile' => '',
                'moyennes' => 'required',
                'INE'=> 'required|string|max:13|unique:etudiants',
                'date_naissance'=> 'date',
                'lieu_naissance'=> 'required|string|max:255',
                'adresse'=> 'required|string|max:255',
                'sexe'=> 'required|string|max:255',
                'niveau_etudes'=> 'required|string|max:255',
                'filiere'=> 'required|string|max:255',
                'statuts_id' => 'integer',Rule::exists('statuts','id'),
            ]);

            $user = new User();
            $etudiant = new Etudiant();
            $user->nom = $request->input('nom');
            $user->prenom = $request->input('prenom');
            $user->email = $request->input('email');
            $user->telephone = $request->input('telephone');
            $user->photo_profile = $request->input('photo_profile');
            $user->roles_id = $request->input('roles_id');
            $user->password = Hash::make($request->password);
            $user->save();
            $etudiant->INE  = $request->input('INE');
            $etudiant->date_naissance  = $request->input('date_naissance');
            $etudiant->lieu_naissance  = $request->input('lieu_naissance');
            $etudiant->adresse  = $request->input('adresse');
            $etudiant->sexe  = $request->input('sexe');
            $etudiant->moyennes  = $request->input('moyennes');
            $etudiant->niveau_etudes  = $request->input('niveau_etudes');
            $etudiant->filiere  = $request->input('filiere');
            $etudiant->statuts_id = $request->input('statuts_id');


            $etudiant->users_id = $user->id;

            if ($etudiant->save()) {
                return response()->json([
                    "message" => " Etudiant ajouté avec success",
                    "Etudiant" => array_merge(array($etudiant), array($user))
                ]);
            } else {
                $user->delete();
                return response()->json(["message" => "impossible d'ajouter un etudiant "]);
            }
        } catch (ValidationException $e) {
            return response()->json([
                'errors' => $e->errors(),
            ], 422);
        }
    }
    //Ajout d'un etudiant type = cas social
    public function ajoutEtudiantCasSocial(Request $request)
    {
        // dd($request->all());
        try {
            $request->validate([
                'nom' => 'required|string|max:255',
                'prenom' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:6',
                'roles_id' => 'integer', Rule::exists('roles','id'),
                'telephone' => 'nullable|numeric|regex:/^[0-9]{9}$/',
                'photo_profile' => '',
                'INE'=> 'required|string|max:13|unique:etudiants',
                'date_naissance'=> 'date',
                'lieu_naissance'=> 'required|string|max:255',
                'adresse'=> 'required|string|max:255',
                'sexe'=> 'required|string|max:255',
                'niveau_etudes'=> 'required|string|max:255',
                'filiere'=> 'required|string|max:255',
                'statuts_id' => 'integer',Rule::exists('statuts','id'),
            ]);

            $user = new User();
            $etudiant = new Etudiant();

            $user->nom = $request->input('nom');
            $user->prenom = $request->input('prenom');
            $user->email = $request->input('email');
            $user->telephone = $request->input('telephone');
            $user->photo_profile = $request->input('photo_profile');
            $user->roles_id = $request->input('roles_id');
            $user->password = Hash::make($request->password);
            $user->save();
            $etudiant->INE  = $request->input('INE');
            $etudiant->date_naissance  = $request->input('date_naissance');
            $etudiant->lieu_naissance  = $request->input('lieu_naissance');
            $etudiant->adresse  = $request->input('adresse');
            $etudiant->sexe  = $request->input('sexe');
            $etudiant->niveau_etudes  = $request->input('niveau_etudes');
            $etudiant->filiere  = $request->input('filiere');
            $etudiant->statuts_id = $request->input('statuts_id');

            $etudiant->users_id = $user->id;

            if ($etudiant->save()) {
                return response()->json([
                    "message" => " Etudiant ajouté avec success",
                    "Etudiant" => array_merge(array($etudiant), array($user))
                ]);
            } else {
                $user->delete();
                return response()->json(["message" => "impossible d'ajouter un etudiant "]);
            }
        } catch (ValidationException $e) {
            return response()->json([
                'errors' => $e->errors(),
            ], 422);
        }
    }
    //Ajout un profil Ex:Chef de pavillon, chef de service pédagogique
    public function ajoutProfil(Request $request)
    {
        //dd($request->all());
        try {
            $request->validate([
                'nom' => 'required|string|max:255',
                'prenom' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:6',
                'roles_id' => 'integer', Rule::exists('roles','id'),
                'telephone' => 'nullable|numeric|regex:/^[0-9]{9}$/',
                'photo_profile' => 'image|mimes:jpeg,png,jpg.svg',
            ]);

            $user = new User();

            $user->nom = $request->input('nom');
            $user->prenom = $request->input('prenom');
            $user->email = $request->input('email');
            $user->password = Hash::make($request->password);
            $user->telephone = $request->input('telephone');
            $user->photo_profile = $request->input('photo_profile');
            $user->roles_id = $request->input('roles_id');

            if ($user->save()) {
                return response()->json([
                    "message" => "Profil Ajouté  avec success",
                    "profil" =>  array($user)
                ]);
            } else {
                $user->delete();
                return response()->json(["message" => "impossible d'ajouter  un profil"]);
            }
        } catch (ValidationException $e) {
            return response()->json([
                'errors' => $e->errors(),
            ], 422);
        }
    }
    //Function Ajout Image
    // private function AjoutImage($image){
    //     return $image->store('photo_profile', 'public');
    // }
    // //Gerer l'image
    // if($request->hash_file('photo_profile')){
    //     $imagePath = $this->storeImage($request->file('photo_profile'));
    //     $input['photo_profile'] = $imagePath;
    // }

    //Changer l'status de l'utilisateur en Inactif
    public function ModifierProfil(Request $request, $userId)
    {
        try {
            $request->validate([
                'status' => 'required|in:Actif,Inactif',
            ]);

            $user = User::findOrFail($userId);

            if ($user->update(['status' => $request->input('status')])) {
                return response()->json([
                    "message" => "Statut du profil modifié avec succès",
                    "profil" => [$user],
                ]);
            } else {
                return response()->json(["message" => "Impossible de modifier le statut du profil"]);
            }
        } catch (ValidationException $e) {
            return response()->json([
                'errors' => $e->errors(),
            ], 422);
        }
    }

    //Valider un Etudiant
    /*
    Algorithme: Valider un étudiant
    Le chef de Service Pédagogique insère les étudiants par ordre de mérite
    Le chef de Service d'hébergement listes les étudiant par ordre de mérite
    Valider les étudiant par ordre de mérite
    */
      //Valider un Etudiant
    public function validerEtudiant(){

    }
      //Lister un/les etudiant(s)
    public function listesEtudiantsMerites(){
            $etudiants =Etudiant::where('statuts_id', 1)->get();
            return response()->json([
                'Etudiants: ' =>   $etudiants
            ],201);
    }
    public function listesEtudiantsCasSocial(){
        $etudiants =Etudiant::where('statuts_id', 2)->get();
        return response()->json([
            'Etudiants: ' =>   $etudiants
        ],201);
    }
    public function detailEtudiant($id){
        try {
            $etudiant = Etudiant::findOrFail($id);

            return response()->json([
                'Etudiant: ' => $etudiant
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(["message" => "Étudiant non trouvé"], 404);
        }

    }
    //Lister un/les utilisateur(s)
    public function listesProfils(){

    }

}

