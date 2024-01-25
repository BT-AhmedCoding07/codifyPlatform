<?php

namespace App\Http\Controllers;

use App\Models\Chambre;
use App\Models\Etudiant;
use App\Models\Pavillon;
use Illuminate\Http\Request;

use Illuminate\Validation\Rule;
use App\Http\Requests\UpdateChambreRequest;

class ChambreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $chambres = Chambre::all();
          return response()->json([
              'Chambre: ' =>  $chambres,
          ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request  $request)
    // {
    //     $pavillon = Pavillon::find($request->pavillons_id);
    //     $etudiant = Etudiant::find($request->etudiants_id);
    //     $input = $request->validate([
    //         'libelle' => ['required'],
    //         'type_chambre' => ['required'],
    //         'nombres_lits' => ['required'],
    //         'nombres_limites' => ['required', 'numeric', 'max:12'] ,
    //         'pavillons_id' => ['required', Rule::exists('pavillons', 'id')],
    //         'etudiants_id'=> ['required', Rule::exists('etudiants', 'id')],
    //     ]);
    //     if(!$etudiant){
    //         return response()->json([
    //             'message' => 'L\'étudiant d\'ID saisi n\'existe pas.',
    //         ], 404);
    //     }
    //     elseif (!$pavillon) {
    //         return response()->json([
    //             'message' => 'Le pavillon d\'ID saisi n\'existe pas.',
    //         ], 404);
    //     }
    //     elseif($request->etudiants_id > 12){
    //         return response()->json([
    //             'Message: ' => 'Le nombre limite de la chambre est atteind',
    //         ], 404);
    //     }
    //     else{
    //         $chambre = Chambre::create($input);

    //         if($chambre ->save()){
    //             return response()->json([
    //                 'Message: ' => 'Success!',
    //                 'Room created: ' =>  $chambre
    //             ], 200);

    //         }else {
    //             return response([
    //                 'Message: ' => 'We could not create a new room.',
    //             ], 500);
    //         }
    //        }
    // }

    public function store(Request $request)
    {
        $pavillon = Pavillon::find($request->pavillons_id);
        $etudiant = Etudiant::find($request->etudiants_id);

        $input = $request->validate([
            'libelle' => ['required'],
            'type_chambre' => ['required'],
            'nombres_lits' => ['required'],
            'nombres_limites' => ['required', 'numeric', 'max:12'],
            'pavillons_id' => ['required', Rule::exists('pavillons', 'id')],
            'etudiants_id' => ['required', Rule::exists('etudiants', 'id')],
        ]);

        if (!$etudiant) {
            return response()->json([
                'message' => 'L\'étudiant d\'ID saisi n\'existe pas.',
            ], 404);
        } elseif (!$pavillon) {
            return response()->json([
                'message' => 'Le pavillon d\'ID saisi n\'existe pas.',
            ], 404);
        } elseif ($request->nombres_limites > 12) {
            return response()->json([
                'Message: ' => 'Le nombre limite de la chambre ne doit pas dépasser 12.',
            ], 404);
        } else {
            $chambre = Chambre::create($input);

            if ($chambre->save()) {
                return response()->json([
                    'Message: ' => 'Success!',
                    'Room created: ' => $chambre
                ], 200);
            } else {
                return response([
                    'Message: ' => 'We could not create a new room.',
                ], 500);
            }
        }
    }


    /**
     * Display the specified resource.
     */

    public function show(string $id){

        $chambre = Chambre::find($id);

        if ($chambre){

            return response()->json([
                'Message: ' => 'Chambre found.',
                'Chambre: ' => $chambre
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
    public function update(Request $request, string $id){

        $chambre = Chambre::find($id);

        $pavillon = Pavillon::find($request->pavillons_id);
        if (!$pavillon) {
            return response()->json([
                'message' => 'Le pavillon d\'ID saisi n\'existe pas.',
            ], 404);
        }else{
            if($chambre){

                $input = $request->validate([
                     'libelle' => ['required'],
                     'type_chambre' => ['required'],
                     'nombres_lits' => ['required'],
                     'nombres_limites' => ['required', 'numeric', 'max:12'] ,
                     'pavillons_id' => ['required', Rule::exists('pavillons', 'id')],
                     'etudiants_id' => ['required', Rule::exists('etudiants', 'id')],
                    ]);
                 $chambre->libelle = $input['libelle'];
                 $chambre->type_chambre = $input['type_chambre'];
                 $chambre->nombres_lits = $input['nombres_lits'];
                 $chambre->nombres_lits = $input['nombres_limites'];
                 $chambre->pavillons_id = $input['pavillons_id'];

                 if($chambre->save()){

                     return response()->json([

                         'Message: ' => 'Chambre updated with success.',
                         'Chambre: ' => $chambre

                     ], 200);


                 }else {

                     return response([

                         'Message: ' => 'We could not update the room.',

                     ], 500);

                 }
             }else {

                 return response([

                     'Message: ' => 'We could not find the room.',

                 ], 500);
             }
        }



    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id){

        $chambre = Chambre::find($id);


        if($chambre){

            $chambre->delete();

            return response()->json([

                'Message: ' => 'chambre deleted with success.',

            ], 200);

        }else {

            return response([

                'Message: ' => 'We could not find the room.',

            ], 500);
        }

    }
}
