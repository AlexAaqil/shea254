<x-admin>
    <section class="Admin_dashboard">
        <div class="container">
            <div class="hero">
                <p>Hi {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</p>
            </div>
        
            <div class="stats">
                <div class="stat">
                    <div class="icon">
                        <i class="fas fa-users-cog"></i>
                    </div>
                    <div class="text">
                        <p>
                            <a href="{{ route('admin.admins') }}">Admins</a>
                        </p>
                        <p>{{ $count_admins }}</p>
                    </div>
                </div>
        
                <div class="stat">
                    <div class="icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="text">
                        <p>
                            <a href="{{ route('admin.admins') }}">Users</a>
                        </p>
                        <p>{{ $count_users }}</p>
                    </div>
                </div>
        
                <div class="stat">
                    <div class="icon">
                        <i class="fas fa-tags"></i>
                    </div>
                    <div class="text">
                        <p>
                            <a href="">Categories</a>
                        </p>
                        <p>xxx</p>
                    </div>
                </div>
        
                <div class="stat">
                    <div class="icon">
                        <i class="fas fa-barcode"></i>
                    </div>
                    <div class="text">
                        <p>
                            <a href="">Products</a>
                        </p>
                        <p>xxx</p>
                    </div>
                </div>
        
                <div class="stat">
                    <div class="icon">
                        <i class="fas fa-blog"></i>
                    </div>
                    <div class="text">
                        <p>
                            <a href="{{ route('blogs.index') }}">Blogs</a>
                        </p>
                        <p>{{ $count_blogs }}</p>
                    </div>
                </div>
        
                <div class="stat">
                    <div class="icon">
                        <i class="fas fa-comment"></i>
                    </div>
                    <div class="text">
                        <p>
                            <a href="{{ route('comments.index') }}">Comments</a>
                        </p>
                        <p>{{ $count_comments }}</p>
                    </div>
                </div>
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

            <div class="charts">
                <div class="chart">
                    <h2>Sales</h2>
                    <canvas id="salesChart"></canvas>
                </div>
                <div class="chart">
                    <h2>Location Orders</h2>
                    <canvas id="citiesChart"></canvas>
                </div>
            </div>
        </div>
    </section>
</x-admin>