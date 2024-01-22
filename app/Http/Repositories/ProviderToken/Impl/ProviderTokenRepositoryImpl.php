<?php

namespace App\Http\Repositories\ProviderToken\Impl;

use App\Http\DataTransferObjects\ProviderToken\GetData;
use App\Http\DataTransferObjects\ProviderToken\SaveData;
use App\Http\Repositories\ProviderToken\ProviderTokenRepository;
use App\Models\ProviderToken;

class ProviderTokenRepositoryImpl implements ProviderTokenRepository
{
    /**
     * @param GetData $data
     * @return ProviderToken|null
     */
    public function get(GetData $data): ?ProviderToken
    {
        return ProviderToken::whereModel(
            ['id' => $data->model_id, 'type' => $data->model_type]
        )->whereName($data->name)->first();
    }

    /**
     * @param ProviderToken $providerToken
     * @param SaveData $data
     * @return ProviderToken
     */
    public function save(ProviderToken $providerToken, SaveData $data): ProviderToken
    {
        $providerToken->fill($data->toArray())->save();
        return $providerToken;
    }
}
