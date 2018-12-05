<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="teamwork-url" content="{{ config('teamwork.endpoint') }}">

    <title>@yield('title')</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-gray-lightest font-sans font-normal antialiased">
    <div class="flex mt-6" id="app">
        @if(Route::has('login'))
            <div class="absolute pin-t pin-r mt-4 mr-4">
                @auth
                    <ul class="list-reset flex">
                        <li class="mr-6">
                            <a 
                                href="{{ url('/') }}" 
                                class="no-underline hover:underline text-sm font-normal text-teal-darker uppercase"
                            >
                                    {{ __('Home') }}
                            </a>
                        </li>
                        <li class="mr-6">
                            <a 
                                href="{{ url('/dashboard') }}" 
                                class="no-underline hover:underline text-sm font-normal text-teal-darker uppercase"
                            >
                                    {{ __('Dashboard') }}
                            </a>
                        </li>
                    </ul>
                @else
                    <ul class="list-reset flex">
                        <li class="mr-6">
                            <a 
                                href="{{ url('/') }}" 
                                class="no-underline hover:underline text-sm font-normal text-teal-darker uppercase pr-6"
                            >
                                    {{ __('Home') }}
                            </a>
                        </li>
                        <li class="mr-6">
                            <a 
                                href="{{ route('login') }}" 
                                class="no-underline hover:underline text-sm font-normal text-teal-darker uppercase pr-6"
                            >
                                    {{ __('Login') }}
                            </a>
                        </li>
                        <li class="mr-6">
                            <a 
                                href="{{ route('register') }}" 
                                class="no-underline hover:underline text-sm font-normal text-teal-darker uppercase"
                            >
                                    {{ __('Register') }}
                            </a>
                        </li>
                    </ul>
                @endauth
            </div>
        @endif

        <div class="mt-6 w-full">
            @yield('content')
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
