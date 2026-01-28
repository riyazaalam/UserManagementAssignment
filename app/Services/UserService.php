<?php

namespace App\Services;

use App\BO\UserBO;
use Illuminate\Support\Facades\Cache;

class UserService
{
    public function __construct(private UserBO $userBO) {}

    public function createUser(array $data)
    {
        $user = $this->userBO->createUser($data);
        Cache::forget("user_{$user->id}");
        return $user;
    }

    public function updateUser(int $id, array $data)
    {
        $user = $this->userBO->updateUser($id, $data);
        Cache::forget("user_{$id}");
        return $user;
    }
    public function getUser(int $id)
    {
        return Cache::remember("user_{$id}", 60, fn() => $this->userBO->getUser($id));
    }

    public function getAllUsers() {
    //    return $this->userBO->getAllUsers();
       
        return Cache::remember('users_all', 3600, function() {
            return $this->userBO->getAllUsers();
        });
    }

}
