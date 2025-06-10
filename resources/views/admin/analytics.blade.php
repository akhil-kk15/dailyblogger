<!DOCTYPE html>
<html>
  <head> 
   @include('admin.admincss')
   <meta name="csrf-token" content="{{ csrf_token() }}">
   <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
   <style type="text/css">
    .page-content {
        padding: 30px;
        background: #f8f9fa;
    }
    .analytics_title {
        font-size: 30px;
        text-align: center;
        padding: 20px;
        font-family: "Muli", sans-serif;
        color: #333;
        margin-bottom: 30px;
    }
    .stats_grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        margin-bottom: 40px;
    }
    .stat_card {
        background: white;
        border-radius: 10px;
        padding: 25px;
        box-shadow: 0 4px 16px rgba(0,0,0,0.1);
        border-left: 4px solid #007bff;
        transition: transform 0.3s ease;
    }
    .stat_card:hover {
        transform: translateY(-5px);
    }
    .stat_card.featured {
        border-left-color: #ffc107;
    }
    .stat_card.users {
        border-left-color: #28a745;
    }
    .stat_card.comments {
        border-left-color: #17a2b8;
    }
    .stat_card.categories {
        border-left-color: #6f42c1;
    }
    .stat_number {
        font-size: 32px;
        font-weight: bold;
        color: #333;
        margin-bottom: 5px;
    }
    .stat_label {
        color: #666;
        font-size: 14px;
        text-transform: uppercase;
        font-weight: 600;
    }
    .stat_icon {
        float: right;
        font-size: 24px;
        color: #ccc;
        margin-top: -10px;
    }
    .chart_container {
        background: white;
        border-radius: 10px;
        padding: 25px;
        margin-bottom: 30px;
        box-shadow: 0 4px 16px rgba(0,0,0,0.1);
    }
    .chart_title {
        font-size: 18px;
        font-weight: bold;
        margin-bottom: 20px;
        color: #333;
    }
    .chart_grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 30px;
        margin-bottom: 30px;
    }
    .table_container {
        background: white;
        border-radius: 10px;
        padding: 25px;
        margin-bottom: 30px;
        box-shadow: 0 4px 16px rgba(0,0,0,0.1);
    }
    .analytics_table {
        width: 100%;
        border-collapse: collapse;
    }
    .analytics_table th {
        background: #f8f9fa;
        padding: 12px;
        text-align: left;
        font-weight: 600;
        color: #333;
        border-bottom: 1px solid #eee;
    }
    .analytics_table td {
        padding: 12px;
        border-bottom: 1px solid #f0f0f0;
        color: #666;
    }
    .recent_posts_table {
        margin-top: 10px;
    }
    .status_badge {
        padding: 4px 8px;
        border-radius: 12px;
        font-size: 11px;
        font-weight: 600;
        text-transform: uppercase;
    }
    .status_active {
        background: #d4edda;
        color: #155724;
    }
    .status_pending {
        background: #fff3cd;
        color: #856404;
    }
    .status_rejected {
        background: #f8d7da;
        color: #721c24;
    }
    @media (max-width: 768px) {
        .chart_grid {
            grid-template-columns: 1fr;
        }
        .stats_grid {
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        }
    }
   </style>
  </head>
  <body>
    <header class="header">   
     @include('admin.header')
    </header>
    <div class="d-flex align-items-stretch">
      <!-- Sidebar Navigation-->
      @include('admin.sidebar')
      <!-- Sidebar Navigation end-->
      
      <div class="page-content">
        <h1 class="analytics_title">📊 Analytics Dashboard</h1>
        
        <!-- Statistics Grid -->
        <div class="stats_grid">
            <div class="stat_card">
                <div class="stat_icon"><i class="fa fa-file-text"></i></div>
                <div class="stat_number">{{ $stats['total_posts'] }}</div>
                <div class="stat_label">Total Posts</div>
            </div>
            <div class="stat_card">
                <div class="stat_icon"><i class="fa fa-check"></i></div>
                <div class="stat_number">{{ $stats['active_posts'] }}</div>
                <div class="stat_label">Active Posts</div>
            </div>
            <div class="stat_card">
                <div class="stat_icon"><i class="fa fa-clock-o"></i></div>
                <div class="stat_number">{{ $stats['pending_posts'] }}</div>
                <div class="stat_label">Pending Posts</div>
            </div>
            <div class="stat_card featured">
                <div class="stat_icon"><i class="fa fa-star"></i></div>
                <div class="stat_number">{{ $stats['featured_posts'] }}</div>
                <div class="stat_label">Featured Posts</div>
            </div>
            <div class="stat_card users">
                <div class="stat_icon"><i class="fa fa-users"></i></div>
                <div class="stat_number">{{ $stats['total_users'] }}</div>
                <div class="stat_label">Total Users</div>
            </div>
            <div class="stat_card comments">
                <div class="stat_icon"><i class="fa fa-comments"></i></div>
                <div class="stat_number">{{ $stats['total_comments'] }}</div>
                <div class="stat_label">Total Comments</div>
            </div>
            <div class="stat_card categories">
                <div class="stat_icon"><i class="fa fa-folder"></i></div>
                <div class="stat_number">{{ $stats['total_categories'] }}</div>
                <div class="stat_label">Categories</div>
            </div>
            <div class="stat_card categories">
                <div class="stat_icon"><i class="fa fa-tags"></i></div>
                <div class="stat_number">{{ $stats['total_tags'] }}</div>
                <div class="stat_label">Tags</div>
            </div>
        </div>

        <!-- Charts -->
        <div class="chart_grid">
            <div class="chart_container">
                <h3 class="chart_title">Posts by Status</h3>
                <canvas id="postsStatusChart" width="400" height="300"></canvas>
            </div>
            <div class="chart_container">
                <h3 class="chart_title">Posts Created (Last 7 Days)</h3>
                <canvas id="postsTimelineChart" width="400" height="300"></canvas>
            </div>
        </div>

        <!-- Top Categories Table -->
        <div class="table_container">
            <h3 class="chart_title">Top Categories by Post Count</h3>
            <table class="analytics_table">
                <thead>
                    <tr>
                        <th>Category</th>
                        <th>Posts</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($topCategories as $category)
                        <tr>
                            <td><strong>{{ $category->name }}</strong></td>
                            <td>{{ $category->posts_count }} posts</td>
                            <td>
                                <span class="status_badge status_active">Active</span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Top Users Table -->
        <div class="table_container">
            <h3 class="chart_title">Most Active Users</h3>
            <table class="analytics_table">
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Posts</th>
                        <th>Join Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($topUsers as $user)
                        <tr>
                            <td><strong>{{ $user->name }}</strong><br><small>{{ $user->email }}</small></td>
                            <td>{{ $user->posts_count }} posts</td>
                            <td>{{ $user->created_at->format('M d, Y') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Recent Posts Activity -->
        <div class="table_container">
            <h3 class="chart_title">Recent Posts Activity</h3>
            <table class="analytics_table recent_posts_table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Category</th>
                        <th>Status</th>
                        <th>Created</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recentPosts as $post)
                        <tr>
                            <td>
                                <strong>{{ Str::limit($post->title, 40) }}</strong>
                                @if($post->is_featured)
                                    <span style="color: #ffc107; margin-left: 5px;"><i class="fa fa-star"></i></span>
                                @endif
                            </td>
                            <td>{{ $post->user->name ?? 'Unknown' }}</td>
                            <td>{{ $post->category->name ?? 'Uncategorized' }}</td>
                            <td>
                                <span class="status_badge status_{{ $post->post_status }}">
                                    {{ ucfirst($post->post_status) }}
                                </span>
                            </td>
                            <td>{{ $post->created_at->diffForHumans() }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

      </div>
    </div>
    @include('admin.footer')
    
    <script>
        // Posts by Status Pie Chart
        const statusCtx = document.getElementById('postsStatusChart').getContext('2d');
        const statusData = @json($postsByStatus);
        
        new Chart(statusCtx, {
            type: 'doughnut',
            data: {
                labels: Object.keys(statusData).map(key => key.charAt(0).toUpperCase() + key.slice(1)),
                datasets: [{
                    data: Object.values(statusData),
                    backgroundColor: [
                        '#28a745',  // active - green
                        '#ffc107',  // pending - yellow
                        '#dc3545',  // rejected - red
                    ],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            padding: 20,
                            usePointStyle: true
                        }
                    }
                }
            }
        });

        // Posts Timeline Line Chart
        const timelineCtx = document.getElementById('postsTimelineChart').getContext('2d');
        const timelineData = @json($postsLast7Days);
        
        new Chart(timelineCtx, {
            type: 'line',
            data: {
                labels: timelineData.map(item => item.date),
                datasets: [{
                    label: 'Posts Created',
                    data: timelineData.map(item => item.count),
                    borderColor: '#007bff',
                    backgroundColor: 'rgba(0, 123, 255, 0.1)',
                    borderWidth: 3,
                    fill: true,
                    tension: 0.4,
                    pointBackgroundColor: '#007bff',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    pointRadius: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                }
            }
        });
    </script>
  </body>
</html>
