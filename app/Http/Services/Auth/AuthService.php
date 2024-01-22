<?php

namespace App\Http\Services\Auth;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

interface AuthService
{
    /**
     * @return User
     */
    public function getUser(): User|Model;

    /**
     * @param User $user
     * @return string
     */
    public function generateAuthenticationToken(User $user): string;

    /**
     * @param User $user
     * @return void
     */
    public function removeAuthenticationToken(User $user): void;
}
