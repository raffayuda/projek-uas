@extends('dashboard.layout.index')
@section('content')
<link href="{{ asset('css/peminjaman-modern.css') }}" rel="stylesheet">

<!-- Modern Gradient Background -->
<div class="min-h-screen relative overflow-hidden bg-gradient-to-br from-blue-50 via-purple-50 to-pink-50">
    <!-- Animated Background Elements -->
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute -top-1/2 -left-1/2 w-full h-full bg-gradient-to-br from-blue-400/20 to-transparent rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute -bottom-1/2 -right-1/2 w-full h-full bg-gradient-to-tl from-purple-400/20 to-transparent rounded-full blur-3xl animate-pulse delay-1000"></div>
    </div>

    <div class="relative py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Glassmorphism Container -->
            <div class="backdrop-blur-xl bg-white/20 border border-white/20 rounded-3xl shadow-2xl overflow-hidden">
                <!-- Header Section -->
                <div class="relative bg-gradient-to-r from-blue-600/80 via-purple-600/80 to-pink-600/80 backdrop-blur-lg p-8">
                    <div class="absolute inset-0 bg-white/10 backdrop-blur-sm"></div>
                    <div class="relative flex justify-between items-center">
                        <div class="flex items-center space-x-4">
                            <div class="w-16 h-16 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center">
                                <i class="fas fa-plus-circle text-3xl text-white"></i>
                            </div>
                            <div>
                                <h1 class="text-3xl font-bold text-white mb-2">Tambah Peminjaman Baru</h1>
                                <p class="text-white/80">Isi form di bawah untuk menambah peminjaman kendaraan</p>
                            </div>
                        </div>
                        <a href="{{ route('peminjaman.index') }}" 
                           class="group bg-white/20 hover:bg-white/30 backdrop-blur-sm text-white font-semibold py-3 px-6 rounded-xl transition-all duration-300 transform hover:scale-105 border border-white/30 hover:border-white/50">
                            <i class="fas fa-arrow-left mr-2 group-hover:-translate-x-1 transition-transform duration-300"></i>
                            Kembali
                        </a>
                    </div>
                </div>

                <!-- Form Content -->
                <div class="p-8 bg-white/30 backdrop-blur-lg">
                    <div class="relative">
                        <!-- Decorative Elements -->
                        <div class="absolute top-0 left-0 w-32 h-32 bg-gradient-to-br from-blue-400/20 to-purple-400/20 rounded-full blur-2xl"></div>
                        <div class="absolute bottom-0 right-0 w-24 h-24 bg-gradient-to-tl from-pink-400/20 to-yellow-400/20 rounded-full blur-xl"></div>

                        <!-- Main Form Section -->
                        <div class="relative z-10" x-data="{ 
                            selectedArmadaId: '',
                            selectedArmada: { id: null, harga: 0 },
                            startDate: null,
                            endDate: null,
                            isSubmitting: false,
                            calculateTotal() {
                                if (this.selectedArmada.harga && this.startDate && this.endDate) {
                                    const start = new Date(this.startDate);
                                    const end = new Date(this.endDate);
                                    start.setHours(0, 0, 0, 0);
                                    end.setHours(0, 0, 0, 0);
                                    const days = Math.ceil((end - start) / (1000 * 60 * 60 * 24));
                                    return Math.max(1, days) * this.selectedArmada.harga;
                                }
                                return 0;
                            }
                        }">
                            <form action="{{ route('peminjaman.store') }}" method="POST" enctype="multipart/form-data"
                                  class="space-y-8" 
                                  @submit="isSubmitting = true">
                                @csrf
                                
                                <!-- Customer Information Card -->
                                <div class="group relative overflow-hidden rounded-2xl border border-white/20 bg-white/10 backdrop-blur-lg hover:bg-white/20 transition-all duration-500 transform hover:scale-[1.02]">
                                    <div class="absolute inset-0 bg-gradient-to-r from-blue-500/10 to-purple-500/10 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                                    <div class="relative z-10 p-6">
                                        <div class="flex items-center mb-6">
                                            <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-purple-600 rounded-xl flex items-center justify-center mr-4">
                                                <i class="fas fa-user text-white text-xl"></i>
                                            </div>
                                            <h3 class="text-xl font-bold text-gray-800">Informasi Peminjam</h3>
                                        </div>
                                        
                                        <!-- User Account Selection -->
                                        <div class="mb-6 p-4 bg-gradient-to-r from-indigo-50 to-purple-50 rounded-xl border border-indigo-200">
                                            <label for="user_id" class="block text-sm font-medium text-gray-700 mb-2">
                                                <i class="fas fa-user-circle mr-2 text-indigo-600"></i>
                                                Pilih Akun User
                                            </label>
                                            <select name="user_id" id="user_id" required
                                                    class="w-full px-4 py-3 bg-white/80 backdrop-blur-sm border border-indigo-300 rounded-xl text-gray-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-300">
                                                <option value="">-- Pilih Akun User --</option>
                                                @foreach($users as $user)
                                                    <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                                        {{ $user->name }} - {{ $user->email }}
                                                        @if($user->phone)
                                                            ({{ $user->phone }})
                                                        @endif
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('user_id')
                                                <p class="text-red-500 text-sm mt-1 flex items-center">
                                                    <i class="fas fa-exclamation-triangle mr-1"></i>
                                                    {{ $message }}
                                                </p>
                                            @enderror
                                            <p class="text-xs text-gray-600 mt-2">
                                                <i class="fas fa-info-circle mr-1"></i>
                                                Peminjaman akan dikaitkan dengan akun user yang dipilih
                                            </p>
                                        </div>
                                        
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                            <div class="space-y-2">
                                                <label for="nama_peminjam" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                                                <input type="text" name="nama_peminjam" id="nama_peminjam" required
                                                       value="{{ old('nama_peminjam') }}"
                                                       class="w-full px-4 py-3 bg-white/50 backdrop-blur-sm border border-white/30 rounded-xl text-gray-800 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-transparent transition-all duration-300"
                                                       placeholder="Masukkan nama lengkap">
                                                @error('nama_peminjam')
                                                    <p class="text-red-500 text-sm mt-1 flex items-center">
                                                        <i class="fas fa-exclamation-triangle mr-1"></i>
                                                        {{ $message }}
                                                    </p>
                                                @enderror
                                            </div>
                                            
                                            <div class="space-y-2">
                                                <label for="phone" class="block text-sm font-medium text-gray-700">Nomor Telepon</label>
                                                <input type="tel" name="phone" id="phone" required
                                                       value="{{ old('phone') }}"
                                                       class="w-full px-4 py-3 bg-white/50 backdrop-blur-sm border border-white/30 rounded-xl text-gray-800 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-transparent transition-all duration-300"
                               placeholder="Masukkan nomor telepon">
                        @error('phone')
                            <p class="text-red-500 text-sm mt-1 flex items-center">
                                <i class="fas fa-exclamation-triangle mr-1"></i>
                                {{ $message }}
                            </p>
                        @enderror
                                            </div>
                                        </div>

                                        <!-- KTP Upload -->
                                        <div class="mt-6">
                                            <label for="ktp_peminjam" class="block text-sm font-medium text-gray-700 mb-2">Upload KTP</label>
                                            <div class="border-2 border-dashed border-white/30 hover:border-blue-400/50 rounded-xl p-6 text-center transition-all duration-300 bg-white/20 backdrop-blur-sm">
                                                <div class="space-y-2">
                                                    <div class="w-16 h-16 mx-auto bg-gradient-to-br from-blue-500/20 to-purple-500/20 rounded-xl flex items-center justify-center">
                                                        <i class="fas fa-cloud-upload-alt text-2xl text-blue-600"></i>
                                                    </div>
                                                    <div>
                                                        <label for="ktp_peminjam" class="cursor-pointer">
                                                            <span class="text-blue-600 font-medium hover:text-blue-500">Pilih file</span>
                                                            <span class="text-gray-500"> atau drag & drop</span>
                                                            <input type="file" name="ktp_peminjam" id="ktp_peminjam" class="hidden" accept="image/*" required>
                                                        </label>
                                                        <p class="text-xs text-gray-500 mt-1">PNG, JPG, JPEG (maksimal 2MB)</p>
                                                    </div>
                                                </div>
                                            </div>
                                            @error('ktp_peminjam')
                                                <p class="text-red-500 text-sm mt-1 flex items-center">
                                                    <i class="fas fa-exclamation-triangle mr-1"></i>
                                                    {{ $message }}
                                                </p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Vehicle Selection Card -->
                                <div class="group relative overflow-hidden rounded-2xl border border-white/20 bg-white/10 backdrop-blur-lg hover:bg-white/20 transition-all duration-500 transform hover:scale-[1.02]">
                                    <div class="absolute inset-0 bg-gradient-to-r from-green-500/10 to-blue-500/10 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                                    <div class="relative z-10 p-6">
                                        <div class="flex items-center mb-6">
                                            <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-blue-600 rounded-xl flex items-center justify-center mr-4">
                                                <i class="fas fa-car text-white text-xl"></i>
                                            </div>
                                            <h3 class="text-xl font-bold text-gray-800">Pilih Kendaraan</h3>
                                        </div>                                        
                                        <div class="space-y-2">
                                            <label for="armada_id" class="block text-sm font-medium text-gray-700">Armada</label>
                                            <select name="armada_id" id="armada_id" required
                                                    x-model="selectedArmadaId"
                                                    @change="selectedArmada = { id: $event.target.value, harga: parseInt($event.target.options[$event.target.selectedIndex].dataset.harga || 0) }"
                                                    class="w-full px-4 py-3 bg-white/50 backdrop-blur-sm border border-white/30 rounded-xl text-gray-800 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-green-500/50 focus:border-transparent transition-all duration-300">
                                                <option value="">Pilih Armada</option>
                                                @foreach($armadas as $armada)
                                                    <option value="{{ $armada->id }}" 
                                                            data-harga="{{ $armada->harga }}"
                                                            {{ old('armada_id') == $armada->id ? 'selected' : '' }}>
                                                        {{ $armada->merk }} - {{ $armada->nopol }} (Rp {{ number_format($armada->harga, 0, ',', '.') }}/hari)
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('armada_id')
                                                <p class="text-red-500 text-sm mt-1 flex items-center">
                                                    <i class="fas fa-exclamation-triangle mr-1"></i>
                                                    {{ $message }}
                                                </p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Date & Time Selection Card -->
                                <div class="group relative overflow-hidden rounded-2xl border border-white/20 bg-white/10 backdrop-blur-lg hover:bg-white/20 transition-all duration-500 transform hover:scale-[1.02]">
                                    <div class="absolute inset-0 bg-gradient-to-r from-purple-500/10 to-pink-500/10 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                                    <div class="relative z-10 p-6">
                                        <div class="flex items-center mb-6">
                                            <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-pink-600 rounded-xl flex items-center justify-center mr-4">
                                                <i class="fas fa-calendar-alt text-white text-xl"></i>
                                            </div>
                                            <h3 class="text-xl font-bold text-gray-800">Periode & Waktu</h3>
                                        </div>
                                        
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                            <div class="space-y-2">
                                                <label for="mulai" class="block text-sm font-medium text-gray-700">Tanggal Mulai</label>
                                                <input type="date" name="mulai" id="mulai" 
                                                       x-model="startDate"
                                                       value="{{ old('mulai') }}" required
                                                       class="w-full px-4 py-3 bg-white/50 backdrop-blur-sm border border-white/30 rounded-xl text-gray-800 focus:outline-none focus:ring-2 focus:ring-purple-500/50 focus:border-transparent transition-all duration-300">
                                                @error('mulai')
                                                    <p class="text-red-500 text-sm mt-1 flex items-center">
                                                        <i class="fas fa-exclamation-triangle mr-1"></i>
                                                        {{ $message }}
                                                    </p>
                                                @enderror
                                            </div>
                                            
                                            <div class="space-y-2">
                                                <label for="selesai" class="block text-sm font-medium text-gray-700">Tanggal Selesai</label>
                                                <input type="date" name="selesai" id="selesai" 
                                                       x-model="endDate"
                                                       value="{{ old('selesai') }}" required
                                                       class="w-full px-4 py-3 bg-white/50 backdrop-blur-sm border border-white/30 rounded-xl text-gray-800 focus:outline-none focus:ring-2 focus:ring-purple-500/50 focus:border-transparent transition-all duration-300">
                                                @error('selesai')
                                                    <p class="text-red-500 text-sm mt-1 flex items-center">
                                                        <i class="fas fa-exclamation-triangle mr-1"></i>
                                                        {{ $message }}
                                                    </p>
                                                @enderror
                                            </div>
                                            
                                            <div class="space-y-2">
                                                <label for="waktu_pengambilan" class="block text-sm font-medium text-gray-700">Waktu Pengambilan</label>
                                                <input type="time" name="waktu_pengambilan" id="waktu_pengambilan" 
                                                       value="{{ old('waktu_pengambilan') }}" required
                                                       class="w-full px-4 py-3 bg-white/50 backdrop-blur-sm border border-white/30 rounded-xl text-gray-800 focus:outline-none focus:ring-2 focus:ring-purple-500/50 focus:border-transparent transition-all duration-300">
                                                @error('waktu_pengambilan')
                                                    <p class="text-red-500 text-sm mt-1 flex items-center">
                                                        <i class="fas fa-exclamation-triangle mr-1"></i>
                                                        {{ $message }}
                                                    </p>
                                                @enderror
                                            </div>
                                            
                                            <div class="space-y-2">
                                                <label for="waktu_pengembalian" class="block text-sm font-medium text-gray-700">Waktu Pengembalian</label>
                                                <input type="time" name="waktu_pengembalian" id="waktu_pengembalian" 
                                                       value="{{ old('waktu_pengembalian') }}" required
                                                       class="w-full px-4 py-3 bg-white/50 backdrop-blur-sm border border-white/30 rounded-xl text-gray-800 focus:outline-none focus:ring-2 focus:ring-purple-500/50 focus:border-transparent transition-all duration-300">
                                                @error('waktu_pengembalian')
                                                    <p class="text-red-500 text-sm mt-1 flex items-center">
                                                        <i class="fas fa-exclamation-triangle mr-1"></i>
                                                        {{ $message }}
                                                    </p>
                                                @enderror
                                            </div>                                        </div>
                                    </div>
                                </div>

                                <!-- Location Selection Card -->
                                <div class="group relative overflow-hidden rounded-2xl border border-white/20 bg-white/10 backdrop-blur-lg hover:bg-white/20 transition-all duration-500 transform hover:scale-[1.02]">
                                    <div class="absolute inset-0 bg-gradient-to-r from-orange-500/10 to-red-500/10 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                                    <div class="relative z-10 p-6">
                                        <div class="flex items-center mb-6">
                                            <div class="w-12 h-12 bg-gradient-to-br from-orange-500 to-red-600 rounded-xl flex items-center justify-center mr-4">
                                                <i class="fas fa-map-marker-alt text-white text-xl"></i>
                                            </div>
                                            <h3 class="text-xl font-bold text-gray-800">Lokasi Pengambilan & Pengembalian</h3>
                                        </div>
                                        
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                            <div class="space-y-2">
                                                <label for="pengambilan_id" class="block text-sm font-medium text-gray-700">Lokasi Pengambilan</label>
                                                <select name="pengambilan_id" id="pengambilan_id" required
                                                        class="w-full px-4 py-3 bg-white/50 backdrop-blur-sm border border-white/30 rounded-xl text-gray-800 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-orange-500/50 focus:border-transparent transition-all duration-300">
                                                    <option value="">Pilih Lokasi</option>
                                                    @foreach($lokasis as $lokasi)
                                                        <option value="{{ $lokasi->id }}" {{ old('pengambilan_id') == $lokasi->id ? 'selected' : '' }}>
                                                            {{ $lokasi->nama }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('pengambilan_id')
                                                    <p class="text-red-500 text-sm mt-1 flex items-center">
                                                        <i class="fas fa-exclamation-triangle mr-1"></i>
                                                        {{ $message }}
                                                    </p>
                                                @enderror
                                            </div>
                                            
                                            <div class="space-y-2">
                                                <label for="pengembalian_id" class="block text-sm font-medium text-gray-700">Lokasi Pengembalian</label>
                                                <select name="pengembalian_id" id="pengembalian_id" required
                                                        class="w-full px-4 py-3 bg-white/50 backdrop-blur-sm border border-white/30 rounded-xl text-gray-800 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-orange-500/50 focus:border-transparent transition-all duration-300">
                                                    <option value="">Pilih Lokasi</option>
                                                    @foreach($lokasis as $lokasi)
                                                        <option value="{{ $lokasi->id }}" {{ old('pengembalian_id') == $lokasi->id ? 'selected' : '' }}>
                                                            {{ $lokasi->nama }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('pengembalian_id')
                                                    <p class="text-red-500 text-sm mt-1 flex items-center">
                                                        <i class="fas fa-exclamation-triangle mr-1"></i>
                                                        {{ $message }}
                                                    </p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Purpose Card -->
                                <div class="group relative overflow-hidden rounded-2xl border border-white/20 bg-white/10 backdrop-blur-lg hover:bg-white/20 transition-all duration-500 transform hover:scale-[1.02]">
                                    <div class="absolute inset-0 bg-gradient-to-r from-yellow-500/10 to-orange-500/10 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                                    <div class="relative z-10 p-6">
                                        <div class="flex items-center mb-6">
                                            <div class="w-12 h-12 bg-gradient-to-br from-yellow-500 to-orange-600 rounded-xl flex items-center justify-center mr-4">
                                                <i class="fas fa-clipboard-list text-white text-xl"></i>
                                            </div>
                                            <h3 class="text-xl font-bold text-gray-800">Keperluan Peminjaman</h3>
                                        </div>
                                        
                                        <div class="space-y-2">
                                            <label for="keperluan_pinjam" class="block text-sm font-medium text-gray-700">Keperluan</label>
                                            <textarea name="keperluan_pinjam" id="keperluan_pinjam" rows="4" required
                                                      placeholder="Deskripsikan keperluan peminjaman kendaraan..."
                                                      class="w-full px-4 py-3 bg-white/50 backdrop-blur-sm border border-white/30 rounded-xl text-gray-800 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-yellow-500/50 focus:border-transparent transition-all duration-300 resize-none">{{ old('keperluan_pinjam') }}</textarea>
                                            @error('keperluan_pinjam')
                                                <p class="text-red-500 text-sm mt-1 flex items-center">
                                                    <i class="fas fa-exclamation-triangle mr-1"></i>
                                                    {{ $message }}
                                                </p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Total Cost Display -->
                                <div class="relative overflow-hidden rounded-2xl border border-white/20 bg-gradient-to-r from-blue-500/20 to-purple-500/20 backdrop-blur-lg p-6">
                                    <div class="absolute inset-0 bg-white/10"></div>
                                    <div class="relative z-10 flex justify-between items-center">
                                        <div>
                                            <h3 class="text-lg font-medium text-gray-800">Total Biaya</h3>
                                            <p class="text-sm text-gray-600" x-text="startDate && endDate ? '(' + Math.max(1, Math.ceil((new Date(endDate) - new Date(startDate)) / (1000 * 60 * 60 * 24))) + ' hari)' : ''"></p>
                                        </div>
                                        <div class="text-right">
                                            <div class="text-3xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent"
                                                 x-text="'Rp ' + calculateTotal().toLocaleString('id-ID')"></div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Submit Button -->
                                <div class="flex justify-end pt-6">
                                    <button type="submit" 
                                            class="group relative overflow-hidden bg-gradient-to-r from-blue-600 via-purple-600 to-pink-600 hover:from-blue-700 hover:via-purple-700 hover:to-pink-700 text-white font-bold py-4 px-8 rounded-2xl transition-all duration-500 transform hover:scale-105 shadow-lg hover:shadow-2xl focus:outline-none focus:ring-4 focus:ring-purple-500/50"
                                            :disabled="isSubmitting"
                                            :class="{ 'opacity-75 cursor-not-allowed': isSubmitting }">
                                        <div class="absolute inset-0 bg-white/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                        <div class="relative z-10 flex items-center">
                                            <template x-if="!isSubmitting">
                                                <div class="flex items-center">
                                                    <i class="fas fa-save mr-3 text-xl group-hover:scale-110 transition-transform duration-300"></i>
                                                    Simpan Peminjaman
                                                </div>
                                            </template>
                                            <template x-if="isSubmitting">
                                                <div class="flex items-center">
                                                    <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                                    </svg>
                                                    Menyimpan...
                                                </div>
                                            </template>
                                        </div>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><!-- Success/Error Messages -->
@if (session('success'))
    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
         class="fixed top-4 right-4 z-50 bg-green-500/90 backdrop-blur-lg text-white p-4 rounded-xl shadow-lg border border-green-400/30">
        <div class="flex items-center">
            <i class="fas fa-check-circle mr-2"></i>
            {{ session('success') }}
        </div>
    </div>
@endif

@if (session('error'))
    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
         class="fixed top-4 right-4 z-50 bg-red-500/90 backdrop-blur-lg text-white p-4 rounded-xl shadow-lg border border-red-400/30">
        <div class="flex items-center">
            <i class="fas fa-exclamation-circle mr-2"></i>
            {{ session('error') }}
        </div>
    </div>
@endif

<script>
document.addEventListener('DOMContentLoaded', function() {
    // KTP File Preview
    const ktpInput = document.getElementById('ktp_peminjam');
    const dropZone = ktpInput.closest('.border-dashed');
    
    ktpInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                // Create preview
                const preview = document.createElement('div');
                preview.className = 'mt-4 p-4 bg-white/30 rounded-lg backdrop-blur-sm';
                preview.innerHTML = `
                    <div class="flex items-center space-x-3">
                        <img src="${e.target.result}" class="w-16 h-16 object-cover rounded-lg shadow-md">
                        <div>
                            <p class="font-medium text-gray-800">${file.name}</p>
                            <p class="text-sm text-gray-600">${(file.size / 1024 / 1024).toFixed(2)} MB</p>
                        </div>
                        <button type="button" onclick="this.closest('.mt-4').remove(); ktpInput.value=''" 
                                class="ml-auto text-red-500 hover:text-red-700">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                `;
                
                // Remove existing preview
                const existingPreview = dropZone.querySelector('.mt-4');
                if (existingPreview) {
                    existingPreview.remove();
                }
                
                dropZone.appendChild(preview);
            };
            reader.readAsDataURL(file);
        }
    });

    // Date validation
    const startDate = document.getElementById('mulai');
    const endDate = document.getElementById('selesai');
    
    if (startDate && endDate) {
        // Set minimum date to today
        const today = new Date().toISOString().split('T')[0];
        startDate.min = today;
        
        startDate.addEventListener('change', function() {
            if (this.value) {
                endDate.min = this.value;
                if (endDate.value && endDate.value < this.value) {
                    endDate.value = '';
                }
            }
        });
        
        endDate.addEventListener('change', function() {
            if (this.value && startDate.value && this.value < startDate.value) {
                alert('Tanggal selesai tidak boleh lebih awal dari tanggal mulai');
                this.value = '';
            }
        });
    }

    // Form submission handling
    const form = document.querySelector('form');
    if (form) {
        form.addEventListener('submit', function(e) {
            // Add smooth transition for form submission
            setTimeout(() => {
                form.style.opacity = '0.7';
                form.style.pointerEvents = 'none';
            }, 100);
        });
    }

    // Auto-hide alerts
    const alerts = document.querySelectorAll('[x-data*="show: true"]');
    alerts.forEach(alert => {
        setTimeout(() => {
            alert.style.opacity = '0';
            alert.style.transform = 'translateX(100%)';
            setTimeout(() => alert.remove(), 300);
        }, 5000);
    });
});
</script>
@endsection