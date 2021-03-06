<?php


namespace Cyaxaress\User\Http\Controllers;


use App\Http\Controllers\Controller;
use Cyaxaress\Common\Responses\AjaxResponses;
use Cyaxaress\Media\Services\MediaFileService;
use Cyaxaress\RolePermissions\Repositories\RoleRepo;
use Cyaxaress\User\Http\Requests\UpdateProfileInformationRequest;
use Cyaxaress\User\Http\Requests\UpdateUserPhoto;
use Cyaxaress\User\Http\Requests\UpdateUserRequest;
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
        $this->authorize('index', User::class);
        $users = $this->userRepo->paginate();
        $roles = $roleRepo->all();
        return view("User::Admin.index", compact('users', 'roles'));
    }

    public function info($user, UserRepo $repo)
    {
        $this->authorize('index', User::class);
        $user = $repo->FindByIdFullInfo($user);
        return view("User::Admin.info", compact("user"));
    }

    public function edit($userId, RoleRepo $roleRepo)
    {
        $this->authorize('edit', User::class);
        $user = $this->userRepo->findById($userId);
        $roles = $roleRepo->all();
        return view("User::Admin.edit", compact('user', 'roles'));
    }

    public function update(UpdateUserRequest $request, $userId)
    {
        $this->authorize('edit', User::class);
        $user = $this->userRepo->findById($userId);

        if ($request->hasFile('image')) {
            $request->request->add(['image_id' => MediaFileService::publicUpload($request->file('image'))->id ]);
            if ($user->banner)
                $user->banner->delete();
        }else{
            $request->request->add(['image_id' => $user->image_id]);
        }

        $this->userRepo->update($userId, $request);
        newFeedback();
        return redirect()->back();
    }

    public function updatePhoto(UpdateUserPhoto $request)
    {
        $this->authorize('editProfile', User::class);
        $media = MediaFileService::publicUpload($request->file('userPhoto'));
        if (auth()->user()->image) auth()->user()->image->delete();
        auth()->user()->image_id = $media->id;
        auth()->user()->save();
        newFeedback();

        return back();
    }

    public function profile()
    {
        $this->authorize('editProfile', User::class);
        return view('User::admin.profile');
    }

    public function updateProfile(UpdateProfileInformationRequest $request)
    {
        $this->authorize('editProfile', User::class);
        $this->userRepo->updateProfile($request);
        newFeedback();
        return back();

    }

    public function destroy($userId)
    {
        $user = $this->userRepo->findById($userId);
        $user->delete();

        return AjaxResponses::SuccessResponse();
    }

    public function manualVerify($userId)
    {
        $this->authorize('manualVerify', User::class);
        $user = $this->userRepo->findById($userId);
        $user->markEmailAsVerified();
        return AjaxResponses::SuccessResponse();
    }

    public function addRole(UpdateUserPhoto $request, User $user)
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
