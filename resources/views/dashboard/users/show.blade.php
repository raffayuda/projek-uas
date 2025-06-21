@extends('dashboard.layout.index')

@section('title', 'Detail User')

@section('content')
<div class="container mx-auto px-6 py-8">
    <!-- Header -->
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Detail User</h1>
            <p class="text-gray-600 mt-1">Informasi lengkap pengguna {{ $user->name }}</p>
        </div>
        <div class="flex space-x-3">
            <a href="{{ route('users.edit', $user) }}" 
               class="bg-green-500 hover:bg-green-600 text-white px-6 py-3 rounded-xl font-medium transition-colors duration-200 flex items-center">
                <i class="fas fa-edit mr-2"></i>
                Edit
            </a>
            <a href="{{ route('users.index') }}" 
               class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-xl font-medium transition-colors duration-200 flex items-center">
                <i class="fas fa-arrow-left mr-2"></i>
                Kembali
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- User Profile Card -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                <!-- Profile Header -->
                <div class="bg-gradient-to-r from-blue-600 to-purple-600 px-8 py-12 text-center">
                    <div class="relative">
                        @if($user->avatar)
                            <img src="{{ asset('storage/avatars/' . $user->avatar) }}" 
                                 alt="{{ $user->name }}" 
                                 class="w-32 h-32 object-cover rounded-full mx-auto border-4 border-white shadow-lg">
                        @else
                            <div class="w-32 h-32 bg-white bg-opacity-20 rounded-full mx-auto flex items-center justify-center border-4 border-white shadow-lg">
                                <i class="fas fa-user text-5xl text-white"></i>
                            </div>
                        @endif
                          <!-- Role Badge -->
                        <div class="absolute -bottom-2 left-1/2 transform -translate-x-1/2">
                            @php
                                $roleText = 'user';
                                $roleColor = 'blue';
                                
                                if (isset($user->role_user_id)) {
                                    if ($user->role_user_id == 3) {
                                        $roleText = 'admin';
                                        $roleColor = 'red';
                                    } else {
                                        $roleText = 'user';
                                        $roleColor = 'blue';
                                    }
                                } elseif (isset($user->role)) {
                                    if ($user->role === 'admin') {
                                        $roleText = 'admin';
                                        $roleColor = 'red';
                                    } else {
                                        $roleText = 'user';
                                        $roleColor = 'blue';
                                    }
                                }
                            @endphp
                            <span class="bg-white text-{{ $roleColor }}-600 px-3 py-1 rounded-full text-sm font-semibold shadow-lg">
                                <i class="fas fa-{{ $roleText == 'admin' ? 'crown' : 'user' }} mr-1"></i>
                                {{ ucfirst($roleText) }}
                            </span>
                        </div>
                    </div>
                    
                    <h2 class="text-2xl font-bold text-white mt-6">{{ $user->name }}</h2>
                    <p class="text-blue-100 mt-1">{{ $user->email }}</p>
                    
                    <!-- Status Badge -->
                    <div class="mt-4">
                        <span class="bg-green-500 bg-opacity-20 text-green-100 px-4 py-2 rounded-full text-sm font-medium">
                            <i class="fas fa-circle text-green-400 mr-2"></i>
                            Aktif
                        </span>
                    </div>
                </div>

                <!-- Contact Info -->
                <div class="p-6 space-y-4">
                    <div class="flex items-center text-gray-700">
                        <i class="fas fa-phone w-5 h-5 text-purple-500 mr-3"></i>
                        <span>{{ $user->phone ?: 'Tidak ada nomor telepon' }}</span>
                    </div>
                    
                    <div class="flex items-start text-gray-700">
                        <i class="fas fa-map-marker-alt w-5 h-5 text-red-500 mr-3 mt-1"></i>
                        <span>{{ $user->address ?: 'Alamat belum diisi' }}</span>
                    </div>
                      <div class="flex items-center text-gray-700">
                        <i class="fas fa-calendar w-5 h-5 text-blue-500 mr-3"></i>
                        <span>Bergabung {{ $user->created_at ? $user->created_at->format('d M Y') : 'Tanggal tidak tersedia' }}</span>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="p-6 border-t bg-gray-50">
                    <div class="grid grid-cols-2 gap-3">
                        <a href="{{ route('users.edit', $user) }}" 
                           class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-xl text-center font-medium transition-colors">
                            <i class="fas fa-edit mr-1"></i>
                            Edit
                        </a>
                        @if($user->id !== Auth::user()->id)
                            <form action="{{ route('users.destroy', $user) }}" method="POST" 
                                  onsubmit="return confirm('Yakin ingin menghapus user ini?')" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="w-full bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-xl font-medium transition-colors">
                                    <i class="fas fa-trash mr-1"></i>
                                    Hapus
                                </button>
                            </form>
                        @else
                            <div class="bg-gray-300 text-gray-500 px-4 py-2 rounded-xl text-center font-medium cursor-not-allowed">
                                <i class="fas fa-lock mr-1"></i>
                                Akun Anda
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-8">
            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <div class="flex items-center">
                        <div class="bg-blue-100 p-3 rounded-xl">
                            <i class="fas fa-car text-2xl text-blue-600"></i>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-semibold text-gray-800">Total Peminjaman</h3>
                            <p class="text-3xl font-bold text-blue-600">{{ $user->peminjamans->count() }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-lg p-6">
                    <div class="flex items-center">
                        <div class="bg-green-100 p-3 rounded-xl">
                            <i class="fas fa-check-circle text-2xl text-green-600"></i>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-semibold text-gray-800">Selesai</h3>
                            <p class="text-3xl font-bold text-green-600">
                                {{ $user->peminjamans->where('status', 'selesai')->count() }}
                            </p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-lg p-6">
                    <div class="flex items-center">
                        <div class="bg-yellow-100 p-3 rounded-xl">
                            <i class="fas fa-clock text-2xl text-yellow-600"></i>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-semibold text-gray-800">Berlangsung</h3>
                            <p class="text-3xl font-bold text-yellow-600">
                                {{ $user->peminjamans->where('status', 'berlangsung')->count() }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Account Details -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                <div class="bg-gradient-to-r from-green-600 to-blue-600 px-8 py-6">
                    <h2 class="text-2xl font-bold text-white">Informasi Akun</h2>
                    <p class="text-green-100 mt-1">Detail lengkap akun pengguna</p>
                </div>

                <div class="p-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="space-y-6">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    <i class="fas fa-user mr-2 text-blue-500"></i>Nama Lengkap
                                </label>
                                <p class="text-lg text-gray-800 bg-gray-50 px-4 py-3 rounded-xl">{{ $user->name }}</p>
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    <i class="fas fa-envelope mr-2 text-green-500"></i>Email
                                </label>
                                <p class="text-lg text-gray-800 bg-gray-50 px-4 py-3 rounded-xl">{{ $user->email }}</p>
                            </div>                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    <i class="fas fa-user-tag mr-2 text-orange-500"></i>Role
                                </label>
                                <p class="text-lg text-gray-800 bg-gray-50 px-4 py-3 rounded-xl">
                                    @php
                                        $roleText = 'user';
                                        $roleBgColor = 'blue';
                                        
                                        if (isset($user->role_user_id)) {
                                            if ($user->role_user_id == 3) {
                                                $roleText = 'admin';
                                                $roleBgColor = 'red';
                                            } else {
                                                $roleText = 'user';
                                                $roleBgColor = 'blue';
                                            }
                                        } elseif (isset($user->role)) {
                                            if ($user->role === 'admin') {
                                                $roleText = 'admin';
                                                $roleBgColor = 'red';
                                            } else {
                                                $roleText = 'user';
                                                $roleBgColor = 'blue';
                                            }
                                        }
                                    @endphp
                                    <span class="bg-{{ $roleBgColor }}-100 text-{{ $roleBgColor }}-800 px-3 py-1 rounded-full text-sm font-semibold">
                                        <i class="fas fa-{{ $roleText == 'admin' ? 'crown' : 'user' }} mr-1"></i>
                                        {{ ucfirst($roleText) }}
                                    </span>
                                </p>
                            </div>
                        </div>

                        <div class="space-y-6">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    <i class="fas fa-phone mr-2 text-purple-500"></i>No. Telepon
                                </label>
                                <p class="text-lg text-gray-800 bg-gray-50 px-4 py-3 rounded-xl">
                                    {{ $user->phone ?: 'Tidak ada nomor telepon' }}
                                </p>
                            </div>                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    <i class="fas fa-calendar mr-2 text-blue-500"></i>Tanggal Bergabung
                                </label>
                                <p class="text-lg text-gray-800 bg-gray-50 px-4 py-3 rounded-xl">
                                    {{ $user->created_at ? $user->created_at->format('d F Y, H:i') : 'Tanggal tidak tersedia' }}
                                </p>
                            </div>                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    <i class="fas fa-clock mr-2 text-yellow-500"></i>Terakhir Diperbarui
                                </label>
                                <p class="text-lg text-gray-800 bg-gray-50 px-4 py-3 rounded-xl">
                                    {{ $user->updated_at ? $user->updated_at->format('d F Y, H:i') : 'Tanggal tidak tersedia' }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Address -->
                    <div class="mt-8">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-map-marker-alt mr-2 text-red-500"></i>Alamat
                        </label>
                        <p class="text-lg text-gray-800 bg-gray-50 px-4 py-3 rounded-xl">
                            {{ $user->address ?: 'Alamat belum diisi' }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Recent Peminjaman -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                <div class="bg-gradient-to-r from-purple-600 to-pink-600 px-8 py-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <h2 class="text-2xl font-bold text-white">Riwayat Peminjaman</h2>
                            <p class="text-purple-100 mt-1">5 peminjaman terbaru</p>
                        </div>
                        <a href="/peminjaman?user={{ $user->id }}" 
                           class="bg-white bg-opacity-20 text-white px-4 py-2 rounded-xl font-medium hover:bg-opacity-30 transition-colors">
                            Lihat Semua
                        </a>
                    </div>
                </div>

                <div class="p-8">
                    @if($user->peminjamans->count() > 0)
                        <div class="space-y-4">
                            @foreach($user->peminjamans as $peminjaman)
                                <div class="border border-gray-200 rounded-xl p-6 hover:shadow-md transition-shadow">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center">
                                            <div class="bg-blue-100 p-3 rounded-xl mr-4">
                                                <i class="fas fa-car text-blue-600"></i>
                                            </div>                                            <div>
                                                <h3 class="font-semibold text-gray-800">{{ $peminjaman->armada->merk ?? 'Mobil' }} - {{ $peminjaman->armada->model ?? 'Model' }}</h3>
                                                <p class="text-gray-600 text-sm">
                                                    {{ $peminjaman->tanggal_mulai ? $peminjaman->tanggal_mulai : 'Tanggal mulai tidak tersedia' }} - 
                                                    {{ $peminjaman->tanggal_selesai ? $peminjaman->tanggal_selesai : 'Tanggal selesai tidak tersedia' }}
                                                </p>
                                            </div>
                                        </div>                                        <div class="text-right">
                                            @php
                                                $statusClass = 'blue';
                                                if ($peminjaman->status == 'selesai') {
                                                    $statusClass = 'green';
                                                } elseif ($peminjaman->status == 'berlangsung') {
                                                    $statusClass = 'yellow';
                                                }
                                            @endphp
                                            <span class="bg-{{ $statusClass }}-100 text-{{ $statusClass }}-800 px-3 py-1 rounded-full text-sm font-semibold">
                                                {{ ucfirst($peminjaman->status ?? 'pending') }}
                                            </span>
                                            <p class="text-gray-600 text-sm mt-1">
                                                {{ $peminjaman->created_at ? $peminjaman->created_at->format('d/m/Y') : 'Tanggal tidak tersedia' }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-12">
                            <i class="fas fa-car text-6xl text-gray-300 mb-4"></i>
                            <h3 class="text-xl font-semibold text-gray-600 mb-2">Belum Ada Peminjaman</h3>
                            <p class="text-gray-500">User ini belum pernah melakukan peminjaman mobil</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
