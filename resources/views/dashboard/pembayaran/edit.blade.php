@extends('dashboard.layout.index')
@section('content')
<div class="min-h-screen bg-gradient-to-br from-purple-50 via-blue-50 to-indigo-100 py-8">
    <div class="max-w-4xl mx-auto px-4">
        <!-- Header Section -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-full mb-4">
                <i class="fas fa-edit text-white text-2xl"></i>
            </div>
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Edit Pembayaran</h1>
            <p class="text-gray-600">Perbarui informasi pembayaran sewa kendaraan</p>
            <div class="flex items-center justify-center mt-4 space-x-2 text-sm text-gray-500">
                <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full font-medium">
                    ID: #{{ $pembayaran->id }}
                </span>
                <span class="bg-gray-100 text-gray-800 px-3 py-1 rounded-full font-medium">
                    {{ $pembayaran->peminjaman->nama_peminjam }}
                </span>
            </div>
        </div>

        <div class="bg-white shadow-2xl rounded-3xl overflow-hidden">
            <!-- Progress Steps -->
            <div class="bg-gradient-to-r from-indigo-500 to-purple-600 px-8 py-6">
                <div class="flex items-center justify-between text-white">
                    <div class="flex items-center space-x-2">
                        <div class="w-8 h-8 bg-white bg-opacity-30 rounded-full flex items-center justify-center">
                            <i class="fas fa-edit text-sm"></i>
                        </div>
                        <span class="font-medium">Edit Detail Pembayaran</span>
                    </div>
                    <div class="hidden md:flex items-center space-x-2">
                        <div class="flex items-center space-x-1 text-white/80">
                            <i class="fas fa-calendar-alt text-xs"></i>
                            <span class="text-sm">{{ \Carbon\Carbon::parse($pembayaran->tanggal)->format('d M Y') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <form action="{{ route('pembayaran.update', $pembayaran) }}" method="POST" 
                  x-data="{
                    biaya: '{{ old('jumlah_bayar', $pembayaran->jumlah_bayar) }}',
                    metode: '{{ old('metode_pembayaran', $pembayaran->metode_pembayaran) }}',
                    status: '{{ old('status_pembayaran', $pembayaran->status_pembayaran) }}',
                    showQris: {{ old('metode_pembayaran', $pembayaran->metode_pembayaran) === 'QRIS' ? 'true' : 'false' }}
                  }" class="p-8">
                @csrf
                @method('PUT')
                
                <!-- Alert Section -->
                @if($errors->any())
                <div class="mb-6 bg-red-50 border border-red-200 rounded-xl p-4">
                    <div class="flex items-start">
                        <i class="fas fa-exclamation-triangle text-red-500 mt-0.5 mr-3"></i>
                        <div>
                            <h4 class="text-red-800 font-medium mb-2">Terdapat kesalahan:</h4>
                            <ul class="text-red-700 text-sm space-y-1">
                                @foreach($errors->all() as $error)
                                    <li>• {{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                @endif
                
                <div class="grid md:grid-cols-2 gap-8">
                    <!-- Left Column -->
                    <div class="space-y-6">
                        <!-- Date Input -->
                        <div class="group">
                            <label class="block text-sm font-semibold text-gray-700 mb-2 flex items-center">
                                <i class="fas fa-calendar-alt text-indigo-500 mr-2"></i>
                                Tanggal Pembayaran
                            </label>
                            <div class="relative">
                                <input type="date" name="tanggal" 
                                       value="{{ old('tanggal', \Carbon\Carbon::parse($pembayaran->tanggal)->format('Y-m-d')) }}"
                                       class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 focus:border-indigo-500 focus:ring-0 transition-colors duration-200 bg-gray-50 focus:bg-white" 
                                       required>
                                @error('tanggal')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Loan Information (Read-only) -->
                        <div class="group">
                            <label class="block text-sm font-semibold text-gray-700 mb-2 flex items-center">
                                <i class="fas fa-car text-indigo-500 mr-2"></i>
                                Informasi Peminjaman
                            </label>
                            <div class="bg-gray-50 border-2 border-gray-200 rounded-xl p-4">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <div class="font-medium text-gray-900">
                                            #{{ $pembayaran->peminjaman->id }} - {{ $pembayaran->peminjaman->nama_peminjam }}
                                        </div>
                                        <div class="text-sm text-gray-600">
                                            {{ $pembayaran->peminjaman->armada->merk ?? '-' }} - {{ $pembayaran->peminjaman->armada->nopol ?? '-' }}
                                        </div>
                                        <div class="text-xs text-gray-500 mt-1">
                                            {{ \Carbon\Carbon::parse($pembayaran->peminjaman->tgl_mulai)->format('d M Y') }} - 
                                            {{ \Carbon\Carbon::parse($pembayaran->peminjaman->tgl_selesai)->format('d M Y') }}
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <div class="text-sm font-medium text-gray-900">Total Biaya</div>
                                        <div class="text-lg font-bold text-indigo-600">Rp {{ number_format($pembayaran->peminjaman->biaya, 0, ',', '.') }}</div>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="peminjaman_id" value="{{ $pembayaran->peminjaman_id }}">
                        </div>

                        <!-- Amount -->
                        <div class="group">
                            <label class="block text-sm font-semibold text-gray-700 mb-2 flex items-center">
                                <i class="fas fa-money-bill-wave text-indigo-500 mr-2"></i>
                                Jumlah Pembayaran
                            </label>
                            <div class="relative">
                                <span class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-500 font-semibold">Rp</span>
                                <input type="number" name="jumlah_bayar" 
                                       class="w-full border-2 border-gray-200 rounded-xl pl-12 pr-4 py-3 focus:border-indigo-500 focus:ring-0 transition-colors duration-200 bg-gray-50 focus:bg-white" 
                                       min="0" x-model="biaya" required>
                                @error('jumlah_bayar')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Payment Status -->
                        <div class="group">
                            <label class="block text-sm font-semibold text-gray-700 mb-2 flex items-center">
                                <i class="fas fa-check-circle text-indigo-500 mr-2"></i>
                                Status Pembayaran
                            </label>
                            <div class="grid grid-cols-2 gap-3">
                                <label class="relative">
                                    <input type="radio" name="status_pembayaran" value="Lunas" class="sr-only peer" 
                                           x-model="status" {{ old('status_pembayaran', $pembayaran->status_pembayaran) == 'Lunas' ? 'checked' : '' }}>
                                    <div class="bg-gray-50 border-2 border-gray-200 rounded-xl p-3 text-center cursor-pointer peer-checked:bg-green-50 peer-checked:border-green-500 transition-all duration-200">
                                        <i class="fas fa-check text-green-500 mb-1"></i>
                                        <div class="text-sm font-medium">Lunas</div>
                                    </div>
                                </label>
                                <label class="relative">
                                    <input type="radio" name="status_pembayaran" value="Belum Lunas" class="sr-only peer" 
                                           x-model="status" {{ old('status_pembayaran', $pembayaran->status_pembayaran) == 'Belum Lunas' ? 'checked' : '' }}>
                                    <div class="bg-gray-50 border-2 border-gray-200 rounded-xl p-3 text-center cursor-pointer peer-checked:bg-yellow-50 peer-checked:border-yellow-500 transition-all duration-200">
                                        <i class="fas fa-clock text-yellow-500 mb-1"></i>
                                        <div class="text-sm font-medium">Belum Lunas</div>
                                    </div>
                                </label>
                            </div>
                            @error('status_pembayaran')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div class="space-y-6">
                        <!-- Payment Method -->
                        <div class="group">
                            <label class="block text-sm font-semibold text-gray-700 mb-2 flex items-center">
                                <i class="fas fa-wallet text-indigo-500 mr-2"></i>
                                Metode Pembayaran
                            </label>
                            <div class="space-y-3">
                                <label class="relative">
                                    <input type="radio" name="metode_pembayaran" value="Transfer" class="sr-only peer" 
                                           x-model="metode" {{ old('metode_pembayaran', $pembayaran->metode_pembayaran) == 'Transfer' ? 'checked' : '' }}>
                                    <div class="bg-gray-50 border-2 border-gray-200 rounded-xl p-4 cursor-pointer peer-checked:bg-blue-50 peer-checked:border-blue-500 transition-all duration-200 flex items-center">
                                        <i class="fas fa-university text-blue-500 mr-3"></i>
                                        <div>
                                            <div class="font-medium">Transfer Bank</div>
                                            <div class="text-xs text-gray-500">Transfer melalui rekening bank</div>
                                        </div>
                                    </div>
                                </label>
                                <label class="relative">
                                    <input type="radio" name="metode_pembayaran" value="Cash" class="sr-only peer" 
                                           x-model="metode" {{ old('metode_pembayaran', $pembayaran->metode_pembayaran) == 'Cash' ? 'checked' : '' }}>
                                    <div class="bg-gray-50 border-2 border-gray-200 rounded-xl p-4 cursor-pointer peer-checked:bg-green-50 peer-checked:border-green-500 transition-all duration-200 flex items-center">
                                        <i class="fas fa-money-bills text-green-500 mr-3"></i>
                                        <div>
                                            <div class="font-medium">Tunai</div>
                                            <div class="text-xs text-gray-500">Pembayaran tunai</div>
                                        </div>
                                    </div>
                                </label>
                                <label class="relative">
                                    <input type="radio" name="metode_pembayaran" value="QRIS" class="sr-only peer" 
                                           x-model="metode" {{ old('metode_pembayaran', $pembayaran->metode_pembayaran) == 'QRIS' ? 'checked' : '' }}>
                                    <div class="bg-gray-50 border-2 border-gray-200 rounded-xl p-4 cursor-pointer peer-checked:bg-purple-50 peer-checked:border-purple-500 transition-all duration-200 flex items-center">
                                        <i class="fas fa-qrcode text-purple-500 mr-3"></i>
                                        <div>
                                            <div class="font-medium">QRIS</div>
                                            <div class="text-xs text-gray-500">Scan untuk bayar</div>
                                        </div>
                                    </div>
                                </label>
                            </div>
                            @error('metode_pembayaran')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            
                            <!-- QRIS Display -->
                            <template x-if="metode == 'QRIS'">
                                <div class="mt-4 bg-gradient-to-br from-purple-50 to-indigo-50 rounded-xl p-6 text-center border border-purple-200" x-transition>
                                    <div class="bg-white rounded-lg p-4 inline-block shadow-lg">
                                        <div class="w-40 h-40 bg-gray-100 rounded flex items-center justify-center">
                                            <i class="fas fa-qrcode text-4xl text-gray-400"></i>
                                        </div>
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
                                <i class="fas fa-sticky-note text-indigo-500 mr-2"></i>
                                Catatan
                            </label>
                            <textarea name="keterangan" 
                                      class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 focus:border-indigo-500 focus:ring-0 transition-colors duration-200 bg-gray-50 focus:bg-white resize-none" 
                                      rows="4" 
                                      placeholder="Tambahkan catatan pembayaran (opsional)">{{ old('keterangan', $pembayaran->keterangan) }}</textarea>
                            @error('keterangan')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Update Information -->
                        <div class="bg-blue-50 border border-blue-200 rounded-xl p-4">
                            <div class="flex items-start">
                                <i class="fas fa-info-circle text-blue-500 mt-0.5 mr-3"></i>
                                <div class="text-sm">
                                    <h4 class="text-blue-800 font-medium mb-1">Informasi Update</h4>
                                    <p class="text-blue-700">
                                        Dibuat: {{ \Carbon\Carbon::parse($pembayaran->created_at)->format('d M Y H:i') }}
                                    </p>
                                    @if($pembayaran->updated_at != $pembayaran->created_at)
                                    <p class="text-blue-700">
                                        Terakhir diupdate: {{ \Carbon\Carbon::parse($pembayaran->updated_at)->format('d M Y H:i') }}
                                    </p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="mt-8 pt-6 border-t border-gray-200">
                    <div class="flex flex-col sm:flex-row gap-4 justify-end">
                        <a href="{{ route('pembayaran.index') }}" 
                           class="px-6 py-3 border-2 border-gray-300 text-gray-700 font-semibold rounded-xl hover:bg-gray-50 transition-colors duration-200 text-center">
                            <i class="fas fa-arrow-left mr-2"></i>Kembali
                        </a>
                        <a href="{{ route('pembayaran.show', $pembayaran) }}" 
                           class="px-6 py-3 border-2 border-blue-300 text-blue-700 font-semibold rounded-xl hover:bg-blue-50 transition-colors duration-200 text-center">
                            <i class="fas fa-eye mr-2"></i>Lihat Detail
                        </a>
                        <button type="submit" 
                                class="px-8 py-3 bg-gradient-to-r from-indigo-500 to-purple-600 text-white font-semibold rounded-xl shadow-lg hover:from-indigo-600 hover:to-purple-700 transform hover:scale-105 transition-all duration-200">
                            <i class="fas fa-save mr-2"></i>Update Pembayaran
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('alpine:init', () => {
    Alpine.data('paymentEdit', () => ({
        init() {
            // Auto-focus first input
            this.$nextTick(() => {
                const firstInput = this.$el.querySelector('input[type="date"]');
                if (firstInput) firstInput.focus();
            });
        }
    }));
});

// Auto-hide success/error messages
document.addEventListener('DOMContentLoaded', function() {
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(alert => {
        setTimeout(() => {
            alert.style.transition = 'opacity 0.5s ease-out';
            alert.style.opacity = '0';
            setTimeout(() => alert.remove(), 500);
        }, 5000);
    });
});
</script>
@endpush
@endsection
