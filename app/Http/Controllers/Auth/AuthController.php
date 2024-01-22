<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\DataTransferObjects\User\SaveData;
use App\Http\Services\Auth\AuthService;
use App\Http\Services\User\UserService;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    /**
     * @param UserService $userService
     * @param AuthService $authService
     */
    public function __construct(
        protected UserService $userService,
        protected AuthService $authService
    )
    {
    }

    public function store(Request $request): JsonResponse
    {
        return response()->json($this->userService->create(SaveData::from($request)));
    }

    /**
     * @return mixed
     */
    public function getUser(): mixed
    {
        return $this->authService->getUser();
    }

    /**
     * @throws AuthenticationException
     */
    public function login(Request $request): mixed
    {
        $user = User::whereEmail($request->email)->first();
        if (!isset($user)) {
        throw new AuthenticationException();
        }
        if (Hash::check($request->password, $user->password)){
            return response()->json(
                [
                    'user' => $user,
                    'token' => $this->authService->generateAuthenticationToken($user)
                ]);
        }
        throw new AuthenticationException();
    }

    /**
     * @return void
     */
    public function logout(): void
    {
        $this->authService->removeAuthenticationToken(request()->user());
    }
}
