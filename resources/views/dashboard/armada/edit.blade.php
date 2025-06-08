@extends('dashboard.layout.index')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-indigo-50 py-8">
    <div class="max-w-4xl mx-auto px-6">
        <!-- Header Section -->
        <div class="bg-white rounded-2xl shadow-xl border border-gray-100 mb-8 overflow-hidden">
            <div class="bg-gradient-to-r from-blue-600 to-indigo-600 px-8 py-6">
                <div class="flex justify-between items-center">
                    <div>
                        <h1 class="text-2xl font-bold text-white mb-2">Edit Kendaraan</h1>
                        <p class="text-blue-100">Perbarui informasi dan detail kendaraan</p>
                    </div>
                    <a href="{{ route('armada.index') }}" 
                       class="bg-white/20 hover:bg-white/30 text-white rounded-full p-3 transition-all duration-200 backdrop-blur-sm">
                        <i class="fas fa-arrow-left text-lg"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Main Form -->
        <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
            <form action="{{ route('armada.update', $armada->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="p-8">
                    <!-- Vehicle Image Section -->
                    <div class="mb-8">
                        <div class="flex items-center space-x-4 mb-6">
                            <div class="bg-gradient-to-r from-blue-500 to-indigo-500 rounded-full p-3">
                                <i class="fas fa-camera text-white text-lg"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-800">Gambar Kendaraan</h3>
                                <p class="text-gray-500 text-sm">Unggah gambar berkualitas tinggi dari kendaraan</p>
                            </div>
                        </div>
                        
                        <div class="relative">
                            <input type="file" id="gambar" name="gambar" accept="image/*" class="hidden">
                            <label for="gambar" class="group cursor-pointer block">
                                <div class="border-2 border-dashed border-gray-300 rounded-xl p-6 text-center hover:border-blue-400 transition-colors duration-200 group-hover:bg-blue-50/50">                                    @if($armada->gambar)
                                        <div class="flex justify-center mb-4">
                                            <img src="{{ asset('storage/armada-images/' . $armada->gambar) }}" alt="Gambar Saat Ini" 
                                                 class="h-32 w-48 object-cover rounded-lg shadow-md">
                                        </div>
                                        <p class="text-blue-600 font-medium">Klik untuk mengubah gambar</p>
                                        <p class="text-gray-500 text-sm mt-1">Gambar saat ini ditampilkan di atas</p>
                                    @else
                                        <div class="text-gray-400 mb-4">
                                            <i class="fas fa-cloud-upload-alt text-4xl"></i>
                                        </div>
                                        <p class="text-gray-600 font-medium">Klik untuk mengunggah gambar</p>
                                        <p class="text-gray-500 text-sm mt-1">PNG, JPG hingga 10MB</p>
                                    @endif
                                </div>
                            </label>
                            @error('gambar')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                            </p>
                            @enderror
                        </div>
                    </div>

                    <!-- Basic Information -->
                    <div class="mb-8">
                        <div class="flex items-center space-x-4 mb-6">
                            <div class="bg-gradient-to-r from-green-500 to-emerald-500 rounded-full p-3">
                                <i class="fas fa-info-circle text-white text-lg"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-800">Informasi Dasar</h3>
                                <p class="text-gray-500 text-sm">Detail dan spesifikasi kendaraan yang penting</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Brand -->
                            <div class="space-y-2">
                                <label for="merk" class="block text-sm font-semibold text-gray-700">
                                    <i class="fas fa-tag text-blue-500 mr-2"></i>Merek
                                </label>
                                <input type="text" id="merk" name="merk" value="{{ old('merk', $armada->merk) }}"
                                       class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-200 bg-gray-50 focus:bg-white">
                                @error('merk')
                                <p class="text-sm text-red-600 flex items-center mt-1">
                                    <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                </p>
                                @enderror
                            </div>

                            <!-- License Plate -->
                            <div class="space-y-2">
                                <label for="nopol" class="block text-sm font-semibold text-gray-700">
                                    <i class="fas fa-id-card text-purple-500 mr-2"></i>Nomor Polisi
                                </label>
                                <input type="text" id="nopol" name="nopol" value="{{ old('nopol', $armada->nopol) }}"
                                       class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-200 bg-gray-50 focus:bg-white">
                                @error('nopol')
                                <p class="text-sm text-red-600 flex items-center mt-1">
                                    <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                </p>
                                @enderror
                            </div>

                            <!-- Year -->
                            <div class="space-y-2">
                    <label for="thn_beli" class="block text-sm font-semibold text-gray-700">
                        <i class="fas fa-calendar text-yellow-500 mr-2"></i>Tahun
                    </label>
                    <input type="number" id="thn_beli" name="thn_beli" value="{{ old('thn_beli', $armada->thn_beli) }}"
                           class="w-full px-5 py-4 text-base rounded-xl border border-gray-300 focus:border-blue-500 focus:ring-3 focus:ring-blue-200 transition-all duration-200 bg-gray-50 focus:bg-white placeholder-gray-400">
                    @error('thn_beli')
                    <p class="text-sm text-red-600 flex items-center mt-2">
                        <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                    </p>
                    @enderror
                    </div>

                    <!-- Vehicle Type -->
                    <div class="space-y-3">
                    <label for="jenis_kendaraan_id" class="block text-sm font-semibold text-gray-700">
                        <i class="fas fa-car text-red-500 mr-2"></i>Jenis Kendaraan
                    </label>
                    <select id="jenis_kendaraan_id" name="jenis_kendaraan_id"
                        class="w-full px-5 py-4 text-base rounded-xl border border-gray-300 focus:border-blue-500 focus:ring-3 focus:ring-blue-200 transition-all duration-200 bg-gray-50 focus:bg-white">
                        <option value="">Pilih Jenis</option>
                                    @foreach($jenisKendaraans as $jenis)
                                    <option value="{{ $jenis->id }}" {{ old('jenis_kendaraan_id', $armada->jenis_kendaraan_id) == $jenis->id ? 'selected' : '' }}>
                                        {{ $jenis->nama }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('jenis_kendaraan_id')
                                <p class="text-sm text-red-600 flex items-center mt-1">
                                    <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                </p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Specifications -->
                    <div class="mb-8">
                        <div class="flex items-center space-x-4 mb-6">
                            <div class="bg-gradient-to-r from-orange-500 to-red-500 rounded-full p-3">
                                <i class="fas fa-cogs text-white text-lg"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-800">Spesifikasi & Harga</h3>
                                <p class="text-gray-500 text-sm">Kapasitas kendaraan, rating, dan informasi harga</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <!-- Seat Capacity -->
                            <div class="space-y-2">
                                <label for="kapasitas_kursi" class="block text-sm font-semibold text-gray-700">
                                    <i class="fas fa-users text-blue-500 mr-2"></i>Kapasitas Kursi
                                </label>
                                <input type="number" id="kapasitas_kursi" name="kapasitas_kursi" value="{{ old('kapasitas_kursi', $armada->kapasitas_kursi) }}"
                                       class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-200 bg-gray-50 focus:bg-white">
                                @error('kapasitas_kursi')
                                <p class="text-sm text-red-600 flex items-center mt-1">
                                    <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                </p>
                                @enderror
                            </div>

                            <!-- Rating -->
                            <div class="space-y-2">
                                <label for="rating" class="block text-sm font-semibold text-gray-700">
                                    <i class="fas fa-star text-yellow-500 mr-2"></i>Rating
                                </label>
                                <select id="rating" name="rating"
                                        class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-200 bg-gray-50 focus:bg-white">
                                    @for($i = 1; $i <= 5; $i++)
                                    <option value="{{ $i }}" {{ old('rating', $armada->rating) == $i ? 'selected' : '' }}>
                                        {{ $i }} ⭐ {{ $i == 1 ? 'Bintang' : 'Bintang' }}
                                    </option>
                                    @endfor
                                </select>
                                @error('rating')
                                <p class="text-sm text-red-600 flex items-center mt-1">
                                    <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                </p>
                                @enderror
                            </div>

                            <!-- Daily Price -->
                            <div class="space-y-2">
                                <label for="harga" class="block text-sm font-semibold text-gray-700">
                                    <i class="fas fa-money-bill-wave text-green-500 mr-2"></i>Harga Harian (Rp)
                                </label>
                                <input type="number" id="harga" name="harga" value="{{ old('harga', $armada->harga) }}"
                                       class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-200 bg-gray-50 focus:bg-white">
                                @error('harga')
                                <p class="text-sm text-red-600 flex items-center mt-1">
                                    <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                </p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="mb-8">
                        <div class="flex items-center space-x-4 mb-6">
                            <div class="bg-gradient-to-r from-indigo-500 to-purple-500 rounded-full p-3">
                                <i class="fas fa-align-left text-white text-lg"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-800">Deskripsi</h3>
                                <p class="text-gray-500 text-sm">Deskripsi detail dan fitur kendaraan</p>
                            </div>
                        </div>

                        <div class="space-y-2">
                            <textarea id="deskripsi" name="deskripsi" rows="4" placeholder="Masukkan deskripsi detail kendaraan..."
                                      class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-200 bg-gray-50 focus:bg-white resize-none">{{ old('deskripsi', $armada->deskripsi) }}</textarea>
                            @error('deskripsi')
                            <p class="text-sm text-red-600 flex items-center mt-1">
                                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                            </p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="bg-gray-50 px-8 py-6 border-t border-gray-200">
                    <div class="flex justify-end space-x-4">
                        <a href="{{ route('armada.index') }}" 
                           class="px-6 py-3 border-2 border-gray-300 rounded-xl text-gray-700 hover:bg-gray-100 hover:border-gray-400 transition-all duration-200 font-semibold flex items-center">
                            <i class="fas fa-times mr-2"></i>Batal
                        </a>
                        <button type="submit" 
                                class="px-6 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 text-white rounded-xl hover:from-blue-700 hover:to-indigo-700 transition-all duration-200 font-semibold shadow-lg hover:shadow-xl flex items-center">
                            <i class="fas fa-save mr-2"></i>Perbarui Kendaraan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .bg-primary { @apply bg-blue-600; }
    .focus\:border-primary:focus { @apply border-blue-500; }
    .focus\:ring-primary:focus { @apply ring-blue-200; }
</style>
@endsection