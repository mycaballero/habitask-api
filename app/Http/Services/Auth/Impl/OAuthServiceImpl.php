<?php

namespace App\Http\Services\Auth\Impl;

use App\Http\DataTransferObjects\User\OAuth\SaveData as UserSaveData;
use App\Http\Services\Auth\OAuthService;
use App\Http\Services\ProviderToken\ProviderTokenService;
use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Laravel\Socialite\Facades\Socialite;

class OAuthServiceImpl implements OAuthService
{
    /**
     * @param ProviderTokenService $providerTokenService
     */
    public function __construct(
        protected ProviderTokenService $providerTokenService
    )
    {
    }

    /**
     * @param string $provider
     * @return mixed
     */
    public function getRedirectUrl(string $provider): mixed
    {
        return Socialite::driver($provider)->stateless()->redirect()->getTargetUrl();
    }


    /**
     * @param string $provider
     * @return User id
     * @throws AuthenticationException
     */
    public function callback(string $provider): User
    {
        $userProvider = Socialite::driver($provider)->stateless()->user();
        $userSaveData = UserSaveData::from([
            'name' => $userProvider->name,
            'email' => $userProvider->email,
            'photo' => $userProvider->getAvatar()
        ]);
        $user = User::whereEmail($userSaveData->email)->first();
        if (!isset($user)) {
            throw new AuthenticationException();
        }
        $user->photo = $userSaveData->photo;
        $user->save();
        $this->providerTokenService->saveWithModel([
            'name' => $provider,
            'model_id' => $user->id,
            'model_type' => 'App\\Models\\User',
            'token' => $userProvider->token
        ]);
        return $user;
    }
}
