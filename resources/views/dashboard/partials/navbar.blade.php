<header class="bg-white shadow-sm sticky top-0 z-10">
    <div class="flex items-center justify-between px-6 py-4">
        <div class="flex items-center">
            <button @click="toggleSidebar()" class="text-gray-500 focus:outline-none lg:hidden mr-4">
                <i class="fas fa-bars text-xl"></i>
            </button>
            <h1 class="text-xl font-semibold text-gray-800">Dashboard Overview</h1>
        </div>
        <div class="flex items-center space-x-4">
            <div class="relative">
                <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                <input type="text" placeholder="Search..." class="pl-10 pr-4 py-2 rounded-full border border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
            </div>
            <button class="p-2 rounded-full bg-gray-100 text-gray-600 hover:bg-gray-200 relative">
                <i class="fas fa-bell"></i>
                <span class="absolute top-0 right-0 w-2 h-2 bg-red-500 rounded-full"></span>
            </button>
        </div>
    </div>
</header>