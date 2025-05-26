@extends('dashboard.layout.index')

@section('content')
            <!-- Dashboard Content -->
            <main class="p-6">
                <!-- Welcome Banner -->
                <div class="bg-gradient-to-r from-primary to-blue-600 rounded-xl p-6 mb-6 text-white">
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center">
                        <div>
                            <h2 class="text-2xl font-bold mb-2">Welcome back, Admin!</h2>
                            <p class="opacity-90">Here's what's happening with your rental business today.</p>
                        </div>
                        <button class="mt-4 md:mt-0 bg-white text-primary px-6 py-2 rounded-lg font-medium hover:bg-opacity-90 transition-all">
                            <i class="fas fa-plus mr-2"></i> Add New Rental
                        </button>
                    </div>
                </div>

                <!-- Stats Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                    <!-- Total Vehicles -->
                    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition-shadow">
                        <div class="flex items-start justify-between">
                            <div>
                                <p class="text-gray-500 text-sm font-medium">Total Vehicles</p>
                                <h3 class="text-2xl font-bold mt-1">6</h3>
                                <p class="text-green-500 text-xs mt-2"><i class="fas fa-arrow-up mr-1"></i> 2 new this month</p>
                            </div>
                            <div class="p-3 rounded-lg bg-blue-50 text-primary">
                                <i class="fas fa-car text-xl"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Active Rentals -->
                    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition-shadow">
                        <div class="flex items-start justify-between">
                            <div>
                                <p class="text-gray-500 text-sm font-medium">Active Rentals</p>
                                <h3 class="text-2xl font-bold mt-1">4</h3>
                                <p class="text-blue-500 text-xs mt-2"><i class="fas fa-clock mr-1"></i> 2 ending soon</p>
                            </div>
                            <div class="p-3 rounded-lg bg-green-50 text-secondary">
                                <i class="fas fa-calendar-check text-xl"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Total Revenue -->
                    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition-shadow">
                        <div class="flex items-start justify-between">
                            <div>
                                <p class="text-gray-500 text-sm font-medium">Total Revenue</p>
                                <h3 class="text-2xl font-bold mt-1">Rp 8.0M</h3>
                                <p class="text-green-500 text-xs mt-2"><i class="fas fa-arrow-up mr-1"></i> 12% from last month</p>
                            </div>
                            <div class="p-3 rounded-lg bg-yellow-50 text-yellow-500">
                                <i class="fas fa-wallet text-xl"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Locations -->
                    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition-shadow">
                        <div class="flex items-start justify-between">
                            <div>
                                <p class="text-gray-500 text-sm font-medium">Locations</p>
                                <h3 class="text-2xl font-bold mt-1">5</h3>
                                <p class="text-gray-500 text-xs mt-2"><i class="fas fa-map-marker-alt mr-1"></i> 3 cities</p>
                            </div>
                            <div class="p-3 rounded-lg bg-purple-50 text-purple-500">
                                <i class="fas fa-map-marked-alt text-xl"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Charts and Recent Rentals -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
                    <!-- Revenue Chart -->
                    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 lg:col-span-2">
                        <div class="flex justify-between items-center mb-4">
                            <h2 class="text-lg font-semibold">Revenue Overview</h2>
                            <select class="text-sm border border-gray-200 rounded-lg px-3 py-1 focus:outline-none focus:ring-2 focus:ring-primary">
                                <option>This Month</option>
                                <option>Last Month</option>
                                <option>This Year</option>
                            </select>
                        </div>
                        <div class="h-64 bg-gray-50 rounded-lg flex items-center justify-center">
                            <!-- Chart placeholder - would be replaced with actual chart library -->
                            <div class="text-center text-gray-400">
                                <i class="fas fa-chart-line text-4xl mb-2"></i>
                                <p>Revenue chart will appear here</p>
                            </div>
                        </div>
                    </div>

                    <!-- Vehicle Status -->
                    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                        <h2 class="text-lg font-semibold mb-4">Vehicle Status</h2>
                        <div class="space-y-4">
                            <div>
                                <div class="flex justify-between text-sm mb-1">
                                    <span>Available</span>
                                    <span>2/6</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-green-500 h-2 rounded-full" style="width: 33%"></div>
                                </div>
                            </div>
                            <div>
                                <div class="flex justify-between text-sm mb-1">
                                    <span>Rented</span>
                                    <span>4/6</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-blue-500 h-2 rounded-full" style="width: 66%"></div>
                                </div>
                            </div>
                            <div>
                                <div class="flex justify-between text-sm mb-1">
                                    <span>Maintenance</span>
                                    <span>0/6</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-yellow-500 h-2 rounded-full" style="width: 0%"></div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-6 pt-4 border-t border-gray-100">
                            <div class="flex items-center justify-between mb-2">
                                <div class="flex items-center">
                                    <div class="w-3 h-3 rounded-full bg-green-500 mr-2"></div>
                                    <span class="text-sm">Available</span>
                                </div>
                                <span class="text-sm font-medium">2</span>
                            </div>
                            <div class="flex items-center justify-between mb-2">
                                <div class="flex items-center">
                                    <div class="w-3 h-3 rounded-full bg-blue-500 mr-2"></div>
                                    <span class="text-sm">Rented</span>
                                </div>
                                <span class="text-sm font-medium">4</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <div class="w-3 h-3 rounded-full bg-yellow-500 mr-2"></div>
                                    <span class="text-sm">Maintenance</span>
                                </div>
                                <span class="text-sm font-medium">0</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Rentals -->
                <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-100">
                    <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center">
                        <h2 class="text-lg font-semibold">Recent Rentals</h2>
                        <button class="text-primary text-sm font-medium hover:text-blue-700">View All</button>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Customer</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Vehicle</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-medium">
                                                R
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">Raffa</div>
                                                <div class="text-sm text-gray-500">raffa@example.com</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">Toyota Prius</div>
                                        <div class="text-sm text-gray-500">2022 • Silver</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">25-27 May 2025</div>
                                        <div class="text-sm text-gray-500">2 days</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                            Pending
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-medium">
                                        Rp 2.4M
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <button class="text-primary hover:text-blue-700 mr-3"><i class="fas fa-eye"></i></button>
                                        <button class="text-secondary hover:text-green-700"><i class="fas fa-edit"></i></button>
                                    </td>
                                </tr>
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10 rounded-full bg-green-100 flex items-center justify-center text-green-600 font-medium">
                                                E
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">E</div>
                                                <div class="text-sm text-gray-500">e@example.com</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">BMW i4</div>
                                        <div class="text-sm text-gray-500">2023 • Black</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">24-26 May 2025</div>
                                        <div class="text-sm text-gray-500">2 days</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                            Pending
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-medium">
                                        Rp 8.0M
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <button class="text-primary hover:text-blue-700 mr-3"><i class="fas fa-eye"></i></button>
                                        <button class="text-secondary hover:text-green-700"><i class="fas fa-edit"></i></button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="px-6 py-3 border-t border-gray-200 bg-gray-50 text-right">
                        <nav class="inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                            <button class="px-3 py-1 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                Previous
                            </button>
                            <button class="px-3 py-1 border-t border-b border-gray-300 bg-white text-sm font-medium text-primary hover:bg-blue-50">
                                1
                            </button>
                            <button class="px-3 py-1 border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                2
                            </button>
                            <button class="px-3 py-1 border-t border-b border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                3
                            </button>
                            <button class="px-3 py-1 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                Next
                            </button>
                        </nav>
                    </div>
                </div>
            </main>
        </div>
    </div>
@endsection
