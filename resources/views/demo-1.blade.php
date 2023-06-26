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
    <!-- Scripts -->
    @vite(['resources/js/app.js'])
</head>
<body class="text-gray-900 antialiased">

<style>
    body{
        font-family: 'Playfair Display', serif;
    }

    a, p {
        font-family: 'Rubik', sans-serif;

    }

    nav > a{
        font-weight: bold;
    }

</style>

<nav class="bg-gray-800 fixed w-full z-10 top-0">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center h-16">
            <!-- Title -->
            <div class="text-white font-bold text-lg">barber<span class="text-3xl">Shop</span></div>

            <!-- Links -->
            <div class="hidden md:flex space-x-4">
                <a href="#" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-bold ">Home</a>
                <a href="#" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-bold ">About</a>
                <a href="#" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-bold ">Prices</a>
                <a href="#" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-bold ">Contact</a>
            </div>

            <div>
                <a class="text-white" href="https://www.facebook.com/yourpage"><i class="fab fa-facebook-square mr-2"></i></a>
                <a class="text-white" href="https://www.instagram.com/yourpage"><i class="fab fa-instagram mr-2"></i></a>
                <a class="text-white" href=""><i class="fa-solid fa-envelope"></i></a>
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

<style>
    .bg-pattern{
        background: url('https://i.imgur.com/lJOIHGF.png');
        background-size: contain;
    }

</style>

<div class="bg-pattern relative mt-16 pt-16 bg-white bg-cover box-content sm:bg-cover">
    <div class="w-9/12 mb-16 min-w-0 mt-8 mx-auto max-w-7xl">
        <div class="text-center">
            <h1 class="text-7xl drop-shadow">Lorem ipsum dolor sit amet</h1>
            <p class="mt-4 text-2xl drop-shadow">sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
            <button class="mt-4 text-2xl drop-shadow">Click Here</button>
        </div>
    </div>

    <style>

    </style>
    <div class="flex flex-col sm:flex-row w-full justify-center items-center gap-4 mb-[100px] overflow-hidden">
        <img class="min-250 h-auto" src="https://atozhairstyles.com/wp-content/uploads/2016/05/23-layered-taper-fade-hairstyles.jpg">
        <img class="min-250 h-auto" src="https://salvatidelta.ro/wp-content/uploads/2020/02/2020-img_5e499e8c85a9e.jpg">
        <img class="min-250 h-auto" src="https://www.dmarge.com/wp-content/uploads/2021/05/mens-quiff-haircuts-quiff-with-fade-920x920.jpg">
    </div>

        <!-- Testimonial Card 2 -->
    <div class="flex flex-col md:flex-row bg-gray-100 border-y-[6em] border-y-gray-800">
        <div class="w-full md:w-[50%] relative">
            <h1 class="absolute -top-12 text-2xl text-white text-center left-[40%] px-4">Where we are</h1>
            <div class="mapouter"><div class="gmap_canvas"><iframe class="gmap_iframe" width="100%" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=600&amp;height=400&amp;hl=en&amp;q=2880 Broadway, New York&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe><a href="https://embed-googlemap.com">embed code google maps</a></div><style>.mapouter{position:relative;text-align:right;width:100%;height:400px;}.gmap_canvas {overflow:hidden;background:none!important;width:100%;height:400px;}.gmap_iframe {height:400px!important;}</style></div>
        </div>
        <div class="w-full md:w-[50%] relative my-auto">
            <h1 class="absolute hidden md:block -top-14 text-2xl text-white left-[40%] px-4">What they say</h1>
            <div class="grid grid-cols-2">
                <!-- Testimonial Card 1 -->
                <div class="rounded-lg overflow-hidden">
                    <div class="p-6">
                        <div class="text-lg font-medium text-gray-900 mb-3">John Doe</div>
                        <div class="text-yellow-400">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        {{ json_encode($scrape) }}
                        <p class="text-gray-700 leading-relaxed">"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse nec ipsum vel metus volutpat aliquam eget et lectus."</p>
                    </div>
                </div>

                <!-- Testimonial Card 2 -->
                <div class="rounded-lg overflow-hidden">
                    <div class="p-6">
                        <div class="text-lg font-medium text-gray-900 mb-3">Jane Smith</div>
                        <div class="text-yellow-400">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <p class="text-gray-700 leading-relaxed">"Fusce malesuada ante ac ligula eleifend, sed sagittis nisi sagittis. Integer et neque sed lorem dictum commodo."</p>
                    </div>
                </div>

                <!-- Testimonial Card 2 -->
                <div class="rounded-lg overflow-hidden">
                    <div class="p-6">
                        <div class="text-lg font-medium text-gray-900 mb-3">Jane Smith</div>
                        <div class="text-yellow-400">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <p class="text-gray-700 leading-relaxed">"Fusce malesuada ante ac ligula eleifend, sed sagittis nisi sagittis. Integer et neque sed lorem dictum commodo."</p>
                    </div>
                </div>

                <!-- Testimonial Card 2 -->
                <div class="rounded-lg overflow-hidden">
                    <div class="p-6">
                        <div class="text-lg font-medium text-gray-900 mb-3">Jane Smith</div>
                        <div class="text-yellow-400">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <p class="text-gray-700 leading-relaxed">"Fusce malesuada ante ac ligula eleifend, sed sagittis nisi sagittis. Integer et neque sed lorem dictum commodo."</p>
                    </div>
                </div>

            </div>

        </div>
    </div>

    <div class="pt-32">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-wrap pb-32">
                <!-- Contact Information -->
                <div class="w-full lg:w-1/2 px-4">
                    <div class="bg-white rounded-lg overflow-hidden shadow-xlg p-6">
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Contact Information</h3>
                        <ul class="text-gray-700">
                            <li class="flex items-center mb-3">
                                <i class="fas fa-envelope mr-2"></i>
                                <a href="mailto:info@example.com">info@example.com</a>
                            </li>
                            <li class="flex items-center mb-3">
                                <i class="fas fa-phone mr-2"></i>
                                <a href="tel:+1234567890">+1 (234) 567-890</a>
                            </li>
                        </ul>
                        <h3 class="text-2xl font-bold text-gray-900 mt-8 mb-4">Socials</h3>
                        <ul class="text-gray-700">
                            <li class="flex items-center mt-6 mb-3">
                                <i class="fab fa-facebook-square mr-2"></i>
                                <a href="https://www.facebook.com/yourpage">Facebook</a>
                            </li>
                            <li class="flex items-center mb-3">
                                <i class="fab fa-instagram mr-2"></i>
                                <a href="https://www.instagram.com/yourpage">Instagram</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Opening Hours -->
                <div class="w-full lg:w-1/2 px-4 mb-8">
                    <div class="bg-white rounded-lg overflow-hidden shadow-xlg p-6">
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Opening Hours</h3>
                        <table class="w-full">
                            <tbody>
                            <tr>
                                <td class="py-2 pr-4 text-gray-700">Monday, Tuesday, Wednesday</td>
                                <td class="py-2 font-sans whitespace-nowrap text-right text-gray-900">8:00 AM - 5:00 PM</td>
                            </tr>
                            <tr>
                                <td class="py-2 pr-4 text-gray-700">Thursday</td>
                                <td class="py-2 font-sans whitespace-nowrap text-right text-gray-900">8:00 AM - 5:00 PM</td>
                            </tr>
                            <tr>
                                <td class="py-2 pr-4 text-gray-700">Friday, Saturday</td>
                                <td class="py-2 font-sans whitespace-nowrap text-right text-gray-900">8:00 AM - 5:00 PM</td>
                            </tr>
                            <tr>
                                <td class="py-2 pr-4 text-gray-700">Sunday</td>
                                <td class="py-2 font-sans whitespace-nowrap text-right text-gray-900">Closed</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    <div class="py-32 bg-gray-900 mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h1 class="text-4xl text-white">Services</h1>

            <div class="grid my-14 grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-6 xl:grid-cols-6 gap-4">
                <div class="min-w-[150px] rounded-md transition-transform hover:scale-105 bg-gray-200 p-4">
                    <p class="text-lg font-semibold">Word 1</p>
                </div>
                <div class="min-w-[150px] rounded-md transition-transform hover:scale-105 bg-gray-200 p-4">
                    <p class="text-lg font-semibold">Word 2</p>
                </div>
                <div class="min-w-[150px] rounded-md transition-transform hover:scale-105 bg-gray-200 p-4">
                    <p class="text-lg font-semibold">Word 3</p>
                </div>
                <div class="min-w-[150px] rounded-md transition-transform hover:scale-105 bg-gray-200 p-4">
                    <p class="text-lg font-semibold">Word 4</p>
                </div>
                <div class="min-w-[150px] rounded-md transition-transform hover:scale-105 bg-gray-200 p-4">
                    <p class="text-lg font-semibold">Word 5</p>
                </div>
                <div class="min-w-[150px] rounded-md transition-transform hover:scale-105 bg-gray-200 p-4">
                    <p class="text-lg font-semibold">Word 5</p>
                </div>
            </div>

        </div>
    </div>
    </div>
        <div class="py-32">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-3xl leading-9 font-extrabold text-gray-900 mb-8 text-center">Price List</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
                    <!-- Service 1 -->
                    <div class="bg-white rounded-lg overflow-hidden shadow-lg">
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-gray-900 mb-4">Haircut</h3>
                            <p class="text-gray-700 mb-4">Get a stylish haircut that suits your style and personality.</p>
                            <p class="text-gray-700">Price: $25</p>
                        </div>
                    </div>

                    <!-- Service 2 -->
                    <div class="bg-white rounded-lg overflow-hidden shadow-lg">
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-gray-900 mb-4">Beard Trim</h3>
                            <p class="text-gray-700 mb-4">Keep your beard well-groomed and perfectly shaped.</p>
                            <p class="text-gray-700">Price: $15</p>
                        </div>
                    </div>

                    <!-- Service 3 -->
                    <div class="bg-white rounded-lg overflow-hidden shadow-lg">
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-gray-900 mb-4">Hot Towel Shave</h3>
                            <p class="text-gray-700 mb-4">Experience a traditional hot towel shave for a smooth and close shave.</p>
                            <p class="text-gray-700">Price: $30</p>
                        </div>
                    </div>

                    <!-- Service 4 -->
                    <div class="bg-white rounded-lg overflow-hidden shadow-lg">
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-gray-900 mb-4">Head Shave</h3>
                            <p class="text-gray-700 mb-4">Go for a clean and refreshing head shave.</p>
                            <p class="text-gray-700">Price: $20</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>


<footer class="bg-gray-900 text-white">
    <div class="max-w-4xl mx-auto px-4 py-8 sm:px-6 lg:px-8">
        <div class="flex flex-wrap -mx-4">
            <!-- Navigation Links -->
            <div class="text-center sm:text-left w-full sm:w-1/2 md:w-1/3 px-4 mb-4">
                <h4 class="text-lg font-bold mb-2">Navigation</h4>
                <nav>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-300 hover:text-white">Home</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white">Services</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white">About</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white">Contact</a></li>
                    </ul>
                </nav>
            </div>

            <!-- Address -->
            <div class="text-center sm:text-left w-full sm:w-1/2 md:w-1/3 px-4 mb-4">
                <h4 class="text-lg font-bold mb-2">Address</h4>
                <p class="text-gray-300">123 Main Street<br>London<br>UK<br>SW1A 1AA</p>
            </div>

            <!-- Contact and Social Media -->
            <div class="text-center sm:text-left w-full sm:w-1/2 md:w-1/3 px-4 mb-4">
                <div class="flex flex-col justify-between">
                    <!-- Contact Number -->
                    <div>
                        <h4 class="text-lg font-bold mb-2">Contact</h4>
                        <p class="text-gray-300">Phone: +44 1234567890</p>
                        <p class="text-gray-300">Email: info@example.com</p>
                    </div>

                    <!-- Follow Us -->
                    <div class="mt-4">
                        <h4 class="text-lg font-bold mb-2">Follow Us</h4>
                        <div class="flex justify-center sm:justify-start space-x-4">
                            <a href="#" class="text-gray-300 hover:text-white"><i class="fab fa-facebook-square"></i></a>
                            <a href="#" class="text-gray-300 hover:text-white"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

</body>
</html>
