<?php

namespace App\Exceptions;

use Throwable;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Client\HttpClientException;
use Illuminate\Auth\Access\AuthorizationException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        // $this->reportable(function (Throwable $e) {
        //     //
        // });
         // On modifier le comportement pour l'exception NotFoundHttpException
         $this->renderable(function (AuthorizationException $e, $request) {
            // Si la requête contient "api/*"
            if ($request->is("api/*")) {
                // On retourne une réponse 404 avec un message en JSON
                return response()->json([
                    "statut" => 403,
                    "message" => "Acces non autorisé"
                ]);
            }
        });

         // On modifier le comportement pour l'exception NotFoundHttpException
        $this->renderable(function (NotFoundHttpException $e, $request) {
            // Si la requête contient "api/*"
            if ($request->is("api/*")) {
                // On retourne une réponse 404 avec un message en JSON
                return response()->json([
                    "message" => "Ressource introuvable"
                ], 404);
            }
        });

        $this->renderable(function (HttpClientException $e, $request) {
            // Si la requête contient "api/*"
            if ($request->is("api/*")) {
                // On retourne une réponse 404 avec un message en JSON
                return response()->json([
                    "statut" => 500,
                    "message" => "Erreur interne du serveur"
                ]);
            }
        });
        $this->reportable(function (\Illuminate\Auth\AuthenticationException $e) {
            Log::error("Une erreur d'authentification s'est produite: " . $e->getMessage());
        });

        $this->reportable(function (\Illuminate\Validation\ValidationException $e) {
            Log::error("Une exception de validation s'est produite: " . $e->getMessage());
        });

        $this->renderable(function (MethodNotAllowedHttpException $e, $request) {
            return response()->json([
                'error' => 'Vous avez utiliser une mauvaise methode',
                'details' => 'La method utiliser n\est pas supporter',
                'url' => 'Cette route ' . ' ' . $request->url() . ' ' . 'Supporte pas la methode utiliser',
            ], 405);
        });
    }
    // public function render($request, Throwable $exception)
    // {
    //     if ($exception instanceof HttpException) {
    //         return response()->json([
    //             'error' => 'Erreur HTTP',
    //             'message' => $exception->getMessage(),
    //         ], $exception->getStatusCode());
    //     }

    //     return parent::render($request, $exception);
    // }
}
