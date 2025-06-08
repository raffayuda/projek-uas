@extends('layouts.index')

@section('content')
<div class="booking-header">
    <div class="hero-pattern"></div>
    <img src="https://images.unsplash.com/photo-1503376780353-7e6692767b70?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80" 
         alt="Booking Saya" 
         class="hero-car">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative w-full">
        <div class="hero-content text-center">
            <div class="hero-badge" data-aos="fade-up">
                <i class="fas fa-bookmark"></i>
                <span class="text-white">Riwayat Booking Saya</span>
            </div>
            <h1 class="text-5xl font-extrabold text-white sm:text-6xl lg:text-7xl mb-8" data-aos="fade-up" data-aos-delay="100">
                Kelola <span class="gradient-text">Booking</span> Anda
            </h1>
            <p class="text-2xl text-gray-200 max-w-3xl mx-auto mb-12" data-aos="fade-up" data-aos-delay="200">
                Lihat dan kelola semua booking rental mobil Anda dalam satu tempat.
                Lacak status, pembayaran dan detail booking dengan mudah.
            </p>
            <div class="hero-stats" data-aos="fade-up" data-aos-delay="300">
                <div class="stat-card">
                    <div class="stat-number">Aktif</div>
                    <div class="stat-label">Lihat Status</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">Riwayat</div>
                    <div class="stat-label">Rental Terdahulu</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">Pembayaran</div>
                    <div class="stat-label">Lacak Pembayaran</div>
                </div>
            </div>
        </div>
    </div>
    <!-- Scroll Indicator -->
    <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 animate-bounce" data-aos="fade-up" data-aos-delay="1000">
        <i class="fas fa-chevron-down text-white text-2xl"></i>
    </div>
</div>

<!-- Alpine.js data for modal management -->
<div x-data="{ 
    openModal: '', 
    showCancelConfirm: false, 
    bookingToCancel: null,
    openDetailModal(bookingId) {
        this.openModal = 'booking-' + bookingId;
    },
    closeModal() {
        this.openModal = '';
    },
    showCancelModal(bookingId) {
        this.bookingToCancel = bookingId;
        this.showCancelConfirm = true;
    },
    hideCancelModal() {
        this.showCancelConfirm = false;
        this.bookingToCancel = null;
    },
    confirmCancel() {
        if (this.bookingToCancel) {
            document.getElementById('cancel-form-' + this.bookingToCancel).submit();
        }
    }
}">

<div class="container mx-auto px-4 py-12">
    <div class="max-w-7xl mx-auto">
        <!-- Header Section -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8">
            <div>
                <h2 class="text-2xl md:text-3xl font-bold text-gray-800">Booking Saya</h2>
                <p class="text-gray-600 mt-2">Reservasi aktif dan riwayat Anda</p>
            </div>
            <div class="mt-4 md:mt-0">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-red-600 to-red-400 rounded-lg font-semibold text-white hover:from-red-700 hover:to-red-700 transition-all shadow-lg">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v2a2 2 0 01-2 2H9a2 2 0 01-2-2v-2"/>
                        </svg>
                        Keluar
                    </button>
                </form>
            </div>
        </div>

        <!-- Success Message -->
        @if(session('success'))
        <div x-data="{ show: true }" x-show="show" x-transition class="bg-green-50 border-l-4 border-green-400 p-4 mb-8 rounded-lg shadow-sm">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <svg class="h-5 w-5 text-green-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    <p class="text-green-700">{{ session('success') }}</p>
                </div>
                <button @click="show = false" class="text-green-500 hover:text-green-700">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
        @endif

        <!-- Booking Cards -->
        <div class="grid grid-cols-1 gap-6">
            @forelse($bookings as $booking)
            <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                <div class="md:flex">
                    <!-- Vehicle Image -->
                    <div class="md:w-1/4">                        @if($booking->armada->gambar)
                        <img class="h-full w-full object-cover" src="{{ asset('storage/armada-images/' . $booking->armada->gambar) }}" alt="{{ $booking->armada->merk }}">
                        @else
                        <div class="h-full bg-gray-100 flex items-center justify-center">
                            <svg class="h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/>
                            </svg>
                        </div>
                        @endif
                    </div>

                    <!-- Booking Details -->
                    <div class="p-6 md:w-2/4">
                        <div class="flex items-center justify-between">
                            <h3 class="text-xl font-bold text-gray-800">{{ $booking->armada->merk }}</h3>
                            <span class="px-3 py-1 text-xs font-semibold rounded-full 
                                {{ $booking->status_pinjam === 'Pending' ? 'bg-yellow-100 text-yellow-800' : 
                                   ($booking->status_pinjam === 'Approved' ? 'bg-green-100 text-green-800' : 
                                   ($booking->status_pinjam === 'Rejected' ? 'bg-red-100 text-red-800' : 'bg-gray-100 text-gray-800')) }}">
                                {{ $booking->status_pinjam }}
                            </span>
                        </div>
                        
                        <div class="mt-2 text-sm text-gray-600">{{ $booking->armada->jenisKendaraan->nama }} • {{ $booking->armada->nopol }}</div>
                        
                        <div class="mt-4 grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-xs font-semibold text-gray-500 uppercase">Pengambilan</p>
                                <p class="text-sm font-medium">{{ \Carbon\Carbon::parse($booking->mulai)->format('M d, Y') }}</p>
                                <p class="text-xs text-gray-500">{{ $booking->lokasiPengambilan->nama ?? 'Tidak tersedia' }}</p>
                            </div>
                            <div>
                                <p class="text-xs font-semibold text-gray-500 uppercase">Pengembalian</p>
                                <p class="text-sm font-medium">{{ \Carbon\Carbon::parse($booking->selesai)->format('M d, Y') }}</p>
                                <p class="text-xs text-gray-500">{{ $booking->lokasiPengembalian->nama ?? 'Tidak tersedia' }}</p>
                            </div>
                        </div>
                        
                        <div class="mt-4">
                            <p class="text-xs font-semibold text-gray-500 uppercase">Keperluan</p>
                            <p class="text-sm">{{ $booking->keperluan_pinjam }}</p>
                        </div>
                    </div>

                    <!-- Payment & Actions -->
                    <div class="p-6 md:w-1/4 border-t md:border-t-0 md:border-l border-gray-200 bg-gray-50">
                        <div class="flex flex-col h-full justify-between">
                            <div>
                                <p class="text-xs font-semibold text-gray-500 uppercase">Total Biaya</p>
                                <p class="text-xl font-bold text-gray-800">Rp {{ number_format($booking->biaya, 0, ',', '.') }}</p>
                                
                                @if($booking->pembayaran)
                                <div class="mt-2">
                                    <p class="text-xs font-semibold text-gray-500 uppercase">Status Pembayaran</p>
                                    <span class="text-xs font-semibold px-2 py-1 rounded-full bg-green-100 text-green-800">
                                        Sudah Dibayar
                                    </span>
                                </div>
                                @else
                                <div class="mt-2">
                                    <p class="text-xs font-semibold text-gray-500 uppercase">Status Pembayaran</p>
                                    <span class="text-xs font-semibold px-2 py-1 rounded-full bg-red-100 text-red-800">
                                        Belum Dibayar
                                    </span>
                                </div>
                                @endif
                            </div>
                            
                            <div class="mt-4 space-y-2">
                                <button @click="openDetailModal({{ $booking->id }})"
                                        class="w-full flex items-center justify-center px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-100 transition-colors">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                    Lihat Detail
                                </button>
                                
                                @if($booking->status_pinjam === 'Pending')
                                <form id="cancel-form-{{ $booking->id }}" action="{{ route('bookings.cancel', $booking->id) }}" method="POST" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                                <button type="button" @click="showCancelModal({{ $booking->id }})"
                                        class="w-full flex items-center justify-center px-4 py-2 border border-transparent rounded-lg text-sm font-medium text-white bg-red-600 hover:bg-red-700 transition-colors">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                    Batalkan Booking
                                </button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="bg-white rounded-xl shadow-md overflow-hidden text-center py-16">
                <svg class="mx-auto h-16 w-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <h3 class="mt-4 text-lg font-medium text-gray-900">Tidak ada booking yang ditemukan</h3>
                <p class="mt-1 text-sm text-gray-500">Anda belum melakukan booking apapun.</p>
                <div class="mt-6">
                    <a href="{{ url('vehicles.index') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700">
                        Lihat Kendaraan yang Tersedia
                    </a>
                </div>
            </div>
            @endforelse
        </div>

        <!-- Booking Details Modal -->
        @foreach($bookings as $booking)
        <div x-show="openModal === 'booking-{{ $booking->id }}'" 
             x-transition:enter="ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 z-50 overflow-y-auto" 
             style="display: none;">
            <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <!-- Overlay -->
                <div class="fixed inset-0 transition-opacity" aria-hidden="true" @click="closeModal()">
                    <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                </div>

                <!-- Modal Content -->
                <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full">
                    <div class="bg-white px-6 py-5">
                        <div class="flex items-start justify-between">
                            <div>
                                <h3 class="text-2xl font-bold text-gray-900">Booking #{{ $booking->id }}</h3>
                                <p class="text-sm text-gray-500">{{ $booking->created_at->format('M d, Y') }}</p>
                            </div>
                            <button @click="closeModal()" class="text-gray-400 hover:text-gray-500">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                        </div>

                        <!-- Vehicle Section -->
                        <div class="mt-6 flex items-start">                            @if($booking->armada->gambar)
                            <img class="h-24 w-24 rounded-lg object-cover mr-4" src="{{ asset('storage/armada-images/' . $booking->armada->gambar) }}" alt="{{ $booking->armada->merk }}">
                            @endif
                            <div>
                                <h4 class="text-lg font-bold text-gray-900">{{ $booking->armada->merk }}</h4>
                                <p class="text-sm text-gray-600">{{ $booking->armada->jenisKendaraan->nama }} • {{ $booking->armada->nopol }}</p>
                                <div class="mt-2">
                                    <span class="px-3 py-1 text-xs font-semibold rounded-full 
                                        {{ $booking->status_pinjam === 'Pending' ? 'bg-yellow-100 text-yellow-800' : 
                                           ($booking->status_pinjam === 'Approved' ? 'bg-green-100 text-green-800' : 
                                           ($booking->status_pinjam === 'Rejected' ? 'bg-red-100 text-red-800' : 'bg-gray-100 text-gray-800')) }}">
                                        {{ $booking->status_pinjam }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Details Grid -->
                        <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Rental Period -->
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <h4 class="text-sm font-semibold text-gray-500 uppercase mb-2">Periode Rental</h4>
                                <div class="flex items-center">
                                    <svg class="flex-shrink-0 h-5 w-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">Dari {{ \Carbon\Carbon::parse($booking->mulai)->format('M d, Y') }}</p>
                                        <p class="text-sm font-medium text-gray-900">Sampai {{ \Carbon\Carbon::parse($booking->selesai)->format('M d, Y') }}</p>
                                        @if($booking->waktu_pengambilan)
                                        <p class="text-xs text-gray-500 mt-1">Waktu pengambilan: {{ $booking->waktu_pengambilan }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- Locations -->
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <h4 class="text-sm font-semibold text-gray-500 uppercase mb-2">Lokasi</h4>
                                <div class="space-y-3">
                                    <div class="flex items-start">
                                        <svg class="flex-shrink-0 h-5 w-5 text-blue-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        </svg>
                                        <div>
                                            <p class="text-sm font-medium text-gray-900">Lokasi Pengambilan</p>
                                            <p class="text-sm text-gray-600">{{ $booking->lokasiPengambilan->nama ?? 'Tidak tersedia' }}</p>
                                        </div>
                                    </div>
                                    <div class="flex items-start">
                                        <svg class="flex-shrink-0 h-5 w-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                        </svg>
                                        <div>
                                            <p class="text-sm font-medium text-gray-900">Lokasi Pengembalian</p>
                                            <p class="text-sm text-gray-600">{{ $booking->lokasiPengembalian->nama ?? 'Tidak tersedia' }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Customer Info -->
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <h4 class="text-sm font-semibold text-gray-500 uppercase mb-2">Penyewa</h4>
                                <div>
                                    <p class="text-sm font-medium text-gray-900">{{ $booking->nama_peminjam }}</p>
                                    <p class="text-sm text-gray-600">{{ $booking->phone }}</p>
                                    <p class="text-sm text-gray-600 mt-2">{{ $booking->keperluan_pinjam }}</p>
                                </div>
                            </div>

                            <!-- Payment Info -->
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <h4 class="text-sm font-semibold text-gray-500 uppercase mb-2">Pembayaran</h4>
                                <div>
                                    <p class="text-2xl font-bold text-gray-900">Rp {{ number_format($booking->biaya, 0, ',', '.') }}</p>
                                    @if($booking->pembayaran)
                                    <div class="mt-2">
                                        <span class="px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                            Sudah Dibayar
                                        </span>
                                    </div>
                                    @else
                                    <div class="mt-2">
                                        <span class="px-3 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                            Belum Dibayar
                                        </span>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="mt-6 pt-6 border-t border-gray-200 flex justify-end">
                            @if($booking->status_pinjam === 'Pending')
                            <button type="button" @click="closeModal(); showCancelModal({{ $booking->id }})"
                                class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-red-600 hover:bg-red-700 mr-3">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                                Batalkan Booking
                            </button>
                            @endif
                            <button @click="closeModal()"
                                    class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md shadow-sm text-gray-700 bg-white hover:bg-gray-50">
                                Tutup
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach

        <!-- Cancel Confirmation Modal -->
        <div x-show="showCancelConfirm" 
             x-transition:enter="ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 z-50 overflow-y-auto" 
             style="display: none;">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <!-- Overlay -->
                <div class="fixed inset-0 transition-opacity" aria-hidden="true" @click="hideCancelModal()">
                    <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                </div>

                <!-- Modal Content -->
                <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                                <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16c-.77.833.192 2.5 1.732 2.5z"/>
                                </svg>
                            </div>
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                <h3 class="text-lg leading-6 font-medium text-gray-900">Batalkan Booking</h3>
                                <div class="mt-2">
                                    <p class="text-sm text-gray-500">
                                        Apakah Anda yakin ingin membatalkan booking ini? Tindakan ini tidak dapat dibatalkan dan Anda mungkin dikenakan biaya pembatalan.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button type="button" @click="confirmCancel()"
                                class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                            Ya, Batalkan Booking
                        </button>
                        <button type="button" @click="hideCancelModal()"
                                class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                            Tetap Booking
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

</div> <!-- End of Alpine.js wrapper -->
@endsection