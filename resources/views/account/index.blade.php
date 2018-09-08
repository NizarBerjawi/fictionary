@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            @include('account.partials.nav')


            <div class="card col-12">
                <div class="card-body">
                    <div class="col-sm-12 mb-3">
                        @include('account.partials.photo_upload')
                    </div>

                    <div class="col-sm-12">
                        @include('account.partials.personal_details')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @parent
@endsection
