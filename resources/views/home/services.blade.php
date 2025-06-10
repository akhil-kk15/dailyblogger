<div class="posts_section layout_padding">
    <div class="container">
        <h1 class="services_taital">Latest Posts</h1>
        <p class="services_text">Discover our latest blog posts and articles</p>
        @if(isset($posts) && $posts->count() > 0)
            <div class="posts_section_2">
                <div class="row">
                    <!-- Left Sidebar - Categories and Stats -->
                    <div class="col-lg-3 col-md-12 order-lg-1 order-3">
                        @include('home.partials.left_sidebar')
                    </div>
                    
                    <!-- Main Content Area (Center) - 6 columns for posts -->
                    <div class="col-lg-6 col-md-12 order-lg-2 order-1">
                        <div class="row">
                            @foreach($posts as $post)
                                <!-- 3 columns layout: col-lg-4 gives us 3 posts per row within the 6-column container -->
                                <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                                    <div class="post_card">
                                        @if($post->image)
                                            <div class="post_image">
                                                <img src="{{ asset('postimage/' . $post->image) }}" class="services_img" alt="{{ $post->title }}">
                                            </div>
                                        @endif                        <div class="post_content">
                            <h4 class="post_title">{{ \Illuminate\Support\Str::limit($post->title, 40) }}</h4>
                            <p class="post_description">{{ \Illuminate\Support\Str::limit($post->description, 70) }}</p>
                            <p class="post_author">By: {{ $post->name }}</p>
                                            
                                            @if($post->category)
                                                <p class="post_category">
                                                    <i class="fa fa-folder category_icon"></i>
                                                    <span class="category_text">{{ $post->category->name }}</span>
                                                </p>
                                            @endif
                                            
                                            @if($post->tags->count() > 0)
                                                <div class="post_tags" style="margin-bottom: 15px;">
                                                    @foreach($post->tags->take(2) as $tag)
                                                        <span class="tag_badge" style="background-color: {{ $tag->color }}; color: #fff; padding: 2px 6px; border-radius: 8px; font-size: 10px; margin-right: 4px; display: inline-block;">
                                                            {{ $tag->name }}
                                                        </span>
                                                    @endforeach
                                                    @if($post->tags->count() > 2)
                                                        <span style="font-size: 10px; color: #666;">+{{ $post->tags->count() - 2 }} more</span>
                                                    @endif
                                                </div>
                                            @endif
                                            
                                            <div class="btn_main">
                                                <a href="{{ route('home.post_details', $post->id) }}">Read More</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="text-center mt-4">
                            <a href="{{ route('home.posts') }}" class="btn btn-primary">View All Posts</a>
                        </div>
                    </div>
                    
                    <!-- Right Sidebar - Latest Posts and Catch Up -->
                    <div class="col-lg-3 col-md-12 order-lg-3 order-2">
                        @include('home.partials.posts_sidebar')
                    </div>
                </div>
            </div>
        @else
            <div class="no_posts_message">
                <p>No posts available at the moment. Check back later!</p>
            </div>
        @endif
    </div>
</div>

<style>
    /* Three-Column Layout with Extended Spacing */
    .posts_section_2 .row {
        margin-left: -25px;
        margin-right: -25px;
    }
    
    .posts_section_2 [class*="col-"] {
        padding-left: 25px;
        padding-right: 25px;
    }
    
    /* Push sidebars to extreme edges */
    .posts_section_2 .col-lg-3:first-child {
        padding-left: 0; /* Left sidebar flush to edge */
    }
    
    .posts_section_2 .col-lg-3:last-child {
        padding-right: 0; /* Right sidebar flush to edge */
    }
    
    /* Main posts container adjustments for better spacing */
    .col-lg-6 .row {
        margin-left: -15px;
        margin-right: -15px;
    }
    
    .col-lg-6 [class*="col-"] {
        padding-left: 15px;
        padding-right: 15px;
    }
    
    /* Add breathing room to the center content */
    .col-lg-6 {
        padding-left: 40px !important;
        padding-right: 40px !important;
    }
    
    .post_card {
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        margin-bottom: 30px;
        overflow: hidden;
        transition: transform 0.3s ease;
        height: 400px; /* Increased height for better proportions */
        display: flex;
        flex-direction: column;
    }
    
    .post_card:hover {
        transform: translateY(-5px);
    }
    
    .post_image {
        height: 180px; /* Increased for better proportions */
        overflow: hidden;
        flex-shrink: 0;
    }
    
    .post_image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .post_content {
        padding: 18px; /* Increased padding for better readability */
        display: flex;
        flex-direction: column;
        flex-grow: 1;
    }
    
    .post_title {
        font-size: 16px; /* Slightly larger for better readability */
        font-weight: bold;
        margin-bottom: 10px;
        color: #333;
        line-height: 1.3;
    }
    
    .post_description {
        color: #666;
        margin-bottom: 10px;
        line-height: 1.4;
        font-size: 14px;
        flex-grow: 1;
    }
    
    .post_author {
        color: #999;
        font-size: 13px;
        margin-bottom: 15px;
    }
    
    .no_posts_message {
        text-align: center;
        padding: 50px 0;
        color: #666;
    }

    /* Sidebar positioning - with internal padding instead of edge flush */
    .col-lg-3.col-md-12 {
        padding-left: 15px;
        padding-right: 15px;
    }
    
    /* Remove the edge flush positioning since we're adding padding internally */
    .posts_section_2 .col-lg-3:nth-child(1) {
        padding-left: 15px; /* Reset to normal padding */
        padding-right: 25px; /* Keep extra spacing from center */
    }
    
    /* Right sidebar with normal padding */
    .posts_section_2 .col-lg-3:nth-child(3) {
        padding-left: 25px; /* Keep extra spacing from center */
        padding-right: 15px; /* Reset to normal padding */
    }
    
    /* Three-column responsive improvements */
    @media (max-width: 992px) {
        .post_card {
            height: auto; /* Allow flexible height on smaller screens */
        }
        
        .post_image {
            height: 200px; /* Restore larger image on tablet */
        }
        
        .post_content {
            padding: 20px; /* Restore larger padding on tablet */
        }
        
        .post_title {
            font-size: 18px; /* Larger title on tablet */
        }
        
        .post_description {
            font-size: 15px; /* Larger description on tablet */
        }
        
        /* Reset sidebar positioning on smaller screens */
        .posts_section_2 .col-lg-3:nth-child(1),
        .posts_section_2 .col-lg-3:nth-child(3) {
            padding-left: 15px;
            padding-right: 15px;
        }
        
        /* Reset center content padding on smaller screens */
        .col-lg-6 {
            padding-left: 15px !important;
            padding-right: 15px !important;
        }
        
        /* On tablet and mobile, stack sidebars below main content */
        .order-lg-1 { order: 2; } /* Left sidebar second */
        .order-lg-2 { order: 1; } /* Main content first */
        .order-lg-3 { order: 3; } /* Right sidebar third */
        
        .col-lg-3.col-md-12 {
            margin-top: 30px; /* Add top margin for sidebars on tablet/mobile */
        }
        
        .col-lg-6.col-md-12 {
            margin-top: 0; /* No top margin for main content */
        }
    }
    
    @media (max-width: 768px) {
        .post_content {
            padding: 20px; /* Restore larger padding on mobile */
        }
        
        .post_title {
            font-size: 18px; /* Larger title on mobile */
        }
        
        .post_description {
            font-size: 15px; /* Larger description on mobile */
        }
        
        .post_author {
            font-size: 14px;
        }
        
        /* On mobile, display posts in single column */
        .col-lg-6 .col-lg-4 {
            flex: 0 0 100%;
            max-width: 100%;
        }
    }

    /* Ensure Bootstrap classes work properly for posts grid */
    .posts_section_2 .row {
        margin: 0 -25px; /* Updated to match new padding */
    }
    
    /* Additional container spacing */
    .posts_section {
        padding-left: 0;
        padding-right: 0;
    }
    
    .posts_section .container {
        max-width: 100%;
        padding-left: 20px;
        padding-right: 20px;
    }
    
    .posts_section_2 .col-md-4 {
        padding: 0 15px;
    }
    
    /* Additional navbar styling to ensure it displays correctly */
    .header_section .navbar {
        background: transparent !important;
    }
    
    .header_section .navbar-nav .nav-link {
        color: #fff !important;
    }
    
    .header_section .menu_main ul li a {
        color: #fff;
        text-decoration: none;
        padding: 10px 15px;
        display: block;
        transition: all 0.3s ease;
    }
    
    .header_section .menu_main ul li a:hover {
        color: #f0f0f0;
    }
</style>