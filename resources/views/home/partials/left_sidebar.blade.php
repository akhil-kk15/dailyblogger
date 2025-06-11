<!-- Left Sidebar - Categories and Stats -->
<div class="left_sidebar_container">
    <!-- Popular Categories Widget -->
    <div class="sidebar_widget">
        <div class="widget_header">
            <h3 class="widget_title">
                <i class="fa fa-tags"></i>
                Popular Categories
            </h3>
        </div>
        <div class="widget_content">
            @php
                $popularCategories = \App\Models\Category::withCount(['posts' => function($query) {
                    $query->where('post_status', 'active');
                }])
                ->having('posts_count', '>', 0)
                ->orderBy('posts_count', 'desc')
                ->take(6)
                ->get();
            @endphp
            
            @if($popularCategories->count() > 0)
                <div class="categories_list">
                    @foreach($popularCategories as $category)
                        <a href="{{ route('home.posts') }}?category={{ $category->id }}" class="category_item">
                            <span class="category_name">{{ $category->name }}</span>
                            <span class="category_count">{{ $category->posts_count }}</span>
                        </a>
                    @endforeach
                </div>
            @else
                <div class="no_posts_message">
                    <i class="fa fa-info-circle"></i>
                    <p>No categories available yet.</p>
                </div>
            @endif
        </div>
    </div>

    <!-- My Stats Widget -->
    <div class="sidebar_widget stats_widget">
        <div class="widget_header">
            <h3 class="widget_title">
                <i class="fa fa-user"></i>
                My Stats
            </h3>
        </div>
        <div class="widget_content">
            @if(Auth::check())
                @php
                    $myPosts = \App\Models\Posts::where('user_id', Auth::id())->count();
                    $myActivePosts = \App\Models\Posts::where('user_id', Auth::id())
                        ->where('post_status', 'active')->count();
                    $myComments = \App\Models\Comment::where('user_id', Auth::id())->count();
                    $memberSince = Auth::user()->created_at->diffForHumans();
                @endphp
                
                <div class="stats_grid">
                    <div class="stat_item">
                        <div class="stat_icon">
                            <i class="fa fa-file-text"></i>
                        </div>
                        <div class="stat_details">
                            <span class="stat_number">{{ $myPosts }}</span>
                            <span class="stat_label">My Posts</span>
                        </div>
                    </div>
                    
                    <div class="stat_item">
                        <div class="stat_icon">
                            <i class="fa fa-check-circle"></i>
                        </div>
                        <div class="stat_details">
                            <span class="stat_number">{{ $myActivePosts }}</span>
                            <span class="stat_label">Published</span>
                        </div>
                    </div>
                    
                    <div class="stat_item">
                        <div class="stat_icon">
                            <i class="fa fa-comments"></i>
                        </div>
                        <div class="stat_details">
                            <span class="stat_number">{{ $myComments }}</span>
                            <span class="stat_label">My Comments</span>
                        </div>
                    </div>
                    
                    <div class="stat_item">
                        <div class="stat_icon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <div class="stat_details">
                            <span class="stat_number">{{ $memberSince }}</span>
                            <span class="stat_label">Member Since</span>
                        </div>
                    </div>
                </div>
            @else
                <div class="no_posts_message">
                    <i class="fa fa-info-circle"></i>
                    <p><a href="{{ route('login') }}">Login</a> to see your stats.</p>
                </div>
            @endif
        </div>
    </div>
</div>

<style>
    /* Left Sidebar Styling with Padding */
    .left_sidebar_container {
        background: transparent;
        padding-left: 20px; /* Add left padding so it's not flush to screen edge */
        padding-right: 10px; /* Add right padding for breathing room */
    }
    
    .sidebar_widget {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        margin-bottom: 25px;
        overflow: hidden;
        transition: all 0.3s ease;
        border: 1px solid rgba(0,0,0,0.05);
    }
    
    .sidebar_widget:hover {
        box-shadow: 0 6px 25px rgba(0,0,0,0.12);
        transform: translateY(-2px);
    }
    
    .widget_header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        padding: 18px 20px;
        border-bottom: none;
    }
    
    .widget_title {
        color: #fff;
        font-size: 16px;
        font-weight: 600;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .widget_title i {
        font-size: 18px;
        opacity: 0.9;
    }
    
    .widget_content {
        padding: 20px;
    }
    
    /* Categories List Styling */
    .categories_list {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }
    
    .category_item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 12px 15px;
        background: #f8f9fa;
        border-radius: 8px;
        text-decoration: none;
        color: #333;
        transition: all 0.3s ease;
        border: 1px solid transparent;
    }
    
    .category_item:hover {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: #fff;
        text-decoration: none;
        transform: translateX(5px);
        border-color: rgba(102, 126, 234, 0.2);
    }
    
    .category_name {
        font-weight: 500;
        font-size: 14px;
    }
    
    .category_count {
        background: #fff;
        color: #667eea;
        padding: 4px 8px;
        border-radius: 12px;
        font-size: 12px;
        font-weight: 600;
        min-width: 25px;
        text-align: center;
        transition: all 0.3s ease;
    }
    
    .category_item:hover .category_count {
        background: rgba(255,255,255,0.9);
        color: #667eea;
    }
    
    /* Stats Grid Styling */
    .stats_grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 15px;
    }
    
    .stat_item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 15px;
        background: #f8f9fa;
        border-radius: 10px;
        transition: all 0.3s ease;
        border: 1px solid rgba(0,0,0,0.05);
    }
    
    .stat_item:hover {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: #fff;
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
    }
    
    .stat_icon {
        width: 40px;
        height: 40px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        transition: all 0.3s ease;
    }
    
    .stat_item:hover .stat_icon {
        background: rgba(255,255,255,0.2);
    }
    
    .stat_icon i {
        font-size: 16px;
        color: #fff;
    }
    
    .stat_details {
        display: flex;
        flex-direction: column;
        min-width: 0;
    }
    
    .stat_number {
        font-size: 18px;
        font-weight: 700;
        color: #333;
        line-height: 1;
        transition: color 0.3s ease;
    }
    
    .stat_item:hover .stat_number {
        color: #fff;
    }
    
    .stat_label {
        font-size: 11px;
        color: #666;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-top: 2px;
        transition: color 0.3s ease;
    }
    
    .stat_item:hover .stat_label {
        color: rgba(255,255,255,0.8);
    }
    
    /* No posts message styling */
    .no_posts_message {
        text-align: center;
        padding: 30px 20px;
        color: #666;
    }
    
    .no_posts_message i {
        font-size: 24px;
        color: #ddd;
        margin-bottom: 10px;
        display: block;
    }
    
    .no_posts_message p {
        margin: 0;
        font-size: 14px;
    }
    
    /* Dark mode support */
    body.dark-mode .sidebar_widget {
        background: #2d2d2d;
        border-color: rgba(255,255,255,0.1);
    }
    
    body.dark-mode .category_item {
        background: #3d3d3d;
        color: #e1e1e1;
    }
    
    body.dark-mode .stat_item {
        background: #3d3d3d;
        border-color: rgba(255,255,255,0.1);
    }
    
    body.dark-mode .stat_number {
        color: #e1e1e1;
    }
    
    body.dark-mode .stat_label {
        color: #b0b0b0;
    }
    
    /* Responsive Design */
    @media (max-width: 992px) {
        .stats_grid {
            grid-template-columns: 1fr;
            gap: 10px;
        }
        
        .stat_item {
            padding: 12px;
        }
        
        .stat_icon {
            width: 35px;
            height: 35px;
        }
        
        .stat_icon i {
            font-size: 14px;
        }
        
        .stat_number {
            font-size: 16px;
        }
    }
    
    @media (max-width: 768px) {
        .left_sidebar_container {
            margin-top: 30px;
        }
        
        .sidebar_widget {
            margin-bottom: 20px;
        }
        
        .widget_content {
            padding: 15px;
        }
        
        .stats_grid {
            grid-template-columns: 1fr 1fr;
            gap: 8px;
        }
        
        .stat_item {
            padding: 10px;
            flex-direction: column;
            text-align: center;
            gap: 8px;
        }
        
        .stat_details {
            align-items: center;
        }
    }
</style>
