@extends('dashboard.layout.index')
@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50" x-data="{ 
    showDeleteModal: false,
    paymentToDelete: null,
    searchQuery: '',
    filterStatus: '',   
    showFilters: false,
    selectedTab: 'all'
}">
    <!-- Animated Background Elements -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-1/2 -left-1/2 w-full h-full bg-gradient-to-br from-blue-400/10 to-transparent rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute -bottom-1/2 -right-1/2 w-full h-full bg-gradient-to-tl from-purple-400/10 to-transparent rounded-full blur-3xl animate-pulse delay-1000"></div>
        <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-gradient-to-br from-indigo-300/10 to-transparent rounded-full blur-2xl animate-bounce" style="animation-duration: 6s;"></div>
    </div>

    <!-- Enhanced Delete Confirmation Modal -->
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
            <div class="relative bg-white/90 backdrop-blur-xl rounded-3xl shadow-2xl max-w-md w-full mx-auto transform transition-all border border-white/20"
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
                        <h3 class="text-2xl font-bold text-gray-900 mb-3">Hapus Pembayaran</h3>
                        <p class="text-gray-600 mb-8">
                            Apakah Anda yakin ingin menghapus data pembayaran ini? Tindakan ini tidak dapat dibatalkan.
                        </p>
                    </div>
                    <div class="flex space-x-3">
                        <button @click="showDeleteModal = false" 
                                class="flex-1 px-6 py-3 border border-gray-300 rounded-xl text-gray-700 font-medium hover:bg-gray-50 transition-all duration-200">
                            Batal
                        </button>
                        <form :action="paymentToDelete ? '/pembayaran/' + paymentToDelete : ''" method="POST" class="flex-1">
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

    <div class="relative z-10 container mx-auto px-6 py-8">
        <!-- Enhanced Header Section -->
        <div class="mb-10">
            <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center">
                <div class="mb-6 lg:mb-0">
                    <h1 class="text-4xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent mb-2">
                        Manajemen Pembayaran
                    </h1>
                    <p class="text-gray-600 text-lg">Kelola dan pantau semua pembayaran sewa dengan wawasan mendalam</p>
                    <div class="flex items-center mt-3 space-x-6 text-sm text-gray-500">
                        <span class="flex items-center">
                            <i class="fas fa-credit-card mr-2 text-blue-500"></i>
                            {{ $pembayarans->total() }} Total Pembayaran
                        </span>
                        <span class="flex items-center">
                            <i class="fas fa-clock mr-2 text-amber-500"></i>
                            {{ $peminjamans->count() }} Menunggu
                        </span>
                        <span class="flex items-center">
                            <i class="fas fa-check-circle mr-2 text-green-500"></i>
                            {{ $pembayarans->where('status_pembayaran', 'Lunas')->count() }} Selesai
                        </span>
                    </div>
                </div>
                
                <!-- Enhanced Search and Actions -->
                <div class="flex flex-col sm:flex-row items-stretch sm:items-center space-y-3 sm:space-y-0 sm:space-x-4 w-full lg:w-auto">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i class="fas fa-search text-gray-400"></i>
                        </div>
                        <input type="text" 
                               x-model="searchQuery"
                               placeholder="Cari berdasarkan nama pelanggan, kendaraan, atau ID pembayaran..." 
                               class="pl-12 pr-4 py-3.5 rounded-2xl border-0 bg-white/70 backdrop-blur-sm shadow-sm ring-1 ring-white/20 focus:ring-2 focus:ring-blue-500 focus:bg-white transition-all duration-200 w-full sm:w-80 text-gray-900 placeholder-gray-500">
                        
                        <!-- Search Helper -->
                        <div x-show="searchQuery.length > 0" 
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 scale-95"
                             x-transition:enter-end="opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-150"
                             x-transition:leave-start="opacity-100 scale-100"
                             x-transition:leave-end="opacity-0 scale-95"
                             class="absolute top-full left-0 right-0 mt-2 p-3 bg-white/95 backdrop-blur-sm rounded-xl border border-blue-200 shadow-lg z-10">
                            <div class="text-sm text-gray-600">
                                <i class="fas fa-info-circle text-blue-500 mr-2"></i>
                                Mencari: <span class="font-semibold text-blue-600" x-text="searchQuery"></span>
                            </div>
                        </div>
                    </div>
                    
                    
                    <a href="{{ route('pembayaran.create') }}" 
                       class="flex items-center justify-center px-6 py-3.5 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-2xl font-medium shadow-lg hover:shadow-xl hover:from-blue-700 hover:to-purple-700 transition-all duration-200 transform hover:-translate-y-0.5">
                        <i class="fas fa-plus mr-2"></i>
                        Tambah Pembayaran
                    </a>
                </div>
            </div>
        </div>

        <!-- Tab Navigation -->
        <div class="mb-8">
            <div class="flex space-x-1 bg-white/50 backdrop-blur-sm p-1 rounded-2xl ring-1 ring-white/20">
                <button @click="selectedTab = 'all'" 
                        :class="selectedTab === 'all' ? 'bg-white shadow-sm text-blue-600' : 'text-gray-600 hover:text-gray-900'"
                        class="flex-1 px-6 py-3 text-sm font-medium rounded-xl transition-all duration-200">
                    Semua Pembayaran
                </button>
                <button @click="selectedTab = 'pending'" 
                        :class="selectedTab === 'pending' ? 'bg-white shadow-sm text-amber-600' : 'text-gray-600 hover:text-gray-900'"
                        class="flex-1 px-6 py-3 text-sm font-medium rounded-xl transition-all duration-200">
                    Menunggu Pembayaran
                </button>
                <button @click="selectedTab = 'completed'" 
                        :class="selectedTab === 'completed' ? 'bg-white shadow-sm text-green-600' : 'text-gray-600 hover:text-gray-900'"
                        class="flex-1 px-6 py-3 text-sm font-medium rounded-xl transition-all duration-200">
                    Selesai
                </button>
            </div>
        </div>

        <!-- Search Results Counter -->
        <div x-show="searchQuery.length > 0" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 -translate-y-2"
             x-transition:enter-end="opacity-100 translate-y-0"
             class="mb-6">
            <div class="bg-white/60 backdrop-blur-lg rounded-2xl p-4 ring-1 ring-white/20">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="flex-shrink-0">
                            <i class="fas fa-search text-blue-500 text-lg"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">
                                Hasil pencarian untuk "<span class="font-semibold text-blue-600" x-text="searchQuery"></span>"
                            </p>
                            <p class="text-xs text-gray-500">
                                <span x-text="(document.querySelectorAll('.payment-card[style*=\\'display: block\\'], .payment-card:not([style*=\\'display: none\\'])').length)"></span> 
                                hasil ditemukan
                            </p>
                        </div>
                    </div>
                    <button @click="searchQuery = ''" 
                            class="text-gray-400 hover:text-gray-600 transition-colors">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Pending Payments Section -->
        @if($peminjamans->count())
        <div x-show="selectedTab === 'pending' || selectedTab === 'all'" class="mb-10">
            <div class="flex items-center mb-6">
                <div class="w-12 h-12 bg-gradient-to-br from-amber-500 to-orange-600 rounded-xl flex items-center justify-center mr-4">
                    <i class="fas fa-clock text-white text-xl"></i>
                </div>
                <div>
                    <h3 class="text-2xl font-bold text-gray-900">Pembayaran Menunggu</h3>
                    <p class="text-gray-600">Sewa yang menunggu proses pembayaran</p>
                </div>
            </div>
            
            <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">
                @foreach($peminjamans as $peminjaman)
                <div class="payment-card group relative overflow-hidden rounded-3xl bg-white/60 backdrop-blur-lg border border-white/20 shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2"
                     x-data="{ 
                         customerName: '{{ addslashes($peminjaman->nama_peminjam) }}',
                         vehicleMerk: '{{ addslashes($peminjaman->armada->merk ?? 'N/A') }}',
                         vehicleNopol: '{{ addslashes($peminjaman->armada->nopol ?? 'N/A') }}',
                         paymentId: '{{ $peminjaman->id }}',
                         phone: '{{ addslashes($peminjaman->phone) }}'
                     }"
                     x-show="searchQuery === '' || 
                             customerName.toLowerCase().includes(searchQuery.toLowerCase()) ||
                             vehicleMerk.toLowerCase().includes(searchQuery.toLowerCase()) ||
                             vehicleNopol.toLowerCase().includes(searchQuery.toLowerCase()) ||
                             paymentId.includes(searchQuery) ||
                             phone.includes(searchQuery)"
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 scale-95"
                     x-transition:enter-end="opacity-100 scale-100"
                     x-transition:leave="transition ease-in duration-200"
                     x-transition:leave-start="opacity-100 scale-100"
                     x-transition:leave-end="opacity-0 scale-95">
                    <!-- Gradient Overlay -->
                    <div class="absolute inset-0 bg-gradient-to-br from-amber-500/10 to-orange-500/10 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    
                    <!-- Card Content -->
                    <div class="relative z-10 p-6">
                        <!-- Header -->
                        <div class="flex justify-between items-start mb-4">
                            <div class="flex items-center">
                                <div class="w-12 h-12 bg-gradient-to-br from-amber-500 to-orange-600 rounded-xl flex items-center justify-center mr-3">
                                    <i class="fas fa-user text-white"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-900" 
                                        x-html="highlightSearchTerm(customerName, searchQuery)">
                                    </h4>
                                    <p class="text-sm text-gray-600" 
                                       x-html="highlightSearchTerm(phone, searchQuery)">
                                    </p>
                                </div>
                            </div>
                            <span class="px-3 py-1 bg-amber-100 text-amber-800 text-xs font-bold rounded-full">
                                #{{ $peminjaman->id }}
                            </span>
                        </div>

                        <!-- Vehicle Info -->
                        <div class="bg-white/50 backdrop-blur-sm rounded-xl p-4 mb-4">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h5 class="font-semibold text-gray-900" 
                                        x-html="highlightSearchTerm(vehicleMerk, searchQuery)">
                                    </h5>
                                    <p class="text-sm text-gray-600" 
                                       x-html="highlightSearchTerm(vehicleNopol, searchQuery)">
                                    </p>
                                </div>
                                <i class="fas fa-car text-2xl text-gray-400"></i>
                            </div>
                        </div>

                        <!-- Date Range -->
                        <div class="flex items-center text-sm text-gray-600 mb-4">
                            <i class="fas fa-calendar-alt mr-2 text-blue-500"></i>
                            <span>{{ \Carbon\Carbon::parse($peminjaman->mulai)->format('d M Y') }} - {{ \Carbon\Carbon::parse($peminjaman->selesai)->format('d M Y') }}</span>
                        </div>

                        <!-- Amount -->
                        <div class="flex justify-between items-center mb-6">
                            <span class="text-sm font-medium text-gray-600">Total Biaya</span>
                            <span class="text-2xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
                                Rp {{ number_format($peminjaman->biaya, 0, ',', '.') }}
                            </span>
                        </div>

                        <!-- Action Button -->
                        <a href="{{ route('pembayaran.create', ['peminjaman_id' => $peminjaman->id]) }}"
                           class="w-full flex items-center justify-center px-6 py-3 bg-gradient-to-r from-green-500 to-emerald-600 text-white font-semibold rounded-xl hover:from-green-600 hover:to-emerald-700 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:scale-105">
                            <i class="fas fa-credit-card mr-2"></i>
                            Proses Pembayaran
                        </a>
                    </div>
                </div>
                @endforeach
                
                <!-- No Search Results State for Pending Payments -->
                <!-- No Search Results for Pending Payments -->
                @if($peminjamans->count() > 0)
                <div x-show="searchQuery.length > 0 && (selectedTab === 'pending' || selectedTab === 'all')" 
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 scale-95"
                     x-transition:enter-end="opacity-100 scale-100"
                     x-data="{ 
                         get hasVisiblePendingCards() {
                             let visibleCount = 0;
                             @foreach($peminjamans as $index => $peminjaman)
                             const card{{ $index }} = document.querySelector('[x-data*=&quot;paymentId: {{ $peminjaman->id }}&quot;]');
                             if (card{{ $index }} && window.getComputedStyle(card{{ $index }}).display !== 'none') {
                                 visibleCount++;
                             }
                             @endforeach
                             return visibleCount > 0;
                         }
                     }"
                     x-show="!hasVisiblePendingCards"
                     class="col-span-full">
                    <div class="text-center py-12">
                        <div class="mx-auto w-20 h-20 bg-gradient-to-br from-amber-100 to-orange-100 rounded-full flex items-center justify-center mb-4">
                            <i class="fas fa-search text-2xl text-amber-500"></i>
                        </div>
                        <h4 class="text-xl font-bold text-gray-900 mb-2">Tidak Ada Pembayaran Menunggu</h4>
                        <p class="text-gray-600 mb-4 max-w-sm mx-auto">
                            Tidak ada pembayaran menunggu yang cocok dengan "<span class="font-semibold text-amber-600" x-text="searchQuery"></span>".
                        </p>
                        <button @click="searchQuery = ''" 
                                class="inline-flex items-center px-4 py-2 text-amber-600 hover:text-amber-700 transition-colors">
                            <i class="fas fa-undo mr-2"></i>
                            Reset Pencarian
                        </button>
                    </div>
                </div>
                @endif
            </div>
        </div>
        @endif

        <!-- Payment History Section -->
        <div x-show="selectedTab === 'completed' || selectedTab === 'all'" class="mb-10">
            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-purple-600 rounded-xl flex items-center justify-center mr-4">
                        <i class="fas fa-history text-white text-xl"></i>
                    </div>
                    <div>
                        <h3 class="text-2xl font-bold text-gray-900">Riwayat Pembayaran</h3>
                        <p class="text-gray-600">Catatan lengkap semua pembayaran yang telah diproses</p>
                    </div>
                </div>
            </div>
            
            <div class="grid gap-6 lg:grid-cols-2 xl:grid-cols-3">
                @forelse($pembayarans as $pembayaran)
                <div class="payment-card group relative overflow-hidden rounded-3xl bg-white/60 backdrop-blur-lg border border-white/20 shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2"
                     x-data="{ 
                         customerName: '{{ addslashes($pembayaran->peminjaman->nama_peminjam ?? 'N/A') }}',
                         vehicleMerk: '{{ addslashes($pembayaran->peminjaman->armada->merk ?? 'N/A') }}',
                         vehicleNopol: '{{ addslashes($pembayaran->peminjaman->armada->nopol ?? 'N/A') }}',
                         paymentId: '{{ $pembayaran->id }}',
                         paymentStatus: '{{ addslashes($pembayaran->status_pembayaran) }}',
                         paymentDate: '{{ \Carbon\Carbon::parse($pembayaran->tanggal)->format('d M Y') }}',
                         paymentAmount: '{{ number_format($pembayaran->jumlah_bayar, 0, ',', '.') }}'
                     }"
                     x-show="searchQuery === '' || 
                             customerName.toLowerCase().includes(searchQuery.toLowerCase()) ||
                             vehicleMerk.toLowerCase().includes(searchQuery.toLowerCase()) ||
                             vehicleNopol.toLowerCase().includes(searchQuery.toLowerCase()) ||
                             paymentId.includes(searchQuery) ||
                             paymentStatus.toLowerCase().includes(searchQuery.toLowerCase()) ||
                             paymentDate.toLowerCase().includes(searchQuery.toLowerCase()) ||
                             paymentAmount.includes(searchQuery)"
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 scale-95"
                     x-transition:enter-end="opacity-100 scale-100"
                     x-transition:leave="transition ease-in duration-200"
                     x-transition:leave-start="opacity-100 scale-100"
                     x-transition:leave-end="opacity-0 scale-95">
                    <!-- Status Indicator -->
                    <div class="absolute top-4 right-4 z-20">
                        <span class="px-3 py-1.5 text-xs font-bold rounded-full shadow-lg {{ $pembayaran->status_pembayaran == 'Lunas' ? 'bg-green-100 text-green-800 border border-green-200' : 'bg-amber-100 text-amber-800 border border-amber-200' }}"
                              x-html="'<i class=\\'fas fa-' + (paymentStatus === 'Lunas' ? 'check-circle' : 'clock') + ' mr-1\\'></i>' + highlightSearchTerm(paymentStatus, searchQuery)">
                        </span>
                    </div>

                    <!-- Gradient Overlay -->
                    <div class="absolute inset-0 bg-gradient-to-br from-blue-500/10 to-purple-500/10 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    
                    <!-- Card Content -->
                    <div class="relative z-10 p-6">
                        <!-- Header -->
                        <div class="flex items-center mb-4">
                            <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-purple-600 rounded-xl flex items-center justify-center mr-3">
                                <i class="fas fa-receipt text-white"></i>
                            </div>
                            <div class="flex-1">
                                <h4 class="font-bold text-gray-900" 
                                    x-html="'#' + highlightSearchTerm(paymentId, searchQuery)">
                                </h4>
                                <p class="text-sm text-gray-600" 
                                   x-html="highlightSearchTerm(paymentDate, searchQuery)">
                                </p>
                            </div>
                        </div>

                        <!-- Customer Info -->
                        <div class="bg-white/50 backdrop-blur-sm rounded-xl p-4 mb-4">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h5 class="font-semibold text-gray-900" 
                                        x-html="highlightSearchTerm(customerName, searchQuery)">
                                    </h5>
                                    <p class="text-sm text-gray-600" 
                                       x-html="highlightSearchTerm(vehicleMerk, searchQuery)">
                                    </p>
                                    <p class="text-xs text-gray-500" 
                                       x-html="highlightSearchTerm(vehicleNopol, searchQuery)">
                                    </p>
                                </div>
                                <div class="text-right">
                                    <div class="w-10 h-10 bg-gradient-to-br from-gray-100 to-gray-200 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-user text-gray-600"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Payment Amount -->
                        <div class="bg-gradient-to-r from-blue-50 to-purple-50 rounded-xl p-4 mb-6">
                            <div class="flex justify-between items-center">
                                <span class="text-sm font-medium text-gray-600">Jumlah Pembayaran</span>
                                <span class="text-2xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent"
                                      x-html="'Rp ' + highlightSearchTerm(paymentAmount, searchQuery)">
                                </span>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex space-x-2">
                            <a href="{{ route('pembayaran.show', $pembayaran) }}" 
                               class="flex-1 flex items-center justify-center px-4 py-2.5 bg-blue-100 text-blue-700 rounded-xl font-medium hover:bg-blue-200 transition-all duration-200">
                                <i class="fas fa-eye mr-2"></i>
                                Lihat
                            </a>
                            <a href="{{ route('pembayaran.edit', $pembayaran) }}" 
                               class="flex-1 flex items-center justify-center px-4 py-2.5 bg-indigo-100 text-indigo-700 rounded-xl font-medium hover:bg-indigo-200 transition-all duration-200">
                                <i class="fas fa-edit mr-2"></i>
                                Edit
                            </a>
                            <button @click="showDeleteModal = true; paymentToDelete = {{ $pembayaran->id }}" 
                                    class="px-4 py-2.5 bg-red-100 text-red-700 rounded-xl font-medium hover:bg-red-200 transition-all duration-200">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                </div>
                @empty
                <!-- Enhanced Empty State -->
                <div class="col-span-full">
                    <div class="text-center py-16">
                        <div class="mx-auto w-24 h-24 bg-gradient-to-br from-blue-100 to-purple-100 rounded-full flex items-center justify-center mb-6">
                            <i class="fas fa-credit-card text-3xl text-blue-500"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-3">Tidak ada pembayaran ditemukan</h3>
                        <p class="text-gray-600 mb-8 max-w-md mx-auto">Mulai proses pembayaran untuk melihatnya disini. Anda dapat membuat pembayaran dari sewa yang menunggu.</p>
                        <a href="{{ route('pembayaran.create') }}" 
                           class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-2xl font-medium shadow-lg hover:shadow-xl hover:from-blue-700 hover:to-purple-700 transition-all duration-200 transform hover:-translate-y-0.5">
                            <i class="fas fa-plus mr-3"></i>
                            Buat Pembayaran Pertama
                        </a>
                    </div>
                </div>
                @endforelse
                
                <!-- No Search Results State for Payment History -->
                <div x-show="searchQuery.length > 0" 
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 scale-95"
                     x-transition:enter-end="opacity-100 scale-100"
                     x-data="{ 
                         get hasVisiblePaymentCards() {
                             return Array.from(document.querySelectorAll('.payment-card')).some(card => 
                                 !card.style.display || card.style.display !== 'none'
                             );
                         }
                     }"
                     x-show="!hasVisiblePaymentCards"
                     class="col-span-full">
                    <div class="text-center py-16">
                        <div class="mx-auto w-24 h-24 bg-gradient-to-br from-orange-100 to-red-100 rounded-full flex items-center justify-center mb-6">
                            <i class="fas fa-search text-3xl text-orange-500"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-3">Tidak Ada Hasil Ditemukan</h3>
                        <p class="text-gray-600 mb-6 max-w-md mx-auto">
                            Tidak ada pembayaran yang ditemukan dengan "<span class="font-semibold text-orange-600" x-text="searchQuery"></span>". 
                            Coba kata kunci yang berbeda atau buat pembayaran baru.
                        </p>
                        <div class="flex flex-col sm:flex-row gap-3 justify-center">
                            <button @click="searchQuery = ''" 
                                    class="inline-flex items-center px-6 py-3 border border-gray-300 text-gray-700 rounded-xl font-medium hover:bg-gray-50 transition-all duration-200">
                                <i class="fas fa-undo mr-2"></i>
                                Reset Pencarian
                            </button>
                            <a href="{{ route('pembayaran.create') }}" 
                               class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-xl font-medium shadow-lg hover:shadow-xl transition-all duration-200 transform hover:scale-105">
                                <i class="fas fa-plus mr-2"></i>
                                Tambah Pembayaran Baru
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Enhanced Pagination -->
        @if($pembayarans->hasPages())
        <div class="flex justify-center">
            <div class="bg-white/60 backdrop-blur-lg rounded-2xl shadow-lg ring-1 ring-white/20 p-2">
                {{ $pembayarans->appends(request()->query())->links() }}
            </div>
        </div>
        @endif
    </div>
</div>

@push('styles')
<style>
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

    /* Enhanced animations */
    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-10px); }
    }
    
    .animate-float {
        animation: float 6s ease-in-out infinite;
    }

    /* Glassmorphism effects */
    .backdrop-blur-xl {
        backdrop-filter: blur(20px);
    }
    
    .backdrop-blur-lg {
        backdrop-filter: blur(16px);
    }
    
    .backdrop-blur-sm {
        backdrop-filter: blur(8px);
    }

    /* Gradient text animation */
    @keyframes gradient-x {
        0%, 100% {
            background-size: 200% 200%;
            background-position: left center;
        }
        50% {
            background-size: 200% 200%;
            background-position: right center;
        }
    }
    
    .animate-gradient-x {
        animation: gradient-x 15s ease infinite;
    }

    /* Card hover effects */
    .card-hover:hover {
        transform: translateY(-8px) scale(1.02);
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
    }

    /* Custom tab styles */
    .tab-active {
        background: linear-gradient(135deg, rgba(59, 130, 246, 0.1), rgba(147, 51, 234, 0.1));
        border: 1px solid rgba(59, 130, 246, 0.2);
    }

    /* Loading animation */
    @keyframes pulse-slow {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.8; }
    }
    
    .animate-pulse-slow {
        animation: pulse-slow 3s ease-in-out infinite;
    }

    /* Status indicator animations */
    .status-indicator {
        position: relative;
        overflow: hidden;
    }
    
    .status-indicator::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
        transition: left 0.5s;
    }
    
    .status-indicator:hover::before {
        left: 100%;
    }
</style>
@endpush

@push('scripts')
<script>
    // Function to highlight search terms in text
    function highlightSearchTerm(text, searchTerm) {
        if (!searchTerm || searchTerm.length === 0) {
            return text;
        }
        
        const regex = new RegExp(`(${searchTerm.replace(/[.*+?^${}()|[\]\\]/g, '\\$&')})`, 'gi');
        return text.replace(regex, '<span class="bg-yellow-200 text-yellow-800 px-1 rounded font-semibold">$1</span>');
    }

    document.addEventListener('alpine:init', () => {
        Alpine.data('paymentManager', () => ({
            searchTimeout: null,
            performSearch() {
                clearTimeout(this.searchTimeout);
                this.searchTimeout = setTimeout(() => {
                    // Implement search functionality
                    console.log('Searching for:', this.searchQuery);
                }, 500);
            },
            filterByStatus() {
                // Implement status filtering
                console.log('Filtering by status:', this.filterStatus);
            }
        }));
    });

    // Enhanced loading states
    document.addEventListener('DOMContentLoaded', function() {
        // Make highlightSearchTerm globally available for Alpine.js
        window.highlightSearchTerm = highlightSearchTerm;
        
        // Add smooth transitions for all interactive elements
        const cards = document.querySelectorAll('.group');
        cards.forEach((card, index) => {
            card.style.animationDelay = `${index * 0.1}s`;
            card.classList.add('animate-fade-in');
        });

        // Auto-hide notifications
        const notifications = document.querySelectorAll('[x-data*="show: true"]');
        notifications.forEach(notification => {
            setTimeout(() => {
                notification.style.opacity = '0';
                notification.style.transform = 'translateX(100%)';
                setTimeout(() => notification.remove(), 300);
            }, 5000);
        });
    });
</script>
@endpush
@endsection