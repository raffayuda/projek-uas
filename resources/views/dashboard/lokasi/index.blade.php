@extends('dashboard.layout.index')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Lokasi Rental</h1>
        <a href="{{ route('lokasi.create') }}" class="bg-gradient-to-r from-blue-500 to-indigo-600 text-white px-6 py-2 rounded-lg shadow-lg hover:from-indigo-600 hover:to-blue-500 transition duration-300 transform hover:scale-105">
            <i class="fas fa-plus mr-2"></i>Tambah Lokasi
        </a>
    </div>

    @if(session('success'))
    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
        <p>{{ session('success') }}</p>
    </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($locations as $location)
        <div class="bg-white rounded-xl shadow-lg overflow-hidden transform transition duration-300 hover:scale-105">
            @if($location->image)
            <div class="relative h-48">
                <img src="{{ asset('storage/location-images/' . $location->image) }}" alt="{{ $location->nama }}" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
            </div>
            @else
            <div class="relative h-48 bg-gradient-to-r from-blue-500 to-indigo-600">
                <div class="absolute inset-0 flex items-center justify-center">
                    <i class="fas fa-map-marker-alt text-white text-5xl"></i>
                </div>
            </div>
            @endif

            <div class="p-6">
                <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $location->nama }}</h3>
                <p class="text-gray-600 mb-4">{{ $location->alamat }}</p>
                
                @if($location->koordinat)
                <div class="flex items-center text-gray-500 mb-4">
                    <i class="fas fa-map-pin mr-2"></i>
                    <span>{{ $location->koordinat }}</span>
                </div>
                @endif

                <div class="flex justify-end space-x-3">
                    <a href="{{ route('lokasi.edit', $location->id) }}" class="text-blue-600 hover:text-blue-800 transition-colors">
                        <i class="fas fa-edit"></i>
                    </a>
                    <form action="{{ route('lokasi.destroy', $location->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus lokasi ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-800 transition-colors">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    @if($locations->isEmpty())
    <div class="text-center py-12">
        <div class="text-gray-400 mb-4">
            <i class="fas fa-map-marked-alt text-6xl"></i>
        </div>
        <h3 class="text-xl font-semibold text-gray-600 mb-2">Belum ada lokasi</h3>
        <p class="text-gray-500">Tambahkan lokasi rental pertama Anda</p>
    </div>
    @endif
</div>
@endsection 