<?php


namespace Cyaxaress\User\Http\Controllers;


use App\Http\Controllers\Controller;
use Cyaxaress\Common\Responses\AjaxResponses;
use Cyaxaress\RolePermissions\Repositories\RoleRepo;
use Cyaxaress\User\Http\Requests\AddRoleRequest;
use Cyaxaress\User\Models\User;
use Cyaxaress\User\Repositories\UserRepo;

class UserController extends Controller
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
        $this->authorize('addRole', User::class);
        $users = $this->userRepo->paginate();
        $roles = $roleRepo->all();
        return view("User::Admin.index", compact('users', 'roles'));
    }

    public function addRole(AddRoleRequest $request, User $user)
    {
        $this->authorize('addRole', User::class);
        $user->assignRole($request->role);
        newFeedback('موفقیت آمیز', " نقش کاربری {$request->role}  به کاربر {$user->name} داده شد.", 'success');
        return back();
    }

    public function removeRole($userId, $role)
    {
        $this->authorize('removeRole', User::class);
        $user = $this->userRepo->findById($userId);
        $user->removeRole($role);
        return AjaxResponses::SuccessResponse();
    }
}
