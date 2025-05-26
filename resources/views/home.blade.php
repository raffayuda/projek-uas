@extends('layouts.index')
@section('content')
<style>
    /* Animation for hover effects */
    .group:hover .group-hover\:scale-105 {
        transform: scale(1.05);
    }
    
    /* Gradient text effect */
    .gradient-text {
        background-clip: text;
        -webkit-background-clip: text;
        color: transparent;
        background-image: linear-gradient(to right, #3b82f6, #60a5fa);
    }
    
    /* Smooth transitions */
    .transition {
        transition-property: all;
        transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
        transition-duration: 300ms;
    }
    
    /* Longer duration for some animations */
    .duration-500 {
        transition-duration: 500ms;
    }
    </style>
    <!-- Hero Section -->
    <div class="booking-header">
        <div class="hero-pattern"></div>
        <img src="https://images.unsplash.com/photo-1503376780353-7e6692767b70?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80" 
             alt="Luxury Car" 
             class="hero-car">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative w-full">
            <div class="hero-content text-center">
                <div class="hero-badge" data-aos="fade-up">
                    <i class="fas fa-home"></i>
                    <span class="text-white">Welcome to DriveEase</span>
                </div>
                <h1 class="text-5xl font-extrabold text-white sm:text-6xl lg:text-7xl mb-8" data-aos="fade-up" data-aos-delay="100">
                    Welcome to <span class="gradient-text">DriveEase</span>
                </h1>
                <p class="text-2xl text-gray-200 max-w-3xl mx-auto mb-12" data-aos="fade-up" data-aos-delay="200">
                    Your trusted partner for premium car rentals in Indonesia.
                    Experience comfort and luxury on every journey.
                </p>
                <div class="hero-stats" data-aos="fade-up" data-aos-delay="300">
                    <div class="stat-card">
                        <div class="stat-number">13+</div>
                        <div class="stat-label">Years Experience</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number">20K+</div>
                        <div class="stat-label">Happy Clients</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number">100%</div>
                        <div class="stat-label">Satisfaction</div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Scroll Indicator -->
        <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 animate-bounce" data-aos="fade-up" data-aos-delay="1000">
            <i class="fas fa-chevron-down text-white text-2xl"></i>
        </div>
    </div>

    <!-- Modern Features Section -->
<div class="py-20 bg-gradient-to-b from-white to-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16" data-aos="fade-up">
            <span class="inline-block bg-blue-100 text-blue-600 px-4 py-1 rounded-full text-sm font-semibold mb-3">WHY CHOOSE US</span>
            <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                Premium <span class="bg-clip-text text-transparent bg-gradient-to-r from-blue-600 to-blue-400">Car Rental</span> Experience
            </h2>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                We redefine mobility with exceptional service, cutting-edge technology, and an unparalleled fleet
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Feature 1 -->
            <div class="group relative overflow-hidden rounded-3xl bg-white shadow-lg hover:shadow-xl transition duration-500" data-aos="fade-up">
                <div class="absolute inset-0 bg-gradient-to-br from-blue-600 to-blue-400 opacity-0 group-hover:opacity-100 transition duration-500"></div>
                <div class="relative z-10 p-8">
                    <div class="w-16 h-16 bg-blue-100 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-white/20 transition duration-500">
                        <i class="fas fa-car text-3xl text-blue-600 group-hover:text-white transition duration-500"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4 group-hover:text-white transition duration-500">Diverse Fleet</h3>
                    <p class="text-gray-600 leading-relaxed group-hover:text-white/80 transition duration-500">
                        Choose from 150+ meticulously maintained vehicles, from luxury sedans to family SUVs and high-performance sports cars.
                    </p>
                    <div class="mt-6">
                        <span class="inline-flex items-center text-blue-600 group-hover:text-white font-medium transition duration-500">
                            Explore Fleet
                            <i class="fas fa-arrow-right ml-2"></i>
                        </span>
                    </div>
                </div>
            </div>
            
            <!-- Feature 2 -->
            <div class="group relative overflow-hidden rounded-3xl bg-white shadow-lg hover:shadow-xl transition duration-500" data-aos="fade-up" data-aos-delay="100">
                <div class="absolute inset-0 bg-gradient-to-br from-blue-600 to-blue-400 opacity-0 group-hover:opacity-100 transition duration-500"></div>
                <div class="relative z-10 p-8">
                    <div class="w-16 h-16 bg-blue-100 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-white/20 transition duration-500">
                        <i class="fas fa-shield-alt text-3xl text-blue-600 group-hover:text-white transition duration-500"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4 group-hover:text-white transition duration-500">Total Protection</h3>
                    <p class="text-gray-600 leading-relaxed group-hover:text-white/80 transition duration-500">
                        Comprehensive coverage with zero deductible options and 24/7 roadside assistance for complete peace of mind.
                    </p>
                    <div class="mt-6">
                        <span class="inline-flex items-center text-blue-600 group-hover:text-white font-medium transition duration-500">
                            Insurance Details
                            <i class="fas fa-arrow-right ml-2"></i>
                        </span>
                    </div>
                </div>
            </div>
            
            <!-- Feature 3 -->
            <div class="group relative overflow-hidden rounded-3xl bg-white shadow-lg hover:shadow-xl transition duration-500" data-aos="fade-up" data-aos-delay="200">
                <div class="absolute inset-0 bg-gradient-to-br from-blue-600 to-blue-400 opacity-0 group-hover:opacity-100 transition duration-500"></div>
                <div class="relative z-10 p-8">
                    <div class="w-16 h-16 bg-blue-100 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-white/20 transition duration-500">
                        <i class="fas fa-headset text-3xl text-blue-600 group-hover:text-white transition duration-500"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4 group-hover:text-white transition duration-500">Concierge Service</h3>
                    <p class="text-gray-600 leading-relaxed group-hover:text-white/80 transition duration-500">
                        Your personal mobility assistant available 24/7 with average response time under 3 minutes.
                    </p>
                    <div class="mt-6">
                        <span class="inline-flex items-center text-blue-600 group-hover:text-white font-medium transition duration-500">
                            Contact Support
                            <i class="fas fa-arrow-right ml-2"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Popular Cars Section - Modern Design -->
<div class="py-20 bg-gradient-to-b from-gray-50 to-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16" data-aos="fade-up">
            <span class="inline-block bg-blue-100 text-blue-600 px-4 py-1 rounded-full text-sm font-semibold mb-3">OUR FLEET</span>
            <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                Featured <span class="bg-clip-text text-transparent bg-gradient-to-r from-blue-600 to-blue-400">Vehicles</span>
            </h2>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                Hand-selected luxury and performance vehicles for every occasion
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Car 1 -->
            <div class="group bg-white rounded-3xl overflow-hidden shadow-lg hover:shadow-xl transition duration-500" data-aos="fade-up">
                <div class="relative overflow-hidden h-64">
                    <img src="https://images.unsplash.com/photo-1552519507-da3b142c6e3d?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=800&q=80" 
                         alt="Chevrolet Camaro" 
                         class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                    <div class="absolute top-4 right-4 bg-blue-600 text-white px-3 py-1 rounded-full text-sm font-medium shadow-lg">
                        Sports
                    </div>
                    <div class="absolute bottom-4 left-4 flex items-center">
                        <div class="bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-sm font-medium shadow-sm">
                            <i class="fas fa-star text-yellow-400 mr-1"></i> 4.8
                        </div>
                    </div>
                </div>
                <div class="p-6">
                    <div class="flex justify-between items-start mb-2">
                        <h3 class="text-xl font-bold text-gray-900">Chevrolet Camaro</h3>
                        <span class="text-blue-600 font-bold">$99<span class="text-gray-400 text-sm font-normal">/day</span></span>
                    </div>
                    <p class="text-gray-500 mb-4">Iconic American sports car with thrilling performance</p>
                    
                    <div class="grid grid-cols-3 gap-4 mb-6">
                        <div class="text-center">
                            <div class="text-gray-400 mb-1"><i class="fas fa-calendar-alt"></i></div>
                            <span class="text-sm">2022</span>
                        </div>
                        <div class="text-center">
                            <div class="text-gray-400 mb-1"><i class="fas fa-cogs"></i></div>
                            <span class="text-sm">Auto</span>
                        </div>
                        <div class="text-center">
                            <div class="text-gray-400 mb-1"><i class="fas fa-gas-pump"></i></div>
                            <span class="text-sm">8.5L/100km</span>
                        </div>
                    </div>
                    
                    <button class="w-full bg-gradient-to-r from-blue-600 to-blue-400 text-white px-6 py-3 rounded-lg font-semibold hover:shadow-lg transition duration-300 group">
                        <span class="group-hover:translate-x-2 transition duration-300 inline-block">Book Now</span>
                        <i class="fas fa-arrow-right ml-2 opacity-0 group-hover:opacity-100 transition duration-300"></i>
                    </button>
                </div>
            </div>
            
            <!-- Car 2 -->
            <div class="group bg-white rounded-3xl overflow-hidden shadow-lg hover:shadow-xl transition duration-500" data-aos="fade-up" data-aos-delay="100">
                <div class="relative overflow-hidden h-64">
                    <img src="https://images.unsplash.com/photo-1553440569-bcc63803a83d?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=800&q=80" 
                         alt="Mercedes-Benz" 
                         class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                    <div class="absolute top-4 right-4 bg-blue-600 text-white px-3 py-1 rounded-full text-sm font-medium shadow-lg">
                        Luxury
                    </div>
                    <div class="absolute bottom-4 left-4 flex items-center">
                        <div class="bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-sm font-medium shadow-sm">
                            <i class="fas fa-star text-yellow-400 mr-1"></i> 4.9
                        </div>
                    </div>
                </div>
                <div class="p-6">
                    <div class="flex justify-between items-start mb-2">
                        <h3 class="text-xl font-bold text-gray-900">Mercedes-Benz E-Class</h3>
                        <span class="text-blue-600 font-bold">$149<span class="text-gray-400 text-sm font-normal">/day</span></span>
                    </div>
                    <p class="text-gray-500 mb-4">Executive luxury with cutting-edge technology</p>
                    
                    <div class="grid grid-cols-3 gap-4 mb-6">
                        <div class="text-center">
                            <div class="text-gray-400 mb-1"><i class="fas fa-calendar-alt"></i></div>
                            <span class="text-sm">2023</span>
                        </div>
                        <div class="text-center">
                            <div class="text-gray-400 mb-1"><i class="fas fa-cogs"></i></div>
                            <span class="text-sm">Auto</span>
                        </div>
                        <div class="text-center">
                            <div class="text-gray-400 mb-1"><i class="fas fa-gas-pump"></i></div>
                            <span class="text-sm">7.2L/100km</span>
                        </div>
                    </div>
                    
                    <button class="w-full bg-gradient-to-r from-blue-600 to-blue-400 text-white px-6 py-3 rounded-lg font-semibold hover:shadow-lg transition duration-300 group">
                        <span class="group-hover:translate-x-2 transition duration-300 inline-block">Book Now</span>
                        <i class="fas fa-arrow-right ml-2 opacity-0 group-hover:opacity-100 transition duration-300"></i>
                    </button>
                </div>
            </div>
            
            <!-- Car 3 -->
            <div class="group bg-white rounded-3xl overflow-hidden shadow-lg hover:shadow-xl transition duration-500" data-aos="fade-up" data-aos-delay="200">
                <div class="relative overflow-hidden h-64">
                    <img src="https://images.unsplash.com/photo-1549317661-bd32c8ce0db2?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=800&q=80" 
                         alt="Toyota RAV4" 
                         class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                    <div class="absolute top-4 right-4 bg-blue-600 text-white px-3 py-1 rounded-full text-sm font-medium shadow-lg">
                        SUV
                    </div>
                    <div class="absolute bottom-4 left-4 flex items-center">
                        <div class="bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-sm font-medium shadow-sm">
                            <i class="fas fa-star text-yellow-400 mr-1"></i> 4.7
                        </div>
                    </div>
                </div>
                <div class="p-6">
                    <div class="flex justify-between items-start mb-2">
                        <h3 class="text-xl font-bold text-gray-900">Toyota RAV4 Hybrid</h3>
                        <span class="text-blue-600 font-bold">$79<span class="text-gray-400 text-sm font-normal">/day</span></span>
                    </div>
                    <p class="text-gray-500 mb-4">Efficient and spacious for family adventures</p>
                    
                    <div class="grid grid-cols-3 gap-4 mb-6">
                        <div class="text-center">
                            <div class="text-gray-400 mb-1"><i class="fas fa-calendar-alt"></i></div>
                            <span class="text-sm">2022</span>
                        </div>
                        <div class="text-center">
                            <div class="text-gray-400 mb-1"><i class="fas fa-cogs"></i></div>
                            <span class="text-sm">Hybrid</span>
                        </div>
                        <div class="text-center">
                            <div class="text-gray-400 mb-1"><i class="fas fa-gas-pump"></i></div>
                            <span class="text-sm">6.8L/100km</span>
                        </div>
                    </div>
                    
                    <button class="w-full bg-gradient-to-r from-blue-600 to-blue-400 text-white px-6 py-3 rounded-lg font-semibold hover:shadow-lg transition duration-300 group">
                        <span class="group-hover:translate-x-2 transition duration-300 inline-block">Book Now</span>
                        <i class="fas fa-arrow-right ml-2 opacity-0 group-hover:opacity-100 transition duration-300"></i>
                    </button>
                </div>
            </div>
        </div>
        
        <div class="text-center mt-12" data-aos="fade-up">
            <button class="inline-flex items-center px-6 py-3 border border-blue-600 text-blue-600 font-medium rounded-full hover:bg-blue-50 transition duration-300">
                View Full Fleet
                <i class="fas fa-arrow-right ml-2"></i>
            </button>
        </div>
    </div>
</div>


<!-- Services Section - Modern Design -->
<div class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16" data-aos="fade-up">
            <span class="inline-block bg-blue-100 text-blue-600 px-4 py-1 rounded-full text-sm font-semibold mb-3">OUR SERVICES</span>
            <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                Beyond <span class="bg-clip-text text-transparent bg-gradient-to-r from-blue-600 to-blue-400">Car Rental</span>
            </h2>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                Comprehensive mobility solutions tailored to your lifestyle
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Service 1 -->
            <div class="group relative overflow-hidden rounded-3xl bg-gray-50 shadow-sm hover:shadow-md transition duration-500" data-aos="fade-up">
                <div class="p-8">
                    <div class="w-14 h-14 bg-white rounded-xl shadow-md flex items-center justify-center mb-6">
                        <i class="fas fa-car text-2xl text-blue-600"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Flexible Fleet</h3>
                    <p class="text-gray-600 leading-relaxed mb-6">
                        Choose from 12 vehicle categories with flexible rental periods from hourly to monthly.
                    </p>
                    <ul class="space-y-2 text-gray-600">
                        <li class="flex items-center">
                            <i class="fas fa-check-circle text-blue-500 mr-2"></i>
                            <span>150+ vehicles available</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check-circle text-blue-500 mr-2"></i>
                            <span>Hourly, daily, weekly rates</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check-circle text-blue-500 mr-2"></i>
                            <span>One-way rentals available</span>
                        </li>
                    </ul>
                </div>
            </div>
            
            <!-- Service 2 -->
            <div class="group relative overflow-hidden rounded-3xl bg-gray-50 shadow-sm hover:shadow-md transition duration-500" data-aos="fade-up" data-aos-delay="100">
                <div class="p-8">
                    <div class="w-14 h-14 bg-white rounded-xl shadow-md flex items-center justify-center mb-6">
                        <i class="fas fa-headset text-2xl text-blue-600"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Premium Support</h3>
                    <p class="text-gray-600 leading-relaxed mb-6">
                        White-glove service with dedicated account managers for corporate clients.
                    </p>
                    <ul class="space-y-2 text-gray-600">
                        <li class="flex items-center">
                            <i class="fas fa-check-circle text-blue-500 mr-2"></i>
                            <span>24/7 multilingual support</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check-circle text-blue-500 mr-2"></i>
                            <span>Dedicated account managers</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check-circle text-blue-500 mr-2"></i>
                            <span>Priority booking access</span>
                        </li>
                    </ul>
                </div>
            </div>
            
            <!-- Service 3 -->
            <div class="group relative overflow-hidden rounded-3xl bg-gray-50 shadow-sm hover:shadow-md transition duration-500" data-aos="fade-up" data-aos-delay="200">
                <div class="p-8">
                    <div class="w-14 h-14 bg-white rounded-xl shadow-md flex items-center justify-center mb-6">
                        <i class="fas fa-shield-alt text-2xl text-blue-600"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Total Protection</h3>
                    <p class="text-gray-600 leading-relaxed mb-6">
                        Comprehensive coverage options tailored to your rental needs.
                    </p>
                    <ul class="space-y-2 text-gray-600">
                        <li class="flex items-center">
                            <i class="fas fa-check-circle text-blue-500 mr-2"></i>
                            <span>Zero deductible options</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check-circle text-blue-500 mr-2"></i>
                            <span>24/7 roadside assistance</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check-circle text-blue-500 mr-2"></i>
                            <span>Damage protection included</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Testimonials Section - Modern Design -->
<div class="py-20 bg-gradient-to-b from-white to-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16" data-aos="fade-up">
            <span class="inline-block bg-blue-100 text-blue-600 px-4 py-1 rounded-full text-sm font-semibold mb-3">TESTIMONIALS</span>
            <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                Client <span class="bg-clip-text text-transparent bg-gradient-to-r from-blue-600 to-blue-400">Experiences</span>
            </h2>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                Don't take our word for it - hear from our valued customers
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Testimonial 1 -->
            <div class="group bg-white rounded-3xl p-8 shadow-lg hover:shadow-xl transition duration-500" data-aos="fade-up">
                <div class="flex items-center mb-6">
                    <img src="https://randomuser.me/api/portraits/men/1.jpg" alt="John Doe" class="w-14 h-14 rounded-full object-cover border-2 border-white shadow-md">
                    <div class="ml-4">
                        <h4 class="text-lg font-bold text-gray-900">John Doe</h4>
                        <p class="text-gray-500 text-sm">Business Traveler</p>
                    </div>
                </div>
                <div class="text-yellow-400 mb-4">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <p class="text-gray-600 leading-relaxed mb-6">
                    "The seamless booking process and impeccable vehicle condition made this my go-to rental service for all business trips."
                </p>
                <div class="text-blue-500">
                    <i class="fas fa-quote-right text-3xl opacity-20"></i>
                </div>
            </div>
            
            <!-- Testimonial 2 -->
            <div class="group bg-white rounded-3xl p-8 shadow-lg hover:shadow-xl transition duration-500" data-aos="fade-up" data-aos-delay="100">
                <div class="flex items-center mb-6">
                    <img src="https://randomuser.me/api/portraits/women/1.jpg" alt="Jane Smith" class="w-14 h-14 rounded-full object-cover border-2 border-white shadow-md">
                    <div class="ml-4">
                        <h4 class="text-lg font-bold text-gray-900">Jane Smith</h4>
                        <p class="text-gray-500 text-sm">Family Vacation</p>
                    </div>
                </div>
                <div class="text-yellow-400 mb-4">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <p class="text-gray-600 leading-relaxed mb-6">
                    "Perfect family SUV with all the safety features we needed. The child seats were clean and properly installed."
                </p>
                <div class="text-blue-500">
                    <i class="fas fa-quote-right text-3xl opacity-20"></i>
                </div>
            </div>
            
            <!-- Testimonial 3 -->
            <div class="group bg-white rounded-3xl p-8 shadow-lg hover:shadow-xl transition duration-500" data-aos="fade-up" data-aos-delay="200">
                <div class="flex items-center mb-6">
                    <img src="https://randomuser.me/api/portraits/men/2.jpg" alt="Mike Johnson" class="w-14 h-14 rounded-full object-cover border-2 border-white shadow-md">
                    <div class="ml-4">
                        <h4 class="text-lg font-bold text-gray-900">Mike Johnson</h4>
                        <p class="text-gray-500 text-sm">Weekend Getaway</p>
                    </div>
                </div>
                <div class="text-yellow-400 mb-4">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
                <p class="text-gray-600 leading-relaxed mb-6">
                    "The Camaro was an absolute dream to drive. Pickup and dropoff were quicker than any other rental I've used."
                </p>
                <div class="text-blue-500">
                    <i class="fas fa-quote-right text-3xl opacity-20"></i>
                </div>
            </div>
        </div>
    </div>
</div>

    <!-- Sponsors Section -->
    <div class="py-16 bg-gray-50 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12" data-aos="fade-up">
                <h2 class="text-3xl font-extrabold text-gray-900 sm:text-4xl mb-4">
                    Our Trusted <span class="gradient-text">Partners</span>
                </h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    We partner with the world's leading automotive brands to provide you with the best vehicles
                </p>
            </div>
            
            <div class="relative">
                <!-- Gradient Overlays -->
                <div class="absolute left-0 top-0 bottom-0 w-32 bg-gradient-to-r from-gray-50 to-transparent z-10"></div>
                <div class="absolute right-0 top-0 bottom-0 w-32 bg-gradient-to-l from-gray-50 to-transparent z-10"></div>
                
                <!-- Marquee Container -->
                <div class="relative overflow-hidden">
                    <div class="flex animate-scroll space-x-16">
                        <!-- First Set -->
                        <div class="flex-shrink-0 w-48 h-24 bg-white rounded-xl shadow-sm hover:shadow-lg transition duration-300 transform hover:-translate-y-1 p-4 flex items-center justify-center">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/9d/Toyota_carlogo.svg/2560px-Toyota_carlogo.svg.png" alt="Toyota" class="max-h-full max-w-full object-contain filter grayscale hover:grayscale-0 transition duration-300">
                        </div>
                        <div class="flex-shrink-0 w-48 h-24 bg-white rounded-xl shadow-sm hover:shadow-lg transition duration-300 transform hover:-translate-y-1 p-4 flex items-center justify-center">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/3/38/Honda-logo.jpg/2560px-Honda-logo.jpg" alt="Honda" class="max-h-full max-w-full object-contain filter grayscale hover:grayscale-0 transition duration-300">
                        </div>
                        <div class="flex-shrink-0 w-48 h-24 bg-white rounded-xl shadow-sm hover:shadow-lg transition duration-300 transform hover:-translate-y-1 p-4 flex items-center justify-center">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/4/44/BMW.svg/2048px-BMW.svg.png" alt="BMW" class="max-h-full max-w-full object-contain filter grayscale hover:grayscale-0 transition duration-300">
                        </div>
                        <div class="flex-shrink-0 w-48 h-24 bg-white rounded-xl shadow-sm hover:shadow-lg transition duration-300 transform hover:-translate-y-1 p-4 flex items-center justify-center">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/90/Mercedes-Logo.svg/2560px-Mercedes-Logo.svg.png" alt="Mercedes" class="max-h-full max-w-full object-contain filter grayscale hover:grayscale-0 transition duration-300">
                        </div>
                        <div class="flex-shrink-0 w-48 h-24 bg-white rounded-xl shadow-sm hover:shadow-lg transition duration-300 transform hover:-translate-y-1 p-4 flex items-center justify-center">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/92/Audi-Logo_2016.svg/2560px-Audi-Logo_2016.svg.png" alt="Audi" class="max-h-full max-w-full object-contain filter grayscale hover:grayscale-0 transition duration-300">
                        </div>
                        <div class="flex-shrink-0 w-48 h-24 bg-white rounded-xl shadow-sm hover:shadow-lg transition duration-300 transform hover:-translate-y-1 p-4 flex items-center justify-center">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/25/Lexus_logo.svg/2560px-Lexus_logo.svg.png" alt="Lexus" class="max-h-full max-w-full object-contain filter grayscale hover:grayscale-0 transition duration-300">
                        </div>
                        <!-- Duplicate Set for Seamless Loop -->
                        <div class="flex-shrink-0 w-48 h-24 bg-white rounded-xl shadow-sm hover:shadow-lg transition duration-300 transform hover:-translate-y-1 p-4 flex items-center justify-center">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/9d/Toyota_carlogo.svg/2560px-Toyota_carlogo.svg.png" alt="Toyota" class="max-h-full max-w-full object-contain filter grayscale hover:grayscale-0 transition duration-300">
                        </div>
                        <div class="flex-shrink-0 w-48 h-24 bg-white rounded-xl shadow-sm hover:shadow-lg transition duration-300 transform hover:-translate-y-1 p-4 flex items-center justify-center">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/3/38/Honda-logo.jpg/2560px-Honda-logo.jpg" alt="Honda" class="max-h-full max-w-full object-contain filter grayscale hover:grayscale-0 transition duration-300">
                        </div>
                        <div class="flex-shrink-0 w-48 h-24 bg-white rounded-xl shadow-sm hover:shadow-lg transition duration-300 transform hover:-translate-y-1 p-4 flex items-center justify-center">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/4/44/BMW.svg/2048px-BMW.svg.png" alt="BMW" class="max-h-full max-w-full object-contain filter grayscale hover:grayscale-0 transition duration-300">
                        </div>
                        <div class="flex-shrink-0 w-48 h-24 bg-white rounded-xl shadow-sm hover:shadow-lg transition duration-300 transform hover:-translate-y-1 p-4 flex items-center justify-center">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/90/Mercedes-Logo.svg/2560px-Mercedes-Logo.svg.png" alt="Mercedes" class="max-h-full max-w-full object-contain filter grayscale hover:grayscale-0 transition duration-300">
                        </div>
                        <div class="flex-shrink-0 w-48 h-24 bg-white rounded-xl shadow-sm hover:shadow-lg transition duration-300 transform hover:-translate-y-1 p-4 flex items-center justify-center">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/92/Audi-Logo_2016.svg/2560px-Audi-Logo_2016.svg.png" alt="Audi" class="max-h-full max-w-full object-contain filter grayscale hover:grayscale-0 transition duration-300">
                        </div>
                        <div class="flex-shrink-0 w-48 h-24 bg-white rounded-xl shadow-sm hover:shadow-lg transition duration-300 transform hover:-translate-y-1 p-4 flex items-center justify-center">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/25/Lexus_logo.svg/2560px-Lexus_logo.svg.png" alt="Lexus" class="max-h-full max-w-full object-contain filter grayscale hover:grayscale-0 transition duration-300">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
   
    <script>
        // Initialize AOS
        AOS.init({
            duration: 800,
            easing: 'ease-in-out',
            once: true,
            mirror: false
        });
    </script>
