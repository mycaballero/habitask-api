<?php

namespace App\Http\DataTransferObjects\ProviderToken;

use Spatie\LaravelData\Data;

class GetData extends Data {
    /**
     * @param int $model_id
     * @param string $model_type
     * @param string|null $name
     */
    public function __construct(
        public ?string $name,
        public int $model_id,
        public string $model_type
    )
    {
    }
}
