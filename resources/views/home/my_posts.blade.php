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
              <h1 class="services_taital">My Posts</h1>
              <p class="services_text">Manage and view all your blog posts</p>
              
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
                                          <div class="post_meta">
                                              <p class="post_date">{{ $post->created_at->format('M d, Y') }}</p>
                                              <div class="post_status">
                                                  <span class="status_badge status_{{ $post->post_status }}">
                                                      {{ ucfirst($post->post_status) }}
                                                  </span>
                                              </div>
                                          </div>
                                          @if($post->post_status == 'rejected' && $post->rejection_reason)
                                              <div class="rejection_reason">
                                                  <strong>Rejection Reason:</strong>
                                                  <p>{{ $post->rejection_reason }}</p>
                                              </div>
                                          @endif
                                          <div class="post_actions">
                                              @if($post->post_status == 'active')
                                                  <a href="{{ route('home.post_details', $post->id) }}" class="btn btn-primary">View Post</a>
                                              @else
                                                  <span class="btn btn-secondary disabled">{{ ucfirst($post->post_status) }}</span>
                                              @endif
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
                      <p>You haven't created any posts yet.</p>
                      @if(Auth::user()->usertype == 'admin')
                          <a href="{{ route('admin.post_page') }}" class="btn btn-primary">Create Your First Post</a>
                      @else
                          <a href="{{ route('home.create_post') }}" class="btn btn-primary">Create Your First Post</a>
                      @endif
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
              margin-bottom: 15px;
              line-height: 1.5;
              flex-grow: 1;
          }
          
          .post_meta {
              display: flex;
              justify-content: space-between;
              align-items: center;
              margin-bottom: 15px;
          }
          
          .post_date {
              color: #999;
              font-size: 12px;
              margin: 0;
          }
          
          .status_badge {
              padding: 4px 8px;
              border-radius: 12px;
              font-size: 11px;
              font-weight: 600;
              text-transform: uppercase;
          }
          
          .status_active {
              background: #28a745;
              color: white;
          }
          
          .status_pending {
              background: #ffc107;
              color: #212529;
          }
          
          .status_rejected {
              background: #dc3545;
              color: white;
          }
          
          .post_actions {
              margin-top: auto;
          }
          
          .btn {
              padding: 8px 16px;
              border: none;
              border-radius: 4px;
              text-decoration: none;
              display: inline-block;
              font-size: 14px;
              cursor: pointer;
              transition: all 0.3s ease;
          }
          
          .btn-primary {
              background: #007bff;
              color: white;
          }
          
          .btn-primary:hover {
              background: #0056b3;
              color: white;
              text-decoration: none;
          }
          
          .btn-secondary {
              background: #6c757d;
              color: white;
          }
          
          .btn.disabled {
              opacity: 0.6;
              cursor: not-allowed;
          }
          
          .no_posts_message {
              text-align: center;
              padding: 50px 0;
              color: #666;
          }
          
          .no_posts_message p {
              font-size: 18px;
              margin-bottom: 20px;
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
          
          .rejection_reason {
              background: #f8d7da;
              border: 1px solid #f5c6cb;
              color: #721c24;
              padding: 10px;
              border-radius: 4px;
              margin-bottom: 15px;
              font-size: 13px;
          }
          
          .rejection_reason strong {
              display: block;
              margin-bottom: 5px;
              font-weight: 600;
          }
          
          .rejection_reason p {
              margin: 0;
              line-height: 1.4;
          }
      </style>
   </body>
</html>
