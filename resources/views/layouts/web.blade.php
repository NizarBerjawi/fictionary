@extends('layouts.base')

@section('styles')
    <style>
    html, body {
        background-color: #fff;
        color: #636b6f;
        font-family: 'Raleway', sans-serif;
        font-weight: 100;
        height: 100vh;
        margin: 0;
    }
    .full-height {
        height: 100vh;
    }
    .flex-center {
        align-items: center;
        display: flex;
        justify-content: center;
    }
    .position-ref {
        position: relative;
    }
    .top-right {
        position: absolute;
        right: 10px;
        top: 18px;
    }
    .content {
        text-align: center;
    }
    .title {
        font-size: 84px;
    }
    .links > a {
        color: #636b6f;
        padding: 0 25px;
        font-size: 12px;
        font-weight: 600;
        letter-spacing: .1rem;
        text-decoration: none;
        text-transform: uppercase;
    }
    .m-b-md {
        margin-bottom: 30px;
    }
</style>
@endsection

@section('layout')
    <div id="app">

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
