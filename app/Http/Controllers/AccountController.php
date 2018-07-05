<?php

namespace App\Http\Controllers;

use App\Fictionary\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RedirectsUsers;

class AccountController extends Controller
{
    use RedirectsUsers;

    /**
     * Where to redirect users after activation.
     *
     * @var string
     */
    public $redirectTo = '/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function activate(Request $request, string $token)
    {
        $validator = Validator::make($request->only('email'), [
            'email' => 'required|email|exists:users,email'
        ]);

        if ($validator->fails()){
            return redirect($this->redirectPath())
                    ->withWarning('Account could not be verified.');
        }

        $user = User::query()
                    ->byEmail($request->input('email'))
                    ->firstOrFail();

        if ($user->isActivated()) {
            return redirect($this->redirectPath())
                        ->withWarning('Account is already activated.');
        }

        $user->activate();

        return redirect($this->redirectPath())
                    ->withSuccess('Account activated successfully');
    }
}
