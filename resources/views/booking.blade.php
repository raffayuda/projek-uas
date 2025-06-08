@extends('layouts.index')
@section('content')
<style>
    .animate-bounce-in {
        animation: bounceIn 0.5s;
    }
    
    @keyframes bounceIn {
        0% { transform: scale(0.9); opacity: 0; }
        50% { transform: scale(1.05); }
        100% { transform: scale(1); opacity: 1; }
    }
    
    .animate-progress {
        animation: progress 3s linear forwards;
    }
    
    @keyframes progress {
        0% { width: 100%; }
        100% { width: 0%; }
    }
    
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    </style>
<!-- Booking Form Section -->
<div class="booking-header">
    <div class="hero-pattern"></div>
    <img src="https://images.unsplash.com/photo-1503376780353-7e6692767b70?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80" 
         alt="Mobil Mewah" 
         class="hero-car">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative w-full">
        <div class="hero-content text-center">
            <div class="hero-badge" data-aos="fade-up">
                <i class="fas fa-star"></i>
                <span class="text-white">Layanan Rental Mobil Premium</span>
            </div>
            <h1 class="text-5xl font-extrabold text-white sm:text-6xl lg:text-7xl mb-8" data-aos="fade-up" data-aos-delay="100">
                Pesan <span class="gradient-text">Mobil Impian</span> Anda
            </h1>
            <p class="text-2xl text-gray-200 max-w-3xl mx-auto mb-12" data-aos="fade-up" data-aos-delay="200">
                Rasakan kemewahan dan kenyamanan dengan armada kendaraan premium kami. 
                Pilih mobil yang sempurna dan mulai perjalanan Anda hari ini.
            </p>
            <div class="hero-stats" data-aos="fade-up" data-aos-delay="300">
                <div class="stat-card">
                    <div class="stat-number">500+</div>
                    <div class="stat-label">Pelanggan Puas</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">50+</div>
                    <div class="stat-label">Mobil Premium</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">24/7</div>
                    <div class="stat-label">Layanan Pelanggan</div>
                </div>
            </div>
        </div>
    </div>
    <!-- Scroll Indicator -->
    <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 animate-bounce" data-aos="fade-up" data-aos-delay="1000">
        <i class="fas fa-chevron-down text-white text-2xl"></i>
    </div>
</div>

<!-- Multi-step Form -->
<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8 md:py-12">
    <div x-data="{
        currentStep: 1,
        totalSteps: 4,
        selectedCar: '',
        cars: {{ json_encode($cars ?? []) }},
        pickupLocations: {{ json_encode($pickupLocations ?? []) }},
        returnLocations: {{ json_encode($returnLocations ?? []) }},
        pickupLocation: '',
        returnLocation: '',
        pickupDate: '',
        returnDate: '',
        pickupTime: '',
        returnTime: '',
        name: '',
        email: '',
        phone: '',
        licenseNumber: '',
        additionalServices: [],
        ktpFile: null,
        komentar: '',
        keperluan: '',
        biaya: 0,
        
        init() {
            this.calculateBiaya();
        },
        
        calculateBiaya() {
            if (this.selectedCar && this.pickupDate && this.returnDate) {
                const car = this.cars.find(c => c.id == this.selectedCar);
                if (car) {
                    const start = new Date(this.pickupDate);
                    const end = new Date(this.returnDate);
                    const days = Math.ceil((end - start) / (1000 * 60 * 60 * 24));
                    this.biaya = car.harga * Math.max(1, days);
                }
            }
        },
        
        handleKtp(e) { 
            this.ktpFile = e.target.files[0]; 
        },
        
        submitBooking() { 
            this.calculateBiaya();
            
            const formData = new FormData();
            formData.append('armada_id', this.selectedCar);
            formData.append('pengambilan_id', this.pickupLocation);
            formData.append('pengembalian_id', this.returnLocation);
            formData.append('mulai', this.pickupDate);
            formData.append('waktu_pengambilan', this.pickupTime);
            formData.append('selesai', this.returnDate);
            formData.append('waktu_pengembalian', this.returnTime);
            formData.append('nama_peminjam', this.name);
            formData.append('phone', this.phone);
            formData.append('keperluan_pinjam', this.keperluan || '');
            formData.append('biaya', this.biaya);
            
            if (this.ktpFile) {
                formData.append('ktp_peminjam', this.ktpFile);
            }

            const csrfToken = document.querySelector('meta[name=csrf-token]')?.getAttribute('content');
            
            if (!csrfToken) {
                alert('CSRF token not found. Please refresh the page.');
                return;
            }

            fetch('/booking/store', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                },
            })
            .then(response => {
                if (!response.ok) {
                    return response.json().then(err => {
                        console.error('Validation errors:', err.errors);
                        throw err;
                    });
                }
                return response.json();
            })
            .then(data => {
                if(data.success) {
                    const modal = document.getElementById('success-modal');
                    modal.classList.remove('hidden');
                    setTimeout(() => {
                        window.location.reload();
                    }, 3000);
                } else {
                    alert('Gagal booking: ' + (data.message || 'Unknown error'));
                }
            })
            .catch(error => {
                console.error('Error:', error);
                if (error.errors) {
                    const errorMessages = Object.values(error.errors).flat();
                    alert('Validasi gagal:\n' + errorMessages.join('\n'));
                } else {
                    alert('Gagal booking: ' + (error.message || 'Terjadi kesalahan pada server'));
                }
            });
        },
        
        showSuccessModal() {
            const modal = document.getElementById('success-modal');
            modal.classList.remove('hidden');
            setTimeout(() => {
                window.location.reload();
            }, 3000);
        }
    }">

        <!-- Progress Steps - Modern Design -->
        <div class="mb-12" data-aos="fade-up">
            <div class="flex items-center justify-between relative">
                <div class="absolute top-5 left-0 w-full h-1.5 bg-gray-100 rounded-full">
                    <div class="h-full bg-gradient-to-r from-blue-500 to-green-400 rounded-full transition-all duration-500" 
                         :style="`width: ${((currentStep-1)/(totalSteps-1))*100}%`"></div>
                </div>
                <template x-for="step in totalSteps" :key="step">
                    <div class="relative z-10 flex flex-col items-center cursor-pointer" @click="currentStep = step">
                        <div :class="{
                            'bg-gradient-to-br from-blue-500 to-blue-600 text-white shadow-lg': currentStep === step,
                            'bg-gradient-to-br from-green-500 to-green-600 text-white shadow-lg': currentStep > step,
                            'bg-white border-2 border-gray-200 text-gray-400': currentStep < step
                        }" class="w-12 h-12 rounded-full flex items-center justify-center font-semibold transition-all duration-300">
                            <span x-show="currentStep > step" class="text-white"><i class="fas fa-check"></i></span>
                            <span x-show="currentStep <= step" x-text="step"></span>
                        </div>
                        <span class="mt-3 text-sm font-medium" :class="currentStep >= step ? 'text-gray-800 font-semibold' : 'text-gray-500'">
                            <span x-show="step === 1">Pilih Mobil</span>
                            <span x-show="step === 2">Detail Sewa</span>
                            <span x-show="step === 3">Data Diri</span>
                            <span x-show="step === 4">Konfirmasi</span>
                        </span>
                    </div>
                </template>
            </div>
        </div>
        
        <!-- Step 1: Car Selection - Card Grid -->
        <div x-show="currentStep === 1" x-transition class="bg-white rounded-2xl shadow-xl p-8" data-aos="fade-up">
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900">Pilih Mobil</h2>
                    <p class="text-gray-500">Pilih mobil yang sesuai kebutuhan Anda</p>
                </div>
                <div class="relative w-64">
                    <select x-model="selectedCar" class="block appearance-none w-full bg-white border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded-lg leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Filter Mobil</option>
                        <template x-for="car in cars" :key="car.id">
                            <option :value="car.id" x-text="`${car.merk} (${car.nopol})`"></option>
                        </template>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                        <i class="fas fa-chevron-down"></i>
                    </div>
                </div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <template x-for="car in cars" :key="car.id">
                    <div @click="selectedCar = car.id" 
                         :class="{'ring-2 ring-blue-500 scale-[1.02]': selectedCar == car.id}"
                         class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-all duration-300 cursor-pointer border border-gray-100">
                        <div class="relative h-48 bg-gray-100">                            <template x-if="car.gambar">
                                <img :src="`/storage/armada-images/${car.gambar}`" 
                                     class="w-full h-full object-cover"
                                     :alt="car.merk">
                            </template>
                            <template x-if="!car.gambar">
                                <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-gray-100 to-gray-200">
                                    <i class="fas fa-car text-gray-300 text-4xl"></i>
                                </div>
                            </template>
                            <div class="absolute top-3 right-3 bg-white rounded-full px-3 py-1 shadow flex items-center">
                                <i class="fas fa-tag text-blue-500 mr-1"></i>
                                <span class="text-sm font-semibold" x-text="`Rp ${car.harga.toLocaleString('id-ID')}/hari`"></span>
                            </div>
                        </div>
                        <div class="p-5">
                            <h3 class="text-xl font-bold text-gray-900 mb-1" x-text="car.merk"></h3>
                            <div class="flex items-center text-gray-500 text-sm mb-3">
                                <i class="fas fa-car text-gray-400 mr-2"></i>
                                <span x-text="car.nopol"></span>
                                <span class="mx-2">•</span>
                                <i class="fas fa-calendar-alt text-gray-400 mr-2"></i>
                                <span x-text="car.thn_beli"></span>
                            </div>
                            <p class="text-gray-600 text-sm mb-4 line-clamp-2" x-text="car.deskripsi"></p>
                            <div class="flex justify-between items-center">
                                <div class="flex items-center">
                                    <i class="fas fa-gas-pump text-gray-400 mr-1"></i>
                                    <span class="text-xs text-gray-500" x-text="car.bahan_bakar || '-'"></span>
                                </div>
                                <button @click.stop="selectedCar = car.id" 
                                        :class="{'bg-blue-600': selectedCar == car.id, 'bg-gray-200 text-gray-700': selectedCar != car.id}"
                                        class="px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                                    <span x-show="selectedCar != car.id">Pilih</span>
                                    <span x-show="selectedCar == car.id">Dipilih <i class="fas fa-check ml-1"></i></span>
                                </button>
                            </div>
                        </div>
                    </div>
                </template>
            </div>
            
            <div class="mt-8 flex justify-end">
                @if (Auth::check())
                <button @click="currentStep++" 
                        :disabled="!selectedCar" 
                        :class="{'opacity-50 cursor-not-allowed': !selectedCar, 'hover:bg-blue-700': selectedCar}" 
                        class="bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold shadow-md transition duration-300 flex items-center">
                    Lanjut <i class="fas fa-arrow-right ml-2"></i>
                </button>
                @else
                <a href="/login" class="bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold shadow-md transition duration-300 flex items-center">
                    Login <i class="fas fa-arrow-right ml-2"></i>
                </a>
                @endif
            </div>
        </div>

        <!-- Step 2: Pickup Details - Modern Form -->
        <div x-show="currentStep === 2" x-transition class="bg-white rounded-2xl shadow-xl p-8" data-aos="fade-up">
            <div class="mb-8">
                <h2 class="text-2xl font-bold text-gray-900">Detail Sewa</h2>
                <p class="text-gray-500">Tentukan lokasi dan tanggal pengambilan & pengembalian</p>
            </div>
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <div>
                    <div class="space-y-6">
                        <!-- Pickup Location -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Lokasi Pengambilan</label>
                            <div class="relative">
                                <select x-model="pickupLocation" class="block appearance-none w-full bg-white border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded-lg leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    <option value="">Pilih Lokasi Pengambilan</option>
                                    <template x-for="loc in pickupLocations" :key="loc.id">
                                        <option :value="loc.id" x-text="loc.nama"></option>
                                    </template>
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Return Location -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Lokasi Pengembalian</label>
                            <div class="relative">
                                <select x-model="returnLocation" class="block appearance-none w-full bg-white border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded-lg leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    <option value="">Pilih Lokasi Pengembalian</option>
                                    <template x-for="loc in returnLocations" :key="loc.id">
                                        <option :value="loc.id" x-text="loc.nama"></option>
                                    </template>
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-8">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Durasi Sewa</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Pickup Date -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Pengambilan</label>
                                <div class="relative">
                                    <input type="date" 
                                           x-model="pickupDate" 
                                           @change="calculateBiaya()"
                                           :min="new Date().toISOString().split('T')[0]"
                                           class="block appearance-none w-full bg-white border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded-lg leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                        <i class="fas fa-calendar-day"></i>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Pickup Time -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Waktu Pengambilan</label>
                                <div class="relative">
                                    <input type="time" 
                                           x-model="pickupTime" 
                                           class="block appearance-none w-full bg-white border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded-lg leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                        <i class="fas fa-clock"></i>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Return Date -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Pengembalian</label>
                                <div class="relative">
                                    <input type="date" 
                                           x-model="returnDate" 
                                           @change="calculateBiaya()"
                                           :min="pickupDate || new Date().toISOString().split('T')[0]"
                                           class="block appearance-none w-full bg-white border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded-lg leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                        <i class="fas fa-calendar-day"></i>
                                    </div>
                                </div>
                            </div>

                            <!-- Return Time -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Waktu Pengembalian</label>
                                <div class="relative">
                                    <input type="time" 
                                           x-model="returnTime" 
                                           class="block appearance-none w-full bg-white border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded-lg leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                        <i class="fas fa-clock"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Summary Card -->
                <div>
                    <div class="bg-gray-50 rounded-xl p-6 border border-gray-100 sticky top-6">
                        <h3 class="text-lg font-bold text-gray-900 mb-4">Ringkasan Pesanan</h3>
                        
                        <template x-if="selectedCar">
                            <div class="flex items-start mb-6 pb-6 border-b border-gray-200">                                <template x-if="cars.find(c => c.id == selectedCar)?.gambar">
                                    <img :src="`/storage/armada-images/${cars.find(c => c.id == selectedCar)?.gambar}`" 
                                         class="w-20 h-16 object-cover rounded-lg mr-4">
                                </template>
                                <template x-if="!cars.find(c => c.id == selectedCar)?.gambar">
                                    <div class="w-20 h-16 bg-gray-200 rounded-lg mr-4 flex items-center justify-center">
                                        <i class="fas fa-car text-gray-400"></i>
                                    </div>
                                </template>
                                <div>
                                    <h4 class="font-semibold" x-text="cars.find(c => c.id == selectedCar)?.merk"></h4>
                                    <p class="text-sm text-gray-500" x-text="cars.find(c => c.id == selectedCar)?.nopol"></p>
                                </div>
                            </div>
                        </template>
                        
                        <div class="space-y-4 mb-6">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Durasi Sewa</span>
                                <span class="font-medium" x-text="pickupDate && returnDate ? Math.ceil((new Date(returnDate) - new Date(pickupDate)) / (1000 * 60 * 60 * 24)) + ' hari' : '-'"></span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Pengambilan</span>
                                <span class="font-medium" x-text="pickupLocations.find(l => l.id == pickupLocation)?.nama || '-'"></span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Pengembalian</span>
                                <span class="font-medium" x-text="returnLocations.find(l => l.id == returnLocation)?.nama || '-'"></span>
                            </div>
                        </div>
                        
                        <div class="bg-blue-50 rounded-lg p-4">
                            <div class="flex justify-between items-center">
                                <span class="font-semibold text-gray-800">Total Biaya</span>
                                <span class="text-xl font-bold text-blue-600" x-text="biaya ? 'Rp ' + biaya.toLocaleString('id-ID') : '-'"></span>
                            </div>
                            <p class="text-xs text-gray-500 mt-1" x-show="biaya > 0">* Belum termasuk biaya tambahan lainnya</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="mt-8 flex justify-between">
                <button @click="currentStep--" 
                        class="bg-white text-gray-700 px-6 py-3 rounded-lg border border-gray-300 hover:bg-gray-50 transition duration-300 flex items-center">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali
                </button>
                <button @click="currentStep++" 
                        :disabled="!pickupLocation || !returnLocation || !pickupDate || !returnDate" 
                        :class="{'opacity-50 cursor-not-allowed': !pickupLocation || !returnLocation || !pickupDate || !returnDate, 'hover:bg-blue-700': pickupLocation && returnLocation && pickupDate && returnDate}" 
                        class="bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold shadow-md transition duration-300 flex items-center">
                    Lanjut <i class="fas fa-arrow-right ml-2"></i>
                </button>
            </div>
        </div>

        <!-- Step 3: Personal Information - Modern Form -->
        <div x-show="currentStep === 3" x-transition class="bg-white rounded-2xl shadow-xl p-8" data-aos="fade-up">
            <div class="mb-8">
                <h2 class="text-2xl font-bold text-gray-900">Data Diri</h2>
                <p class="text-gray-500">Lengkapi informasi pribadi Anda untuk proses pemesanan</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Lengkap <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <input type="text" 
                                   x-model="name" 
                                   class="block appearance-none w-full bg-white border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded-lg leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                                   placeholder="Nama sesuai KTP" 
                                   required>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                <i class="fas fa-user"></i>
                            </div>
                        </div>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Nomor Telepon</label>
                        <div class="relative">
                            <input type="tel" 
                                   x-model="phone" 
                                   class="block appearance-none w-full bg-white border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded-lg leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                                   placeholder="0812-3456-7890">
                            
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                <i class="fas fa-phone"></i>
                            </div>
                        </div>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Keperluan Peminjaman</label>
                        <div class="relative">
                            <input type="text" 
                                   x-model="keperluan" 
                                   class="block appearance-none w-full bg-white border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded-lg leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                                   placeholder="Keperluan peminjaman kendaraan">
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                <i class="fas fa-clipboard-list"></i>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Upload KTP <span class="text-red-500">*</span></label>
                        <div class="border-2 border-dashed border-gray-200 rounded-lg p-6 text-center transition hover:border-blue-400" 
                             @dragover.prevent="$event.dataTransfer.dropEffect = 'copy'; $el.classList.add('border-blue-400', 'bg-blue-50')"
                             @dragleave.prevent="$el.classList.remove('border-blue-400', 'bg-blue-50')"
                             @drop.prevent="ktpFile = $event.dataTransfer.files[0]; $el.classList.remove('border-blue-400', 'bg-blue-50')">
                            <template x-if="!ktpFile">
                                <div>
                                    <i class="fas fa-cloud-upload-alt text-3xl text-gray-400 mb-3"></i>
                                    <p class="text-sm text-gray-500 mb-2">Seret file KTP ke sini atau klik untuk memilih</p>
                                    <button type="button" class="text-blue-600 text-sm font-medium hover:text-blue-700">
                                        Pilih File
                                    </button>
                                    <input type="file" 
                                           @change="handleKtp" 
                                           accept="image/*,.pdf" 
                                           class="hidden">
                                </div>
                            </template>
                            <template x-if="ktpFile">
                                <div class="flex items-center justify-center">
                                    <div class="mr-4">
                                        <i class="far fa-file-alt text-3xl text-blue-500"></i>
                                    </div>
                                    <div class="text-left">
                                        <p class="text-sm font-medium text-gray-900 mb-1" x-text="ktpFile.name"></p>
                                        <p class="text-xs text-gray-500" x-text="(ktpFile.size / 1024).toFixed(2) + ' KB'"></p>
                                        <button type="button" 
                                                @click="ktpFile = null" 
                                                class="text-red-500 text-xs mt-2 hover:text-red-700">
                                            <i class="fas fa-times mr-1"></i> Hapus
                                        </button>
                                    </div>
                                </div>
                            </template>
                        </div>
                        <p class="text-xs text-gray-500 mt-2">Format: JPG, PNG, atau PDF (maks. 5MB)</p>
                    </div>
                </div>
            </div>
            
            <div class="mt-8 flex justify-between">
                <button @click="currentStep--" 
                        class="bg-white text-gray-700 px-6 py-3 rounded-lg border border-gray-300 hover:bg-gray-50 transition duration-300 flex items-center">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali
                </button>
                <button @click="currentStep++" 
                        :disabled="!name || !ktpFile" 
                        :class="{'opacity-50 cursor-not-allowed': !name || !ktpFile, 'hover:bg-blue-700': name && ktpFile}" 
                        class="bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold shadow-md transition duration-300 flex items-center">
                    Lanjut <i class="fas fa-arrow-right ml-2"></i>
                </button>
            </div>
        </div>

        <!-- Step 4: Confirmation - Modern Summary -->
        <div x-show="currentStep === 4" x-transition class="bg-white rounded-2xl shadow-xl p-8" data-aos="fade-up">
            <div class="mb-8">
                <h2 class="text-2xl font-bold text-gray-900">Konfirmasi Pemesanan</h2>
                <p class="text-gray-500">Periksa kembali detail pemesanan Anda sebelum mengkonfirmasi</p>
            </div>
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <div>
                    <div class="bg-gray-50 rounded-xl p-6 mb-6 border border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                            <i class="fas fa-car text-blue-500 mr-2"></i> Detail Kendaraan
                        </h3>
                        <div class="space-y-4">
                            <div class="flex">
                                <div class="w-1/3 text-gray-600">Mobil</div>
                                <div class="w-2/3 font-medium" x-text="cars.find(c => c.id == selectedCar)?.merk"></div>
                            </div>
                            <div class="flex">
                                <div class="w-1/3 text-gray-600">No. Polisi</div>
                                <div class="w-2/3 font-medium" x-text="cars.find(c => c.id == selectedCar)?.nopol"></div>
                            </div>
                            <div class="flex">
                                <div class="w-1/3 text-gray-600">Tahun</div>
                                <div class="w-2/3 font-medium" x-text="cars.find(c => c.id == selectedCar)?.thn_beli"></div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-gray-50 rounded-xl p-6 mb-6 border border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                            <i class="fas fa-calendar-alt text-blue-500 mr-2"></i> Jadwal Sewa
                        </h3>
                        <div class="space-y-4">
                            <div class="flex">
                                <div class="w-1/3 text-gray-600">Pengambilan</div>
                                <div class="w-2/3">
                                    <div class="font-medium" x-text="pickupLocations.find(l => l.id == pickupLocation)?.nama"></div>
                                    <div class="text-sm text-gray-500" x-text="pickupDate"></div>
                                </div>
                            </div>
                            <div class="flex">
                                <div class="w-1/3 text-gray-600">Pengembalian</div>
                                <div class="w-2/3">
                                    <div class="font-medium" x-text="returnLocations.find(l => l.id == returnLocation)?.nama"></div>
                                    <div class="text-sm text-gray-500" x-text="returnDate"></div>
                                </div>
                            </div>
                            <div class="flex">
                                <div class="w-1/3 text-gray-600">Durasi</div>
                                <div class="w-2/3 font-medium" x-text="Math.ceil((new Date(returnDate) - new Date(pickupDate)) / (1000 * 60 * 60 * 24) + ' hari'"></div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div>
                    <div class="bg-gray-50 rounded-xl p-6 mb-6 border border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                            <i class="fas fa-user text-blue-500 mr-2"></i> Data Peminjam
                        </h3>
                        <div class="space-y-4">
                            <div class="flex">
                                <div class="w-1/3 text-gray-600">Nama</div>
                                <div class="w-2/3 font-medium" x-text="name"></div>
                            </div>
                            <div class="flex">
                                <div class="w-1/3 text-gray-600">Telepon</div>
                                <div class="w-2/3 font-medium" x-text="phone || '-'"></div>
                            </div>
                            <div class="flex">
                                <div class="w-1/3 text-gray-600">Keperluan</div>
                                <div class="w-2/3 font-medium" x-text="keperluan || '-'"></div>
                            </div>
                            <div class="flex">
                                <div class="w-1/3 text-gray-600">KTP</div>
                                <div class="w-2/3 font-medium" x-text="ktpFile ? ktpFile.name : '-'"></div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-blue-50 rounded-xl p-6 border border-blue-100">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Ringkasan Pembayaran</h3>
                        <div class="space-y-3 mb-4">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Harga Sewa</span>
                                <span class="font-medium" x-text="'Rp ' + (cars.find(c => c.id == selectedCar)?.harga.toLocaleString('id-ID') + ' x ' + Math.ceil((new Date(returnDate) - new Date(pickupDate)) / (1000 * 60 * 60 * 24) + ' hari'"></span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Biaya Tambahan</span>
                                <span class="font-medium">Rp 0</span>
                            </div>
                        </div>
                        <div class="border-t border-gray-200 pt-4">
                            <div class="flex justify-between items-center">
                                <span class="font-semibold text-gray-800">Total Pembayaran</span>
                                <span class="text-xl font-bold text-blue-600" x-text="'Rp ' + biaya.toLocaleString('id-ID')"></span>
                            </div>
                            <p class="text-xs text-gray-500 mt-2">* Pembayaran dilakukan saat pengambilan mobil</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="mt-8 flex justify-between">
                <button @click="currentStep--" 
                        class="bg-white text-gray-700 px-6 py-3 rounded-lg border border-gray-300 hover:bg-gray-50 transition duration-300 flex items-center">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali
                </button>
                <button @click="submitBooking" 
                        class="bg-green-600 text-white px-6 py-3 rounded-lg font-semibold shadow-md hover:bg-green-700 transition duration-300 flex items-center">
                    <i class="fas fa-check-circle mr-2"></i> Konfirmasi Pemesanan
                </button>
            </div>
        </div>
    </div>    <!-- Success Modal -->
    <div id="success-modal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-2xl p-8 max-w-md w-full text-center animate-bounce-in" data-aos="zoom-in">
            <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
                <i class="fas fa-check-circle text-green-500 text-4xl"></i>
            </div>
            <h3 class="text-2xl font-bold text-gray-900 mb-2">Pemesanan Berhasil!</h3>
            <p class="text-gray-600 mb-6">Terima kasih telah memesan. Kami akan segera menghubungi Anda untuk konfirmasi lebih lanjut.</p>
            <div class="w-full bg-gray-100 rounded-full h-2.5 mb-6">
                <div class="bg-green-500 h-2.5 rounded-full animate-progress" style="width: 100%"></div>
            </div>
            <button onclick="window.location.reload()" class="text-blue-600 font-medium hover:text-blue-800">
                <i class="fas fa-sync-alt mr-2"></i> Kembali ke halaman utama
            </button>
        </div>
    </div>
</div>
</div>

<script>
window.submitBooking = function(alpine) {
    const formData = new FormData();
    formData.append('armada_id', alpine.selectedCar);
    formData.append('pengambilan_id', alpine.pickupLocation);
    formData.append('pengembalian_id', alpine.returnLocation);
    formData.append('mulai', alpine.pickupDate);
    formData.append('waktu_pengambilan', alpine.pickupTime);
    formData.append('selesai', alpine.returnDate);
    formData.append('waktu_pengembalian', alpine.returnTime);
    formData.append('nama_peminjam', alpine.name);
    formData.append('phone', alpine.phone);
    formData.append('keperluan_pinjam', alpine.keperluan || '');
    formData.append('biaya', alpine.biaya);
    
    if (alpine.ktpFile) {
        formData.append('ktp_peminjam', alpine.ktpFile);
    }

    const csrfToken = document.querySelector('meta[name=csrf-token]')?.getAttribute('content');
    
    if (!csrfToken) {
        alert('CSRF token not found. Please refresh the page.');
        return;
    }

    fetch('/booking/store', {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': csrfToken,
        },
    })
    .then(response => {
        if (!response.ok) {
            return response.json().then(err => {
                console.error('Validation errors:', err.errors);
                throw err;
            });
        }
        return response.json();
    })
    .then(data => {
        if(data.success) {
            const modal = document.getElementById('success-modal');
            modal.classList.remove('hidden');
            setTimeout(() => {
                window.location.reload();
            }, 3000);
        } else {
            alert('Gagal booking: ' + (data.message || 'Unknown error'));
        }
    })
    .catch(error => {
        console.error('Error:', error);
        if (error.errors) {
            const errorMessages = Object.values(error.errors).flat();
            alert('Validasi gagal:\n' + errorMessages.join('\n'));
        } else {
            alert('Gagal booking: ' + (error.message || 'Terjadi kesalahan pada server'));
        }
    });
}
</script>
@endsection
