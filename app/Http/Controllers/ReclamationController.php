<?php

namespace App\Http\Controllers;

use App\Models\Chambre;
use App\Models\Etudiant;

use App\Models\Reclamation;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
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
     * @OA\Post(
     *     path="/api/faireReclamations",
     *     summary="Créer une nouvelle réclamation.",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"objet", "message", "chambres_id"},
     *             @OA\Property(property="objet", type="string"),
     *             @OA\Property(property="message", type="string"),
     *             @OA\Property(property="chambres_id", type="integer"),
     *         ),
     *     ),
     *     @OA\Response(response="200", description="Réclamation créée avec succès."),
     *     @OA\Response(response="404", description="Erreur lors de la création de la réclamation."),
     *     @OA\Response(response="500", description="Erreur lors de la création de la réclamation."),
     * )
     */
    public function store(Request $request)
    {
        $chambre = Chambre::find($request->chambres_id);
        $input = $request->validate([
            'objet' => ['required'],
            'message' => ['required'],
            'chambres_id' => ['required', Rule::exists('chambres', 'id')],
        ]);

        if(!$chambre) {
            return response()->json([
                'message' => 'La chambre d\'ID saisi n\'existe pas.',
            ], 404);
        } else {
            $reclamation = Reclamation::create($input);

            if ($reclamation->save()) {
                return response()->json([
                    'Message: ' => 'Success!',
                    'Réclamation created: ' => $reclamation
                ], 200);
            } else {
                return response([
                    'Message: ' => 'Création réclamation impossible.',
                ], 500);
            }
        }
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
                'Message: ' => 'We could not find the reclamation.',
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
                'Message' => 'Reclamation deleted with success.',
            ], 200);
        } else {
            return response()->json([
                'Message' => 'We could not find the reclamation.',
            ], 500);
        }
    }

       /**
     * @OA\Post(
     *     path="/api/traiterReclamation/{id}",
     *     summary="Traiter une réclamation pour une chambre spécifique.",
     *     @OA\Parameter(name="chambreId", in="path", required=true, description="ID de la chambre", @OA\Schema(type="integer")),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"status"},
     *             @OA\Property(property="status", type="string", enum={"En Cours", "Traité"}),
     *         ),
     *     ),
     *     @OA\Response(response="200", description="Statut de la réclamation modifié avec succès."),
     *     @OA\Response(response="422", description="Erreur de validation."),
     *     @OA\Response(response="404", description="La chambre spécifiée n'existe pas."),
     *     @OA\Response(response="500", description="Erreur lors de la modification du statut de la réclamation."),
     * )
     */
    public function traiterUneReclamation(Request $request, $chambreId){
        try {
            $request->validate([
                'status' => 'required|in:En Cours,Traité',
            ]);
            $chambre = Chambre::findOrFail($chambreId);

            if ($chambre->update(['status' => $request->input('status')])) {
                return response()->json([
                    "message" => "Statut de la réclamation traité avec succès",
                    "profil" => [$chambre],
                ]);
            } else {
                return response()->json(["message" => "Impossible de modifier le statut de réclamation"]);
            }
        } catch (ValidationException $e) {
            return response()->json([
                'errors' => $e->errors(),
            ], 422);
        }
    }

}
