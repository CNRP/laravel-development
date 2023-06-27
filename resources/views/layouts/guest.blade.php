@php
    use App\View\Components\AddRemoveBasketButtons;
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&family=Rubik:wght@300&display=swap" rel="stylesheet">
        @livewireStyles

        <!-- Scripts -->
        @vite(['resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">

{{--    <nav class="bg-gray-800 fixed w-full z-10">--}}
{{--        <div class="container mx-auto px-4">--}}
{{--            <div class="flex justify-between items-center h-16">--}}
{{--                <!-- Title -->--}}
{{--                <div class="text-white font-bold text-lg">shoestore</div>--}}

{{--                <!-- Links -->--}}
{{--                <div class="hidden md:flex space-x-4">--}}
{{--                    <a href="/" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Home</a>--}}
{{--                    <a href="/products" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Products</a>--}}
{{--                    <a href="/basket" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">View Basket</a>--}}
{{--                    <a href="/booking" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Book</a>--}}
{{--                </div>--}}

                <!-- Login Button -->
{{--                <a href="#" class="hidden md:block bg-gray-600 hover:bg-gray-700 px-4 py-2 rounded-md text-sm font-medium text-white">Login</a>--}}
{{--                    <div class="flex">--}}
{{--                        @auth--}}
{{--                            <a href="{{ url('/dashboard') }}" class="hidden md:block bg-gray-600 hover:bg-gray-700 px-4 py-2 rounded-md text-sm font-medium text-white">--}}
{{--                                <i class="fas fa-user-circle mr-2"></i>Dashboard</a>--}}
{{--                        @else--}}
{{--                            <a href="{{ route('login') }}" class="">Log in</a>--}}
{{--                            <a href="{{ route('login') }}" class="hidden md:block bg-gray-600 hover:bg-gray-700 px-4 py-2 rounded-md text-sm font-medium text-white">--}}
{{--                                <i class="fas fa-sign-in-alt mr-2"></i>Login</a>--}}
{{--                            <a href="{{ route('register') }}" class="ml-4 hidden md:block bg-gray-600 hover:bg-gray-700 px-4 py-2 rounded-md text-sm font-medium text-white">--}}
{{--                                <i class="fas fa-user mr-2"></i>Register</a>--}}
{{--                        @endauth--}}


{{--                            <fb:login-button--}}
{{--                                scope="public_profile,email"--}}
{{--                                onlogin="checkLoginState();">--}}
{{--                            </fb:login-button>--}}
{{--                    </div>--}}
{{--                <!-- Mobile Menu Button -->--}}
{{--                <div class="md:hidden">--}}
{{--                    <button class="focus:outline-none">--}}
{{--                        <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">--}}
{{--                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>--}}
{{--                        </svg>--}}
{{--                    </button>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </nav>--}}

    <nav class="bg-gray-800 fixed w-full z-10 top-0">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center h-16">
                <!-- Title -->
                <div class="text-white font-bold text-lg">barber<span class="text-3xl">Shop</span></div>

                <!-- Links -->
                <div class="hidden md:flex space-x-4">
                    <a href="/" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-bold ">Home</a>
                    <a href="/booking" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-bold ">Booking</a>
                    <a href="/products" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-bold ">Products</a>
                    <a href="/basket" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-bold ">Basket</a>
                </div>

                <div>
                    <a class="text-white" href="https://www.facebook.com/yourpage"><i class="fab fa-facebook-square mr-2"></i></a>
                    <a class="text-white" href="https://www.instagram.com/yourpage"><i class="fab fa-instagram mr-2"></i></a>
                    <a class="text-white" href=""><i class="fa-solid fa-envelope"></i></a>
                </div>

                <div class="flex items-center">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="hidden md:block bg-gray-600 hover:bg-gray-700 px-4 py-2 rounded-md text-sm font-medium text-white">
                            <i class="fas fa-user-circle mr-2"></i>Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="hidden md:block bg-gray-600 hover:bg-gray-700 px-4 py-2 rounded-md text-sm font-medium text-white">
                            <i class="fas fa-sign-in-alt mr-2"></i>Login</a>
                        <a href="{{ route('register') }}" class="ml-4 hidden md:block bg-gray-600 hover:bg-gray-700 px-4 py-2 rounded-md text-sm font-medium text-white">
                            <i class="fas fa-user mr-2"></i>Register</a>
                    <div class="p-2 flex items-center">
                        <fb:login-button
                            scope="public_profile,email"
                            onlogin="checkLoginState();">
                        </fb:login-button>
                    </div>
                    @endauth
                </div>

                <!-- Mobile Menu Button -->
                <div class="md:hidden">
                    <button class="focus:outline-none">
                        <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </nav>

        <div class="min-h-screen flex flex-col items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">
            <div class="pt-28 min-1200">
                {{ $slot }}
            </div>
        </div>
    <!-- Scripts -->
    <script>
        window.fbAsyncInit = function() {
            FB.init({
                appId      : '217670841182193',
                cookie     : true,
                xfbml      : true,
                version    : 'v17.0'
            });

            FB.AppEvents.logPageView();

        };

        (function(d, s, id){
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) {return;}
            js = d.createElement(s); js.id = id;
            js.src = "https://connect.facebook.net/en_US/sdk.js";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>
    @livewireScripts
    </body>
</html>
