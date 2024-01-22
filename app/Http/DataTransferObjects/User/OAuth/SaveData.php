<?php

namespace App\Http\DataTransferObjects\User\OAuth;

use Spatie\LaravelData\Data;

class SaveData extends Data
{
    /**
     * @param string $email
     * @param string $name
     * @param string|null $photo
     */
    public function __construct(
        public string $email,
        public string $name,
        public ?string $photo
    )
    {
    }

    /**
     * @return string[]
     */
    public static function rules(): array
    {
        return [
            'email' => 'required|max:255',
            'name' => 'required|max:255',
            'photo' => 'max:255'
        ];
    }
}
