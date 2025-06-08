<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CarRental Pro - Login</title>
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
    </div>

    <div class="min-h-screen flex items-center justify-center relative z-10 px-4">
        <div class="w-full max-w-5xl flex bg-white/10 backdrop-blur-2xl rounded-3xl shadow-2xl overflow-hidden border border-white/20">
            <!-- Left Side - Branding -->
            <div class="hidden lg:flex lg:w-1/2 car-gradient p-12 flex-col justify-center items-center relative">
                <div class="absolute inset-0 bg-black/10"></div>
                <div class="relative z-10 text-center animate-fadeIn">
                    <div class="mb-8">
                        <i class="fas fa-car text-8xl text-white floating"></i>
                    </div>
                    <h1 class="text-4xl font-bold text-white mb-4">CarRental Pro</h1>
                    <p class="text-xl text-white/90 mb-8">Your Premium Car Rental Experience</p>
                    <div class="flex justify-center space-x-4 text-white/80">
                        <div class="text-center">
                            <i class="fas fa-shield-alt text-2xl mb-2"></i>
                            <p class="text-sm">Secure</p>
                        </div>
                        <div class="text-center">
                            <i class="fas fa-clock text-2xl mb-2"></i>
                            <p class="text-sm">24/7</p>
                        </div>
                        <div class="text-center">
                            <i class="fas fa-star text-2xl mb-2"></i>
                            <p class="text-sm">Premium</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Side - Login Form -->
            <div class="w-full lg:w-1/2 p-12 flex flex-col justify-center">
                <div class="animate-slideUp">
                    <div class="text-center mb-8">
                        <div class="lg:hidden mb-6">
                            <i class="fas fa-car text-5xl text-white"></i>
                        </div>
                        <h2 class="text-3xl font-bold text-white mb-2">
                            Welcome Back
                        </h2>
                        <p class="text-white/70">
                            Sign in to access your dashboard
                        </p>
                    </div>                    <form class="space-y-6" action="{{ route('login') }}" method="POST">
                        @csrf                        <!-- Email Field -->
                        <div class="group">
                            <label for="email" class="block text-sm font-medium text-white/80 mb-2">
                                <i class="fas fa-envelope mr-2"></i>Email Address
                            </label>
                            <div class="relative">
                                @error('email')
                                    <input id="email" name="email" type="email" required 
                                        class="w-full px-4 py-3 bg-white/10 border-2 border-red-400 rounded-xl text-white placeholder-white/50 focus:outline-none focus:ring-2 focus:ring-red-400 focus:border-transparent transition duration-300 backdrop-blur-sm" 
                                        placeholder="Enter your email"
                                        value="{{ old('email') }}">
                                @else
                                    <input id="email" name="email" type="email" required 
                                        class="w-full px-4 py-3 bg-white/10 border border-white/20 rounded-xl text-white placeholder-white/50 focus:outline-none focus:ring-2 focus:ring-cyan-400 focus:border-transparent transition duration-300 backdrop-blur-sm" 
                                        placeholder="Enter your email"
                                        value="{{ old('email') }}">
                                @enderror
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                    <i class="fas fa-user text-white/40"></i>
                                </div>
                            </div>
                            @error('email')
                                <p class="text-red-300 text-sm mt-2 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Password Field -->
                        <div class="group">
                            <label for="password" class="block text-sm font-medium text-white/80 mb-2">
                                <i class="fas fa-lock mr-2"></i>Password
                            </label>
                            <div class="relative">
                                @error('password')
                                    <input id="password" name="password" type="password" required 
                                        class="w-full px-4 py-3 bg-white/10 border-2 border-red-400 rounded-xl text-white placeholder-white/50 focus:outline-none focus:ring-2 focus:ring-red-400 focus:border-transparent transition duration-300 backdrop-blur-sm" 
                                        placeholder="Enter your password">
                                @else
                                    <input id="password" name="password" type="password" required 
                                        class="w-full px-4 py-3 bg-white/10 border border-white/20 rounded-xl text-white placeholder-white/50 focus:outline-none focus:ring-2 focus:ring-cyan-400 focus:border-transparent transition duration-300 backdrop-blur-sm" 
                                        placeholder="Enter your password">
                                @enderror
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                    <button type="button" onclick="togglePassword()" class="text-white/40 hover:text-white/60 transition-colors">
                                        <i class="fas fa-eye" id="toggle-icon"></i>
                                    </button>
                                </div>
                            </div>
                            @error('password')
                                <p class="text-red-300 text-sm mt-2 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                </p>
                            @enderror
                        </div>

                        

                        <!-- Submit Button -->
                        <div>
                            <button type="submit" 
                                class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-xl text-white bg-gradient-to-r from-cyan-500 to-blue-500 hover:from-cyan-600 hover:to-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500 transition duration-300 transform hover:scale-105 shadow-lg">
                                <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                                    <i class="fas fa-sign-in-alt text-cyan-200 group-hover:text-white transition-colors"></i>
                                </span>
                                <span class="ml-3">Sign In to Dashboard</span>
                            </button>
                        </div>

                        <!-- Divider -->
                        <div class="relative">
                            <div class="absolute inset-0 flex items-center">
                                <div class="w-full border-t border-white/20"></div>
                            </div>
                            <div class="relative flex justify-center text-sm">
                                <span class="px-2 bg-white/10 text-white/60 rounded-lg backdrop-blur-sm">
                                    Secure Login
                                </span>
                            </div>
                        </div>

                        <!-- Security Notice -->
                        <div class="bg-white/5 backdrop-blur-sm rounded-xl p-4 border border-white/10">
                            <div class="flex items-center">
                                <i class="fas fa-shield-alt text-green-400 mr-3"></i>
                                <div>
                                    <p class="text-sm text-white/80 font-medium">Secure Connection</p>
                                    <p class="text-xs text-white/60">Your data is protected with enterprise-grade security</p>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('toggle-icon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }

        // Add some interactive animations
        document.addEventListener('DOMContentLoaded', function() {
            // Add focus effects to form inputs
            const inputs = document.querySelectorAll('input[type="email"], input[type="password"]');
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.parentElement.classList.add('scale-105');
                });
                input.addEventListener('blur', function() {
                    this.parentElement.classList.remove('scale-105');
                });
            });

            // Add loading effect to submit button
            const form = document.querySelector('form');
            const submitBtn = document.querySelector('button[type="submit"]');
            
            form.addEventListener('submit', function() {
                submitBtn.innerHTML = `
                    <i class="fas fa-spinner fa-spin mr-2"></i>
                    Signing In...
                `;
                submitBtn.disabled = true;
            });
        });
    </script>
</body>
</html>
