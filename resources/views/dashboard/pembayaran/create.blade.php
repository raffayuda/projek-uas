@extends('dashboard.layout.index')
@section('content')
<div class="min-h-screen bg-gradient-to-br from-purple-50 via-blue-50 to-indigo-100 py-8">
    <div class="max-w-4xl mx-auto px-4">
        <!-- Header Section -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-r from-purple-500 to-indigo-600 rounded-full mb-4">
                <i class="fas fa-credit-card text-white text-2xl"></i>
            </div>
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Pembayaran Baru</h1>
            <p class="text-gray-600">Proses pembayaran sewa kendaraan dengan mudah</p>
        </div>

        <div class="bg-white shadow-2xl rounded-3xl overflow-hidden">
            <!-- Progress Steps -->
            <div class="bg-gradient-to-r from-purple-500 to-indigo-600 px-8 py-6">
                <div class="flex items-center justify-between text-white">
                    <div class="flex items-center space-x-2">
                        <div class="w-8 h-8 bg-white bg-opacity-30 rounded-full flex items-center justify-center">
                            <span class="text-sm font-semibold">1</span>
                        </div>
                        <span class="font-medium">Detail Pembayaran</span>
                    </div>
                    <div class="hidden md:flex items-center space-x-2 opacity-50">
                        <div class="w-8 h-8 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                            <span class="text-sm">2</span>
                        </div>
                        <span class="text-sm">Konfirmasi</span>
                    </div>
                </div>
            </div>

            <form action="{{ route('pembayaran.store') }}" method="POST" 
                  x-data="{
                    biaya: '{{ old('jumlah_bayar', isset($selectedPeminjaman) && $selectedPeminjaman ? ($peminjamans->where('id', $selectedPeminjaman)->first()->biaya ?? '') : '') }}',
                    metode: 'Transfer',
                    showQris: false
                  }" class="p-8">
                @csrf
                
                <div class="grid md:grid-cols-2 gap-8">
                    <!-- Left Column -->
                    <div class="space-y-6">
                        <!-- Date Input -->
                        <div class="group">
                            <label class="block text-sm font-semibold text-gray-700 mb-2 flex items-center">
                                <i class="fas fa-calendar-alt text-purple-500 mr-2"></i>
                                Tanggal Pembayaran
                            </label>
                            <div class="relative">
                                <input type="date" name="tanggal" 
                                       class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 focus:border-purple-500 focus:ring-0 transition-colors duration-200 bg-gray-50 focus:bg-white" 
                                       required>
                            </div>
                        </div>

                        <!-- Loan Selection -->
                        <div class="group">
                            <label class="block text-sm font-semibold text-gray-700 mb-2 flex items-center">
                                <i class="fas fa-car text-purple-500 mr-2"></i>
                                Pilih Peminjaman
                            </label>
                            <select name="peminjaman_id" 
                                    class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 focus:border-purple-500 focus:ring-0 transition-colors duration-200 bg-gray-50 focus:bg-white"
                                    @change="biaya = $event.target.options[$event.target.selectedIndex].dataset.biaya"
                                    required>
                                <option value="">-- Pilih Peminjaman --</option>
                                @foreach($peminjamans as $peminjaman)
                                    <option value="{{ $peminjaman->id }}"
                                            data-biaya="{{ $peminjaman->biaya }}"
                                            {{ (old('peminjaman_id', $selectedPeminjaman ?? '') == $peminjaman->id) ? 'selected' : '' }}>
                                        #{{ $peminjaman->id }} - {{ $peminjaman->nama_peminjam }} ({{ $peminjaman->armada->merk ?? '-' }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Amount -->
                        <div class="group">
                            <label class="block text-sm font-semibold text-gray-700 mb-2 flex items-center">
                                <i class="fas fa-money-bill-wave text-purple-500 mr-2"></i>
                                Jumlah Pembayaran
                            </label>
                            <div class="relative">
                                <span class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-500 font-semibold">Rp</span>
                                <input type="number" name="jumlah_bayar" 
                                       class="w-full border-2 border-gray-200 rounded-xl pl-12 pr-4 py-3 focus:border-purple-500 focus:ring-0 transition-colors duration-200 bg-gray-50 focus:bg-white" 
                                       min="0" x-model="biaya" required>
                            </div>
                        </div>

                        <!-- Payment Status -->
                        <div class="group">
                            <label class="block text-sm font-semibold text-gray-700 mb-2 flex items-center">
                                <i class="fas fa-check-circle text-purple-500 mr-2"></i>
                                Status Pembayaran
                            </label>
                            <div class="grid grid-cols-2 gap-3">
                                <label class="relative">
                                    <input type="radio" name="status_pembayaran" value="Lunas" class="sr-only peer" checked>
                                    <div class="bg-gray-50 border-2 border-gray-200 rounded-xl p-3 text-center cursor-pointer peer-checked:bg-green-50 peer-checked:border-green-500 transition-all duration-200">
                                        <i class="fas fa-check text-green-500 mb-1"></i>
                                        <div class="text-sm font-medium">Lunas</div>
                                    </div>
                                </label>
                                <label class="relative">
                                    <input type="radio" name="status_pembayaran" value="Belum Lunas" class="sr-only peer">
                                    <div class="bg-gray-50 border-2 border-gray-200 rounded-xl p-3 text-center cursor-pointer peer-checked:bg-yellow-50 peer-checked:border-yellow-500 transition-all duration-200">
                                        <i class="fas fa-clock text-yellow-500 mb-1"></i>
                                        <div class="text-sm font-medium">Belum Lunas</div>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div class="space-y-6">
                        <!-- Payment Method -->
                        <div class="group">
                            <label class="block text-sm font-semibold text-gray-700 mb-2 flex items-center">
                                <i class="fas fa-wallet text-purple-500 mr-2"></i>
                                Metode Pembayaran
                            </label>
                            <div class="space-y-3">
                                <label class="relative">
                                    <input type="radio" name="metode_pembayaran" value="Transfer" class="sr-only peer" x-model="metode">
                                    <div class="bg-gray-50 border-2 border-gray-200 rounded-xl p-4 cursor-pointer peer-checked:bg-blue-50 peer-checked:border-blue-500 transition-all duration-200 flex items-center">
                                        <i class="fas fa-university text-blue-500 mr-3"></i>
                                        <div>
                                            <div class="font-medium">Transfer Bank</div>
                                            <div class="text-xs text-gray-500">Transfer melalui rekening bank</div>
                                        </div>
                                    </div>
                                </label>
                                <label class="relative">
                                    <input type="radio" name="metode_pembayaran" value="Cash" class="sr-only peer" x-model="metode">
                                    <div class="bg-gray-50 border-2 border-gray-200 rounded-xl p-4 cursor-pointer peer-checked:bg-green-50 peer-checked:border-green-500 transition-all duration-200 flex items-center">
                                        <i class="fas fa-money-bills text-green-500 mr-3"></i>
                                        <div>
                                            <div class="font-medium">Tunai</div>
                                            <div class="text-xs text-gray-500">Pembayaran tunai</div>
                                        </div>
                                    </div>
                                </label>
                                <label class="relative">
                                    <input type="radio" name="metode_pembayaran" value="QRIS" class="sr-only peer" x-model="metode">
                                    <div class="bg-gray-50 border-2 border-gray-200 rounded-xl p-4 cursor-pointer peer-checked:bg-purple-50 peer-checked:border-purple-500 transition-all duration-200 flex items-center">
                                        <i class="fas fa-qrcode text-purple-500 mr-3"></i>
                                        <div>
                                            <div class="font-medium">QRIS</div>
                                            <div class="text-xs text-gray-500">Scan untuk bayar</div>
                                        </div>
                                    </div>
                                </label>
                            </div>
                            
                            <!-- QRIS Display -->
                            <template x-if="metode == 'QRIS'">
                                <div class="mt-4 bg-gradient-to-br from-purple-50 to-indigo-50 rounded-xl p-6 text-center border border-purple-200" x-transition>
                                    <div class="bg-white rounded-lg p-4 inline-block shadow-lg">
                                        <img src="{{ asset('images/qr.jpg') }}" alt="QRIS" class="h-40 mx-auto rounded">
                                    </div>
                                    <div class="mt-3">
                                        <div class="text-sm font-semibold text-purple-700">Scan QRIS untuk pembayaran</div>
                                        <div class="text-xs text-gray-500 mt-1">Gunakan aplikasi mobile banking atau e-wallet</div>
                                    </div>
                                </div>
                            </template>
                        </div>

                        <!-- Notes -->
                        <div class="group">
                            <label class="block text-sm font-semibold text-gray-700 mb-2 flex items-center">
                                <i class="fas fa-sticky-note text-purple-500 mr-2"></i>
                                Catatan
                            </label>
                            <textarea name="keterangan" 
                                      class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 focus:border-purple-500 focus:ring-0 transition-colors duration-200 bg-gray-50 focus:bg-white resize-none" 
                                      rows="4" 
                                      placeholder="Tambahkan catatan pembayaran (opsional)"></textarea>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="mt-8 pt-6 border-t border-gray-200">
                    <div class="flex flex-col sm:flex-row gap-4 justify-end">
                        <button type="button" onclick="history.back()" 
                                class="px-6 py-3 border-2 border-gray-300 text-gray-700 font-semibold rounded-xl hover:bg-gray-50 transition-colors duration-200">
                            <i class="fas fa-arrow-left mr-2"></i>Kembali
                        </button>
                        <button type="submit" 
                                class="px-8 py-3 bg-gradient-to-r from-purple-500 to-indigo-600 text-white font-semibold rounded-xl shadow-lg hover:from-purple-600 hover:to-indigo-700 transform hover:scale-105 transition-all duration-200">
                            <i class="fas fa-save mr-2"></i>Simpan Pembayaran
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection