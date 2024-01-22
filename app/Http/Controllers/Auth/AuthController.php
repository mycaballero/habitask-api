<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Services\Auth\AuthService;

class AuthController extends Controller
{
    /**
     * @param AuthService $authService
     */
    public function __construct(protected AuthService $authService)
    {
    }

    /**
     * @return mixed
     */
    public function getUser(): mixed
    {
        return $this->authService->getUser();
    }

    /**
     * @return void
     */
    public function logout(): void
    {
        $this->authService->removeAuthenticationToken(request()->user());
    }
}
