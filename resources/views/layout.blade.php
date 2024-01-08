<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', config('app.name'))</title>
    @vite(['./node_modules/bootstrap/dist/css/bootstrap.min.css'])
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand text-white" href="{{ route('home.index') }}">Homepage</a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#">Friends</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#">Chats</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#">Groups</a>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto d-flex">
                    @guest
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('auth.registerForm') }}">Register</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('auth.loginForm') }}">Login</a>
                        </li>
                    @endguest
                    @auth
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('profile.edit') }}">{{ Auth::user()->name }}</a>
                        </li>
                        <li class="nav-item">
                            <form action="{{ route('auth.logout') }}" method="POST">
                                @csrf
                                <button class="nav-link text-white" type="submit">Logout</button>
                            </form>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        @yield('content')
    </div>

</body>

</html>
