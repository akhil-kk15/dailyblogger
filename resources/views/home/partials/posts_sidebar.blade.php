<div class="posts_sidebar">
    <!-- Latest Posts Widget -->
    <div class="sidebar_widget">
        <div class="widget_header">
            <h3 class="widget_title">
                <i class="fa fa-clock-o"></i>
                Latest Posts
            </h3>
        </div>
        <div class="widget_content">
            @php
                $latestPosts = \App\Models\Posts::where('post_status', 'active')
                    ->fromNonBlockedUsers()
                    ->orderBy('created_at', 'desc')
                    ->take(5)
                    ->get();
            @endphp
            
            @if($latestPosts->count() > 0)
                @foreach($latestPosts as $latestPost)
                    <div class="sidebar_post_item">
                        @if($latestPost->image)
                            <div class="sidebar_post_image">
                                <img src="{{ asset('postimage/' . $latestPost->image) }}" alt="{{ $latestPost->title }}">
                            </div>
                        @endif
                        <div class="sidebar_post_content">
                            <h5 class="sidebar_post_title">
                                <a href="{{ route('home.post_details', $latestPost->id) }}">
                                    {{ \Illuminate\Support\Str::limit($latestPost->title, 60) }}
                                </a>
                            </h5>
                            <div class="sidebar_post_meta">
                                <span class="sidebar_post_date">
                                    <i class="fa fa-calendar"></i>
                                    {{ $latestPost->created_at->format('M d, Y') }}
                                </span>
                                <span class="sidebar_post_author">
                                    <i class="fa fa-user"></i>
                                    {{ $latestPost->name }}
                                </span>
                            </div>
                            @if($latestPost->category)
                                <div class="sidebar_post_category">
                                    <i class="fa fa-folder"></i>
                                    {{ $latestPost->category->name }}
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
                <div class="widget_footer">
                    <a href="{{ route('home.posts') }}" class="view_all_btn">
                        <i class="fa fa-arrow-right"></i>
                        View All Posts
                    </a>
                </div>
            @else
                <div class="no_posts_message">
                    <i class="fa fa-info-circle"></i>
                    <p>No posts available yet.</p>
                </div>
            @endif
        </div>
    </div>

    @auth
    <!-- Unseen Posts Widget (Only for logged-in users) -->
    <div class="sidebar_widget">
        <div class="widget_header">
            <h3 class="widget_title">
                <i class="fa fa-eye-slash"></i>
                Catch Up
                <small>Posts you might have missed</small>
            </h3>
        </div>
        <div class="widget_content">
            @php
                // Get posts that the user hasn't viewed yet
                // We'll assume posts created in the last 7 days that user hasn't clicked on
                // Ordered by oldest first (ascending) so users see older posts they might have missed
                $unseenPosts = \App\Models\Posts::where('post_status', 'active')
                    ->fromNonBlockedUsers()
                    ->where('created_at', '>=', now()->subDays(7))
                    ->where('user_id', '!=', Auth::id()) // Exclude user's own posts
                    ->orderBy('created_at', 'asc') // Show oldest posts first for catch-up
                    ->take(4)
                    ->get();
            @endphp
            
            @if($unseenPosts->count() > 0)
                @foreach($unseenPosts as $unseenPost)
                    <div class="sidebar_post_item unseen_post">
                        @if($unseenPost->image)
                            <div class="sidebar_post_image">
                                <img src="{{ asset('postimage/' . $unseenPost->image) }}" alt="{{ $unseenPost->title }}">
                                <div class="new_badge">NEW</div>
                            </div>
                        @endif
                        <div class="sidebar_post_content">
                            <h5 class="sidebar_post_title">
                                <a href="{{ route('home.post_details', $unseenPost->id) }}">
                                    {{ \Illuminate\Support\Str::limit($unseenPost->title, 50) }}
                                </a>
                            </h5>
                            <div class="sidebar_post_meta">
                                <span class="sidebar_post_date">
                                    <i class="fa fa-clock-o"></i>
                                    {{ $unseenPost->created_at->diffForHumans() }}
                                </span>
                                @if($unseenPost->usertype === 'admin')
                                    <span class="admin_post_badge">
                                        <i class="fa fa-star"></i>
                                        Admin
                                    </span>
                                @endif
                            </div>
                            <p class="sidebar_post_excerpt">
                                {{ \Illuminate\Support\Str::limit($unseenPost->description, 80) }}
                            </p>
                        </div>
                    </div>
                @endforeach
                <div class="widget_footer">
                    <a href="{{ route('home.posts') }}?filter=recent" class="view_all_btn catch_up_btn">
                        <i class="fa fa-refresh"></i>
                        See All Recent Posts
                    </a>
                </div>
            @else
                <div class="no_posts_message">
                    <i class="fa fa-check-circle"></i>
                    <p>You're all caught up! 🎉</p>
                    <small>No new posts in the last 7 days.</small>
                </div>
            @endif
        </div>
    </div>
    @endauth
</div>

<style>
/* Posts Sidebar Styles with Padding */
.posts_sidebar {
    padding-left: 10px; /* Add left padding for breathing room */
    padding-right: 20px; /* Add right padding so it's not flush to screen edge */
}

.sidebar_widget {
    background: #ffffff;
    border-radius: 12px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    margin-bottom: 25px;
    overflow: hidden;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.sidebar_widget:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
}

.widget_header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 15px 20px;
    position: relative;
}

.widget_title {
    margin: 0;
    font-size: 16px;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 8px;
}

.widget_title small {
    display: block;
    font-size: 12px;
    opacity: 0.9;
    font-weight: 400;
    margin-top: 2px;
}

.widget_content {
    padding: 20px;
}

/* Sidebar Post Items */
.sidebar_post_item {
    display: flex;
    gap: 12px;
    padding: 15px 0;
    border-bottom: 1px solid #f0f0f0;
    transition: all 0.3s ease;
}

.sidebar_post_item:last-child {
    border-bottom: none;
    padding-bottom: 0;
}

.sidebar_post_item:hover {
    background: #f8f9fa;
    margin: 0 -15px;
    padding-left: 15px;
    padding-right: 15px;
    border-radius: 8px;
}

.sidebar_post_image {
    flex-shrink: 0;
    width: 70px;
    height: 70px;
    border-radius: 8px;
    overflow: hidden;
    position: relative;
}

.sidebar_post_image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.sidebar_post_item:hover .sidebar_post_image img {
    transform: scale(1.05);
}

.new_badge {
    position: absolute;
    top: -2px;
    right: -2px;
    background: #ff4757;
    color: white;
    font-size: 8px;
    padding: 2px 5px;
    border-radius: 10px;
    font-weight: bold;
}

.sidebar_post_content {
    flex: 1;
    min-width: 0;
}

.sidebar_post_title {
    margin: 0 0 8px 0;
    font-size: 14px;
    line-height: 1.4;
}

.sidebar_post_title a {
    color: #333;
    text-decoration: none;
    transition: color 0.3s ease;
}

.sidebar_post_title a:hover {
    color: #667eea;
}

.sidebar_post_meta {
    display: flex;
    flex-direction: column;
    gap: 4px;
    margin-bottom: 8px;
}

.sidebar_post_date,
.sidebar_post_author {
    font-size: 11px;
    color: #666;
    display: flex;
    align-items: center;
    gap: 4px;
}

.sidebar_post_category {
    font-size: 10px;
    color: #667eea;
    display: flex;
    align-items: center;
    gap: 4px;
    font-weight: 500;
}

.sidebar_post_excerpt {
    font-size: 12px;
    color: #777;
    line-height: 1.4;
    margin: 0;
}

.admin_post_badge {
    background: #dc3545;
    color: white;
    font-size: 9px;
    padding: 2px 5px;
    border-radius: 8px;
    font-weight: bold;
    display: inline-flex;
    align-items: center;
    gap: 2px;
}

/* Unseen Posts Specific Styles */
.unseen_post {
    background: linear-gradient(90deg, rgba(102, 126, 234, 0.03) 0%, transparent 100%);
    border-left: 3px solid #667eea;
    padding-left: 12px;
    margin-left: -15px;
    margin-right: -15px;
}

.unseen_post:hover {
    background: linear-gradient(90deg, rgba(102, 126, 234, 0.08) 0%, transparent 100%);
}

/* Widget Footer */
.widget_footer {
    padding: 15px 20px;
    background: #f8f9fa;
    border-top: 1px solid #eee;
}

.view_all_btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    color: #667eea;
    text-decoration: none;
    font-weight: 500;
    font-size: 14px;
    transition: all 0.3s ease;
}

.view_all_btn:hover {
    color: #764ba2;
    transform: translateX(2px);
}

.catch_up_btn {
    color: #28a745;
}

.catch_up_btn:hover {
    color: #218838;
}

/* Categories List */
.categories_list {
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.category_item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 8px 12px;
    background: #f8f9fa;
    border-radius: 6px;
    text-decoration: none;
    color: #333;
    transition: all 0.3s ease;
}

.category_item:hover {
    background: #667eea;
    color: white;
    transform: translateX(3px);
}

.category_name {
    font-size: 13px;
    font-weight: 500;
}

.category_count {
    font-size: 11px;
    background: rgba(0,0,0,0.1);
    padding: 2px 6px;
    border-radius: 10px;
    min-width: 20px;
    text-align: center;
}

.category_item:hover .category_count {
    background: rgba(255,255,255,0.2);
}

/* Stats Widget */
.stats_widget .widget_content {
    padding: 20px;
}

.stats_grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 15px;
}

.stat_item {
    text-align: center;
    padding: 15px 10px;
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    border-radius: 8px;
    transition: transform 0.3s ease;
}

.stat_item:hover {
    transform: translateY(-2px);
}

.stat_number {
    font-size: 24px;
    font-weight: bold;
    color: #667eea;
    margin-bottom: 5px;
}

.stat_label {
    font-size: 11px;
    color: #666;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

/* No Posts Message */
.no_posts_message {
    text-align: center;
    padding: 30px 20px;
    color: #666;
}

.no_posts_message i {
    font-size: 32px;
    margin-bottom: 10px;
    color: #ddd;
}

.no_posts_message p {
    margin: 10px 0 5px 0;
    font-weight: 500;
}

.no_posts_message small {
    color: #999;
    font-size: 12px;
}

/* Responsive Design */
@media (max-width: 991px) {
    .posts_sidebar {
        padding-left: 0;
        margin-top: 40px;
    }
    
    .sidebar_widget {
        margin-bottom: 20px;
    }
    
    .stats_grid {
        grid-template-columns: repeat(4, 1fr);
        gap: 10px;
    }
    
    .stat_item {
        padding: 10px 5px;
    }
    
    .stat_number {
        font-size: 18px;
    }
    
    .stat_label {
        font-size: 10px;
    }
}

@media (max-width: 576px) {
    .sidebar_post_item {
        flex-direction: column;
        gap: 8px;
    }
    
    .sidebar_post_image {
        width: 100%;
        height: 150px;
    }
    
    .stats_grid {
        grid-template-columns: 1fr 1fr;
        gap: 15px;
    }
}

/* Dark mode support */
body.dark-mode .sidebar_widget {
    background: #2d2d2d;
    color: #e1e1e1;
}

body.dark-mode .sidebar_post_title a {
    color: #e1e1e1;
}

body.dark-mode .sidebar_post_title a:hover {
    color: #87ceeb;
}

body.dark-mode .sidebar_post_item:hover {
    background: #3a3a3a;
}

body.dark-mode .category_item {
    background: #3a3a3a;
    color: #e1e1e1;
}

body.dark-mode .category_item:hover {
    background: #667eea;
}

body.dark-mode .stat_item {
    background: linear-gradient(135deg, #3a3a3a 0%, #4a4a4a 100%);
}

body.dark-mode .widget_footer {
    background: #3a3a3a;
    border-color: #555;
}
</style>
