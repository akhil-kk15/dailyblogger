<div class="page-content">
        <!-- Enhanced Dashboard Header -->
        <div class="page-header">
          <div class="container-fluid">
            <div class="dashboard-welcome">
              <div class="welcome-content">
                <h1 class="dashboard-title">
                  <i class="fa fa-tachometer" aria-hidden="true"></i>
                  {{ __('admin.welcome') }} {{ __('admin.admin_panel') }}
                </h1>
                <p class="dashboard-subtitle">
                  <i class="fa fa-calendar" aria-hidden="true"></i>
                  {{ date('l, F j, Y') }} | 
                  <i class="fa fa-clock-o" aria-hidden="true"></i>
                  <span id="current-time"></span>
                </p>
                <div class="quick-actions">
                  <a href="{{ route('admin.post_page') }}" class="quick-action-btn">
                    <i class="fa fa-plus"></i>
                    {{ __('admin.create_post') }}
                  </a>
                  <a href="{{ route('admin.analytics') }}" class="quick-action-btn">
                    <i class="fa fa-bar-chart"></i>
                    {{ __('admin.analytics') }}
                  </a>
                  <a href="{{ route('admin.show_posts') }}" class="quick-action-btn">
                    <i class="fa fa-list"></i>
                    {{ __('admin.manage_posts') }}
                  </a>
                </div>
              </div>
              <div class="welcome-stats">
                <div class="stat-item">
                  <div class="stat-number">{{ $stats['recentPosts'] ?? 0 }}</div>
                  <div class="stat-label">New Posts (30d)</div>
                </div>
                <div class="stat-item">
                  <div class="stat-number">{{ $stats['recentUsers'] ?? 0 }}</div>
                  <div class="stat-label">New Users (30d)</div>
                </div>
                <div class="stat-item">
                  <div class="stat-number">{{ $stats['recentApproved'] ?? 0 }}</div>
                  <div class="stat-label">Recently Published</div>
                </div>
                <div class="stat-item">
                  <div class="stat-number">{{ $stats['pendingPosts'] ?? 0 }}</div>
                  <div class="stat-label">Awaiting Review</div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Enhanced Statistics Section -->
        <section class="no-padding-top no-padding-bottom">
          <div class="container-fluid">
            <div class="section-header">
              <h3 class="section-title">
                <i class="fa fa-line-chart"></i>
                Performance Overview
              </h3>
              <p class="section-subtitle">Real-time insights into your blog's performance</p>
            </div>
            
            <div class="row">
              <div class="col-md-3 col-sm-6">
                <a href="{{ route('admin.users.index') }}" class="statistic-link">
                  <div class="statistic-block block">
                    <div class="progress-details d-flex align-items-end justify-content-between">
                      <div class="title">
                        <div class="icon"><i class="icon-user-1"></i></div><strong>Total Users</strong>
                      </div>
                      <div class="number dashtext-1">{{ $stats['totalUsers'] ?? 0 }}</div>
                    </div>
                    <div class="progress progress-template">
                      @php
                        $totalUsers = max($stats['totalUsers'] ?? 0, 1);
                        $recentUsers = max($stats['recentUsers'] ?? 0, 0);
                        $userProgress = min(max(($recentUsers / $totalUsers) * 100, 0), 100);
                        $userProgress = round($userProgress, 1);
                      @endphp
                      <div role="progressbar" style="width: {{ $userProgress }}%" aria-valuenow="{{ $userProgress }}" aria-valuemin="0" aria-valuemax="100" class="progress-bar progress-bar-template dashbg-1"></div>
                    </div>
                    <small class="text-muted">+{{ $stats['recentUsers'] ?? 0 }} this month</small>
                  </div>
                </a>
              </div>
              <div class="col-md-3 col-sm-6">
                <a href="{{ route('admin.show_posts') }}" class="statistic-link">
                  <div class="statistic-block block">
                    <div class="progress-details d-flex align-items-end justify-content-between">
                      <div class="title">
                        <div class="icon"><i class="icon-contract"></i></div><strong>Total Posts</strong>
                      </div>
                      <div class="number dashtext-2">{{ $stats['totalPosts'] ?? 0 }}</div>
                    </div>
                    <div class="progress progress-template">
                      @php
                        $totalPosts = max($stats['totalPosts'] ?? 0, 1);
                        $recentPosts = max($stats['recentPosts'] ?? 0, 0);
                        $postProgress = min(max(($recentPosts / $totalPosts) * 100, 0), 100);
                        $postProgress = round($postProgress, 1);
                      @endphp
                      <div role="progressbar" style="width: {{ $postProgress }}%" aria-valuenow="{{ $postProgress }}" aria-valuemin="0" aria-valuemax="100" class="progress-bar progress-bar-template dashbg-2"></div>
                    </div>
                    <small class="text-muted">+{{ $stats['recentPosts'] ?? 0 }} this month</small>
                  </div>
                </a>
              </div>
              <div class="col-md-3 col-sm-6">
                <a href="{{ route('admin.show_posts') }}?status=pending" class="statistic-link">
                  <div class="statistic-block block">
                    <div class="progress-details d-flex align-items-end justify-content-between">
                      <div class="title">
                        <div class="icon"><i class="icon-paper-and-pencil"></i></div><strong>Pending Approval</strong>
                      </div>
                      <div class="number dashtext-3">{{ $stats['pendingPosts'] ?? 0 }}</div>
                    </div>
                    <div class="progress progress-template">
                      @php
                        $totalPosts = max($stats['totalPosts'] ?? 0, 1);
                        $pendingPosts = max($stats['pendingPosts'] ?? 0, 0);
                        $pendingProgress = min(max(($pendingPosts / $totalPosts) * 100, 0), 100);
                        $pendingProgress = round($pendingProgress, 1);
                      @endphp
                      <div role="progressbar" style="width: {{ $pendingProgress }}%" aria-valuenow="{{ $pendingProgress }}" aria-valuemin="0" aria-valuemax="100" class="progress-bar progress-bar-template dashbg-3"></div>
                    </div>
                    <small class="text-muted">Needs attention</small>
                  </div>
                </a>
              </div>
              <div class="col-md-3 col-sm-6">
                <a href="{{ route('admin.show_posts') }}?status=active" class="statistic-link">
                  <div class="statistic-block block">
                    <div class="progress-details d-flex align-items-end justify-content-between">
                      <div class="title">
                        <div class="icon"><i class="icon-writing-whiteboard"></i></div><strong>Approved Posts</strong>
                      </div>
                      <div class="number dashtext-4">{{ $stats['approvedPosts'] ?? 0 }}</div>
                    </div>
                    <div class="progress progress-template">
                      @php
                        $totalPosts = max($stats['totalPosts'] ?? 0, 1);
                        $approvedPosts = max($stats['approvedPosts'] ?? 0, 0);
                        $approvedProgress = min(max(($approvedPosts / $totalPosts) * 100, 0), 100);
                        $approvedProgress = round($approvedProgress, 1);
                      @endphp
                      <div role="progressbar" style="width: {{ $approvedProgress }}%" aria-valuenow="{{ $approvedProgress }}" aria-valuemin="0" aria-valuemax="100" class="progress-bar progress-bar-template dashbg-4"></div>
                    </div>
                    <small class="text-muted">+{{ $stats['recentApproved'] ?? 0 }} this month</small>
                  </div>
                </a>
              </div>
            </div>
          </div>
        </section>
        
        <!-- Recent Activities Section -->
        <section class="no-padding-bottom">
          <div class="container-fluid">
            <div class="row">
              <div class="col-lg-6">
                <div class="recent-posts-block block">
                  <div class="title">
                    <strong><i class="fa fa-file-text-o"></i> Recent Posts</strong>
                    <span class="badge badge-primary">{{ $stats['recentPosts'] ?? 0 }} new</span>
                  </div>
                  @if(isset($recentPosts) && $recentPosts instanceof \Illuminate\Support\Collection && $recentPosts->count() > 0)
                    <div class="recent-posts-list">
                      @foreach($recentPosts as $post)
                        <div class="recent-post-item d-flex align-items-center">
                          <div class="post-image">
                            @if($post->image)
                              <img src="{{ asset('postimage/' . $post->image) }}" alt="Post Image" class="img-fluid">
                            @else
                              <div class="no-image"><i class="fa fa-file-text"></i></div>
                            @endif
                          </div>
                          <div class="post-content">
                            <strong class="d-block">{{ Str::limit($post->title, 40) }}</strong>
                            <span class="d-block text-muted">by {{ $post->name }}</span>
                            <small class="date d-block">{{ $post->created_at->diffForHumans() }}</small>
                            <span class="status-badge status-{{ $post->post_status }}">{{ ucfirst($post->post_status) }}</span>
                          </div>
                        </div>
                      @endforeach
                    </div>
                  @else
                    <div class="text-center text-muted py-4">
                      <i class="fa fa-file-text-o fa-3x mb-3"></i>
                      <p>No recent posts found</p>
                    </div>
                  @endif
                </div>
              </div>
              <div class="col-lg-6">
                <div class="recent-users-block block">
                  <div class="title">
                    <strong><i class="fa fa-users"></i> Recent Users</strong>
                    <span class="badge badge-success">{{ $stats['recentUsers'] ?? 0 }} new</span>
                  </div>
                  @if(isset($recentUsers) && $recentUsers instanceof \Illuminate\Support\Collection && $recentUsers->count() > 0)
                    <div class="recent-users-list">
                      @foreach($recentUsers as $user)
                        <div class="recent-user-item d-flex align-items-center">
                          <div class="user-avatar">
                            @if($user->profile_photo_path)
                              <img src="{{ asset('storage/' . $user->profile_photo_path) }}" alt="User Avatar" class="img-fluid rounded-circle">
                            @else
                              <div class="default-avatar"><i class="fa fa-user"></i></div>
                            @endif
                          </div>
                          <div class="user-content">
                            <strong class="d-block">{{ $user->name }}</strong>
                            <span class="d-block text-muted">{{ $user->email }}</span>
                            <small class="date d-block">Joined {{ $user->created_at->diffForHumans() }}</small>
                            <span class="user-type-badge">{{ ucfirst($user->usertype) }}</span>
                          </div>
                        </div>
                      @endforeach
                    </div>
                  @else
                    <div class="text-center text-muted py-4">
                      <i class="fa fa-users fa-3x mb-3"></i>
                      <p>No recent users found</p>
                    </div>
                  @endif
                </div>
              </div>
            </div>
          </div>
        </section>

        <!-- Quick Actions & Overview Section -->
        <section class="no-padding-bottom">
          <div class="container-fluid">
            <div class="row">
              <div class="col-lg-4">
                <div class="quick-stats-block block">
                  <div class="title"><strong><i class="fa fa-bolt"></i> Quick Stats</strong></div>
                  <div class="quick-stats-content">
                    <div class="stat-row d-flex justify-content-between align-items-center">
                      <span><i class="fa fa-eye text-info"></i> Today's Views</span>
                      <strong class="text-info">{{ $stats['todayViews'] ?? 0 }}</strong>
                    </div>
                    <div class="stat-row d-flex justify-content-between align-items-center">
                      <span><i class="fa fa-clock-o text-warning"></i> Pending Posts</span>
                      <strong class="text-warning">{{ $stats['pendingPosts'] ?? 0 }}</strong>
                    </div>
                    <div class="stat-row d-flex justify-content-between align-items-center">
                      <span><i class="fa fa-star text-success"></i> Featured Posts</span>
                      <strong class="text-success">{{ $stats['featuredPosts'] ?? 0 }}</strong>
                    </div>
                    <div class="stat-row d-flex justify-content-between align-items-center">
                      <span><i class="fa fa-comments text-primary"></i> Total Comments</span>
                      <strong class="text-primary">{{ $stats['totalComments'] ?? 0 }}</strong>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-4">
                <div class="activity-summary-block block">
                  <div class="title"><strong><i class="fa fa-activity"></i> This Week's Activity</strong></div>
                  <div class="activity-content">
                    <div class="activity-item">
                      <div class="activity-icon bg-success"><i class="fa fa-plus"></i></div>
                      <div class="activity-text">
                        <strong>{{ $stats['weeklyPosts'] ?? 0 }}</strong>
                        <span>Posts created</span>
                      </div>
                    </div>
                    <div class="activity-item">
                      <div class="activity-icon bg-info"><i class="fa fa-check"></i></div>
                      <div class="activity-text">
                        <strong>{{ $stats['weeklyApproved'] ?? 0 }}</strong>
                        <span>Posts approved</span>
                      </div>
                    </div>
                    <div class="activity-item">
                      <div class="activity-icon bg-warning"><i class="fa fa-user-plus"></i></div>
                      <div class="activity-text">
                        <strong>{{ $stats['weeklyUsers'] ?? 0 }}</strong>
                        <span>New users</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-4">
                <div class="action-center-block block">
                  <div class="title"><strong><i class="fa fa-cogs"></i> Action Center</strong></div>
                  <div class="action-buttons">
                    <a href="{{ route('admin.post_page') }}" class="action-btn btn-create">
                      <i class="fa fa-plus"></i>
                      <span>Create New Post</span>
                    </a>
                    <a href="{{ route('admin.show_posts', ['status' => 'pending']) }}" class="action-btn btn-review">
                      <i class="fa fa-clock-o"></i>
                      <span>Review Pending ({{ $stats['pendingPosts'] ?? 0 }})</span>
                    </a>
                    <a href="{{ route('admin.users.index') }}" class="action-btn btn-users">
                      <i class="fa fa-users"></i>
                      <span>Manage Users</span>
                    </a>
                    <a href="{{ route('admin.analytics') }}" class="action-btn btn-analytics">
                      <i class="fa fa-bar-chart"></i>
                      <span>View Analytics</span>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
        <!-- <section class="no-padding-bottom">
          <div class="container-fluid">
            <div class="row">
              <div class="col-lg-6">
                <div class="stats-2-block block d-flex">
                  <div class="stats-2 d-flex">
                    <div class="stats-2-arrow low"><i class="fa fa-caret-down"></i></div>
                    <div class="stats-2-content"><strong class="d-block">5.657</strong><span class="d-block">Standard Scans</span>
                      <div class="progress progress-template progress-small">
                        <div role="progressbar" style="width: 60%;" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" class="progress-bar progress-bar-template progress-bar-small dashbg-2"></div>
                      </div>
                    </div>
                  </div>
                  <div class="stats-2 d-flex">
                    <div class="stats-2-arrow height"><i class="fa fa-caret-up"></i></div>
                    <div class="stats-2-content"><strong class="d-block">3.1459</strong><span class="d-block">Team Scans</span>
                      <div class="progress progress-template progress-small">
                        <div role="progressbar" style="width: 35%;" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" class="progress-bar progress-bar-template progress-bar-small dashbg-3"></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="stats-3-block block d-flex">
                  <div class="stats-3"><strong class="d-block">745</strong><span class="d-block">Total requests</span>
                    <div class="progress progress-template progress-small">
                      <div role="progressbar" style="width: 35%;" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" class="progress-bar progress-bar-template progress-bar-small dashbg-1"></div>
                    </div>
                  </div>
                  <div class="stats-3 d-flex justify-content-between text-center">
                    <div class="item"><strong class="d-block strong-sm">4.124</strong><span class="d-block span-sm">Threats</span>
                      <div class="line"></div><small>+246</small>
                    </div>
                    <div class="item"><strong class="d-block strong-sm">2.147</strong><span class="d-block span-sm">Neutral</span>
                      <div class="line"></div><small>+416</small>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="drills-chart block">
                  <canvas id="lineChart1"></canvas>
                </div>
              </div>
            </div>
          </div>
        </section> -->
        <!-- <section class="no-padding-bottom">
          <div class="container-fluid">
            <div class="row">
              <div class="col-lg-4">
                <div class="user-block block text-center">
                  <div class="avatar"><img src="admincss/img/avatar-1.jpg" alt="..." class="img-fluid">
                    <div class="order dashbg-2">1st</div>
                  </div><a href="#" class="user-title">
                    <h3 class="h5">Richard Nevoreski</h3><span>@richardnevo</span></a>
                  <div class="contributions">950 Contributions</div>
                  <div class="details d-flex">
                    <div class="item"><i class="icon-info"></i><strong>150</strong></div>
                    <div class="item"><i class="fa fa-gg"></i><strong>340</strong></div>
                    <div class="item"><i class="icon-flow-branch"></i><strong>460</strong></div>
                  </div>
                </div>
              </div>
              <div class="col-lg-4">
                <div class="user-block block text-center">
                  <div class="avatar"><img src="admincss/img/avatar-4.jpg" alt="..." class="img-fluid">
                    <div class="order dashbg-1">2nd</div>
                  </div><a href="#" class="user-title">
                    <h3 class="h5">Samuel Watson</h3><span>@samwatson</span></a>
                  <div class="contributions">772 Contributions</div>
                  <div class="details d-flex">
                    <div class="item"><i class="icon-info"></i><strong>80</strong></div>
                    <div class="item"><i class="fa fa-gg"></i><strong>420</strong></div>
                    <div class="item"><i class="icon-flow-branch"></i><strong>272</strong></div>
                  </div>
                </div>
              </div>
              <div class="col-lg-4">
                <div class="user-block block text-center">
                  <div class="avatar"><img src="admincss/img/avatar-6.jpg" alt="..." class="img-fluid">
                    <div class="order dashbg-4">3rd</div>
                  </div><a href="#" class="user-title">
                    <h3 class="h5">Sebastian Wood</h3><span>@sebastian</span></a>
                  <div class="contributions">620 Contributions</div>
                  <div class="details d-flex">
                    <div class="item"><i class="icon-info"></i><strong>150</strong></div>
                    <div class="item"><i class="fa fa-gg"></i><strong>280</strong></div>
                    <div class="item"><i class="icon-flow-branch"></i><strong>190</strong></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="public-user-block block">
              <div class="row d-flex align-items-center">                   
                <div class="col-lg-4 d-flex align-items-center">
                  <div class="order">4th</div>
                  <div class="avatar"> <img src="admincss/img/avatar-1.jpg" alt="..." class="img-fluid"></div><a href="#" class="name"><strong class="d-block">Tomas Hecktor</strong><span class="d-block">@tomhecktor</span></a>
                </div>
                <div class="col-lg-4 text-center">
                  <div class="contributions">410 Contributions</div>
                </div>
                <div class="col-lg-4">
                  <div class="details d-flex">
                    <div class="item"><i class="icon-info"></i><strong>110</strong></div>
                    <div class="item"><i class="fa fa-gg"></i><strong>200</strong></div>
                    <div class="item"><i class="icon-flow-branch"></i><strong>100</strong></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="public-user-block block">
              <div class="row d-flex align-items-center">                   
                <div class="col-lg-4 d-flex align-items-center">
                  <div class="order">5th</div>
                  <div class="avatar"> <img src="admincss/img/avatar-2.jpg" alt="..." class="img-fluid"></div><a href="#" class="name"><strong class="d-block">Alexander Shelby</strong><span class="d-block">@alexshelby</span></a>
                </div>
                <div class="col-lg-4 text-center">
                  <div class="contributions">320 Contributions</div>
                </div>
                <div class="col-lg-4">
                  <div class="details d-flex">
                    <div class="item"><i class="icon-info"></i><strong>150</strong></div>
                    <div class="item"><i class="fa fa-gg"></i><strong>120</strong></div>
                    <div class="item"><i class="icon-flow-branch"></i><strong>50</strong></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="public-user-block block">
              <div class="row d-flex align-items-center">                   
                <div class="col-lg-4 d-flex align-items-center">
                  <div class="order">6th</div>
                  <div class="avatar"> <img src="admincss/img/avatar-6.jpg" alt="..." class="img-fluid"></div><a href="#" class="name"><strong class="d-block">Arther Kooper</strong><span class="d-block">@artherkooper</span></a>
                </div>
                <div class="col-lg-4 text-center">
                  <div class="contributions">170 Contributions</div>
                </div>
                <div class="col-lg-4">
                  <div class="details d-flex">
                    <div class="item"><i class="icon-info"></i><strong>60</strong></div>
                    <div class="item"><i class="fa fa-gg"></i><strong>70</strong></div>
                    <div class="item"><i class="icon-flow-branch"></i><strong>40</strong></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
        <section class="margin-bottom-sm">
          <div class="container-fluid">
            <div class="row d-flex align-items-stretch">
              <div class="col-lg-4">
                <div class="stats-with-chart-1 block">
                  <div class="title"> <strong class="d-block">Sales Difference</strong><span class="d-block">Lorem ipsum dolor sit</span></div>
                  <div class="row d-flex align-items-end justify-content-between">
                    <div class="col-5">
                      <div class="text"><strong class="d-block dashtext-3">$740</strong><span class="d-block">May 2017</span><small class="d-block">320 Sales</small></div>
                    </div>
                    <div class="col-7">
                      <div class="bar-chart chart">
                        <canvas id="salesBarChart1"></canvas>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-4">   
                <div class="stats-with-chart-1 block">
                  <div class="title"> <strong class="d-block">Visit Statistics</strong><span class="d-block">Lorem ipsum dolor sit</span></div>
                  <div class="row d-flex align-items-end justify-content-between">
                    <div class="col-4">
                      <div class="text"><strong class="d-block dashtext-1">$457</strong><span class="d-block">May 2017</span><small class="d-block">210 Sales</small></div>
                    </div>
                    <div class="col-8">
                      <div class="bar-chart chart">
                        <canvas id="visitPieChart"></canvas>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-4">
                <div class="stats-with-chart-1 block">
                  <div class="title"> <strong class="d-block">Sales Activities</strong><span class="d-block">Lorem ipsum dolor sit</span></div>
                  <div class="row d-flex align-items-end justify-content-between">
                    <div class="col-5">
                      <div class="text"><strong class="d-block dashtext-2">80%</strong><span class="d-block">May 2017</span><small class="d-block">+35 Sales</small></div>
                    </div>
                    <div class="col-7">
                      <div class="bar-chart chart">
                        <canvas id="salesBarChart2"></canvas>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section> -->
        <!-- <section class="no-padding-bottom">
          <div class="container-fluid">
            <div class="row">
              <div class="col-lg-6">
                <div class="checklist-block block">
                  <div class="title"><strong>To Do List</strong></div>
                  <div class="checklist">
                    <div class="item d-flex align-items-center">
                      <input type="checkbox" id="input-1" name="input-1" class="checkbox-template">
                      <label for="input-1">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</label>
                    </div>
                    <div class="item d-flex align-items-center">
                      <input type="checkbox" id="input-2" name="input-2" checked class="checkbox-template">
                      <label for="input-2">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</label>
                    </div>
                    <div class="item d-flex align-items-center">
                      <input type="checkbox" id="input-3" name="input-3" class="checkbox-template">
                      <label for="input-3">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</label>
                    </div>
                    <div class="item d-flex align-items-center">
                      <input type="checkbox" id="input-4" name="input-4" class="checkbox-template">
                      <label for="input-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</label>
                    </div>
                    <div class="item d-flex align-items-center">
                      <input type="checkbox" id="input-5" name="input-5" class="checkbox-template">
                      <label for="input-5">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</label>
                    </div>
                    <div class="item d-flex align-items-center">
                      <input type="checkbox" id="input-6" name="input-6" class="checkbox-template">
                      <label for="input-6">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</label>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-6">                                           
                <div class="messages-block block">
                  <div class="title"><strong>New Messages</strong></div>
                  <div class="messages"><a href="#" class="message d-flex align-items-center">
                      <div class="profile"><img src="admincss/img/avatar-3.jpg" alt="..." class="img-fluid">
                        <div class="status online"></div>
                      </div>
                      <div class="content">   <strong class="d-block">Nadia Halsey</strong><span class="d-block">lorem ipsum dolor sit amit</span><small class="date d-block">9:30am</small></div></a><a href="#" class="message d-flex align-items-center">
                      <div class="profile"><img src="admincss/img/avatar-2.jpg" alt="..." class="img-fluid">
                        <div class="status away"></div>
                      </div>
                      <div class="content">   <strong class="d-block">Peter Ramsy</strong><span class="d-block">lorem ipsum dolor sit amit</span><small class="date d-block">7:40am</small></div></a><a href="#" class="message d-flex align-items-center">
                      <div class="profile"><img src="admincss/img/avatar-1.jpg" alt="..." class="img-fluid">
                        <div class="status busy"></div>
                      </div>
                      <div class="content">   <strong class="d-block">Sam Kaheil</strong><span class="d-block">lorem ipsum dolor sit amit</span><small class="date d-block">6:55am</small></div></a><a href="#" class="message d-flex align-items-center">
                      <div class="profile"><img src="admincss/img/avatar-5.jpg" alt="..." class="img-fluid">
                        <div class="status offline"></div>
                      </div>
                      <div class="content">   <strong class="d-block">Sara Wood</strong><span class="d-block">lorem ipsum dolor sit amit</span><small class="date d-block">10:30pm</small></div></a><a href="#" class="message d-flex align-items-center">
                      <div class="profile"><img src="admincss/img/avatar-1.jpg" alt="..." class="img-fluid">
                        <div class="status online"></div>
                      </div>
                      <div class="content">   <strong class="d-block">Nader Magdy</strong><span class="d-block">lorem ipsum dolor sit amit</span><small class="date d-block">9:47pm</small></div></a></div>
                </div>
              </div>
            </div>
          </div>
        </section> -->
        <!-- <section>
          <div class="container-fluid">
            <div class="row">
              <div class="col-lg-4">
                <div class="stats-with-chart-2 block">
                  <div class="title"><strong class="d-block">Credit Sales</strong><span class="d-block">Lorem ipsum dolor sit</span></div>
                  <div class="piechart chart">
                    <canvas id="pieChartHome1"></canvas>
                    <div class="text"><strong class="d-block">$2.145</strong><span class="d-block">Sales</span></div>
                  </div>
                </div>
              </div>
              <div class="col-lg-4">
                <div class="stats-with-chart-2 block">
                  <div class="title"><strong class="d-block">Channel Sales</strong><span class="d-block">Lorem ipsum dolor sit</span></div>
                  <div class="piechart chart">
                    <canvas id="pieChartHome2"></canvas>
                    <div class="text"><strong class="d-block">$7.784</strong><span class="d-block">Sales</span></div>
                  </div>
                </div>
              </div>
              <div class="col-lg-4">
                <div class="stats-with-chart-2 block">
                  <div class="title"><strong class="d-block">Direct Sales</strong><span class="d-block">Lorem ipsum dolor sit</span></div>
                  <div class="piechart chart">
                    <canvas id="pieChartHome3"></canvas>
                    <div class="text"><strong class="d-block">$4.957</strong><span class="d-block">Sales</span></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section -->