<?php

namespace App\Http\Services\User\Impl;

use App\Http\DataTransferObjects\User\SaveData;
use App\Http\Repositories\User\UserRepository;
use App\Http\Services\User\UserService;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Query\Builder;

class UserServiceImpl implements UserService
{

    /**
     * @param UserRepository $userRepository
     */
    public function __construct(protected UserRepository $userRepository)
    {
    }

    public function create(SaveData $data): User
    {
        $payload = [
            'name' => $data->name,
            'email' => $data->email,
            'password' => $data->password,
        ];
        return $this->userRepository->create($payload);
    }

    /**
     * @param int $id
     * @param SaveData $data
     * @return User
     */
    public function update(int $id, SaveData $data): User
    {
        $payload = [
            'name' => $data->name,
            'email' => $data->email,
            'password' => $data->password,
        ];
        return $this->userRepository->update($id, $payload);
    }

    /**
     * @return Collection|Builder
     */
    public function getUsers(): Collection|Builder
    {
        return User::select('id', 'name')->get();
    }
}
