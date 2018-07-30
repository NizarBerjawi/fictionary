<?php

namespace App\Http\Controllers\Admin;

use App\Fictionary\Auth\User;
use App\Fictionary\Auth\Filters\UserFilter;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * User filter
     *
     * @var UserFilter @filters
     */
    private $filters;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserFilter $filters)
    {
        $this->filters = $filters;
    }

    /**
     * Show a collection of users
     */
    public function index(Request $request)
    {
        $users = User::query()
                     ->exclude($request->user())
                     ->filter($this->filters)
                     ->paginate(10);

        return view('admin.users.index')->with(compact('users'));
    }
}
