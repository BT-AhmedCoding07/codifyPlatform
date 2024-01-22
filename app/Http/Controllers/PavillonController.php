<?php

namespace App\Http\Controllers;

use App\Models\Pavillon;
use Illuminate\Http\Request;
use App\Http\Requests\StorePavillonRequest;
use App\Http\Requests\UpdatePavillonRequest;

class PavillonController extends Controller
{
    /**
     * Display a listing of the resource.
     * lister tous les pavillons
     * listesPavillons = index
     */

    public function index()
    {
        $pavillons = Pavillon::all();

          return response()->json([
              'Pavillon: ' =>  $pavillons,
          ]);
    }


    /**
     * Store a newly created resource in storage.
     * ajoutePavillon = store
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

                'Message: ' => 'We could not create a new product.',

            ], 500);
        }
    }

    /**
     * Display the specified resource.
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
     * Update the specified resource in storage.
     */
    // public function update(UpdatePavillonRequest $request, Pavillon $pavillon)
    // {
    //     //
    // }
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
     * Remove the specified resource from storage.
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
