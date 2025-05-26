<nav class="navbar fixed w-full z-50" 
         x-data="{ isOpen: false, isScrolled: false }" 
         @scroll.window="isScrolled = (window.pageYOffset > 50) ? true : false"
         :class="{'scrolled': isScrolled}">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20">
                <div class="flex items-center">
                    <a href="/" class="flex-shrink-0 flex items-center group">
                        <div class="p-2 bg-blue-600 rounded-lg group-hover:bg-blue-700 transition duration-300">
                            <i class="fas fa-car-side text-2xl text-white"></i>
                        </div>
                        <span class="ml-3 text-2xl font-bold logo-text">DriveEase</span>
                    </a>
                </div>
                <div class="hidden md:flex items-center space-x-8">
                    <a href="/" class="nav-link font-medium{{ request()->is('/') ? ' active' : '' }}">Home</a>
                    <a href="/cars" class="nav-link font-medium{{ request()->is('cars') ? ' active' : '' }}">Cars</a>
                    <a href="/about" class="nav-link font-medium{{ request()->is('about') ? ' active' : '' }}">About</a>
                    <a href="/location" class="nav-link font-medium{{ request()->is('location') ? ' active' : '' }}">Location</a>
                    <a href="/booking" class="nav-link font-medium{{ request()->is('booking') ? ' active' : '' }}">Booking</a>
                    <a href="/contact" class="nav-link font-medium{{ request()->is('contact') ? ' active' : '' }}">Contact</a>
                    @if (Auth::check())
                    <a href="/mybooking" class="w-full nav-button text-white px-6 py-2.5 rounded-full mt-4">
                        My Booking
                    </a>
                    @else
                    <a href="/login" class="w-full nav-button text-white px-6 py-2.5 rounded-full mt-4">
                        Login
                    </a>
                    @endif
                </div>
                <div class="md:hidden flex items-center">
                    <button @click="isOpen = !isOpen" class="text-white transition duration-300" :class="{'text-gray-700': isScrolled}">
                        <i class="fas fa-bars text-2xl"></i>
                    </button>
                </div>
            </div>
        </div>
        <!-- Mobile menu -->
        <div x-show="isOpen" 
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 -translate-y-4"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-4"
             class="md:hidden mobile-menu">
            <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
                <a href="/" class="block px-3 py-2 text-gray-700 hover:text-blue-600 font-medium transition duration-300">Home</a>
                <a href="/cars" class="block px-3 py-2 text-gray-700 hover:text-blue-600 font-medium transition duration-300">Cars</a>
                <a href="#" class="block px-3 py-2 text-gray-700 hover:text-blue-600 font-medium transition duration-300">Services</a>
                <a href="/booking" class="block px-3 py-2 text-blue-600 font-medium">Booking</a>
                <a href="#" class="block px-3 py-2 text-gray-700 hover:text-blue-600 font-medium transition duration-300">About</a>
                <a href="#" class="block px-3 py-2 text-gray-700 hover:text-blue-600 font-medium transition duration-300">Contact</a>
            </div>
        </div>
    </nav>