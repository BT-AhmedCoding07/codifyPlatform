<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Chambre;
use App\Models\Etudiant;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

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
    //Ajout d'un etudiant type = mérite
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
    // public function ValiderEtudiant(Request $request, $EtudiantId){
    //     try {
    //         $request->validate([
    //             'estAttribue' => 'integer',
    //         ]);

    //         $etudiant = Etudiant::findOrFail($EtudiantId);

    //         if ( $etudiant->update(['estAttribue' => $request->input('estAttribue')])) {
    //             return response()->json([
    //                 "message" => "Chambre est attribué à un étudiant",
    //                 "profil" => [ $etudiant],
    //             ]);
    //         } else {
    //             return response()->json(["message" => "Impossible d'attribuer une chambre à un étudiant"]);
    //         }
    //     } catch (ValidationException $e) {
    //         return response()->json([
    //             'errors' => $e->errors(),
    //         ], 422);
    //     }
    // }

    // public function ValiderEtudiant(Request $request, $EtudiantId, $ChambreId){
    //     try {
    //         $request->validate([
    //             'chambres_id' => 'required|exists:chambres,id',
    //             'etudiants_id'=> 'required|exists:etudiants,id',
    //             'estAttribue' => 'integer',
    //         ]);

    //         $etudiant = Etudiant::findOrFail($EtudiantId);
    //         $Chambre = Chambre::findOrFail( $ChambreId);

    //         // Vérifier si l'étudiant est déjà attribué à une chambre
    //         if ($etudiant->estAttribue) {
    //             return response()->json(["message" => "Cet étudiant est déjà attribué à une chambre."]);
    //         }

    //         $nombreMaxEtudiantsParChambre = 12;
    //         $nombreEtudiantsAttribues = Etudiant::where('estAttribue', true)->count();

    //         // Vérifier si le maximun est atteind
    //         if ($nombreEtudiantsAttribues >= $nombreMaxEtudiantsParChambre) {
    //             return response()->json(["message" => "Le nombre maximum d'étudiants attribués à une chambre est atteint."]);
    //         }

    //         if ($etudiant->update(['estAttribue' => $request->input('estAttribue')])) {
    //             return response()->json([
    //                 "message" => "Chambre attribuée à l'étudiant avec succès",
    //                 "profil" => [$etudiant],
    //             ]);
    //         } else {
    //             return response()->json(["message" => "Impossible d'attribuer une chambre à l'étudiant"]);
    //         }
    //     } catch (ValidationException $e) {
    //         return response()->json([
    //             'errors' => $e->errors(),
    //         ], 422);
    //     }
    // }


}

