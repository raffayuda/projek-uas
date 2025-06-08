@extends('dashboard.layout.index')
@section('content')

<div class="py-8">
    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="bg-gradient-to-br from-indigo-600 via-purple-600 to-pink-600 rounded-3xl shadow-2xl overflow-hidden mb-8">
            <div class="relative p-8">
                <div class="absolute inset-0 bg-black/10"></div>
                <div class="relative flex items-center justify-between">
                    <div>
                        <h1 class="text-4xl font-bold text-white mb-2">Edit Profile</h1>
                        <p class="text-indigo-100">Update your personal information and settings</p>
                    </div>
                    <a href="{{ route('profile.show') }}" 
                       class="inline-flex items-center px-6 py-3 bg-white/20 hover:bg-white/30 backdrop-blur-sm border border-white/30 rounded-xl text-white font-medium transition-all duration-300 hover:scale-105">
                        <i class="fas fa-arrow-left mr-2"></i>Back to Profile
                    </a>
                </div>
            </div>
        </div>

        @if(session('success'))
            <div class="bg-green-50 border border-green-200 rounded-xl p-4 mb-6 flex items-center">
                <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                    <i class="fas fa-check text-green-600"></i>
                </div>
                <p class="text-green-800 font-medium">{{ session('success') }}</p>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Profile Information Form -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Personal Information -->
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 px-6 py-4 border-b border-gray-100">
                        <h3 class="text-xl font-bold text-gray-800 flex items-center">
                            <i class="fas fa-user-edit mr-3 text-blue-600"></i>
                            Personal Information
                        </h3>
                    </div>
                    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="p-6">
                        @csrf
                        @method('PUT')
                        
                        <div class="space-y-6">
                            <!-- Avatar Upload -->
                            <div class="text-center">
                                <div class="relative inline-block">
                                    <div class="w-24 h-24 rounded-full bg-gradient-to-br from-blue-400 to-purple-500 flex items-center justify-center shadow-lg">
                                        @if($user->avatar)
                                            <img src="{{ asset('storage/avatars/' . $user->avatar) }}" 
                                                 alt="Avatar" 
                                                 class="w-full h-full rounded-full object-cover"
                                                 id="avatar-preview">
                                        @else
                                            <i class="fas fa-user text-3xl text-white" id="avatar-icon"></i>
                                        @endif
                                    </div>
                                    <label for="avatar" class="absolute -bottom-1 -right-1 w-8 h-8 bg-blue-500 hover:bg-blue-600 rounded-full flex items-center justify-center cursor-pointer transition-colors shadow-lg">
                                        <i class="fas fa-camera text-white text-sm"></i>
                                    </label>
                                    <input type="file" id="avatar" name="avatar" class="hidden" accept="image/*" onchange="previewAvatar(this)">
                                </div>
                                <p class="text-sm text-gray-500 mt-2">Click camera icon to change avatar</p>
                                @error('avatar')
                                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Name -->
                                <div>
                                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                                        <i class="fas fa-signature mr-2 text-blue-500"></i>Full Name
                                    </label>
                                    <input type="text" name="name" id="name" 
                                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                                           value="{{ old('name', $user->name) }}" required>
                                    @error('name')
                                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Email -->
                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                        <i class="fas fa-envelope mr-2 text-green-500"></i>Email Address
                                    </label>
                                    <input type="email" name="email" id="email" 
                                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                                           value="{{ old('email', $user->email) }}" required>
                                    @error('email')
                                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Phone -->
                                <div>
                                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">
                                        <i class="fas fa-phone mr-2 text-purple-500"></i>Phone Number
                                    </label>
                                    <input type="tel" name="phone" id="phone" 
                                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                                           value="{{ old('phone', $user->phone) }}" placeholder="e.g., +62 812 3456 7890">
                                    @error('phone')
                                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Address -->
                                <div>
                                    <label for="address" class="block text-sm font-medium text-gray-700 mb-2">
                                        <i class="fas fa-map-marker-alt mr-2 text-red-500"></i>Address
                                    </label>
                                    <textarea name="address" id="address" rows="3"
                                              class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 resize-none"
                                              placeholder="Enter your full address">{{ old('address', $user->address) }}</textarea>
                                    @error('address')
                                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="flex justify-end space-x-4">
                                <a href="{{ route('profile.show') }}" 
                                   class="px-6 py-3 border border-gray-300 rounded-xl text-gray-700 hover:bg-gray-50 font-medium transition-colors">
                                    Cancel
                                </a>
                                <button type="submit" 
                                        class="px-8 py-3 bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700 text-white rounded-xl font-medium transition-all duration-300 hover:scale-105 hover:shadow-lg">
                                    <i class="fas fa-save mr-2"></i>Save Changes
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Password Change -->
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden" id="password">
                    <div class="bg-gradient-to-r from-red-50 to-pink-50 px-6 py-4 border-b border-gray-100">
                        <h3 class="text-xl font-bold text-gray-800 flex items-center">
                            <i class="fas fa-lock mr-3 text-red-600"></i>
                            Change Password
                        </h3>
                    </div>
                    <form action="{{ route('profile.password.update') }}" method="POST" class="p-6">
                        @csrf
                        @method('PUT')
                        
                        <div class="space-y-6">
                            <!-- Current Password -->
                            <div>
                                <label for="current_password" class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-key mr-2 text-gray-500"></i>Current Password
                                </label>
                                <input type="password" name="current_password" id="current_password" 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all duration-200"
                                       required>
                                @error('current_password')
                                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- New Password -->
                                <div>
                                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                                        <i class="fas fa-lock mr-2 text-green-500"></i>New Password
                                    </label>
                                    <input type="password" name="password" id="password" 
                                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all duration-200"
                                           required>
                                    @error('password')
                                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Confirm Password -->
                                <div>
                                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                                        <i class="fas fa-lock mr-2 text-blue-500"></i>Confirm Password
                                    </label>
                                    <input type="password" name="password_confirmation" id="password_confirmation" 
                                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all duration-200"
                                           required>
                                </div>
                            </div>

                            <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-4">
                                <div class="flex items-start">
                                    <i class="fas fa-exclamation-triangle text-yellow-600 mt-1 mr-3"></i>
                                    <div>
                                        <h4 class="font-medium text-yellow-800">Password Requirements</h4>
                                        <ul class="text-sm text-yellow-700 mt-1 space-y-1">
                                            <li>• At least 8 characters long</li>
                                            <li>• Contains uppercase and lowercase letters</li>
                                            <li>• Contains at least one number</li>
                                            <li>• Contains at least one special character</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="flex justify-end">
                                <button type="submit" 
                                        class="px-8 py-3 bg-gradient-to-r from-red-500 to-pink-600 hover:from-red-600 hover:to-pink-700 text-white rounded-xl font-medium transition-all duration-300 hover:scale-105 hover:shadow-lg">
                                    <i class="fas fa-shield-alt mr-2"></i>Update Password
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Sidebar Information -->
            <div class="space-y-6">
                <!-- Profile Completion -->
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                    <div class="bg-gradient-to-r from-green-50 to-emerald-50 px-6 py-4 border-b border-gray-100">
                        <h3 class="text-lg font-bold text-gray-800 flex items-center">
                            <i class="fas fa-chart-pie mr-3 text-green-600"></i>
                            Profile Completion
                        </h3>
                    </div>
                    <div class="p-6">
                        @php
                            $completion = 0;
                            if($user->name) $completion += 25;
                            if($user->email) $completion += 25;
                            if($user->phone) $completion += 25;
                            if($user->address) $completion += 25;
                        @endphp
                        
                        <div class="relative pt-1">
                            <div class="flex mb-2 items-center justify-between">
                                <div>
                                    <span class="text-xs font-semibold inline-block py-1 px-2 uppercase rounded-full text-green-600 bg-green-200">
                                        Progress
                                    </span>
                                </div>
                                <div class="text-right">
                                    <span class="text-xs font-semibold inline-block text-green-600">
                                        {{ $completion }}%
                                    </span>
                                </div>
                            </div>
                            <div class="overflow-hidden h-2 mb-4 text-xs flex rounded bg-green-200">
                                <div style="width:{{ $completion }}%" class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-gradient-to-r from-green-500 to-emerald-500 transition-all duration-500"></div>
                            </div>
                        </div>

                        <div class="space-y-3">
                            <div class="flex items-center {{ $user->name ? 'text-green-600' : 'text-gray-400' }}">
                                <i class="fas {{ $user->name ? 'fa-check-circle' : 'fa-circle' }} mr-3"></i>
                                <span class="text-sm">Full Name</span>
                            </div>
                            <div class="flex items-center {{ $user->email ? 'text-green-600' : 'text-gray-400' }}">
                                <i class="fas {{ $user->email ? 'fa-check-circle' : 'fa-circle' }} mr-3"></i>
                                <span class="text-sm">Email Address</span>
                            </div>
                            <div class="flex items-center {{ $user->phone ? 'text-green-600' : 'text-gray-400' }}">
                                <i class="fas {{ $user->phone ? 'fa-check-circle' : 'fa-circle' }} mr-3"></i>
                                <span class="text-sm">Phone Number</span>
                            </div>
                            <div class="flex items-center {{ $user->address ? 'text-green-600' : 'text-gray-400' }}">
                                <i class="fas {{ $user->address ? 'fa-check-circle' : 'fa-circle' }} mr-3"></i>
                                <span class="text-sm">Address</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Security Tips -->
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                    <div class="bg-gradient-to-r from-blue-50 to-cyan-50 px-6 py-4 border-b border-gray-100">
                        <h3 class="text-lg font-bold text-gray-800 flex items-center">
                            <i class="fas fa-shield-alt mr-3 text-blue-600"></i>
                            Security Tips
                        </h3>
                    </div>
                    <div class="p-6 space-y-4">
                        <div class="flex items-start space-x-3">
                            <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center mt-0.5">
                                <i class="fas fa-key text-blue-600 text-sm"></i>
                            </div>
                            <div>
                                <h4 class="font-medium text-gray-800">Strong Password</h4>
                                <p class="text-sm text-gray-600">Use a unique password with mix of characters</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start space-x-3">
                            <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center mt-0.5">
                                <i class="fas fa-user-check text-green-600 text-sm"></i>
                            </div>
                            <div>
                                <h4 class="font-medium text-gray-800">Keep Info Updated</h4>
                                <p class="text-sm text-gray-600">Regular updates help us serve you better</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start space-x-3">
                            <div class="w-8 h-8 bg-yellow-100 rounded-full flex items-center justify-center mt-0.5">
                                <i class="fas fa-eye text-yellow-600 text-sm"></i>
                            </div>
                            <div>
                                <h4 class="font-medium text-gray-800">Monitor Activity</h4>
                                <p class="text-sm text-gray-600">Check your account regularly for any unusual activity</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Danger Zone -->
                @if($user->avatar)
                <div class="bg-white rounded-2xl shadow-lg border border-red-200 overflow-hidden">
                    <div class="bg-gradient-to-r from-red-50 to-pink-50 px-6 py-4 border-b border-red-200">
                        <h3 class="text-lg font-bold text-gray-800 flex items-center">
                            <i class="fas fa-exclamation-triangle mr-3 text-red-600"></i>
                            Danger Zone
                        </h3>
                    </div>
                    <div class="p-6">
                        <div class="bg-red-50 border border-red-200 rounded-xl p-4">
                            <h4 class="font-medium text-red-800 mb-2">Remove Avatar</h4>
                            <p class="text-sm text-red-700 mb-4">This will permanently delete your profile picture.</p>
                            <form action="{{ route('profile.avatar.delete') }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm rounded-lg transition-colors"
                                        onclick="return confirm('Are you sure you want to delete your avatar?')">
                                    <i class="fas fa-trash mr-2"></i>Delete Avatar
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
function previewAvatar(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const preview = document.getElementById('avatar-preview');
            const icon = document.getElementById('avatar-icon');
            
            if (preview) {
                preview.src = e.target.result;
            } else if (icon) {
                // Create new image element
                const img = document.createElement('img');
                img.src = e.target.result;
                img.alt = 'Avatar';
                img.className = 'w-full h-full rounded-full object-cover';
                img.id = 'avatar-preview';
                
                // Replace icon with image
                icon.parentNode.replaceChild(img, icon);
            }
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>

@endsection
