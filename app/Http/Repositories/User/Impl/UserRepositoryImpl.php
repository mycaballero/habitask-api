<?php

namespace App\Http\Repositories\User\Impl;

use App\Http\Repositories\User\UserRepository;
use App\Models\User;

class UserRepositoryImpl implements UserRepository
{

    public function create($data): USer
    {
        return User::create($data);
    }

    /**
     * @param int $id
     * @param $data
     * @return User
     */
    public function update(int $id, $data): User
    {
        $user = User::findOrFail($id);
        $user->update($data);
        return $user;
    }
}
