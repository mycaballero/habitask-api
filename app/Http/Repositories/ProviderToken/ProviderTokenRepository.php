<?php

namespace App\Http\Repositories\ProviderToken;

use App\Http\DataTransferObjects\ProviderToken\GetData;
use App\Http\DataTransferObjects\ProviderToken\SaveData;
use App\Models\ProviderToken;

interface ProviderTokenRepository
{
    /**
     * @param GetData $data
     * @return ProviderToken|null
     */
    public function get(GetData $data): ?ProviderToken;

    /**
     * @param ProviderToken $providerToken
     * @param SaveData $data
     * @return ProviderToken
     */
    public function save(ProviderToken $providerToken, SaveData $data): ProviderToken;
}
