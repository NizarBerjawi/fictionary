@extends('layouts.base')

@section('styles')
    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
@endsection

@section('layout')
    <div id="app">
        @include('partials.navbar')

        <div class="row">
            <div class="col-md-8 offset-md-2">
                @include('admin.partials.nav')
            </div>
        </div>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
@endsection

@section('scripts')
    <script src="{{ webpack('vendor', 'js') }}" defer></script>
    <script src="{{ webpack('common', 'js') }}" defer></script>
    <script src="{{ webpack('main', 'js') }}" defer></script>
@endsection
