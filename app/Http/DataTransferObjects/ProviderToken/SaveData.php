<?php

namespace App\Http\DataTransferObjects\ProviderToken;

use Spatie\LaravelData\Data;

class SaveData extends Data
{
    /**
     * @param int $model_id
     * @param string $model_type
     * @param string $name
     * @param string $token
     */
    public function __construct(
        public string $name,
        public int    $model_id,
        public string $model_type,
        public string $token
    )
    {
    }

    public static function rules(): array
    {
        return [
            'name' => 'required|max:255',
            'model_id' => 'required|int',
            'model_type' => 'required|max:255',
            'token' => 'required|max:255'
        ];
    }
}
