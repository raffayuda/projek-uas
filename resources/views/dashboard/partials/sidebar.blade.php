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
          <span class="ml-auto bg-white/20 px-2 py-0.5 rounded-lg text-xs">{{ $armadaCount }} Cars</span>
       </a>

       <a href="/peminjaman" 
         class="flex items-center px-4 py-3 text-white rounded-xl backdrop-blur-sm border transition-all duration-200 {{ request()->is('peminjaman*') ? 'bg-white/10 border-white/10' : 'hover:bg-white/10 border-transparent hover:border-white/10' }} group">
          <i class="fas fa-calendar-check w-5 h-5 {{ request()->is('peminjaman*') ? 'text-white' : 'text-blue-200 group-hover:text-white' }} transition-colors"></i>
          <span class="ml-3 font-medium">Peminjaman</span>
          <span class="ml-auto bg-white/20 px-2 py-0.5 rounded-lg text-xs">{{ $activePeminjamanCount }} Pending</span>
       </a>

       <a href="/pembayaran" 
         class="flex items-center px-4 py-3 text-white rounded-xl backdrop-blur-sm border transition-all duration-200 {{ request()->is('pembayaran*') ? 'bg-white/10 border-white/10' : 'hover:bg-white/10 border-transparent hover:border-white/10' }} group">
          <i class="fas fa-credit-card w-5 h-5 {{ request()->is('pembayaran*') ? 'text-white' : 'text-blue-200 group-hover:text-white' }} transition-colors"></i>
          <span class="ml-3 font-medium">Pembayaran</span>
          <span class="ml-auto bg-white/20 px-2 py-0.5 rounded-lg text-xs">{{ $pembayaranCount > 0 ? $pembayaranCount : 'New' }}</span>
       </a>

       <a href="/lokasi" 
         class="flex items-center px-4 py-3 text-white rounded-xl backdrop-blur-sm border transition-all duration-200 {{ request()->is('lokasi*') ? 'bg-white/10 border-white/10' : 'hover:bg-white/10 border-transparent hover:border-white/10' }} group">
          <i class="fas fa-map-marker-alt w-5 h-5 {{ request()->is('lokasi*') ? 'text-white' : 'text-blue-200 group-hover:text-white' }} transition-colors"></i>
          <span class="ml-3 font-medium">Lokasi</span>
          <span class="ml-auto bg-white/20 px-2 py-0.5 rounded-lg text-xs">{{ $lokasiCount }} Spots</span>
       </a>
    </nav>

    <!-- User Profile Section -->
    <div class="absolute bottom-0 w-full p-4 border-t border-blue-500/20">
       <div class="bg-white/10 backdrop-blur-sm rounded-xl p-3 flex items-center space-x-3 border border-white/10 relative" x-data="{ profileOpen: false }">
          <div class="w-10 h-10 rounded-lg bg-white/20 flex items-center justify-center">
             @if(auth()->user()->avatar)
                <img src="{{ asset('storage/avatars/' . auth()->user()->avatar) }}" 
                    alt="Avatar" 
                    class="w-full h-full rounded-lg object-cover">
             @else
                <i class="fas fa-user text-white"></i>
             @endif
          </div>
          <div class="flex-1 min-w-0">
             <p class="text-white font-medium truncate">{{ auth()->user()->name }}</p>
             <p class="text-blue-200 text-xs truncate">Administrator</p>
          </div>
          <button @click="profileOpen = !profileOpen" 
                class="p-2 rounded-lg hover:bg-white/10 text-white transition-colors">
             <i class="fas fa-ellipsis-v"></i>
          </button>

          <!-- Dropdown Menu -->
          <div x-show="profileOpen" 
              x-transition:enter="transition ease-out duration-200"
              x-transition:enter-start="opacity-0 transform scale-95"
              x-transition:enter-end="opacity-100 transform scale-100"
              x-transition:leave="transition ease-in duration-150"
              x-transition:leave-start="opacity-100 transform scale-100"
              x-transition:leave-end="opacity-0 transform scale-95"
              @click.away="profileOpen = false"
              class="absolute bottom-full left-0 right-0 mb-2 bg-white rounded-xl shadow-2xl border border-gray-200 py-2 z-50">
             

             <a href="{{ route('profile.edit') }}" 
                class="flex items-center px-4 py-3 text-gray-700 hover:bg-gray-50 transition-colors group">
                <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center mr-3 group-hover:bg-green-200 transition-colors">
                    <i class="fas fa-edit text-green-600"></i>
                </div>
                <div>
                    <p class="font-medium text-sm">Edit Profile</p>
                    <p class="text-xs text-gray-500">Update your information</p>
                </div>
             </a>

             <a href="{{ route('profile.edit') }}#password" 
                class="flex items-center px-4 py-3 text-gray-700 hover:bg-gray-50 transition-colors group">
                <div class="w-8 h-8 bg-yellow-100 rounded-lg flex items-center justify-center mr-3 group-hover:bg-yellow-200 transition-colors">
                    <i class="fas fa-key text-yellow-600"></i>
                </div>
                <div>
                    <p class="font-medium text-sm">Change Password</p>
                    <p class="text-xs text-gray-500">Update your password</p>
                </div>
             </a>

             <div class="border-t border-gray-100 my-2"></div>

             <form action="{{ route('logout') }}" method="POST" class="block">
                @csrf
                <button type="submit" 
                       class="w-full flex items-center px-4 py-3 text-red-600 hover:bg-red-50 transition-colors group">
                    <div class="w-8 h-8 bg-red-100 rounded-lg flex items-center justify-center mr-3 group-hover:bg-red-200 transition-colors">
                       <i class="fas fa-sign-out-alt text-red-600"></i>
                    </div>
                    <div class="text-left">
                       <p class="font-medium text-sm">Sign Out</p>
                       <p class="text-xs text-red-500">Sign out of your account</p>
                    </div>
                </button>
             </form>
          </div>
       </div>
    </div>
</div>
