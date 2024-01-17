@extends('partials.base')

@section('content')
<main class="Admin">
    @include('admin.sidenav')
    <section class="Main Admin_Dashboard">
        <div class="container">
            <h1>Dashboard</h1>

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
                        <i class="fas fa-store-alt"></i>
                    </div>
                    <div class="text">
                        <p>Products</p>
                        <p>{{ $count_products }}</p>
                    </div>
                </div>

                <div class="static">
                    <div class="icon">
                        <i class="fas fa-truck"></i>
                    </div>
                    <div class="text">
                        <p>Orders</p>
                        <p>{{ $count_orders }}</p>
                    </div>
                </div>

                <div class="static">
                    <div class="icon">
                        <i class="fas fa-balance-scale-left"></i>
                    </div>
                    <div class="text">
                        <p>Sales</p>
                        <p>{{ number_format($total_sales) }}</p>
                    </div>
                </div>
            </div>

            <div class="analytics">
                <div class="info">
                    <h2>Sales Analytics</h2>
                    <ul class="list_style_none sales_analytics">
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

            <div class="charts">
                <div class="chart">
                    <h2>{{ $this_year }} Sales</h2>
                    <canvas id="salesChart"></canvas>
                </div>
                <div class="chart">
                    <h2>Cities</h2>
                    <canvas id="citiesChart"></canvas>
                </div>
            </div>
        </div>
    </section>
</main>
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
            labels: {!! json_encode($cities_labels) !!},
            datasets: [{
                label: 'Orders',
                data: {!! json_encode($cities_orders) !!},
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
