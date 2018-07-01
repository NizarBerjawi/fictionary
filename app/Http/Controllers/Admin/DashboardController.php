<?php

namespace App\Http\Controllers\Admin;

use App\Fictionary\Auth\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     *
     */
    public function index(Request $request)
    {
        return 'here';
    }
}
