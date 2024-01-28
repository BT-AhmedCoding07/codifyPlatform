<?php

namespace App\Http\Controllers;

use App\Models\Chambre;
use App\Models\Etudiant;

use App\Models\Reclamation;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class ReclamationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reclamations = Reclamation::all();

        return response()->json([
            'Reclamation: ' =>  $reclamations
        ],201);
    }

    /**
     * Store a newly created resource in storage.
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
     * Display the specified resource.
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
     * Remove the specified resource from storage.
     */
    public function destroy(Reclamation $reclamation)
    {
        //
    }
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
