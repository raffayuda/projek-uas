@extends('dashboard.layout.index')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-indigo-50 py-8">
    <div class="max-w-4xl mx-auto px-6">
        <!-- Header Section -->
        <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden mb-8">
            <div class="bg-gradient-to-r from-blue-600 to-indigo-600 px-8 py-6">
                <div class="flex justify-between items-center">
                    <div>
                        <h1 class="text-2xl font-bold text-white flex items-center">
                            <i class="fas fa-car mr-3 text-blue-200"></i>
                            Tambah Kendaraan Baru
                        </h1>
                        <p class="text-blue-100 mt-1">Isi detail untuk menambahkan kendaraan baru ke armada Anda</p>
                    </div>
                    <a href="{{ route('armada.index') }}" 
                       class="bg-white/10 hover:bg-white/20 text-white rounded-lg p-2 transition-all duration-200">
                        <i class="fas fa-times text-lg"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Form Section -->
        <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
            <form action="{{ route('armada.store') }}" method="POST" enctype="multipart/form-data" class="p-8">
            @csrf
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Left Column -->
                <div class="space-y-6">
                <div class="bg-gray-50 rounded-xl p-6 border border-gray-100">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-info-circle mr-2 text-blue-500"></i>
                    Informasi Dasar
                    </h3>
                    
                    <div class="space-y-4">
                    <div>
                        <label for="merk" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-tag mr-1 text-gray-400"></i>Merek
                        </label>
                        <input type="text" id="merk" name="merk" value="{{ old('merk') }}"
                           class="w-full h-12 px-4 rounded-xl border-gray-200 focus:border-blue-500 focus:ring-blue-500 shadow-sm transition-all duration-200 hover:border-gray-300"
                           placeholder="contoh: Toyota, Honda">
                        @error('merk')
                        <p class="mt-2 text-sm text-red-600 flex items-center">
                        <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                        </p>
                        @enderror
                    </div>

                    <div>
                        <label for="nopol" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-id-card mr-1 text-gray-400"></i>Nomor Polisi
                        </label>
                        <input type="text" id="nopol" name="nopol" value="{{ old('nopol') }}"
                           class="w-full h-12 px-4 rounded-xl border-gray-200 focus:border-blue-500 focus:ring-blue-500 shadow-sm transition-all duration-200 hover:border-gray-300"
                           placeholder="contoh: B 1234 ABC">
                        @error('nopol')
                        <p class="mt-2 text-sm text-red-600 flex items-center">
                        <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                        </p>
                        @enderror
                    </div>

                    <div>
                        <label for="thn_beli" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-calendar-alt mr-1 text-gray-400"></i>Tahun
                        </label>
                        <input type="number" id="thn_beli" name="thn_beli" value="{{ old('thn_beli') }}"
                           class="w-full h-12 px-4 rounded-xl border-gray-200 focus:border-blue-500 focus:ring-blue-500 shadow-sm transition-all duration-200 hover:border-gray-300"
                           placeholder="2024" min="1990" max="2030">
                        @error('thn_beli')
                        <p class="mt-2 text-sm text-red-600 flex items-center">
                        <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                        </p>
                        @enderror
                    </div>

                    <div>
                        <label for="jenis_kendaraan_id" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-car-side mr-1 text-gray-400"></i>Jenis Kendaraan
                        </label>
                        <select id="jenis_kendaraan_id" name="jenis_kendaraan_id"
                            class="w-full h-12 px-4 rounded-xl border-gray-200 focus:border-blue-500 focus:ring-blue-500 shadow-sm transition-all duration-200 hover:border-gray-300">
                        <option value="">Pilih jenis kendaraan...</option>
                        @foreach($jenisKendaraans as $jenis)
                        <option value="{{ $jenis->id }}" {{ old('jenis_kendaraan_id') == $jenis->id ? 'selected' : '' }}>
                            {{ $jenis->nama }}
                        </option>
                        @endforeach
                        </select>
                        @error('jenis_kendaraan_id')
                        <p class="mt-2 text-sm text-red-600 flex items-center">
                        <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                        </p>
                        @enderror
                    </div>
                    </div>
                </div>
                </div>

                <!-- Right Column -->
                <div class="space-y-6">
                <div class="bg-gray-50 rounded-xl p-6 border border-gray-100">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-cogs mr-2 text-green-500"></i>
                    Spesifikasi & Harga
                    </h3>
                    
                    <div class="space-y-4">
                    <div>
                        <label for="kapasitas_kursi" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-users mr-1 text-gray-400"></i>Kapasitas Kursi
                        </label>
                        <input type="number" id="kapasitas_kursi" name="kapasitas_kursi" value="{{ old('kapasitas_kursi') }}"
                           class="w-full h-12 px-4 rounded-xl border-gray-200 focus:border-blue-500 focus:ring-blue-500 shadow-sm transition-all duration-200 hover:border-gray-300"
                           placeholder="contoh: 7" min="1" max="50">
                        @error('kapasitas_kursi')
                        <p class="mt-2 text-sm text-red-600 flex items-center">
                        <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                        </p>
                        @enderror
                    </div>

                    <div>
                        <label for="rating" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-star mr-1 text-yellow-400"></i>Rating
                        </label>
                        <select id="rating" name="rating"
                            class="w-full h-12 px-4 rounded-xl border-gray-200 focus:border-blue-500 focus:ring-blue-500 shadow-sm transition-all duration-200 hover:border-gray-300">
                        @for($i = 1; $i <= 5; $i++)
                        <option value="{{ $i }}" {{ old('rating') == $i ? 'selected' : '' }}>
                            {{ str_repeat('⭐', $i) }} {{ $i }} Bintang
                        </option>
                        @endfor
                        </select>
                        @error('rating')
                        <p class="mt-2 text-sm text-red-600 flex items-center">
                        <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                        </p>
                        @enderror
                    </div>

                    <div>
                        <label for="harga" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-money-bill-wave mr-1 text-green-400"></i>Harga Per Hari (Rp)
                        </label>
                        <div class="relative">
                        <span class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-500 font-semibold">Rp</span>
                        <input type="number" id="harga" name="harga" value="{{ old('harga') }}"
                               class="w-full h-12 pl-12 pr-4 rounded-xl border-gray-200 focus:border-blue-500 focus:ring-blue-500 shadow-sm transition-all duration-200 hover:border-gray-300"
                               placeholder="500,000">
                        </div>
                        @error('harga')
                        <p class="mt-2 text-sm text-red-600 flex items-center">
                        <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                        </p>
                        @enderror
                    </div>

                    <div>
                        <label for="gambar" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-image mr-1 text-purple-400"></i>Gambar Kendaraan
                        </label>
                        <div class="relative">
                        <input type="file" id="gambar" name="gambar" accept="image/*"
                               class="w-full h-12 rounded-xl border-gray-200 focus:border-blue-500 focus:ring-blue-500 shadow-sm transition-all duration-200 hover:border-gray-300 file:mr-4 file:h-full file:py-0 file:px-4 file:rounded-l-xl file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                        </div>
                        @error('gambar')
                        <p class="mt-2 text-sm text-red-600 flex items-center">
                        <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                        </p>
                        @enderror
                    </div>
                    </div>
                </div>
                </div>
            </div>

            <!-- Description Section -->
            <div class="mt-8 bg-gray-50 rounded-xl p-6 border border-gray-100">
                <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                <i class="fas fa-align-left mr-2 text-indigo-500"></i>
                Deskripsi
                </h3>
                <textarea id="deskripsi" name="deskripsi" rows="5"
                      class="w-full px-4 py-3 rounded-xl border-gray-200 focus:border-blue-500 focus:ring-blue-500 shadow-sm transition-all duration-200 hover:border-gray-300 resize-none"
                      placeholder="Deskripsikan fitur kendaraan, kondisi, dan informasi tambahan lainnya...">{{ old('deskripsi') }}</textarea>
                @error('deskripsi')
                <p class="mt-2 text-sm text-red-600 flex items-center">
                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                </p>
                @enderror
            </div>

            <!-- Action Buttons -->
            <div class="mt-8 flex flex-col sm:flex-row justify-end space-y-3 sm:space-y-0 sm:space-x-4">
                <a href="{{ route('armada.index') }}" 
                   class="px-8 py-4 border-2 border-gray-300 rounded-xl text-gray-700 font-semibold hover:bg-gray-50 hover:border-gray-400 transition-all duration-200 text-center flex items-center justify-center">
                <i class="fas fa-arrow-left mr-2"></i>Batal
                </a>
                <button type="submit" 
                    class="px-10 py-4 bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-semibold rounded-xl hover:from-blue-700 hover:to-indigo-700 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200 flex items-center justify-center">
                <i class="fas fa-save mr-2"></i>Simpan Kendaraan
                </button>
            </div>
            </form>
        </div>
    </div>
</div>
@endsection