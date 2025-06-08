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
</style>

<!-- Booking Form Section -->
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
                Tentang <span class="gradient-text">DriveEase</span>
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
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
    <!-- Our Story - Modern Split Layout -->
    <div class="mb-32" data-aos="fade-up">
        <div class="flex flex-col lg:flex-row items-center gap-12">
            <div class="lg:w-1/2 relative">
                <div class="relative rounded-3xl overflow-hidden aspect-[4/3] shadow-2xl">
                    <img src="images/iseng2.jpg" 
                         alt="Cerita Kami"
                         class="w-full h-full object-cover transition-transform duration-700 hover:scale-105">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                </div>
                <div class="absolute -bottom-6 -right-6 bg-white p-6 rounded-2xl shadow-xl w-3/4">
                    <div class="flex items-start gap-4">
                        <div class="bg-blue-600 text-white p-3 rounded-lg">
                            <i class="fas fa-quote-right text-2xl"></i>
                        </div>
                        <div>
                            <p class="text-gray-800 font-medium">"Excellence is not a skill. It is an attitude."</p>
                            <div class="h-1 w-12 bg-blue-600 my-3"></div>
                            <p class="text-sm text-gray-500">Boday Stevano, Pendiri</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="lg:w-1/2">
                <span class="text-blue-600 font-semibold mb-2 inline-block">SEJAK 2010</span>
                <h2 class="text-4xl md:text-5xl font-bold mb-6 leading-tight">Menghadirkan Keunggulan di Setiap Perjalanan</h2>
                <p class="text-gray-600 leading-relaxed mb-8 text-lg">
                    Didirikan dengan visi untuk merevolusi mobilitas, DriveEase telah berkembang dari armada sederhana menjadi layanan rental mobil mewah terdepan di Jakarta, memberikan pengalaman tak terlupakan kepada ribuan klien yang menuntut kualitas.
                </p>
                <div class="grid grid-cols-2 gap-6">
                    <div class="bg-gradient-to-br from-blue-600 to-blue-800 p-6 rounded-2xl text-white shadow-lg transform hover:-translate-y-2 transition duration-500">
                        <div class="text-4xl font-bold mb-2" x-data="{ count: 0 }" x-intersect="() => { let interval = setInterval(() => { if (count < 13) count++; else clearInterval(interval) }, 50) }" x-text="count">0</div>
                        <div>Tahun Keunggulan</div>
                    </div>
                    <div class="bg-gradient-to-br from-blue-500 to-blue-700 p-6 rounded-2xl text-white shadow-lg transform hover:-translate-y-2 transition duration-500">
                        <div class="text-4xl font-bold mb-2" x-data="{ count: 0 }" x-intersect="() => { let interval = setInterval(() => { if (count < 20) count++; else clearInterval(interval) }, 10) }" x-text="count + 'K+'">0K+</div>
                        <div>Klien Puas</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Our Values - Modern Card Grid -->
    <div class="mb-32" data-aos="fade-up">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <span class="text-blue-600 font-semibold">NILAI INTI KAMI</span>
            <h2 class="text-4xl md:text-5xl font-bold mt-2 mb-4">Perbedaan DriveEase</h2>
            <p class="text-gray-600 text-lg">Kami tidak hanya menyewakan mobil - kami memberikan pengalaman luar biasa yang dibangun atas prinsip-prinsip dasar ini</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="group relative overflow-hidden rounded-3xl shadow-lg hover:shadow-xl transition duration-500">
                <div class="absolute inset-0 bg-gradient-to-br from-blue-500 to-blue-600 opacity-0 group-hover:opacity-100 transition duration-500"></div>
                <div class="relative z-10 p-8 bg-white h-full group-hover:bg-transparent transition duration-500">
                    <div class="h-16 w-16 bg-blue-100 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-white/20 transition duration-500">
                        <i class="fas fa-shield-alt text-2xl text-blue-600 group-hover:text-white transition duration-500"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-4 group-hover:text-white transition duration-500">Keamanan Tanpa Kompromi</h3>
                    <p class="text-gray-600 group-hover:text-white/80 transition duration-500">Setiap kendaraan menjalani 150 poin inspeksi dan perawatan rutin untuk ketenangan pikiran Anda.</p>
                    <div class="mt-6">
                        <span class="inline-block px-4 py-2 bg-blue-100 text-blue-600 rounded-full text-sm font-medium group-hover:bg-white/20 group-hover:text-white transition duration-500">Pelajari Lebih</span>
                    </div>
                </div>
            </div>
            
            <div class="group relative overflow-hidden rounded-3xl shadow-lg hover:shadow-xl transition duration-500">
                <div class="absolute inset-0 bg-gradient-to-br from-blue-500 to-blue-600 opacity-0 group-hover:opacity-100 transition duration-500"></div>
                <div class="relative z-10 p-8 bg-white h-full group-hover:bg-transparent transition duration-500">
                    <div class="h-16 w-16 bg-blue-100 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-white/20 transition duration-500">
                        <i class="fas fa-gem text-2xl text-blue-600 group-hover:text-white transition duration-500"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-4 group-hover:text-white transition duration-500">Keunggulan Terkurasi</h3>
                    <p class="text-gray-600 group-hover:text-white/80 transition duration-500">Hanya 1 dari 10 kendaraan yang memenuhi standar ketat kami untuk dimasukkan dalam koleksi DriveEase.</p>
                    <div class="mt-6">
                        <span class="inline-block px-4 py-2 bg-blue-100 text-blue-600 rounded-full text-sm font-medium group-hover:bg-white/20 group-hover:text-white transition duration-500">Armada Kami</span>
                    </div>
                </div>
            </div>

            <div class="group relative overflow-hidden rounded-3xl shadow-lg hover:shadow-xl transition duration-500">
                <div class="absolute inset-0 bg-gradient-to-br from-blue-500 to-blue-600 opacity-0 group-hover:opacity-100 transition duration-500"></div>
                <div class="relative z-10 p-8 bg-white h-full group-hover:bg-transparent transition duration-500">
                    <div class="h-16 w-16 bg-blue-100 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-white/20 transition duration-500">
                        <i class="fas fa-headset text-2xl text-blue-600 group-hover:text-white transition duration-500"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-4 group-hover:text-white transition duration-500">Selalu Tersedia</h3>
                    <p class="text-gray-600 group-hover:text-white/80 transition duration-500">Tim concierge kami memberikan layanan white-glove 24/7/365 dengan waktu respons rata-rata di bawah 5 menit.</p>
                    <div class="mt-6">
                        <span class="inline-block px-4 py-2 bg-blue-100 text-blue-600 rounded-full text-sm font-medium group-hover:bg-white/20 group-hover:text-white transition duration-500">Hubungi Kami</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Team Section - Modern Layout -->
    <div class="mb-32" data-aos="fade-up">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <span class="text-blue-600 font-semibold">KENALI TIM KAMI</span>
            <h2 class="text-4xl md:text-5xl font-bold mt-2 mb-4">Otak di Balik Perjalanan Sempurna Anda</h2>
            <p class="text-gray-600 text-lg">Tim berpengalaman kami menggabungkan puluhan tahun keahlian otomotif dengan keramahan yang tak tertandingi</p>
        </div>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            <div class="group relative overflow-hidden rounded-3xl shadow-lg">
                <div class="relative overflow-hidden aspect-square">
                    <img src="https://images.unsplash.com/photo-1560250097-0b93528c311a?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=600&q=80" 
                         alt="John Doe" 
                         class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                </div>
                <div class="p-6 text-center bg-white">
                    <h3 class="text-xl font-bold mb-1">John Doe</h3>
                    <p class="text-gray-600 mb-4">CEO & Pendiri</p>
                    <div class="flex justify-center space-x-4">
                        <a href="#" class="text-gray-400 hover:text-blue-600 transition duration-300">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-blue-600 transition duration-300">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-blue-600 transition duration-300">
                            <i class="fas fa-envelope"></i>
                        </a>
                    </div>
                    <div class="absolute -bottom-full left-0 right-0 bg-blue-600 text-white p-4 transition-all duration-500 group-hover:bottom-0">
                        <p class="text-sm">"Membangun masa depan mobilitas premium sejak hari pertama."</p>
                    </div>
                </div>
            </div>

            <div class="group relative overflow-hidden rounded-3xl shadow-lg">
                <div class="relative overflow-hidden aspect-square">
                    <img src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=600&q=80" 
                         alt="Sarah Smith" 
                         class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                </div>
                <div class="p-6 text-center bg-white">
                    <h3 class="text-xl font-bold mb-1">Sarah Smith</h3>
                    <p class="text-gray-600 mb-4">Manajer Operasional</p>
                    <div class="flex justify-center space-x-4">
                        <a href="#" class="text-gray-400 hover:text-blue-600 transition duration-300">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-blue-600 transition duration-300">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-blue-600 transition duration-300">
                            <i class="fas fa-envelope"></i>
                        </a>
                    </div>
                    <div class="absolute -bottom-full left-0 right-0 bg-blue-600 text-white p-4 transition-all duration-500 group-hover:bottom-0">
                        <p class="text-sm">"Memastikan setiap detail melebihi harapan Anda."</p>
                    </div>
                </div>
            </div>

            <div class="group relative overflow-hidden rounded-3xl shadow-lg">
                <div class="relative overflow-hidden aspect-square">
                    <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=600&q=80" 
                         alt="Mike Johnson" 
                         class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                </div>
                <div class="p-6 text-center bg-white">
                    <h3 class="text-xl font-bold mb-1">Mike Johnson</h3>
                    <p class="text-gray-600 mb-4">Manajer Armada</p>
                    <div class="flex justify-center space-x-4">
                        <a href="#" class="text-gray-400 hover:text-blue-600 transition duration-300">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-blue-600 transition duration-300">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-blue-600 transition duration-300">
                            <i class="fas fa-envelope"></i>
                        </a>
                    </div>
                    <div class="absolute -bottom-full left-0 right-0 bg-blue-600 text-white p-4 transition-all duration-500 group-hover:bottom-0">
                        <p class="text-sm">"Menjaga kesempurnaan di setiap kendaraan yang kami tawarkan."</p>
                    </div>
                </div>
            </div>

            <div class="group relative overflow-hidden rounded-3xl shadow-lg">
                <div class="relative overflow-hidden aspect-square">
                    <img src="https://images.unsplash.com/photo-1580489944761-15a19d654956?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=600&q=80" 
                         alt="Emily Brown" 
                         class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                </div>
                <div class="p-6 text-center bg-white">
                    <h3 class="text-xl font-bold mb-1">Emily Brown</h3>
                    <p class="text-gray-600 mb-4">Hubungan Pelanggan</p>
                    <div class="flex justify-center space-x-4">
                        <a href="#" class="text-gray-400 hover:text-blue-600 transition duration-300">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-blue-600 transition duration-300">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-blue-600 transition duration-300">
                            <i class="fas fa-envelope"></i>
                        </a>
                    </div>
                    <div class="absolute -bottom-full left-0 right-0 bg-blue-600 text-white p-4 transition-all duration-500 group-hover:bottom-0">
                        <p class="text-sm">"Kepuasan Anda adalah pencapaian terbesar kami."</p>
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
