<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Etudiant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
/**
 * @OA\Tag(
 *     name="Authentification de l'utilisateur",
 *     description="Endpoints pour l'authentification."
 * )
 */
class AuthController extends Controller
{
     /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }
    /**
     * @OA\Post(
     *     path="/api/auth/login",
     *     summary="Authentification de l'utilisateur",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"email", "password"},
     *             @OA\Property(property="email", type="string", format="email", example="btidiane004@example.com"),
     *             @OA\Property(property="password", type="string", example="secret"),
     *         ),
     *     ),
     *     @OA\Response(response="200", description="Authentification réussie"),
     *     @OA\Response(response="401", description="Échec de l'authentification"),
     * )
     */

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    // public function login()
    // {
    //     $email=request(['email']);
    //     $user = User::where('email',$email['email'])->first();
    //     $credentials = request(['email', 'password']);
    //     if (! $token = auth()->attempt($credentials)) {
    //         return response()->json(['error' => 'Merci de vous connecter en renseignant votre email et mot de passe'], 401);
    //     }
    //     return $this->respondWithToken([
    //     'access_token' => $token,
    //     'Utilisateur' => $user
    //  ]);
    // }
    public function login()
    {
        $validator = Validator::make(request()->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $credentials = request(['email', 'password']);

        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Merci de saisir un mail ou mot de passe valide'], 401);
        }

        return $this->respondWithToken($token);
    }


    /**
     * @OA\Get(
     *     path="/api/me",
     *     summary="Récupérer les informations de l'utilisateur authentifié",
     *     security={{ "bearerAuth": {} }},
     *     @OA\Response(response="200", description="Informations de l'utilisateur"),
     * )
     */

    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * @OA\Post(
     *     path="/api/logout",
     *     summary="Déconnexion de l'utilisateur (Invalidation du token)",
     *     security={{ "bearerAuth": {} }},
     *     @OA\Response(response="200", description="Déconnexion réussie"),
     * )
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

   /**
     * @OA\Post(
     *     path="/api/refresh",
     *     summary="Actualiser le token",
     *     security={{ "bearerAuth": {} }},
     *     @OA\Response(response="200", description="Token actualisé avec succès"),
     * )
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */

    protected function respondWithToken($token)
    {
        $user = User::with('etudiants')->where('id', auth()->user()->id)->get();

        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 120,
            'user' =>  $user,
            'message' => "Vous êtes connecté avez succés...",
            // 'user' => UserRessouce::collection($user)
        ]);
    }

}
