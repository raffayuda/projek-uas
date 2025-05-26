
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
             alt="About Us" 
             class="hero-car">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative w-full">
            <div class="hero-content text-center">
                <div class="hero-badge" data-aos="fade-up">
                    <i class="fas fa-building"></i>
                    <span class="text-white">About Our Company</span>
                </div>
                <h1 class="text-5xl font-extrabold text-white sm:text-6xl lg:text-7xl mb-8" data-aos="fade-up" data-aos-delay="100">
                    About <span class="gradient-text">DriveEase</span>
                </h1>
                <p class="text-2xl text-gray-200 max-w-3xl mx-auto mb-12" data-aos="fade-up" data-aos-delay="200">
                    Get to know our story, our mission, and our commitment to providing 
                    the best car rental experience in Indonesia.
                </p>
                <div class="hero-stats" data-aos="fade-up" data-aos-delay="300">
                    <div class="stat-card">
                        <div class="stat-number">13+</div>
                        <div class="stat-label">Years Experience</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number">100%</div>
                        <div class="stat-label">Satisfaction</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number">Trust</div>
                        <div class="stat-label">Our Priority</div>
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
                             alt="Our Story"
                             class="w-full h-full object-cover transition-transform duration-700 hover:scale-105">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                    </div>
                    <div class="absolute -bottom-6 -right-6 bg-white p-6 rounded-2xl shadow-xl w-3/4">
                        <div class="flex items-start gap-4">
                            <div class="bg-blue-600 text-white p-3 rounded-lg">
                                <i class="fas fa-quote-right text-2xl"></i>
                            </div>
                            <div>
                                <p class="text-gray-800 font-medium">"Excellence is not a skill. It's an attitude."</p>
                                <div class="h-1 w-12 bg-blue-600 my-3"></div>
                                <p class="text-sm text-gray-500">Boday Stevano, Founder</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="lg:w-1/2">
                    <span class="text-blue-600 font-semibold mb-2 inline-block">SINCE 2010</span>
                    <h2 class="text-4xl md:text-5xl font-bold mb-6 leading-tight">Driving Excellence in Every Journey</h2>
                    <p class="text-gray-600 leading-relaxed mb-8 text-lg">
                        Founded with a vision to revolutionize mobility, DriveEase has grown from a modest fleet to Jakarta's premier luxury car rental service, delivering unforgettable experiences to thousands of discerning clients.
                    </p>
                    <div class="grid grid-cols-2 gap-6">
                        <div class="bg-gradient-to-br from-blue-600 to-blue-800 p-6 rounded-2xl text-white shadow-lg transform hover:-translate-y-2 transition duration-500">
                            <div class="text-4xl font-bold mb-2" x-data="{ count: 0 }" x-intersect="() => { let interval = setInterval(() => { if (count < 13) count++; else clearInterval(interval) }, 50) }" x-text="count">0</div>
                            <div>Years of Excellence</div>
                        </div>
                        <div class="bg-gradient-to-br from-blue-500 to-blue-700 p-6 rounded-2xl text-white shadow-lg transform hover:-translate-y-2 transition duration-500">
                            <div class="text-4xl font-bold mb-2" x-data="{ count: 0 }" x-intersect="() => { let interval = setInterval(() => { if (count < 20) count++; else clearInterval(interval) }, 10) }" x-text="count + 'K+'">0K+</div>
                            <div>Satisfied Clients</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
        <!-- Our Values - Modern Card Grid -->
        <div class="mb-32" data-aos="fade-up">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <span class="text-blue-600 font-semibold">OUR CORE VALUES</span>
                <h2 class="text-4xl md:text-5xl font-bold mt-2 mb-4">The DriveEase Difference</h2>
                <p class="text-gray-600 text-lg">We don't just rent cars - we deliver exceptional experiences built on these fundamental principles</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="group relative overflow-hidden rounded-3xl shadow-lg hover:shadow-xl transition duration-500">
                    <div class="absolute inset-0 bg-gradient-to-br from-blue-500 to-blue-600 opacity-0 group-hover:opacity-100 transition duration-500"></div>
                    <div class="relative z-10 p-8 bg-white h-full group-hover:bg-transparent transition duration-500">
                        <div class="h-16 w-16 bg-blue-100 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-white/20 transition duration-500">
                            <i class="fas fa-shield-alt text-2xl text-blue-600 group-hover:text-white transition duration-500"></i>
                        </div>
                        <h3 class="text-xl font-bold mb-4 group-hover:text-white transition duration-500">Uncompromising Safety</h3>
                        <p class="text-gray-600 group-hover:text-white/80 transition duration-500">Every vehicle undergoes 150-point inspections and regular maintenance for your peace of mind.</p>
                        <div class="mt-6">
                            <span class="inline-block px-4 py-2 bg-blue-100 text-blue-600 rounded-full text-sm font-medium group-hover:bg-white/20 group-hover:text-white transition duration-500">Learn More</span>
                        </div>
                    </div>
                </div>
                
                <div class="group relative overflow-hidden rounded-3xl shadow-lg hover:shadow-xl transition duration-500">
                    <div class="absolute inset-0 bg-gradient-to-br from-blue-500 to-blue-600 opacity-0 group-hover:opacity-100 transition duration-500"></div>
                    <div class="relative z-10 p-8 bg-white h-full group-hover:bg-transparent transition duration-500">
                        <div class="h-16 w-16 bg-blue-100 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-white/20 transition duration-500">
                            <i class="fas fa-gem text-2xl text-blue-600 group-hover:text-white transition duration-500"></i>
                        </div>
                        <h3 class="text-xl font-bold mb-4 group-hover:text-white transition duration-500">Curated Excellence</h3>
                        <p class="text-gray-600 group-hover:text-white/80 transition duration-500">Only 1 in 10 vehicles meets our stringent standards for inclusion in the DriveEase collection.</p>
                        <div class="mt-6">
                            <span class="inline-block px-4 py-2 bg-blue-100 text-blue-600 rounded-full text-sm font-medium group-hover:bg-white/20 group-hover:text-white transition duration-500">Our Fleet</span>
                        </div>
                    </div>
                </div>
    
                <div class="group relative overflow-hidden rounded-3xl shadow-lg hover:shadow-xl transition duration-500">
                    <div class="absolute inset-0 bg-gradient-to-br from-blue-500 to-blue-600 opacity-0 group-hover:opacity-100 transition duration-500"></div>
                    <div class="relative z-10 p-8 bg-white h-full group-hover:bg-transparent transition duration-500">
                        <div class="h-16 w-16 bg-blue-100 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-white/20 transition duration-500">
                            <i class="fas fa-headset text-2xl text-blue-600 group-hover:text-white transition duration-500"></i>
                        </div>
                        <h3 class="text-xl font-bold mb-4 group-hover:text-white transition duration-500">Always Available</h3>
                        <p class="text-gray-600 group-hover:text-white/80 transition duration-500">Our concierge team provides white-glove service 24/7/365 with an average response time under 5 minutes.</p>
                        <div class="mt-6">
                            <span class="inline-block px-4 py-2 bg-blue-100 text-blue-600 rounded-full text-sm font-medium group-hover:bg-white/20 group-hover:text-white transition duration-500">Contact Us</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
        <!-- Team Section - Modern Layout -->
        <div class="mb-32" data-aos="fade-up">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <span class="text-blue-600 font-semibold">MEET THE TEAM</span>
                <h2 class="text-4xl md:text-5xl font-bold mt-2 mb-4">The Minds Behind Your Perfect Ride</h2>
                <p class="text-gray-600 text-lg">Our passionate team combines decades of automotive expertise with unparalleled hospitality</p>
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
                        <p class="text-gray-600 mb-4">CEO & Founder</p>
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
                            <p class="text-sm">"Building the future of premium mobility since day one."</p>
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
                        <p class="text-gray-600 mb-4">Operations Manager</p>
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
                            <p class="text-sm">"Ensuring every detail exceeds your expectations."</p>
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
                        <p class="text-gray-600 mb-4">Fleet Manager</p>
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
                            <p class="text-sm">"Maintaining perfection in every vehicle we offer."</p>
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
                        <p class="text-gray-600 mb-4">Customer Relations</p>
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
                            <p class="text-sm">"Your satisfaction is our greatest achievement."</p>
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
</body>
</html> 