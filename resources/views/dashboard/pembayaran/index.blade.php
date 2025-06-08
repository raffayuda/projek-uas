@extends('dashboard.layout.index')
@section('content')
@if($peminjamans->count())
<div class="mb-8">
    <h3 class="text-lg font-bold text-gray-700 mb-2">Pinjaman Belum Dibayar</h3>
    <div class="bg-yellow-50 border border-yellow-200 rounded-lg shadow p-4 overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead>
                <tr>
                    <th class="px-4 py-2 text-left text-xs font-bold text-gray-600 uppercase">#</th>
                    <th class="px-4 py-2 text-left text-xs font-bold text-gray-600 uppercase">Peminjam</th>
                    <th class="px-4 py-2 text-left text-xs font-bold text-gray-600 uppercase">Armada</th>
                    <th class="px-4 py-2 text-left text-xs font-bold text-gray-600 uppercase">Tanggal</th>
                    <th class="px-4 py-2 text-left text-xs font-bold text-gray-600 uppercase">Biaya</th>
                    <th class="px-4 py-2"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($peminjamans as $peminjaman)
                <tr>
                    <td class="px-4 py-2 text-gray-500">#{{ $peminjaman->id }}</td>
                    <td class="px-4 py-2">
                        <div class="font-semibold text-gray-800">{{ $peminjaman->nama_peminjam }}</div>
                        <div class="text-xs text-gray-500">{{ $peminjaman->phone }}</div>
                    </td>
                    <td class="px-4 py-2">
                        <div class="text-gray-800">{{ $peminjaman->armada->merk ?? '-' }}</div>
                        <div class="text-xs text-gray-500">{{ $peminjaman->armada->nopol ?? '-' }}</div>
                    </td>
                    <td class="px-4 py-2">
                        {{ \Carbon\Carbon::parse($peminjaman->mulai)->format('d M Y') }} - {{ \Carbon\Carbon::parse($peminjaman->selesai)->format('d M Y') }}
                    </td>
                    <td class="px-4 py-2 text-blue-600 font-bold">Rp {{ number_format($peminjaman->biaya, 0, ',', '.') }}</td>
                    <td class="px-4 py-2">
                        <a href="{{ route('pembayaran.create', ['peminjaman_id' => $peminjaman->id]) }}"
                           class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg font-bold shadow transition">
                            Bayar
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endif
<div class="py-8">
    <div class="max-w-7xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Daftar Pembayaran</h2>
            <a href="{{ route('pembayaran.create') }}" class="bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-indigo-600 hover:to-blue-500 text-white font-bold py-2 px-4 rounded-lg shadow-lg transition duration-300 transform hover:scale-105">
                <i class="fas fa-plus mr-2"></i>Tambah Pembayaran
            </a>
        </div>
        <div class="bg-white shadow rounded-lg overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gradient-to-r from-blue-50 to-indigo-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase">#</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase">Tanggal</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase">Peminjam</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase">Jumlah</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($pembayarans as $pembayaran)
                    <tr class="hover:bg-blue-50 transition">
                        <td class="px-6 py-4 text-sm text-gray-500">#{{ $pembayaran->id }}</td>
                        <td class="px-6 py-4 text-sm">{{ \Carbon\Carbon::parse($pembayaran->tanggal)->format('d M Y') }}</td>
                        <td class="px-6 py-4">
                            <div class="font-semibold text-gray-800">{{ $pembayaran->peminjaman->nama_peminjam ?? '-' }}</div>
                            <div class="text-xs text-gray-500">{{ $pembayaran->peminjaman->armada->merk ?? '-' }}</div>
                        </td>
                        <td class="px-6 py-4 text-blue-600 font-bold">Rp {{ number_format($pembayaran->jumlah_bayar, 0, ',', '.') }}</td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold
                                {{ $pembayaran->status_pembayaran == 'Lunas' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                {{ $pembayaran->status_pembayaran }}
                            </span>
                        </td>
                        <td class="px-6 py-4 flex space-x-2">
                            <a href="{{ route('pembayaran.show', $pembayaran) }}" class="text-blue-500 hover:text-blue-700"><i class="fas fa-eye"></i></a>
                            <a href="{{ route('pembayaran.edit', $pembayaran) }}" class="text-indigo-500 hover:text-indigo-700"><i class="fas fa-edit"></i></a>
                            <form action="{{ route('pembayaran.destroy', $pembayaran) }}" method="POST" onsubmit="return confirm('Hapus pembayaran ini?')" class="inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="p-4">
                {{ $pembayarans->links() }}
            </div>
        </div>
    </div>
</div>
@endsection 