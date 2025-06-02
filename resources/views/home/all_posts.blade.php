<!DOCTYPE html>
<html lang="en">
   <head>
      @include('home.homecss')
       </head>
   <body>
      <!-- header section start -->
      <div class="header_section">
         @include('home.header')
      </div>
      <!-- header section end -->
      
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
                                          <p class="post_date">{{ $post->created_at->format('M d, Y') }}</p>
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
