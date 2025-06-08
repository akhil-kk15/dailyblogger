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
                                  @if($post->category)
                                      <span class="post_category">
                                          <i class="fa fa-folder" style="margin-right: 5px;"></i>
                                          {{ $post->category->name }}
                                      </span>
                                  @endif
                              </div>
                              
                              @if($post->tags->count() > 0)
                                  <div class="post_tags">
                                      <i class="fa fa-tags" style="margin-right: 8px; color: #666;"></i>
                                      @foreach($post->tags as $tag)
                                          <span class="tag_badge" style="background-color: {{ $tag->color }}; color: #fff; padding: 4px 8px; border-radius: 12px; font-size: 12px; margin-right: 6px; display: inline-block;">
                                              {{ $tag->name }}
                                          </span>
                                      @endforeach
                                  </div>
                              @endif
                              
                              <div class="post_description_full">
                                  {!! nl2br(e($post->description)) !!}
                              </div>
                              
                              <div class="post_actions">
                                  <a href="{{ route('home.posts') }}" class="btn btn-primary">← Back to All Posts</a>
                                  <a href="{{ route('home.homepage') }}" class="btn btn-secondary">← Back to Home</a>
                              </div>
                          </div>
                      </div>
                      
                      <!-- Comments Section -->
                      <div class="comments_section">
                          <h3 class="comments_title">Comments ({{ $comments->count() }})</h3>
                          
                          @if(session()->has('message'))
                              <div class="alert alert-success">
                                  {{ session('message') }}
                              </div>
                          @endif
                          
                          <!-- Add Comment Form (only for authenticated users) -->
                          @if(Auth::check())
                              <div class="add_comment_form">
                                  <h4>Leave a Comment</h4>
                                  <form action="{{ route('home.store_comment', $post->id) }}" method="POST">
                                      @csrf
                                      <div class="form_group">
                                          <textarea name="comment" placeholder="Write your comment here..." rows="4" required>{{ old('comment') }}</textarea>
                                          @error('comment')
                                              <span class="error_message">{{ $message }}</span>
                                          @enderror
                                      </div>
                                      <button type="submit" class="btn btn-primary">Post Comment</button>
                                  </form>
                              </div>
                          @else
                              <div class="login_prompt">
                                  <p>Please <a href="{{ route('login') }}">login</a> to leave a comment.</p>
                              </div>
                          @endif
                          
                          <!-- Display Comments -->
                          <div class="comments_list">
                              @if($comments->count() > 0)
                                  @foreach($comments as $comment)
                                      <div class="comment_item">
                                          <div class="comment_header">
                                              <strong class="comment_author">{{ $comment->user_name }}</strong>
                                              <span class="comment_date">{{ $comment->created_at->format('M d, Y \a\t h:i A') }}</span>
                                          </div>
                                          <div class="comment_content">
                                              {!! nl2br(e($comment->comment)) !!}
                                          </div>
                                      </div>
                                  @endforeach
                              @else
                                  <div class="no_comments">
                                      <p>No comments yet. Be the first to comment!</p>
                                  </div>
                              @endif
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
              margin-bottom: 20px;
              padding-bottom: 15px;
              border-bottom: 1px solid #eee;
          }
          
          .post_author, .post_date, .post_category {
              color: #666;
              font-size: 14px;
          }
          
          .post_category {
              color: #007bff;
              font-weight: 600;
          }
          
          .post_tags {
              margin-bottom: 30px;
              padding-bottom: 15px;
              border-bottom: 1px solid #eee;
          }
          
          .tag_badge {
              transition: transform 0.2s ease;
          }
          
          .tag_badge:hover {
              transform: scale(1.05);
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
          
          /* Comments Section Styles */
          .comments_section {
              background: #fff;
              border-radius: 8px;
              box-shadow: 0 2px 10px rgba(0,0,0,0.1);
              padding: 30px;
              margin-top: 30px;
          }
          
          .comments_title {
              font-size: 24px;
              font-weight: bold;
              margin-bottom: 25px;
              color: #333;
              border-bottom: 2px solid #007bff;
              padding-bottom: 10px;
          }
          
          .add_comment_form {
              margin-bottom: 30px;
              padding: 20px;
              background: #f8f9fa;
              border-radius: 8px;
          }
          
          .add_comment_form h4 {
              margin-bottom: 15px;
              color: #333;
          }
          
          .form_group {
              margin-bottom: 15px;
          }
          
          .form_group textarea {
              width: 100%;
              padding: 12px;
              border: 1px solid #ddd;
              border-radius: 4px;
              font-size: 14px;
              resize: vertical;
              font-family: inherit;
          }
          
          .form_group textarea:focus {
              outline: none;
              border-color: #007bff;
              box-shadow: 0 0 0 3px rgba(0,123,255,0.1);
          }
          
          .error_message {
              color: #dc3545;
              font-size: 14px;
              margin-top: 5px;
              display: block;
          }
          
          .login_prompt {
              text-align: center;
              padding: 20px;
              background: #f8f9fa;
              border-radius: 8px;
              margin-bottom: 30px;
          }
          
          .login_prompt a {
              color: #007bff;
              text-decoration: none;
              font-weight: bold;
          }
          
          .login_prompt a:hover {
              text-decoration: underline;
          }
          
          .comments_list {
              margin-top: 20px;
          }
          
          .comment_item {
              border: 1px solid #eee;
              border-radius: 8px;
              padding: 20px;
              margin-bottom: 15px;
              background: #fff;
          }
          
          .comment_header {
              display: flex;
              justify-content: space-between;
              align-items: center;
              margin-bottom: 10px;
              padding-bottom: 8px;
              border-bottom: 1px solid #f0f0f0;
          }
          
          .comment_author {
              color: #007bff;
              font-size: 16px;
          }
          
          .comment_date {
              color: #666;
              font-size: 12px;
          }
          
          .comment_content {
              color: #444;
              line-height: 1.6;
              font-size: 14px;
          }
          
          .no_comments {
              text-align: center;
              color: #666;
              font-style: italic;
              padding: 40px 20px;
          }
          
          .alert {
              padding: 15px;
              margin-bottom: 20px;
              border: 1px solid transparent;
              border-radius: 4px;
          }
          
          .alert-success {
              color: #155724;
              background-color: #d4edda;
              border-color: #c3e6cb;
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
              
              .comments_section {
                  padding: 20px;
              }
              
              .comment_header {
                  flex-direction: column;
                  align-items: flex-start;
                  gap: 5px;
              }
          }
      </style>
   </body>
</html>
