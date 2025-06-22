@extends('dashboard.layout.index')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 via-purple-50 to-pink-50">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header -->
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Tambah Jenis Kendaraan</h1>
                <p class="text-gray-600 mt-1">Buat kategori jenis kendaraan baru</p>
            </div>
            <a href="{{ route('jenis-kendaraan.index') }}" 
               class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-xl font-medium transition-colors duration-200 flex items-center">
                <i class="fas fa-arrow-left mr-2"></i>
                Kembali
            </a>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
            <div class="bg-gradient-to-r from-blue-600 to-purple-600 px-8 py-6">
                <h2 class="text-2xl font-bold text-white">Form Tambah Jenis Kendaraan</h2>
                <p class="text-blue-100 mt-1">Lengkapi informasi jenis kendaraan baru</p>
            </div>

            <form action="{{ route('jenis-kendaraan.store') }}" method="POST" class="p-8">
                @csrf

                <!-- Nama Jenis Kendaraan -->
                <div class="mb-6">
                    <label for="nama" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-list mr-2 text-blue-500"></i>Nama Jenis Kendaraan *
                    </label>
                    <input type="text" 
                           id="nama" 
                           name="nama" 
                           value="{{ old('nama') }}"
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

                <!-- Info Box -->
                <div class="bg-blue-50 border border-blue-200 rounded-xl p-6 mb-8">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <i class="fas fa-lightbulb text-blue-500 text-xl"></i>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-blue-800">Tips Penamaan Jenis Kendaraan</h3>
                            <div class="mt-2 text-sm text-blue-700">
                                <ul class="list-disc list-inside space-y-1">
                                    <li>Gunakan nama yang mudah dipahami dan umum digunakan</li>
                                    <li>Contoh yang baik: Sedan, SUV, Hatchback, MPV, Pickup, Minibus</li>
                                    <li>Hindari penggunaan nama yang terlalu spesifik atau merek tertentu</li>
                                    <li>Nama harus unik dan belum pernah digunakan sebelumnya</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Submit Buttons -->
                <div class="flex justify-end space-x-4 pt-6 border-t">
                    <a href="{{ route('jenis-kendaraan.index') }}" 
                       class="px-6 py-3 border border-gray-300 text-gray-700 rounded-xl hover:bg-gray-50 font-medium transition-colors">
                        Batal
                    </a>
                    <button type="submit" 
                            class="bg-gradient-to-r from-blue-600 to-purple-600 text-white px-8 py-3 rounded-xl font-semibold hover:from-blue-700 hover:to-purple-700 transition-all duration-200 shadow-lg hover:shadow-xl">
                        <i class="fas fa-save mr-2"></i>
                        Simpan Jenis Kendaraan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
