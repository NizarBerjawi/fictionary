@extends('layouts.admin')

@section('content')
    <div class="container">
        @include('partials.messages')

        @include('admin.users.partials.filter_form')
        <div class="card border-0">
            <div class="card-block">
                <table class="table table-striped table-hover mb-0">
                    <thead>
                        <tr>
                            <th scope="col">Username</th>
                            <th scope="col">Full Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Last Login</th>
                            <th scope="col">Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                            <tr class="table-row">
                                <th scope="row">
                                    @if (!is_null($user->profile))
                                        <a href="{{ route('profile.show', $user->profile) }}">{{ $user->profile->username }}</a>
                                    @endif
                                </th>
                                <td>{{ $user->profile->full_name ?? $user->full_name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->last_login }}</td>
                                <td>
                                    <span class="badge badge-pill {{ $user->trashed() ? 'badge-danger' : ($user->activation->isVerified() ? 'badge-success' : 'badge-warning') }}">
                                        {{ $user->trashed() ? 'Deleted' : ($user->activation->isVerified() ? 'Active' : 'Inactive') }}
                                    </span>
                                </td>
                                <td>
                                    @if (!$user->trashed())
                                        <form class="delete-user" action={{ route('users.destroy', $user) }} method="POST">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <button type="submit" class="btn btn-primary"><i class="fas fa-trash-alt"></i></button>
                                        </form>
                                    @endif

                                    @if ($user->trashed())
                                        <form action={{ route('users.restore', $user) }} method="POST">
                                            {{ csrf_field() }}
                                            {{ method_field('PATCH') }}
                                            <button type="submit" class="btn btn-primary"><i class="fas fa-window-restore"></i></button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7">No users available<td/>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row">
            <div class="col mt-2">
                {{ $users->appends($input)->links() }}
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @parent
@endsection
