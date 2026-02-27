<x-admin-layout>
<!-- Welcome Section -->
<div class="mb-8">
    <h2 class="text-3xl font-bold text-gray-900">Dashboard</h2>
    <p class="text-gray-600">Welcome back, Admin</p>
    <p class="text-sm text-gray-500 mt-2">📅 {{ now()->format('l, F d, Y') }}</p>
</div>

<!-- Stats Cards -->
<div class="grid grid-cols-4 gap-6 mb-8">
    <!-- Total Care -->
    <div class="bg-white rounded-lg p-6 shadow-sm border border-gray-100">
        <div class="flex items-start justify-between mb-4">
            <div>
                <p class="text-gray-600 text-sm">Total Care</p>
                <p class="text-4xl font-bold text-gray-900">{{ $stats['total_cats'] ?? 0 }}</p>
                <p class="text-xs text-gray-500 mt-1">Cats in System</p>
            </div>
            <span class="text-4xl">🐱</span>
        </div>
        <div class="flex items-center gap-1">
            <span class="text-green-500 text-sm">↓ 12%</span>
            <span class="text-gray-500 text-xs">from last month</span>
        </div>
    </div>

    <!-- Adoptions -->
    <div class="bg-white rounded-lg p-6 shadow-sm border border-gray-100">
        <div class="flex items-start justify-between mb-4">
            <div>
                <p class="text-gray-600 text-sm">Adoptions</p>
                <p class="text-4xl font-bold text-gray-900">{{ $stats['adoptions_this_month'] ?? 0 }}</p>
                <p class="text-xs text-gray-500 mt-1">This Month</p>
            </div>
            <span class="text-4xl">❤️</span>
        </div>
        <div class="flex items-center gap-1">
            <span class="text-green-500 text-sm">↑ 15.2%</span>
            <span class="text-gray-500 text-xs">from last month</span>
        </div>
    </div>

    <!-- Volunteers -->
    <div class="bg-white rounded-lg p-6 shadow-sm border border-gray-100">
        <div class="flex items-start justify-between mb-4">
            <div>
                <p class="text-gray-600 text-sm">Volunteers</p>
                <p class="text-4xl font-bold text-gray-900">{{ $stats['total_users'] ?? 0 }}</p>
                <p class="text-xs text-gray-500 mt-1">Active Team</p>
            </div>
            <span class="text-4xl">👥</span>
        </div>
        <div class="flex items-center gap-1">
            <span class="text-green-500 text-sm">↑ 2</span>
            <span class="text-gray-500 text-xs">new this week</span>
        </div>
    </div>

    <!-- Revenue -->
    <div class="bg-white rounded-lg p-6 shadow-sm border border-gray-100">
        <div class="flex items-start justify-between mb-4">
            <div>
                <p class="text-gray-600 text-sm">Revenue</p>
                <p class="text-4xl font-bold text-gray-900">${{ number_format(($stats['total_donations'] ?? 0) / 1000, 1) }}k</p>
                <p class="text-xs text-gray-500 mt-1">Donations YTD</p>
            </div>
            <span class="text-4xl">💰</span>
        </div>
        <div class="flex items-center gap-1">
            <span class="text-green-500 text-sm">↑ 8%</span>
            <span class="text-gray-500 text-xs">from last month</span>
        </div>
    </div>
</div>

<!-- Charts Row -->
<div class="grid grid-cols-3 gap-6">
    <!-- Adoption vs Intake Trends -->
    <div class="col-span-2 bg-white rounded-lg p-6 shadow-sm border border-gray-100">
        <h3 class="text-lg font-semibold text-gray-900 mb-6 flex items-center gap-2">
            <span>📈</span> Adoption vs Intake Trends
        </h3>
        <canvas id="trendsChart" height="80"></canvas>
    </div>

    <!-- Recent Activity -->
    <div class="bg-white rounded-lg p-6 shadow-sm border border-gray-100">
        <h3 class="text-lg font-semibold text-gray-900 mb-6">Recent Activity</h3>
        <div class="space-y-4 max-h-96 overflow-y-auto">
            <div class="flex gap-3">
                <div class="w-3 h-3 bg-pink-400 rounded-full mt-2 flex-shrink-0"></div>
                <div>
                    <p class="text-sm text-gray-900">Luna was adopted by Sarah J.</p>
                    <p class="text-xs text-gray-500">2 hours ago</p>
                </div>
            </div>
            <div class="flex gap-3">
                <div class="w-3 h-3 bg-blue-400 rounded-full mt-2 flex-shrink-0"></div>
                <div>
                    <p class="text-sm text-gray-900">New intake: Oliver (Siamese)</p>
                    <p class="text-xs text-gray-500">4 hours ago</p>
                </div>
            </div>
            <div class="flex gap-3">
                <div class="w-3 h-3 bg-gray-400 rounded-full mt-2 flex-shrink-0"></div>
                <div>
                    <p class="text-sm text-gray-900">Medical checkup completed for Mittens</p>
                    <p class="text-xs text-gray-500">5 hours ago</p>
                </div>
            </div>
            <div class="flex gap-3">
                <div class="w-3 h-3 bg-gray-400 rounded-full mt-2 flex-shrink-0"></div>
                <div>
                    <p class="text-sm text-gray-900">Volunteer orientation scheduled</p>
                    <p class="text-xs text-gray-500">1 day ago</p>
                </div>
            </div>
        </div>
        <a href="#" class="text-blue-600 hover:text-blue-700 text-sm font-medium mt-4 inline-block">View All Activity</a>
    </div>
</div>

<script>
    // Adoption vs Intake Trends Chart
    const ctx = document.getElementById('trendsChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
            datasets: [
                {
                    label: 'Adoptions',
                    data: [5, 6, 8, 12, 15, 14, 18],
                    borderColor: '#ec4899',
                    backgroundColor: 'rgba(236, 72, 153, 0.1)',
                    fill: true,
                    tension: 0.4,
                    borderWidth: 3,
                    pointRadius: 0,
                },
                {
                    label: 'Intake',
                    data: [5, 4, 7, 9, 11, 10, 13],
                    borderColor: '#3b82f6',
                    backgroundColor: 'rgba(59, 130, 246, 0.1)',
                    fill: true,
                    tension: 0.4,
                    borderWidth: 3,
                    pointRadius: 0,
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: {
                    position: 'top',
                    labels: {
                        usePointStyle: true,
                        padding: 20,
                        font: {
                            size: 12,
                            weight: '500'
                        }
                    }
                },
                filler: {
                    propagate: true
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    max: 20,
                    ticks: {
                        stepSize: 5,
                        font: {
                            size: 12
                        }
                    },
                    grid: {
                        color: '#f3f4f6',
                    }
                },
                x: {
                    grid: {
                        display: false
                    },
                    ticks: {
                        font: {
                            size: 12
                        }
                    }
                }
            }
        }
    });
</script>
</x-admin-layout>
