@extends('layouts.index')
@section('content')

<!-- Booking Form Section -->
<div class="booking-header">
    <div class="hero-pattern"></div>
    <img src="https://images.unsplash.com/photo-1503376780353-7e6692767b70?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80" 
         alt="Lokasi Kami" 
         class="hero-car">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative w-full">
        <div class="hero-content text-center">
            <div class="hero-badge" data-aos="fade-up">
                <i class="fas fa-map-marker-alt"></i>
                <span class="text-white">Lokasi Kami</span>
            </div>
            <h1 class="text-5xl font-extrabold text-white sm:text-6xl lg:text-7xl mb-8" data-aos="fade-up" data-aos-delay="100">
                Temukan Kami <span class="gradient-text">Terdekat</span>
            </h1>
            <p class="text-2xl text-gray-200 max-w-3xl mx-auto mb-12" data-aos="fade-up" data-aos-delay="200">
                Temukan lokasi rental kami di kota-kota besar di Indonesia.
                Kunjungi kami di lokasi yang paling nyaman untuk Anda.
            </p>
            <div class="hero-stats" data-aos="fade-up" data-aos-delay="300">
                <div class="stat-card">
                    <div class="stat-number">{{ count($locations) }}+</div>
                    <div class="stat-label">Lokasi</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">24/7</div>
                    <div class="stat-label">Tersedia</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">Mudah</div>
                    <div class="stat-label">Diakses</div>
                </div>
            </div>
        </div>
    </div>
    <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 animate-bounce" data-aos="fade-up" data-aos-delay="1000">
        <i class="fas fa-chevron-down text-white text-2xl"></i>
    </div>
</div>

<!-- Location Section -->
<div class="bg-gradient-to-b from-gray-50 to-white min-h-screen">
    <!-- Interactive Location Explorer -->
    @if($locations && count($locations) > 0)
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20" id="locationContainer">
        
        <!-- Main Location Display - Modern Design -->
        <div class="bg-white rounded-3xl shadow-2xl overflow-hidden mb-16" data-aos="fade-up">
            <div class="grid lg:grid-cols-2 gap-0">
                <!-- Location Info Panel -->
                <div class="p-8 lg:p-12 flex flex-col justify-center bg-gradient-to-br from-blue-50 to-indigo-100">
                    <div class="mb-6">
                        <div class="inline-flex items-center gap-2 bg-blue-600 text-white px-4 py-2 rounded-full text-sm font-medium mb-4">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>Lokasi Aktif</span>
                        </div>
                        <h2 class="text-4xl font-bold text-gray-900 mb-3" id="currentLocationName">
                            {{ $locations[0]->nama ?? 'Tidak Ada Lokasi' }}
                        </h2>
                        <p class="text-xl text-gray-600 mb-6" id="currentLocationAddress">
                            {{ $locations[0]->alamat ?? 'Alamat tidak tersedia' }}
                        </p>
                    </div>
                    
                    <!-- Location Details -->
                    <div class="space-y-4 mb-8">
                        <div class="flex items-center gap-3 text-gray-700">
                            <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-globe text-blue-600"></i>
                            </div>
                            <div>
                                <div class="font-medium">Koordinat</div>
                                <div class="text-sm text-gray-500" id="currentLocationCoords">{{ $locations[0]->koordinat ?? '-6.2088,106.8456' }}</div>
                            </div>
                        </div>
                        <div class="flex items-center gap-3 text-gray-700">
                            <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-clock text-green-600"></i>
                            </div>
                            <div>
                                <div class="font-medium">Jam Operasional</div>
                                <div class="text-sm text-gray-500">24 Jam / 7 Hari</div>
                            </div>
                        </div>
                        <div class="flex items-center gap-3 text-gray-700">
                            <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-car text-purple-600"></i>
                            </div>
                            <div>
                                <div class="font-medium">Layanan</div>
                                <div class="text-sm text-gray-500">Rental & Konsultasi</div>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-wrap gap-3">
                        <button class="flex items-center gap-2 bg-blue-600 text-white px-6 py-3 rounded-xl font-medium hover:bg-blue-700 transition duration-300 shadow-lg hover:shadow-xl">
                            <i class="fas fa-directions"></i>
                            <span>Dapatkan Arah</span>
                        </button>
                        <button class="flex items-center gap-2 bg-white text-blue-600 border-2 border-blue-600 px-6 py-3 rounded-xl font-medium hover:bg-blue-50 transition duration-300">
                            <i class="fas fa-phone"></i>
                            <span>Hubungi</span>
                        </button>
                    </div>
                </div>

                <!-- Map & Image Panel -->
                <div class="relative">
                    <!-- Location Image -->
                    <div class="relative h-64 lg:h-full">
                        <img 
                            id="currentLocationImage"
                            src="{{ $locations[0]->image && $locations[0]->image != '' ? (str_starts_with($locations[0]->image, 'http') ? $locations[0]->image : asset('storage/location-images/' . $locations[0]->image)) : 'https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=600&q=80' }}" 
                            alt="Gambar {{ $locations[0]->nama ?? 'Lokasi' }}" 
                            class="w-full h-full object-cover"
                            onerror="this.src='https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=600&q=80'">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent"></div>
                    </div>
                    
                    <!-- Floating Map Card -->
                    <div class="absolute bottom-4 left-4 right-4">
                        <div class="bg-white/95 backdrop-blur-sm rounded-2xl p-4 shadow-xl">
                            <div class="flex items-center justify-between mb-3">
                                <h4 class="font-semibold text-gray-900">Lihat di Peta</h4>
                                <button class="text-blue-600 hover:text-blue-800 transition duration-200" onclick="toggleMap()">
                                    <i class="fas fa-expand-alt"></i>
                                </button>
                            </div>
                            <div class="rounded-xl overflow-hidden border border-gray-200" id="mapContainer">
                                <iframe 
                                    id="locationMap"
                                    src="https://maps.google.com/maps?q={{ $locations[0]->koordinat ?? '-6.2088,106.8456' }}&t=&z=16&ie=UTF8&iwloc=&output=embed" 
                                    width="100%" 
                                    height="150" 
                                    style="border:0;" 
                                    allowfullscreen 
                                    loading="lazy">
                                </iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Location Cards Grid - Enhanced Design -->
        <div class="mb-16" data-aos="fade-up" data-aos-delay="200">
            <div class="text-center mb-12">
                <h3 class="text-3xl font-bold text-gray-900 mb-4">Pilih Lokasi Terdekat</h3>
                <p class="text-lg text-gray-600">Temukan cabang kami yang paling nyaman untuk Anda kunjungi</p>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($locations as $index => $loc)
                <div class="group location-card bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 overflow-hidden border border-gray-100">
                    <!-- Card Image -->
                    <div class="relative h-48 overflow-hidden">
                        <img 
                            src="{{ $loc->image && $loc->image != '' ? (str_starts_with($loc->image, 'http') ? $loc->image : asset('storage/location-images/' . $loc->image)) : 'https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=600&q=80' }}" 
                            alt="Gambar {{ $loc->nama ?? 'Lokasi ' . ($index + 1) }}" 
                            class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                            onerror="this.src='https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=600&q=80'">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition duration-500"></div>
                        
                        <!-- Location Badge -->
                        <div class="absolute top-4 left-4">
                            <span class="bg-white/90 backdrop-blur-sm text-gray-900 px-3 py-1 rounded-full text-xs font-medium">
                                Lokasi {{ $index + 1 }}
                            </span>
                        </div>
                        
                        <!-- Quick Info Overlay -->
                        <div class="absolute bottom-4 left-4 right-4 text-white opacity-0 group-hover:opacity-100 transition-all duration-500 transform translate-y-4 group-hover:translate-y-0">
                            <div class="flex items-center gap-2 text-sm">
                                <i class="fas fa-map-marker-alt"></i>
                                <span class="truncate">{{ $loc->koordinat ?? '-6.2088,106.8456' }}</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Card Content -->
                    <div class="p-6">
                        <h4 class="font-bold text-lg text-gray-900 mb-2 group-hover:text-blue-600 transition duration-300">
                            {{ $loc->nama ?? 'Lokasi ' . ($index + 1) }}
                        </h4>
                        <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                            {{ $loc->alamat ?? 'Alamat tidak tersedia' }}
                        </p>
                        
                        <!-- Features -->
                        <div class="flex items-center gap-2 mb-4">
                            <span class="inline-flex items-center gap-1 bg-green-100 text-green-700 px-2 py-1 rounded-full text-xs">
                                <i class="fas fa-clock w-3"></i>
                                24/7
                            </span>
                            <span class="inline-flex items-center gap-1 bg-blue-100 text-blue-700 px-2 py-1 rounded-full text-xs">
                                <i class="fas fa-car w-3"></i>
                                Available
                            </span>
                        </div>
                        
                        <!-- Action Button -->
                        <button 
                            type="button"
                            class="location-btn w-full py-3 rounded-xl font-semibold transition-all duration-300 focus:outline-none focus:ring-4 focus:ring-blue-500/20 {{ $index === 0 ? 'bg-blue-600 text-white shadow-lg' : 'bg-gray-100 text-blue-600 hover:bg-blue-50 hover:text-blue-700' }}"
                            data-index="{{ $index }}"
                            data-nama="{{ e($loc->nama ?? 'Lokasi ' . ($index + 1)) }}"
                            data-alamat="{{ e($loc->alamat ?? 'Alamat tidak tersedia') }}"
                            data-koordinat="{{ $loc->koordinat ?? '-6.2088,106.8456' }}"
                            data-image="{{ $loc->image && $loc->image != '' ? (str_starts_with($loc->image, 'http') ? $loc->image : asset('storage/location-images/' . $loc->image)) : 'https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=600&q=80' }}">
                            <i class="fas fa-eye mr-2"></i>
                            Lihat Detail
                        </button>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Additional Services Section -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6" data-aos="fade-up" data-aos-delay="400">
            <div class="bg-gradient-to-br from-blue-500 to-blue-600 text-white p-8 rounded-2xl shadow-xl">
                <div class="w-12 h-12 bg-white/20 rounded-lg flex items-center justify-center mb-4">
                    <i class="fas fa-phone text-2xl"></i>
                </div>
                <h4 class="text-xl font-bold mb-2">Bantuan 24/7</h4>
                <p class="text-blue-100 mb-4">Tim support kami siap membantu Anda kapan saja</p>
                <button class="bg-white/20 hover:bg-white/30 text-white px-4 py-2 rounded-lg transition duration-300">
                    Hubungi Sekarang
                </button>
            </div>
            
            <div class="bg-gradient-to-br from-green-500 to-green-600 text-white p-8 rounded-2xl shadow-xl">
                <div class="w-12 h-12 bg-white/20 rounded-lg flex items-center justify-center mb-4">
                    <i class="fas fa-route text-2xl"></i>
                </div>
                <h4 class="text-xl font-bold mb-2">Antar Jemput</h4>
                <p class="text-green-100 mb-4">Layanan antar jemput mobil ke lokasi Anda</p>
                <button class="bg-white/20 hover:bg-white/30 text-white px-4 py-2 rounded-lg transition duration-300">
                    Pesan Sekarang
                </button>
            </div>
            
            <div class="bg-gradient-to-br from-purple-500 to-purple-600 text-white p-8 rounded-2xl shadow-xl">
                <div class="w-12 h-12 bg-white/20 rounded-lg flex items-center justify-center mb-4">
                    <i class="fas fa-calendar-check text-2xl"></i>
                </div>
                <h4 class="text-xl font-bold mb-2">Reservasi Online</h4>
                <p class="text-purple-100 mb-4">Pesan mobil Anda dengan mudah secara online</p>
                <button class="bg-white/20 hover:bg-white/30 text-white px-4 py-2 rounded-lg transition duration-300">
                    Reservasi
                </button>
            </div>
        </div>
    </div>
    @else
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
        <div class="bg-white rounded-3xl shadow-2xl p-12 text-center" data-aos="fade-up">
            <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                <i class="fas fa-map-marker-alt text-3xl text-gray-400"></i>
            </div>
            <h3 class="text-3xl font-bold text-gray-900 mb-4">Tidak Ada Lokasi Tersedia</h3>
            <p class="text-gray-500 text-lg mb-8">Kami sedang memperbarui informasi lokasi. Silakan cek kembali nanti atau hubungi customer service kami.</p>
            <button class="bg-blue-600 text-white px-8 py-3 rounded-xl font-medium hover:bg-blue-700 transition duration-300">
                Hubungi Customer Service
            </button>
        </div>
    </div>
    @endif
</div>

<script>
// Initialize AOS
AOS.init({
    duration: 800,
    easing: 'ease-in-out',
    once: true,
    mirror: false
});

// Map toggle functionality
function toggleMap() {
    const mapContainer = document.getElementById('mapContainer');
    const iframe = document.getElementById('locationMap');
    
    if (mapContainer.classList.contains('expanded')) {
        mapContainer.classList.remove('expanded');
        iframe.style.height = '150px';
    } else {
        mapContainer.classList.add('expanded');
        iframe.style.height = '300px';
    }
}

// Enhanced location switching with animations
function switchLocation(index, nama, alamat, koordinat, image) {
    // Add loading state
    const elements = {
        name: document.getElementById('currentLocationName'),
        address: document.getElementById('currentLocationAddress'),
        coords: document.getElementById('currentLocationCoords'),
        image: document.getElementById('currentLocationImage'),
        map: document.getElementById('locationMap')
    };

    // Fade out animation
    Object.values(elements).forEach(el => {
        if (el) el.style.opacity = '0.5';
    });

    // Update content after short delay for smooth transition
    setTimeout(() => {
        elements.name.textContent = nama;
        elements.address.textContent = alamat;
        elements.coords.textContent = koordinat;
        
        elements.image.src = image;
        elements.image.alt = 'Gambar ' + nama;
        elements.image.onerror = function() {
            this.src = 'https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=600&q=80';
        };

        elements.map.src = 'https://maps.google.com/maps?q=' + koordinat + '&t=&z=16&ie=UTF8&iwloc=&output=embed';

        // Fade in animation
        Object.values(elements).forEach(el => {
            if (el) el.style.opacity = '1';
        });
    }, 200);

    // Update button states with enhanced animations
    document.querySelectorAll('.location-btn').forEach(btn => {
        btn.classList.remove('bg-blue-600', 'text-white', 'shadow-lg');
        btn.classList.add('bg-gray-100', 'text-blue-600');
    });

    const clickedBtn = document.querySelector(`.location-btn[data-index="${index}"]`);
    if (clickedBtn) {
        clickedBtn.classList.remove('bg-gray-100', 'text-blue-600');
        clickedBtn.classList.add('bg-blue-600', 'text-white', 'shadow-lg');
        
        // Add pulse animation
        clickedBtn.style.transform = 'scale(0.95)';
        setTimeout(() => {
            clickedBtn.style.transform = 'scale(1)';
        }, 150);
    }

    // Scroll to main location display on mobile
    if (window.innerWidth < 768) {
        document.getElementById('locationContainer').scrollIntoView({ 
            behavior: 'smooth', 
            block: 'start' 
        });
    }
}

// Enhanced event listeners
document.addEventListener('DOMContentLoaded', function() {
    // Location button clicks
    document.addEventListener('click', function(e) {
        const btn = e.target.closest('.location-btn');
        if (!btn) return;

        const index = btn.dataset.index;
        const nama = btn.dataset.nama;
        const alamat = btn.dataset.alamat;
        const koordinat = btn.dataset.koordinat;
        const image = btn.dataset.image;

        switchLocation(index, nama, alamat, koordinat, image);
    });

    // Add intersection observer for card animations
    const cards = document.querySelectorAll('.location-card');
    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry, index) => {
            if (entry.isIntersecting) {
                setTimeout(() => {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }, index * 100);
            }
        });
    }, { threshold: 0.1 });

    cards.forEach(card => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        observer.observe(card);
    });

    // Add smooth transitions to all interactive elements
    const interactiveElements = document.querySelectorAll('button, .location-btn');
    interactiveElements.forEach(el => {
        el.style.transition = 'all 0.3s ease';
    });
});

// Add CSS for enhanced animations
const style = document.createElement('style');
style.textContent = `
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    
    .location-card:hover {
        transform: translateY(-8px) !important;
    }
    
    .location-btn {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
    }
    
    .location-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
    }
    
    .location-btn:active {
        transform: translateY(0);
    }
    
    #currentLocationImage {
        transition: opacity 0.3s ease;
    }
    
    .expanded iframe {
        transition: height 0.3s ease;
    }
`;
document.head.appendChild(style);
</script>

@endsection
