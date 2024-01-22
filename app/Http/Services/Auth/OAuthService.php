<?php

namespace App\Http\Services\Auth;

use App\Models\User;

interface OAuthService
{
    /**
     * @param string $provider
     * @return mixed
     */
    public function getRedirectUrl(string $provider): mixed;

    /**
     * @param string $provider
     * @return User
     */
    public function callback(string $provider): User;
}
