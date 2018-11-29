@extends('layouts.app')

@section('content')
    <div class="container">
        @include('partials.messages')

        <div class="row">
            <div class="card col-md-6 offset-md-3 col-sm-12">
                <div class="card-body">
                    <div class="col-sm-12">
                        @include('app.profile.partials.profile_form', [
                            'action' => route('profile.store'),
                            'method' => 'POST'
                        ])
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @parent
@endsection
