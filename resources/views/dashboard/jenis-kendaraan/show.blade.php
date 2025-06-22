@extends('dashboard.layout.index')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 via-purple-50 to-pink-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header Section -->
        <div class="relative mb-8">
            <div class="absolute inset-0 bg-gradient-to-r from-blue-600 to-purple-600 rounded-3xl opacity-10"></div>
            <div class="relative bg-white/70 backdrop-blur-lg border border-white/20 rounded-3xl p-8 shadow-xl">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                    <div>
                        <h1 class="text-4xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
                            Detail Jenis Kendaraan
                        </h1>
                        <p class="text-gray-600 mt-2">Informasi lengkap tentang {{ $jenisKendaraan->nama }}</p>
                    </div>
                    <div class="flex gap-3">
                        <a href="{{ route('jenis-kendaraan.edit', $jenisKendaraan) }}" 
                           class="bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 text-white font-semibold py-3 px-6 rounded-2xl transition-all duration-300 transform hover:scale-105 hover:shadow-lg flex items-center space-x-2">
                            <i class="fas fa-edit"></i>
                            <span>Edit</span>
                        </a>
                        <a href="{{ route('jenis-kendaraan.index') }}" 
                           class="bg-gradient-to-r from-gray-500 to-gray-600 hover:from-gray-600 hover:to-gray-700 text-white font-semibold py-3 px-6 rounded-2xl transition-all duration-300 transform hover:scale-105 hover:shadow-lg flex items-center space-x-2">
                            <i class="fas fa-arrow-left"></i>
                            <span>Kembali</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Detail Information -->
            <div class="lg:col-span-1">
                <div class="bg-white/60 backdrop-blur-lg border border-white/30 rounded-2xl p-6 shadow-lg">
                    <div class="text-center mb-6">
                        <div class="w-24 h-24 mx-auto bg-gradient-to-br from-blue-400 to-purple-500 rounded-2xl flex items-center justify-center mb-4">
                            <i class="fas fa-car text-4xl text-white"></i>
                        </div>
                        <h2 class="text-2xl font-bold text-gray-800">{{ $jenisKendaraan->nama }}</h2>
                        <p class="text-gray-600">Jenis Kendaraan</p>
                    </div>
                    
                    <div class="space-y-4">                        <div class="bg-white/50 rounded-xl p-4">
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">Total Armada</span>
                                <span class="font-bold text-xl text-blue-600">{{ $jenisKendaraan->armada->count() }}</span>
                            </div>
                        </div>
                        
                        <div class="bg-white/50 rounded-xl p-4">
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">Dibuat Pada</span>
                                <span class="font-medium text-gray-800">{{ $jenisKendaraan->created_at ? $jenisKendaraan->created_at->format('d M Y H:i') : 'Tidak tersedia' }}</span>
                            </div>
                        </div>
                        
                        <div class="bg-white/50 rounded-xl p-4">
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">Terakhir Diupdate</span>
                                <span class="font-medium text-gray-800">{{ $jenisKendaraan->updated_at ? $jenisKendaraan->updated_at->format('d M Y H:i') : 'Tidak tersedia' }}</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Action Buttons -->
                    <div class="mt-6 space-y-3">
                        <a href="{{ route('jenis-kendaraan.edit', $jenisKendaraan) }}" 
                           class="w-full bg-green-500 hover:bg-green-600 text-white text-center py-3 px-4 rounded-xl transition-colors flex items-center justify-center space-x-2">
                            <i class="fas fa-edit"></i>
                            <span>Edit Jenis Kendaraan</span>
                        </a>
                        
                        @if($jenisKendaraan->armada->count() == 0)
                        <form action="{{ route('jenis-kendaraan.destroy', $jenisKendaraan) }}" 
                              method="POST" 
                              onsubmit="return confirm('Yakin ingin menghapus jenis kendaraan ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="w-full bg-red-500 hover:bg-red-600 text-white py-3 px-4 rounded-xl transition-colors flex items-center justify-center space-x-2">
                                <i class="fas fa-trash"></i>
                                <span>Hapus</span>
                            </button>
                        </form>
                        @else
                        <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded-xl">
                            <div class="flex items-center">
                                <i class="fas fa-exclamation-triangle mr-2"></i>
                                <span class="text-sm">Tidak dapat dihapus karena masih memiliki armada terkait</span>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Armada List -->
            <div class="lg:col-span-2">
                <div class="bg-white/60 backdrop-blur-lg border border-white/30 rounded-2xl shadow-lg overflow-hidden">
                    <!-- Header -->
                    <div class="bg-gradient-to-r from-blue-600 to-purple-600 px-6 py-4">                        <h2 class="text-xl font-bold text-white flex items-center">
                            <i class="fas fa-cars mr-3"></i>
                            Daftar Armada ({{ $jenisKendaraan->armada->count() }})
                        </h2>
                    </div>

                    @if($jenisKendaraan->armada->count() > 0)
                    <!-- Armada Grid -->
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            @foreach($jenisKendaraan->armada as $armada)
                            <div class="bg-white rounded-xl p-4 border border-gray-200 hover:shadow-lg transition-all duration-300">
                                <div class="flex items-start space-x-4">
                                    <div class="flex-shrink-0">
                                        @if($armada->gambar)
                                            <img src="{{ asset('images/' . $armada->gambar) }}" 
                                                 alt="{{ $armada->nama_mobil }}"
                                                 class="w-16 h-16 rounded-lg object-cover">
                                        @else
                                            <div class="w-16 h-16 bg-gradient-to-br from-gray-400 to-gray-500 rounded-lg flex items-center justify-center">
                                                <i class="fas fa-car text-2xl text-white"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <h3 class="text-lg font-semibold text-gray-900 truncate">{{ $armada->nama_mobil }}</h3>
                                        <p class="text-sm text-gray-600">{{ $armada->merk }} • {{ $armada->model }}</p>
                                        <div class="mt-2 flex items-center space-x-3">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                                {{ $armada->status == 'Tersedia' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                {{ $armada->status }}
                                            </span>
                                            <span class="text-sm font-medium text-blue-600">
                                                Rp {{ number_format($armada->harga_sewa) }}/hari
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-4 flex justify-end">
                                    <a href="{{ route('armada.show', $armada) }}" 
                                       class="text-blue-600 hover:text-blue-800 text-sm font-medium flex items-center">
                                        Lihat Detail
                                        <i class="fas fa-arrow-right ml-1"></i>
                                    </a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        
                        @if($jenisKendaraan->armada->count() >= 10)
                        <div class="mt-6 text-center">
                            <a href="{{ route('armada.index', ['jenis_kendaraan' => $jenisKendaraan->id]) }}" 
                               class="inline-flex items-center px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-lg transition-colors">
                                Lihat Semua Armada
                                <i class="fas fa-arrow-right ml-2"></i>
                            </a>
                        </div>
                        @endif
                    </div>
                    @else
                    <!-- Empty State -->
                    <div class="p-12 text-center">
                        <div class="flex flex-col items-center">
                            <i class="fas fa-car text-6xl text-gray-300 mb-4"></i>
                            <h3 class="text-lg font-medium text-gray-600 mb-2">Belum Ada Armada</h3>
                            <p class="text-gray-500 mb-4">Jenis kendaraan ini belum memiliki armada yang terdaftar</p>
                            <a href="{{ route('armada.create') }}" 
                               class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition-colors">
                                Tambah Armada
                            </a>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
