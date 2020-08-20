<?php


namespace Cyaxaress\User\Http\Controllers;


use Cyaxaress\RolePermissions\Repositories\RoleRepo;
use Cyaxaress\User\Repositories\UserRepo;

class UserController
{
    /**
     * @var UserRepo
     */
    private $userRepo;

    public function __construct(UserRepo $userRepo)
    {

        $this->userRepo = $userRepo;
    }
    public function index(RoleRepo $roleRepo)
    {
        $users = $this->userRepo->paginate();
        $roles = $roleRepo->all();
        return view("User::Admin.index", compact('users', 'roles'));
    }
}
