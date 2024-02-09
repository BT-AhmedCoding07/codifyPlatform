<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Statut;
use App\Models\Chambre;
use App\Mail\Validation;
use App\Models\Etudiant;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserController extends Controller
{
     /**
     * @OA\Post(
     *     path="/api/ajoutEtudiant/Merite",
     *     summary="Ajouter un etudiant par mérite.",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"nom", "prenom", "email", "password", "roles_id", "telephone","photo_profile","moyennes","INE","date_naissance","filiere","lieu_naissance","adresse","sexe","niveau_etudes","statuts_id"},
     *             @OA\Property(property="nom", type="string"),
     *             @OA\Property(property="prenom", type="string"),
     *             @OA\Property(property="email", type="string"),
     *             @OA\Property(property="password", type="string"),
     *             @OA\Property(property="roles_id", type="integer"),
     *             @OA\Property(property="telephone", type="string"),
     *             @OA\Property(property="photo_profile", type="string"),
     *             @OA\Property(property="moyennes", type="string"),
     *             @OA\Property(property="INE", type="string"),
     *             @OA\Property(property="date_naissance", type="date"),
     *             @OA\Property(property="filiere", type="string"),
     *             @OA\Property(property="sexe", type="string", enum={"homme", "femme"}),
     *             @OA\Property(property="niveau_etudes", type="string"),
     *             @OA\Property(property="statuts_id", type="integer"),
     *         ),
     *     ),
     *     @OA\Response(response="200", description="Etudiant ajouté avec succès."),
     *     @OA\Response(response="402", description="Erreur lors de l'ajout de l'étudiant."),
     * )
     */
    public function ajoutEtudiantMerite(Request $request)
    {
        // dd($request->all());
        try {
            $request->validate([
                'nom' => 'required|string|max:255',
                'prenom' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:6',
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
                'chambres_id' => 'integer', Rule::exists('chambres','id'),
            ]);
            $user = new User();
            $etudiant = new Etudiant();
            $user->nom = $request->input('nom');
            $user->prenom = $request->input('prenom');
            $user->email = $request->input('email');
            $user->telephone = $request->input('telephone');
            $user->photo_profile = $request->input('photo_profile');
            $user->roles_id = 4;
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
            $etudiant->statuts_id = 1;
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
    /**
     * @OA\Post(
     *     path="/api/ajoutEtudiant/CasSocial",
     *     summary="Ajouter un etudiant par mérite.",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"nom", "prenom", "email", "password", "roles_id", "telephone","photo_profile","moyennes","INE","date_naissance","filiere","lieu_naissance","adresse","sexe","niveau_etudes","statuts_id"},
     *             @OA\Property(property="nom", type="string"),
     *             @OA\Property(property="prenom", type="string"),
     *             @OA\Property(property="email", type="string"),
     *             @OA\Property(property="password", type="string"),
     *             @OA\Property(property="roles_id", type="integer"),
     *             @OA\Property(property="telephone", type="string"),
     *             @OA\Property(property="photo_profile", type="string"),
     *             @OA\Property(property="moyennes", type="string"),
     *             @OA\Property(property="INE", type="string"),
     *             @OA\Property(property="date_naissance", type="date"),
     *             @OA\Property(property="filiere", type="string"),
     *             @OA\Property(property="sexe", type="enum"),
     *             @OA\Property(property="niveau_etudes", type="string"),
     *             @OA\Property(property="statuts_id", type="integer"),
     *         ),
     *     ),
     *     @OA\Response(response="200", description="Etudiant ajouté avec succès."),
     *     @OA\Response(response="422", description="Erreur lors de l'ajout de l'étudiant."),
     * )
     */
    public function ajoutEtudiantCasSocial(Request $request)
    {


        try {
            $request->validate([
                'nom' => 'required|string|max:255',
                'prenom' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:6',
                'telephone' => 'nullable|numeric|regex:/^[0-9]{9}$/',
                'photo_profile' => '',
                'INE'=> 'required|string|max:13|unique:etudiants',
                'date_naissance'=> 'date',
                'lieu_naissance'=> 'required|string|max:255',
                'adresse'=> 'required|string|max:255',
                'sexe'=> 'required|string|max:255',
                'niveau_etudes'=> 'required|string|max:255',
                'filiere'=> 'required|string|max:255',
            ]);

            $user = new User();
            $etudiant = new Etudiant();
            $chambre = Chambre::where($request->chambres_id)->get();
            dd($chambre);
            $user->nom = $request->input('nom');
            $user->prenom = $request->input('prenom');
            $user->email = $request->input('email');
            $user->telephone = $request->input('telephone');
            $user->photo_profile = $request->input('photo_profile');
            $user->roles_id = 4;
            $user->password = Hash::make($request->password);
            $user->save();
            $etudiant->INE  = $request->input('INE');
            $etudiant->date_naissance  = $request->input('date_naissance');
            $etudiant->lieu_naissance  = $request->input('lieu_naissance');
            $etudiant->adresse  = $request->input('adresse');
            $etudiant->sexe  = $request->input('sexe');
            $etudiant->niveau_etudes  = $request->input('niveau_etudes');
            $etudiant->filiere  = $request->input('filiere');
            $etudiant->statuts_id = 2;
            $etudiant->users_id = $user->id;
            $etudiant->chambres_id= $chambre->id;
            if ($etudiant->save()) {
                $etudiant->update(['estAttribue' => 1]);
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

    // modifierEtudiantMerite
    // modifierEtudiantCasSocial
    /**
     * @OA\Post(
     *     path="/api/ajoutProfil",
     *     summary="Ajouter un profil.",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"nom", "prenom", "email", "password", "roles_id", "telephone","photo_profile"},
     *             @OA\Property(property="nom", type="string"),
     *             @OA\Property(property="prenom", type="string"),
     *             @OA\Property(property="email", type="string"),
     *             @OA\Property(property="password", type="string"),
     *             @OA\Property(property="roles_id", type="integer"),
     *             @OA\Property(property="telephone", type="string"),
     *             @OA\Property(property="photo_profile", type="string"),
     *         ),
     *     ),
     *     @OA\Response(response="200", description="Utilisateur ajouté avec succès."),
     *     @OA\Response(response="422", description="Erreur lors de l'ajout de l'utilisateur."),
     * )
     */
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
            //$logoPath = $request->file('photo_profile')->store('Image\photo_profile', 'public');

            $user->nom = $request->input('nom');
            $user->prenom = $request->input('prenom');
            $user->email = $request->input('email');
            $user->password = Hash::make($request->password);
            $user->telephone = $request->input('telephone');
            $user->photo_profile =$request->input('photo_profile');
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

    /**
     * @OA\Put(
     *     path="/api/modifierProfil/{id}",
     *     summary="Modifier un profil utilisateur.",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"status"},
     *         @OA\Property(property="sexe", type="string", enum={"homme", "femme"}),
     *         ),
     *     ),
     *     @OA\Response(response="200", description="Statut  profil mise à jour  avec succès."),
     *     @OA\Response(response="422", description="Erreur Impossible de  modifier l'statut du profil."),
     * )
    */
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
     /**
     * @OA\Put(
     *     path="/ValiderEtudiant/update/{id}",
     *     summary="Mettre à jour les détails d'une chambre spécifique.",
     *     @OA\Parameter(name="id", in="path", required=true, description="ID de la Etudiant", @OA\Schema(type="string")),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"estAttribue"},
     *             @OA\Property(property="estAttribue", type="boolean"),
     *         ),
     *     ),
     *     @OA\Response(response="200", description="Etudiant avec succès."),
     *     @OA\Response(response="500", description="Etudiant non trouvé."),
     * )
     */

    public function validerEtudiant($etudiantId){

        try {
            $etudiant = Etudiant::findOrFail($etudiantId);
            $user = User::where('id',$etudiant->users_id)->first();
            if ($etudiant->estAttribue == 1) {
                return response()->json([
                    "message" => "L'étudiant a déjà été attribué."
                ], 400);
            }

            $etudiant->update(['estAttribue' => 1]);
            //logique mail
            Mail::to($user->email)->send(new Validation());
            return response()->json([
                "message" => "Étudiant validé avec succès."
            ], 200);

        } catch (ModelNotFoundException $e) {
                return response()->json(["message" => "Étudiant non trouvé"], 404);
        }
    }

    /**
     * @OA\Get(
     *     path="/api/listesEtudiantsMerites",
     *     summary="Récupérer la liste des étudiants par mérite.",
     *     @OA\Response(response="200", description="Liste des étudiants."),
     * )
    */
    public function listesEtudiantsMerites(){

            // $etudiants =Etudiant::where('statuts_id', 1)->get();
            $etudiants = Etudiant::with('users')->where('statuts_id', 1)->get();
            $data=[];
            foreach($etudiants as $etudiant){
                $user=$etudiant->users;
                $data[]=[
                    'nom' => $user->nom,
                    'prenom' => $user->prenom,
                    'email' => $user->email,
                    'roles_id' =>$user->roles_id,
                    'telephone' => $user->telephone,
                    'INE'=> $etudiant['INE'],
                    'date_naissance'=>$etudiant['date_naissance'] ,
                    'lieu_naissance'=>$etudiant['lieu_naissance'] ,
                    'adresse'=> $etudiant['adresse'],
                    'sexe'=> $etudiant['sexe'],
                    'niveau_etudes'=>$etudiant['niveau_etudes'],
                    'filiere'=> $etudiant['filiere'],
                    'statuts_id' =>$etudiant['filiere']
                ];
            }
            return response()->json($data);
    }
    /**
     * @OA\Get(
     *     path="/api/listesEtudiantsCasSocial",
     *     summary="Récupérer la liste des étudiants par mérite.",
     *     @OA\Response(response="200", description="Liste des étudiants."),
     * )
    */
    public function listesEtudiantsCasSocial(){
        $etudiants = Etudiant::with('users')->where('statuts_id', 2)->get();
        $data=[];
        foreach($etudiants as $etudiant){
            $user=$etudiant->users;
            $data[]=[
                'nom' => $user->nom,
                'prenom' => $user->prenom,
                'email' => $user->email,
                'roles_id' =>$user->roles_id,
                'telephone' => $user->telephone,
                'INE'=> $etudiant['INE'],
                'date_naissance'=>$etudiant['date_naissance'] ,
                'lieu_naissance'=>$etudiant['lieu_naissance'] ,
                'adresse'=> $etudiant['adresse'],
                'sexe'=> $etudiant['sexe'],
                'niveau_etudes'=>$etudiant['niveau_etudes'],
                'filiere'=> $etudiant['filiere'],
            ];
        }
        return response()->json($data);
    }
     /**
     * @OA\Get(
     *     path="/detailEtudiant/{id}",
     *     summary="Récupérer les détails d'un etudiant spécifique.",
     *     @OA\Parameter(name="id", in="path", required=true, description="ID de la chambre", @OA\Schema(type="string")),
     *     @OA\Response(response="200", description="Chambre trouvée."),
     *     @OA\Response(response="500", description="Erreur lors de la recherche de la chambre."),
     * )
     */
    public function detailEtudiantCasSocial($id){
        try {
            // $etudiant = Etudiant::where('statuts_id', 2)->get();
            $etudiant = Etudiant::with('users')->where('statuts_id', 2)->findOrFail($id);
            return response()->json([
                "Etudiant" => $etudiant
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(["message" => "Étudiant non trouvé"], 404);
        }

    }
         /**
     * @OA\Get(
     *     path="/detailEtudiant/{id}",
     *     summary="Récupérer les détails d'un etudiant spécifique.",
     *     @OA\Parameter(name="id", in="path", required=true, description="ID de la chambre", @OA\Schema(type="string")),
     *     @OA\Response(response="200", description="Chambre trouvée."),
     *     @OA\Response(response="500", description="Erreur lors de la recherche de la chambre."),
     * )
     */
    public function detailEtudiantMerite($id){
        try {
            // $etudiant = Etudiant::where('statuts_id', 1)->get();
               $etudiant = Etudiant::with('users')->where('statuts_id', 1)->findOrFail($id);
            return response()->json([
                "Etudiant" => $etudiant
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(["message" => "Étudiant non trouvé"], 404);
        }

    }
      /**
     * @OA\Get(
     *     path="/api/Utilisateurs",
     *     summary="Récupérer la liste des étudiants par mérite.",
     *     @OA\Response(response="200", description="Liste des étudiants."),
     * )
    */
    //Lister un/les utilisateur(s)
    public function listesProfils(){
        $users = User::whereIn('roles_id', [2, 3])
            ->join('roles', 'users.roles_id', '=', 'roles.id')
            ->select('users.nom', 'users.prenom', 'users.email', 'users.telephone', 'users.status','roles.nomRole')
            ->get();
        return response()->json([
            "Utilisateurs" => $users
        ], 201);
    }

    //Lister un profil
          /**
     * @OA\Get(
     *     path="/detailEtudiant/{id}",
     *     summary="Récupérer les détails d'un etudiant spécifique.",
     *     @OA\Parameter(name="id", in="path", required=true, description="ID de la chambre", @OA\Schema(type="string")),
     *     @OA\Response(response="200", description="Chambre trouvée."),
     *     @OA\Response(response="500", description="Erreur lors de la recherche de la chambre."),
     * )
     */
    //
    public function detailProfilUtilisateurPavillon($id){
        try {
            $user = User::where('roles_id', 2)->get();

            return response()->json([
                "Profil" => $user
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(["message" => "Utilisateur non trouvé"], 404);
        }

    }
    public function detailProfilUtilisateurPedagogique($id){
        try {
            $user = User::where('roles_id', 3)->get();

            return response()->json([
                "Profil" => $user
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(["message" => "Utilisateur non trouvé"], 404);
        }

    }
    //Ajout Role
    public function ajoutRole(Request $request)
    {
        try {
            $request->validate([
                "nomRole" => 'required|string|max:255',
            ]);

            $role = new Role();
            $role->nomRole = $request->input('nomRole');

            if ($role->save()) {
                return response()->json([
                    "message" => "Role Ajouté  avec success",
                    "Role" =>  array($role)
                ]);
            } else {
                $role->delete();
                return response()->json(["message" => "impossible d'ajouter un role"]);
            }
        } catch (ValidationException $e) {
            return response()->json([
                "errors" => $e->errors(),
            ], 422);
        }
    }
}
