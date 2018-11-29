@extends('layouts.admin')

@section('content')
    <div class="container">
        @include('partials.messages')

        <div class="row">
            <div class="col">
                <h1>Admin Homepage</h1>
            </div>
        </div>

    </div>
@endsection

@section('scripts')
    @parent
@endsection
