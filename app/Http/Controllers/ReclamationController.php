<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Chambre;

use App\Models\Etudiant;

use App\Models\Reclamation;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
/**
 * @OA\Tag(
 *     name="Réclamations",
 *     description="Endpoints pour la gestion des réclamations."
 * )
 */
class ReclamationController extends Controller
{
     /**
     * @OA\Get(
     *     path="/api/listerDesReclamations",
     *     summary="Récupérer la liste des réclamations.",
     *     @OA\Response(response="201", description="Liste des réclamations."),
     * )
     */
    public function index()
    {
        $reclamations = Reclamation::all();

        return response()->json([
            'Reclamation: ' =>  $reclamations
        ],201);
    }
     /**
     * @OA\Get(
     *     path="/api/detailReclamation/read/{id}",
     *     summary="Récupérer les détails d'une réclamation spécifique.",
     *     @OA\Parameter(name="id", in="path", required=true, description="ID de la réclamation", @OA\Schema(type="string")),
     *     @OA\Response(response="200", description="Réclamation trouvée."),
     *     @OA\Response(response="500", description="Erreur lors de la recherche de la réclamation."),
     * )
     */
    public function show(string $id){

        $reclamation = Reclamation::find($id);

        if ($reclamation){

            return response()->json([
                'Message: ' => 'Reclamation trouvé.',
                'Reclamation: ' => $reclamation
            ], 200);

        } else {
            return response([
                'Message: ' => 'Nous n\'avons pas pu trouver la récupération.',
            ], 500);
        }
    }
    /**
     * @OA\Delete(
     *     path="/SupprimerReclamation/delete/{id}",
     *     summary="Supprimer une reclamation spécifique.",
     *     @OA\Parameter(name="id", in="path", required=true, description="ID de la reclamation", @OA\Schema(type="string")),
     *     @OA\Response(response="200", description="reclamation supprimée avec succès."),
     *     @OA\Response(response="500", description="Erreur lors de la suppression de la réclamation."),
     * )
     */
    public function destroy($id)
    {
        $reclamation = Reclamation::find($id);

        if ($reclamation) {
            $reclamation->delete();

            return response()->json([
                'Message' => 'Reclamation supprimé avec success.',
            ], 200);
        } else {
            return response()->json([
                'Message' => 'Nous n\'avons pas pu trouver la réclamation.',
            ], 500);
        }
    }

    public function traiterUneReclamation(Request $request, $reclamationId)
    {
        try {
            $request->validate([
                'status' => 'required|in:Ouvert,Traité',
            ]);

            // Vérifier que l'ID de la réclamation est valide
            $reclamation = Reclamation::findOrFail($reclamationId);
            // Mettre à jour le statut de la réclamation
            $reclamation->status = $request->input('status');
            if ($reclamation->save()) {
                return response()->json([
                    "message" => "Réclamation traitée avec succès",
                    "reclamation" => $reclamation,
                ]);
            } else {
                return response()->json(["message" => "Impossible de modifier le statut de la réclamation"]);
            }
        } catch (ValidationException $e) {
            return response()->json([
                'errors' => $e->errors(),
            ], 422);
        }
    }

    public function historiqueReclamation() {

        $user = auth()->user();
        $etudiant = Etudiant::where('users_id', $user->id)->first();
       // dd($etudiant);
        if (!$etudiant) {
            return response()->json(['message' => 'Aucune chambre associée à cet étudiant'], 404);
        }else{
            $reclamation = Reclamation::where("etudiants_id", $etudiant->id)->get();
            if(!$reclamation){
                return response()->json(['message' => 'Aucune réclamation associée à cette chambre'], 404);
            }else{
                return response()->json(['Historiques'=> $reclamation], 201);
            }
        }
    }

    public function faireReclamation(Request $request) {
       $user = auth()->user();
       $etudiant = Etudiant::where('users_id', $user->id)
       ->where('estAttribue', 1)
       ->where('chambres_id', '!=', NULL)
       ->first();
        if (!$etudiant) {
            return response()->json(['message' => 'Aucune chambre associée à cet étudiant'], 404);
        }else {
            $request->validate([
                'objet' => ['required'],
                'message' => ['required'],
            ]);
            $reclamation = new Reclamation();
            $reclamation->objet = $request->input('objet');
            $reclamation->message = $request->input('message');
            $reclamation->etudiants_id = $etudiant->id;
            //dd($reclamation);
            if ($reclamation->save()) {
                return response()->json([
                    'Message' => 'Success!',
                    'Réclamation created' => $reclamation
                ], 200);
            }
            elseif(!$reclamation->save()) {
                return response([
                'Message' => 'Création réclamation impossible.',
                ], 500);
            }
            else {
                return response()->json(["message" => "L'étudiant n'est pas autorisé à faire une réclamation"]);
            }
        }
    }


}
