@extends('admin.partials.base')
@section('admin_content')
    <div class="container admin_dashboard">
        <div class="hero">
            <p>Hi {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</p>
        </div>

        <div class="statistics">
            <div class="static">
                <div class="icon">
                    <i class="fas fa-users-cog"></i>
                </div>
                <div class="text">
                    <p>Admins</p>
                    <p>{{ $count_admins }}</p>
                </div>
            </div>

            <div class="static">
                <div class="icon">
                    <i class="fas fa-users"></i>
                </div>
                <div class="text">
                    <p>Users</p>
                    <p>{{ $count_users }}</p>
                </div>
            </div>

            <div class="static">
                <div class="icon">
                    <i class="fas fa-tags"></i>
                </div>
                <div class="text">
                    <p>Categories</p>
                    <p>{{ $count_categories }}</p>
                </div>
            </div>

            <div class="static">
                <div class="icon">
                    <i class="fas fa-barcode"></i>
                </div>
                <div class="text">
                    <p>Products</p>
                    <p>{{ $count_products }}</p>
                </div>
            </div>

            <div class="static">
                <div class="icon">
                    <i class="fas fa-blog"></i>
                </div>
                <div class="text">
                    <p>Blogs</p>
                    <p>{{ $count_blogs }}</p>
                </div>
            </div>

            <div class="static">
                <div class="icon">
                    <i class="fas fa-comment"></i>
                </div>
                <div class="text">
                    <p>Comments</p>
                    <p>{{ $count_comments }}</p>
                </div>
            </div>
        </div>

        <div class="sales_analytics">
            <div class="header">
                <h2>Sales Analytics</h2>

                <form action="">
                    <select name="duration" id="duration">
                        <option value="today">Today</option>
                        <option value="this_week">This Week</option>
                        <option value="this_month">This Month</option>
                        <option value="this_year">This Year</option>
                    </select>
                </form>
            </div>

            <div class="analytics">
                <div class="analytic">
                    <div class="text">
                        <p>xxx</p>
                        <p>Gross Sales</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                </div>

                <div class="analytic">
                    <div class="text">
                        <p>xxx</p>
                        <p>Net Sales</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                </div>

                <div class="analytic">
                    <div class="text">
                        <p>xxx</p>
                        <p>Cost of Sales</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                </div>

                <div class="analytic">
                    <div class="text">
                        <p>xxx</p>
                        <p>Gross Profit</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="charts">
            <div class="chart">
                <h2>{{ $this_year }} Sales</h2>
                <canvas id="salesChart"></canvas>
            </div>
            <div class="chart">
                <h2>Location Orders</h2>
                <canvas id="citiesChart"></canvas>
            </div>
        </div>

        <div class="sales">
            <div class="info">
                <h2>Sales Analytics</h2>
                <ul class="list_style_none sales_summary">
                    <li>
                        <span>Today</span>
                        <span>Ksh. {{ number_format($sales_today) }}</span>
                    </li>

                    <li>
                        <span>This Week</span>
                        <span>Ksh. {{ number_format($sales_this_week) }}</span>
                    </li>

                    <li>
                        <span>This Month</span>
                        <span>Ksh. {{ number_format($sales_this_month) }}</span>
                    </li>

                    <li>
                        <span>This Year</span>
                        <span>Ksh. {{ number_format($sales_this_year) }}</span>
                    </li>
                </ul>
            </div>

            <div class="info">
                <h2>
                    <a href="{{ route('list_orders') }}">Recent Orders</a>
                </h2>
                <ul class="list_style_none recent_orders">
                    @foreach($recent_orders as $order)
                    <li>
                        <span>{{ $order->order_number }}</span>
                        <span>Kshs. {{ number_format($order->total_amount) }}</span>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    @section('additional_javascript')
        <script src="{{ asset('assets/js/chart.js') }}"></script>
        <script>
        const ctx = document.getElementById('salesChart');

        new Chart(ctx, {
            type: 'bar',
            data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            datasets: [{
                label: 'Amount',
                data: {!! json_encode($sales_data) !!},
                borderWidth: 1
            }]
            },
            options: {
                responsive: true,
            }
        });

        const cities = document.getElementById('citiesChart');

            new Chart(cities, {
                type: 'doughnut',
                data: {
                    labels: {!! json_encode($locations_labels) !!},
                    datasets: [{
                        label: 'Orders',
                        data: {!! json_encode($locations_orders) !!},
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'right',
                        }
                    }
            }
        });
        </script>
    @endsection
@endsection
