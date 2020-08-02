<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Bobby's Shop</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app">
        <div id="admin-panel">
            <aside id="menu">
                <nav>
                    <ul>
                        @guest
                            <li>
                                <a href="{{ route('login') }}"><i class="fas fa-fw fa-sign-in-alt"></i> <span>{{ __('Login') }}</span></a>
                            </li>
                            @if (Route::has('register'))
                                <li>
                                    <a href="{{ route('register') }}"><i class="fas fa-user-plus"></i> <span>{{ __('Register') }}</span></a>
                                </li>
                            @endif
                        @else

                        <li>
                            <a href="{{ route('dashboard') }}"><i class="fas fa-fw fa-home"></i> <span>Dashboard</span></a>
                        </li>

                        @if (Auth::user()->is_admin)
                            <li>
                                <a href="{{ route('admin.users.index') }}"><i class="fas fa-fw fa-users"></i> <span>Users</span></a>
                            </li>
                            <li>
                                <a href="{{ route('admin.transactions.index') }}"><i class="fas fa-fw fa-pound-sign"></i> <span>Transactions</span></a>
                            </li>
                        @else
                            <li>
                                <a href="{{ route('profile') }}"><i class="fas fa-fw fa-user"></i> <span>Profile</span></a>
                            </li>
                            <li>
                                <a href="{{ route('profile') }}"><i class="fas fa-fw fa-user"></i> <span>My Transactions</span></a>
                            </li>
                        @endif

                        @endguest
                    </ul>
                </nav>
                @guest
                @else
                    <div onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="current-profile">
                        <span>{{ Auth::user()->name }}</span>
                        <i class="fas fa-sign-out-alt" href="{{ route('logout') }}" ></i>
                    </div>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                @endguest
            </aside>
            <main id="content">
                @yield('breadcrumb')
                @yield('content')
            </main>
        </div>
        @yield('scripts')
    </div>
</body>
</html>
