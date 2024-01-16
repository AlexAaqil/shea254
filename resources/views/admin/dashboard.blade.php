@extends('partials.base')

@section('content')
<main class="Admin">
    @include('admin.sidenav')
    <section class="Main Dashboard">
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
                        <p>xxx</p>
                    </div>
                </div>
            </div>

            <div class="analytics">
                <div class="chart">
                    <h2>Sales</h2>
                    <canvas id="salesChart"></canvas>
                </div>
                <div class="chart">
                    <h2>Cities</h2>
                    <canvas id="citiesChart"></canvas>
                </div>
            </div>

            <div class="analytics">
<div class="info sales_analytics">
                    <h3>Sales Analytics</h3>
                    <ul class="list_style_none">
                        <li>
                            <span>Today</span>
                            <span>Ksh. 10, 000</span>
                        </li>

                        <li>
                            <span>This Week</span>
                            <span>Ksh. 10, 000</span>
                        </li>

                        <li>
                            <span>This Month</span>
                            <span>Ksh. 10, 000</span>
                        </li>

                        <li>
                            <span>This Year</span>
                            <span>Ksh. 10, 000</span>
                        </li>
                    </ul>
                </div>

                <div class="info recent_orders">
                    <ul class="list_style_none">
                        <li>
                            <span>Mint Essential Oil</span>
                            <span>Ksh. 10000</span>
                        </li>
                        <li>
                            <span>Mint Essential Oil</span>
                            <span>Ksh. 10000</span>
                        </li>
                        <li>
                            <span>Mint Essential Oil</span>
                            <span>Ksh. 10000</span>
                        </li>
                        <li>
                            <span>Mint Essential Oil</span>
                            <span>Ksh. 10000</span>
                        </li>
                        <li>
                            <span>Mint Essential Oil</span>
                            <span>Ksh. 10000</span>
                        </li>
                    </ul>
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
      labels: ['january', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
      datasets: [{
        label: 'Amount',
        data: [1000, 1900, 3, 5, 2, 3],
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });

  const cities = document.getElementById('citiesChart');

  new Chart(cities, {
    type: 'doughnut',
    data: {
      labels: ['Nairobi', 'Kiambu', 'Nakuru'],
      datasets: [{
        label: 'Orders',
        data: [100, 19, 3],
      }]
    },
    options: {
      plugins: {
        legend: {
          display: true,
          position: 'right',
        }
      }
    }
  });
</script>
@endsection
