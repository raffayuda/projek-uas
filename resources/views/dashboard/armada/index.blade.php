@extends('dashboard.layout.index')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-indigo-50 via-white to-cyan-50" x-data="{ 
    showDeleteModal: false, 
    armadaToDelete: null,
    searchQuery: '',
    viewMode: 'grid',
    showFilters: false,
    performSearch() {
        const url = new URL(window.location.href);
        url.searchParams.set('search', this.searchQuery);
        window.location.href = url.toString();
    }
}">
    <!-- Modal Konfirmasi Hapus -->
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
            <div class="fixed inset-0 transition-opacity bg-black bg-opacity-60 backdrop-blur-sm"></div>
            <div class="relative bg-white rounded-3xl shadow-2xl max-w-md w-full mx-auto transform transition-all"
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
                        <h3 class="text-2xl font-bold text-gray-900 mb-3">Hapus Kendaraan</h3>
                        <p class="text-gray-600 mb-8">
                            Apakah Anda yakin ingin menghapus kendaraan ini? Tindakan ini tidak dapat dibatalkan dan semua data terkait akan dihapus secara permanen.
                        </p>
                    </div>
                    <div class="flex space-x-3">
                        <button @click="showDeleteModal = false" 
                                class="flex-1 px-6 py-3 border border-gray-300 rounded-xl text-gray-700 font-medium hover:bg-gray-50 transition-all duration-200">
                            Batal
                        </button>
                        <form :action="armadaToDelete ? '/armada/' + armadaToDelete : ''" method="POST" class="flex-1">
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

    <div class="container mx-auto px-6 py-8">
        <!-- Header Section -->
        <div class="mb-10">
            <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center">
                <div class="mb-6 lg:mb-0">
                    <h1 class="text-4xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent mb-2">
                        Armada Kendaraan
                    </h1>
                    <p class="text-gray-600 text-lg">Kelola kendaraan rental Anda dengan gaya dan efisiensi</p>
                    <div class="flex items-center mt-3 space-x-4 text-sm text-gray-500">
                        <span class="flex items-center">
                            <i class="fas fa-car mr-2 text-blue-500"></i>
                            {{ $armadas->total() }} Total Kendaraan
                        </span>
                        <span class="flex items-center">
                            <i class="fas fa-check-circle mr-2 text-green-500"></i>
                            {{ $armadas->where('status', 'available')->count() }} Tersedia
                        </span>
                    </div>
                </div>
                
                <!-- Search dan Actions -->
                <div class="flex flex-col sm:flex-row items-stretch sm:items-center space-y-3 sm:space-y-0 sm:space-x-4 w-full lg:w-auto">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i class="fas fa-search text-gray-400"></i>
                        </div>
                        <input type="text" 
                               x-model="searchQuery"
                               @keyup.enter="performSearch()"
                               placeholder="Cari kendaraan..." 
                               class="pl-12 pr-4 py-3.5 rounded-2xl border-0 bg-white shadow-sm ring-1 ring-gray-200 focus:ring-2 focus:ring-blue-500 focus:bg-white transition-all duration-200 w-full sm:w-80 text-gray-900 placeholder-gray-500">
                    </div>
                    
                    <button @click="showFilters = !showFilters" 
                            class="flex items-center justify-center px-6 py-3.5 bg-white rounded-2xl shadow-sm ring-1 ring-gray-200 hover:ring-gray-300 transition-all duration-200 text-gray-700 font-medium">
                        <i class="fas fa-filter mr-2"></i>
                        Filter
                    </button>
                    
                    <a href="{{ route('armada.create') }}" 
                       class="flex items-center justify-center px-6 py-3.5 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-2xl font-medium shadow-lg hover:shadow-xl hover:from-blue-700 hover:to-blue-800 transition-all duration-200 transform hover:-translate-y-0.5">
                        <i class="fas fa-plus mr-2"></i>
                        Tambah Kendaraan
                    </a>
                </div>
            </div>
        </div>

        <!-- Panel Filter -->
        <div x-show="showFilters" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 transform -translate-y-4"
             x-transition:enter-end="opacity-100 transform translate-y-0"
             class="bg-white rounded-3xl shadow-sm ring-1 ring-gray-200 p-6 mb-8">
            <form action="{{ route('armada.index') }}" method="GET" class="flex flex-wrap items-end gap-6">
                <div class="flex-1 min-w-48">
                    <label for="jenis" class="block text-sm font-semibold text-gray-700 mb-2">Jenis Kendaraan</label>
                    <select name="jenis" id="jenis" class="w-full rounded-xl border-gray-300 shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200">
                        <option value="">Semua Jenis</option>
                        @foreach($jenisKendaraans as $jenis)
                        <option value="{{ $jenis->id }}" {{ request('jenis') == $jenis->id ? 'selected' : '' }}>
                            {{ $jenis->nama }}
                        </option>
                        @endforeach
                    </select>
                </div>
                
                <div class="flex-1 min-w-48">
                    <label for="status" class="block text-sm font-semibold text-gray-700 mb-2">Status</label>
                    <select name="status" id="status" class="w-full rounded-xl border-gray-300 shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200">
                        <option value="">Semua Status</option>
                        <option value="available" {{ request('status') == 'available' ? 'selected' : '' }}>Tersedia</option>
                        <option value="rented" {{ request('status') == 'rented' ? 'selected' : '' }}>Disewa</option>
                    </select>
                </div>
                
                <button type="submit" class="px-8 py-3 bg-gray-900 text-white rounded-xl font-medium hover:bg-gray-800 transition-all duration-200 shadow-lg hover:shadow-xl">
                    <i class="fas fa-search mr-2"></i>
                    Terapkan
                </button>
            </form>
        </div>

        <!-- Grid Kartu Kendaraan -->
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">
            @forelse($armadas as $armada)
            <div class="group bg-white rounded-3xl shadow-sm hover:shadow-2xl transition-all duration-300 overflow-hidden ring-1 ring-gray-100 hover:ring-gray-200 transform hover:-translate-y-2">
                <!-- Gambar Kendaraan -->
                <div class="relative h-56 bg-gradient-to-br from-gray-100 to-gray-200 overflow-hidden">                    @if($armada->gambar)
                    <img src="{{ asset('storage/armada-images/' . $armada->gambar) }}" 
                         alt="{{ $armada->merk }}" 
                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    @else
                    <div class="w-full h-full bg-gradient-to-br from-gray-200 to-gray-300 flex items-center justify-center">
                        <i class="fas fa-car text-5xl text-gray-400"></i>
                    </div>
                    @endif
                    
                    <!-- Badge Status -->
                    <div class="absolute top-4 left-4">
                        <span class="px-3 py-1.5 bg-{{ $armada->status == 'available' ? 'green' : 'red' }}-500 text-white text-xs font-bold rounded-full shadow-lg">
                            {{ $armada->status == 'available' ? 'Tersedia' : 'Disewa' }}
                        </span>
                    </div>
                    
                    <!-- Badge Rating -->
                    <div class="absolute top-4 right-4 bg-white/90 backdrop-blur-sm rounded-full px-3 py-1.5 shadow-lg">
                        <span class="text-sm font-bold text-gray-900">{{ $armada->rating }}</span>
                        <i class="fas fa-star text-yellow-400 ml-1"></i>
                    </div>

                    <!-- Overlay Actions -->
                    <div class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                        <div class="flex space-x-3">
                            <a href="{{ route('armada.edit', $armada->id) }}" 
                               class="p-3 bg-white/90 backdrop-blur-sm text-blue-600 rounded-full hover:bg-white transition-all duration-200 shadow-lg hover:shadow-xl transform hover:scale-110">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button @click="showDeleteModal = true; armadaToDelete = {{ $armada->id }}" 
                                    class="p-3 bg-white/90 backdrop-blur-sm text-red-600 rounded-full hover:bg-white transition-all duration-200 shadow-lg hover:shadow-xl transform hover:scale-110">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Detail Kendaraan -->
                <div class="p-6">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <h3 class="text-xl font-bold text-gray-900 mb-1">{{ $armada->merk }}</h3>
                            <p class="text-gray-500 text-sm font-medium">{{ $armada->nopol }} • {{ $armada->thn_beli }}</p>
                        </div>
                        <div class="text-right">
                            <div class="text-2xl font-bold text-blue-600">Rp {{ number_format($armada->harga, 0, ',', '.') }}</div>
                            <div class="text-xs text-gray-500 font-medium">per hari</div>
                        </div>
                    </div>

                    <!-- Fitur Kendaraan -->
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div class="flex items-center text-sm text-gray-600 bg-gray-50 rounded-xl p-3">
                            <i class="fas fa-car-side text-blue-500 mr-3"></i>
                            <span class="font-medium">{{ $armada->jenisKendaraan->nama }}</span>
                        </div>
                        <div class="flex items-center text-sm text-gray-600 bg-gray-50 rounded-xl p-3">
                            <i class="fas fa-users text-green-500 mr-3"></i>
                            <span class="font-medium">{{ $armada->kapasitas_kursi }} Kursi</span>
                        </div>
                    </div>

                    <p class="text-sm text-gray-600 line-clamp-2 leading-relaxed">{{ $armada->deskripsi }}</p>

                    <!-- Tombol Aksi (Mobile) -->
                    <div class="mt-6 pt-4 border-t border-gray-100 flex space-x-3 md:hidden">
                        <a href="{{ route('armada.edit', $armada->id) }}" 
                           class="flex-1 text-center py-2.5 text-blue-600 border border-blue-200 rounded-xl font-medium hover:bg-blue-50 transition-colors">
                            <i class="fas fa-edit mr-2"></i>Edit
                        </a>
                        <button @click="showDeleteModal = true; armadaToDelete = {{ $armada->id }}" 
                                class="flex-1 py-2.5 text-red-600 border border-red-200 rounded-xl font-medium hover:bg-red-50 transition-colors">
                            <i class="fas fa-trash mr-2"></i>Hapus
                        </button>
                    </div>
                </div>
            </div>
            @empty
            <!-- State Kosong -->
            <div class="col-span-full">
                <div class="text-center py-16">
                    <div class="mx-auto w-24 h-24 bg-gradient-to-br from-blue-100 to-cyan-100 rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-car text-3xl text-blue-500"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-3">Tidak ada kendaraan ditemukan</h3>
                    <p class="text-gray-600 mb-8 max-w-md mx-auto">Mulai dengan menambahkan kendaraan pertama Anda ke armada. Anda dapat menambahkan detail, foto, dan mengelola ketersediaan.</p>
                    <a href="{{ route('armada.create') }}" 
                       class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-2xl font-medium shadow-lg hover:shadow-xl hover:from-blue-700 hover:to-blue-800 transition-all duration-200 transform hover:-translate-y-0.5">
                        <i class="fas fa-plus mr-3"></i>
                        Tambah Kendaraan Pertama
                    </a>
                </div>
            </div>
            @endforelse
        </div>

        <!-- Paginasi -->
        @if($armadas->hasPages())
        <div class="mt-12 flex justify-center">
            <div class="bg-white rounded-2xl shadow-sm ring-1 ring-gray-200 p-2">
                {{ $armadas->appends(request()->query())->links() }}
            </div>
        </div>
        @endif
    </div>
</div>

@push('styles')
<style>
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    
    /* Custom scrollbar */
    ::-webkit-scrollbar {
        width: 6px;
    }
    
    ::-webkit-scrollbar-track {
        background: #f1f5f9;
    }
    
    ::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 3px;
    }
    
    ::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
    }
</style>
@endpush

@push('scripts')
<script>
    // Enhanced search with debouncing
    document.addEventListener('alpine:init', () => {
        Alpine.data('vehicleManager', () => ({
            searchTimeout: null,
            performSearch() {
                clearTimeout(this.searchTimeout);
                this.searchTimeout = setTimeout(() => {
                    const url = new URL(window.location.href);
                    if (this.searchQuery) {
                        url.searchParams.set('search', this.searchQuery);
                    } else {
                        url.searchParams.delete('search');
                    }
                    window.location.href = url.toString();
                }, 500);
            }
        }));
    });
</script>
@endpush
@endsection