@extends('layouts.base')

@section('styles')
    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">

    {{--  Styles --}}
    <link href="{{ webpack('vendor', 'css') }}" rel="stylesheet">
    <link href="{{ webpack('main', 'css') }}" rel="stylesheet">
    <link href="{{ webpack('admin', 'css') }}" rel="stylesheet">
@endsection

@section('layout')
    <div id="app">

        @include('admin.partials.navbar')

        <main class="py-4">
            @yield('content')
        </main>
    </div>
@endsection

@section('scripts')
    <script src="{{ webpack('vendor', 'js') }}" defer></script>
    <script src="{{ webpack('common', 'js') }}" defer></script>
    <script src="{{ webpack('main', 'js') }}" defer></script>
    <script src="{{ webpack('admin', 'js') }}" defer></script>
@endsection
