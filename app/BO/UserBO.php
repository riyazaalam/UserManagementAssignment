<?php

namespace App\BO;

use App\DAO\UserDAO;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UserBO
{
    public function __construct(private UserDAO $userDAO) {}

    public function createUser(array $data): User
    {
        $data['password'] = Hash::make($data['password']);
        return $this->userDAO->create($data);
    }

    public function updateUser(int $id, array $data): User
    {
       
        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']); // avoid overwriting with null
        }

        return $this->userDAO->update($id, $data);
    }

    public function getUser(int $id): User
    {
        return $this->userDAO->find($id);
    }

    public function getAllUsers(): Collection
    {
        return $this->userDAO->getAll();
    }

}