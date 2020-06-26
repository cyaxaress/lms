<?php


namespace Cyaxaress\User\Repositories;


use Cyaxaress\User\Models\User;

class UserRepo
{
    public function findByEmail($email)
    {
        return User::query()->where('email', $email)->first();
    }
}
