@extends('dashboard.layout.index')
@section('content')
    

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-bold text-gray-800">Edit Peminjaman</h2>
                        <a href="{{ route('peminjaman.index') }}" 
                           class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded-lg transition duration-300">
                            <i class="fas fa-arrow-left mr-2"></i>Kembali
                        </a>
                    </div>

                    <form action="{{ route('peminjaman.update', $peminjaman) }}" method="POST" enctype="multipart/form-data" 
                          class="space-y-6" x-data="{ 
                              selectedArmada: {
                                  id: {{ $peminjaman->armada_id }},
                                  harga: {{ $peminjaman->armada->harga }}
                              },
                              startDate: '{{ $peminjaman->mulai->format('Y-m-d') }}',
                              endDate: '{{ $peminjaman->selesai->format('Y-m-d') }}',
                              calculateTotal() {
                                  if (this.selectedArmada && this.startDate && this.endDate) {
                                      const start = new Date(this.startDate);
                                      const end = new Date(this.endDate);
                                      // Set time to midnight to ensure accurate day calculation
                                      start.setHours(0, 0, 0, 0);
                                      end.setHours(0, 0, 0, 0);
                                      // Calculate days without adding 1 to get correct rental duration
                                      const days = Math.ceil((end - start) / (1000 * 60 * 60 * 24));
                                      return days * this.selectedArmada.harga;
                                  }
                                  return 0;
                              }
                          }">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Data Peminjam -->
                            <div class="space-y-4">
                                <h3 class="text-lg font-semibold text-gray-700">Data Peminjam</h3>
                                
                                <div>
                                    <label for="nama_peminjam" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                                    <input type="text" name="nama_peminjam" id="nama_peminjam" 
                                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                           value="{{ old('nama_peminjam', $peminjaman->nama_peminjam) }}" required>
                                    @error('nama_peminjam')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="phone" class="block text-sm font-medium text-gray-700">Nomor Telepon</label>
                                    <input type="tel" name="phone" id="phone" 
                                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                           value="{{ old('phone', $peminjaman->phone) }}" required>
                                    @error('phone')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="ktp_peminjam" class="block text-sm font-medium text-gray-700">Foto KTP</label>
                                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md" x-data="{ showPreview: true }">
                                        @if($peminjaman->ktp_peminjam)
                                            <div class="text-center">
                                                <img src="{{ asset('storage/uploads/ktp/' . $peminjaman->ktp_peminjam) }}" 
                                                     alt="KTP Preview" 
                                                     class="h-32 w-auto mx-auto mb-4"
                                                     x-show="showPreview">
                                                <div class="flex justify-center space-x-2">
                                                    <button type="button" 
                                                            @click="showPreview = false"
                                                            class="text-sm text-red-600 hover:text-red-800">
                                                        <i class="fas fa-trash mr-1"></i>Hapus KTP
                                                    </button>
                                                    <label class="text-sm text-blue-600 hover:text-blue-800 cursor-pointer">
                                                        <i class="fas fa-upload mr-1"></i>Ganti KTP
                                                        <input type="file" 
                                                               name="ktp_peminjam" 
                                                               class="hidden" 
                                                               accept="image/*"
                                                               @change="showPreview = false">
                                                    </label>
                                                </div>
                                            </div>
                                        @else
                                            <div class="space-y-1 text-center">
                                                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                                </svg>
                                                <div class="flex text-sm text-gray-600">
                                                    <label for="ktp_peminjam" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                                        <span>Upload file</span>
                                                        <input id="ktp_peminjam" name="ktp_peminjam" type="file" class="sr-only" accept="image/*">
                                                    </label>
                                                    <p class="pl-1">atau drag and drop</p>
                                                </div>
                                                <p class="text-xs text-gray-500">PNG, JPG, JPEG sampai 2MB</p>
                                            </div>
                                        @endif
                                    </div>
                                    @error('ktp_peminjam')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Detail Peminjaman -->
                            <div class="space-y-4">
                                <h3 class="text-lg font-semibold text-gray-700">Detail Peminjaman</h3>

                                <div>
                                    <label for="armada_id" class="block text-sm font-medium text-gray-700">Pilih Armada</label>
                                    <select name="armada_id" id="armada_id" 
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                            x-model="selectedArmada.id"
                                            @change="selectedArmada.harga = $event.target.options[$event.target.selectedIndex].dataset.harga"
                                            required>
                                        <option value="">Pilih Armada</option>
                                        @foreach($armadas as $armada)
                                            <option value="{{ $armada->id }}" 
                                                    data-harga="{{ $armada->harga }}"
                                                    {{ old('armada_id', $peminjaman->armada_id) == $armada->id ? 'selected' : '' }}>
                                                {{ $armada->merk }} - {{ $armada->nopol }} (Rp {{ number_format($armada->harga, 0, ',', '.') }}/hari)
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('armada_id')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label for="mulai" class="block text-sm font-medium text-gray-700">Tanggal Mulai</label>
                                        <input type="date" name="mulai" id="mulai" 
                                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                               x-model="startDate"
                                               value="{{ old('mulai', $peminjaman->mulai->format('Y-m-d')) }}" required>
                                        @error('mulai')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="selesai" class="block text-sm font-medium text-gray-700">Tanggal Selesai</label>
                                        <input type="date" name="selesai" id="selesai" 
                                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                               x-model="endDate"
                                               value="{{ old('selesai', $peminjaman->selesai->format('Y-m-d')) }}" required>
                                        @error('selesai')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label for="pengambilan_id" class="block text-sm font-medium text-gray-700">Lokasi Pengambilan</label>
                                        <select name="pengambilan_id" id="pengambilan_id" 
                                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                                required>
                                            <option value="">Pilih Lokasi</option>
                                            @foreach($lokasis as $lokasi)
                                                <option value="{{ $lokasi->id }}" 
                                                    {{ old('pengambilan_id', $peminjaman->pengambilan_id) == $lokasi->id ? 'selected' : '' }}>
                                                    {{ $lokasi->nama }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('pengambilan_id')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="pengembalian_id" class="block text-sm font-medium text-gray-700">Lokasi Pengembalian</label>
                                        <select name="pengembalian_id" id="pengembalian_id" 
                                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                                required>
                                            <option value="">Pilih Lokasi</option>
                                            @foreach($lokasis as $lokasi)
                                                <option value="{{ $lokasi->id }}" 
                                                    {{ old('pengembalian_id', $peminjaman->pengembalian_id) == $lokasi->id ? 'selected' : '' }}>
                                                    {{ $lokasi->nama }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('pengembalian_id')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label for="waktu_pengambilan" class="block text-sm font-medium text-gray-700">Waktu Pengambilan</label>
                                        <input type="time" name="waktu_pengambilan" id="waktu_pengambilan" 
                                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                               value="{{ old('waktu_pengambilan', $peminjaman->waktu_pengambilan) }}" required>
                                        @error('waktu_pengambilan')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="waktu_pengembalian" class="block text-sm font-medium text-gray-700">Waktu Pengembalian</label>
                                        <input type="time" name="waktu_pengembalian" id="waktu_pengembalian" 
                                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                               value="{{ old('waktu_pengembalian', $peminjaman->waktu_pengembalian) }}" required>
                                        @error('waktu_pengembalian')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div>
                                    <label for="keperluan_pinjam" class="block text-sm font-medium text-gray-700">Keperluan Peminjaman</label>
                                    <textarea name="keperluan_pinjam" id="keperluan_pinjam" rows="3" 
                                              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                              required>{{ old('keperluan_pinjam', $peminjaman->keperluan_pinjam) }}</textarea>
                                    @error('keperluan_pinjam')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="status_pinjam" class="block text-sm font-medium text-gray-700">Status Peminjaman</label>
                                    <select name="status_pinjam" id="status_pinjam" 
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                            required>
                                        <option value="Pending" {{ old('status_pinjam', $peminjaman->status_pinjam) == 'Pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="Dipinjam" {{ old('status_pinjam', $peminjaman->status_pinjam) == 'Dipinjam' ? 'selected' : '' }}>Dipinjam</option>
                                        <option value="Selesai" {{ old('status_pinjam', $peminjaman->status_pinjam) == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                                        <option value="Dibatalkan" {{ old('status_pinjam', $peminjaman->status_pinjam) == 'Dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                                    </select>
                                    @error('status_pinjam')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Total Biaya -->
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <div class="flex justify-between items-center">
                                <span class="text-lg font-medium text-gray-700">Total Biaya:</span>
                                <div class="text-right">
                                    <span class="text-2xl font-bold text-blue-600" x-text="'Rp ' + calculateTotal().toLocaleString('id-ID')"></span>
                                    <div class="text-sm text-gray-500" x-text="'(' + (Math.ceil((new Date(endDate) - new Date(startDate)) / (1000 * 60 * 60 * 24))) + ' hari)'"></div>
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-end">
                            <button type="submit" 
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg transition duration-300 ease-in-out transform hover:scale-105">
                                <i class="fas fa-save mr-2"></i>Update Peminjaman
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        // Preview KTP image before upload
        document.querySelectorAll('input[type="file"]').forEach(input => {
            input.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const container = this.closest('.border-dashed');
                        const preview = document.createElement('img');
                        preview.src = e.target.result;
                        preview.className = 'h-32 w-auto mx-auto mb-4';
                        
                        // Remove existing preview if any
                        const existingPreview = container.querySelector('img');
                        if (existingPreview) {
                            existingPreview.remove();
                        }

                        // Insert new preview before the buttons
                        const buttons = container.querySelector('.flex.justify-center');
                        if (buttons) {
                            container.insertBefore(preview, buttons);
                        } else {
                            container.appendChild(preview);
                        }
                    }.bind(this);
                    reader.readAsDataURL(file);
                }
            });
        });

        // Handle KTP deletion
        document.querySelectorAll('button[type="button"]').forEach(button => {
            button.addEventListener('click', function() {
                const container = this.closest('.border-dashed');
                const preview = container.querySelector('img');
                if (preview) {
                    preview.remove();
                }
                // Add a hidden input to indicate KTP deletion
                const deleteInput = document.createElement('input');
                deleteInput.type = 'hidden';
                deleteInput.name = 'delete_ktp';
                deleteInput.value = '1';
                container.appendChild(deleteInput);
            });
        });
    </script>
    @endpush
    @endsection