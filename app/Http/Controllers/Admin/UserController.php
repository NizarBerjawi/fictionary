<?php

namespace App\Http\Controllers\Admin;

use App\Fictionary\Auth\User;
use App\Fictionary\Support\Forms\AggregatorInterface;
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
     * Data required to render form
     *
     * @var DataAggregator
     */
    private $data;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(AggregatorInterface $data, UserFilter $filters)
    {
        $this->data = $data;
        $this->filters = $filters;
    }

    /**
     * Show a collection of users
     *
     * @param Request $request
     * @return Respose
     */
    public function index(Request $request)
    {
        $users = User::query()
                     ->withTrashed()
                     ->with(['activation', 'profile' => function($query) {
                         $query->withTrashed();
                     }])
                     ->exclude([$request->user()])
                     ->filter($this->filters)
                     ->paginate(10);

        return view('admin.users.index')
                ->withUsers($users)
                ->withData($this->data)
                ->withInput($request->all());
    }

    /**
     * Delete a specified user
     *
     * @param Request $request
     * @param User $user
     * @return Response
     */
    public function destroy(Request $request, User $user)
    {
        $this->authorize('delete', $user);

        $user->delete();

        return back()->withSuccess('User deleted successfully');
    }

    /**
     * Restore a specifie user
     *
     * @param Request $request
     * @param User $user
     *
     */
    public function restore(Request $request, $uuid)
    {
        $user = User::where('uuid', $uuid)->onlyTrashed()->firstOrFail();

        $this->authorize('restore', $user);

        $user->restore();

        return back()->withSuccess('User restored successfully.');
    }
}
