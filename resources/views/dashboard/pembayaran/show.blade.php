@extends('dashboard.layout.index')
@section('content')
<div class="max-w-2xl mx-auto py-8">
    <div class="bg-white shadow-lg rounded-lg p-8">
        <h2 class="text-xl font-bold mb-6 text-indigo-700">Detail Pembayaran</h2>
        <div class="mb-4">
            <span class="font-semibold text-gray-700">Tanggal:</span>
            <span>{{ \Carbon\Carbon::parse($pembayaran->tanggal)->format('d M Y') }}</span>
        </div>
        <div class="mb-4">
            <span class="font-semibold text-gray-700">Peminjam:</span>
            <span>{{ $pembayaran->peminjaman->nama_peminjam ?? '-' }}</span>
        </div>
        <div class="mb-4">
            <span class="font-semibold text-gray-700">Jumlah Bayar:</span>
            <span class="text-blue-600 font-bold">Rp {{ number_format($pembayaran->jumlah_bayar, 0, ',', '.') }}</span>
        </div>
        <div class="mb-4">
            <span class="font-semibold text-gray-700">Status:</span>
            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold
                {{ $pembayaran->status_pembayaran == 'Lunas' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                {{ $pembayaran->status_pembayaran }}
            </span>
        </div>
        <div class="mb-4">
            <span class="font-semibold text-gray-700">Metode:</span>
            <span>{{ $pembayaran->metode_pembayaran }}</span>
        </div>
        <div class="mb-4">
            <span class="font-semibold text-gray-700">Keterangan:</span>
            <span>{{ $pembayaran->keterangan ?? '-' }}</span>
        </div>
        <a href="{{ route('pembayaran.index') }}" class="inline-block mt-4 bg-gray-200 hover:bg-gray-300 text-gray-700 font-bold px-4 py-2 rounded-lg transition">Kembali</a>
    </div>
</div>
@endsection 