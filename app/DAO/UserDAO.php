<?php

namespace App\DAO;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UserDAO
{
    public function create(array $data): User
    {
        return User::create($data);
    }

    public function update(int $id, array $data): User
    {
        $user = User::findOrFail($id);
        $user->update($data);
        //return $user;
        return $user->fresh(); // return updated model
    }

    public function find(int $id): User
    {
        return User::findOrFail($id);
    }
    public function getAll(): Collection
    {
        return User::get();
    }
}
