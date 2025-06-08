@extends('layouts.index')
@section('content')
@section('styles')
<style>
    /* Enhanced Modern Styling */
    .car-card {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
              <!-- Results Info -->
            <div class="mb-8 flex justify-between items-center results-info p-6 rounded-2xl" data-aos="fade-up">
                <div>
                    <h2 class="text-3xl font-bold gradient-text mb-2">Tersedia {{ $cars->total() }} Mobil</h2>
                    <p class="text-gray-600">
                        @if(request('search'))
                            Hasil pencarian untuk "<strong class="text-indigo-600">{{ request('search') }}</strong>"
                        @elseif(request('type'))
                            Filter: <strong class="text-indigo-600">{{ request('type') }}</strong>
                        @else
                            Semua mobil rental tersedia
                        @endif
                    </p>
                </div>
                <div class="text-sm text-gray-500 bg-white/70 px-4 py-2 rounded-full">
                    Halaman {{ $cars->currentPage() }} dari {{ $cars->lastPage() }}
                </div>
            </div>r-card:hover {
        transform: translateY(-8px) scale(1.02);
        box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
    }
    
    .car-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, rgba(79, 70, 229, 0.05) 0%, rgba(147, 51, 234, 0.05) 100%);
        opacity: 0;
        transition: opacity 0.3s ease;
        border-radius: 1rem;
        pointer-events: none;
    }
    
    .car-card:hover::before {
        opacity: 1;
    }
    
    .price-highlight {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        animation: priceGlow 2s ease-in-out infinite alternate;
    }
    
    @keyframes priceGlow {
        0% { 
            filter: brightness(1); 
        }
        100% { 
            filter: brightness(1.2); 
        }
    }
    
    .status-badge {
        animation: statusPulse 2s ease-in-out infinite;
    }
    
    @keyframes statusPulse {
        0%, 100% { 
            transform: scale(1); 
        }
        50% { 
            transform: scale(1.05); 
        }
    }
    
    .filter-container {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.3);
    }
    
    .gradient-text {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    
    .floating-card {
        animation: float 6s ease-in-out infinite;
    }
    
    @keyframes float {
        0%, 100% { 
            transform: translateY(0px); 
        }
        50% { 
            transform: translateY(-10px); 
        }
    }
    
    .shimmer-effect {
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
        background-size: 200% 100%;
        animation: shimmer 2s infinite;
    }
    
    @keyframes shimmer {
        0% { background-position: -200% 0; }
        100% { background-position: 200% 0; }
    }
    
    .results-info {
        background: linear-gradient(135deg, rgba(255,255,255,0.9) 0%, rgba(248,250,252,0.9) 100%);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255,255,255,0.3);
    }
    
    /* Enhanced Button Styles */
    .btn-gradient {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
        transition: all 0.3s ease;
    }
    
    .btn-gradient:hover {
        transform: translateY(-2px);
        box-shadow: 0 15px 30px rgba(102, 126, 234, 0.4);
    }
    
    .btn-gradient:active {
        transform: translateY(0);
    }
    
    /* Loading Animation */
    .loading-spinner {
        width: 40px;
        height: 40px;
        border: 4px solid #f3f3f3;
        border-top: 4px solid #667eea;
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }
    
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
    
    /* Enhanced Empty State */
    .empty-state {
        background: linear-gradient(135deg, rgba(255,255,255,0.9) 0%, rgba(248,250,252,0.9) 100%);
        backdrop-filter: blur(10px);
        border: 2px dashed rgba(102, 126, 234, 0.3);
    }
    
    /* Mobile Responsive Enhancements */
    @media (max-width: 768px) {
        .car-card:hover {
            transform: translateY(-4px) scale(1.01);
        }
        
        .hero-section h1 {
            font-size: 2.5rem;
        }
        
        .hero-section p {
            font-size: 1.1rem;
        }
    }
</style>
@endsection

<!-- Hero Section -->
    
    <!-- Hero Content -->
    <div class="booking-header">
    <div class="hero-pattern"></div>
    <img src="https://images.unsplash.com/photo-1503376780353-7e6692767b70?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80" 
         alt="Lokasi Kami" 
         class="hero-car">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative w-full">
        <div class="hero-content text-center">
            <div class="hero-badge" data-aos="fade-up">
                <i class="fas fa-map-marker-alt"></i>
                <span class="text-white">Armada Kendaraan Premium</span>
            </div>
            <h1 class="text-5xl font-extrabold text-white sm:text-6xl lg:text-7xl mb-8" data-aos="fade-up" data-aos-delay="100">
                Mobil <span class="gradient-text">Impian Anda</span>
            </h1>
            <p class="text-2xl text-gray-200 max-w-3xl mx-auto mb-12" data-aos="fade-up" data-aos-delay="200">
                Jelajahi koleksi kendaraan premium kami dengan teknologi terdepan dan kenyamanan maksimal untuk perjalanan tak terlupakan
            </p>
            <div class="hero-stats" data-aos="fade-up" data-aos-delay="300">
                <div class="stat-card">
                    <div class="stat-number">{{ $cars->total() }}+</div>
                    <div class="stat-label">Mobil Tersedia</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">{{ $vehicleTypes->count() }}+</div>
                    <div class="stat-label">Jenis Kendaraan</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">24/7</div>
                    <div class="stat-label">Layanan</div>
                </div>
            </div>
        </div>
    </div>
    <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 animate-bounce" data-aos="fade-up" data-aos-delay="1000">
        <i class="fas fa-chevron-down text-white text-2xl"></i>
    </div>
</div>
    
    <!-- Scroll Indicator -->
    <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce">
        <div class="w-6 h-10 border-2 border-white/50 rounded-full flex justify-center">
            <div class="w-1 h-3 bg-white rounded-full mt-2 animate-pulse"></div>
        </div>
    </div>
</div>

<!-- Search & Filter Section -->
<div class="py-16 bg-gradient-to-br from-gray-50 to-blue-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="search-container mb-12" data-aos="fade-up">
            <form method="GET" action="{{ route('cars.index') }}" class="space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                    <!-- Search Input -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Cari Mobil</label>
                        <div class="relative">
                            <input type="text" name="search" value="{{ request('search') }}" 
                                   placeholder="Cari berdasarkan merek atau deskripsi..."
                                   class="w-full pl-12 pr-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-transparent bg-white/80 backdrop-blur-sm">
                            <i class="fas fa-search absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                        </div>
                    </div>
                    
                    <!-- Vehicle Type Filter -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Jenis Kendaraan</label>
                        <select name="type" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-transparent bg-white/80 backdrop-blur-sm">
                            <option value="">Semua Jenis</option>
                            @foreach($vehicleTypes as $type)
                                <option value="{{ $type->nama }}" {{ request('type') == $type->nama ? 'selected' : '' }}>
                                    {{ $type->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <!-- Sort Filter -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Urutkan</label>
                        <select name="sort" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-transparent bg-white/80 backdrop-blur-sm">
                            <option value="">Rating Tertinggi</option>
                            <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Harga Terendah</option>
                            <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Harga Tertinggi</option>
                            <option value="rating" {{ request('sort') == 'rating' ? 'selected' : '' }}>Rating Terbaik</option>
                        </select>
                    </div>
                </div>
                
                <div class="flex flex-wrap gap-4 items-center justify-between">
                    <div class="flex items-center">
                        <input type="checkbox" name="available" value="1" id="available" 
                               {{ request('available') ? 'checked' : '' }}
                               class="w-5 h-5 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                        <label for="available" class="ml-2 text-sm font-medium text-gray-700">
                            Hanya tampilkan mobil yang tersedia
                        </label>
                    </div>
                    
                    <div class="flex gap-3">                        <a href="{{ route('cars.index') }}" class="px-6 py-2 border border-gray-300 rounded-xl text-gray-700 hover:bg-gray-50 transition-colors">
                            Reset
                        </a>
                        <button type="submit" class="px-6 py-2 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-xl hover:from-indigo-700 hover:to-purple-700 transition-all duration-300 font-semibold shadow-lg">
                            <i class="fas fa-filter mr-2"></i>Terapkan Filter
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Cars Grid Section -->
<div class="py-16 bg-gradient-to-br from-gray-50 to-indigo-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if($cars->count() > 0)
            <!-- Results Info -->
            <div class="mb-8 flex justify-between items-center results-info" data-aos="fade-up">
                <div>
                    <h2 class="text-3xl font-bold text-gray-900 mb-2">Tersedia {{ $cars->total() }} Mobil</h2>
                    <p class="text-gray-600">
                        @if(request('search'))
                            Hasil pencarian untuk "<strong>{{ request('search') }}</strong>"
                        @elseif(request('type'))
                            Filter: {{ request('type') }}
                        @else
                            Semua mobil rental tersedia
                        @endif
                    </p>
                </div>
                <div class="text-sm text-gray-500">
                    Halaman {{ $cars->currentPage() }} dari {{ $cars->lastPage() }}
                </div>
            </div>

            <!-- Cars Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($cars as $index => $car)
                    <div class="bg-white rounded-2xl shadow-xl overflow-hidden transform transition hover:scale-105 hover:shadow-2xl car-card group" 
                         data-aos="fade-up" data-aos-delay="{{ ($index % 6) * 100 }}">
                        <div class="relative overflow-hidden">
                            <!-- Car Image -->
                                <img src="{{ Storage::url('armada-images/'.$car->gambar) }}" 
                                     alt="{{ $car->merk }}" 
                                     class="w-full h-56 object-cover group-hover:scale-110 transition-transform duration-500">
                            
                            <!-- Vehicle Type Badge -->
                            <div class="absolute top-4 right-4 bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-3 py-1 rounded-full text-sm font-medium shadow-lg">
                                {{ $car->jenisKendaraan->nama ?? 'Kendaraan' }}
                            </div>
                            
                            <!-- Availability Status -->
                            <div class="absolute top-4 left-4">
                                @if($car->status === 'available')
                                    <div class="bg-green-500 text-white px-3 py-1 rounded-full text-xs font-medium flex items-center status-badge">
                                        <div class="w-2 h-2 bg-white rounded-full mr-1 animate-pulse"></div>
                                        Tersedia
                                    </div>
                                @else
                                    <div class="bg-red-500 text-white px-3 py-1 rounded-full text-xs font-medium flex items-center">
                                        <div class="w-2 h-2 bg-white rounded-full mr-1"></div>
                                        Sedang Disewa
                                    </div>
                                @endif
                            </div>
                        </div>
                        
                        <div class="p-6">
                            <!-- Car Title & Description -->
                            <h3 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-indigo-600 transition-colors">
                                {{ $car->merk }}
                            </h3>
                            <p class="text-gray-600 mb-4 text-sm leading-relaxed">
                                {{ Str::limit($car->deskripsi ?? 'Mobil berkualitas untuk perjalanan Anda', 60) }}
                            </p>
                            
                            <!-- Car Details -->
                            <div class="grid grid-cols-2 gap-2 text-sm text-gray-600 mb-4">
                                <div class="flex items-center">
                                    <i class="fas fa-calendar-alt mr-2 text-indigo-500"></i>
                                    <span>{{ $car->thn_beli ?? 'N/A' }}</span>
                                </div>
                                <div class="flex items-center">
                                    <i class="fas fa-user-friends mr-2 text-indigo-500"></i>
                                    <span>{{ $car->kapasitas_kursi ?? 'N/A' }} Kursi</span>
                                </div>
                                <div class="flex items-center">
                                    <i class="fas fa-id-card mr-2 text-indigo-500"></i>
                                    <span>{{ $car->nopol ?? 'N/A' }}</span>
                                </div>
                                <div class="flex items-center">
                                    <i class="fas fa-star mr-2 text-yellow-500"></i>
                                    <span>{{ number_format($car->rating ?? 0, 1) }}</span>
                                </div>
                            </div>
                            
                            <!-- Price & Action -->
                            <div class="flex items-center justify-between mb-4">
                                <div class="flex items-baseline">
                                    <span class="text-2xl font-bold text-gray-900">
                                        Rp {{ number_format($car->harga, 0, ',', '.') }}
                                    </span>
                                    <span class="text-gray-500 ml-1">/hari</span>
                                </div>
                            </div>
                            
                            <!-- Action Button -->
                            @if($car->status === 'available')
                                <a href="{{ route('booking.create', ['car_id' => $car->id]) }}" 
                                   class="w-full bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-6 py-3 rounded-xl hover:from-indigo-700 hover:to-purple-700 transition-all duration-300 font-semibold text-center block shadow-lg transform hover:scale-105 btn-gradient">
                                    <i class="fas fa-calendar-check mr-2"></i>Pesan Sekarang
                                </a>
                            @else
                                <button disabled 
                                        class="w-full bg-gray-400 text-white px-6 py-3 rounded-xl font-semibold cursor-not-allowed">
                                    <i class="fas fa-clock mr-2"></i>Sedang Disewa
                                </button>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-16" data-aos="fade-up">
                {{ $cars->appends(request()->query())->links('custom-pagination') }}
            </div>

        @else
            <!-- Empty State -->
            <div class="text-center py-16 empty-state" data-aos="fade-up">
                <div class="max-w-md mx-auto">
                    <div class="bg-gray-100 rounded-full w-32 h-32 flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-car-side text-4xl text-gray-400"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Tidak Ada Mobil Ditemukan</h3>
                    <p class="text-gray-600 mb-8">
                        @if(request()->hasAny(['search', 'type', 'sort', 'available']))
                            Maaf, tidak ada mobil yang sesuai dengan kriteria pencarian Anda.
                        @else
                            Saat ini belum ada mobil yang tersedia untuk disewa.
                        @endif
                    </p>
                    <a href="{{ route('cars.index') }}" 
                       class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-semibold rounded-xl hover:from-indigo-700 hover:to-purple-700 transition-all duration-300">
                        <i class="fas fa-refresh mr-2"></i>Reset Filter
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>@endsection

<script>
    // Initialize AOS
    AOS.init({
        duration: 800,
        easing: 'ease-in-out',
        once: true,
        mirror: false
    });

    // Enhanced JavaScript functionality
    document.addEventListener('DOMContentLoaded', function() {
        // Search form auto-submit with debouncing
        let searchTimeout;
        const searchInput = document.querySelector('input[name="search"]');
        if (searchInput) {
            searchInput.addEventListener('input', function() {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(() => {
                    if (this.value.length >= 3 || this.value.length === 0) {
                        this.form.submit();
                    }
                }, 500);
            });
        }

        // Filter change auto-submit
        document.querySelectorAll('select[name="type"], select[name="sort"]').forEach(select => {
            select.addEventListener('change', function() {
                this.form.submit();
            });
        });

        // Car card hover effects
        document.querySelectorAll('.car-card').forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-12px) scale(1.02)';
                this.style.boxShadow = '0 25px 50px rgba(0, 0, 0, 0.2)';
            });

            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0) scale(1)';
                this.style.boxShadow = '';
            });
        });

        // Scroll to results after form submission
        if (window.location.search && document.querySelector('.results-info')) {
            document.querySelector('.results-info').scrollIntoView({ 
                behavior: 'smooth', 
                block: 'start' 
            });
        }

        // Add loading state to buttons
        document.querySelectorAll('a[href*="booking.create"]').forEach(button => {
            button.addEventListener('click', function(e) {
                if (!this.disabled) {
                    this.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Memproses...';
                    this.classList.add('opacity-75', 'cursor-wait');
                }
            });
        });

        // Lazy loading for images
        if ('IntersectionObserver' in window) {
            const imageObserver = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        img.src = img.dataset.src;
                        img.classList.remove('lazy');
                        imageObserver.unobserve(img);
                    }
                });
            });

            document.querySelectorAll('img[data-src]').forEach(img => {
                imageObserver.observe(img);
            });
        }

        // Add price animation on scroll
        const priceElements = document.querySelectorAll('.price-highlight');
        const priceObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.animation = 'priceGlow 2s ease-in-out infinite alternate';
                }
            });
        });

        priceElements.forEach(price => {
            priceObserver.observe(price);
        });

        // Enhanced filtering with URL state management
        const urlParams = new URLSearchParams(window.location.search);
        
        // Update filter UI based on URL params
        if (urlParams.get('search')) {
            document.querySelector('input[name="search"]').value = urlParams.get('search');
        }
        if (urlParams.get('type')) {
            document.querySelector('select[name="type"]').value = urlParams.get('type');
        }
        if (urlParams.get('sort')) {
            document.querySelector('select[name="sort"]').value = urlParams.get('sort');
        }
        if (urlParams.get('available')) {
            document.querySelector('input[name="available"]').checked = true;
        }
    });

    // Smooth scroll for pagination
    document.querySelectorAll('.pagination a').forEach(link => {
        link.addEventListener('click', function(e) {
            // Let the default action proceed, then scroll
            setTimeout(() => {
                document.querySelector('.results-info').scrollIntoView({ 
                    behavior: 'smooth', 
                    block: 'start' 
                });
            }, 100);
        });
    });
</script>
