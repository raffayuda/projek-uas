@extends('dashboard.layout.index')

@section('content')
<div class="p-6 max-w-3xl mx-auto">
    <div class="bg-white rounded-xl shadow-sm p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-bold text-gray-800">Edit Vehicle</h2>
            <a href="{{ route('armada.index') }}" class="text-gray-500 hover:text-gray-700">
                <i class="fas fa-times"></i>
            </a>
        </div>

        <form action="{{ route('armada.update', $armada->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Left Column -->
                <div>
                    <div class="mb-4">
                        <label for="merk" class="block text-sm font-medium text-gray-700 mb-1">Brand</label>
                        <input type="text" id="merk" name="merk" value="{{ old('merk', $armada->merk) }}"
                               class="w-full rounded-lg border-gray-300 focus:border-primary focus:ring-primary">
                        @error('merk')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="nopol" class="block text-sm font-medium text-gray-700 mb-1">License Plate</label>
                        <input type="text" id="nopol" name="nopol" value="{{ old('nopol', $armada->nopol) }}"
                               class="w-full rounded-lg border-gray-300 focus:border-primary focus:ring-primary">
                        @error('nopol')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="thn_beli" class="block text-sm font-medium text-gray-700 mb-1">Year</label>
                        <input type="number" id="thn_beli" name="thn_beli" value="{{ old('thn_beli', $armada->thn_beli) }}"
                               class="w-full rounded-lg border-gray-300 focus:border-primary focus:ring-primary">
                        @error('thn_beli')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="jenis_kendaraan_id" class="block text-sm font-medium text-gray-700 mb-1">Vehicle Type</label>
                        <select id="jenis_kendaraan_id" name="jenis_kendaraan_id"
                                class="w-full rounded-lg border-gray-300 focus:border-primary focus:ring-primary">
                            <option value="">Select Type</option>
                            @foreach($jenisKendaraans as $jenis)
                            <option value="{{ $jenis->id }}" {{ old('jenis_kendaraan_id', $armada->jenis_kendaraan_id) == $jenis->id ? 'selected' : '' }}>
                                {{ $jenis->nama }}
                            </option>
                            @endforeach
                        </select>
                        @error('jenis_kendaraan_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Right Column -->
                <div>
                    <div class="mb-4">
                        <label for="kapasitas_kursi" class="block text-sm font-medium text-gray-700 mb-1">Seat Capacity</label>
                        <input type="number" id="kapasitas_kursi" name="kapasitas_kursi" value="{{ old('kapasitas_kursi', $armada->kapasitas_kursi) }}"
                               class="w-full rounded-lg border-gray-300 focus:border-primary focus:ring-primary">
                        @error('kapasitas_kursi')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="rating" class="block text-sm font-medium text-gray-700 mb-1">Rating</label>
                        <select id="rating" name="rating"
                                class="w-full rounded-lg border-gray-300 focus:border-primary focus:ring-primary">
                            @for($i = 1; $i <= 5; $i++)
                            <option value="{{ $i }}" {{ old('rating', $armada->rating) == $i ? 'selected' : '' }}>{{ $i }} Star</option>
                            @endfor
                        </select>
                        @error('rating')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="harga" class="block text-sm font-medium text-gray-700 mb-1">Daily Price (Rp)</label>
                        <input type="number" id="harga" name="harga" value="{{ old('harga', $armada->harga) }}"
                               class="w-full rounded-lg border-gray-300 focus:border-primary focus:ring-primary">
                        @error('harga')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="gambar" class="block text-sm font-medium text-gray-700 mb-1">Image</label>
                        <input type="file" id="gambar" name="gambar" accept="image/*"
                               class="w-full rounded-lg border-gray-300 focus:border-primary focus:ring-primary">
                        @error('gambar')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        @if($armada->gambar)
                        <div class="mt-2">
                            <img src="{{ asset('storage/' . $armada->gambar) }}" alt="Current Image" class="h-20 rounded-lg">
                            <p class="text-xs text-gray-500 mt-1">Current image</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="mt-4">
                <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                <textarea id="deskripsi" name="deskripsi" rows="3"
                          class="w-full rounded-lg border-gray-300 focus:border-primary focus:ring-primary">{{ old('deskripsi', $armada->deskripsi) }}</textarea>
                @error('deskripsi')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-6 flex justify-end space-x-3">
                <a href="{{ route('armada.index') }}" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                    Cancel
                </a>
                <button type="submit" class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-blue-700">
                    Update Vehicle
                </button>
            </div>
        </form>
    </div>
</div>
@endsection