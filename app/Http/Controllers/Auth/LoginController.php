<?php

namespace App\Http\Controllers\Auth;

use App\Fictionary\Auth\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Where to redirect admins after login.
     *
     * @var string
     */
    protected $redirectAdminTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Set the the login redirect path for the user by role
     *
     * @return string
     */
    public function redirectTo()
    {
        $user = $this->getUser();

        if ($user->hasRole('admin')) {
            return $this->redirectAdminTo;
        }

        return $this->redirectTo;
    }

    /**
     * The user making the request
     *
     * @return User
     */
    protected function getUser()
    {
        return request()->user();
    }
}
