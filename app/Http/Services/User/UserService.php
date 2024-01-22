<?php

namespace App\Http\Services\User;

use App\Http\DataTransferObjects\User\SaveData;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Query\Builder;

interface UserService
{
    public function create(SaveData $data): User;
    public function update(int $id, SaveData $data): User;

    public function getUsers(): Collection|Builder;
}
