<div class="fixed inset-y-0 left-0 w-72 bg-gradient-to-br from-primary via-blue-600 to-blue-700 shadow-xl transform transition-all duration-300 z-30"
             :class="{
                'translate-x-0': (sidebarOpen || mobileSidebarOpen),
                '-translate-x-full': (!sidebarOpen && !mobileSidebarOpen)
             }">
            <!-- Logo Section -->
            <div class="p-6 flex items-center space-x-3 border-b border-blue-500/20">
                <div class="w-10 h-10 rounded-xl bg-white/10 backdrop-blur-sm flex items-center justify-center">
                    <i class="fas fa-car text-xl text-white"></i>
                </div>
                <div>
                    <h2 class="text-2xl font-bold text-white">DriveEasy</h2>
                    <p class="text-blue-200 text-xs">Car Rental System</p>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="p-4 space-y-1">
                <div class="px-3 py-2">
                    <span class="text-xs font-semibold text-blue-200 uppercase tracking-wider">Main Menu</span>
                </div>
                
                <a href="/dashboard" 
                   class="flex items-center px-4 py-3 text-white rounded-xl backdrop-blur-sm border transition-all duration-200 {{ request()->is('dashboard') ? 'bg-white/10 border-white/10' : 'hover:bg-white/10 border-transparent hover:border-white/10' }} group">
                    <i class="fas fa-tachometer-alt w-5 h-5 {{ request()->is('dashboard') ? 'text-white' : 'text-blue-200 group-hover:text-white' }} transition-colors"></i>
                    <span class="ml-3 font-medium">Dashboard</span>
                    <span class="ml-auto bg-white/20 px-2 py-0.5 rounded-lg text-xs">Home</span>
                </a>

                <a href="/armada" 
                   class="flex items-center px-4 py-3 text-white rounded-xl backdrop-blur-sm border transition-all duration-200 {{ request()->is('armada*') ? 'bg-white/10 border-white/10' : 'hover:bg-white/10 border-transparent hover:border-white/10' }} group">
                    <i class="fas fa-car w-5 h-5 {{ request()->is('armada*') ? 'text-white' : 'text-blue-200 group-hover:text-white' }} transition-colors"></i>
                    <span class="ml-3 font-medium">Armada</span>
                    <span class="ml-auto bg-white/20 px-2 py-0.5 rounded-lg text-xs">6 Cars</span>
                </a>

                <a href="/peminjaman" 
                   class="flex items-center px-4 py-3 text-white rounded-xl backdrop-blur-sm border transition-all duration-200 {{ request()->is('peminjaman*') ? 'bg-white/10 border-white/10' : 'hover:bg-white/10 border-transparent hover:border-white/10' }} group">
                    <i class="fas fa-calendar-check w-5 h-5 {{ request()->is('peminjaman*') ? 'text-white' : 'text-blue-200 group-hover:text-white' }} transition-colors"></i>
                    <span class="ml-3 font-medium">Peminjaman</span>
                    <span class="ml-auto bg-white/20 px-2 py-0.5 rounded-lg text-xs">4 Active</span>
                </a>

                <a href="/pembayaran" 
                   class="flex items-center px-4 py-3 text-white rounded-xl backdrop-blur-sm border transition-all duration-200 {{ request()->is('pembayaran*') ? 'bg-white/10 border-white/10' : 'hover:bg-white/10 border-transparent hover:border-white/10' }} group">
                    <i class="fas fa-credit-card w-5 h-5 {{ request()->is('pembayaran*') ? 'text-white' : 'text-blue-200 group-hover:text-white' }} transition-colors"></i>
                    <span class="ml-3 font-medium">Pembayaran</span>
                    <span class="ml-auto bg-white/20 px-2 py-0.5 rounded-lg text-xs">New</span>
                </a>

                <a href="/lokasi" 
                   class="flex items-center px-4 py-3 text-white rounded-xl backdrop-blur-sm border transition-all duration-200 {{ request()->is('lokasi*') ? 'bg-white/10 border-white/10' : 'hover:bg-white/10 border-transparent hover:border-white/10' }} group">
                    <i class="fas fa-map-marker-alt w-5 h-5 {{ request()->is('lokasi*') ? 'text-white' : 'text-blue-200 group-hover:text-white' }} transition-colors"></i>
                    <span class="ml-3 font-medium">Lokasi</span>
                    <span class="ml-auto bg-white/20 px-2 py-0.5 rounded-lg text-xs">5 Spots</span>
                </a>

                <div class="px-3 py-2 mt-6">
                    <span class="text-xs font-semibold text-blue-200 uppercase tracking-wider">Settings</span>
                </div>

                <a href="#" 
                   class="flex items-center px-4 py-3 text-white rounded-xl backdrop-blur-sm border transition-all duration-200 {{ request()->is('settings*') ? 'bg-white/10 border-white/10' : 'hover:bg-white/10 border-transparent hover:border-white/10' }} group">
                    <i class="fas fa-cog w-5 h-5 {{ request()->is('settings*') ? 'text-white' : 'text-blue-200 group-hover:text-white' }} transition-colors"></i>
                    <span class="ml-3 font-medium">Settings</span>
                </a>

                <a href="#" 
                   class="flex items-center px-4 py-3 text-white rounded-xl backdrop-blur-sm border transition-all duration-200 {{ request()->is('help*') ? 'bg-white/10 border-white/10' : 'hover:bg-white/10 border-transparent hover:border-white/10' }} group">
                    <i class="fas fa-question-circle w-5 h-5 {{ request()->is('help*') ? 'text-white' : 'text-blue-200 group-hover:text-white' }} transition-colors"></i>
                    <span class="ml-3 font-medium">Help & Support</span>
                </a>
            </nav>

            <!-- User Profile Section -->
            <div class="absolute bottom-0 w-full p-4 border-t border-blue-500/20">
                <div class="bg-white/10 backdrop-blur-sm rounded-xl p-3 flex items-center space-x-3 border border-white/10">
                    <div class="w-10 h-10 rounded-lg bg-white/20 flex items-center justify-center">
                        <i class="fas fa-user text-white"></i>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-white font-medium truncate">Admin</p>
                        <p class="text-blue-200 text-xs truncate">Administrator</p>
                    </div>
                    <button class="p-2 rounded-lg hover:bg-white/10 text-white transition-colors">
                        <i class="fas fa-ellipsis-v"></i>
                    </button>
                </div>
            </div>
        </div>