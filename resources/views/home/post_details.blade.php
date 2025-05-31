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
      
      <!-- post details section start -->
      <div class="post_details_section layout_padding">
          <div class="container">
              <div class="row">
                  <div class="col-md-8 offset-md-2">
                      <div class="post_details_card">
                          @if($post->image)
                              <div class="post_image_large">
                                  <img src="{{ asset('postimage/' . $post->image) }}" alt="{{ $post->title }}" class="img-fluid">
                              </div>
                          @endif
                          
                          <div class="post_details_content">
                              <h1 class="post_title_large">{{ $post->title }}</h1>
                              
                              <div class="post_meta">
                                  <span class="post_author">By: {{ $post->name }}</span>
                                  <span class="post_date">{{ $post->created_at->format('F d, Y') }}</span>
                                  @if($post->usertype)
                                      <span class="post_user_type">{{ ucfirst($post->usertype) }}</span>
                                  @endif
                              </div>
                              
                              <div class="post_description_full">
                                  {!! nl2br(e($post->description)) !!}
                              </div>
                              
                              <div class="post_actions">
                                  <a href="{{ route('home.posts') }}" class="btn btn-primary">← Back to All Posts</a>
                                  <a href="{{ route('home.homepage') }}" class="btn btn-secondary">← Back to Home</a>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <!-- post details section end -->
      
      <!-- footer section start -->
      @include('home.footer')
      <!-- footer section end -->
      
      <style>
          .post_details_card {
              background: #fff;
              border-radius: 8px;
              box-shadow: 0 2px 10px rgba(0,0,0,0.1);
              overflow: hidden;
              margin-bottom: 30px;
          }
          
          .post_image_large {
              width: 100%;
              max-height: 400px;
              overflow: hidden;
          }
          
          .post_image_large img {
              width: 100%;
              height: 100%;
              object-fit: cover;
          }
          
          .post_details_content {
              padding: 40px;
          }
          
          .post_title_large {
              font-size: 32px;
              font-weight: bold;
              margin-bottom: 20px;
              color: #333;
              line-height: 1.3;
          }
          
          .post_meta {
              display: flex;
              flex-wrap: wrap;
              gap: 20px;
              margin-bottom: 30px;
              padding-bottom: 20px;
              border-bottom: 1px solid #eee;
          }
          
          .post_author, .post_date, .post_user_type {
              color: #666;
              font-size: 14px;
          }
          
          .post_user_type {
              background: #007bff;
              color: white;
              padding: 2px 8px;
              border-radius: 12px;
              font-size: 12px;
          }
          
          .post_description_full {
              color: #444;
              line-height: 1.8;
              font-size: 16px;
              margin-bottom: 40px;
          }
          
          .post_actions {
              display: flex;
              gap: 15px;
              flex-wrap: wrap;
          }
          
          .post_actions .btn {
              padding: 10px 20px;
              text-decoration: none;
              border-radius: 5px;
              font-weight: bold;
              transition: all 0.3s ease;
          }
          
          .post_actions .btn-primary {
              background: #007bff;
              color: white;
          }
          
          .post_actions .btn-primary:hover {
              background: #0056b3;
          }
          
          .post_actions .btn-secondary {
              background: #6c757d;
              color: white;
          }
          
          .post_actions .btn-secondary:hover {
              background: #545b62;
          }
          
          @media (max-width: 768px) {
              .post_details_content {
                  padding: 20px;
              }
              
              .post_title_large {
                  font-size: 24px;
              }
              
              .post_meta {
                  flex-direction: column;
                  gap: 10px;
              }
          }
      </style>
   </body>
</html>
