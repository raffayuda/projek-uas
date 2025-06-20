<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CarRental Pro - Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'inter': ['Inter', 'sans-serif'],
                    },
                    animation: {
                        'fadeIn': 'fadeIn 0.8s ease-in-out',
                        'slideUp': 'slideUp 0.6s ease-out',
                        'bounce-slow': 'bounce 2s infinite',
                        'pulse-slow': 'pulse 3s infinite',
                    },
                    keyframes: {
                        fadeIn: {
                            '0%': { opacity: '0', transform: 'translateY(20px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' }
                        },
                        slideUp: {
                            '0%': { opacity: '0', transform: 'translateY(50px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' }
                        }
                    }
                }
            }
        }
    </script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        .glass-effect {
            backdrop-filter: blur(16px);
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .car-gradient {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        }
        .floating {
            animation: floating 3s ease-in-out infinite;
        }
        @keyframes floating {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
    </style>
</head>
<body class="gradient-bg min-h-screen relative overflow-hidden">
    <!-- Background Elements -->
    <div class="absolute inset-0">
        <!-- Animated background shapes -->
        <div class="absolute top-10 left-10 w-32 h-32 bg-white/10 rounded-full blur-xl animate-pulse-slow"></div>
        <div class="absolute top-1/3 right-10 w-24 h-24 bg-blue-300/20 rounded-full blur-lg animate-bounce-slow"></div>
        <div class="absolute bottom-20 left-1/4 w-40 h-40 bg-purple-300/15 rounded-full blur-2xl animate-pulse-slow"></div>
        <div class="absolute bottom-10 right-1/3 w-20 h-20 bg-cyan-300/25 rounded-full blur-lg floating"></div>
    </div>    <div class="min-h-screen flex items-center justify-center relative z-10 px-4 py-8">
        <div class="w-full max-w-2xl bg-white/10 backdrop-blur-2xl rounded-2xl shadow-2xl border border-white/20 p-6">
            <!-- Register Form -->
            <div class="w-full">                <div class="animate-slideUp">
                <div class="text-center mb-6">
                <div class="mb-4">
                    <i class="fas fa-car text-4xl text-white"></i>
                </div>
                <h2 class="text-2xl font-bold text-white mb-2">
                    Buat Akun
                </h2>
                <p class="text-white/70 text-sm">
                    Bergabunglah dengan kami dan mulai sewa mobil impian Anda hari ini
                </p>
                </div>@if ($errors->any())
                <div class="bg-red-500/20 backdrop-blur-sm border border-red-400/30 rounded-xl p-4 mb-6">
                    <div class="flex">
                    <div class="flex-shrink-0">
                        <i class="fas fa-exclamation-triangle text-red-300"></i>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-red-200">
                        Mohon perbaiki kesalahan berikut:
                        </h3>
                        <div class="mt-2 text-sm text-red-100">
                        <ul class="list-disc pl-5 space-y-1">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        </div>
                    </div>
                    </div>
                </div>
                @endif                    <form class="space-y-4" action="{{ route('register') }}" method="POST">
                @csrf
                
                <!-- Two Column Layout for Form Fields -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Name Field -->
                    <div class="group">
                    <label for="name" class="block text-sm font-medium text-white/80 mb-2">
                        <i class="fas fa-user mr-2"></i>Nama Lengkap
                    </label>                                <div class="relative">
                        @error('name')
                        <input id="name" name="name" type="text" required 
                            class="w-full px-3 py-2 bg-white/10 border-2 border-red-400 rounded-lg text-white placeholder-white/50 focus:outline-none focus:ring-2 focus:ring-red-400 focus:border-transparent transition duration-300 backdrop-blur-sm" 
                            placeholder="Masukkan nama lengkap Anda"
                            value="{{ old('name') }}">
                        @else
                        <input id="name" name="name" type="text" required 
                            class="w-full px-3 py-2 bg-white/10 border border-white/20 rounded-lg text-white placeholder-white/50 focus:outline-none focus:ring-2 focus:ring-cyan-400 focus:border-transparent transition duration-300 backdrop-blur-sm" 
                            placeholder="Masukkan nama lengkap Anda"
                            value="{{ old('name') }}">
                        @enderror
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                        <i class="fas fa-user text-white/40"></i>
                        </div>
                    </div>
                    @error('name')
                        <p class="text-red-300 text-sm mt-2 flex items-center">
                        <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                        </p>
                    @enderror
                    </div>

                    <!-- Email Field -->
                    <div class="group">
                    <label for="email" class="block text-sm font-medium text-white/80 mb-2">
                        <i class="fas fa-envelope mr-2"></i>Alamat Email
                    </label>                                <div class="relative">
                        @error('email')
                        <input id="email" name="email" type="email" required 
                            class="w-full px-3 py-2 bg-white/10 border-2 border-red-400 rounded-lg text-white placeholder-white/50 focus:outline-none focus:ring-2 focus:ring-red-400 focus:border-transparent transition duration-300 backdrop-blur-sm" 
                            placeholder="Masukkan alamat email Anda"
                            value="{{ old('email') }}">
                        @else
                        <input id="email" name="email" type="email" required 
                            class="w-full px-3 py-2 bg-white/10 border border-white/20 rounded-lg text-white placeholder-white/50 focus:outline-none focus:ring-2 focus:ring-cyan-400 focus:border-transparent transition duration-300 backdrop-blur-sm" 
                            placeholder="Masukkan alamat email Anda"
                            value="{{ old('email') }}">
                        @enderror
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                        <i class="fas fa-envelope text-white/40"></i>
                        </div>
                    </div>
                    @error('email')
                        <p class="text-red-300 text-sm mt-2 flex items-center">
                        <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                        </p>
                    @enderror
                    </div>

                    <!-- Phone Field -->
                    <div class="group">
                    <label for="phone" class="block text-sm font-medium text-white/80 mb-2">
                        <i class="fas fa-phone mr-2"></i>Nomor Telepon
                    </label>                                <div class="relative">
                        @error('phone')
                        <input id="phone" name="phone" type="tel" required 
                            class="w-full px-3 py-2 bg-white/10 border-2 border-red-400 rounded-lg text-white placeholder-white/50 focus:outline-none focus:ring-2 focus:ring-red-400 focus:border-transparent transition duration-300 backdrop-blur-sm" 
                            placeholder="Masukkan nomor telepon Anda"
                            value="{{ old('phone') }}">
                        @else
                        <input id="phone" name="phone" type="tel" required 
                            class="w-full px-3 py-2 bg-white/10 border border-white/20 rounded-lg text-white placeholder-white/50 focus:outline-none focus:ring-2 focus:ring-cyan-400 focus:border-transparent transition duration-300 backdrop-blur-sm" 
                            placeholder="Masukkan nomor telepon Anda"
                            value="{{ old('phone') }}">
                        @enderror
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                        <i class="fas fa-phone text-white/40"></i>
                        </div>
                    </div>
                    @error('phone')
                        <p class="text-red-300 text-sm mt-2 flex items-center">
                        <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                        </p>
                    @enderror
                    </div>

                    <!-- Password Field -->
                    <div class="group">
                    <label for="password" class="block text-sm font-medium text-white/80 mb-2">
                        <i class="fas fa-lock mr-2"></i>Kata Sandi
                    </label>                                <div class="relative">
                        @error('password')
                        <input id="password" name="password" type="password" required 
                            class="w-full px-3 py-2 bg-white/10 border-2 border-red-400 rounded-lg text-white placeholder-white/50 focus:outline-none focus:ring-2 focus:ring-red-400 focus:border-transparent transition duration-300 backdrop-blur-sm" 
                            placeholder="Masukkan kata sandi Anda">
                        @else
                        <input id="password" name="password" type="password" required 
                            class="w-full px-3 py-2 bg-white/10 border border-white/20 rounded-lg text-white placeholder-white/50 focus:outline-none focus:ring-2 focus:ring-cyan-400 focus:border-transparent transition duration-300 backdrop-blur-sm" 
                            placeholder="Masukkan kata sandi Anda">
                        @enderror
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                        <button type="button" onclick="togglePassword('password')" class="text-white/40 hover:text-white/60 transition-colors">
                            <i class="fas fa-eye" id="password-icon"></i>
                        </button>
                        </div>
                    </div>
                    @error('password')
                        <p class="text-red-300 text-sm mt-2 flex items-center">
                        <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                        </p>
                    @enderror
                    </div>

                    <!-- Confirm Password Field -->
                    <div class="group">
                    <label for="password_confirmation" class="block text-sm font-medium text-white/80 mb-2">
                        <i class="fas fa-lock mr-2"></i>Konfirmasi Kata Sandi
                    </label>                                <div class="relative">
                        <input id="password_confirmation" name="password_confirmation" type="password" required 
                        class="w-full px-3 py-2 bg-white/10 border border-white/20 rounded-lg text-white placeholder-white/50 focus:outline-none focus:ring-2 focus:ring-cyan-400 focus:border-transparent transition duration-300 backdrop-blur-sm" 
                        placeholder="Konfirmasi kata sandi Anda">
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                        <button type="button" onclick="togglePassword('password_confirmation')" class="text-white/40 hover:text-white/60 transition-colors">
                            <i class="fas fa-eye" id="password_confirmation-icon"></i>
                        </button>
                        </div>
                    </div>
                    </div>
                </div>

                <!-- Address Field - Full Width -->
                <div class="group">
                    <label for="address" class="block text-sm font-medium text-white/80 mb-2">
                    <i class="fas fa-map-marker-alt mr-2"></i>Alamat
                    </label>                            <div class="relative">
                    @error('address')
                        <textarea id="address" name="address" required rows="2"
                        class="w-full px-3 py-2 bg-white/10 border-2 border-red-400 rounded-lg text-white placeholder-white/50 focus:outline-none focus:ring-2 focus:ring-red-400 focus:border-transparent transition duration-300 backdrop-blur-sm resize-none" 
                        placeholder="Masukkan alamat lengkap Anda">{{ old('address') }}</textarea>
                    @else
                        <textarea id="address" name="address" required rows="2"
                        class="w-full px-3 py-2 bg-white/10 border border-white/20 rounded-lg text-white placeholder-white/50 focus:outline-none focus:ring-2 focus:ring-cyan-400 focus:border-transparent transition duration-300 backdrop-blur-sm resize-none" 
                        placeholder="Masukkan alamat lengkap Anda">{{ old('address') }}</textarea>
                    @enderror
                    <div class="absolute top-2 right-0 pr-3 flex items-center">
                        <i class="fas fa-map-marker-alt text-white/40"></i>
                    </div>
                    </div>
                    @error('address')
                    <p class="text-red-300 text-sm mt-2 flex items-center">
                        <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                    </p>
                    @enderror
                </div>

                         <!-- Submit Button -->
                <div class="pt-2">
                    <button type="submit" 
                    class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-lg text-white bg-gradient-to-r from-cyan-500 to-blue-500 hover:from-cyan-600 hover:to-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500 transition duration-300 transform hover:scale-105 shadow-lg">
                    <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                        <i class="fas fa-user-plus text-cyan-200 group-hover:text-white transition-colors"></i>
                    </span>
                    <span class="ml-3">Buat Akun</span>
                    </button>
                </div>

                <!-- Login Link -->
                <div class="text-center">
                    <p class="text-sm text-white/70">
                    Sudah memiliki akun?
                    <a href="{{ route('login') }}" class="font-medium text-cyan-300 hover:text-cyan-200 transition-colors duration-300">
                        Masuk di sini
                    </a>
                    </p>
                </div>

                <!-- Divider -->
                <div class="relative">
                    <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-white/20"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                    <span class="px-2 bg-white/10 text-white/60 rounded-lg backdrop-blur-sm">
                        Pendaftaran Aman
                    </span>
                    </div>
                </div>                        <!-- Security Notice -->
                <div class="bg-white/5 backdrop-blur-sm rounded-lg p-3 border border-white/10">
                    <div class="flex items-center">
                    <i class="fas fa-shield-alt text-green-400 mr-3"></i>
                    <div>
                        <p class="text-sm text-white/80 font-medium">Pendaftaran Aman</p>
                        <p class="text-xs text-white/60">Data Anda dilindungi dengan keamanan tingkat enterprise</p>
                    </div>
                    </div>
                </div>
                </form>
            </div>
            </div>
        </div>
    </div>

    <script>
        function togglePassword(fieldId) {
            const field = document.getElementById(fieldId);
            const icon = document.getElementById(fieldId + '-icon');
            
            if (field.type === 'password') {
                field.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                field.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }

        // Add some interactive animations
        document.addEventListener('DOMContentLoaded', function() {
            // Add focus effects to form inputs
            const inputs = document.querySelectorAll('input, textarea');
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.parentElement.classList.add('scale-105');
                });
                input.addEventListener('blur', function() {
                    this.parentElement.classList.remove('scale-105');
                });
            });

            // Password confirmation validation
            const password = document.getElementById('password');
            const passwordConfirmation = document.getElementById('password_confirmation');
            
            passwordConfirmation.addEventListener('input', function() {
                if (password.value !== passwordConfirmation.value) {
                    passwordConfirmation.setCustomValidity('Passwords do not match');
                } else {
                    passwordConfirmation.setCustomValidity('');
                }
            });

            // Add loading effect to submit button
            const form = document.querySelector('form');
            const submitBtn = document.querySelector('button[type="submit"]');
            
            form.addEventListener('submit', function() {
                submitBtn.innerHTML = `
                    <i class="fas fa-spinner fa-spin mr-2"></i>
                    Creating Account...
                `;
                submitBtn.disabled = true;
            });
        });
    </script>
</body>
</html>
