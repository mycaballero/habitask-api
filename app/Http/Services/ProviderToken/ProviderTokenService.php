<?php

namespace App\Http\Services\ProviderToken;

use App\Models\ProviderToken;

interface ProviderTokenService
{
    /**
     * @param array $data
     * @return ProviderToken
     */
    public function saveWithModel(array $data): ProviderToken;
}
