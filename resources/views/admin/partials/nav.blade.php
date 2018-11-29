<nav class="navbar navbar-expand-md navbar-light navbar-laravel p-3 border">
    <!-- Left Side Of Navbar -->
    <ul class="navbar-nav d-flex justify-content-center mx-auto">
        @if (Auth::user()->isAdmin())
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('users') }}">Users <span class="sr-only">(current)</span></a>
            </li>
        @endif

        <li class="nav-item active">
            <a class="nav-link" href="{{ route('users') }}">Books <span class="sr-only">(current)</span></a>
        </li>
    </ul>
</nav>
