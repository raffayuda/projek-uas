    @extends('layouts.index')
    @section('content')
    <!-- Booking Form Section -->
    <div class="booking-header">
        <div class="hero-pattern"></div>
        <img src="https://images.unsplash.com/photo-1503376780353-7e6692767b70?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80" 
             alt="Our Locations" 
             class="hero-car">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative w-full">
            <div class="hero-content text-center">
                <div class="hero-badge" data-aos="fade-up">
                    <i class="fas fa-map-marker-alt"></i>
                    <span class="text-white">Our Locations</span>
                </div>
                <h1 class="text-5xl font-extrabold text-white sm:text-6xl lg:text-7xl mb-8" data-aos="fade-up" data-aos-delay="100">
                    Find Us <span class="gradient-text">Nearby</span>
                </h1>
                <p class="text-2xl text-gray-200 max-w-3xl mx-auto mb-12" data-aos="fade-up" data-aos-delay="200">
                    Discover our rental locations across major cities in Indonesia.
                    Visit us at your most convenient location.
                </p>
                <div class="hero-stats" data-aos="fade-up" data-aos-delay="300">
                    <div class="stat-card">
                        <div class="stat-number">4+</div>
                        <div class="stat-label">Major Cities</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number">24/7</div>
                        <div class="stat-label">Available</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number">Easy</div>
                        <div class="stat-label">Access</div>
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
        <!-- Location Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-32 mb-20" x-data="{
        locations: [
            {
                name: 'Jakarta Downtown',
                address: 'Jl. Sudirman No. 1, Jakarta',
                coordinates: '-6.609609230670722, 106.8039391707528',
                image: 'https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=600&q=80',
            },
            {
                name: 'Bandung City Center',
                address: 'Jl. Asia Afrika No. 2, Bandung',
                coordinates: '-6.9147,107.6098',
                image: 'https://images.unsplash.com/photo-1465101046530-73398c7f28ca?auto=format&fit=crop&w=600&q=80',
            },
            {
                name: 'Surabaya Hub',
                address: 'Jl. Pemuda No. 3, Surabaya',
                coordinates: '-7.2575,112.7521',
                image: 'https://images.unsplash.com/photo-1502082553048-f009c37129b9?auto=format&fit=crop&w=600&q=80',
            },
            {
                name: 'Bali Airport',
                address: 'Ngurah Rai International Airport, Bali',
                coordinates: '-8.7482,115.1675',
                image: 'https://images.unsplash.com/photo-1500534314209-a25ddb2bd429?auto=format&fit=crop&w=600&q=80',
            },
        ],
        selected: 0
    }">
        <!-- Large Map Card -->
        <div class="bg-white rounded-3xl shadow-xl p-8 flex flex-col md:flex-row items-center gap-8 mb-12">
            <div class="flex-1 w-full max-w-md">
                <div class="text-2xl font-bold text-gray-900 mb-2" x-text="locations[selected].name"></div>
                <div class="text-gray-500 mb-4" x-text="locations[selected].address"></div>
                <div class="text-sm text-gray-500 mb-2">Koordinat: <span x-text="locations[selected].coordinates"></span></div>
                <div class="text-xs text-blue-600 mb-4">Tanda merah pada peta menunjukkan lokasi tepat.</div>
                <div class="rounded-xl overflow-hidden border border-gray-200 shadow-sm">
                    <iframe :src="'https://maps.google.com/maps?q=' + locations[selected].coordinates + '&t=&z=16&ie=UTF8&iwloc=&output=embed'" width="100%" height="260" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
            <div class="hidden md:block flex-1 w-full">
                <img :src="locations[selected].image" alt="Location Image" class="rounded-2xl shadow-lg w-full h-full max-h-96 object-cover">
            </div>
        </div>
        <!-- Location Cards Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-8">
            <template x-for="(loc, idx) in locations" :key="idx">
                <div class="bg-white rounded-2xl shadow-lg p-6 flex flex-col items-center text-center transition hover:shadow-2xl hover:-translate-y-1 duration-300">
                    <img :src="loc.image" alt="Location" class="w-28 h-28 object-cover rounded-xl mb-4 shadow-md">
                    <div class="font-semibold text-lg text-gray-900 mb-1" x-text="loc.name"></div>
                    <div class="text-gray-500 text-sm mb-2" x-text="loc.address"></div>
                    <div class="text-xs text-gray-400 mb-4" x-text="'Koordinat: ' + loc.coordinates"></div>
                    <button @click="selected = idx" :class="selected === idx ? 'bg-blue-600 text-white' : 'bg-gray-100 text-blue-600 hover:bg-blue-50'" class="px-6 py-2 rounded-full font-semibold transition duration-200 shadow-md focus:outline-none">
                        Lihat Lokasi
                    </button>
                </div>
            </template>
        </div>
    </div>
    <!-- End Location Section -->
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
