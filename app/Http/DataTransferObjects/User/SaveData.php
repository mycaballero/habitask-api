<?php

namespace App\Http\DataTransferObjects\User;

use Spatie\LaravelData\Data;

class SaveData extends Data
{
    /**
     * @param string $name
     * @param string $email
     * @param string $password
     */
    public function __construct(
        public string $name,
        public string $email,
        public string  $password,
    )
    {
    }

    /**
     * @return string[]
     */
    public static function rules(): array
    {
        return [
            'name' => 'required|max:30',
            'email' => 'required|email|unique:users,email',
            'password' => ['required',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/']
        ];
    }
}
