<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>DriveEasy - Rental Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#4F46E5',
                        secondary: '#10B981',
                        dark: '#1F2937',
                        light: '#F9FAFB'
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                }
            }
        }
    </script>
    <style>
        [x-cloak] { display: none !important; }
    </style>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="font-sans bg-gray-50 text-dark">
    <div class="min-h-screen" x-data="{ 
        sidebarOpen: window.innerWidth > 1024,
        mobileSidebarOpen: false,
        toggleSidebar() {
            if (window.innerWidth <= 1024) {
                this.mobileSidebarOpen = !this.mobileSidebarOpen;
            } else {
                this.sidebarOpen = !this.sidebarOpen;
            }
        }
    }" @resize.window="sidebarOpen = window.innerWidth > 1024">
        <!-- Mobile Sidebar Overlay -->
        <div x-show="mobileSidebarOpen" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             @click="mobileSidebarOpen = false"
             class="fixed inset-0 bg-black bg-opacity-50 z-20 lg:hidden"></div>

        <!-- Sidebar -->
        @include('dashboard.partials.sidebar')

        <!-- Main Content -->
        <div class="lg:ml-72 transition-all duration-300" :class="{'ml-0': !sidebarOpen && !mobileSidebarOpen, 'ml-72': sidebarOpen || mobileSidebarOpen}">
            <!-- Top Navigation -->
            @include('dashboard.partials.navbar')
            
            <!-- Main Content Area -->
            <main class="p-6">
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Scripts -->
    @stack('scripts')
</body>
</html>