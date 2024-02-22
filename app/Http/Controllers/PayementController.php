<?php

namespace App\Http\Controllers;

//use App\Models\Payment;
use App\Models\Payment;
use App\Models\Etudiant;
use function Ramsey\Uuid\v1;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Http\Services\PaytechService;
use App\Http\Requests\PayementRequest;
use Illuminate\Support\Facades\Redirect;

class PayementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */

    public function index()
    {

        return view('index');
    }

    public function create(){
        $payment = new Payment();
        return view('index', compact('payment'));
    }
    public function payment(PayementRequest $request)
    {
        //dd($request);
        $validated = $request->validated();


        //etudiant connecté


        // send info to api paytech
        $IPN_URL = 'https://urltowebsite.com';

        $amount = $validated['price'];
        $mois = $validated['mois'];
        $etudiants_id =$validated['etudiants_id'];
        $code = "47";
        $success_url = route('payment.success', [
            'code' => $code,
            'data' => [
                'amount' => $request->price,
                'mois' => $mois,
                'etudiants_id'=> $etudiants_id,
            ],
        ]);

        // The success_url takes two parameters: the first one can be product id and the other all data retrieved from the form

        $cancel_url = route('payment.index');
        $paymentService = new PaytechService(config('paytech.PAYTECH_API_KEY'), config('paytech.PAYTECH_SECRET_KEY'));

        $jsonResponse = $paymentService->setQuery([
            'item_price' => $amount,
            'mois' => $mois,
            'etudiants_id'=> $etudiants_id,
            'command_name' => "Votre paiement mensuelle a été effectué avec succès",
        ])
        ->setCustomeField([
                'time_command' => time(),
                'ip_user' => $_SERVER['REMOTE_ADDR'],
                'lang' => $_SERVER['HTTP_ACCEPT_LANGUAGE'],
        ])
        ->setTestMode(true) // Change it to false if you are turning in production
        ->setCurrency("xof")
        ->setRefCommand(uniqid())
        ->setNotificationUrl([
                'ipn_url' => $IPN_URL . '/ipn',
                'success_url' => $success_url,
                'cancel_url' => $cancel_url,
                ])->send();
                // dd($jsonResponse);
            if ($jsonResponse['success'] < 0) {
                // return back()->withErrors($jsonResponse['errors'][0]);
                return 'error';
            } elseif ($jsonResponse['success'] == 1) {
                // Redirection to Paytech website for completing checkout
                $token = $jsonResponse['token'];
                //$token = random_int(1,1000);
                session(['token' => $token]);
                return redirect($jsonResponse['redirect_url']);
            }
    }



    public function success(Request $request, $code)
    {

       // $token = session('token') ?? '';
        $token = random_int(1,1000);
        $data = $request->query('data');
       // dd($token);
        if (!$token || !$data) {
            return redirect()->route('payment.index')->withErrors('Token ou données manquants');
        }
       // dd($data);
        $data['token'] = $token;

        $payment = Payment::firstOrCreate([
            'token' => 1,
        ], [
            'amount' => $data['amount'],
            'mois' => $data['mois'],
            'etudiants_id'=>$data['etudiants_id'],
        ]);

        if (!$payment) {
            return redirect()->route('payment.index')->withErrors('Échec de la sauvegarde du paiement');
        }

        session()->forget('token');

        return view('success');
    }


    public function paymentSuccessView(Request $request, $code)
    {


        return view('vendor.paytech.success'/* , compact('record') */)->with('success', 'Félicitation, Votre paiement est éffectué avec succès');
    }

    public function cancel()
    {
        # code...
    }

    public function fairePayement(){
        $user = auth()->user();
        $etudiant = Etudiant::where('users_id', $user->id)->first();
        $etudiant_id = $etudiant->id;
        if (!$etudiant) {
            return response()->json(['message' => "L'étudiant n'existe pas"], 404);
        }else{
            return response()->json([
                'statut' => 'ok',
                'payment_url' => "http://127.0.0.1:8000/api/payment?verify={$etudiant_id}"
                ]);
        }
    }

    public function historiquePayement(){
        $user = auth()->user();
        $etudiant = Etudiant::where('users_id', $user->id)->first();
       // dd($etudiant);
        if (!$etudiant) {
            return response()->json(['message' => 'Aucune chambre associée à cet étudiant'], 404);
        }else{
            $payement = Payment::where("etudiants_id", $etudiant->id)->get();
            if(!$payement){
                return response()->json(['message' => 'Aucun payement  à éffectuer '], 404);
            }else{
                return response()->json(['Historiques'=> $payement], 201);
            }
        }
    }

    public function listesPayments()
    {
        $payements = Payment::all();

        return response()->json([
            'Payments: ' =>  $payements
        ],201);
    }
}
