@extends('dashboard.layout.index')

@section('content')
<div class="p-6" x-data="{ 
    showDeleteModal: false, 
    armadaToDelete: null,
    searchQuery: '',
    performSearch() {
        const url = new URL(window.location.href);
        url.searchParams.set('search', this.searchQuery);
        window.location.href = url.toString();
    }
}">
    <!-- Delete Confirmation Modal -->
    <div x-show="showDeleteModal" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-50 overflow-y-auto" 
         style="display: none;">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                            <i class="fas fa-exclamation-triangle text-red-600"></i>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-medium text-gray-900">Delete Vehicle</h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-500">
                                    Are you sure you want to delete this vehicle? This action cannot be undone.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <form :action="armadaToDelete ? '/armada/' + armadaToDelete : ''" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                            Delete
                        </button>
                    </form>
                    <button @click="showDeleteModal = false" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Header with Search and Add Button -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Vehicle Fleet Management</h1>
            <p class="text-gray-600">Manage your rental vehicles efficiently</p>
        </div>
        <div class="flex items-center space-x-4 mt-4 md:mt-0">
            <div class="relative">
                <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                <input type="text" 
                       x-model="searchQuery"
                       @keyup.enter="performSearch()"
                       placeholder="Search vehicles..." 
                       class="pl-10 pr-4 py-2 rounded-full border border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent w-full md:w-64">
            </div>
            <a href="{{ route('armada.create') }}" 
               class="bg-primary text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors flex items-center">
                <i class="fas fa-plus mr-2"></i> Add Vehicle
            </a>
        </div>
    </div>

    <!-- Filter Options -->
    <form action="{{ route('armada.index') }}" method="GET" class="bg-white rounded-xl shadow-sm p-4 mb-6 flex flex-wrap items-center gap-4">
        <div>
            <label for="jenis" class="block text-sm font-medium text-gray-700 mb-1">Vehicle Type</label>
            <select name="jenis" id="jenis" class="rounded-lg border-gray-300 text-sm focus:ring-primary focus:border-primary">
                <option value="">All Types</option>
                @foreach($jenisKendaraans as $jenis)
                <option value="{{ $jenis->id }}" {{ request('jenis') == $jenis->id ? 'selected' : '' }}>
                    {{ $jenis->nama }}
                </option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
            <select name="status" id="status" class="rounded-lg border-gray-300 text-sm focus:ring-primary focus:border-primary">
                <option value="">All Statuses</option>
                <option value="available" {{ request('status') == 'available' ? 'selected' : '' }}>Available</option>
                <option value="rented" {{ request('status') == 'rented' ? 'selected' : '' }}>Rented</option>
            </select>
        </div>
        <button type="submit" class="ml-auto bg-gray-100 hover:bg-gray-200 px-4 py-2 rounded-lg text-sm transition-colors">
            <i class="fas fa-filter mr-2"></i> Apply Filters
        </button>
    </form>

    <!-- Vehicle Cards Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($armadas as $armada)
        <div class="bg-white rounded-xl shadow-sm overflow-hidden hover:shadow-md transition-shadow border border-gray-100">
            <!-- Vehicle Image -->
            <div class="h-48 bg-gray-100 relative overflow-hidden">
                @if($armada->gambar)
                <img src="{{ asset('storage/' . $armada->gambar) }}" alt="{{ $armada->merk }}" class="w-full h-full object-cover">
                @else
                <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                    <i class="fas fa-car text-4xl text-gray-400"></i>
                </div>
                @endif
                <div class="absolute top-3 right-3 bg-white rounded-full w-10 h-10 flex items-center justify-center shadow-sm">
                    <span class="text-sm font-bold text-primary">{{ $armada->rating }} <i class="fas fa-star text-yellow-400 ml-1"></i></span>
                </div>
                <div class="absolute bottom-3 left-3">
                    <span class="px-2 py-1 bg-{{ $armada->status_color }}-100 text-{{ $armada->status_color }}-800 text-xs font-medium rounded-full">
                        {{ ucfirst($armada->status) }}
                    </span>
                </div>
            </div>

            <!-- Vehicle Details -->
            <div class="p-5">
                <div class="flex justify-between items-start">
                    <div>
                        <h3 class="text-lg font-bold text-gray-800">{{ $armada->merk }}</h3>
                        <p class="text-gray-500 text-sm">{{ $armada->nopol }} • {{ $armada->thn_beli }}</p>
                    </div>
                    <span class="text-xl font-bold text-primary">Rp {{ number_format($armada->harga, 0, ',', '.') }}/day</span>
                </div>

                <div class="mt-4 flex items-center text-sm text-gray-600">
                    <i class="fas fa-car-side mr-2 text-primary"></i>
                    <span>{{ $armada->jenisKendaraan->nama }}</span>
                </div>

                <div class="mt-2 flex items-center text-sm text-gray-600">
                    <i class="fas fa-users mr-2 text-primary"></i>
                    <span>{{ $armada->kapasitas_kursi }} Seats</span>
                </div>

                <p class="mt-3 text-sm text-gray-600 line-clamp-2">{{ $armada->deskripsi }}</p>

                <div class="mt-4 pt-4 border-t my-auto items-center border-gray-100 flex justify-between">
                    <div class="flex h-full items-center w-full space-x-2 justify-between">
                        <a href="{{ route('armada.edit', $armada->id) }}" class="text-secondary hover:text-green-700 p-2 rounded-full hover:bg-green-50">
                            <i class="fas fa-edit"></i>
                        </a>
                        <button @click="showDeleteModal = true; armadaToDelete = {{ $armada->id }}" class="text-red-500 hover:text-red-700 p-2 rounded-full hover:bg-red-50">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-full bg-white rounded-xl shadow-sm p-8 text-center mt-8">
            <i class="fas fa-car text-4xl text-gray-300 mb-4"></i>
            <h3 class="text-lg font-medium text-gray-700 mb-2">No vehicles found</h3>
            <p class="text-gray-500 mb-4">Add your first vehicle to get started</p>
            <a href="{{ route('armada.create') }}" class="bg-primary text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors inline-flex items-center">
                <i class="fas fa-plus mr-2"></i> Add Vehicle
            </a>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($armadas->hasPages())
    <div class="mt-8">
        {{ $armadas->appends(request()->query())->links() }}
    </div>
    @endif
</div>

@push('scripts')
<script>
    // Search functionality is now handled by Alpine.js
</script>
@endpush
@endsection