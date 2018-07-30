@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <a href="{{ route('admin.users') }}" class="text-info">
                    <div class="card">
                        <div class="card-body text-center">
                            <i class="fa fa-3x fa-users"></i>
                            <h5 class="card-title">Users</h5>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-6">
                <a href="#" class="text-info">
                    <div class="card">
                        <div class="card-body text-center">
                            <i class="fa fa-3x fa-book-open"></i>
                            <h5 class="card-title">Books</h5>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @parent
@endsection
