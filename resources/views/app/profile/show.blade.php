@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-md-6 offset-md-3 col-sm-12">
                @include('partials.messages')
                <div class="card">
                    <div class="card-body">
                        <div class="col-sm-12">
                            @include('app.profile.partials.profile')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @parent
@endsection
