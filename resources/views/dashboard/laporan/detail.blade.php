@extends('dashboard.layout.index')

@section('title', 'Detail Laporan')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100 py-8" x-data="{
    showFilters: false,
    viewMode: 'table'
}">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header Section -->
        <div class="relative mb-8">
            <div class="absolute inset-0 bg-gradient-to-r from-blue-600 to-purple-600 rounded-3xl opacity-10"></div>
            <div class="relative bg-white/70 backdrop-blur-lg border border-white/20 rounded-3xl p-8 shadow-xl">
                <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-6">
                    <div>
                        <div class="flex items-center space-x-3 mb-2">
                            <a href="{{ route('laporan.index') }}" class="text-blue-600 hover:text-blue-800 transition-colors">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                </svg>
                            </a>
                            <h1 class="text-4xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
                                📋 Detail Laporan Peminjaman
                            </h1>
                        </div>
                        <p class="text-gray-600">Data lengkap dan terfilter dari semua transaksi peminjaman</p>
                    </div>
                    <div class="flex flex-col sm:flex-row gap-3">
                        <button @click="showFilters = !showFilters" 
                                class="bg-gradient-to-r from-indigo-500 to-purple-600 hover:from-indigo-600 hover:to-purple-700 text-white font-semibold py-3 px-6 rounded-2xl transition-all duration-300 transform hover:scale-105 hover:shadow-lg flex items-center space-x-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.707A1 1 0 013 7V4z"></path>
                            </svg>
                            <span>Filter Data</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filter Section -->
        <div x-show="showFilters" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 transform -translate-y-4"
             x-transition:enter-end="opacity-100 transform translate-y-0"
             class="bg-white/80 backdrop-blur-sm rounded-2xl border border-gray-200/50 p-6 shadow-lg mb-8">
            <h3 class="text-lg font-bold text-gray-800 mb-4">🔍 Filter Laporan</h3>
            <form method="GET" action="{{ route('laporan.detail') }}" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Mulai</label>
                    <input type="date" name="start_date" value="{{ request('start_date') }}" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Selesai</label>
                    <input type="date" name="end_date" value="{{ request('end_date') }}" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                    <select name="status" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="">Semua Status</option>
                        <option value="Pending" {{ request('status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                        <option value="Approved" {{ request('status') == 'Approved' ? 'selected' : '' }}>Approved</option>
                        <option value="Finished" {{ request('status') == 'Finished' ? 'selected' : '' }}>Finished</option>
                        <option value="Rejected" {{ request('status') == 'Rejected' ? 'selected' : '' }}>Rejected</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Armada</label>
                    <select name="armada_id" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="">Semua Armada</option>
                        @foreach($armadas as $armada)
                        <option value="{{ $armada->id }}" {{ request('armada_id') == $armada->id ? 'selected' : '' }}>
                            {{ $armada->merk }} - {{ $armada->nopol }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="md:col-span-2 lg:col-span-4 flex justify-end space-x-3">
                    <a href="{{ route('laporan.detail') }}" 
                       class="px-6 py-3 border border-gray-300 text-gray-700 rounded-xl hover:bg-gray-50 transition-colors font-medium">
                        Reset Filter
                    </a>
                    <button type="submit" 
                            class="px-6 py-3 bg-gradient-to-r from-blue-500 to-purple-600 text-white rounded-xl hover:from-blue-600 hover:to-purple-700 transition-all font-medium">
                        Terapkan Filter
                    </button>
                </div>
            </form>
        </div>

        <!-- Results Summary -->
        <div class="bg-white/80 backdrop-blur-sm rounded-2xl border border-gray-200/50 p-6 shadow-lg mb-6">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                <div>
                    <h3 class="text-lg font-bold text-gray-800">📊 Hasil Filter</h3>
                    <p class="text-gray-600">Ditemukan {{ $peminjamans->total() }} transaksi peminjaman</p>
                </div>
                <div class="flex items-center space-x-3">
                    <span class="text-sm text-gray-600">Tampilan:</span>
                    <div class="bg-gray-100 rounded-lg p-1 flex">
                        <button @click="viewMode = 'table'" 
                                :class="viewMode === 'table' ? 'bg-white shadow-sm' : 'hover:bg-gray-200'"
                                class="px-3 py-2 rounded-md text-sm font-medium transition-colors">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                            </svg>
                        </button>
                        <button @click="viewMode = 'cards'" 
                                :class="viewMode === 'cards' ? 'bg-white shadow-sm' : 'hover:bg-gray-200'"
                                class="px-3 py-2 rounded-md text-sm font-medium transition-colors">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Table View -->
        <div x-show="viewMode === 'table'" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             class="bg-white/80 backdrop-blur-sm rounded-2xl border border-gray-200/50 shadow-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gradient-to-r from-gray-50 to-gray-100">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Peminjam</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Armada</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Periode</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Biaya</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Dibuat</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($peminjamans as $peminjaman)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">#{{ $peminjaman->id }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center text-white text-sm font-medium mr-3">
                                        {{ $peminjaman->nama_peminjam ? substr($peminjaman->nama_peminjam, 0, 2) : '??' }}
                                    </div>
                                    <div>
                                        <div class="text-sm font-medium text-gray-900">{{ $peminjaman->nama_peminjam ?? 'N/A' }}</div>
                                        <div class="text-sm text-gray-500">{{ $peminjaman->phone ?? 'N/A' }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $peminjaman->armada ? $peminjaman->armada->merk : 'N/A' }}</div>
                                <div class="text-sm text-gray-500">{{ $peminjaman->armada ? $peminjaman->armada->nopol : 'N/A' }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">
                                    {{ $peminjaman->mulai ? $peminjaman->mulai->format('d M Y') : 'N/A' }} - 
                                    {{ $peminjaman->selesai ? $peminjaman->selesai->format('d M Y') : 'N/A' }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-semibold text-gray-900">Rp {{ number_format($peminjaman->biaya, 0, ',', '.') }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    {{ $peminjaman->status_pinjam == 'Pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                    {{ $peminjaman->status_pinjam == 'Approved' ? 'bg-blue-100 text-blue-800' : '' }}
                                    {{ $peminjaman->status_pinjam == 'Finished' ? 'bg-green-100 text-green-800' : '' }}
                                    {{ $peminjaman->status_pinjam == 'Rejected' ? 'bg-red-100 text-red-800' : '' }}">
                                    {{ $peminjaman->status_pinjam }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $peminjaman->created_at->format('d M Y H:i') }}</div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center">
                                <div class="text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    <h3 class="mt-2 text-lg font-medium text-gray-900">Tidak ada data</h3>
                                    <p class="mt-1 text-gray-500">Tidak ditemukan peminjaman sesuai kriteria filter.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Cards View -->
        <div x-show="viewMode === 'cards'" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($peminjamans as $peminjaman)
            <div class="group bg-gradient-to-br from-white to-gray-50/50 rounded-2xl p-6 border border-gray-200/50 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                <!-- Header -->
                <div class="flex justify-between items-start mb-4">
                    <div class="flex items-center space-x-3">
                        <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-purple-600 rounded-xl flex items-center justify-center text-white font-bold">
                            {{ $peminjaman->nama_peminjam ? substr($peminjaman->nama_peminjam, 0, 2) : '??' }}
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-900">{{ $peminjaman->nama_peminjam ?? 'N/A' }}</h4>
                            <p class="text-sm text-gray-500">#{{ $peminjaman->id }}</p>
                        </div>
                    </div>
                    <span class="px-3 py-1 text-xs font-semibold rounded-full
                        {{ $peminjaman->status_pinjam == 'Pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                        {{ $peminjaman->status_pinjam == 'Approved' ? 'bg-blue-100 text-blue-800' : '' }}
                        {{ $peminjaman->status_pinjam == 'Finished' ? 'bg-green-100 text-green-800' : '' }}
                        {{ $peminjaman->status_pinjam == 'Rejected' ? 'bg-red-100 text-red-800' : '' }}">
                        {{ $peminjaman->status_pinjam }}
                    </span>
                </div>

                <!-- Vehicle Info -->
                <div class="bg-gray-50/80 rounded-xl p-4 mb-4">
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
                            <svg class="w-4 h-4 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z"></path>
                                <path d="M3 4a1 1 0 00-1 1v10a1 1 0 001 1h1.05a2.5 2.5 0 014.9 0H10a1 1 0 001-1V5a1 1 0 00-1-1H3zM14 7a1 1 0 00-1 1v6.05A2.5 2.5 0 0115.95 16H17a1 1 0 001-1V8a1 1 0 00-1-1h-3z"></path>
                            </svg>
                        </div>
                        <div>
                            <h5 class="font-medium text-gray-900">{{ $peminjaman->armada ? $peminjaman->armada->merk : 'N/A' }}</h5>
                            <p class="text-sm text-gray-500">{{ $peminjaman->armada ? $peminjaman->armada->nopol : 'N/A' }}</p>
                        </div>
                    </div>
                </div>

                <!-- Date and Price -->
                <div class="space-y-3 mb-4">
                    <div class="flex items-center text-sm text-gray-600">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        {{ $peminjaman->mulai ? $peminjaman->mulai->format('d M Y') : 'N/A' }} - {{ $peminjaman->selesai ? $peminjaman->selesai->format('d M Y') : 'N/A' }}
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600">Total Biaya:</span>
                        <span class="text-lg font-bold text-blue-600">Rp {{ number_format($peminjaman->biaya, 0, ',', '.') }}</span>
                    </div>
                </div>

                <!-- Created Date -->
                <div class="text-xs text-gray-400 border-t border-gray-200 pt-3">
                    Dibuat: {{ $peminjaman->created_at->format('d M Y H:i') }}
                </div>
            </div>
            @empty
            <div class="col-span-full text-center py-12">
                <div class="text-center">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    <h3 class="mt-2 text-lg font-medium text-gray-900">Tidak ada data</h3>
                    <p class="mt-1 text-gray-500">Tidak ditemukan peminjaman sesuai kriteria filter.</p>
                </div>
            </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($peminjamans->hasPages())
        <div class="mt-8 flex justify-center">
            <div class="bg-white/80 backdrop-blur-sm rounded-2xl border border-gray-200/50 p-2">
                {{ $peminjamans->appends(request()->query())->links() }}
            </div>
        </div>
        @endif
    </div>
</div>

@push('scripts')
<script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
@endpush
@endsection
