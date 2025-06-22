@extends('dashboard.layout.index')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 via-purple-50 to-pink-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header Section -->
        <div class="relative mb-8">
            <div class="absolute inset-0 bg-gradient-to-r from-blue-600 to-purple-600 rounded-3xl opacity-10"></div>
            <div class="relative bg-white/70 backdrop-blur-lg border border-white/20 rounded-3xl p-8 shadow-xl">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                    <div>
                        <h1 class="text-4xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
                            Jenis Kendaraan
                        </h1>
                        <p class="text-gray-600 mt-2">Kelola kategori dan jenis kendaraan dalam sistem</p>
                    </div>
                    <a href="{{ route('jenis-kendaraan.create') }}" 
                       class="bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700 text-white font-semibold py-3 px-6 rounded-2xl transition-all duration-300 transform hover:scale-105 hover:shadow-lg flex items-center space-x-2">
                        <i class="fas fa-plus"></i>
                        <span>Tambah Jenis Kendaraan</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Search and Filter Section -->
        <div class="bg-white/60 backdrop-blur-lg border border-white/30 rounded-2xl p-6 mb-8 shadow-lg">
            <form method="GET" action="{{ route('jenis-kendaraan.index') }}" class="flex flex-col md:flex-row gap-4">
                <div class="flex-1">
                    <div class="relative">
                        <input type="text" 
                               name="search" 
                               value="{{ request('search') }}"
                               placeholder="Cari jenis kendaraan..."
                               class="w-full pl-12 pr-4 py-3 bg-white/80 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-search text-gray-400"></i>
                        </div>
                    </div>
                </div>
                <div class="flex gap-2">
                    <button type="submit" 
                            class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded-xl transition-colors flex items-center space-x-2">
                        <i class="fas fa-search"></i>
                        <span>Cari</span>
                    </button>
                    <a href="{{ route('jenis-kendaraan.index') }}" 
                       class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-xl transition-colors flex items-center space-x-2">
                        <i class="fas fa-refresh"></i>
                        <span>Reset</span>
                    </a>
                </div>
            </form>
        </div>

        <!-- Success/Error Messages -->
        @if(session('success'))
            <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-xl">
                {{ session('error') }}
            </div>
        @endif

        <!-- Content Section -->
        <div class="bg-white/60 backdrop-blur-lg border border-white/30 rounded-2xl shadow-lg overflow-hidden">
            <!-- Header -->
            <div class="bg-gradient-to-r from-blue-600 to-purple-600 px-6 py-4">
                <h2 class="text-xl font-bold text-white flex items-center">
                    <i class="fas fa-list mr-3"></i>
                    Daftar Jenis Kendaraan
                </h2>
            </div>

            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Jenis</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah Armada</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Dibuat</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($jenisKendaraans as $index => $jenisKendaraan)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $jenisKendaraans->firstItem() + $index }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        <div class="h-10 w-10 rounded-lg bg-gradient-to-br from-blue-400 to-purple-500 flex items-center justify-center">
                                            <i class="fas fa-car text-white"></i>
                                        </div>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">{{ $jenisKendaraan->nama }}</div>
                                    </div>
                                </div>
                            </td>                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    {{ $jenisKendaraan->armada_count }} armada
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $jenisKendaraan->created_at ? $jenisKendaraan->created_at->format('d M Y') : 'Tidak tersedia' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex items-center justify-end space-x-2">
                                    <a href="{{ route('jenis-kendaraan.show', $jenisKendaraan) }}" 
                                       class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-2 rounded-lg text-xs transition-colors flex items-center">
                                        <i class="fas fa-eye mr-1"></i>
                                        Detail
                                    </a>
                                    <a href="{{ route('jenis-kendaraan.edit', $jenisKendaraan) }}" 
                                       class="bg-green-500 hover:bg-green-600 text-white px-3 py-2 rounded-lg text-xs transition-colors flex items-center">
                                        <i class="fas fa-edit mr-1"></i>
                                        Edit
                                    </a>                                    <button onclick="openDeleteModal({{ $jenisKendaraan->id }}, '{{ $jenisKendaraan->nama }}')" 
                                            class="bg-red-500 hover:bg-red-600 text-white px-3 py-2 rounded-lg text-xs transition-colors flex items-center">
                                        <i class="fas fa-trash mr-1"></i>
                                        Hapus
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center">
                                    <i class="fas fa-list text-6xl text-gray-300 mb-4"></i>
                                    <h3 class="text-lg font-medium text-gray-600 mb-2">Belum Ada Jenis Kendaraan</h3>
                                    <p class="text-gray-500 mb-4">Mulai dengan menambahkan jenis kendaraan pertama</p>
                                    <a href="{{ route('jenis-kendaraan.create') }}" 
                                       class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition-colors">
                                        Tambah Jenis Kendaraan
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($jenisKendaraans->hasPages())
            <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
                {{ $jenisKendaraans->links() }}
            </div>
            @endif        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50 transition-all duration-300 opacity-0">
    <div class="bg-white rounded-2xl p-6 m-4 max-w-md w-full shadow-2xl transform transition-all duration-300 scale-95" id="deleteModalContent">
        <!-- Modal Header -->
        <div class="flex items-center justify-center mb-4">
            <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center">
                <i class="fas fa-exclamation-triangle text-2xl text-red-600"></i>
            </div>
        </div>
        
        <!-- Modal Content -->
        <div class="text-center mb-6">
            <h3 class="text-xl font-bold text-gray-800 mb-2">Hapus Jenis Kendaraan</h3>
            <p class="text-gray-600">Apakah Anda yakin ingin menghapus jenis kendaraan <span id="deleteItemName" class="font-semibold"></span>?</p>
            <p class="text-red-600 text-sm mt-2">Tindakan ini tidak dapat dibatalkan.</p>
        </div>
        
        <!-- Modal Actions -->
        <div class="flex space-x-3">
            <button onclick="closeDeleteModal()" class="flex-1 bg-gray-500 hover:bg-gray-600 text-white py-3 px-4 rounded-xl font-medium transition-colors">
                Batal
            </button>
            <form id="deleteForm" method="POST" class="flex-1">
                @csrf
                @method('DELETE')
                <button type="submit" class="w-full bg-red-500 hover:bg-red-600 text-white py-3 px-4 rounded-xl font-medium transition-colors">
                    Hapus
                </button>
            </form>
        </div>
    </div>
</div>

<script>
function openDeleteModal(id, name) {
    document.getElementById('deleteItemName').textContent = name;
    document.getElementById('deleteForm').action = '/jenis-kendaraan/' + id;
    const modal = document.getElementById('deleteModal');
    const modalContent = document.getElementById('deleteModalContent');
    
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    
    // Trigger animation
    setTimeout(() => {
        modal.classList.remove('opacity-0');
        modal.classList.add('opacity-100');
        modalContent.classList.remove('scale-95');
        modalContent.classList.add('scale-100');
    }, 10);
}

function closeDeleteModal() {
    const modal = document.getElementById('deleteModal');
    const modalContent = document.getElementById('deleteModalContent');
    
    modal.classList.add('opacity-0');
    modal.classList.remove('opacity-100');
    modalContent.classList.add('scale-95');
    modalContent.classList.remove('scale-100');
    
    setTimeout(() => {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }, 300);
}

// Close modal when clicking outside
document.getElementById('deleteModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeDeleteModal();
    }
});

// Close modal with Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeDeleteModal();
    }
});
</script>
@endsection
