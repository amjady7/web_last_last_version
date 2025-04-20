@extends('admin.layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    @if (session('success'))
        <div class="bg-green-500 text-white p-4 rounded-lg mb-6">
            {{ session('success') }}
        </div>
    @endif

    <!-- Page Heading -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-100">Dashboard</h1>
        <div class="flex space-x-4">
            <a href="{{ route('home') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition duration-300">
                Go to Home
            </a>
        </div>
    </div>

    <!-- Content Row -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
        <!-- Category Card -->
        <div class="bg-gray-800 rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="flex-1">
                    <p class="text-sm font-medium text-gray-400">Categories</p>
                    <p class="text-2xl font-semibold text-gray-100">{{ \App\Models\Category::where('is_active', true)->count() }}</p>
                </div>
                <div class="text-gray-400">
                    <i class="fas fa-sitemap fa-2x"></i>
                </div>
            </div>
        </div>

        <!-- Products Card -->
        <div class="bg-gray-800 rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="flex-1">
                    <p class="text-sm font-medium text-gray-400">Products</p>
                    <p class="text-2xl font-semibold text-gray-100">{{ \App\Models\Product::where('is_active', true)->count() }}</p>
                </div>
                <div class="text-gray-400">
                    <i class="fas fa-cubes fa-2x"></i>
                </div>
            </div>
        </div>

        <!-- Orders Card -->
        <div class="bg-gray-800 rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="flex-1">
                    <p class="text-sm font-medium text-gray-400">Orders</p>
                    <p class="text-2xl font-semibold text-gray-100">{{ \App\Models\Order::where('status', '!=', 'cancelled')->count() }}</p>
                </div>
                <div class="text-gray-400">
                    <i class="fas fa-clipboard-list fa-2x"></i>
                </div>
            </div>
        </div>

        <!-- Posts Card -->
        <div class="bg-gray-800 rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="text-gray-400">
                 <!--   <i class="fas fa-folder fa-2x"></i>-->
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Earnings Chart -->
        <div class="bg-gray-800 rounded-lg shadow p-6">
            <div class="flex justify-between items-center mb-4">
                <h6 class="text-lg font-semibold text-gray-100">Earnings Overview</h6>
            </div>
            <div class="chart-area">
                <canvas id="earningsChart"></canvas>
            </div>
        </div>

        <!-- Users Chart -->
        <div class="bg-gray-800 rounded-lg shadow p-6">
            <div class="flex justify-between items-center mb-4">
                <h6 class="text-lg font-semibold text-gray-100">Users</h6>
            </div>
            <div id="usersChart" style="height: 300px;"></div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script>
    // Load Google Charts
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawUsersChart);

    // Users Chart
    function drawUsersChart() {
        var data = google.visualization.arrayToDataTable([
            ['Day', 'Users'],
            @foreach($users as $user)
                ['{{ $user->date }}', {{ $user->count }}],
            @endforeach
        ]);

        var options = {
            title: 'Last 7 Days Registered Users',
            backgroundColor: 'transparent',
            titleTextStyle: { color: '#fff' },
            legend: { textStyle: { color: '#fff' } },
            hAxis: { textStyle: { color: '#fff' } },
            vAxis: { textStyle: { color: '#fff' } }
        };

        var chart = new google.visualization.PieChart(document.getElementById('usersChart'));
        chart.draw(data, options);
    }

    // Earnings Chart
    const ctx = document.getElementById('earningsChart');
    const url = "{{ route('admin.earnings') }}";

    axios.get(url)
        .then(function (response) {
            const data = response.data;
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: Object.keys(data),
                    datasets: [{
                        label: 'Earnings',
                        data: Object.values(data),
                        borderColor: 'rgb(75, 192, 192)',
                        tension: 0.1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            labels: {
                                color: '#fff'
                            }
                        }
                    },
                    scales: {
                        y: {
                            ticks: {
                                color: '#fff'
                            },
                            grid: {
                                color: 'rgba(255, 255, 255, 0.1)'
                            }
                        },
                        x: {
                            ticks: {
                                color: '#fff'
                            },
                            grid: {
                                color: 'rgba(255, 255, 255, 0.1)'
                            }
                        }
                    }
                }
            });
        })
        .catch(function (error) {
            console.error('Error fetching earnings data:', error);
        });
</script>
@endpush 