@extends('dashboard.layout.index')
@section('content')
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-bold text-gray-800">Detail Peminjaman</h2>
                        <div class="flex space-x-4">
                            <a href="{{ route('peminjaman.edit', $peminjaman) }}" 
                               class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition duration-300">
                                <i class="fas fa-edit mr-2"></i>Edit
                            </a>
                            <a href="{{ route('peminjaman.index') }}" 
                               class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded-lg transition duration-300">
                                <i class="fas fa-arrow-left mr-2"></i>Kembali
                            </a>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Data Peminjam -->
                        <div class="bg-gray-50 p-6 rounded-lg">
                            <h3 class="text-lg font-semibold text-gray-700 mb-4">Data Peminjam</h3>
                            
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-500">Nama Lengkap</label>
                                    <p class="mt-1 text-sm text-gray-900">{{ $peminjaman->nama_peminjam }}</p>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-500">Nomor Telepon</label>
                                    <p class="mt-1 text-sm text-gray-900">{{ $peminjaman->phone }}</p>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-500">Foto KTP</label>
                                    <div class="mt-2">
                                        <img src="{{ Storage::url($peminjaman->ktp_peminjam) }}" 
                                             alt="KTP" 
                                             class="h-48 w-auto rounded-lg shadow-md">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Detail Peminjaman -->
                        <div class="bg-gray-50 p-6 rounded-lg">
                            <h3 class="text-lg font-semibold text-gray-700 mb-4">Detail Peminjaman</h3>
                            
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-500">Armada</label>
                                    <p class="mt-1 text-sm text-gray-900">
                                        {{ $peminjaman->armada->merk }} - {{ $peminjaman->armada->nopol }}
                                    </p>
                                </div>

                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-500">Tanggal Mulai</label>
                                        <p class="mt-1 text-sm text-gray-900">
                                            {{ $peminjaman->mulai->format('d M Y') }}
                                        </p>
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-500">Tanggal Selesai</label>
                                        <p class="mt-1 text-sm text-gray-900">
                                            {{ $peminjaman->selesai->format('d M Y') }}
                                        </p>
                                    </div>
                                </div>

                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-500">Lokasi Pengambilan</label>
                                        <p class="mt-1 text-sm text-gray-900">
                                            {{ $peminjaman->pengambilan->nama }}
                                        </p>
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-500">Lokasi Pengembalian</label>
                                        <p class="mt-1 text-sm text-gray-900">
                                            {{ $peminjaman->pengembalian->nama }}
                                        </p>
                                    </div>
                                </div>

                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-500">Waktu Pengambilan</label>
                                        <p class="mt-1 text-sm text-gray-900">
                                            {{ $peminjaman->waktu_pengambilan }}
                                        </p>
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-500">Waktu Pengembalian</label>
                                        <p class="mt-1 text-sm text-gray-900">
                                            {{ $peminjaman->waktu_pengembalian }}
                                        </p>
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-500">Keperluan Peminjaman</label>
                                    <p class="mt-1 text-sm text-gray-900">
                                        {{ $peminjaman->keperluan_pinjam }}
                                    </p>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-500">Status Peminjaman</label>
                                    <span class="mt-1 inline-flex px-2 py-1 text-xs font-semibold rounded-full
                                        {{ $peminjaman->status_pinjam == 'Pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                        {{ $peminjaman->status_pinjam == 'Dipinjam' ? 'bg-blue-100 text-blue-800' : '' }}
                                        {{ $peminjaman->status_pinjam == 'Selesai' ? 'bg-green-100 text-green-800' : '' }}
                                        {{ $peminjaman->status_pinjam == 'Dibatalkan' ? 'bg-red-100 text-red-800' : '' }}">
                                        {{ $peminjaman->status_pinjam }}
                                    </span>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-500">Total Biaya</label>
                                    <p class="mt-1 text-2xl font-bold text-blue-600">
                                        Rp {{ number_format($peminjaman->biaya, 0, ',', '.') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pembayaran Section -->
                    @if($peminjaman->pembayaran)
                    <div class="mt-8 bg-gray-50 p-6 rounded-lg">
                        <h3 class="text-lg font-semibold text-gray-700 mb-4">Detail Pembayaran</h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-500">Tanggal Pembayaran</label>
                                <p class="mt-1 text-sm text-gray-900">
                                    {{ $peminjaman->pembayaran->tanggal->format('d M Y') }}
                                </p>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-500">Jumlah Bayar</label>
                                <p class="mt-1 text-sm text-gray-900">
                                    Rp {{ number_format($peminjaman->pembayaran->jumlah_bayar, 0, ',', '.') }}
                                </p>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-500">Status Pembayaran</label>
                                <span class="mt-1 inline-flex px-2 py-1 text-xs font-semibold rounded-full
                                    {{ $peminjaman->pembayaran->status_pembayaran == 'Lunas' ? 'bg-green-100 text-green-800' : '' }}
                                    {{ $peminjaman->pembayaran->status_pembayaran == 'Belum Lunas' ? 'bg-yellow-100 text-yellow-800' : '' }}">
                                    {{ $peminjaman->pembayaran->status_pembayaran }}
                                </span>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-500">Metode Pembayaran</label>
                                <p class="mt-1 text-sm text-gray-900">
                                    {{ $peminjaman->pembayaran->metode_pembayaran }}
                                </p>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-500">Keterangan</label>
                                <p class="mt-1 text-sm text-gray-900">
                                    {{ $peminjaman->pembayaran->keterangan ?? '-' }}
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