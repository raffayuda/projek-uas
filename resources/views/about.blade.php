@extends('layouts.index')
@section('content')
<style>
    /* Animation for number counting */
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    /* Custom animation classes */
    .animate-fadeInUp {
        animation: fadeInUp 0.6s ease-out forwards;
    }

    /* Modern glass card effect */
    .glass-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    /* Gradient text */
    .gradient-text-modern {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    /* Floating animation */
    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-10px); }
    }

    .float-animation {
        animation: float 3s ease-in-out infinite;
    }
</style>

<!-- Booking Form Section (unchanged) -->
<div class="booking-header">
    <div class="hero-pattern"></div>
    <img src="https://images.unsplash.com/photo-1503376780353-7e6692767b70?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80" 
         alt="Tentang Kami" 
         class="hero-car">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative w-full">
        <div class="hero-content text-center">
            <div class="hero-badge" data-aos="fade-up">
                <i class="fas fa-building"></i>
                <span class="text-white">Tentang Perusahaan Kami</span>
            </div>
            <h1 class="text-5xl font-extrabold text-white sm:text-6xl lg:text-7xl mb-8" data-aos="fade-up" data-aos-delay="100">
                Tentang <span class="gradient-text">DrivEasy</span>
            </h1>
            <p class="text-2xl text-gray-200 max-w-3xl mx-auto mb-12" data-aos="fade-up" data-aos-delay="200">
                Kenali cerita kami, misi kami, dan komitmen kami untuk memberikan 
                pengalaman rental mobil terbaik di Indonesia.
            </p>
            <div class="hero-stats" data-aos="fade-up" data-aos-delay="300">
                <div class="stat-card">
                    <div class="stat-number">13+</div>
                    <div class="stat-label">Tahun Pengalaman</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">100%</div>
                    <div class="stat-label">Kepuasan</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">Kepercayaan</div>
                    <div class="stat-label">Prioritas Kami</div>
                </div>
            </div>
        </div>
    </div>
    <!-- Scroll Indicator -->
    <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 animate-bounce" data-aos="fade-up" data-aos-delay="1000">
        <i class="fas fa-chevron-down text-white text-2xl"></i>
    </div>
</div>

<!-- About Section -->
<div class="bg-gradient-to-b from-gray-50 to-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
        <!-- Our Story - Ultra Modern Design -->
        <div class="mb-40" data-aos="fade-up">
            <div class="grid lg:grid-cols-2 gap-16 items-center">
                <div class="relative">
                    <!-- Main Image with Modern Frame -->
                    <div class="relative">
                        <div class="absolute -inset-4 bg-gradient-to-r from-blue-500 to-purple-600 rounded-3xl blur opacity-20"></div>
                        <div class="relative bg-white p-3 rounded-3xl shadow-2xl">
                            <img src="https://images.unsplash.com/photo-1449824913935-59a10b8d2000?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80" 
                                 alt="CarRental Pro Office"
                                 class="w-full h-96 object-cover rounded-2xl">
                        </div>
                    </div>
                    
                    <!-- Floating Stats Card -->
                    <div class="absolute -top-8 -right-8 glass-card p-6 rounded-2xl shadow-xl float-animation">
                        <div class="text-center">
                            <div class="text-3xl font-bold gradient-text-modern mb-2">13+</div>
                            <div class="text-sm text-gray-600">Years Excellence</div>
                        </div>
                    </div>
                    
                    <!-- Quote Card -->
                    <div class="absolute -bottom-8 -left-8 glass-card p-6 rounded-2xl shadow-xl max-w-xs">
                        <div class="flex items-start gap-3">
                            <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-purple-600 rounded-lg flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-quote-right text-white text-sm"></i>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-800 mb-2">"Excellence is our standard"</p>
                                <p class="text-xs text-gray-500">- Boday Stevano</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="space-y-8">
                    <div>
                        <div class="inline-flex items-center gap-2 bg-blue-50 text-blue-600 px-4 py-2 rounded-full text-sm font-medium mb-4">
                            <i class="fas fa-star"></i>
                            <span>Sejak 2012</span>
                        </div>
                        <h2 class="text-5xl font-bold mb-6 leading-tight">
                            Menghadirkan 
                            <span class="gradient-text-modern">Keunggulan</span> 
                            di Setiap Perjalanan
                        </h2>
                        <p class="text-gray-600 text-lg leading-relaxed mb-8">
                            Didirikan dengan visi untuk merevolusi mobilitas, DriveEase telah berkembang dari armada sederhana menjadi layanan rental mobil mewah terdepan di Jakarta, memberikan pengalaman tak terlupakan kepada ribuan klien yang menuntut kualitas.
                        </p>
                    </div>
                    
                    <!-- Modern Stats Grid -->
                    <div class="grid grid-cols-2 gap-6">
                        <div class="group relative overflow-hidden bg-gradient-to-br from-blue-500 to-blue-600 p-6 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-2">
                            <div class="absolute top-0 right-0 w-20 h-20 bg-white/10 rounded-full -translate-y-10 translate-x-10"></div>
                            <div class="relative">
                                <div class="text-4xl font-bold text-white mb-2">10</div>
                                <div class="text-blue-100">Tahun Keunggulan</div>
                            </div>
                        </div>
                        <div class="group relative overflow-hidden bg-gradient-to-br from-purple-500 to-purple-600 p-6 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-2">
                            <div class="absolute top-0 right-0 w-20 h-20 bg-white/10 rounded-full -translate-y-10 translate-x-10"></div>
                            <div class="relative">
                                <div class="text-4xl font-bold text-white mb-2" x-data="{ count: 90 }" x-intersect="() => { let interval = setInterval(() => { if (count < 20) count++; else clearInterval(interval) }, 10) }" x-text="count + '%'">90%</div>
                                <div class="text-purple-100">Klien Puas</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Our Values - Redesigned with Modern Cards -->
        <div class="mb-40" data-aos="fade-up">
            <div class="text-center max-w-4xl mx-auto mb-20">
                <div class="inline-flex items-center gap-2 bg-gradient-to-r from-blue-50 to-purple-50 text-blue-600 px-6 py-3 rounded-full text-sm font-medium mb-6">
                    <i class="fas fa-gem"></i>
                    <span>Nilai Inti Kami</span>
                </div>
                <h2 class="text-5xl font-bold mb-6">
                    Perbedaan <span class="gradient-text-modern">DriveEasy</span>
                </h2>
                <p class="text-gray-600 text-xl leading-relaxed">
                    Kami tidak hanya menyewakan mobil - kami memberikan pengalaman luar biasa yang dibangun atas prinsip-prinsip dasar ini
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Card 1 -->
                <div class="group relative">
                    <div class="absolute -inset-2 bg-gradient-to-r from-blue-500 to-purple-600 rounded-3xl blur opacity-0 group-hover:opacity-20 transition duration-700"></div>
                    <div class="relative bg-white p-8 rounded-3xl shadow-lg hover:shadow-2xl transition-all duration-700 hover:-translate-y-4 border border-gray-100">
                        <div class="relative">
                            <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition duration-500">
                                <i class="fas fa-shield-alt text-2xl text-white"></i>
                            </div>
                            <div class="absolute -top-2 -right-2 w-6 h-6 bg-green-400 rounded-full opacity-0 group-hover:opacity-100 transition duration-500">
                                <i class="fas fa-check text-xs text-white absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2"></i>
                            </div>
                        </div>
                        <h3 class="text-2xl font-bold mb-4 group-hover:text-blue-600 transition duration-500">Keamanan Tanpa Kompromi</h3>
                        <p class="text-gray-600 mb-6 leading-relaxed">Setiap kendaraan menjalani 150 poin inspeksi dan perawatan rutin untuk ketenangan pikiran Anda.</p>
                        <div class="flex items-center text-blue-600 font-medium group-hover:gap-2 transition-all duration-500">
                            <span>Pelajari Lebih</span>
                            <i class="fas fa-arrow-right ml-2 group-hover:translate-x-2 transition duration-500"></i>
                        </div>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="group relative">
                    <div class="absolute -inset-2 bg-gradient-to-r from-purple-500 to-pink-600 rounded-3xl blur opacity-0 group-hover:opacity-20 transition duration-700"></div>
                    <div class="relative bg-white p-8 rounded-3xl shadow-lg hover:shadow-2xl transition-all duration-700 hover:-translate-y-4 border border-gray-100">
                        <div class="relative">
                            <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition duration-500">
                                <i class="fas fa-gem text-2xl text-white"></i>
                            </div>
                            <div class="absolute -top-2 -right-2 w-6 h-6 bg-green-400 rounded-full opacity-0 group-hover:opacity-100 transition duration-500">
                                <i class="fas fa-check text-xs text-white absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2"></i>
                            </div>
                        </div>
                        <h3 class="text-2xl font-bold mb-4 group-hover:text-purple-600 transition duration-500">Keunggulan Terkurasi</h3>
                        <p class="text-gray-600 mb-6 leading-relaxed">Hanya 1 dari 10 kendaraan yang memenuhi standar ketat kami untuk dimasukkan dalam koleksi DriveEasy.</p>
                        <div class="flex items-center text-purple-600 font-medium group-hover:gap-2 transition-all duration-500">
                            <span>Armada Kami</span>
                            <i class="fas fa-arrow-right ml-2 group-hover:translate-x-2 transition duration-500"></i>
                        </div>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="group relative">
                    <div class="absolute -inset-2 bg-gradient-to-r from-green-500 to-teal-600 rounded-3xl blur opacity-0 group-hover:opacity-20 transition duration-700"></div>
                    <div class="relative bg-white p-8 rounded-3xl shadow-lg hover:shadow-2xl transition-all duration-700 hover:-translate-y-4 border border-gray-100">
                        <div class="relative">
                            <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-green-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition duration-500">
                                <i class="fas fa-headset text-2xl text-white"></i>
                            </div>
                            <div class="absolute -top-2 -right-2 w-6 h-6 bg-green-400 rounded-full opacity-0 group-hover:opacity-100 transition duration-500">
                                <i class="fas fa-check text-xs text-white absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2"></i>
                            </div>
                        </div>
                        <h3 class="text-2xl font-bold mb-4 group-hover:text-green-600 transition duration-500">Selalu Tersedia</h3>
                        <p class="text-gray-600 mb-6 leading-relaxed">Tim concierge kami memberikan layanan white-glove 24/7/365 dengan waktu respons rata-rata di bawah 5 menit.</p>
                        <div class="flex items-center text-green-600 font-medium group-hover:gap-2 transition-all duration-500">
                            <span>Hubungi Kami</span>
                            <i class="fas fa-arrow-right ml-2 group-hover:translate-x-2 transition duration-500"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Team Section - Ultra Modern Design -->
        <div class="mb-32" data-aos="fade-up">
            <div class="text-center max-w-4xl mx-auto mb-20">
                <div class="inline-flex items-center gap-2 bg-gradient-to-r from-blue-50 to-purple-50 text-blue-600 px-6 py-3 rounded-full text-sm font-medium mb-6">
                    <i class="fas fa-users"></i>
                    <span>Kenali Tim Kami</span>
                </div>
                <h2 class="text-5xl font-bold mb-6">
                    Otak di Balik <span class="gradient-text-modern">Perjalanan Sempurna</span> Anda
                </h2>
                <p class="text-gray-600 text-xl leading-relaxed">
                    Tim berpengalaman kami menggabungkan puluhan tahun keahlian otomotif dengan keramahan yang tak tertandingi
                </p>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Team Member 1 -->
                <div class="group relative">
                    <div class="absolute -inset-2 bg-gradient-to-r from-blue-500 to-purple-600 rounded-3xl blur opacity-0 group-hover:opacity-20 transition duration-700"></div>
                    <div class="relative bg-white rounded-3xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-700 hover:-translate-y-4">
                        <div class="relative overflow-hidden">
                            <img src="{{ asset('images/raffa.jpg') }}" 
                                 alt="CEO CarRental Pro" 
                                 class="w-full h-64 object-cover transition-transform duration-700 group-hover:scale-110">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition duration-700"></div>
                            <div class="absolute bottom-4 left-4 right-4 text-white opacity-0 group-hover:opacity-100 transition-all duration-700 transform translate-y-4 group-hover:translate-y-0">
                                <p class="text-sm font-medium">"Kualitas dan kepuasan pelanggan adalah prioritas utama kami."</p>
                            </div>
                        </div>
                        <div class="p-6 text-center">
                            <h3 class="text-xl font-bold mb-1">Raffa Yuda Pratama</h3>
                            <p class="text-blue-600 font-medium mb-4">Web Developer</p>
                            <div class="flex justify-center space-x-4">
                                <a href="#" class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center text-gray-400 hover:bg-blue-600 hover:text-white transition duration-300">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                                <a href="#" class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center text-gray-400 hover:bg-blue-600 hover:text-white transition duration-300">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a href="#" class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center text-gray-400 hover:bg-blue-600 hover:text-white transition duration-300">
                                    <i class="fas fa-envelope"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Team Member 2 -->
                <div class="group relative">
                    <div class="absolute -inset-2 bg-gradient-to-r from-purple-500 to-pink-600 rounded-3xl blur opacity-0 group-hover:opacity-20 transition duration-700"></div>
                    <div class="relative bg-white rounded-3xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-700 hover:-translate-y-4">
                        <div class="relative overflow-hidden">
                            <img src="{{ asset('images/noval.jpg') }}" 
                                 alt="Operations Manager" 
                                 class="w-full h-64 object-cover transition-transform duration-700 group-hover:scale-110">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition duration-700"></div>
                            <div class="absolute bottom-4 left-4 right-4 text-white opacity-0 group-hover:opacity-100 transition-all duration-700 transform translate-y-4 group-hover:translate-y-0">
                                <p class="text-sm font-medium">"Memastikan setiap detail melebihi harapan Anda."</p>
                            </div>
                        </div>
                        <div class="p-6 text-center">
                            <h3 class="text-xl font-bold mb-1">Noval Maulani</h3>
                            <p class="text-purple-600 font-medium mb-4">Manajer Operasional</p>
                            <div class="flex justify-center space-x-4">
                                <a href="#" class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center text-gray-400 hover:bg-purple-600 hover:text-white transition duration-300">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                                <a href="#" class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center text-gray-400 hover:bg-purple-600 hover:text-white transition duration-300">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a href="#" class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center text-gray-400 hover:bg-purple-600 hover:text-white transition duration-300">
                                    <i class="fas fa-envelope"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Team Member 3 -->
                <div class="group relative">
                    <div class="absolute -inset-2 bg-gradient-to-r from-green-500 to-teal-600 rounded-3xl blur opacity-0 group-hover:opacity-20 transition duration-700"></div>
                    <div class="relative bg-white rounded-3xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-700 hover:-translate-y-4">
                        <div class="relative overflow-hidden">
                            <img src="{{ asset('images/hafiz.jpg') }}" 
                                 alt="Mike Johnson" 
                                 class="w-full h-64 object-cover transition-transform duration-700 group-hover:scale-110">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition duration-700"></div>
                            <div class="absolute bottom-4 left-4 right-4 text-white opacity-0 group-hover:opacity-100 transition-all duration-700 transform translate-y-4 group-hover:translate-y-0">
                                <p class="text-sm font-medium">"Menjaga kesempurnaan di setiap kendaraan yang kami tawarkan."</p>
                            </div>
                        </div>
                        <div class="p-6 text-center">
                            <h3 class="text-xl font-bold mb-1">Hafiz Azzaidan</h3>
                            <p class="text-green-600 font-medium mb-4">Manajer Armada</p>
                            <div class="flex justify-center space-x-4">
                                <a href="#" class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center text-gray-400 hover:bg-green-600 hover:text-white transition duration-300">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                                <a href="#" class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center text-gray-400 hover:bg-green-600 hover:text-white transition duration-300">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a href="#" class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center text-gray-400 hover:bg-green-600 hover:text-white transition duration-300">
                                    <i class="fas fa-envelope"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Team Member 4 -->
                <div class="group relative">
                    <div class="absolute -inset-2 bg-gradient-to-r from-orange-500 to-red-600 rounded-3xl blur opacity-0 group-hover:opacity-20 transition duration-700"></div>
                    <div class="relative bg-white rounded-3xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-700 hover:-translate-y-4">
                        <div class="relative overflow-hidden">
                            <img src="{{ asset('images/rozi.jpg') }}" 
                                 alt="Emily Brown" 
                                 class="w-full h-64 object-cover transition-transform duration-700 group-hover:scale-110">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition duration-700"></div>
                            <div class="absolute bottom-4 left-4 right-4 text-white opacity-0 group-hover:opacity-100 transition-all duration-700 transform translate-y-4 group-hover:translate-y-0">
                                <p class="text-sm font-medium">"Kepuasan Anda adalah pencapaian terbesar kami."</p>
                            </div>
                        </div>
                        <div class="p-6 text-center">
                            <h3 class="text-xl font-bold mb-1">Muhammad Rozi</h3>
                            <p class="text-orange-600 font-medium mb-4">Hubungan Pelanggan</p>
                            <div class="flex justify-center space-x-4">
                                <a href="#" class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center text-gray-400 hover:bg-orange-600 hover:text-white transition duration-300">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                                <a href="#" class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center text-gray-400 hover:bg-orange-600 hover:text-white transition duration-300">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a href="#" class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center text-gray-400 hover:bg-orange-600 hover:text-white transition duration-300">
                                    <i class="fas fa-envelope"></i>
                                </a>
                            </div>
                        </div>
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
