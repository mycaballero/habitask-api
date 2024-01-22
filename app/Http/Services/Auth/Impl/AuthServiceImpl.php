<?php

namespace App\Http\Services\Auth\Impl;

use App\Models\User;
use App\Http\Services\Auth\AuthService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class AuthServiceImpl implements AuthService
{
    /**
     * @return User|Model
     */
    public function getUser(): User|Model
    {
        return User::with('roles.permissions')->find(Auth::user()->id);
    }

    /**
     * @param User $user
     * @return string
     */
    public function generateAuthenticationToken(User $user): string
    {
        $user->tokens()->whereName('api-token')->delete();
        return $user->createToken('api-token')->plainTextToken;
    }

    /**
     * @param User $user
     * @return void
     */
    public function removeAuthenticationToken(User $user): void
    {
        $user->currentAccessToken()->delete();
    }
}
