<?php

namespace App\Helpers;

class OAuthHelper {
    /**
     * @return mixed
     */
    public static function getGoogleCredentials(): array
    {
        $route = "keys/google/credentials." . config('app.env') . ".json";
        $path = storage_path($route);
        $content = file_get_contents($path);
        $credentials = json_decode($content,true);
        return $credentials['web'];
    }
}
