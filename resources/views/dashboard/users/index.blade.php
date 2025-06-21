@extends('dashboard.layout.index')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 via-purple-50 to-pink-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header Section -->
        <div class="relative mb-8">
            <div class="absolute inset-0 bg-gradient-to-r from-purple-600 to-blue-600 rounded-3xl opacity-10"></div>
            <div class="relative bg-white/70 backdrop-blur-lg border border-white/20 rounded-3xl p-8 shadow-xl">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                    <div>
                        <h1 class="text-4xl font-bold bg-gradient-to-r from-purple-600 to-blue-600 bg-clip-text text-transparent">
                            User Management
                        </h1>
                        <p class="text-gray-600 mt-2">Kelola semua user dalam sistem</p>
                    </div>
                    <a href="{{ route('users.create') }}" 
                       class="bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700 text-white font-semibold py-3 px-6 rounded-2xl transition-all duration-300 transform hover:scale-105 hover:shadow-lg flex items-center space-x-2">
                        <i class="fas fa-plus"></i>
                        <span>Tambah User</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Search and Filter Section -->
        <div class="bg-white/60 backdrop-blur-lg border border-white/30 rounded-2xl p-6 mb-8 shadow-lg">
            <form method="GET" action="{{ route('users.index') }}" class="flex flex-col md:flex-row gap-4">
                <div class="flex-1">
                    <div class="relative">
                        <input type="text" 
                               name="search" 
                               value="{{ request('search') }}"
                               placeholder="Cari berdasarkan nama, email, atau telepon..."
                               class="w-full pl-12 pr-4 py-3 bg-white/80 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-search text-gray-400"></i>
                        </div>
                    </div>
                </div>
                <div class="flex gap-2">
                    <button type="submit" 
                            class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded-xl transition-colors flex items-center space-x-2">
                        <i class="fas fa-search"></i>
                        <span>Cari</span>
                    </button>
                    <a href="{{ route('users.index') }}" 
                       class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-xl transition-colors flex items-center space-x-2">
                        <i class="fas fa-refresh"></i>
                        <span>Reset</span>
                    </a>
                </div>
            </form>
        </div>

        <!-- Users Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($users as $user)
            <div class="bg-white/70 backdrop-blur-lg border border-white/30 rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                <!-- User Avatar and Basic Info -->
                <div class="flex items-center space-x-4 mb-4">
                    <div class="relative">
                        @if($user->avatar)
                            <img src="{{ asset('storage/avatars/' . $user->avatar) }}" 
                                 alt="{{ $user->name }}" 
                                 class="w-16 h-16 rounded-full object-cover border-4 border-white shadow-lg">
                        @else
                            <div class="w-16 h-16 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full flex items-center justify-center shadow-lg">
                                <span class="text-white font-bold text-xl">{{ substr($user->name, 0, 1) }}</span>
                            </div>
                        @endif
                        <div class="absolute -bottom-1 -right-1 w-6 h-6 bg-green-500 rounded-full border-2 border-white flex items-center justify-center">
                            <i class="fas fa-check text-white text-xs"></i>
                        </div>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-lg font-bold text-gray-900">{{ $user->name }}</h3>
                        <p class="text-sm text-gray-600">{{ $user->email }}</p>
                        @if($user->phone)
                            <p class="text-xs text-gray-500">{{ $user->phone }}</p>
                        @endif
                    </div>
                </div>

                <!-- User Details -->
                <div class="space-y-3 mb-6">                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600">Role:</span>
                        @php
                            $roleText = 'user';
                            $roleClass = 'bg-blue-100 text-blue-800';
                            
                            if (isset($user->role_user_id)) {
                                if ($user->role_user_id == 3) {
                                    $roleText = 'admin';
                                    $roleClass = 'bg-red-100 text-red-800';
                                } else {
                                    $roleText = 'user';
                                    $roleClass = 'bg-blue-100 text-blue-800';
                                }
                            } elseif (isset($user->role)) {
                                if ($user->role === 'admin') {
                                    $roleText = 'admin';
                                    $roleClass = 'bg-red-100 text-red-800';
                                } else {
                                    $roleText = 'user';
                                    $roleClass = 'bg-blue-100 text-blue-800';
                                }
                            }
                        @endphp
                        <span class="px-2 py-1 rounded-full text-xs font-semibold {{ $roleClass }}">
                            {{ ucfirst($roleText) }}
                        </span>
                    </div><div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600">Bergabung:</span>
                        <span class="text-sm font-medium text-gray-900">
                            {{ $user->created_at ? $user->created_at->format('d M Y') : 'Tanggal tidak tersedia' }}
                        </span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600">Total Peminjaman:</span>
                        <span class="text-sm font-medium text-gray-900">{{ $user->peminjamans ? $user->peminjamans->count() : 0 }}</span>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex space-x-2">
                    <a href="{{ route('users.show', $user) }}" 
                       class="flex-1 bg-blue-500 hover:bg-blue-600 text-white text-center py-2 rounded-lg transition-colors flex items-center justify-center space-x-1">
                        <i class="fas fa-eye text-sm"></i>
                        <span class="text-sm">Detail</span>
                    </a>
                    <a href="{{ route('users.edit', $user) }}" 
                       class="flex-1 bg-yellow-500 hover:bg-yellow-600 text-white text-center py-2 rounded-lg transition-colors flex items-center justify-center space-x-1">
                        <i class="fas fa-edit text-sm"></i>
                        <span class="text-sm">Edit</span>
                    </a>
                    @if($user->id !== auth()->user()->id)
                    <form action="{{ route('users.destroy', $user) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                onclick="return confirm('Apakah Anda yakin ingin menghapus user ini?')"
                                class="bg-red-500 hover:bg-red-600 text-white px-3 py-2 rounded-lg transition-colors">
                            <i class="fas fa-trash text-sm"></i>
                        </button>
                    </form>
                    @endif
                </div>
            </div>
            @empty
            <div class="col-span-full">
                <div class="bg-white/70 backdrop-blur-lg border border-white/30 rounded-2xl p-12 text-center shadow-lg">
                    <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-users text-gray-400 text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Tidak ada user ditemukan</h3>
                    <p class="text-gray-600 mb-6">Belum ada user yang terdaftar dalam sistem.</p>
                    <a href="{{ route('users.create') }}" 
                       class="bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700 text-white font-semibold py-3 px-6 rounded-2xl transition-all duration-300 transform hover:scale-105 hover:shadow-lg inline-flex items-center space-x-2">
                        <i class="fas fa-plus"></i>
                        <span>Tambah User Pertama</span>
                    </a>
                </div>
            </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($users->hasPages())
        <div class="mt-8 flex justify-center">
            {{ $users->links() }}
        </div>
        @endif
    </div>
</div>

@if(session('success'))
<div x-data="{ show: true }" x-show="show" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform scale-90" x-transition:enter-end="opacity-100 transform scale-100" x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 transform scale-100" x-transition:leave-end="opacity-0 transform scale-90" class="fixed top-4 right-4 z-50">
    <div class="bg-green-500 text-white px-6 py-4 rounded-lg shadow-lg flex items-center space-x-3">
        <i class="fas fa-check-circle"></i>
        <span>{{ session('success') }}</span>
        <button @click="show = false" class="ml-4 text-white hover:text-gray-200">
            <i class="fas fa-times"></i>
        </button>
    </div>
</div>
@endif

@if(session('error'))
<div x-data="{ show: true }" x-show="show" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform scale-90" x-transition:enter-end="opacity-100 transform scale-100" x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 transform scale-100" x-transition:leave-end="opacity-0 transform scale-90" class="fixed top-4 right-4 z-50">
    <div class="bg-red-500 text-white px-6 py-4 rounded-lg shadow-lg flex items-center space-x-3">
        <i class="fas fa-exclamation-circle"></i>
        <span>{{ session('error') }}</span>
        <button @click="show = false" class="ml-4 text-white hover:text-gray-200">
            <i class="fas fa-times"></i>
        </button>
    </div>
</div>
@endif
@endsection
