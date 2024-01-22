<?php

namespace App\Http\Services\ProviderToken\Impl;

use App\Http\DataTransferObjects\ProviderToken\GetData;
use App\Http\DataTransferObjects\ProviderToken\SaveData;
use App\Http\Repositories\ProviderToken\ProviderTokenRepository;
use App\Http\Services\ProviderToken\ProviderTokenService;
use App\Models\ProviderToken;

class ProviderTokenServiceImpl implements ProviderTokenService
{

    public function __construct(
        protected ProviderTokenRepository $providerTokenRepository,
    )
    {
    }
    /**
     * @inheritDoc
     */
    public function saveWithModel(array $data): ProviderToken
    {
        $providerToken = $this->providerTokenRepository->get(GetData::from($data));
        if(!isset($providerToken)){
            $providerToken = new ProviderToken();
        }
        return $this->providerTokenRepository->save($providerToken,SaveData::from($data));
    }
}
