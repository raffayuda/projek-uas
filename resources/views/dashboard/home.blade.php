@extends('dashboard.layout.index')

@section('content')
            <!-- Dashboard Content -->
            <main class="p-6">
                <!-- Welcome Banner -->
                <div class="bg-gradient-to-r from-primary to-blue-600 rounded-xl p-6 mb-6 text-white">
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center">
                        <div>
                            <h2 class="text-2xl font-bold mb-2">Welcome back, {{ Auth::user()->name }}!</h2>
                            <p class="opacity-90">Here's what's happening with your rental business today.</p>
                        </div>
                        <a href="{{ route('peminjaman.create') }}" class="mt-4 md:mt-0 bg-white text-primary px-6 py-2 rounded-lg font-medium hover:bg-opacity-90 transition-all">
                            <i class="fas fa-plus mr-2"></i> Add New Rental
                        </a>
                    </div>
                </div>

                <!-- Stats Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                    <!-- Total Vehicles -->
                    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition-shadow">
                        <div class="flex items-start justify-between">
                            <div>
                                <p class="text-gray-500 text-sm font-medium">Total Vehicles</p>
                                <h3 class="text-2xl font-bold mt-1">{{ $totalVehicles }}</h3>
                                <p class="text-green-500 text-xs mt-2"><i class="fas fa-arrow-up mr-1"></i> {{ $newVehiclesThisMonth }} new this month</p>
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
                                <h3 class="text-2xl font-bold mt-1">{{ $activeRentals }}</h3>
                                <p class="text-blue-500 text-xs mt-2"><i class="fas fa-clock mr-1"></i> {{ $endingSoonCount }} ending soon</p>
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
                                <h3 class="text-2xl font-bold mt-1">Rp {{ number_format($totalRevenue / 1000000, 1) }}M</h3>
                                <p class="text-{{ $revenueGrowth >= 0 ? 'green' : 'red' }}-500 text-xs mt-2">
                                    <i class="fas fa-arrow-{{ $revenueGrowth >= 0 ? 'up' : 'down' }} mr-1"></i> 
                                    {{ abs($revenueGrowth) }}% from last month
                                </p>
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
                                <h3 class="text-2xl font-bold mt-1">{{ $totalLocations }}</h3>
                                <p class="text-gray-500 text-xs mt-2"><i class="fas fa-map-marker-alt mr-1"></i> {{ $citiesCount }} cities</p>
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
                            <select id="revenueChartPeriod" class="text-sm border border-gray-200 rounded-lg px-3 py-1 focus:outline-none focus:ring-2 focus:ring-primary">
                                <option value="month">This Month</option>
                                <option value="6months" selected>Last 6 Months</option>
                                <option value="year">This Year</option>
                            </select>
                        </div>
                        <div class="h-64 bg-gray-50 rounded-lg">
                            <canvas id="revenueChart"></canvas>
                        </div>
                    </div>

                    <!-- Vehicle Status -->
                    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                        <h2 class="text-lg font-semibold mb-4">Vehicle Status</h2>
                        <div class="space-y-4">
                            <div>
                                <div class="flex justify-between text-sm mb-1">
                                    <span>Available</span>
                                    <span>{{ $availableVehicles }}/{{ $totalArmada }}</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-green-500 h-2 rounded-full" style="width: {{ $availablePercentage }}%"></div>
                                </div>
                            </div>
                            <div>
                                <div class="flex justify-between text-sm mb-1">
                                    <span>Rented</span>
                                    <span>{{ $rentedVehicles }}/{{ $totalArmada }}</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-blue-500 h-2 rounded-full" style="width: {{ $rentedPercentage }}%"></div>
                                </div>
                            </div>
                            <div>
                                <div class="flex justify-between text-sm mb-1">
                                    <span>Maintenance</span>
                                    <span>{{ $maintenanceVehicles }}/{{ $totalArmada }}</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-yellow-500 h-2 rounded-full" style="width: {{ $maintenancePercentage }}%"></div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-6 pt-4 border-t border-gray-100">
                            <div class="flex items-center justify-between mb-2">
                                <div class="flex items-center">
                                    <div class="w-3 h-3 rounded-full bg-green-500 mr-2"></div>
                                    <span class="text-sm">Available</span>
                                </div>
                                <span class="text-sm font-medium">{{ $availableVehicles }}</span>
                            </div>
                            <div class="flex items-center justify-between mb-2">
                                <div class="flex items-center">
                                    <div class="w-3 h-3 rounded-full bg-blue-500 mr-2"></div>
                                    <span class="text-sm">Rented</span>
                                </div>
                                <span class="text-sm font-medium">{{ $rentedVehicles }}</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <div class="w-3 h-3 rounded-full bg-yellow-500 mr-2"></div>
                                    <span class="text-sm">Maintenance</span>
                                </div>
                                <span class="text-sm font-medium">{{ $maintenanceVehicles }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Rentals -->
                <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-100">
                    <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center">
                        <h2 class="text-lg font-semibold">Recent Rentals</h2>
                        <a href="{{ route('peminjaman.index') }}" class="text-primary text-sm font-medium hover:text-blue-700">View All</a>
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
                                @forelse($recentRentals as $rental)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-medium">
                                                {{ substr($rental->nama_peminjam, 0, 1) }}
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">{{ $rental->nama_peminjam }}</div>
                                                <div class="text-sm text-gray-500">{{ $rental->phone }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $rental->armada->merk }}</div>
                                        <div class="text-sm text-gray-500">{{ $rental->armada->thn_beli }} • {{ $rental->armada->nopol }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ \Carbon\Carbon::parse($rental->mulai)->format('d M Y') }} - {{ \Carbon\Carbon::parse($rental->selesai)->format('d M Y') }}</div>
                                        <div class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($rental->mulai)->diffInDays(\Carbon\Carbon::parse($rental->selesai)) + 1 }} days</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @php
                                            $statusColor = 'yellow';
                                            if($rental->status_pinjam == 'Selesai') {
                                                $statusColor = 'green';
                                            } elseif($rental->status_pinjam == 'Dibatalkan') {
                                                $statusColor = 'red';
                                            } elseif($rental->status_pinjam == 'Aktif') {
                                                $statusColor = 'blue';
                                            }
                                        @endphp
                                        <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-{{ $statusColor }}-100 text-{{ $statusColor }}-800">
                                            {{ $rental->status_pinjam }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-medium">
                                        Rp {{ number_format($rental->biaya / 1000000, 1) }}M
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <a href="{{ route('peminjaman.show', $rental->id) }}" class="text-primary hover:text-blue-700 mr-3"><i class="fas fa-eye"></i></a>
                                        <a href="{{ route('peminjaman.edit', $rental->id) }}" class="text-secondary hover:text-green-700"><i class="fas fa-edit"></i></a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                        No rentals found
                                    </td>
                                </tr>
                                @endforelse
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

@push('scripts')
<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Data dari controller
        const monthLabels = @json($monthLabels);
        const monthlyRevenue = @json($monthlyRevenue);
        
        // Setup chart
        const ctx = document.getElementById('revenueChart').getContext('2d');
        const revenueChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: monthLabels,
                datasets: [{
                    label: 'Revenue (in millions)',
                    data: monthlyRevenue,
                    backgroundColor: 'rgba(79, 70, 229, 0.2)',
                    borderColor: 'rgba(79, 70, 229, 1)',
                    borderWidth: 2,
                    tension: 0.3,
                    fill: true,
                    pointBackgroundColor: '#fff',
                    pointBorderColor: 'rgba(79, 70, 229, 1)',
                    pointBorderWidth: 2,
                    pointRadius: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return 'Rp ' + value + 'M';
                            }
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return 'Rp ' + context.raw.toFixed(1) + 'M';
                            }
                        }
                    }
                }
            }
        });
        
        // Handle period change
        document.getElementById('revenueChartPeriod').addEventListener('change', function() {
            // In a real application, this would fetch new data based on the selected period
            // For now, we'll just show an alert
            alert('In a complete implementation, this would load data for the selected period: ' + this.value);
        });
    });
</script>
@endpush
