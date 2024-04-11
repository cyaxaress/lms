<?php

namespace Cyaxaress\User\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Cyaxaress\User\Http\Requests\ChangePasswordRequest;
use Cyaxaress\User\Services\UserService;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    public function showResetForm()
    {
        return view('User::Front.passwords.reset');
    }

    public function reset(ChangePasswordRequest $request)
    {
        UserService::changePassword(auth()->user(), $request->password);

        return redirect(route('home'));
    }
}
