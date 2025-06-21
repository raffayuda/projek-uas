
<nav class="navbar fixed w-full z-50" 
         x-data="{ isOpen: false, isScrolled: false }" 
         @scroll.window="isScrolled = (window.pageYOffset > 50) ? true : false"
         :class="{'scrolled': isScrolled}">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20">
                <div class="flex items-center">
                    <a href="/" class="flex-shrink-0 flex items-center group">
                        <div class="p-2 rounded-lg group-hover:bg-blue-700 transition duration-300">
                            <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-purple-600 rounded-lg flex items-center justify-center shadow-lg">
                                <i class="fas fa-car text-white text-xl"></i>
                            </div>
                        </div>
                        <span class="ml-3 text-2xl font-bold logo-text transition-colors duration-300" 
                              :class="isScrolled ? 'text-gray-800' : 'text-white'">DrivEasy</span>
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
                    <a href="/mybooking" class="nav-link font-medium{{ request()->is('mybooking') ? ' active' : '' }}">My Booking</a>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="nav-button text-white px-6 py-2.5 rounded-full bg-red-600 hover:bg-red-700 transition-colors duration-300">
                            Logout
                        </button>
                    </form>
                    @else
                    <a href="/login" class="nav-link font-medium">
                        Login
                    </a>
                    <a href="/register" class="nav-button text-white px-6 py-2.5 rounded-full">
                        Register
                    </a>
                    @endif
                </div>
                <div class="md:hidden flex items-center">
                    <button @click="isOpen = !isOpen" 
                            class="transition duration-300" 
                            :class="isScrolled ? 'text-gray-700' : 'text-white'">
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
                <a href="/about" class="block px-3 py-2 text-gray-700 hover:text-blue-600 font-medium transition duration-300">About</a>
                <a href="/location" class="block px-3 py-2 text-gray-700 hover:text-blue-600 font-medium transition duration-300">Location</a>
                <a href="/booking" class="block px-3 py-2 text-gray-700 hover:text-blue-600 font-medium transition duration-300">Booking</a>
                <a href="/contact" class="block px-3 py-2 text-gray-700 hover:text-blue-600 font-medium transition duration-300">Contact</a>
                @if (Auth::check())
                <a href="/mybooking" class="nav-link font-medium{{ request()->is('mybooking') ? ' active' : '' }}">My Booking</a>
                <form method="POST" action="{{ route('logout') }}" class="px-3 py-2">
                    @csrf
                    <button type="submit" class="w-full text-left text-red-600 font-medium">Logout</button>
                </form>
                @else
                <a href="/login" class="block px-3 py-2 text-blue-600 font-medium">Login</a>
                <a href="/register" class="block px-3 py-2 text-green-600 font-medium">Register</a>
                @endif
            </div>
        </div>
    </nav>