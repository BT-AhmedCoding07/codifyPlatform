<?php

namespace App\Http\Controllers;

use App\Models\Chambre;
use App\Models\Etudiant;

use App\Models\Reclamation;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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
                'Message: ' => 'Chambre found.',
                'Chambre: ' => $reclamation
            ], 200);

        } else {
            return response([
                'Message: ' => 'We could not find the room.',
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, string $id){

    //     $reclamation = Reclamation::find($id);

    //     $etudiant = Etudiant::find($request->etudiants_id);
    //     if (!$etudiant) {
    //         return response()->json([
    //             'message' => 'Le pavillon d\'ID saisi n\'existe pas.',
    //         ], 404);
    //     }else{
    //         if($chambre){

    //             $input = $request->validate([
    //                  'libelle' => ['required'],
    //                  'type_chambre' => ['required'],
    //                  'nombres_lits' => ['required'],
    //                  'nombres_limites' => ['required', 'numeric', 'max:12'] ,
    //                  'pavillons_id' => ['required', Rule::exists('pavillons', 'id')],
    //                  'etudiants_id' => ['required', Rule::exists('etudiants', 'id')],
    //                 ]);
    //              $chambre->libelle = $input['libelle'];
    //              $chambre->type_chambre = $input['type_chambre'];
    //              $chambre->nombres_lits = $input['nombres_lits'];
    //              $chambre->nombres_lits = $input['nombres_limites'];
    //              $chambre->pavillons_id = $input['pavillons_id'];

    //              if($chambre->save()){

    //                  return response()->json([

    //                      'Message: ' => 'Chambre updated with success.',
    //                      'Chambre: ' => $chambre

    //                  ], 200);


    //              }else {

    //                  return response([

    //                      'Message: ' => 'We could not update the room.',

    //                  ], 500);

    //              }
    //          }else {

    //              return response([

    //                  'Message: ' => 'We could not find the room.',

    //              ], 500);
    //          }
    //     }
    // }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reclamation $reclamation)
    {
        //
    }
}
