@extends('dashboard.layout.index')
@section('content')
<div class="max-w-xl mx-auto py-8">
    <div class="bg-white shadow-lg rounded-lg p-8">
        <h2 class="text-xl font-bold mb-6 text-indigo-700">Tambah Pembayaran</h2>
        <form action="{{ route('pembayaran.store') }}" method="POST"
              x-data="{
                biaya: '{{ old('jumlah_bayar', isset($selectedPeminjaman) && $selectedPeminjaman ? ($peminjamans->where('id', $selectedPeminjaman)->first()->biaya ?? '') : '') }}'
              }">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Tanggal</label>
                <input type="date" name="tanggal" class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-indigo-200" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Pilih Peminjaman</label>
                <select name="peminjaman_id" class="w-full border rounded-lg px-3 py-2"
                        @change="biaya = $event.target.options[$event.target.selectedIndex].dataset.biaya"
                        required>
                    <option value="">-- Pilih --</option>
                    @foreach($peminjamans as $peminjaman)
                        <option value="{{ $peminjaman->id }}"
                                data-biaya="{{ $peminjaman->biaya }}"
                                {{ (old('peminjaman_id', $selectedPeminjaman ?? '') == $peminjaman->id) ? 'selected' : '' }}>
                            #{{ $peminjaman->id }} - {{ $peminjaman->nama_peminjam }} ({{ $peminjaman->armada->merk ?? '-' }})
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Jumlah Bayar</label>
                <input type="number" name="jumlah_bayar" class="w-full border rounded-lg px-3 py-2" min="0" x-model="biaya" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Status Pembayaran</label>
                <select name="status_pembayaran" class="w-full border rounded-lg px-3 py-2" required>
                    <option value="Lunas">Lunas</option>
                    <option value="Belum Lunas">Belum Lunas</option>
                </select>
            </div>
            <div class="mb-4" x-data="{ metode: 'Transfer' }">
                <label class="block text-gray-700 font-semibold mb-2">Metode Pembayaran</label>
                <select name="metode_pembayaran" class="w-full border rounded-lg px-3 py-2" x-model="metode" required>
                    <option value="Transfer">Transfer</option>
                    <option value="Cash">Cash</option>
                    <option value="QRIS">QRIS</option>
                </select>
                <template x-if="metode == 'QRIS'">
                    <div class="mt-2">
                        <img src="{{ asset('img/qris-sample.png') }}" alt="QRIS" class="h-32 mx-auto rounded shadow">
                        <div class="text-xs text-gray-500 text-center mt-1">Scan QRIS untuk pembayaran</div>
                    </div>
                </template>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Keterangan</label>
                <textarea name="keterangan" class="w-full border rounded-lg px-3 py-2"></textarea>
            </div>
            <div class="flex justify-end">
                <button type="submit" class="bg-gradient-to-r from-indigo-500 to-blue-500 text-white font-bold px-6 py-2 rounded-lg shadow-lg hover:from-blue-500 hover:to-indigo-500 transition transform hover:scale-105">
                    <i class="fas fa-save mr-2"></i>Simpan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection 