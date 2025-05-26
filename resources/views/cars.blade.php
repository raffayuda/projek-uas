    @extends('layouts.index')
    @section('content')

    <!-- Booking Form Section -->
    <div class="booking-header">
        <div class="hero-pattern"></div>
        <img src="https://images.unsplash.com/photo-1503376780353-7e6692767b70?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80" 
             alt="Available Cars" 
             class="hero-car">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative w-full">
            <div class="hero-content text-center">
                <div class="hero-badge" data-aos="fade-up">
                    <i class="fas fa-car"></i>
                    <span class="text-white">Our Vehicle Fleet</span>
                </div>
                <h1 class="text-5xl font-extrabold text-white sm:text-6xl lg:text-7xl mb-8" data-aos="fade-up" data-aos-delay="100">
                    Available <span class="gradient-text">Cars</span>
                </h1>
                <p class="text-2xl text-gray-200 max-w-3xl mx-auto mb-12" data-aos="fade-up" data-aos-delay="200">
                    Browse our selection of quality vehicles.
                    Find the perfect car for your needs and budget.
                </p>
                <div class="hero-stats" data-aos="fade-up" data-aos-delay="300">
                    <div class="stat-card">
                        <div class="stat-number">Cars</div>
                        <div class="stat-label">All Types</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number">Prices</div>
                        <div class="stat-label">Best Rates</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number">Book</div>
                        <div class="stat-label">Easy Process</div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Scroll Indicator -->
        <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 animate-bounce" data-aos="fade-up" data-aos-delay="1000">
            <i class="fas fa-chevron-down text-white text-2xl"></i>
        </div>
    </div>

    <!-- Multi-step Form -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10">
            <!-- Card 1 -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden transform transition hover:scale-102 hover:shadow-2xl car-card" data-aos="fade-up" data-aos-delay="100">
                <div class="relative">
                    <img src="https://images.unsplash.com/photo-1617469767053-3c4f2a9c0459?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80" alt="Toyota Camry" class="w-full h-56 object-cover">
                    <div class="absolute top-4 right-4 bg-[#334155] text-white px-3 py-1 rounded-full text-sm font-medium">Sedan</div>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Toyota Camry</h3>
                    <p class="text-gray-500 mb-4">Comfortable and efficient sedan for city rides.</p>
                    <div class="flex items-center justify-between text-sm text-gray-500 mb-2">
                        <span><i class="fas fa-calendar-alt mr-1"></i>2022</span>
                        <span><i class="fas fa-cogs mr-1"></i>Automatic</span>
                        <span><i class="fas fa-user-friends mr-1"></i>5 Seats</span>
                    </div>
                    <div class="flex items-center justify-between text-sm text-gray-500 mb-4">
                        <span><i class="fas fa-gas-pump mr-1"></i>8.5L/100km</span>
                        <span class="flex items-center"><i class="fas fa-star text-yellow-400 mr-1"></i>4.8</span>
                    </div>
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-2xl font-bold text-gray-800">$75</span>
                        <span class="text-gray-400">/day</span>
                    </div>
                    <button class="w-full bg-[#1e293b] text-white px-6 py-2.5 rounded-lg hover:bg-[#334155] transition duration-300 font-semibold text-lg shadow-md">Book Now</button>
                </div>
            </div>
            <!-- Card 2 -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden transform transition hover:scale-102 hover:shadow-2xl car-card" data-aos="fade-up" data-aos-delay="200">
                <div class="relative">
                    <img src="https://images.unsplash.com/photo-1603584173870-7f23fdae1b7a?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80" alt="Honda CR-V" class="w-full h-56 object-cover">
                    <div class="absolute top-4 right-4 bg-[#334155] text-white px-3 py-1 rounded-full text-sm font-medium">SUV</div>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Honda CR-V</h3>
                    <p class="text-gray-500 mb-4">Spacious SUV for family and adventure trips.</p>
                    <div class="flex items-center justify-between text-sm text-gray-500 mb-2">
                        <span><i class="fas fa-calendar-alt mr-1"></i>2023</span>
                        <span><i class="fas fa-cogs mr-1"></i>Automatic</span>
                        <span><i class="fas fa-user-friends mr-1"></i>7 Seats</span>
                    </div>
                    <div class="flex items-center justify-between text-sm text-gray-500 mb-4">
                        <span><i class="fas fa-gas-pump mr-1"></i>7.2L/100km</span>
                        <span class="flex items-center"><i class="fas fa-star text-yellow-400 mr-1"></i>4.7</span>
                    </div>
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-2xl font-bold text-gray-800">$85</span>
                        <span class="text-gray-400">/day</span>
                    </div>
                    <button class="w-full bg-[#1e293b] text-white px-6 py-2.5 rounded-lg hover:bg-[#334155] transition duration-300 font-semibold text-lg shadow-md">Book Now</button>
                </div>
            </div>
            <!-- Card 3 -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden transform transition hover:scale-102 hover:shadow-2xl car-card" data-aos="fade-up" data-aos-delay="300">
                <div class="relative">
                    <img src="https://images.unsplash.com/photo-1555215695-300b0ca386ba?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80" alt="BMW 3 Series" class="w-full h-56 object-cover">
                    <div class="absolute top-4 right-4 bg-[#334155] text-white px-3 py-1 rounded-full text-sm font-medium">Luxury</div>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">BMW 3 Series</h3>
                    <p class="text-gray-500 mb-4">Luxury sedan for a premium driving experience.</p>
                    <div class="flex items-center justify-between text-sm text-gray-500 mb-2">
                        <span><i class="fas fa-calendar-alt mr-1"></i>2022</span>
                        <span><i class="fas fa-cogs mr-1"></i>Automatic</span>
                        <span><i class="fas fa-user-friends mr-1"></i>5 Seats</span>
                    </div>
                    <div class="flex items-center justify-between text-sm text-gray-500 mb-4">
                        <span><i class="fas fa-gas-pump mr-1"></i>6.8L/100km</span>
                        <span class="flex items-center"><i class="fas fa-star text-yellow-400 mr-1"></i>4.9</span>
                    </div>
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-2xl font-bold text-gray-800">$120</span>
                        <span class="text-gray-400">/day</span>
                    </div>
                    <button class="w-full bg-[#1e293b] text-white px-6 py-2.5 rounded-lg hover:bg-[#334155] transition duration-300 font-semibold text-lg shadow-md">Book Now</button>
                </div>
            </div>
            <!-- Card 4 -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden transform transition hover:scale-102 hover:shadow-2xl car-card" data-aos="fade-up" data-aos-delay="400">
                <div class="relative">
                    <img src="https://images.unsplash.com/photo-1503376780353-7e6692767b70?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80" alt="Porsche 911" class="w-full h-56 object-cover">
                    <div class="absolute top-4 right-4 bg-[#334155] text-white px-3 py-1 rounded-full text-sm font-medium">Sports</div>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Porsche 911</h3>
                    <p class="text-gray-500 mb-4">Iconic sports car for thrilling performance.</p>
                    <div class="flex items-center justify-between text-sm text-gray-500 mb-2">
                        <span><i class="fas fa-calendar-alt mr-1"></i>2023</span>
                        <span><i class="fas fa-cogs mr-1"></i>Automatic</span>
                        <span><i class="fas fa-user-friends mr-1"></i>2 Seats</span>
                    </div>
                    <div class="flex items-center justify-between text-sm text-gray-500 mb-4">
                        <span><i class="fas fa-gas-pump mr-1"></i>9.5L/100km</span>
                        <span class="flex items-center"><i class="fas fa-star text-yellow-400 mr-1"></i>4.9</span>
                    </div>
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-2xl font-bold text-gray-800">$200</span>
                        <span class="text-gray-400">/day</span>
                    </div>
                    <button class="w-full bg-[#1e293b] text-white px-6 py-2.5 rounded-lg hover:bg-[#334155] transition duration-300 font-semibold text-lg shadow-md">Book Now</button>
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
