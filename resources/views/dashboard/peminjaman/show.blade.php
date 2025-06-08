@push('styles')
<link rel="stylesheet" href="{{ asset('css/peminjaman-modern.css') }}">
@endpush

@extends('dashboard.layout.index')
@section('content')
    <!-- Background with gradient -->
    <div class="min-h-screen bg-gradient-to-br from-indigo-50 via-white to-purple-50 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header Section with Glass Effect -->
            <div class="relative mb-8">
                <div class="absolute inset-0 bg-gradient-to-r from-purple-600 to-blue-600 rounded-3xl opacity-10"></div>
                <div class="relative bg-white/70 backdrop-blur-lg border border-white/20 rounded-3xl p-8 shadow-xl">
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                        <div>
                            <h1 class="text-4xl font-bold bg-gradient-to-r from-purple-600 to-blue-600 bg-clip-text text-transparent">
                                Detail Peminjaman
                            </h1>
                            <p class="text-gray-600 mt-2">Informasi lengkap peminjaman armada</p>
                        </div>
                        <div class="flex space-x-4">
                            <a href="{{ route('peminjaman.edit', $peminjaman) }}" 
                               class="bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white font-semibold py-3 px-6 rounded-2xl transition-all duration-300 transform hover:scale-105 hover:shadow-lg flex items-center space-x-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                                <span>Edit</span>
                            </a>
                            <a href="{{ route('peminjaman.index') }}" 
                               class="bg-gradient-to-r from-gray-500 to-gray-600 hover:from-gray-600 hover:to-gray-700 text-white font-semibold py-3 px-6 rounded-2xl transition-all duration-300 transform hover:scale-105 hover:shadow-lg flex items-center space-x-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                </svg>
                                <span>Kembali</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>            <!-- Main Content with Enhanced Design -->
            <div class="bg-white/60 backdrop-blur-md border border-white/30 rounded-3xl shadow-xl overflow-hidden relative">
                <!-- Animated Background Pattern -->
                <div class="absolute inset-0 opacity-5">
                    <div class="absolute inset-0 bg-gradient-to-r from-blue-400 via-purple-500 to-pink-500 animate-pulse"></div>
                </div>
                
                <!-- Progress Bar -->
                <div class="h-1 bg-gradient-to-r from-blue-500 via-purple-500 to-pink-500"></div>
                
                <div class="p-8 relative z-10">
                    <!-- Status Badge -->
                    <div class="flex justify-center mb-8">
                        <div class="status-badge-large 
                            {{ $peminjaman->status_pinjam == 'Pending' ? 'bg-gradient-to-r from-yellow-400 to-yellow-500 text-yellow-900' : '' }}
                            {{ $peminjaman->status_pinjam == 'Dipinjam' ? 'bg-gradient-to-r from-blue-400 to-blue-500 text-blue-900' : '' }}
                            {{ $peminjaman->status_pinjam == 'Selesai' ? 'bg-gradient-to-r from-green-400 to-green-500 text-green-900' : '' }}
                            {{ $peminjaman->status_pinjam == 'Dibatalkan' ? 'bg-gradient-to-r from-red-400 to-red-500 text-red-900' : '' }}
                            px-8 py-4 rounded-2xl shadow-lg backdrop-blur-sm border border-white/30">
                            <div class="flex items-center space-x-3">
                                <div class="w-3 h-3 rounded-full bg-current animate-pulse"></div>
                                <span class="text-lg font-bold">{{ $peminjaman->status_pinjam }}</span>
                                <div class="w-3 h-3 rounded-full bg-current animate-pulse"></div>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 xl:grid-cols-2 gap-8">
                        <!-- Data Peminjam Section -->
                        <div class="bg-gradient-to-br from-blue-50/70 to-indigo-50/70 backdrop-blur-sm rounded-3xl p-8 border border-blue-200/30 shadow-lg">
                            <div class="flex items-center mb-6">
                                <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center mr-4 shadow-lg">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-2xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">Data Peminjam</h3>
                                    <p class="text-sm text-gray-600">Informasi identitas peminjam</p>
                                </div>
                            </div>
                            
                            <div class="space-y-6">
                                <div class="bg-white/70 backdrop-blur-sm rounded-2xl p-6 shadow-inner">
                                    <label class="text-sm font-semibold text-gray-600 uppercase tracking-wide flex items-center mb-2">
                                        <svg class="w-4 h-4 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                        Nama Lengkap
                                    </label>
                                    <p class="text-lg font-semibold text-gray-900">{{ $peminjaman->nama_peminjam }}</p>
                                </div>

                                <div class="bg-white/70 backdrop-blur-sm rounded-2xl p-6 shadow-inner">
                                    <label class="text-sm font-semibold text-gray-600 uppercase tracking-wide flex items-center mb-2">
                                        <svg class="w-4 h-4 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                        </svg>
                                        Nomor Telepon
                                    </label>
                                    <p class="text-lg font-semibold text-gray-900">{{ $peminjaman->phone }}</p>
                                </div>

                                <div class="bg-white/70 backdrop-blur-sm rounded-2xl p-6 shadow-inner">
                                    <label class="text-sm font-semibold text-gray-600 uppercase tracking-wide flex items-center mb-4">
                                        <svg class="w-4 h-4 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4V2a1 1 0 011-1h8a1 1 0 011 1v2h4a1 1 0 011 1v4a1 1 0 01-1 1h-4v10a1 1 0 01-1 1H8a1 1 0 01-1-1V10H3a1 1 0 01-1-1V5a1 1 0 011-1h4z"></path>
                                        </svg>
                                        Foto KTP
                                    </label>
                                    <div class="relative group">
                                        <img src="{{ Storage::url('uploads/ktp/' . $peminjaman->ktp_peminjam) }}" 
                                             alt="KTP" 
                                             class="h-48 w-auto rounded-xl shadow-lg transition-transform duration-300 group-hover:scale-105 border-4 border-white">
                                        <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent rounded-xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                    </div>
                                </div>
                            </div>
                        </div>                        <!-- Detail Peminjaman Section -->
                        <div class="bg-gradient-to-br from-purple-50/70 to-pink-50/70 backdrop-blur-sm rounded-3xl p-8 border border-purple-200/30 shadow-lg">
                            <div class="flex items-center mb-6">
                                <div class="w-12 h-12 bg-gradient-to-r from-purple-500 to-pink-600 rounded-xl flex items-center justify-center mr-4 shadow-lg">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-2xl font-bold bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent">Detail Peminjaman</h3>
                                    <p class="text-sm text-gray-600">Informasi lengkap peminjaman</p>
                                </div>
                            </div>
                            
                            <div class="space-y-6">
                                <div class="bg-white/70 backdrop-blur-sm rounded-2xl p-6 shadow-inner">
                                    <label class="text-sm font-semibold text-gray-600 uppercase tracking-wide flex items-center mb-2">
                                        <svg class="w-4 h-4 mr-2 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        Armada
                                    </label>
                                    <p class="text-lg font-semibold text-gray-900">
                                        {{ $peminjaman->armada->merk }} - {{ $peminjaman->armada->nopol }}
                                    </p>
                                </div>

                                <div class="grid grid-cols-2 gap-4">
                                    <div class="bg-white/70 backdrop-blur-sm rounded-2xl p-6 shadow-inner">
                                        <label class="text-sm font-semibold text-gray-600 uppercase tracking-wide flex items-center mb-2">
                                            <svg class="w-4 h-4 mr-2 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a1 1 0 011-1h6a1 1 0 011 1v4m-6 4V7m0 0h6"></path>
                                            </svg>
                                            Tanggal Mulai
                                        </label>
                                        <p class="text-lg font-semibold text-gray-900">
                                            {{ $peminjaman->mulai->format('d-M-Y') }}
                                        </p>
                                    </div>

                                    <div class="bg-white/70 backdrop-blur-sm rounded-2xl p-6 shadow-inner">
                                        <label class="text-sm font-semibold text-gray-600 uppercase tracking-wide flex items-center mb-2">
                                            <svg class="w-4 h-4 mr-2 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a1 1 0 011-1h6a1 1 0 011 1v4m-6 4V7m0 0h6"></path>
                                            </svg>
                                            Tanggal Selesai
                                        </label>
                                        <p class="text-lg font-semibold text-gray-900">
                                            {{ $peminjaman->selesai->format('d-M-Y') }}
                                        </p>
                                    </div>
                                </div>

                                <div class="grid grid-cols-2 gap-4">
                                    <div class="bg-white/70 backdrop-blur-sm rounded-2xl p-6 shadow-inner">
                                        <label class="text-sm font-semibold text-gray-600 uppercase tracking-wide flex items-center mb-2">
                                            <svg class="w-4 h-4 mr-2 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            </svg>
                                            Lokasi Pengambilan
                                        </label>
                                        <p class="text-lg font-semibold text-gray-900">
                                            {{ $peminjaman->pengambilan->nama }}
                                        </p>
                                    </div>

                                    <div class="bg-white/70 backdrop-blur-sm rounded-2xl p-6 shadow-inner">
                                        <label class="text-sm font-semibold text-gray-600 uppercase tracking-wide flex items-center mb-2">
                                            <svg class="w-4 h-4 mr-2 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            </svg>
                                            Lokasi Pengembalian
                                        </label>
                                        <p class="text-lg font-semibold text-gray-900">
                                            {{ $peminjaman->pengembalian->nama }}
                                        </p>
                                    </div>
                                </div>

                                <div class="grid grid-cols-2 gap-4">
                                    <div class="bg-white/70 backdrop-blur-sm rounded-2xl p-6 shadow-inner">
                                        <label class="text-sm font-semibold text-gray-600 uppercase tracking-wide flex items-center mb-2">
                                            <svg class="w-4 h-4 mr-2 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            Waktu Pengambilan
                                        </label>
                                        <p class="text-lg font-semibold text-gray-900">
                                            {{ $peminjaman->waktu_pengambilan }}
                                        </p>
                                    </div>

                                    <div class="bg-white/70 backdrop-blur-sm rounded-2xl p-6 shadow-inner">
                                        <label class="text-sm font-semibold text-gray-600 uppercase tracking-wide flex items-center mb-2">
                                            <svg class="w-4 h-4 mr-2 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            Waktu Pengembalian
                                        </label>
                                        <p class="text-lg font-semibold text-gray-900">
                                            {{ $peminjaman->waktu_pengembalian }}
                                        </p>
                                    </div>
                                </div>

                                <div class="bg-white/70 backdrop-blur-sm rounded-2xl p-6 shadow-inner">
                                    <label class="text-sm font-semibold text-gray-600 uppercase tracking-wide flex items-center mb-2">
                                        <svg class="w-4 h-4 mr-2 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                        </svg>
                                        Keperluan Peminjaman
                                    </label>
                                    <p class="text-lg text-gray-900 leading-relaxed">
                                        {{ $peminjaman->keperluan_pinjam }}
                                    </p>
                                </div>

                                <!-- Total Biaya with Special Highlight -->
                                <div class="bg-gradient-to-r from-green-50 to-blue-50 backdrop-blur-sm rounded-2xl p-6 shadow-inner border-2 border-green-200/50">
                                    <label class="text-sm font-semibold text-gray-600 uppercase tracking-wide flex items-center mb-2">
                                        <svg class="w-4 h-4 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                        </svg>
                                        Total Biaya
                                    </label>
                                    <p class="text-3xl font-bold bg-gradient-to-r from-green-600 to-blue-600 bg-clip-text text-transparent">
                                        Rp {{ number_format($peminjaman->biaya, 0, ',', '.') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>                    <!-- Pembayaran Section -->
                    @if($peminjaman->pembayaran)
                    <div class="mt-8 bg-gradient-to-br from-emerald-50/70 to-teal-50/70 backdrop-blur-sm rounded-3xl p-8 border border-emerald-200/30 shadow-lg">
                        <div class="flex items-center mb-6">
                            <div class="w-12 h-12 bg-gradient-to-r from-emerald-500 to-teal-600 rounded-xl flex items-center justify-center mr-4 shadow-lg">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-2xl font-bold bg-gradient-to-r from-emerald-600 to-teal-600 bg-clip-text text-transparent">Detail Pembayaran</h3>
                                <p class="text-sm text-gray-600">Informasi transaksi pembayaran</p>
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            <div class="bg-white/70 backdrop-blur-sm rounded-2xl p-6 shadow-inner">
                                <label class="text-sm font-semibold text-gray-600 uppercase tracking-wide flex items-center mb-2">
                                    <svg class="w-4 h-4 mr-2 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a1 1 0 011-1h6a1 1 0 011 1v4m-6 4V7m0 0h6"></path>
                                    </svg>
                                    Tanggal Pembayaran
                                </label>
                                <p class="text-lg font-semibold text-gray-900">
                                    {{ $peminjaman->pembayaran->tanggal }}
                                </p>
                            </div>

                            <div class="bg-white/70 backdrop-blur-sm rounded-2xl p-6 shadow-inner">
                                <label class="text-sm font-semibold text-gray-600 uppercase tracking-wide flex items-center mb-2">
                                    <svg class="w-4 h-4 mr-2 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                    </svg>
                                    Jumlah Bayar
                                </label>
                                <p class="text-lg font-semibold text-gray-900">
                                    Rp {{ number_format($peminjaman->pembayaran->jumlah_bayar, 0, ',', '.') }}
                                </p>
                            </div>

                            <div class="bg-white/70 backdrop-blur-sm rounded-2xl p-6 shadow-inner">
                                <label class="text-sm font-semibold text-gray-600 uppercase tracking-wide flex items-center mb-2">
                                    <svg class="w-4 h-4 mr-2 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Status Pembayaran
                                </label>
                                <span class="inline-flex px-4 py-2 text-sm font-bold rounded-xl
                                    {{ $peminjaman->pembayaran->status_pembayaran == 'Lunas' ? 'bg-gradient-to-r from-green-100 to-green-200 text-green-800 border border-green-300' : '' }}
                                    {{ $peminjaman->pembayaran->status_pembayaran == 'Belum Lunas' ? 'bg-gradient-to-r from-yellow-100 to-yellow-200 text-yellow-800 border border-yellow-300' : '' }}">
                                    {{ $peminjaman->pembayaran->status_pembayaran }}
                                </span>
                            </div>

                            <div class="bg-white/70 backdrop-blur-sm rounded-2xl p-6 shadow-inner">
                                <label class="text-sm font-semibold text-gray-600 uppercase tracking-wide flex items-center mb-2">
                                    <svg class="w-4 h-4 mr-2 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                                    </svg>
                                    Metode Pembayaran
                                </label>
                                <p class="text-lg font-semibold text-gray-900">
                                    {{ $peminjaman->pembayaran->metode_pembayaran }}
                                </p>
                            </div>

                            <div class="bg-white/70 backdrop-blur-sm rounded-2xl p-6 shadow-inner md:col-span-2">
                                <label class="text-sm font-semibold text-gray-600 uppercase tracking-wide flex items-center mb-2">
                                    <svg class="w-4 h-4 mr-2 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path>
                                    </svg>
                                    Keterangan
                                </label>
                                <p class="text-lg text-gray-900 leading-relaxed">
                                    {{ $peminjaman->pembayaran->keterangan ?? 'Tidak ada keterangan tambahan' }}
                                </p>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    // Add some interactive effects
    document.addEventListener('DOMContentLoaded', function() {
        // Animate elements on load
        const elements = document.querySelectorAll('.floating, .bg-gradient-to-br');
        elements.forEach((el, index) => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(20px)';
            setTimeout(() => {
                el.style.transition = 'all 0.6s ease-out';
                el.style.opacity = '1';
                el.style.transform = 'translateY(0)';
            }, index * 100);
        });

        // Add hover effects to images
        const images = document.querySelectorAll('img');
        images.forEach(img => {
            img.addEventListener('click', function() {
                // Create modal overlay for image preview
                const modal = document.createElement('div');
                modal.className = 'fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center z-50 p-4';
                modal.onclick = () => modal.remove();
                
                const modalImg = document.createElement('img');
                modalImg.src = this.src;
                modalImg.className = 'max-w-full max-h-full rounded-lg shadow-2xl';
                
                modal.appendChild(modalImg);
                document.body.appendChild(modal);
            });
        });

        // Add copy functionality to phone numbers and other text
        const copyableElements = document.querySelectorAll('[data-copy]');
        copyableElements.forEach(el => {
            el.style.cursor = 'pointer';
            el.title = 'Klik untuk menyalin';
            el.addEventListener('click', function() {
                navigator.clipboard.writeText(this.textContent);
                showNotification('Disalin ke clipboard!', 'success');
            });
        });
    });

    // Notification system
    function showNotification(message, type = 'info') {
        const notification = document.createElement('div');
        notification.className = `fixed top-4 right-4 p-4 rounded-xl shadow-lg z-50 transition-all duration-300 transform translate-x-full ${
            type === 'error' ? 'bg-red-500 text-white' : 
            type === 'success' ? 'bg-green-500 text-white' : 
            'bg-blue-500 text-white'
        }`;
        notification.textContent = message;
        
        document.body.appendChild(notification);
        
        // Animate in
        setTimeout(() => notification.classList.remove('translate-x-full'), 100);
        
        // Auto remove
        setTimeout(() => {
            notification.classList.add('translate-x-full');
            setTimeout(() => notification.remove(), 300);
        }, 3000);
    }
</script>
@endpush