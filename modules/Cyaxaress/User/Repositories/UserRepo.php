<?php


namespace Cyaxaress\User\Repositories;


use Cyaxaress\RolePermissions\Models\Permission;
use Cyaxaress\User\Models\User;

class UserRepo
{
    public function findByEmail($email)
    {
        return User::query()->where('email', $email)->first();
    }

    public function getTeachers()
    {
        return User::permission(Permission::PERMISSION_TEACH)->get();
    }

    public function findById($id)
    {
        return User::findOrFail($id);
    }

    public function paginate()
    {
        return User::paginate();
    }

    public function update($userId, $values)
    {
        $update = [
            'name' => $values->name,
            'email' => $values->email,
            'mobile' => $values->mobile,
            'username' => $values->username,
            'headline' => $values->headline,
            'website' => $values->website,
            'instagram' => $values->instagram,
            'linkedin' => $values->linkedin,
            'twitter' => $values->twitter,
            'facebook' => $values->facebook,
            'youtube' => $values->youtube,
            'status' => $values->status,
            'bio' => $values->bio,
            'image_id' => $values->image_id
        ];
        if (! is_null($values->password)) {
            $update['password'] = bcrypt($values->password);
        }
        return User::where('id', $userId)->update($update);
    }
}
