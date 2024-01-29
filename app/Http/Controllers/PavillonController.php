<?php

namespace App\Http\Controllers;

use App\Models\Pavillon;
use Illuminate\Http\Request;
/**
 * @OA\Tag(
 *     name="Pavillons",
 *     description="Endpoints pour la gestion des pavillons."
 * )
 */

class PavillonController extends Controller
{
   /**
     * @OA\Get(
     *     path="/api/pavillons",
     *     summary="Récupérer la liste des pavillons.",
     *     @OA\Response(response="200", description="Liste des pavillons."),
     * )
     */

    public function index()
    {
        $pavillons = Pavillon::all();

          return response()->json([
              'Pavillon: ' =>  $pavillons,
          ]);
    }


    /**
         * @OA\Post(
         *     path="/api/pavillon/create",
         *     summary="Créer un nouveau pavillon.",
         *     @OA\RequestBody(
         *         required=true,
         *         @OA\JsonContent(
         *             required={"libelle", "type_pavillon", "nombres_etages", "nombres_chambres"},
         *             @OA\Property(property="libelle", type="string"),
         *             @OA\Property(property="type_pavillon", type="string"),
         *             @OA\Property(property="nombres_etages", type="integer"),
         *             @OA\Property(property="nombres_chambres", type="integer"),
         *         ),
         *     ),
         *     @OA\Response(response="200", description="Pavillon créé avec succès."),
         *     @OA\Response(response="500", description="Erreur lors de la création du pavillon."),
         * )
    */

    public function store(Request  $request)
    {
        $input = $request->validate([
            'libelle' => ['required'],
            'type_pavillon' => ['required'],
            'nombres_etages' => ['required'],
            'nombres_chambres' => ['required'],
        ]);

        $pavillon = Pavillon::create($input);

        if ($pavillon->save()){

            return response()->json([
                'Message: ' => 'Success!',
                'Pavillon created: ' =>  $pavillon
            ], 200);

        }else {

            return response([

                'Message: ' => 'We could not create a new pavillon.',

            ], 500);
        }
    }

    /**
     * @OA\Get(
     *     path="/api/pavillon/read/{id}",
     *     summary="Récupérer les détails d'un pavillon spécifique.",
     *     @OA\Parameter(name="id", in="path", required=true, description="ID du pavillon", @OA\Schema(type="string")),
     *     @OA\Response(response="200", description="Pavillon trouvé."),
     *     @OA\Response(response="500", description="Erreur lors de la recherche du pavillon."),
     * )
     */
    public function show(string $id){

        $pavillon = Pavillon::find($id);

        if ($pavillon){

            return response()->json([
                'Message: ' => 'Pavillon found.',
                'Pavillon: ' => $pavillon
            ], 200);

        } else {

            return response([

                'Message: ' => 'We could not find the pavillon.',

            ], 500);
        }
    }
    /**
     * @OA\Put(
     *     path="/api/pavillon/update/{id}",
     *     summary="Mettre à jour les détails d'un pavillon spécifique.",
     *     @OA\Parameter(name="id", in="path", required=true, description="ID du pavillon", @OA\Schema(type="string")),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"libelle", "type_pavillon", "nombres_etages", "nombres_chambres"},
     *             @OA\Property(property="libelle", type="string"),
     *             @OA\Property(property="type_pavillon", type="string"),
     *             @OA\Property(property="nombres_etages", type="integer"),
     *             @OA\Property(property="nombres_chambres", type="integer"),
     *         ),
     *     ),
     *     @OA\Response(response="200", description="Pavillon mis à jour avec succès."),
     *     @OA\Response(response="500", description="Erreur lors de la mise à jour du pavillon."),
     * )
     */
    public function update(Request $request, string $id){

        $pavillon = Pavillon::find($id);

        if($pavillon){

           $input = $request->validate([
                'libelle' => ['required'],
                'type_pavillon' => ['required'],
                'nombres_etages' => ['required'],
                'nombres_chambres' => ['required'],
            ]);

            $pavillon->libelle = $input['libelle'];
            $pavillon->type_pavillon = $input['type_pavillon'];
            $pavillon->nombres_etages = $input['nombres_etages'];
            $pavillon->nombres_chambres = $input['nombres_chambres'];

            if($pavillon->save()){

                return response()->json([

                    'Message: ' => 'Pavillon updated with success.',
                    'Pavillon: ' => $pavillon

                ], 200);


            }else {

                return response([

                    'Message: ' => 'We could not update the pavillon.',

                ], 500);

            }
        }else {

            return response([

                'Message: ' => 'We could not find the pavillon.',

            ], 500);
        }

    }

    /**
     * @OA\Delete(
     *     path="/api/pavillon/delete/{id}",
     *     summary="Supprimer un pavillon spécifique.",
     *     @OA\Parameter(name="id", in="path", required=true, description="ID du pavillon", @OA\Schema(type="string")),
     *     @OA\Response(response="200", description="Pavillon supprimé avec succès."),
     *     @OA\Response(response="500", description="Erreur lors de la suppression du pavillon."),
     * )
     */
    public function destroy(string $id){

        $pavillon = Pavillon::find($id);

        if($pavillon){

            $pavillon->delete();

            return response()->json([

                'Message: ' => 'pavillon deleted with success.',

            ], 200);

        }else {

            return response([

                'Message: ' => 'We could not find the pavillon.',

            ], 500);
        }

    }
}
