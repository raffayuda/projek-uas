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
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    @if($locations && count($locations) > 0)
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-32 mb-20" id="locationContainer">

        <!-- Map Card -->
        <div class="bg-white rounded-3xl shadow-xl p-8 flex flex-col md:flex-row items-center gap-8 mb-12">
            <div class="flex-1 w-full max-w-md">
                <div class="text-2xl font-bold text-gray-900 mb-2" id="currentLocationName">
                    {{ $locations[0]->nama ?? 'Tidak Ada Lokasi' }}
                </div>
                <div class="text-gray-500 mb-4" id="currentLocationAddress">
                    {{ $locations[0]->alamat ?? 'Alamat tidak tersedia' }}
                </div>
                <div class="text-sm text-gray-500 mb-2">
                    Koordinat: <span id="currentLocationCoords">{{ $locations[0]->koordinat ?? '-6.2088,106.8456' }}</span>
                </div>
                <div class="text-xs text-blue-600 mb-4">Tanda merah pada peta menunjukkan lokasi tepat.</div>
                <div class="rounded-xl overflow-hidden border border-gray-200 shadow-sm">
                    <iframe 
                        id="locationMap"
                        src="https://maps.google.com/maps?q={{ $locations[0]->koordinat ?? '-6.2088,106.8456' }}&t=&z=16&ie=UTF8&iwloc=&output=embed" 
                        width="100%" 
                        height="260" 
                        style="border:0;" 
                        allowfullscreen 
                        loading="lazy">
                    </iframe>
                </div>
            </div>
            <div class="hidden md:block flex-1 w-full">
                <img 
                    id="currentLocationImage"
                    src="{{ $locations[0]->image && $locations[0]->image != '' ? (str_starts_with($locations[0]->image, 'http') ? $locations[0]->image : asset('storage/location-images/' . $locations[0]->image)) : 'https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=600&q=80' }}" 
                    alt="Gambar {{ $locations[0]->nama ?? 'Lokasi' }}" 
                    class="rounded-2xl shadow-lg w-full h-full max-h-96 object-cover"
                    onerror="this.src='https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=600&q=80'">
            </div>
        </div>

        <!-- Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-8">
            @foreach($locations as $index => $loc)
            <div class="bg-white rounded-2xl shadow-lg p-6 flex flex-col items-center text-center transition hover:shadow-2xl hover:-translate-y-1 duration-300 location-card">
                <img 
                    src="{{ $loc->image && $loc->image != '' ? (str_starts_with($loc->image, 'http') ? $loc->image : asset('storage/location-images/' . $loc->image)) : 'https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=600&q=80' }}" 
                    alt="Gambar {{ $loc->nama ?? 'Lokasi ' . ($index + 1) }}" 
                    class="w-28 h-28 object-cover rounded-xl mb-4 shadow-md"
                    onerror="this.src='https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=600&q=80'">
                <div class="font-semibold text-lg text-gray-900 mb-1">{{ $loc->nama ?? 'Lokasi ' . ($index + 1) }}</div>
                <div class="text-gray-500 text-sm mb-2">{{ $loc->alamat ?? 'Alamat tidak tersedia' }}</div>
                <div class="text-xs text-gray-400 mb-4">Koordinat: {{ $loc->koordinat ?? '-6.2088,106.8456' }}</div>
                <button 
                    type="button"
                    class="location-btn px-6 py-2 rounded-full font-semibold transition duration-200 shadow-md focus:outline-none cursor-pointer {{ $index === 0 ? 'bg-blue-600 text-white' : 'bg-gray-100 text-blue-600 hover:bg-blue-50' }}"
                    data-index="{{ $index }}"
                    data-nama="{{ e($loc->nama ?? 'Lokasi ' . ($index + 1)) }}"
                    data-alamat="{{ e($loc->alamat ?? 'Alamat tidak tersedia') }}"
                    data-koordinat="{{ $loc->koordinat ?? '-6.2088,106.8456' }}"
                    data-image="{{ $loc->image && $loc->image != '' ? (str_starts_with($loc->image, 'http') ? $loc->image : asset('storage/location-images/' . $loc->image)) : 'https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=600&q=80' }}">
                    Lihat Lokasi
                </button>
            </div>
            @endforeach
        </div>
    </div>
    @else
    <div class="bg-white rounded-3xl shadow-xl p-12 text-center">
        <h3 class="text-2xl font-bold text-gray-900 mb-4">Tidak Ada Lokasi Tersedia</h3>
        <p class="text-gray-500 text-lg">Kami sedang memperbarui informasi lokasi. Silakan cek kembali nanti.</p>
    </div>
    @endif
</div>

<script>
AOS.init({
    duration: 800,
    easing: 'ease-in-out',
    once: true,
    mirror: false
});

function switchLocation(index, nama, alamat, koordinat, image) {
    document.getElementById('currentLocationName').textContent = nama;
    document.getElementById('currentLocationAddress').textContent = alamat;
    document.getElementById('currentLocationCoords').textContent = koordinat;
    
    const imageEl = document.getElementById('currentLocationImage');
    imageEl.src = image;
    imageEl.alt = 'Gambar ' + nama;
    imageEl.onerror = function() {
        this.src = 'https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=600&q=80';
    };

    document.getElementById('locationMap').src = 'https://maps.google.com/maps?q=' + koordinat + '&t=&z=16&ie=UTF8&iwloc=&output=embed';

    document.querySelectorAll('.location-btn').forEach(btn => {
        btn.classList.remove('bg-blue-600', 'text-white');
        btn.classList.add('bg-gray-100', 'text-blue-600', 'hover:bg-blue-50');
    });

    const clickedBtn = document.querySelector(`.location-btn[data-index="${index}"]`);
    if (clickedBtn) {
        clickedBtn.classList.remove('bg-gray-100', 'text-blue-600', 'hover:bg-blue-50');
        clickedBtn.classList.add('bg-blue-600', 'text-white');
    }
}

document.addEventListener('DOMContentLoaded', function() {
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
});
</script>

@endsection
