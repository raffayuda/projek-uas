@extends('dashboard.layout.index')
@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50 py-8">
    <div class="max-w-4xl mx-auto px-4">
        <!-- Header Section -->
        <div class="bg-white shadow-xl rounded-2xl overflow-hidden mb-6">
            <div class="bg-gradient-to-r from-indigo-600 to-purple-600 px-8 py-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-2xl font-bold text-white mb-2">Detail Pembayaran</h1>
                        <p class="text-indigo-100">Informasi lengkap transaksi pembayaran</p>
                    </div>
                    <div class="bg-white/20 backdrop-blur-sm rounded-lg p-4">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Payment Info Card -->
            <div class="lg:col-span-2 bg-white shadow-lg rounded-2xl p-8">
                <h3 class="text-lg font-semibold text-gray-800 mb-6 flex items-center">
                    <span class="bg-indigo-100 p-2 rounded-lg mr-3">
                        <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </span>
                    Informasi Pembayaran
                </h3>

                <div class="space-y-6">
                    <!-- Date -->
                    <div class="flex items-center p-4 bg-gray-50 rounded-xl">
                        <div class="bg-blue-100 p-3 rounded-lg mr-4">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 font-medium">Tanggal Pembayaran</p>
                            <p class="text-lg font-semibold text-gray-800">{{ \Carbon\Carbon::parse($pembayaran->tanggal)->format('d M Y') }}</p>
                        </div>
                    </div>

                    <!-- Borrower -->
                    <div class="flex items-center p-4 bg-gray-50 rounded-xl">
                        <div class="bg-green-100 p-3 rounded-lg mr-4">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 font-medium">Nama Peminjam</p>
                            <p class="text-lg font-semibold text-gray-800">{{ $pembayaran->peminjaman->nama_peminjam ?? '-' }}</p>
                        </div>
                    </div>

                    <!-- Payment Method -->
                    <div class="flex items-center p-4 bg-gray-50 rounded-xl">
                        <div class="bg-purple-100 p-3 rounded-lg mr-4">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 font-medium">Metode Pembayaran</p>
                            <p class="text-lg font-semibold text-gray-800">{{ $pembayaran->metode_pembayaran }}</p>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="p-4 bg-gray-50 rounded-xl">
                        <div class="flex items-start">
                            <div class="bg-gray-100 p-3 rounded-lg mr-4">
                                <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm text-gray-500 font-medium mb-2">Keterangan</p>
                                <p class="text-gray-800 leading-relaxed">{{ $pembayaran->keterangan ?? 'Tidak ada keterangan tambahan' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Amount & Status Card -->
            <div class="space-y-6">
                <!-- Amount Card -->
                <div class="bg-gradient-to-br from-green-500 to-green-600 shadow-lg rounded-2xl p-6 text-white">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold">Jumlah Bayar</h3>
                        <div class="bg-white/20 p-2 rounded-lg">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                            </svg>
                        </div>
                    </div>
                    <p class="text-3xl font-bold mb-2">Rp {{ number_format($pembayaran->jumlah_bayar, 0, ',', '.') }}</p>
                    <p class="text-green-100">Total pembayaran</p>
                </div>

                <!-- Status Card -->
                <div class="bg-white shadow-lg rounded-2xl p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Status Pembayaran</h3>
                    <div class="text-center">
                        <div class="inline-flex items-center px-6 py-3 rounded-full text-sm font-bold mb-4
                            {{ $pembayaran->status_pembayaran == 'Lunas' ? 'bg-green-100 text-green-800 border-2 border-green-200' : 'bg-yellow-100 text-yellow-800 border-2 border-yellow-200' }}">
                            @if($pembayaran->status_pembayaran == 'Lunas')
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            @else
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            @endif
                            {{ $pembayaran->status_pembayaran }}
                        </div>
                        <p class="text-sm text-gray-600">
                            {{ $pembayaran->status_pembayaran == 'Lunas' ? 'Pembayaran telah diselesaikan' : 'Pembayaran dalam proses' }}
                        </p>
                    </div>
                </div>

                <!-- Action Button -->
                <div class="bg-white shadow-lg rounded-2xl p-6">
                    <a href="{{ route('pembayaran.index') }}" 
                       class="w-full bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 
                              text-white font-bold py-3 px-6 rounded-xl transition duration-300 transform hover:scale-105 
                              flex items-center justify-center shadow-lg">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Kembali ke Daftar
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection