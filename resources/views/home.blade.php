@extends('layouts.index')
@section('content')
<style>
    /* Animation for hover effects */
    .group:hover .group-hover\:scale-105 {
        transform: scale(1.05);
    }
    
    /* Gradient text effect */
    .gradient-text {
        background-clip: text;
        -webkit-background-clip: text;
        color: transparent;
        background-image: linear-gradient(to right, #3b82f6, #60a5fa);
    }
    
    /* Smooth transitions */
    .transition {
        transition-property: all;
        transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
        transition-duration: 300ms;
    }
    
    /* Longer duration for some animations */
    .duration-500 {
        transition-duration: 500ms;
    }
    </style>
    <!-- Hero Section -->
    <div class="booking-header">
        <div class="hero-pattern"></div>
        <img src="https://images.unsplash.com/photo-1503376780353-7e6692767b70?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80" 
             alt="Mobil Mewah" 
             class="hero-car">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative w-full">
            <div class="hero-content text-center">
                <div class="hero-badge" data-aos="fade-up">
                    <i class="fas fa-home"></i>
                    <span class="text-white">Selamat Datang di DrivEasy</span>
                </div>
                <h1 class="text-5xl font-extrabold text-white sm:text-6xl lg:text-7xl mb-8" data-aos="fade-up" data-aos-delay="100">
                    Selamat Datang di <span class="gradient-text">DrivEasy</span>
                </h1>
                <p class="text-2xl text-gray-200 max-w-3xl mx-auto mb-12" data-aos="fade-up" data-aos-delay="200">
                    Mitra terpercaya untuk penyewaan mobil premium di Indonesia.
                    Rasakan kenyamanan dan kemewahan di setiap perjalanan.
                </p>
                <div class="hero-stats" data-aos="fade-up" data-aos-delay="300">
                    <div class="stat-card">
                        <div class="stat-number">13+</div>
                        <div class="stat-label">Tahun Berpengalaman</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number">90%</div>
                        <div class="stat-label">Klien Puas</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number">100%</div>
                        <div class="stat-label">Kepuasan</div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Scroll Indicator -->
        <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 animate-bounce" data-aos="fade-up" data-aos-delay="1000">
            <i class="fas fa-chevron-down text-white text-2xl"></i>
        </div>
    </div>

    <!-- Modern Features Section -->
<div class="py-20 bg-gradient-to-b from-white to-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16" data-aos="fade-up">
            <span class="inline-block bg-blue-100 text-blue-600 px-4 py-1 rounded-full text-sm font-semibold mb-3">MENGAPA MEMILIH KAMI</span>
            <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                Pengalaman <span class="bg-clip-text text-transparent bg-gradient-to-r from-blue-600 to-blue-400">Sewa Mobil</span> Premium
            </h2>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                Kami mendefinisikan ulang mobilitas dengan layanan luar biasa, teknologi canggih, dan armada yang tak tertandingi
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Feature 1 -->
            <div class="group relative overflow-hidden rounded-3xl bg-white shadow-lg hover:shadow-xl transition duration-500" data-aos="fade-up">
                <div class="absolute inset-0 bg-gradient-to-br from-blue-600 to-blue-400 opacity-0 group-hover:opacity-100 transition duration-500"></div>
                <div class="relative z-10 p-8">
                    <div class="w-16 h-16 bg-blue-100 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-white/20 transition duration-500">
                        <i class="fas fa-car text-3xl text-blue-600 group-hover:text-white transition duration-500"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4 group-hover:text-white transition duration-500">Armada Beragam</h3>
                    <p class="text-gray-600 leading-relaxed group-hover:text-white/80 transition duration-500">
                        Pilih dari 150+ kendaraan yang terawat dengan cermat, mulai dari sedan mewah hingga SUV keluarga dan mobil sport performa tinggi.
                    </p>
                    <div class="mt-6">
                        <span class="inline-flex items-center text-blue-600 group-hover:text-white font-medium transition duration-500">
                            Jelajahi Armada
                            <i class="fas fa-arrow-right ml-2"></i>
                        </span>
                    </div>
                </div>
            </div>
            
            <!-- Feature 2 -->
            <div class="group relative overflow-hidden rounded-3xl bg-white shadow-lg hover:shadow-xl transition duration-500" data-aos="fade-up" data-aos-delay="100">
                <div class="absolute inset-0 bg-gradient-to-br from-blue-600 to-blue-400 opacity-0 group-hover:opacity-100 transition duration-500"></div>
                <div class="relative z-10 p-8">
                    <div class="w-16 h-16 bg-blue-100 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-white/20 transition duration-500">
                        <i class="fas fa-shield-alt text-3xl text-blue-600 group-hover:text-white transition duration-500"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4 group-hover:text-white transition duration-500">Perlindungan Menyeluruh</h3>
                    <p class="text-gray-600 leading-relaxed group-hover:text-white/80 transition duration-500">
                        Perlindungan komprehensif dengan opsi tanpa deductible dan bantuan darurat 24/7 untuk ketenangan pikiran total.
                    </p>
                    <div class="mt-6">
                        <span class="inline-flex items-center text-blue-600 group-hover:text-white font-medium transition duration-500">
                            Detail Asuransi
                            <i class="fas fa-arrow-right ml-2"></i>
                        </span>
                    </div>
                </div>
            </div>
            
            <!-- Feature 3 -->
            <div class="group relative overflow-hidden rounded-3xl bg-white shadow-lg hover:shadow-xl transition duration-500" data-aos="fade-up" data-aos-delay="200">
                <div class="absolute inset-0 bg-gradient-to-br from-blue-600 to-blue-400 opacity-0 group-hover:opacity-100 transition duration-500"></div>
                <div class="relative z-10 p-8">
                    <div class="w-16 h-16 bg-blue-100 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-white/20 transition duration-500">
                        <i class="fas fa-headset text-3xl text-blue-600 group-hover:text-white transition duration-500"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4 group-hover:text-white transition duration-500">Layanan Concierge</h3>
                    <p class="text-gray-600 leading-relaxed group-hover:text-white/80 transition duration-500">
                        Asisten mobilitas pribadi Anda tersedia 24/7 dengan waktu respons rata-rata di bawah 3 menit.
                    </p>
                    <div class="mt-6">
                        <span class="inline-flex items-center text-blue-600 group-hover:text-white font-medium transition duration-500">
                            Hubungi Dukungan
                            <i class="fas fa-arrow-right ml-2"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Popular Cars Section - Modern Design -->
<div class="py-20 bg-gradient-to-b from-gray-50 to-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16" data-aos="fade-up">
            <span class="inline-block bg-blue-100 text-blue-600 px-4 py-1 rounded-full text-sm font-semibold mb-3">ARMADA KAMI</span>
            <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                Kendaraan <span class="bg-clip-text text-transparent bg-gradient-to-r from-blue-600 to-blue-400">Unggulan</span>
            </h2>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                Kendaraan mewah dan performa terpilih untuk setiap kesempatan
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Car 1 -->
            <div class="group bg-white rounded-3xl overflow-hidden shadow-lg hover:shadow-xl transition duration-500" data-aos="fade-up">
                <div class="relative overflow-hidden h-64">
                    <img src="https://images.unsplash.com/photo-1552519507-da3b142c6e3d?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=800&q=80" 
                         alt="Chevrolet Camaro" 
                         class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                    <div class="absolute top-4 right-4 bg-blue-600 text-white px-3 py-1 rounded-full text-sm font-medium shadow-lg">
                        Sport
                    </div>
                    <div class="absolute bottom-4 left-4 flex items-center">
                        <div class="bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-sm font-medium shadow-sm">
                            <i class="fas fa-star text-yellow-400 mr-1"></i> 4.8
                        </div>
                    </div>
                </div>
                <div class="p-6">
                    <div class="flex justify-between items-start mb-2">
                        <h3 class="text-xl font-bold text-gray-900">Chevrolet Camaro</h3>
                        <span class="text-blue-600 font-bold">Rp1.500K<span class="text-gray-400 text-sm font-normal">/hari</span></span>
                    </div>
                    <p class="text-gray-500 mb-4">Mobil sport Amerika ikonik dengan performa mendebarkan</p>
                    
                    <div class="grid grid-cols-3 gap-4 mb-6">
                        <div class="text-center">
                            <div class="text-gray-400 mb-1"><i class="fas fa-calendar-alt"></i></div>
                            <span class="text-sm">2022</span>
                        </div>
                        <div class="text-center">
                            <div class="text-gray-400 mb-1"><i class="fas fa-cogs"></i></div>
                            <span class="text-sm">Otomatis</span>
                        </div>
                        <div class="text-center">
                            <div class="text-gray-400 mb-1"><i class="fas fa-gas-pump"></i></div>
                            <span class="text-sm">8,5L/100km</span>
                        </div>
                    </div>
                    
                    <button class="w-full bg-gradient-to-r from-blue-600 to-blue-400 text-white px-6 py-3 rounded-lg font-semibold hover:shadow-lg transition duration-300 group">
                        <span class="group-hover:translate-x-2 transition duration-300 inline-block">Pesan Sekarang</span>
                        <i class="fas fa-arrow-right ml-2 opacity-0 group-hover:opacity-100 transition duration-300"></i>
                    </button>
                </div>
            </div>
            
            <!-- Car 2 -->
            <div class="group bg-white rounded-3xl overflow-hidden shadow-lg hover:shadow-xl transition duration-500" data-aos="fade-up" data-aos-delay="100">
                <div class="relative overflow-hidden h-64">
                    <img src="https://images.unsplash.com/photo-1553440569-bcc63803a83d?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=800&q=80" 
                         alt="Mercedes-Benz" 
                         class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                    <div class="absolute top-4 right-4 bg-blue-600 text-white px-3 py-1 rounded-full text-sm font-medium shadow-lg">
                        Mewah
                    </div>
                    <div class="absolute bottom-4 left-4 flex items-center">
                        <div class="bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-sm font-medium shadow-sm">
                            <i class="fas fa-star text-yellow-400 mr-1"></i> 4.9
                        </div>
                    </div>
                </div>
                <div class="p-6">
                    <div class="flex justify-between items-start mb-2">
                        <h3 class="text-xl font-bold text-gray-900">Mercedes-Benz E-Class</h3>
                        <span class="text-blue-600 font-bold">Rp2.250K<span class="text-gray-400 text-sm font-normal">/hari</span></span>
                    </div>
                    <p class="text-gray-500 mb-4">Kemewahan eksekutif dengan teknologi canggih</p>
                    
                    <div class="grid grid-cols-3 gap-4 mb-6">
                        <div class="text-center">
                            <div class="text-gray-400 mb-1"><i class="fas fa-calendar-alt"></i></div>
                            <span class="text-sm">2023</span>
                        </div>
                        <div class="text-center">
                            <div class="text-gray-400 mb-1"><i class="fas fa-cogs"></i></div>
                            <span class="text-sm">Otomatis</span>
                        </div>
                        <div class="text-center">
                            <div class="text-gray-400 mb-1"><i class="fas fa-gas-pump"></i></div>
                            <span class="text-sm">7,2L/100km</span>
                        </div>
                    </div>
                    
                    <button class="w-full bg-gradient-to-r from-blue-600 to-blue-400 text-white px-6 py-3 rounded-lg font-semibold hover:shadow-lg transition duration-300 group">
                        <span class="group-hover:translate-x-2 transition duration-300 inline-block">Pesan Sekarang</span>
                        <i class="fas fa-arrow-right ml-2 opacity-0 group-hover:opacity-100 transition duration-300"></i>
                    </button>
                </div>
            </div>
            
            <!-- Car 3 -->
            <div class="group bg-white rounded-3xl overflow-hidden shadow-lg hover:shadow-xl transition duration-500" data-aos="fade-up" data-aos-delay="200">
                <div class="relative overflow-hidden h-64">
                    <img src="https://images.unsplash.com/photo-1549317661-bd32c8ce0db2?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=800&q=80" 
                         alt="Toyota RAV4" 
                         class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                    <div class="absolute top-4 right-4 bg-blue-600 text-white px-3 py-1 rounded-full text-sm font-medium shadow-lg">
                        SUV
                    </div>
                    <div class="absolute bottom-4 left-4 flex items-center">
                        <div class="bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-sm font-medium shadow-sm">
                            <i class="fas fa-star text-yellow-400 mr-1"></i> 4.7
                        </div>
                    </div>
                </div>
                <div class="p-6">
                    <div class="flex justify-between items-start mb-2">
                        <h3 class="text-xl font-bold text-gray-900">Toyota RAV4 Hybrid</h3>
                        <span class="text-blue-600 font-bold">Rp1.200K<span class="text-gray-400 text-sm font-normal">/hari</span></span>
                    </div>
                    <p class="text-gray-500 mb-4">Efisien dan luas untuk petualangan keluarga</p>
                    
                    <div class="grid grid-cols-3 gap-4 mb-6">
                        <div class="text-center">
                            <div class="text-gray-400 mb-1"><i class="fas fa-calendar-alt"></i></div>
                            <span class="text-sm">2022</span>
                        </div>
                        <div class="text-center">
                            <div class="text-gray-400 mb-1"><i class="fas fa-cogs"></i></div>
                            <span class="text-sm">Hybrid</span>
                        </div>
                        <div class="text-center">
                            <div class="text-gray-400 mb-1"><i class="fas fa-gas-pump"></i></div>
                            <span class="text-sm">6,8L/100km</span>
                        </div>
                    </div>
                    
                    <button class="w-full bg-gradient-to-r from-blue-600 to-blue-400 text-white px-6 py-3 rounded-lg font-semibold hover:shadow-lg transition duration-300 group">
                        <span class="group-hover:translate-x-2 transition duration-300 inline-block">Pesan Sekarang</span>
                        <i class="fas fa-arrow-right ml-2 opacity-0 group-hover:opacity-100 transition duration-300"></i>
                    </button>
                </div>
            </div>
        </div>
        
        <div class="text-center mt-12" data-aos="fade-up">
            <button class="inline-flex items-center px-6 py-3 border border-blue-600 text-blue-600 font-medium rounded-full hover:bg-blue-50 transition duration-300">
                Lihat Semua Armada
                <i class="fas fa-arrow-right ml-2"></i>
            </button>
        </div>
    </div>
</div>


<!-- Services Section - Modern Design -->
<div class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16" data-aos="fade-up">
            <span class="inline-block bg-blue-100 text-blue-600 px-4 py-1 rounded-full text-sm font-semibold mb-3">LAYANAN KAMI</span>
            <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                Lebih dari <span class="bg-clip-text text-transparent bg-gradient-to-r from-blue-600 to-blue-400">Sewa Mobil</span>
            </h2>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                Solusi mobilitas komprehensif yang disesuaikan dengan gaya hidup Anda
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Service 1 -->
            <div class="group relative overflow-hidden rounded-3xl bg-gray-50 shadow-sm hover:shadow-md transition duration-500" data-aos="fade-up">
                <div class="p-8">
                    <div class="w-14 h-14 bg-white rounded-xl shadow-md flex items-center justify-center mb-6">
                        <i class="fas fa-car text-2xl text-blue-600"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Armada Fleksibel</h3>
                    <p class="text-gray-600 leading-relaxed mb-6">
                        Pilih dari 12 kategori kendaraan dengan periode sewa fleksibel dari per jam hingga bulanan.
                    </p>
                    <ul class="space-y-2 text-gray-600">
                        <li class="flex items-center">
                            <i class="fas fa-check-circle text-blue-500 mr-2"></i>
                            <span>150+ kendaraan tersedia</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check-circle text-blue-500 mr-2"></i>
                            <span>Tarif harian, mingguan, bulanan</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check-circle text-blue-500 mr-2"></i>
                            <span>Sewa satu arah tersedia</span>
                        </li>
                    </ul>
                </div>
            </div>
            
            <!-- Service 2 -->
            <div class="group relative overflow-hidden rounded-3xl bg-gray-50 shadow-sm hover:shadow-md transition duration-500" data-aos="fade-up" data-aos-delay="100">
                <div class="p-8">
                    <div class="w-14 h-14 bg-white rounded-xl shadow-md flex items-center justify-center mb-6">
                        <i class="fas fa-headset text-2xl text-blue-600"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Dukungan Premium</h3>
                    <p class="text-gray-600 leading-relaxed mb-6">
                        Layanan berkelas dengan manajer akun khusus untuk klien korporat.
                    </p>
                    <ul class="space-y-2 text-gray-600">
                        <li class="flex items-center">
                            <i class="fas fa-check-circle text-blue-500 mr-2"></i>
                            <span>Dukungan multibahasa 24/7</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check-circle text-blue-500 mr-2"></i>
                            <span>Manajer akun khusus</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check-circle text-blue-500 mr-2"></i>
                            <span>Akses pemesanan prioritas</span>
                        </li>
                    </ul>
                </div>
            </div>
            
            <!-- Service 3 -->
            <div class="group relative overflow-hidden rounded-3xl bg-gray-50 shadow-sm hover:shadow-md transition duration-500" data-aos="fade-up" data-aos-delay="200">
                <div class="p-8">
                    <div class="w-14 h-14 bg-white rounded-xl shadow-md flex items-center justify-center mb-6">
                        <i class="fas fa-shield-alt text-2xl text-blue-600"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Perlindungan Total</h3>
                    <p class="text-gray-600 leading-relaxed mb-6">
                        Opsi perlindungan komprehensif yang disesuaikan dengan kebutuhan sewa Anda.
                    </p>
                    <ul class="space-y-2 text-gray-600">
                        <li class="flex items-center">
                            <i class="fas fa-check-circle text-blue-500 mr-2"></i>
                            <span>Opsi tanpa deductible</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check-circle text-blue-500 mr-2"></i>
                            <span>Bantuan darurat 24/7</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check-circle text-blue-500 mr-2"></i>
                            <span>Perlindungan kerusakan termasuk</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Testimonials Section - Modern Design -->
<div class="py-20 bg-gradient-to-b from-white to-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16" data-aos="fade-up">
            <span class="inline-block bg-blue-100 text-blue-600 px-4 py-1 rounded-full text-sm font-semibold mb-3">TESTIMONI</span>
            <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                Pengalaman <span class="bg-clip-text text-transparent bg-gradient-to-r from-blue-600 to-blue-400">Klien</span>
            </h2>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                Jangan hanya percaya kata kami - dengar dari pelanggan berharga kami
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Testimonial 1 -->
            <div class="group bg-white rounded-3xl p-8 shadow-lg hover:shadow-xl transition duration-500" data-aos="fade-up">
                <div class="flex items-center mb-6">
                    <img src="https://randomuser.me/api/portraits/men/1.jpg" alt="Budi Santoso" class="w-14 h-14 rounded-full object-cover border-2 border-white shadow-md">
                    <div class="ml-4">
                        <h4 class="text-lg font-bold text-gray-900">Budi Santoso</h4>
                        <p class="text-gray-500 text-sm">Pelancong Bisnis</p>
                    </div>
                </div>
                <div class="text-yellow-400 mb-4">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <p class="text-gray-600 leading-relaxed mb-6">
                    "Proses pemesanan yang mudah dan kondisi kendaraan yang sempurna membuat ini menjadi layanan sewa favorit saya untuk semua perjalanan bisnis."
                </p>
                <div class="text-blue-500">
                    <i class="fas fa-quote-right text-3xl opacity-20"></i>
                </div>
            </div>
            
            <!-- Testimonial 2 -->
            <div class="group bg-white rounded-3xl p-8 shadow-lg hover:shadow-xl transition duration-500" data-aos="fade-up" data-aos-delay="100">
                <div class="flex items-center mb-6">
                    <img src="https://randomuser.me/api/portraits/women/1.jpg" alt="Sari Wijaya" class="w-14 h-14 rounded-full object-cover border-2 border-white shadow-md">
                    <div class="ml-4">
                        <h4 class="text-lg font-bold text-gray-900">Sari Wijaya</h4>
                        <p class="text-gray-500 text-sm">Liburan Keluarga</p>
                    </div>
                </div>
                <div class="text-yellow-400 mb-4">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <p class="text-gray-600 leading-relaxed mb-6">
                    "SUV keluarga yang sempurna dengan semua fitur keamanan yang kami butuhkan. Tempat duduk anak bersih dan terpasang dengan benar."
                </p>
                <div class="text-blue-500">
                    <i class="fas fa-quote-right text-3xl opacity-20"></i>
                </div>
            </div>
            
            <!-- Testimonial 3 -->
            <div class="group bg-white rounded-3xl p-8 shadow-lg hover:shadow-xl transition duration-500" data-aos="fade-up" data-aos-delay="200">
                <div class="flex items-center mb-6">
                    <img src="https://randomuser.me/api/portraits/men/2.jpg" alt="Andi Rahman" class="w-14 h-14 rounded-full object-cover border-2 border-white shadow-md">
                    <div class="ml-4">
                        <h4 class="text-lg font-bold text-gray-900">Andi Rahman</h4>
                        <p class="text-gray-500 text-sm">Liburan Akhir Pekan</p>
                    </div>
                </div>
                <div class="text-yellow-400 mb-4">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
                <p class="text-gray-600 leading-relaxed mb-6">
                    "Camaro benar-benar mimpi untuk dikendarai. Pengambilan dan pengembalian lebih cepat dari layanan sewa lain yang pernah saya gunakan."
                </p>
                <div class="text-blue-500">
                    <i class="fas fa-quote-right text-3xl opacity-20"></i>
                </div>
            </div>
        </div>
    </div>
</div>

    <!-- Sponsors Section -->
    <div class="py-16 bg-gray-50 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12" data-aos="fade-up">
                <h2 class="text-3xl font-extrabold text-gray-900 sm:text-4xl mb-4">
                    Mitra <span class="gradient-text">Terpercaya</span> Kami
                </h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Kami bermitra dengan merek otomotif terkemuka dunia untuk memberikan kendaraan terbaik untuk Anda
                </p>
            </div>
            
            <div class="relative">
                <!-- Gradient Overlays -->
                <div class="absolute left-0 top-0 bottom-0 w-32 bg-gradient-to-r from-gray-50 to-transparent z-10"></div>
                <div class="absolute right-0 top-0 bottom-0 w-32 bg-gradient-to-l from-gray-50 to-transparent z-10"></div>
                
                <!-- Marquee Container -->
                <div class="relative overflow-hidden">
                    <div class="flex animate-scroll space-x-16">
                        <!-- First Set -->
                        <div class="flex-shrink-0 w-48 h-24 bg-white rounded-xl shadow-sm hover:shadow-lg transition duration-300 transform hover:-translate-y-1 p-4 flex items-center justify-center">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/9d/Toyota_carlogo.svg/2560px-Toyota_carlogo.svg.png" alt="Toyota" class="max-h-full max-w-full object-contain filter grayscale hover:grayscale-0 transition duration-300">
                        </div>
                        <div class="flex-shrink-0 w-48 h-24 bg-white rounded-xl shadow-sm hover:shadow-lg transition duration-300 transform hover:-translate-y-1 p-4 flex items-center justify-center">
                            <img src="{{ asset('images/honda.png') }}" alt="Honda" class="max-h-full max-w-full object-contain filter grayscale hover:grayscale-0 transition duration-300">
                        </div>
                        <div class="flex-shrink-0 w-48 h-24 bg-white rounded-xl shadow-sm hover:shadow-lg transition duration-300 transform hover:-translate-y-1 p-4 flex items-center justify-center">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/4/44/BMW.svg/2048px-BMW.svg.png" alt="BMW" class="max-h-full max-w-full object-contain filter grayscale hover:grayscale-0 transition duration-300">
                        </div>
                        <div class="flex-shrink-0 w-48 h-24 bg-white rounded-xl shadow-sm hover:shadow-lg transition duration-300 transform hover:-translate-y-1 p-4 flex items-center justify-center">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/90/Mercedes-Logo.svg/2560px-Mercedes-Logo.svg.png" alt="Mercedes" class="max-h-full max-w-full object-contain filter grayscale hover:grayscale-0 transition duration-300">
                        </div>
                        <div class="flex-shrink-0 w-48 h-24 bg-white rounded-xl shadow-sm hover:shadow-lg transition duration-300 transform hover:-translate-y-1 p-4 flex items-center justify-center">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/92/Audi-Logo_2016.svg/2560px-Audi-Logo_2016.svg.png" alt="Audi" class="max-h-full max-w-full object-contain filter grayscale hover:grayscale-0 transition duration-300">
                        </div>
                        <div class="flex-shrink-0 w-48 h-24 bg-white rounded-xl shadow-sm hover:shadow-lg transition duration-300 transform hover:-translate-y-1 p-4 flex items-center justify-center">
                            <img src="{{ asset('images/lexus.png') }}" alt="Lexus" class="max-h-full max-w-full object-contain filter grayscale hover:grayscale-0 transition duration-300">
                        </div>
                        <!-- Duplicate Set for Seamless Loop -->
                        <div class="flex-shrink-0 w-48 h-24 bg-white rounded-xl shadow-sm hover:shadow-lg transition duration-300 transform hover:-translate-y-1 p-4 flex items-center justify-center">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/9d/Toyota_carlogo.svg/2560px-Toyota_carlogo.svg.png" alt="Toyota" class="max-h-full max-w-full object-contain filter grayscale hover:grayscale-0 transition duration-300">
                        </div>
                        <div class="flex-shrink-0 w-48 h-24 bg-white rounded-xl shadow-sm hover:shadow-lg transition duration-300 transform hover:-translate-y-1 p-4 flex items-center justify-center">
                            <img src="{{ asset('images/honda.png') }}" alt="Honda" class="max-h-full max-w-full object-contain filter grayscale hover:grayscale-0 transition duration-300">
                        </div>
                        <div class="flex-shrink-0 w-48 h-24 bg-white rounded-xl shadow-sm hover:shadow-lg transition duration-300 transform hover:-translate-y-1 p-4 flex items-center justify-center">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/4/44/BMW.svg/2048px-BMW.svg.png" alt="BMW" class="max-h-full max-w-full object-contain filter grayscale hover:grayscale-0 transition duration-300">
                        </div>
                        <div class="flex-shrink-0 w-48 h-24 bg-white rounded-xl shadow-sm hover:shadow-lg transition duration-300 transform hover:-translate-y-1 p-4 flex items-center justify-center">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/90/Mercedes-Logo.svg/2560px-Mercedes-Logo.svg.png" alt="Mercedes" class="max-h-full max-w-full object-contain filter grayscale hover:grayscale-0 transition duration-300">
                        </div>
                        <div class="flex-shrink-0 w-48 h-24 bg-white rounded-xl shadow-sm hover:shadow-lg transition duration-300 transform hover:-translate-y-1 p-4 flex items-center justify-center">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/92/Audi-Logo_2016.svg/2560px-Audi-Logo_2016.svg.png" alt="Audi" class="max-h-full max-w-full object-contain filter grayscale hover:grayscale-0 transition duration-300">
                        </div>
                        <div class="flex-shrink-0 w-48 h-24 bg-white rounded-xl shadow-sm hover:shadow-lg transition duration-300 transform hover:-translate-y-1 p-4 flex items-center justify-center">
                            <img src="{{ asset('images/lexus.png') }}" alt="Lexus" class="max-h-full max-w-full object-contain filter grayscale hover:grayscale-0 transition duration-300">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
   
    <script>
        // Initialize AOS
        AOS.init({
            duration: 800,
            easing: 'ease-in-out',
            once: true,
            mirror: false
        });
    </script>
