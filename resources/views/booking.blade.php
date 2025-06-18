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

    /* Modern Form Styles */
    .glass-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
    }

    .floating-card {
        transform: translateY(0);
        transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
    }

    .floating-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 25px 50px rgba(0,0,0,0.15);
    }

    .step-progress {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    .step-circle {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        box-shadow: 0 4px 15px 0 rgba(102, 126, 234, 0.4);
    }

    .step-circle.completed {
        background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        animation: pulse 1s infinite;
    }

    .car-selection-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
        gap: 1.5rem;
    }

    .car-card {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        position: relative;
        overflow: hidden;
        transform: scale(1);
        transition: all 0.3s ease;
    }

    .car-card:hover {
        transform: scale(1.05);
        box-shadow: 0 20px 40px rgba(102, 126, 234, 0.3);
    }

    .car-card.selected {
        transform: scale(1.05);
        box-shadow: 0 0 30px rgba(102, 126, 234, 0.6);
        border: 2px solid #fff;
    }

    .car-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0.05) 100%);
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .car-card:hover::before {
        opacity: 1;
    }

    .form-input {
        background: rgba(255, 255, 255, 0.9);
        border: 2px solid transparent;
        transition: all 0.3s ease;
    }

    .form-input:focus {
        background: rgba(255, 255, 255, 1);
        border-color: #667eea;
        box-shadow: 0 0 20px rgba(102, 126, 234, 0.2);
    }

    .summary-card {
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        color: white;
    }

    .confirmation-section {
        background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
    }

    @keyframes pulse {
        0% { box-shadow: 0 0 0 0 rgba(102, 126, 234, 0.7); }
        70% { box-shadow: 0 0 0 10px rgba(102, 126, 234, 0); }
        100% { box-shadow: 0 0 0 0 rgba(102, 126, 234, 0); }
    }

    .slide-in {
        animation: slideInUp 0.5s ease-out forwards;
    }

    @keyframes slideInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Confirmation page specific styles */
    .confirmation-card {
        background: linear-gradient(135deg, rgba(255,255,255,0.9) 0%, rgba(248,250,252,0.95) 100%);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255,255,255,0.3);
        box-shadow: 0 8px 32px rgba(0,0,0,0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .confirmation-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 40px rgba(0,0,0,0.15);
    }

    /* Payment summary gradients */
    .payment-gradient {
        background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
    }

    /* Enhanced button effects */
    .btn-confirm {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        box-shadow: 0 4px 15px rgba(16, 185, 129, 0.4);
        transition: all 0.3s ease;
    }

    .btn-confirm:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(16, 185, 129, 0.6);
    }

    /* Sparkle animation for final button */
    @keyframes sparkle {
        0%, 100% { opacity: 1; transform: scale(1) rotate(0deg); }
        50% { opacity: 0.7; transform: scale(1.1) rotate(180deg); }
    }

    .btn-confirm i.fa-sparkles {
        animation: sparkle 2s infinite;
    }

    /* Premium badge animation */
    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-10px); }
    }

    .premium-badge {
        animation: float 3s ease-in-out infinite;
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

<!-- Modern Multi-step Form -->
<div class="relative bg-gradient-to-br from-blue-50 via-purple-50 to-pink-50 py-16">
    <!-- Background Pattern -->
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-20 left-20 w-32 h-32 bg-purple-300 rounded-full mix-blend-multiply filter blur-xl animate-pulse"></div>
        <div class="absolute top-40 right-20 w-40 h-40 bg-yellow-300 rounded-full mix-blend-multiply filter blur-xl animate-pulse animation-delay-2000"></div>
        <div class="absolute bottom-20 left-40 w-36 h-36 bg-pink-300 rounded-full mix-blend-multiply filter blur-xl animate-pulse animation-delay-4000"></div>
    </div>

    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
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

        <!-- Modern Progress Header -->
        <div class="text-center mb-12" data-aos="fade-up">
            <h2 class="text-4xl font-bold bg-gradient-to-r from-purple-600 to-blue-600 bg-clip-text text-transparent mb-4">
            Proses Pemesanan
            </h2>
            <p class="text-gray-600 max-w-2xl mx-auto">
            Selesaikan pemesanan rental mobil Anda hanya dalam 4 langkah sederhana. Kami telah membuat prosesnya cepat dan mudah untuk Anda.
            </p>
        </div>

        <!-- Enhanced Progress Steps -->
        <div class="mb-16" data-aos="fade-up" data-aos-delay="100">
            <div class="flex items-center justify-between relative max-w-4xl mx-auto">
            <!-- Progress Line -->
            <div class="absolute top-6 left-0 w-full h-2 bg-gray-200 rounded-full">
                <div class="h-full step-progress rounded-full transition-all duration-700 ease-out" 
                 :style="`width: ${((currentStep-1)/(totalSteps-1))*100}%`"></div>
            </div>
            
            <!-- Step Circles -->
            <template x-for="step in totalSteps" :key="step">
                <div class="relative z-10 flex flex-col items-center cursor-pointer group" @click="if(step <= currentStep) currentStep = step">
                <div :class="{
                    'step-circle text-white scale-110': currentStep >= step,
                    'bg-white border-4 border-gray-200 text-gray-400': currentStep < step,
                    'completed': currentStep > step
                }" class="w-12 h-12 rounded-full flex items-center justify-center font-bold text-lg transition-all duration-300 group-hover:scale-110">
                    <span x-show="currentStep > step" class="text-white">
                    <i class="fas fa-check text-xl"></i>
                    </span>
                    <span x-show="currentStep <= step" x-text="step"></span>
                </div>
                
                <!-- Step Labels -->
                <div class="mt-4 text-center">
                    <div class="font-semibold text-sm" :class="currentStep >= step ? 'text-purple-600' : 'text-gray-500'">
                    <span x-show="step === 1">Pilih Mobil</span>
                    <span x-show="step === 2">Detail Rental</span>
                    <span x-show="step === 3">Info Pribadi</span>
                    <span x-show="step === 4">Konfirmasi</span>
                    </div>
                    <div class="text-xs text-gray-400 mt-1">
                    <span x-show="step === 1">Pilih kendaraan Anda</span>
                    <span x-show="step === 2">Tanggal & lokasi</span>
                    <span x-show="step === 3">Informasi Anda</span>
                    <span x-show="step === 4">Tinjau & pesan</span>
                    </div>
                </div>
                </div>
            </template>
            </div>
        </div>
        
        <!-- Step 1: Modern Car Selection -->
        <div x-show="currentStep === 1" x-transition class="slide-in">
            <div class="glass-card rounded-3xl p-8 floating-card" data-aos="fade-up">
            <!-- Header with Search -->
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between mb-8">
                <div class="mb-4 lg:mb-0">
                <h3 class="text-3xl font-bold bg-gradient-to-r from-purple-600 to-blue-600 bg-clip-text text-transparent mb-2">
                    Pilih Mobil Impian Anda
                </h3>
                <p class="text-gray-600">Pilih dari koleksi kendaraan premium kami</p>
                </div>
                
                <!-- Modern Filter -->
                <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <i class="fas fa-search text-purple-400"></i>
                </div>
                <select x-model="selectedCar" class="form-input pl-12 pr-8 py-4 rounded-2xl text-gray-700 font-medium min-w-[280px] focus:outline-none">
                    <option value="">🚗 Filter berdasarkan Model Mobil</option>
                    <template x-for="car in cars" :key="car.id">
                    <option :value="car.id" x-text="`${car.merk} - ${car.nopol}`"></option>
                    </template>
                </select>
                </div>
            </div>
            
            <!-- Enhanced Car Grid -->
            <div class="car-selection-grid mb-8">
                <template x-for="car in cars" :key="car.id">
                <div @click="selectedCar = car.id; calculateBiaya()" 
                     :class="{'selected': selectedCar == car.id}"
                     class="car-card rounded-2xl overflow-hidden cursor-pointer group">
                    
                    <!-- Car Image with Overlay -->
                    <div class="relative h-56 overflow-hidden">
                    <template x-if="car.gambar">
                        <img :src="`/storage/armada-images/${car.gambar}`" 
                         :alt="car.merk"
                         class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                    </template>
                    <template x-if="!car.gambar">
                        <div class="w-full h-full bg-gradient-to-br from-gray-400 to-gray-600 flex items-center justify-center">
                        <i class="fas fa-car text-white text-6xl opacity-50"></i>
                        </div>
                    </template>
                    
                    <!-- Price Badge -->
                    <div class="absolute top-4 right-4 bg-white bg-opacity-95 backdrop-blur-sm rounded-full px-4 py-2 shadow-lg">
                        <div class="text-sm font-bold text-purple-600" x-text="`Rp ${car.harga.toLocaleString('id-ID')}`"></div>
                        <div class="text-xs text-gray-500">per hari</div>
                    </div>
                    
                    <!-- Selection Indicator -->
                    <div x-show="selectedCar == car.id" 
                         class="absolute inset-0 bg-purple-600 bg-opacity-20 flex items-center justify-center">
                        <div class="bg-white rounded-full p-4 shadow-lg">
                        <i class="fas fa-check text-purple-600 text-2xl"></i>
                        </div>
                    </div>
                    </div>
                    
                    <!-- Car Details -->
                    <div class="p-6 text-white">
                    <div class="flex items-center justify-between mb-3">
                        <h4 class="text-xl font-bold" x-text="car.merk"></h4>
                        <div class="flex items-center space-x-1">
                        <template x-for="i in 5" :key="i">
                            <i class="fas fa-star text-yellow-300 text-sm"></i>
                        </template>
                        </div>
                    </div>
                    
                    <!-- Car Specs -->
                    <div class="grid grid-cols-2 gap-4 mb-4 text-sm">
                        <div class="flex items-center space-x-2">
                        <i class="fas fa-hashtag text-purple-200"></i>
                        <span x-text="car.nopol"></span>
                        </div>
                        <div class="flex items-center space-x-2">
                        <i class="fas fa-calendar text-purple-200"></i>
                        <span x-text="car.thn_beli"></span>
                        </div>
                        <div class="flex items-center space-x-2">
                        <i class="fas fa-gas-pump text-purple-200"></i>
                        <span x-text="car.bahan_bakar || 'Bensin'"></span>
                        </div>
                        <div class="flex items-center space-x-2">
                        <i class="fas fa-users text-purple-200"></i>
                        <span>5 Kursi</span>
                        </div>
                    </div>
                    
                    <!-- Description -->
                    <p class="text-purple-100 text-sm line-clamp-2 mb-4" x-text="car.deskripsi"></p>
                    
                    <!-- Action Button -->
                    <button @click.stop="selectedCar = car.id; calculateBiaya()" 
                        :class="selectedCar == car.id ? 'bg-white text-purple-600' : 'bg-purple-500 text-white hover:bg-purple-400'"
                        class="w-full py-3 rounded-xl font-semibold transition-all duration-300 flex items-center justify-center space-x-2">
                        <span x-show="selectedCar != car.id">
                        <i class="fas fa-plus mr-2"></i>Pilih Mobil Ini
                        </span>
                        <span x-show="selectedCar == car.id">
                        <i class="fas fa-check mr-2"></i>Terpilih
                        </span>
                    </button>
                    </div>
                </div>
                </template>
            </div>
            
            <!-- Enhanced Action Buttons -->
            <div class="flex justify-end">
                @if (Auth::check())
                <button @click="currentStep++" 
                    :disabled="!selectedCar" 
                    :class="{'opacity-50 cursor-not-allowed': !selectedCar, 'hover:scale-105 hover:shadow-xl': selectedCar}" 
                    class="bg-gradient-to-r from-purple-600 to-blue-600 text-white px-8 py-4 rounded-2xl font-bold shadow-lg transition-all duration-300 flex items-center space-x-3">
                <span>Lanjut ke Detail</span>
                <i class="fas fa-arrow-right"></i>
                </button>
                @else
                <a href="/login" class="bg-gradient-to-r from-purple-600 to-blue-600 text-white px-8 py-4 rounded-2xl font-bold shadow-lg hover:scale-105 hover:shadow-xl transition-all duration-300 flex items-center space-x-3">
                <i class="fas fa-sign-in-alt"></i>
                <span>Login untuk Melanjutkan</span>
                </a>
                @endif
            </div>
            </div>
        </div>

        <!-- Step 2: Modern Rental Details -->
        <div x-show="currentStep === 2" x-transition class="slide-in">
            <div class="glass-card rounded-3xl p-8 floating-card" data-aos="fade-up">
            <!-- Header -->
            <div class="text-center mb-8">
                <h3 class="text-3xl font-bold bg-gradient-to-r from-purple-600 to-blue-600 bg-clip-text text-transparent mb-2">
                Detail Rental
                </h3>
                <p class="text-gray-600">Atur preferensi pengambilan dan pengembalian Anda</p>
            </div>
            
            <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
                <!-- Form Section -->
                <div class="xl:col-span-2 space-y-8">
                <!-- Location Selection -->
                <div class="bg-gradient-to-br from-blue-50 to-purple-50 rounded-2xl p-6">
                    <h4 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                    <div class="w-8 h-8 bg-gradient-to-r from-purple-500 to-blue-500 rounded-full flex items-center justify-center mr-3">
                        <i class="fas fa-map-marker-alt text-white text-sm"></i>
                    </div>
                    Lokasi Pengambilan & Pengembalian
                    </h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Pickup Location -->
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-3">📍 Lokasi Pengambilan</label>
                        <div class="relative">
                        <select x-model="pickupLocation" class="form-input w-full py-4 pl-12 pr-4 rounded-xl text-gray-700 font-medium">
                            <option value="">Pilih lokasi pengambilan</option>
                            <template x-for="loc in pickupLocations" :key="loc.id">
                            <option :value="loc.id" x-text="loc.nama"></option>
                            </template>
                        </select>
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i class="fas fa-location-arrow text-purple-400"></i>
                        </div>
                        </div>
                    </div>
                    
                    <!-- Return Location -->
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-3">🏁 Lokasi Pengembalian</label>
                        <div class="relative">
                        <select x-model="returnLocation" class="form-input w-full py-4 pl-12 pr-4 rounded-xl text-gray-700 font-medium">
                            <option value="">Pilih lokasi pengembalian</option>
                            <template x-for="loc in returnLocations" :key="loc.id">
                            <option :value="loc.id" x-text="loc.nama"></option>
                            </template>
                        </select>
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i class="fas fa-flag-checkered text-purple-400"></i>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
                
                <!-- Date & Time Selection -->
                <div class="bg-gradient-to-br from-pink-50 to-orange-50 rounded-2xl p-6">
                    <h4 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                    <div class="w-8 h-8 bg-gradient-to-r from-pink-500 to-orange-500 rounded-full flex items-center justify-center mr-3">
                        <i class="fas fa-calendar-alt text-white text-sm"></i>
                    </div>
                    Durasi Rental
                    </h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Pickup Date -->
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-3">📅 Tanggal Pengambilan</label>
                        <input type="date" 
                           x-model="pickupDate" 
                           @change="calculateBiaya()"
                           :min="new Date().toISOString().split('T')[0]"
                           class="form-input w-full py-4 px-4 rounded-xl text-gray-700 font-medium">
                    </div>
                    
                    <!-- Pickup Time -->
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-3">🕐 Waktu Pengambilan</label>
                        <input type="time" 
                           x-model="pickupTime" 
                           class="form-input w-full py-4 px-4 rounded-xl text-gray-700 font-medium">
                    </div>
                    
                    <!-- Return Date -->
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-3">📅 Tanggal Pengembalian</label>
                        <input type="date" 
                           x-model="returnDate" 
                           @change="calculateBiaya()"
                           :min="pickupDate || new Date().toISOString().split('T')[0]"
                           class="form-input w-full py-4 px-4 rounded-xl text-gray-700 font-medium">
                    </div>

                    <!-- Return Time -->
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-3">🕐 Waktu Pengembalian</label>
                        <input type="time" 
                           x-model="returnTime" 
                           class="form-input w-full py-4 px-4 rounded-xl text-gray-700 font-medium">
                    </div>
                    </div>
                </div>
                </div>
                
                <!-- Enhanced Summary Card -->
                <div class="xl:col-span-1 text-black">
                <div class="summary-card rounded-2xl p-6 text-white sticky top-6">
                    <h4 class="text-xl font-bold mb-6 flex items-center">
                    <i class="fas fa-file-invoice-dollar mr-3"></i>
                    Ringkasan Pemesanan
                    </h4>
                    
                    <!-- Selected Car -->
                    <template x-if="selectedCar">
                    <div class="bg-white bg-opacity-20 rounded-xl p-4 mb-6">
                        <div class="flex items-center space-x-4">
                        <template x-if="cars.find(c => c.id == selectedCar)?.gambar">
                            <img :src="`/storage/armada-images/${cars.find(c => c.id == selectedCar)?.gambar}`" 
                             class="w-16 h-12 object-cover rounded-lg">
                        </template>
                        <div>
                            <h5 class="font-bold" x-text="cars.find(c => c.id == selectedCar)?.merk"></h5>
                            <p class="text-sm opacity-80" x-text="cars.find(c => c.id == selectedCar)?.nopol"></p>
                        </div>
                        </div>
                    </div>
                    </template>
                    
                    <!-- Details -->
                    <div class="space-y-4 mb-6">
                    <div class="flex justify-between items-center">
                        <span class="flex items-center">
                        <i class="fas fa-clock mr-2 text-sm"></i>
                        Durasi
                        </span>
                        <span class="font-bold" x-text="pickupDate && returnDate ? Math.ceil((new Date(returnDate) - new Date(pickupDate)) / (1000 * 60 * 60 * 24)) + ' hari' : '-'"></span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="flex items-center">
                        <i class="fas fa-map-marker-alt mr-2 text-sm"></i>
                        Ambil
                        </span>
                        <span class="font-bold text-right text-sm" x-text="pickupLocations.find(l => l.id == pickupLocation)?.nama || '-'"></span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="flex items-center">
                        <i class="fas fa-flag-checkered mr-2 text-sm"></i>
                        Kembali
                        </span>
                        <span class="font-bold text-right text-sm" x-text="returnLocations.find(l => l.id == returnLocation)?.nama || '-'"></span>
                    </div>
                    </div>
                    
                    <!-- Total Cost -->
                    <div class="bg-white bg-opacity-20 rounded-xl p-4 text-black">
                    <div class="flex justify-between items-center">
                        <span class="text-lg font-bold">Total Biaya</span>
                        <span class="text-2xl font-bold" x-text="biaya ? 'Rp ' + biaya.toLocaleString('id-ID') : 'Rp 0'"></span>
                    </div>
                    <p class="text-xs opacity-80 mt-2" x-show="biaya > 0">* Belum termasuk layanan tambahan</p>
                    </div>
                </div>
                </div>
            </div>
            
            <!-- Action Buttons -->
            <div class="flex justify-between mt-8">
                <button @click="currentStep--" 
                    class="bg-gray-100 text-gray-700 px-8 py-4 rounded-2xl font-bold hover:bg-gray-200 transition-all duration-300 flex items-center space-x-3">
                <i class="fas fa-arrow-left"></i>
                <span>Kembali</span>
                </button>
                <button @click="currentStep++" 
                    :disabled="!pickupLocation || !returnLocation || !pickupDate || !returnDate" 
                    :class="{'opacity-50 cursor-not-allowed': !pickupLocation || !returnLocation || !pickupDate || !returnDate, 'hover:scale-105 hover:shadow-xl': pickupLocation && returnLocation && pickupDate && returnDate}" 
                    class="bg-gradient-to-r from-purple-600 to-blue-600 text-white px-8 py-4 rounded-2xl font-bold shadow-lg transition-all duration-300 flex items-center space-x-3">
                <span>Lanjutkan</span>
                <i class="fas fa-arrow-right"></i>
                </button>
            </div>
            </div>
        </div>

        <!-- Step 3: Modern Personal Information -->
        <div x-show="currentStep === 3" x-transition class="slide-in">
            <div class="glass-card rounded-3xl p-8 floating-card" data-aos="fade-up">
            <!-- Header -->
            <div class="text-center mb-8">
                <h3 class="text-3xl font-bold bg-gradient-to-r from-green-600 to-blue-600 bg-clip-text text-transparent mb-2">
                Informasi Pribadi
                </h3>
                <p class="text-gray-600">Ceritakan tentang diri Anda untuk menyelesaikan pemesanan</p>
            </div>
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Personal Details Section -->
                <div class="bg-gradient-to-br from-green-50 to-blue-50 rounded-2xl p-6 space-y-6">
                <h4 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                    <div class="w-8 h-8 bg-gradient-to-r from-green-500 to-blue-500 rounded-full flex items-center justify-center mr-3">
                    <i class="fas fa-user text-white text-sm"></i>
                    </div>
                    Informasi Kontak
                </h4>
                
                <!-- Full Name -->
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-3">
                    👤 Nama Lengkap <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                    <input type="text" 
                           x-model="name" 
                           class="form-input w-full py-4 pl-12 pr-4 rounded-xl text-gray-700 font-medium" 
                           placeholder="Masukkan nama lengkap sesuai KTP"
                           required>
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <i class="fas fa-user text-green-400"></i>
                    </div>
                    </div>
                </div>
                
                <!-- Phone Number -->
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-3">📱 Nomor Telepon</label>
                    <div class="relative">
                    <input type="tel" 
                           x-model="phone" 
                           class="form-input w-full py-4 pl-12 pr-4 rounded-xl text-gray-700 font-medium" 
                           placeholder="contoh: +62 812-3456-7890">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <i class="fas fa-phone text-green-400"></i>
                    </div>
                    </div>
                </div>
                
                <!-- Purpose -->
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-3">🎯 Tujuan Rental</label>
                    <div class="relative">
                    <input type="text" 
                           x-model="keperluan" 
                           class="form-input w-full py-4 pl-12 pr-4 rounded-xl text-gray-700 font-medium" 
                           placeholder="contoh: Perjalanan bisnis, liburan, pernikahan">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <i class="fas fa-clipboard-list text-green-400"></i>
                    </div>
                    </div>
                </div>
                </div>
                
                <!-- Document Upload Section -->
                <div class="bg-gradient-to-br from-purple-50 to-pink-50 rounded-2xl p-6">
                <h4 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                    <div class="w-8 h-8 bg-gradient-to-r from-purple-500 to-pink-500 rounded-full flex items-center justify-center mr-3">
                    <i class="fas fa-id-card text-white text-sm"></i>
                    </div>
                    Verifikasi Identitas
                </h4>
                
                <!-- ID Upload -->
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-3">
                    🆔 Upload KTP <span class="text-red-500">*</span>
                    </label>
                    <div class="border-3 border-dashed border-purple-200 rounded-2xl p-8 text-center transition-all duration-300 hover:border-purple-400 hover:bg-purple-25" 
                     @dragover.prevent="$event.dataTransfer.dropEffect = 'copy'; $el.classList.add('border-purple-400', 'bg-purple-50')"
                     @dragleave.prevent="$el.classList.remove('border-purple-400', 'bg-purple-50')"
                     @drop.prevent="ktpFile = $event.dataTransfer.files[0]; $el.classList.remove('border-purple-400', 'bg-purple-50')">
                    
                    <template x-if="!ktpFile">
                        <div class="space-y-4">
                        <div class="w-16 h-16 bg-gradient-to-r from-purple-500 to-pink-500 rounded-full flex items-center justify-center mx-auto">
                            <i class="fas fa-cloud-upload-alt text-white text-2xl"></i>
                        </div>
                        <div>
                            <p class="text-lg font-semibold text-gray-700 mb-2">Letakkan KTP Anda di sini</p>
                            <p class="text-sm text-gray-500 mb-4">atau klik untuk memilih file</p>
                            <label class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-purple-500 to-pink-500 text-white font-semibold rounded-xl cursor-pointer hover:from-purple-600 hover:to-pink-600 transition-all duration-300">
                            <i class="fas fa-folder-open mr-2"></i>
                            Pilih File
                            <input type="file" 
                                   @change="handleKtp" 
                                   accept="image/*,.pdf" 
                                   class="hidden">
                            </label>
                        </div>
                        </div>
                    </template>
                    
                    <template x-if="ktpFile">
                        <div class="space-y-4">
                        <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto">
                            <i class="fas fa-check-circle text-green-500 text-2xl"></i>
                        </div>
                        <div>
                            <p class="text-lg font-semibold text-gray-700 mb-2" x-text="ktpFile.name"></p>
                            <p class="text-sm text-gray-500 mb-4" x-text="(ktpFile.size / 1024 / 1024).toFixed(2) + ' MB'"></p>
                            <div class="flex justify-center space-x-3">
                            <button type="button" 
                                class="px-4 py-2 bg-green-100 text-green-700 rounded-lg font-medium hover:bg-green-200 transition-colors">
                                <i class="fas fa-eye mr-2"></i>Pratinjau
                            </button>
                            <button type="button" 
                                @click="ktpFile = null" 
                                class="px-4 py-2 bg-red-100 text-red-700 rounded-lg font-medium hover:bg-red-200 transition-colors">
                                <i class="fas fa-trash mr-2"></i>Hapus
                            </button>
                            </div>
                        </div>
                        </div>
                    </template>
                    </div>
                    <div class="mt-4 p-4 bg-blue-50 rounded-xl">
                    <p class="text-sm text-blue-700 flex items-center">
                        <i class="fas fa-info-circle mr-2"></i>
                        <span>Format yang diterima: JPG, PNG, PDF (maksimal 5MB)</span>
                    </p>
                    </div>
                </div>
                </div>
            </div>
            
            <!-- Action Buttons -->
            <div class="flex justify-between mt-8">
                <button @click="currentStep--" 
                    class="bg-gray-100 text-gray-700 px-8 py-4 rounded-2xl font-bold hover:bg-gray-200 transition-all duration-300 flex items-center space-x-3">
                <i class="fas fa-arrow-left"></i>
                <span>Kembali</span>
                </button>
                <button @click="currentStep++" 
                    :disabled="!name || !ktpFile" 
                    :class="{'opacity-50 cursor-not-allowed': !name || !ktpFile, 'hover:scale-105 hover:shadow-xl': name && ktpFile}" 
                    class="bg-gradient-to-r from-green-600 to-blue-600 text-white px-8 py-4 rounded-2xl font-bold shadow-lg transition-all duration-300 flex items-center space-x-3">
                <span>Lanjutkan</span>
                <i class="fas fa-arrow-right"></i>
                </button>
            </div>
            </div>
        </div>

        <!-- Step 4: Modern Confirmation Summary -->
        <div x-show="currentStep === 4" x-transition class="slide-in">
            <div class="glass-card rounded-3xl p-8 floating-card" data-aos="fade-up">
            <!-- Header -->
            <div class="text-center mb-10">
                <div class="w-20 h-20 bg-gradient-to-r from-emerald-500 to-teal-500 rounded-full flex items-center justify-center mx-auto mb-6 shadow-lg">
                <i class="fas fa-check-double text-white text-3xl"></i>
                </div>
                <h3 class="text-4xl font-bold bg-gradient-to-r from-emerald-600 to-teal-600 bg-clip-text text-transparent mb-2">
                Konfirmasi Pemesanan Anda
                </h3>
                <p class="text-gray-600 text-lg">Tinjau semua detail sebelum menyelesaikan reservasi Anda</p>
            </div>
            
            <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
                <!-- Main Details Section -->
                <div class="xl:col-span-2 space-y-6">
                <!-- Car Details Card -->
                <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-2xl p-6 border border-blue-100 transform hover:scale-105 transition-all duration-300">
                    <h4 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                    <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-indigo-500 rounded-full flex items-center justify-center mr-4">
                        <i class="fas fa-car text-white"></i>
                    </div>
                    Kendaraan Terpilih
                    </h4>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Car Image -->
                    <div class="relative">
                        <template x-if="cars.find(c => c.id == selectedCar)?.gambar">
                        <img :src="`/storage/armada-images/${cars.find(c => c.id == selectedCar)?.gambar}`" 
                             class="w-full h-48 object-cover rounded-xl shadow-lg">
                        </template>
                        <template x-if="!cars.find(c => c.id == selectedCar)?.gambar">
                        <div class="w-full h-48 bg-gradient-to-br from-gray-400 to-gray-600 rounded-xl flex items-center justify-center">
                            <i class="fas fa-car text-white text-6xl opacity-50"></i>
                        </div>
                        </template>
                        
                        <!-- Premium Badge -->
                        <div class="absolute top-4 right-4 bg-yellow-400 text-yellow-900 px-3 py-1 rounded-full text-sm font-bold premium-badge">
                        PREMIUM
                        </div>
                    </div>
                    
                    <!-- Car Specs -->
                    <div class="space-y-4">
                        <div class="flex items-center justify-between p-3 bg-white bg-opacity-60 rounded-xl">
                        <span class="flex items-center text-gray-600">
                            <i class="fas fa-tag text-blue-500 mr-3"></i>
                            Merek & Model
                        </span>
                        <span class="font-bold text-gray-800" x-text="cars.find(c => c.id == selectedCar)?.merk"></span>
                        </div>
                        <div class="flex items-center justify-between p-3 bg-white bg-opacity-60 rounded-xl">
                        <span class="flex items-center text-gray-600">
                            <i class="fas fa-hashtag text-blue-500 mr-3"></i>
                            Plat Nomor
                        </span>
                        <span class="font-bold text-gray-800" x-text="cars.find(c => c.id == selectedCar)?.nopol"></span>
                        </div>
                        <div class="flex items-center justify-between p-3 bg-white bg-opacity-60 rounded-xl">
                        <span class="flex items-center text-gray-600">
                            <i class="fas fa-calendar text-blue-500 mr-3"></i>
                            Tahun
                        </span>
                        <span class="font-bold text-gray-800" x-text="cars.find(c => c.id == selectedCar)?.thn_beli"></span>
                        </div>
                        <div class="flex items-center justify-between p-3 bg-white bg-opacity-60 rounded-xl">
                        <span class="flex items-center text-gray-600">
                            <i class="fas fa-gas-pump text-blue-500 mr-3"></i>
                            Jenis Bahan Bakar
                        </span>
                        <span class="font-bold text-gray-800">Bensin</span>
                        </div>
                    </div>
                    </div>
                </div>
                
                <!-- Rental Schedule Card -->
                <div class="bg-gradient-to-br from-purple-50 to-pink-50 rounded-2xl p-6 border border-purple-100 transform hover:scale-105 transition-all duration-300">
                    <h4 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                    <div class="w-10 h-10 bg-gradient-to-r from-purple-500 to-pink-500 rounded-full flex items-center justify-center mr-4">
                        <i class="fas fa-calendar-alt text-white"></i>
                    </div>
                    Jadwal Rental
                    </h4>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Pickup Details -->
                    <div class="bg-white bg-opacity-70 rounded-xl p-5">
                        <div class="flex items-center mb-4">
                        <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center mr-3">
                            <i class="fas fa-play text-white text-sm"></i>
                        </div>
                        <h5 class="font-bold text-green-700">PENGAMBILAN</h5>
                        </div>
                        <div class="space-y-3">
                        <div class="flex items-center">
                            <i class="fas fa-map-marker-alt text-green-500 mr-3"></i>
                            <span class="font-semibold text-gray-700" x-text="pickupLocations.find(l => l.id == pickupLocation)?.nama"></span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-calendar text-green-500 mr-3"></i>
                            <span class="text-gray-700" x-text="pickupDate"></span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-clock text-green-500 mr-3"></i>
                            <span class="text-gray-700" x-text="pickupTime || '09:00'"></span>
                        </div>
                        </div>
                    </div>
                    
                    <!-- Return Details -->
                    <div class="bg-white bg-opacity-70 rounded-xl p-5">
                        <div class="flex items-center mb-4">
                        <div class="w-8 h-8 bg-red-500 rounded-full flex items-center justify-center mr-3">
                            <i class="fas fa-stop text-white text-sm"></i>
                        </div>
                        <h5 class="font-bold text-red-700">PENGEMBALIAN</h5>
                        </div>
                        <div class="space-y-3">
                        <div class="flex items-center">
                            <i class="fas fa-map-marker-alt text-red-500 mr-3"></i>
                            <span class="font-semibold text-gray-700" x-text="returnLocations.find(l => l.id == returnLocation)?.nama"></span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-calendar text-red-500 mr-3"></i>
                            <span class="text-gray-700" x-text="returnDate"></span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-clock text-red-500 mr-3"></i>
                            <span class="text-gray-700" x-text="returnTime || '17:00'"></span>
                        </div>
                        </div>
                    </div>
                    </div>
                    
                    <!-- Duration Badge -->
                    <div class="mt-6 text-center">
                    <div class="inline-flex items-center bg-gradient-to-r from-purple-500 to-pink-500 text-white px-6 py-3 rounded-full font-bold text-lg shadow-lg">
                        <i class="fas fa-hourglass-half mr-3"></i>
                        <span x-text="Math.ceil((new Date(returnDate) - new Date(pickupDate)) / (1000 * 60 * 60 * 24)) + ' Hari Total'"></span>
                    </div>
                    </div>
                </div>
                
                <!-- Personal Information Card -->
                <div class="bg-gradient-to-br from-emerald-50 to-teal-50 rounded-2xl p-6 border border-emerald-100 transform hover:scale-105 transition-all duration-300">
                    <h4 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                    <div class="w-10 h-10 bg-gradient-to-r from-emerald-500 to-teal-500 rounded-full flex items-center justify-center mr-4">
                        <i class="fas fa-user text-white"></i>
                    </div>
                    Informasi Pelanggan
                    </h4>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-4">
                        <div class="flex items-center justify-between p-3 bg-white bg-opacity-70 rounded-xl">
                        <span class="flex items-center text-gray-600">
                            <i class="fas fa-user text-emerald-500 mr-3"></i>
                            Nama Lengkap
                        </span>
                        <span class="font-bold text-gray-800" x-text="name"></span>
                        </div>
                        <div class="flex items-center justify-between p-3 bg-white bg-opacity-70 rounded-xl">
                        <span class="flex items-center text-gray-600">
                            <i class="fas fa-phone text-emerald-500 mr-3"></i>
                            Telepon
                        </span>
                        <span class="font-bold text-gray-800" x-text="phone || 'Tidak disediakan'"></span>
                        </div>
                    </div>
                    <div class="space-y-4">
                        <div class="flex items-center justify-between p-3 bg-white bg-opacity-70 rounded-xl">
                        <span class="flex items-center text-gray-600">
                            <i class="fas fa-clipboard-list text-emerald-500 mr-3"></i>
                            Tujuan
                        </span>
                        <span class="font-bold text-gray-800" x-text="keperluan || 'Keperluan pribadi'"></span>
                        </div>
                        <div class="flex items-center justify-between p-3 bg-white bg-opacity-70 rounded-xl">
                        <span class="flex items-center text-gray-600">
                            <i class="fas fa-id-card text-emerald-500 mr-3"></i>
                            Dokumen KTP
                        </span>
                        <span class="font-bold text-gray-800" x-text="ktpFile ? '✓ Terupload' : 'Belum diupload'"></span>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
                
                <!-- Payment Summary Sidebar -->
                <div class="xl:col-span-1">
                <div class="sticky top-6">
                    <!-- Payment Summary Card -->
                    <div class="bg-gradient-to-br from-yellow-50 to-orange-50 rounded-2xl p-6 border border-yellow-100 shadow-lg">
                    <h4 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                        <div class="w-10 h-10 bg-gradient-to-r from-yellow-500 to-orange-500 rounded-full flex items-center justify-center mr-4">
                        <i class="fas fa-file-invoice-dollar text-white"></i>
                        </div>
                        Ringkasan Pembayaran
                    </h4>
                    
                    <!-- Cost Breakdown -->
                    <div class="space-y-4 mb-6">
                        <div class="flex justify-between items-center p-3 bg-white bg-opacity-70 rounded-xl">
                        <span class="text-gray-600">Tarif Harian</span>
                        <span class="font-bold text-gray-800" x-text="'Rp ' + (cars.find(c => c.id == selectedCar)?.harga.toLocaleString('id-ID') || '0')"></span>
                        </div>
                        <div class="flex justify-between items-center p-3 bg-white bg-opacity-70 rounded-xl">
                        <span class="text-gray-600">Durasi</span>
                        <span class="font-bold text-gray-800" x-text="Math.ceil((new Date(returnDate) - new Date(pickupDate)) / (1000 * 60 * 60 * 24)) + ' hari'"></span>
                        </div>
                        <div class="flex justify-between items-center p-3 bg-white bg-opacity-70 rounded-xl">
                        <span class="text-gray-600">Layanan Tambahan</span>
                        <span class="font-bold text-gray-800">Rp 0</span>
                        </div>
                        <div class="flex justify-between items-center p-3 bg-white bg-opacity-70 rounded-xl">
                        <span class="text-gray-600">Pajak & Biaya</span>
                        <span class="font-bold text-gray-800">Sudah termasuk</span>
                        </div>
                    </div>
                    
                    <!-- Total Amount -->
                    <div class="bg-gradient-to-r from-yellow-400 to-orange-400 rounded-xl p-6 text-center mb-6">
                        <div class="text-white text-sm font-medium mb-2">TOTAL BIAYA</div>
                        <div class="text-white text-3xl font-bold" x-text="'Rp ' + (biaya ? biaya.toLocaleString('id-ID') : '0')"></div>
                        <div class="text-yellow-100 text-xs mt-2">* Pembayaran saat pengambilan</div>
                    </div>
                    
                    <!-- Terms Notice -->
                    <div class="bg-blue-50 rounded-xl p-4 border border-blue-200">
                        <div class="flex items-start">
                        <i class="fas fa-info-circle text-blue-500 mr-3 mt-1"></i>
                        <div class="text-sm text-blue-700">
                            <p class="font-semibold mb-2">Catatan Penting:</p>
                            <ul class="space-y-1 text-xs">
                            <li>• Pembayaran saat pengambilan kendaraan</li>
                            <li>• KTP yang valid diperlukan</li>
                            <li>• Inspeksi kendaraan sudah termasuk</li>
                            <li>• Dukungan pelanggan 24/7</li>
                            </ul>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
            </div>
            
            <!-- Action Buttons -->
            <div class="flex justify-between mt-10">
                <button @click="currentStep--" 
                    class="bg-gray-100 text-gray-700 px-8 py-4 rounded-2xl font-bold hover:bg-gray-200 transition-all duration-300 flex items-center space-x-3 hover:scale-105">
                <i class="fas fa-arrow-left"></i>
                <span>Kembali untuk Edit</span>
                </button>
                <button @click="submitBooking" 
                    class="btn-confirm text-white px-10 py-4 rounded-2xl font-bold shadow-lg transition-all duration-300 flex items-center space-x-3 hover:scale-105 hover:shadow-xl">
                <i class="fas fa-check-circle"></i>
                <span>Konfirmasi Pemesanan</span>
                <i class="fas fa-sparkles ml-2"></i>
                </button>
            </div>
            </div>
        </div>
    </div>    <!-- Success Modal -->
    <div id="success-modal" class="fixed inset-0 z-50 hidden">
        <div class="fixed inset-0 transition-opacity" 
             style="background-color: rgba(0, 0, 0, 0.1);"></div>
        <div class="flex items-center justify-center min-h-screen p-4 relative z-10">
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
