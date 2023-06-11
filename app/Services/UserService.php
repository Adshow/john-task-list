<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function createUser(array $data)
    {
        $data['password'] = $this->hashPassword($data['password']);
        return User::create($data);
    }

    public function getUserById($id)
    {
        return User::find($id);
    }

    public function updateUser(User $user, array $data)
    {
        $user->update($data);
        return $user;
    }

    public function deleteUser(User $user)
    {
        $user->delete();
    }

    private function hashPassword($password)
    {
        return Hash::make($password);
    }
}