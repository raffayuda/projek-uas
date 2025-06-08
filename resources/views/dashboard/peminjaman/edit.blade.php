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
                                Edit Peminjaman
                            </h1>
                            <p class="text-gray-600 mt-2">Perbarui informasi peminjaman armada</p>
                        </div>
                        <a href="{{ route('peminjaman.index') }}" 
                           class="bg-gradient-to-r from-gray-500 to-gray-600 hover:from-gray-600 hover:to-gray-700 text-white font-semibold py-3 px-6 rounded-2xl transition-all duration-300 transform hover:scale-105 hover:shadow-lg flex items-center space-x-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            <span>Kembali</span>
                        </a>
                    </div>
                </div>
            </div>            <!-- Main Form Container with Enhanced Design -->
            <div class="bg-white/60 backdrop-blur-md border border-white/30 rounded-3xl shadow-xl overflow-hidden relative">
                <!-- Animated Background Pattern -->
                <div class="absolute inset-0 opacity-5">
                    <div class="absolute inset-0 bg-gradient-to-r from-blue-400 via-purple-500 to-pink-500 animate-pulse"></div>
                </div>
                
                <!-- Progress Bar -->
                <div class="h-1 bg-gradient-to-r from-blue-500 via-purple-500 to-pink-500 animate-pulse"></div>
                
                <div class="p-8 relative z-10">
                    <!-- Form Progress Indicator -->
                    <div class="flex justify-center mb-8">
                        <div class="flex space-x-4">
                            <div class="flex items-center space-x-2">
                                <div class="w-8 h-8 bg-gradient-to-r from-blue-500 to-blue-600 rounded-full flex items-center justify-center text-white text-sm font-bold">1</div>
                                <span class="text-sm font-medium text-gray-700">Data Peminjam</span>
                            </div>
                            <div class="flex items-center">
                                <div class="w-16 h-0.5 bg-gradient-to-r from-blue-500 to-purple-500"></div>
                            </div>
                            <div class="flex items-center space-x-2">
                                <div class="w-8 h-8 bg-gradient-to-r from-purple-500 to-purple-600 rounded-full flex items-center justify-center text-white text-sm font-bold">2</div>
                                <span class="text-sm font-medium text-gray-700">Detail Peminjaman</span>
                            </div>
                        </div>
                    </div>

                    <form action="{{ route('peminjaman.update', $peminjaman) }}" method="POST" enctype="multipart/form-data" 
                          class="space-y-8" x-data="{ 
                              selectedArmadaId: '{{ $peminjaman->armada_id }}',
                              selectedArmada: {
                                  id: {{ $peminjaman->armada_id }},
                                  harga: {{ $peminjaman->armada->harga }}
                              },
                              startDate: '{{ $peminjaman->mulai->format('Y-m-d') }}',
                              endDate: '{{ $peminjaman->selesai->format('Y-m-d') }}',
                              isSubmitting: false,
                              formProgress: 0,
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
                              },                              updateProgress() {
                                  const inputs = this.$el.querySelectorAll('input[required], select[required], textarea[required]');
                                  const filled = Array.from(inputs).filter(input => input.value.trim() !== '').length;
                                  this.formProgress = Math.round((filled / inputs.length) * 100);
                              }
                          }" 
                          @input="updateProgress()"
                          x-init="updateProgress()">
                        @csrf
                        @method('PUT')
                        
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                            <!-- Data Peminjam Section with Enhanced Design -->
                            <div class="bg-gradient-to-br from-blue-50/50 to-indigo-50/50 backdrop-blur-sm rounded-2xl p-6 border border-blue-200/30 form-section floating" style="animation-delay: 0.1s;">
                                <div class="flex items-center mb-6">
                                    <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center mr-4 shadow-lg">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="text-xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">Data Peminjam</h3>
                                        <p class="text-sm text-gray-600">Informasi identitas peminjam</p>
                                    </div>
                                </div>
                                
                                <div class="space-y-6">                                    <div class="relative">
                                        <label for="nama_peminjam" class="text-sm font-semibold text-gray-700 mb-2 flex items-center">
                                            <svg class="w-4 h-4 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                            </svg>
                                            Nama Lengkap
                                        </label>
                                        <input type="text" name="nama_peminjam" id="nama_peminjam" 
                                               class="w-full px-4 py-3 rounded-xl border-0 bg-white/90 backdrop-blur-sm shadow-inner focus:outline-none focus:ring-2 focus:ring-blue-500/50 transition-all duration-300 modern-input"
                                               value="{{ old('nama_peminjam', $peminjaman->nama_peminjam) }}" 
                                               placeholder="Masukkan nama lengkap"
                                               required>
                                        @error('nama_peminjam')
                                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                                </svg>
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>

                                    <div class="relative">
                                        <label for="phone" class="text-sm font-semibold text-gray-700 mb-2 flex items-center">
                                            <svg class="w-4 h-4 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                            </svg>
                                            Nomor Telepon
                                        </label>
                                        <input type="tel" name="phone" id="phone" 
                                               class="w-full px-4 py-3 rounded-xl border-0 bg-white/90 backdrop-blur-sm shadow-inner focus:outline-none focus:ring-2 focus:ring-blue-500/50 transition-all duration-300 modern-input"
                                               value="{{ old('phone', $peminjaman->phone) }}" 
                                               placeholder="08xx-xxxx-xxxx"
                                               required>
                                        @error('phone')
                                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                                </svg>
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>

                                    <div class="relative">
                                        <label for="ktp_peminjam" class="text-sm font-semibold text-gray-700 mb-2 flex items-center">
                                            <svg class="w-4 h-4 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4V2a1 1 0 011-1h8a1 1 0 011 1v2h4a1 1 0 011 1v4a1 1 0 01-1 1h-4v10a1 1 0 01-1 1H8a1 1 0 01-1-1V10H3a1 1 0 01-1-1V5a1 1 0 011-1h4z"></path>
                                            </svg>
                                            Foto KTP
                                        </label>
                                        @if($peminjaman->ktp_peminjam)
                                            <div class="mb-4 relative group">
                                                <img src="{{ Storage::url('uploads/ktp/' . $peminjaman->ktp_peminjam) }}" 
                                                     alt="KTP Saat Ini" 
                                                     class="h-32 w-auto border-2 border-white rounded-xl shadow-lg transition-transform duration-300 group-hover:scale-105">
                                                <div class="absolute inset-0 bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-xl flex items-center justify-center">
                                                    <span class="text-white text-sm font-medium">KTP Saat Ini</span>
                                                </div>
                                                <p class="text-xs text-gray-500 mt-2">KTP saat ini (kosongkan jika tidak ingin mengubah)</p>
                                            </div>
                                        @endif
                                        <div class="border-2 border-dashed border-gray-300 rounded-xl p-6 text-center bg-white/60 backdrop-blur-sm hover:bg-white/80 transition-all duration-300 upload-area" 
                                             ondrop="handleDrop(event)" ondragover="event.preventDefault()" ondragenter="event.preventDefault()">
                                            <svg class="mx-auto h-12 w-12 text-gray-400 mb-3" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                            <label for="ktp_peminjam" class="cursor-pointer">
                                                <span class="bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent font-semibold">{{ $peminjaman->ktp_peminjam ? 'Ganti file' : 'Upload file' }}</span>
                                                <span class="text-gray-600"> atau drag and drop</span>
                                                <input id="ktp_peminjam" name="ktp_peminjam" type="file" class="sr-only" accept="image/*">
                                            </label>
                                            <p class="text-xs text-gray-500 mt-1">PNG, JPG, JPEG sampai 2MB</p>
                                        </div>
                                        @error('ktp_peminjam')
                                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                                </svg>
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Detail Peminjaman Section -->
                            <div class="bg-gradient-to-br from-purple-50/50 to-pink-50/50 backdrop-blur-sm rounded-2xl p-6 border border-purple-200/30">
                                <div class="flex items-center mb-6">
                                    <div class="w-10 h-10 bg-gradient-to-r from-purple-500 to-pink-600 rounded-xl flex items-center justify-center mr-3">
                                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                        </svg>
                                    </div>
                                    <h3 class="text-xl font-bold bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent">Detail Peminjaman</h3>
                                </div>

                                <div class="space-y-6">
                                    <div>
                                        <label for="armada_id" class="block text-sm font-semibold text-gray-700 mb-2">Pilih Armada</label>
                                        <select name="armada_id" id="armada_id" 
                                                class="w-full px-4 py-3 rounded-xl border-0 bg-white/80 backdrop-blur-sm shadow-inner focus:outline-none focus:ring-2 focus:ring-purple-500/50 transition-all duration-200"
                                                x-model="selectedArmadaId"
                                                @change="selectedArmada = { id: $event.target.value, harga: parseInt($event.target.options[$event.target.selectedIndex].dataset.harga || 0) }"
                                                required>
                                            <option value="">Pilih Armada</option>
                                            @foreach($armadas as $armada)
                                                <option value="{{ $armada->id }}" 
                                                        data-harga="{{ $armada->harga }}"
                                                        {{ old('armada_id', $peminjaman->armada_id) == $armada->id ? 'selected' : '' }}>
                                                    {{ $armada->merk }} - {{ $armada->nopol }} (Rp {{ number_format($armada->harga, 0, ',', '.') }}/hari)
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('armada_id')
                                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="grid grid-cols-2 gap-4">
                                        <div>
                                            <label for="mulai" class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Mulai</label>                                            <input type="date" name="mulai" id="mulai" 
                                                   class="w-full px-4 py-3 rounded-xl border-0 bg-white/80 backdrop-blur-sm shadow-inner focus:outline-none focus:ring-2 focus:ring-purple-500/50 transition-all duration-200"
                                                   x-model="startDate"
                                                   value="{{ old('mulai', $peminjaman->mulai ? $peminjaman->mulai->format('Y-m-d') : '') }}" required>
                                            @error('mulai')
                                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div>
                                            <label for="selesai" class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Selesai</label>                                            <input type="date" name="selesai" id="selesai" 
                                                   class="w-full px-4 py-3 rounded-xl border-0 bg-white/80 backdrop-blur-sm shadow-inner focus:outline-none focus:ring-2 focus:ring-purple-500/50 transition-all duration-200"
                                                   x-model="endDate"
                                                   value="{{ old('selesai', $peminjaman->selesai ? $peminjaman->selesai->format('Y-m-d') : '') }}" required>
                                            @error('selesai')
                                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-2 gap-4">
                                        <div>
                                            <label for="pengambilan_id" class="block text-sm font-semibold text-gray-700 mb-2">Lokasi Pengambilan</label>
                                            <select name="pengambilan_id" id="pengambilan_id" 
                                                    class="w-full px-4 py-3 rounded-xl border-0 bg-white/80 backdrop-blur-sm shadow-inner focus:outline-none focus:ring-2 focus:ring-purple-500/50 transition-all duration-200"
                                                    required>
                                                <option value="">Pilih Lokasi</option>
                                                @foreach($lokasis as $lokasi)
                                                    <option value="{{ $lokasi->id }}" 
                                                        {{ old('pengambilan_id', $peminjaman->pengambilan_id) == $lokasi->id ? 'selected' : '' }}>
                                                        {{ $lokasi->nama }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('pengambilan_id')
                                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div>
                                            <label for="pengembalian_id" class="block text-sm font-semibold text-gray-700 mb-2">Lokasi Pengembalian</label>
                                            <select name="pengembalian_id" id="pengembalian_id" 
                                                    class="w-full px-4 py-3 rounded-xl border-0 bg-white/80 backdrop-blur-sm shadow-inner focus:outline-none focus:ring-2 focus:ring-purple-500/50 transition-all duration-200"
                                                    required>
                                                <option value="">Pilih Lokasi</option>
                                                @foreach($lokasis as $lokasi)
                                                    <option value="{{ $lokasi->id }}" 
                                                        {{ old('pengembalian_id', $peminjaman->pengembalian_id) == $lokasi->id ? 'selected' : '' }}>
                                                        {{ $lokasi->nama }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('pengembalian_id')
                                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-2 gap-4">
                                        <div>
                                            <label for="waktu_pengambilan" class="block text-sm font-semibold text-gray-700 mb-2">Waktu Pengambilan</label>
                                            <input type="time" name="waktu_pengambilan" id="waktu_pengambilan" 
                                                   class="w-full px-4 py-3 rounded-xl border-0 bg-white/80 backdrop-blur-sm shadow-inner focus:outline-none focus:ring-2 focus:ring-purple-500/50 transition-all duration-200"
                                                   value="{{ old('waktu_pengambilan', $peminjaman->waktu_pengambilan) }}" required>
                                            @error('waktu_pengambilan')
                                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div>
                                            <label for="waktu_pengembalian" class="block text-sm font-semibold text-gray-700 mb-2">Waktu Pengembalian</label>
                                            <input type="time" name="waktu_pengembalian" id="waktu_pengembalian" 
                                                   class="w-full px-4 py-3 rounded-xl border-0 bg-white/80 backdrop-blur-sm shadow-inner focus:outline-none focus:ring-2 focus:ring-purple-500/50 transition-all duration-200"
                                                   value="{{ old('waktu_pengembalian', $peminjaman->waktu_pengembalian) }}" required>
                                            @error('waktu_pengembalian')
                                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div>
                                        <label for="keperluan_pinjam" class="block text-sm font-semibold text-gray-700 mb-2">Keperluan Peminjaman</label>
                                        <textarea name="keperluan_pinjam" id="keperluan_pinjam" rows="3" 
                                                  class="w-full px-4 py-3 rounded-xl border-0 bg-white/80 backdrop-blur-sm shadow-inner focus:outline-none focus:ring-2 focus:ring-purple-500/50 transition-all duration-200 resize-none"
                                                  required>{{ old('keperluan_pinjam', $peminjaman->keperluan_pinjam) }}</textarea>
                                        @error('keperluan_pinjam')
                                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>                                    <div>
                                        <label for="status_pinjam" class="text-sm font-semibold text-gray-700 mb-2 flex items-center">
                                            <svg class="w-4 h-4 mr-2 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            Status Peminjaman
                                        </label>                                        <select name="status_pinjam" id="status_pinjam" 
                                                class="w-full px-4 py-3 rounded-xl border-0 bg-white/90 backdrop-blur-sm shadow-inner focus:outline-none focus:ring-2 focus:ring-purple-500/50 transition-all duration-300 modern-input"
                                                required>
                                            <option value="Pending" {{ old('status_pinjam', $peminjaman->status_pinjam) == 'Pending' ? 'selected' : '' }}>🟡 Pending - Menunggu Persetujuan</option>
                                            <option value="Dipinjam" {{ old('status_pinjam', $peminjaman->status_pinjam) == 'Dipinjam' ? 'selected' : '' }}>🔵 Dipinjam - Sedang Dipinjam</option>
                                            <option value="Selesai" {{ old('status_pinjam', $peminjaman->status_pinjam) == 'Selesai' ? 'selected' : '' }}>🟢 Selesai - Peminjaman Selesai</option>
                                            <option value="Dibatalkan" {{ old('status_pinjam', $peminjaman->status_pinjam) == 'Dibatalkan' ? 'selected' : '' }}>🔴 Dibatalkan - Peminjaman Dibatalkan</option>
                                        </select>
                                        @error('status_pinjam')
                                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                                </svg>
                                                {{ $message }}
                                            </p>
                                        @enderror
                                        
                                        <!-- Status Preview -->
                                        <div class="mt-3" x-show="$('#status_pinjam').val()">
                                            <div class="flex items-center space-x-2">
                                                <span class="text-xs text-gray-500">Preview Status:</span>                                                <span x-text="document.getElementById('status_pinjam').options[document.getElementById('status_pinjam').selectedIndex]?.text" 
                                                      class="status-badge"
                                                      :class="{
                                                          'status-pending': document.getElementById('status_pinjam').value === 'Pending',
                                                          'status-approved': document.getElementById('status_pinjam').value === 'Dipinjam',
                                                          'status-finished': document.getElementById('status_pinjam').value === 'Selesai',
                                                          'status-rejected': document.getElementById('status_pinjam').value === 'Dibatalkan'
                                                      }"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>                        <!-- Enhanced Total Biaya Section -->
                        <div class="cost-display rounded-2xl p-6 border border-blue-200/30 relative overflow-hidden">
                            <div class="relative z-10">
                                <div class="flex justify-between items-start mb-4">
                                    <div>
                                        <div class="flex items-center mb-2">
                                            <svg class="w-6 h-6 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                            </svg>
                                            <h4 class="text-xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
                                                Ringkasan Biaya
                                            </h4>
                                        </div>
                                        <div class="space-y-2 text-sm text-gray-600">
                                            <div class="flex items-center">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                </svg>
                                                <span x-text="'Durasi: ' + Math.max(1, Math.ceil((new Date(endDate) - new Date(startDate)) / (1000 * 60 * 60 * 24))) + ' hari'"></span>
                                            </div>
                                            <div class="flex items-center" x-show="selectedArmada.harga">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                                </svg>
                                                <span x-text="'Harga per hari: Rp ' + (selectedArmada.harga || 0).toLocaleString('id-ID')"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <div class="text-4xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent pulse-glow" 
                                             x-text="'Rp ' + calculateTotal().toLocaleString('id-ID')"></div>
                                        <div class="text-sm text-gray-500 mt-1">Total Pembayaran</div>
                                    </div>
                                </div>
                                
                                <!-- Progress Bar for Form Completion -->
                                <div class="mt-4 pt-4 border-t border-gray-200/50">
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="text-sm font-medium text-gray-700">Form Progress</span>
                                        <span class="text-sm text-gray-500" x-text="formProgress + '%'"></span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2">
                                        <div class="bg-gradient-to-r from-blue-500 to-purple-500 h-2 rounded-full transition-all duration-500" 
                                             :style="'width: ' + formProgress + '%'"></div>
                                    </div>
                                </div>
                            </div>
                        </div>                        <!-- Enhanced Action Buttons -->
                        <div class="flex flex-col sm:flex-row justify-end space-y-3 sm:space-y-0 sm:space-x-4 pt-6">
                            <a href="{{ route('peminjaman.index') }}" 
                               class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold py-3 px-6 rounded-2xl transition-all duration-300 border border-gray-300/50 flex items-center justify-center space-x-2 hover:shadow-lg">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                                <span>Batal</span>
                            </a>                            <button type="submit" 
                                    class="modern-button bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white font-semibold py-3 px-8 rounded-2xl transition-all duration-300 transform hover:scale-105 hover:shadow-xl flex items-center justify-center space-x-2 relative overflow-hidden"
                                    :disabled="isSubmitting">
                                <div x-show="!isSubmitting" class="flex items-center space-x-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3-3m0 0l-3 3m3-3v12"></path>
                                    </svg>
                                    <span>Update Peminjaman</span>
                                </div>
                                <div x-show="isSubmitting" class="flex items-center space-x-2">
                                    <div class="loading-spinner"></div>
                                    <span>Updating...</span>
                                </div>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script>
    // Initialize enhanced date pickers
    flatpickr("#mulai", {
        dateFormat: "Y-m-d",
        altInput: true,
        altFormat: "d F Y",
        locale: "id",
        theme: "material_blue",
        minDate: "today",
        onChange: function(selectedDates, dateStr, instance) {
            // Auto-update minimum date for end date
            const selesaiPicker = document.querySelector("#selesai")._flatpickr;
            selesaiPicker.set('minDate', dateStr);
        }
    });

    flatpickr("#selesai", {
        dateFormat: "Y-m-d",
        altInput: true,
        altFormat: "d F Y", 
        locale: "id",
        theme: "material_blue",
        minDate: "today"
    });

    // Enhanced file upload with drag & drop
    function handleDrop(e) {
        e.preventDefault();
        const files = e.dataTransfer.files;
        if (files.length > 0) {
            const file = files[0];
            if (file.type.startsWith('image/')) {
                document.getElementById('ktp_peminjam').files = files;
                previewFile(file);
            } else {
                showNotification('Hanya file gambar yang diperbolehkan!', 'error');
            }
        }
    }

    // File preview function
    function previewFile(file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const container = document.querySelector('.upload-area');
            let preview = container.querySelector('.preview-image');
            
            if (!preview) {
                preview = document.createElement('img');
                preview.className = 'preview-image h-32 w-auto border-2 border-white rounded-xl shadow-lg mt-4 transition-all duration-300';
                container.appendChild(preview);
            }
            
            preview.src = e.target.result;
            preview.style.opacity = '0';
            setTimeout(() => preview.style.opacity = '1', 100);
        };
        reader.readAsDataURL(file);
    }

    // Enhanced file input change handler
    document.getElementById('ktp_peminjam').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            // Validate file size (2MB)
            if (file.size > 2 * 1024 * 1024) {
                showNotification('File terlalu besar! Maksimal 2MB', 'error');
                this.value = '';
                return;
            }
            previewFile(file);
        }
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
    }    // Enhanced form submission with loading state
    document.querySelector('form').addEventListener('submit', function(e) {
        // Show loading state immediately
        showNotification('Memproses update peminjaman...', 'info');
    });

    // Auto-save draft functionality (optional)
    let autoSaveTimer;
    function autoSaveDraft() {
        clearTimeout(autoSaveTimer);
        autoSaveTimer = setTimeout(() => {
            const formData = new FormData(document.querySelector('form'));
            // You can implement auto-save to localStorage or server here
            console.log('Auto-saving draft...');
        }, 2000);
    }

    // Add input listeners for auto-save
    document.querySelectorAll('input, select, textarea').forEach(element => {
        element.addEventListener('input', autoSaveDraft);
    });

    // Keyboard shortcuts
    document.addEventListener('keydown', function(e) {
        // Ctrl/Cmd + S to save
        if ((e.ctrlKey || e.metaKey) && e.key === 's') {
            e.preventDefault();
            document.querySelector('button[type="submit"]').click();
        }
        
        // Escape to cancel
        if (e.key === 'Escape') {
            window.location.href = '{{ route("peminjaman.index") }}';
        }
    });

    // Add smooth scrolling to errors
    if (document.querySelector('.text-red-600')) {
        document.querySelector('.text-red-600').scrollIntoView({ 
            behavior: 'smooth', 
            block: 'center' 
        });
    }

    // Initialize tooltips for better UX
    function initTooltips() {
        const tooltipElements = document.querySelectorAll('[title]');
        tooltipElements.forEach(element => {
            element.addEventListener('mouseenter', function() {
                const tooltip = document.createElement('div');
                tooltip.className = 'absolute bg-gray-800 text-white text-xs rounded px-2 py-1 z-50 opacity-0 transition-opacity duration-200';
                tooltip.textContent = this.title;
                this.title = '';
                
                document.body.appendChild(tooltip);
                
                const rect = this.getBoundingClientRect();
                tooltip.style.left = rect.left + 'px';
                tooltip.style.top = (rect.top - tooltip.offsetHeight - 5) + 'px';
                
                setTimeout(() => tooltip.style.opacity = '1', 100);
                
                this.addEventListener('mouseleave', function() {
                    tooltip.style.opacity = '0';
                    setTimeout(() => tooltip.remove(), 200);
                }, { once: true });
            });
        });
    }

    // Initialize on page load
    document.addEventListener('DOMContentLoaded', initTooltips);
</script>
@endpush