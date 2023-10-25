<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'GameXChange')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <style>
        body{
            /* background-image: url('{{ asset('Asset/icons/gamesxchange-bg.jpg') }}') */
        }
        .star-btn {
            background: none; /* Remove the background color */
            border: none; /* Remove the border */
            padding: 0; /* Remove padding */
        }

        .star-btn .bi-star, .star-btn .bi-star-fill {
            color: white;
            font-size: 24px; /* Change the star color to gold or any other color you prefer */
        }
        th, tr, td {
            background-color: #212529 !important;
            color: white !important;
        }
        .bg-grayish {
            background-color: #383838 !important;
            border-color: #383838 !important;
            color: white !important;
        }
        .bg-grayeesh {
            background-color: #424242 !important;
            border-color: #383838 !important;
        }
        .hover-effect {
            transition: all 0.3s ease;
        }
        .hover-effect:hover {
            transform: scale(1.1);
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }
        .bg-blackish {
            background-color: #212121 !important;
        }
        .bg-darker {
            background-color: #1c1c1c !important;
        }
        .styled {
            font-size: 18px;
            color: #e1e1e1;
            font-family: inherit;
            font-weight: 600;
            cursor: pointer;
            position: relative;
            border: none;
            background: none;
            text-transform: none;
            transition-timing-function: cubic-bezier(0.25, 0.8, 0.25, 1);
            transition-duration: 400ms;
            transition-property: color;
        }
        .styled:focus, .styled:hover {
            color: #fff;
        }
        .styled:focus:after, .styled:hover:after {
            width: 100%;
            left: 0%;
        }
        .styled:after {
            content: "";
            pointer-events: none;
            bottom: -2px;
            left: 50%;
            position: absolute;
            width: 0%;
            height: 2px;
            background-color: #fff;
            transition-timing-function: cubic-bezier(0.25, 0.8, 0.25, 1);
            transition-duration: 400ms;
            transition-property: width, left;
        }
        body {
            font-family: 'Jost', sans-serif;
        }
        a {
            text-decoration: none;
            color: white;
        }
        .gray-placeholder::placeholder {
            color: #8a8a8a;
        }
    </style>
</head>
<body class="bg-dark text-bg-secondary">
    <div>
        <nav class="navbar navbar-expand-md navbar-dark bg-darker px-3 shadow fixed-top" style="height: 80px">
            <a class="navbar-brand fw-bold fs-3 me-3" href="{{ route('home') }}">GameXChange</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link styled mx-3" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link styled mx-3" href="{{ route('games') }}">Games</a>
                    </li>
                    @auth
                        @if (auth()->user()->role === "admin")
                            <li class="nav-item">
                                <a class="nav-link styled mx-3" href="{{ route('game.create') }}">Add Game</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link styled mx-3" href="{{ route('developer.create') }}">Add Developer</a>
                            </li>
                        @endif
                    @endauth
                </ul>
                <ul class="navbar-nav ms-auto">
                    @auth
                        @if (auth()->user()->role === "customer")
                            <li class="nav-item">
                                <a class="nav-link styled mx-3" href="{{ route('history') }}"><i class="bi bi-clock-history"></i></a>
                            </li>
                            @if (auth()->user()->carts->count() > 0)
                                <li class="nav-item">
                                    <a class="nav-link styled mx-3" href="{{ route('cart') }}"><i class="bi bi-cart"></i></a>
                                </li>
                            @else
                                <li class="nav-item">
                                    <a class="nav-link disabled styled mx-3" href="{{ route('profile') }}"><i class="bi bi-cart"></i></a>
                                </li>
                            @endif
                        @endif
                    @endauth
                    @guest
                        <li class="nav-item">
                            <a class="nav-link styled mx-3" href="{{ route('register') }}">Register</a>
                        </li>
                    @endguest
                    <li class="nav-item">
                        @guest
                            <a class="nav-link styled mx-3" href="{{ route('login') }}">Login</a>
                        @endguest
                        @auth
                            <a class="nav-link styled mx-3" href="{{ route('profile') }}">{{ auth()->user()->name }}</a>
                        @endauth
                    </li>
                </ul>
            </div>
        </nav>
        @yield('content')
        <footer class="bg-darker shadow text-light d-flex flex-column justify-content-center align-items-center" style="min-height: 40vh">
            <div class="d-flex align-items-center">
                <a href="#"><i class="bi bi-twitter"></i></a>
                <a href="#"><i class="bi bi-facebook"></i></a>
                <a href="#"><i class="bi bi-whatsapp"></i></a>
                <a href="#"><i class="bi bi-instagram"></i></a>
            </div>
            <div class="container text-center">
                <p>&copy; 2023 GameXChange. All rights reserved.</p>
            </div>
        </footer>
    </div>
</body>
</html>
