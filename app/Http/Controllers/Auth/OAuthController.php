<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Services\Auth\AuthService;
use App\Http\Services\Auth\OAuthService;
use Illuminate\Http\JsonResponse;

class OAuthController extends Controller
{
    public function __construct(
        protected OAuthService $oAuthService,
        protected AuthService  $authService
    )
    {
    }

    /**
     * @param string $provider
     * @return mixed
     */
    public function getRedirectUrl(string $provider): mixed
    {
        return $this->oAuthService->getRedirectUrl($provider);
    }

    /**
     * @param string $provider
     * @return JsonResponse
     */
    public function callback(string $provider): JsonResponse
    {
        $user = $this->oAuthService->callback($provider);
        return response()->json(
            [
                'user' => $user,
                'token' => $this->authService->generateAuthenticationToken($user)
            ]
        );
    }
}
