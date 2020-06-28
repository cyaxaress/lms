<?php


namespace Cyaxaress\User\Services;


class UserService
{
    public static function changePassword($user, $newPassword)
    {
        $user->password = bcrypt($newPassword);
        $user->save();
    }
}
