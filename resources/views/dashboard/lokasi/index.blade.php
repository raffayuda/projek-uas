@extends('dashboard.layout.index')

@section('content')
<link rel="stylesheet" href="{{ asset('css/lokasi-dashboard.css') }}">
<div class="floating-bg">
    <div class="floating-shapes">
        <div class="floating-shape"></div>
        <div class="floating-shape"></div>
        <div class="floating-shape"></div>
    </div>
</div>

<div class="container mx-auto px-4 py-8" x-data="{
    viewMode: 'grid',
    searchQuery: '',
    selectedCategory: 'all',
    showDeleteModal: false,
    locationToDelete: null
}"><!-- Enhanced Delete Modal -->
    <div x-show="showDeleteModal" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-50 overflow-y-auto" 
         style="display: none;">
        <div class="flex items-center justify-center min-h-screen px-4">
            <div class="fixed inset-0 transition-opacity bg-black/60 backdrop-blur-sm"></div>
            <div class="relative bg-white/95 backdrop-blur-xl rounded-3xl shadow-2xl max-w-md w-full mx-auto transform transition-all border border-white/30"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 translate-y-4 scale-95"
                 x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                 x-transition:leave-end="opacity-0 translate-y-4 scale-95">
                <div class="p-8">
                    <div class="text-center">
                        <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-red-100 mb-6">
                            <i class="fas fa-exclamation-triangle text-red-500 text-2xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-3">Hapus Lokasi</h3>
                        <p class="text-gray-600 mb-8">
                            Apakah Anda yakin ingin menghapus lokasi ini? Tindakan ini tidak dapat dibatalkan.
                        </p>
                    </div>
                    <div class="flex space-x-3">
                        <button @click="showDeleteModal = false" 
                                class="flex-1 px-6 py-3 border border-gray-300 rounded-xl text-gray-700 font-medium hover:bg-gray-50 transition-all duration-200">
                            Batal
                        </button>
                        <form :action="locationToDelete ? '/lokasi/' + locationToDelete : ''" method="POST" class="flex-1">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="w-full px-6 py-3 bg-red-500 text-white rounded-xl font-medium hover:bg-red-600 transition-all duration-200 shadow-lg hover:shadow-xl">
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Header Section -->
    <div class="glass-header rounded-2xl p-6 mb-8">
        <div class="flex flex-col lg:flex-row lg:justify-between lg:items-center space-y-4 lg:space-y-0">
            <div>
                <h1 class="text-4xl font-bold bg-gradient-to-r from-emerald-600 to-teal-600 bg-clip-text text-transparent mb-2">
                    <i class="fas fa-map-marked-alt mr-3"></i>Lokasi Rental
                </h1>
                <p class="text-gray-600">Kelola semua lokasi rental kendaraan Anda</p>
                <div class="flex items-center space-x-6 text-sm text-gray-500 mt-2">
                    <span class="flex items-center">
                        <i class="fas fa-map-marker-alt mr-2 text-emerald-500"></i>
                        {{ $locations->count() }} Total Lokasi
                    </span>
                    <span class="flex items-center">
                        <i class="fas fa-globe mr-2 text-teal-500"></i>
                        Tersedia Nasional
                    </span>
                    <span class="flex items-center">
                        <i class="fas fa-clock mr-2 text-cyan-500"></i>
                        Layanan 24/7
                    </span>
                </div>
            </div>
            
            <div class="flex flex-col sm:flex-row space-y-3 sm:space-y-0 sm:space-x-4">
                <!-- View Toggle -->
                <div class="view-toggle rounded-lg p-1 flex">
                    <button @click="viewMode = 'grid'" 
                            :class="viewMode === 'grid' ? 'bg-emerald-500 text-white' : 'text-gray-600 hover:text-emerald-600'"
                            class="px-4 py-2 rounded-md transition-all duration-300 flex items-center">
                        <i class="fas fa-th mr-2"></i>Grid
                    </button>
                    <button @click="viewMode = 'list'" 
                            :class="viewMode === 'list' ? 'bg-emerald-500 text-white' : 'text-gray-600 hover:text-emerald-600'"
                            class="px-4 py-2 rounded-md transition-all duration-300 flex items-center">
                        <i class="fas fa-list mr-2"></i>List
                    </button>
                </div>
                
                <a href="{{ route('lokasi.create') }}" 
                   class="emerald-gradient text-white px-6 py-3 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105 flex items-center justify-center">
                    <i class="fas fa-plus mr-2"></i>Tambah Lokasi
                </a>
            </div>
        </div>
        
        <!-- Search and Filter -->
        <div class="mt-6 flex flex-col lg:flex-row space-y-4 lg:space-y-0 lg:space-x-4">
            <div class="flex-1">
                <div class="relative">                    <i class="fas fa-search absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    <input type="text" 
                           x-model="searchQuery"
                           placeholder="Cari berdasarkan kota (contoh: Jakarta Pusat, Kemayoran, Bandung)..."
                           class="w-full pl-12 pr-4 py-3 rounded-xl border border-emerald-200 focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all duration-300 bg-white/90 backdrop-blur-sm">
                      <!-- Search Helper -->
                    <div x-show="searchQuery.length > 0" 
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 scale-95"
                         x-transition:enter-end="opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-150"
                         x-transition:leave-start="opacity-100 scale-100"
                         x-transition:leave-end="opacity-0 scale-95"
                         class="absolute top-full left-0 right-0 mt-2 p-3 bg-white/95 backdrop-blur-sm rounded-xl border border-emerald-200 shadow-lg z-10">
                        <div class="text-sm text-gray-600">
                            <i class="fas fa-info-circle text-emerald-500 mr-2"></i>
                            Mencari lokasi dengan kota: <span class="font-semibold text-emerald-600" x-text="searchQuery"></span>
                        </div>
                    </div>
                </div>
            </div>
            
            
        </div>
    </div>    @if(session('success'))
    <div class="success-alert text-emerald-700 p-4 mb-6 rounded-xl" role="alert">
        <div class="flex items-center">
            <i class="fas fa-check-circle text-emerald-500 mr-3"></i>
            <p class="font-medium">{{ session('success') }}</p>
        </div>
    </div>
    @endif

    <!-- Search Results Counter -->
    <div x-show="searchQuery.length > 0" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 -translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0"
         class="mb-6">
        <div class="glass-header rounded-xl p-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="flex-shrink-0">
                        <i class="fas fa-search text-emerald-500 text-lg"></i>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">
                            Hasil pencarian untuk "<span class="font-semibold text-emerald-600" x-text="searchQuery"></span>"
                        </p>
                        <p class="text-xs text-gray-500" 
                           x-text="(document.querySelectorAll('.location-card[x-show]').length - document.querySelectorAll('.location-card[style*=\\'display: none\\']').length) + ' lokasi ditemukan'">
                        </p>
                    </div>
                </div>
                <button @click="searchQuery = ''" 
                        class="text-gray-400 hover:text-gray-600 transition-colors">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
    </div>    <!-- Locations Grid/List -->
    <div :class="viewMode === 'grid' ? 'grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8' : 'space-y-6'">
        @forelse($locations as $location)
        <div class="location-card rounded-2xl p-6 transform transition-all duration-300"
             x-data="{ 
                 locationName: '{{ addslashes($location->nama) }}',
                 locationAddress: '{{ addslashes($location->alamat) }}'
             }"
             x-show="searchQuery === '' || 
                     extractCityFromAddress(locationAddress).toLowerCase().includes(searchQuery.toLowerCase()) ||
                     locationAddress.toLowerCase().includes(searchQuery.toLowerCase())"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 scale-100"
             x-transition:leave-end="opacity-0 scale-95">
            
            <!-- Location Image -->
            <div class="relative h-48 -m-6 mb-6 rounded-t-2xl overflow-hidden">
                @if($location->image)
                <img src="{{ asset('storage/location-images/' . $location->image) }}" 
                     alt="{{ $location->nama }}" 
                     class="w-full h-full object-cover">
                @else
                <div class="w-full h-full emerald-gradient flex items-center justify-center">
                    <i class="fas fa-map-marker-alt text-white text-4xl opacity-80"></i>
                </div>
                @endif
                
                <!-- Image Overlay -->
                <div class="image-overlay absolute inset-0 flex items-center justify-center">
                    <div class="quick-actions flex space-x-3">
                        <a href="{{ route('lokasi.edit', $location->id) }}" 
                           class="p-3 bg-white/90 backdrop-blur-sm text-blue-600 rounded-full hover:bg-white transition-all duration-200 shadow-lg">
                            <i class="fas fa-edit"></i>
                        </a>
                        <button @click="showDeleteModal = true; locationToDelete = {{ $location->id }}" 
                                class="p-3 bg-white/90 backdrop-blur-sm text-red-600 rounded-full hover:bg-white transition-all duration-200 shadow-lg">
                            <i class="fas fa-trash"></i>
                        </button>
                        @if($location->koordinat)
                        <a href="https://maps.google.com/?q={{ $location->koordinat }}" target="_blank"
                           class="p-3 bg-white/90 backdrop-blur-sm text-emerald-600 rounded-full hover:bg-white transition-all duration-200 shadow-lg">
                            <i class="fas fa-external-link-alt"></i>
                        </a>
                        @endif
                    </div>
                </div>

                <!-- Location Badge -->
                <div class="absolute top-4 left-4">
                    <span class="px-3 py-1 bg-white/90 backdrop-blur-sm text-emerald-700 text-xs font-bold rounded-full">
                        #{{ $location->id }}
                    </span>
                </div>
            </div>            <!-- Content -->
            <div>
                <div class="flex items-start justify-between mb-2">
                    <h3 class="text-xl font-bold text-gray-900">{{ $location->nama }}</h3>
                    <!-- City Badge -->
                    <span class="city-badge px-2 py-1 bg-gradient-to-r from-emerald-100 to-teal-100 text-emerald-700 text-xs font-semibold rounded-full border border-emerald-200"
                          x-text="extractCityFromAddress(locationAddress)"
                          x-show="extractCityFromAddress(locationAddress) !== locationAddress">
                    </span>
                </div>                <div class="flex items-start text-gray-600 mb-4">
                    <i class="fas fa-map-marker-alt mr-2 mt-1 text-emerald-500 flex-shrink-0"></i>
                    <p class="text-sm leading-relaxed" 
                       x-html="highlightSearchTerm(locationAddress, searchQuery)">
                    </p>
                </div>
                
                <!-- Features Grid -->
                <div class="grid grid-cols-2 gap-3 mb-4">
                    @if($location->koordinat)
                    <div class="flex items-center text-xs text-gray-600 bg-emerald-50 rounded-lg p-2">
                        <i class="fas fa-crosshairs text-emerald-500 mr-2"></i>
                        <span>GPS Ready</span>
                    </div>
                    @endif
                    
                    <div class="flex items-center text-xs text-gray-600 bg-teal-50 rounded-lg p-2">
                        <i class="fas fa-clock text-teal-500 mr-2"></i>
                        <span>24/7 Open</span>
                    </div>
                    
                    <div class="flex items-center text-xs text-gray-600 bg-cyan-50 rounded-lg p-2">
                        <i class="fas fa-car text-cyan-500 mr-2"></i>
                        <span>Parking</span>
                    </div>
                    
                    <div class="flex items-center text-xs text-gray-600 bg-blue-50 rounded-lg p-2">
                        <i class="fas fa-wifi text-blue-500 mr-2"></i>
                        <span>Free WiFi</span>
                    </div>
                </div>

                <!-- Mobile Actions -->
                <div class="flex space-x-2 md:hidden">
                    <a href="{{ route('lokasi.edit', $location->id) }}" 
                       class="flex-1 text-center py-2 text-blue-600 border border-blue-200 rounded-lg text-sm font-medium hover:bg-blue-50 transition-colors">
                        <i class="fas fa-edit mr-1"></i>Edit
                    </a>
                    <button @click="showDeleteModal = true; locationToDelete = {{ $location->id }}" 
                            class="flex-1 py-2 text-red-600 border border-red-200 rounded-lg text-sm font-medium hover:bg-red-50 transition-colors">
                        <i class="fas fa-trash mr-1"></i>Hapus
                    </button>
                </div>
            </div>
        </div>        @empty
        <!-- Empty State -->
        <div class="col-span-full">
            <div class="text-center py-16">
                <div class="mx-auto w-24 h-24 bg-gradient-to-br from-emerald-100 to-teal-100 rounded-full flex items-center justify-center mb-6">
                    <i class="fas fa-map-marked-alt text-3xl text-emerald-500"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-3">Belum Ada Lokasi</h3>
                <p class="text-gray-600 mb-6 max-w-md mx-auto">
                    Mulai bangun jaringan rental Anda dengan menambahkan lokasi pertama untuk pickup dan drop-off.
                </p>
                <a href="{{ route('lokasi.create') }}" 
                   class="inline-flex items-center px-6 py-3 emerald-gradient text-white rounded-xl font-medium shadow-lg hover:shadow-xl transition-all duration-200 transform hover:scale-105">
                    <i class="fas fa-plus mr-2"></i>
                    Tambah Lokasi Pertama
                </a>
            </div>
        </div>
        @endforelse
        
        <!-- No Search Results State -->
        <div x-show="searchQuery.length > 0" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100"
             x-data="{ 
                 get hasVisibleCards() {
                     return Array.from(document.querySelectorAll('.location-card')).some(card => 
                         !card.style.display || card.style.display !== 'none'
                     );
                 }
             }"
             x-show="!hasVisibleCards"
             class="col-span-full">
            <div class="text-center py-16">
                <div class="mx-auto w-24 h-24 bg-gradient-to-br from-orange-100 to-red-100 rounded-full flex items-center justify-center mb-6">
                    <i class="fas fa-search text-3xl text-orange-500"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-3">Tidak Ada Hasil</h3>
                <p class="text-gray-600 mb-6 max-w-md mx-auto">
                    Tidak ditemukan lokasi dengan kota "<span class="font-semibold text-orange-600" x-text="searchQuery"></span>". 
                    Coba kata kunci lain atau tambahkan lokasi baru.
                </p>
                <div class="flex flex-col sm:flex-row gap-3 justify-center">
                    <button @click="searchQuery = ''" 
                            class="inline-flex items-center px-6 py-3 border border-gray-300 text-gray-700 rounded-xl font-medium hover:bg-gray-50 transition-all duration-200">
                        <i class="fas fa-undo mr-2"></i>
                        Reset Pencarian
                    </button>
                    <a href="{{ route('lokasi.create') }}" 
                       class="inline-flex items-center px-6 py-3 emerald-gradient text-white rounded-xl font-medium shadow-lg hover:shadow-xl transition-all duration-200 transform hover:scale-105">
                        <i class="fas fa-plus mr-2"></i>
                        Tambah Lokasi Baru
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
<script>    // Function to extract city names from address
    function extractCityFromAddress(address) {
        // Comprehensive list of Indonesian cities, districts, and areas
        const cities = [
            // Jakarta areas
            'Jakarta Pusat', 'Jakarta Utara', 'Jakarta Selatan', 'Jakarta Timur', 'Jakarta Barat',
            'Kemayoran', 'Menteng', 'Tanah Abang', 'Cempaka Putih', 'Johar Baru', 'Gambir',
            'Sawah Besar', 'Kelapa Gading', 'Sunter', 'Ancol', 'Pademangan', 'Tanjung Priok',
            'Kebayoran Lama', 'Kebayoran Baru', 'Pesanggrahan', 'Cilandak', 'Pasar Minggu',
            'Jagakarsa', 'Mampang Prapatan', 'Setiabudi', 'Tebet', 'Kramat Jati', 'Pasar Rebo',
            'Cipayung', 'Cakung', 'Matraman', 'Pulo Gadung', 'Duren Sawit', 'Makasar',
            'Cengkareng', 'Grogol Petamburan', 'Taman Sari', 'Tambora', 'Kebon Jeruk',
            'Palmerah', 'Kembangan', 'Kalideres',
            
            // Major cities
            'Bandung', 'Surabaya', 'Medan', 'Bekasi', 'Depok', 'Tangerang', 'Semarang',
            'Palembang', 'Makassar', 'Yogyakarta', 'Solo', 'Malang', 'Bogor', 'Batam',
            'Pekanbaru', 'Bandar Lampung', 'Padang', 'Denpasar', 'Samarinda', 'Balikpapan',
            
            // Other cities
            'Jambi', 'Cirebon', 'Sukabumi', 'Serang', 'Mataram', 'Manado', 'Pontianak',
            'Bengkulu', 'Banjarmasin', 'Palu', 'Ambon', 'Kupang', 'Kendari', 'Gorontalo',
            'Mamuju', 'Sofifi', 'Banda Aceh', 'Tanjung Pinang', 'Pangkal Pinang', 'Jayapura',
            
            // Additional areas
            'Bintaro', 'Serpong', 'Alam Sutera', 'BSD', 'Karawaci', 'Gading Serpong',
            'Lippo Cikarang', 'Sentul', 'Cibubur', 'Pondok Indah', 'Kelapa Gading'
        ];
        
        // Convert address to lowercase for comparison
        const lowerAddress = address.toLowerCase();
        
        // Find longest matching city in the address (to get more specific areas)
        let foundCity = '';
        for (let city of cities) {
            if (lowerAddress.includes(city.toLowerCase()) && city.length > foundCity.length) {
                foundCity = city;
            }
        }
        
        if (foundCity) return foundCity;
        
        // Enhanced patterns for Indonesian address structures
        const patterns = [
            // Kota/Kabupaten patterns
            /(?:kota|kab\.?|kabupaten)\s+([a-z\s]+?)(?:\s|,|$)/i,
            
            // Jakarta specific patterns
            /([a-z\s]+?)\s+(?:jakarta|jkt)(?:\s|,|$)/i,
            /jakarta\s+([a-z\s]+?)(?:\s|,|$)/i,
            
            // General city patterns
            /([a-z\s]+?)\s+(?:kota|kab|city)(?:\s|,|$)/i,
            
            // Area/district patterns
            /(?:kelurahan|kecamatan|distrik)\s+([a-z\s]+?)(?:\s|,|$)/i,
            
            // Common Indonesian location indicators
            /(?:jl\.?|jalan)\s+[^,]+?,\s*([a-z\s]+?)(?:\s|,|$)/i,
        ];
        
        for (let pattern of patterns) {
            const match = address.match(pattern);
            if (match && match[1] && match[1].trim().length > 2) {
                return match[1].trim();
            }
        }
        
        // If no pattern matches, try to extract first meaningful word group
        const words = address.split(/[,\s]+/).filter(word => 
            word.length > 2 && 
            !['jalan', 'jl', 'no', 'rt', 'rw', 'blok'].includes(word.toLowerCase())
        );
        
        if (words.length > 0) {
            return words[0];
        }
          return address; // Return full address if no city pattern found
    }

    // Function to highlight search terms in text
    function highlightSearchTerm(text, searchTerm) {
        if (!searchTerm || searchTerm.length === 0) {
            return text;
        }
        
        const regex = new RegExp(`(${searchTerm})`, 'gi');
        return text.replace(regex, '<span class="bg-yellow-200 text-yellow-800 px-1 rounded font-semibold">$1</span>');
    }

    // Additional JavaScript for enhanced functionality
    document.addEventListener('DOMContentLoaded', function() {
        // Smooth animations for cards
        const cards = document.querySelectorAll('.location-card');
        cards.forEach((card, index) => {
            card.style.animationDelay = `${index * 0.1}s`;
        });
        
        // Auto-hide success messages
        const alerts = document.querySelectorAll('.success-alert');
        alerts.forEach(alert => {
            setTimeout(() => {
                alert.style.opacity = '0';
                alert.style.transform = 'translateY(-10px)';
                setTimeout(() => alert.remove(), 300);
            }, 5000);
        });
          // Make functions globally available for Alpine.js
        window.extractCityFromAddress = extractCityFromAddress;
        window.highlightSearchTerm = highlightSearchTerm;
    });
</script>
@endpush
@endsection