@extends('dashboard.layout.index')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 via-purple-50 to-pink-50">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header -->
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Edit Jenis Kendaraan</h1>
                <p class="text-gray-600 mt-1">Perbarui informasi jenis kendaraan {{ $jenisKendaraan->nama }}</p>
            </div>
            <div class="flex space-x-3">
                <a href="{{ route('jenis-kendaraan.show', $jenisKendaraan) }}" 
                   class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded-xl font-medium transition-colors duration-200 flex items-center">
                    <i class="fas fa-eye mr-2"></i>
                    Detail
                </a>
                <a href="{{ route('jenis-kendaraan.index') }}" 
                   class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-xl font-medium transition-colors duration-200 flex items-center">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Kembali
                </a>
            </div>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
            <div class="bg-gradient-to-r from-green-600 to-blue-600 px-8 py-6">
                <h2 class="text-2xl font-bold text-white">Form Edit Jenis Kendaraan</h2>
                <p class="text-green-100 mt-1">Perbarui informasi jenis kendaraan</p>
            </div>

            <form action="{{ route('jenis-kendaraan.update', $jenisKendaraan) }}" method="POST" class="p-8">
                @csrf
                @method('PUT')

                <!-- Nama Jenis Kendaraan -->
                <div class="mb-6">
                    <label for="nama" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-list mr-2 text-blue-500"></i>Nama Jenis Kendaraan *
                    </label>
                    <input type="text" 
                           id="nama" 
                           name="nama" 
                           value="{{ old('nama', $jenisKendaraan->nama) }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors @error('nama') border-red-500 @enderror"
                           placeholder="Contoh: Sedan, SUV, Hatchback, MPV"
                           required>
                    @error('nama')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                    <p class="text-gray-500 text-sm mt-2">
                        <i class="fas fa-info-circle mr-1"></i>
                        Masukkan nama kategori kendaraan yang akan digunakan untuk mengklasifikasikan armada
                    </p>
                </div>

                <!-- Info Section -->
                <div class="bg-gray-50 rounded-xl p-6 mb-8">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">
                        <i class="fas fa-info-circle mr-2 text-blue-500"></i>Informasi Jenis Kendaraan
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                        <div>
                            <span class="text-gray-600">Dibuat:</span>
                            <p class="font-semibold">{{ $jenisKendaraan->created_at ? $jenisKendaraan->created_at->format('d/m/Y H:i') : 'Tidak tersedia' }}</p>
                        </div>
                        <div>
                            <span class="text-gray-600">Terakhir Diperbarui:</span>
                            <p class="font-semibold">{{ $jenisKendaraan->updated_at ? $jenisKendaraan->updated_at->format('d/m/Y H:i') : 'Tidak tersedia' }}</p>
                        </div>
                        <div>
                            <span class="text-gray-600">Total Armada:</span>
                            <p class="font-semibold">{{ $jenisKendaraan->armada()->count() }} kendaraan</p>
                        </div>
                    </div>
                </div>

                <!-- Warning if has armadas -->
                @if($jenisKendaraan->armada()->count() > 0)
                <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-6 mb-8">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <i class="fas fa-exclamation-triangle text-yellow-500 text-xl"></i>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-yellow-800">Perhatian</h3>
                            <div class="mt-2 text-sm text-yellow-700">
                                <p>Jenis kendaraan ini memiliki <strong>{{ $jenisKendaraan->armada()->count() }} armada</strong> yang terkait. 
                                   Perubahan nama akan mempengaruhi semua armada yang menggunakan jenis kendaraan ini.</p>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Submit Buttons -->
                <div class="flex justify-end space-x-4 pt-6 border-t">
                    <a href="{{ route('jenis-kendaraan.index') }}" 
                       class="px-6 py-3 border border-gray-300 text-gray-700 rounded-xl hover:bg-gray-50 font-medium transition-colors">
                        Batal
                    </a>
                    <button type="submit" 
                            class="bg-gradient-to-r from-green-600 to-blue-600 text-white px-8 py-3 rounded-xl font-semibold hover:from-green-700 hover:to-blue-700 transition-all duration-200 shadow-lg hover:shadow-xl">
                        <i class="fas fa-save mr-2"></i>
                        Update Jenis Kendaraan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
