@extends('layouts.admin')

@section('content')
    <div class="container">
        <form action="{{ route('admin.users') }}" method="GET" class="mb-3">
            <div class="form-row mb-2">
                <div class="col">
                    <input type="text" class="form-control" placeholder="Username" name="username">
                </div>
                <div class="col">
                    <input type="text" class="form-control" placeholder="Name" name="name">
                </div>
                <div class="col">
                    <input type="email" class="form-control" placeholder="Email" name="email">
                </div>
            </div>

            <div class="form-row mb-2">
                <div class="col">
                    <select class="form-control" name="status">
                        <option>(Status)</option>
                        <option value="active">Active</option>
                        <option value="pending">Pending</option>
                        <option value="deleted">Deleted</option>
                    </select>
                </div>
            </div>

            <div class="form-row text-right">
                <div class="col">
                    <button type="submit" class="btn btn-primary btn-sm">Filter</button>
                </div>
            </div>
        </form>

        <div class="card border-0">
            <div class="card-block">
                <table class="table table-striped mb-0">
                    <thead>
                        <tr>
                            <th scope="col">Username</th>
                            <th scope="col">First Name</th>
                            <th scope="col">Last Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Last Login</th>
                            <th scope="col">Status</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                            <tr>
                                <th scope="row">{{ $user->name }}</th>
                                <td>{{ $user->first_name }}</td>
                                <td>{{ $user->last_name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->last_login }}</td>
                                <td><span class="badge badge-pill {{ $user->activation->isVerified() ? 'badge-success' : 'badge-warning' }}">{{ $user->activation->isVerified() ? 'Active' : 'Inactive' }}</span></td>
                                <td>
                                    <span><i class="fas fa-edit"></i></span>
                                    <span><i class="fas fa-trash-alt"></i></span>
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
    </div>
@endsection

@section('scripts')
    @parent
@endsection
