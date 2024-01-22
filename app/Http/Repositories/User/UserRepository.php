<?php

namespace App\Http\Repositories\User;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

interface UserRepository
{
    /**
     * @param int $id
     * @param $data
     * @return User
     */
    public function update(int $id, $data): User;
}
