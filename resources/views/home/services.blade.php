<div class="posts_section layout_padding">
    <div class="container">
        <h1 class="services_taital">Latest Posts</h1>
        <p class="services_text">Discover our latest blog posts and articles</p>
        @if(isset($posts) && $posts->count() > 0)
            <div class="posts_section_2">
                <div class="row">
                    @foreach($posts as $post)
                        <div class="col-md-4 mb-4">
                            <div class="post_card">
                                @if($post->image)
                                    <div class="post_image">
                                        <img src="{{ asset('postimage/' . $post->image) }}" class="services_img" alt="{{ $post->title }}">
                                    </div>
                                @endif
                                <div class="post_content">
                                    <h4 class="post_title">{{ \Illuminate\Support\Str::limit($post->title, 50) }}</h4>
                                    <p class="post_description">{{ \Illuminate\Support\Str::limit($post->description, 100) }}</p>
                                    <p class="post_author">By: {{ $post->name }}</p>
                                    
                                    @if($post->category)
                                        <p class="post_category">
                                            <i class="fa fa-folder" style="margin-right: 5px; color: #007bff;"></i>
                                            <span style="color: #007bff; font-weight: 600;">{{ $post->category->name }}</span>
                                        </p>
                                    @endif
                                    
                                    @if($post->tags->count() > 0)
                                        <div class="post_tags" style="margin-bottom: 15px;">
                                            @foreach($post->tags->take(3) as $tag)
                                                <span class="tag_badge" style="background-color: {{ $tag->color }}; color: #fff; padding: 2px 6px; border-radius: 8px; font-size: 10px; margin-right: 4px; display: inline-block;">
                                                    {{ $tag->name }}
                                                </span>
                                            @endforeach
                                            @if($post->tags->count() > 3)
                                                <span style="font-size: 10px; color: #666;">+{{ $post->tags->count() - 3 }} more</span>
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
        @else
            <div class="no_posts_message">
                <p>No posts available at the moment. Check back later!</p>
            </div>
        @endif
    </div>
</div>

<style>
    .post_card {
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        margin-bottom: 30px;
        overflow: hidden;
        transition: transform 0.3s ease;
        height: 100%;
    }
    
    .post_card:hover {
        transform: translateY(-5px);
    }
    
    .post_image {
        height: 200px;
        overflow: hidden;
    }
    
    .post_image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .post_content {
        padding: 20px;
        display: flex;
        flex-direction: column;
        height: calc(100% - 200px);
    }
    
    .post_title {
        font-size: 18px;
        font-weight: bold;
        margin-bottom: 10px;
        color: #333;
    }
    
    .post_description {
        color: #666;
        margin-bottom: 10px;
        line-height: 1.5;
        flex-grow: 1;
    }
    
    .post_author {
        color: #999;
        font-size: 14px;
        margin-bottom: 15px;
    }
    
    .no_posts_message {
        text-align: center;
        padding: 50px 0;
        color: #666;
    }

    /* Ensure Bootstrap classes work properly for posts grid */
    .posts_section_2 .row {
        margin: 0 -15px;
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