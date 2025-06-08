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
                <div class="absolute inset-0 bg-gradient-to-r from-blue-600 to-purple-600 rounded-3xl opacity-10"></div>
                <div class="relative bg-white/70 backdrop-blur-lg border border-white/20 rounded-3xl p-8 shadow-xl">
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                        <div>
                            <h1 class="text-4xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
                                Daftar Peminjaman
                            </h1>
                            <p class="text-gray-600 mt-2">Kelola dan pantau semua peminjaman armada</p>
                        </div>
                        <a href="{{ route('peminjaman.create') }}" 
                           class="bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white font-semibold py-3 px-6 rounded-2xl transition-all duration-300 transform hover:scale-105 hover:shadow-lg flex items-center space-x-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            <span>Tambah Peminjaman</span>
                        </a>
                    </div>
                </div>
            </div>            <!-- Search and Filter Section with Glass Effect -->
            <div class="bg-white/60 backdrop-blur-md border border-white/30 rounded-3xl p-6 shadow-xl mb-8" x-data="{ showFilters: false }">
                <div class="flex flex-wrap gap-4 items-center mb-4">
                    <form action="{{ route('peminjaman.index') }}" method="GET" class="flex-1 max-w-md">
                        <div class="relative">
                            <input type="text" name="search" value="{{ request('search') }}" 
                                   class="w-full pl-12 pr-4 py-3 rounded-2xl border-0 bg-white/80 backdrop-blur-sm shadow-inner focus:outline-none focus:ring-2 focus:ring-blue-500/50 placeholder-gray-500"
                                   placeholder="Cari peminjaman...">
                            <div class="absolute left-4 top-3.5 text-gray-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                        </div>
                    </form>
                    <button @click="showFilters = !showFilters" 
                            class="bg-gradient-to-r from-gray-100 to-gray-200 hover:from-gray-200 hover:to-gray-300 text-gray-700 font-semibold py-3 px-6 rounded-2xl transition-all duration-300 transform hover:scale-105 shadow-lg border border-white/50 backdrop-blur-sm flex items-center space-x-2"
                            :class="showFilters ? 'ring-2 ring-blue-500/50' : ''">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.414A1 1 0 013 6.707V4z"></path>
                        </svg>
                        <span>Filter</span>
                    </button>
                </div>

                <!-- Filter Options with Animation -->
                <div x-show="showFilters" 
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 transform scale-95"
                     x-transition:enter-end="opacity-100 transform scale-100"
                     x-transition:leave="transition ease-in duration-200"
                     x-transition:leave-start="opacity-100 transform scale-100"
                     x-transition:leave-end="opacity-0 transform scale-95"
                     class="bg-gradient-to-r from-blue-50/50 to-purple-50/50 backdrop-blur-sm rounded-2xl p-6 border border-white/30">
                    <form action="{{ route('peminjaman.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Status Peminjaman</label>
                            <select name="status" class="w-full rounded-xl border-0 bg-white/80 backdrop-blur-sm shadow-inner focus:ring-2 focus:ring-blue-500/50 py-3 px-4">
                                <option value="">Semua Status</option>
                                <option value="Pending" {{ request('status') == 'Pending' ? 'selected' : '' }}>🟡 Pending</option>
                                <option value="Dipinjam" {{ request('status') == 'Dipinjam' ? 'selected' : '' }}>🔵 Dipinjam</option>
                                <option value="Selesai" {{ request('status') == 'Selesai' ? 'selected' : '' }}>🟢 Selesai</option>
                                <option value="Dibatalkan" {{ request('status') == 'Dibatalkan' ? 'selected' : '' }}>🔴 Dibatalkan</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Rentang Tanggal</label>
                            <input type="text" name="date_range" value="{{ request('date_range') }}" 
                                   class="w-full rounded-xl border-0 bg-white/80 backdrop-blur-sm shadow-inner focus:ring-2 focus:ring-blue-500/50 py-3 px-4" 
                                   placeholder="Pilih rentang tanggal">
                        </div>
                        <div class="flex items-end">
                            <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white font-semibold py-3 px-6 rounded-xl transition-all duration-300 transform hover:scale-105 shadow-lg">
                                Terapkan Filter
                            </button>
                        </div>
                    </form>
                </div>
            </div>            <!-- Main Content with Modern Card Design -->
            <div class="bg-white/60 backdrop-blur-md border border-white/30 rounded-3xl shadow-xl overflow-hidden">
                <!-- Peminjaman Cards Grid -->
                <div class="p-6">
                    <div class="grid gap-6" x-data="{ viewMode: 'grid' }">
                        <!-- View Toggle -->
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-xl font-semibold text-gray-800">Data Peminjaman</h3>
                            <div class="flex bg-gray-100/80 backdrop-blur-sm rounded-xl p-1">
                                <button @click="viewMode = 'grid'" 
                                        :class="viewMode === 'grid' ? 'bg-white shadow-sm' : ''"
                                        class="px-4 py-2 rounded-lg transition-all duration-200 text-sm font-medium">
                                    <svg class="w-4 h-4 inline mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                                    </svg>
                                    Grid
                                </button>
                                <button @click="viewMode = 'table'" 
                                        :class="viewMode === 'table' ? 'bg-white shadow-sm' : ''"
                                        class="px-4 py-2 rounded-lg transition-all duration-200 text-sm font-medium">
                                    <svg class="w-4 h-4 inline mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zm0 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V8zm0 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1v-2z" clip-rule="evenodd"></path>
                                    </svg>
                                    Table
                                </button>
                            </div>
                        </div>

                        <!-- Grid View -->
                        <div x-show="viewMode === 'grid'" 
                             x-transition:enter="transition ease-out duration-300"
                             x-transition:enter-start="opacity-0 transform scale-95"
                             x-transition:enter-end="opacity-100 transform scale-100"
                             x-transition:leave="transition ease-in duration-200"
                             x-transition:leave-start="opacity-100 transform scale-100"
                             x-transition:leave-end="opacity-0 transform scale-95"
                             class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @forelse ($peminjamans as $peminjaman)
                                <div class="group bg-gradient-to-br from-white to-gray-50/50 rounded-2xl p-6 border border-gray-200/50 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 backdrop-blur-sm">
                                    <!-- Header -->
                                    <div class="flex justify-between items-start mb-4">
                                        <div class="flex items-center space-x-3">
                                            <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-purple-600 rounded-xl flex items-center justify-center text-white font-bold">
                                                {{ substr($peminjaman->nama_peminjam, 0, 2) }}
                                            </div>
                                            <div>
                                                <h4 class="font-semibold text-gray-900">{{ $peminjaman->nama_peminjam }}</h4>
                                                <p class="text-sm text-gray-500">#{{ $peminjaman->id }}</p>
                                            </div>
                                        </div>
                                        <span class="px-3 py-1 text-xs font-semibold rounded-full
                                            {{ $peminjaman->status_pinjam == 'Pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                            {{ $peminjaman->status_pinjam == 'Dipinjam' ? 'bg-blue-100 text-blue-800' : '' }}
                                            {{ $peminjaman->status_pinjam == 'Selesai' ? 'bg-green-100 text-green-800' : '' }}
                                            {{ $peminjaman->status_pinjam == 'Dibatalkan' ? 'bg-red-100 text-red-800' : '' }}">
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
                                                <h5 class="font-medium text-gray-900">{{ $peminjaman->armada->merk }}</h5>
                                                <p class="text-sm text-gray-500">{{ $peminjaman->armada->nopol }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Date and Price -->
                                    <div class="space-y-3 mb-4">
                                        <div class="flex items-center text-sm text-gray-600">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                            {{ $peminjaman->mulai->format('d M Y') }} - {{ $peminjaman->selesai->format('d M Y') }}
                                        </div>
                                        <div class="flex items-center justify-between">
                                            <span class="text-sm text-gray-600">Total Biaya:</span>
                                            <span class="text-lg font-bold text-blue-600">Rp {{ number_format($peminjaman->biaya, 0, ',', '.') }}</span>
                                        </div>
                                    </div>

                                    <!-- Actions -->
                                    <div class="flex space-x-2 pt-4 border-t border-gray-200/50">
                                        <a href="{{ route('peminjaman.show', $peminjaman) }}" 
                                           class="flex-1 bg-blue-50 hover:bg-blue-100 text-blue-600 text-center py-2 rounded-lg transition-colors duration-200 text-sm font-medium">
                                            Detail
                                        </a>
                                        <a href="{{ route('peminjaman.edit', $peminjaman) }}" 
                                           class="flex-1 bg-purple-50 hover:bg-purple-100 text-purple-600 text-center py-2 rounded-lg transition-colors duration-200 text-sm font-medium">
                                            Edit
                                        </a>
                                        <form action="{{ route('peminjaman.destroy', $peminjaman) }}" method="POST" 
                                              class="flex-1"
                                              onsubmit="return confirm('Apakah Anda yakin ingin menghapus peminjaman ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="w-full bg-red-50 hover:bg-red-100 text-red-600 py-2 rounded-lg transition-colors duration-200 text-sm font-medium">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @empty
                                <div class="col-span-full">
                                    <div class="text-center py-12">
                                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                        </svg>
                                        <h3 class="mt-2 text-lg font-medium text-gray-900">Tidak ada data peminjaman</h3>
                                        <p class="mt-1 text-gray-500">Mulai dengan menambahkan peminjaman baru.</p>
                                    </div>
                                </div>
                            @endforelse
                        </div>

                        <!-- Table View -->
                        <div x-show="viewMode === 'table'" 
                             x-transition:enter="transition ease-out duration-300"
                             x-transition:enter-start="opacity-0 transform scale-95"
                             x-transition:enter-end="opacity-100 transform scale-100"
                             x-transition:leave="transition ease-in duration-200"
                             x-transition:leave-start="opacity-100 transform scale-100"
                             x-transition:leave-end="opacity-0 transform scale-95"
                             class="overflow-x-auto bg-white/80 backdrop-blur-sm rounded-2xl border border-gray-200/50">
                            <table class="min-w-full divide-y divide-gray-200/50">
                                <thead class="bg-gradient-to-r from-gray-50 to-gray-100/80">
                                    <tr>
                                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">ID</th>
                                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Peminjam</th>
                                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Armada</th>
                                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Tanggal</th>
                                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Biaya</th>
                                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Status</th>
                                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white/50 backdrop-blur-sm divide-y divide-gray-200/30">
                                    @forelse ($peminjamans as $peminjaman)
                                        <tr class="hover:bg-white/70 transition-colors duration-200">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="text-sm font-medium text-gray-900">#{{ $peminjaman->id }}</span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center text-white text-sm font-medium mr-3">
                                                        {{ substr($peminjaman->nama_peminjam, 0, 2) }}
                                                    </div>
                                                    <div>
                                                        <div class="text-sm font-medium text-gray-900">{{ $peminjaman->nama_peminjam }}</div>
                                                        <div class="text-sm text-gray-500">{{ $peminjaman->phone }}</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-medium text-gray-900">{{ $peminjaman->armada->merk }}</div>
                                                <div class="text-sm text-gray-500">{{ $peminjaman->armada->nopol }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900">
                                                    {{ $peminjaman->mulai->format('d M Y') }} - {{ $peminjaman->selesai->format('d M Y') }}
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
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <div class="flex space-x-2">
                                                    <a href="{{ route('peminjaman.show', $peminjaman) }}" 
                                                       class="bg-blue-100 hover:bg-blue-200 text-blue-600 p-2 rounded-lg transition-colors duration-200"
                                                       title="Detail">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                        </svg>
                                                    </a>
                                                    <a href="{{ route('peminjaman.edit', $peminjaman) }}" 
                                                       class="bg-purple-100 hover:bg-purple-200 text-purple-600 p-2 rounded-lg transition-colors duration-200"
                                                       title="Edit">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                        </svg>
                                                    </a>
                                                    <form action="{{ route('peminjaman.destroy', $peminjaman) }}" method="POST" 
                                                          class="inline-block"
                                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus peminjaman ini?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="bg-red-100 hover:bg-red-200 text-red-600 p-2 rounded-lg transition-colors duration-200"
                                                                title="Hapus">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                            </svg>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="px-6 py-12 text-center">
                                                <div class="text-center">
                                                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                                    </svg>
                                                    <h3 class="mt-2 text-lg font-medium text-gray-900">Tidak ada data peminjaman</h3>
                                                    <p class="mt-1 text-gray-500">Mulai dengan menambahkan peminjaman baru.</p>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Pagination -->
                    @if($peminjamans->hasPages())
                    <div class="mt-8 flex justify-center">
                        <div class="bg-white/80 backdrop-blur-sm rounded-2xl border border-gray-200/50 p-2">
                            {{ $peminjamans->links() }}
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script>
        // Initialize date range picker with modern styling
        flatpickr("input[name='date_range']", {
            mode: "range",
            dateFormat: "Y-m-d",
            altInput: true,
            altFormat: "d F Y",
            locale: "id",
            theme: "material_blue"
        });

        // Add loading states for buttons
        document.querySelectorAll('form').forEach(form => {
            form.addEventListener('submit', function() {
                const submitBtn = this.querySelector('button[type="submit"]');
                if (submitBtn) {
                    submitBtn.innerHTML = '<svg class="animate-spin -ml-1 mr-3 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>Processing...';
                    submitBtn.disabled = true;
                }
            });
        });

        // Auto-submit search form on input
        document.querySelector('input[name="search"]').addEventListener('input', function() {
            clearTimeout(this.searchTimeout);
            this.searchTimeout = setTimeout(() => {
                this.closest('form').submit();
            }, 500);
        });

        // Add smooth transitions
        document.addEventListener('DOMContentLoaded', function() {
            // Fade in animation for cards
            const cards = document.querySelectorAll('.group');
            cards.forEach((card, index) => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';
                setTimeout(() => {
                    card.style.transition = 'all 0.5s ease';
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, index * 100);
            });
        });
    </script>
    @endpush
    @endsection