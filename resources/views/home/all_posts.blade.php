<!DOCTYPE html>
<html lang="en">
   <head>
      @include('home.homecss')
       </head>
   <body>
      <!-- header           .post_author, .post_date {
              color: #666;
              font-size: 14px;
              margin-bottom: 10px;
          }
          
          .post_meta {
              display: flex;
              justify-content: space-between;
              align-items: center;
              margin-bottom: 15px;
          }
          
          .post_meta p {
              margin: 0;
          }
          
          .post_comments {
              color: #007bff;
              font-size: 12px;
              font-weight: 600;
          }
          
          .no_posts_message {
              text-align: center;
              padding: 50px 0;
              color: #666;
          }rt -->
      <div class="header_section">
         @include('home.header')
      </div>
      <!-- header section end -->
      
      <!-- announcements section start -->
      @if(isset($announcements) && $announcements->count() > 0)
      <div class="announcements_section" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 40px 0; margin-bottom: 30px;">
          <div class="container">
              <h2 style="color: #fff; text-align: center; margin-bottom: 30px; font-size: 28px; font-weight: 600;">
                  <i class="fa fa-bullhorn" style="margin-right: 10px;"></i>Latest Announcements
              </h2>
              <div class="row">
                  @foreach($announcements as $announcement)
                      <div class="col-md-6 col-lg-4 mb-4">
                          <div class="announcement_card priority-{{ $announcement->priority }}" style="background: #fff; border-radius: 12px; padding: 20px; box-shadow: 0 8px 25px rgba(0,0,0,0.1); transition: all 0.3s ease; border-left: 5px solid {{ $announcement->priority_color }};">
                              <div class="announcement_header" style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 15px;">
                                  <span class="type_badge" style="background: {{ $announcement->type_color }}; color: #fff; padding: 4px 8px; border-radius: 12px; font-size: 11px; font-weight: 600; text-transform: uppercase;">
                                      {{ $announcement->type }}
                                  </span>
                                  <span class="priority_badge" style="background: {{ $announcement->priority_color }}; color: #fff; padding: 4px 8px; border-radius: 12px; font-size: 11px; font-weight: 600; text-transform: uppercase;">
                                      {{ $announcement->priority }}
                                  </span>
                              </div>
                              <h4 style="color: #333; font-size: 16px; font-weight: 600; margin-bottom: 10px; line-height: 1.4;">{{ $announcement->title }}</h4>
                              <p style="color: #666; font-size: 14px; line-height: 1.6; margin-bottom: 15px;">{{ Str::limit($announcement->content, 120) }}</p>
                              <div class="announcement_meta" style="display: flex; justify-content: space-between; align-items: center; font-size: 12px; color: #999;">
                                  <span><i class="fa fa-user" style="margin-right: 5px;"></i>{{ $announcement->creator->name }}</span>
                                  <span><i class="fa fa-calendar" style="margin-right: 5px;"></i>{{ $announcement->created_at->format('M d, Y') }}</span>
                              </div>
                              @if($announcement->expires_at)
                                  <div class="expiry_info" style="margin-top: 10px; padding: 8px; background: #f8f9fa; border-radius: 6px; font-size: 12px; color: #666;">
                                      <i class="fa fa-clock-o" style="margin-right: 5px;"></i>Expires: {{ $announcement->expires_at->format('M d, Y') }}
                                  </div>
                              @endif
                          </div>
                      </div>
                  @endforeach
              </div>
          </div>
      </div>
      @endif
      <!-- announcements section end -->

      <!-- posts section start -->
      <div class="posts_section layout_padding">
          <div class="container">
              <h1 class="services_taital">All Posts</h1>
              <p class="services_text">Browse through all our blog posts and articles</p>
              
              @if($posts->count() > 0)
                  <div class="posts_section_2">
                      <div class="row">
                          @foreach($posts as $post)
                              <div class="col-md-4 col-sm-6 mb-4">
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
                                          
                                          <div class="post_meta">
                                              <p class="post_date">{{ $post->created_at->format('M d, Y') }}</p>
                                              <p class="post_comments">{{ $post->comments_count }} {{ $post->comments_count == 1 ? 'comment' : 'comments' }}</p>
                                          </div>
                                          <div class="btn_main">
                                              <a href="{{ route('home.post_details', $post->id) }}">Check Post</a>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          @endforeach
                      </div>
                      
                      <!-- Pagination -->
                      <div class="pagination_wrapper">
                          {{ $posts->links() }}
                      </div>
                  </div>
              @else
                  <div class="no_posts_message">
                      <p>No posts available at the moment. Check back later!</p>
                  </div>
              @endif
          </div>
      </div>
      <!-- posts section end -->
      
      <!-- footer section start -->
      @include('home.footer')
      <!-- footer section end -->
      
      <style>
          .announcement_card:hover {
              transform: translateY(-5px);
              box-shadow: 0 12px 35px rgba(0,0,0,0.15) !important;
          }
          
          .announcement_card.priority-urgent {
              animation: pulse 2s infinite;
          }
          
          @keyframes pulse {
              0% { box-shadow: 0 8px 25px rgba(0,0,0,0.1); }
              50% { box-shadow: 0 8px 25px rgba(220, 53, 69, 0.3); }
              100% { box-shadow: 0 8px 25px rgba(0,0,0,0.1); }
          }

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
              margin-bottom: 5px;
          }
          
          .post_date {
              color: #999;
              font-size: 12px;
              margin-bottom: 15px;
          }
          
          .no_posts_message {
              text-align: center;
              padding: 50px 0;
              color: #666;
          }
          
          .pagination_wrapper {
              display: flex;
              justify-content: center;
              margin-top: 40px;
          }
          
          .pagination_wrapper .pagination {
              display: flex;
              list-style: none;
              padding: 0;
          }
          
          .pagination_wrapper .pagination li {
              margin: 0 5px;
          }
          
          .pagination_wrapper .pagination li a {
              display: block;
              padding: 8px 12px;
              background: #f8f9fa;
              color: #007bff;
              text-decoration: none;
              border-radius: 4px;
          }
          
          .pagination_wrapper .pagination li.active a {
              background: #007bff;
              color: white;
          }
      </style>
   </body>
</html>
