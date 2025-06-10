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
                      
                      <!-- Comments Section -->
                      <div class="comments_section">
                          <h3 class="comments_title">Comments ({{ $post->comments->count() }})</h3>
                          
                          @if(session('message'))
                              <div class="alert alert-success alert-dismissible fade show" role="alert">
                                  {{ session('message') }}
                                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                              </div>
                          @endif
                          
                          @if(session('error'))
                              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                  {{ session('error') }}
                                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                              </div>
                          @endif
                          
                          <!-- Add Comment Form -->
                          @auth
                              <div class="add_comment_form">
                                  <h4>Leave a Comment</h4>
                                  <form method="POST" action="{{ route('comments.store') }}">
                                      @csrf
                                      <input type="hidden" name="post_id" value="{{ $post->id }}">
                                      
                                      <div class="form_group">
                                          <textarea name="comment" class="comment_textarea" rows="4" placeholder="Write your comment here..." required>{{ old('comment') }}</textarea>
                                          @error('comment')
                                              <span class="error_message">{{ $message }}</span>
                                          @enderror
                                      </div>
                                      
                                      <div class="form_actions">
                                          <button type="submit" class="btn btn-primary">Post Comment</button>
                                      </div>
                                  </form>
                              </div>
                          @else
                              <div class="login_prompt">
                                  <p>Please <a href="{{ route('login') }}">login</a> to leave a comment.</p>
                              </div>
                          @endauth
                          
                          <!-- Comments List -->
                          <div class="comments_list">
                              @forelse($post->comments->sortByDesc('created_at') as $comment)
                                  <div class="comment_item" id="comment-{{ $comment->id }}">
                                      <div class="comment_header">
                                          <div class="comment_author">
                                              <strong>{{ $comment->user_name }}</strong>
                                              @if($comment->user && $comment->user->usertype === 'admin')
                                                  <span class="admin_badge">Admin</span>
                                              @endif
                                          </div>
                                          <div class="comment_date">{{ $comment->created_at->diffForHumans() }}</div>
                                      </div>
                                      
                                      <div class="comment_content">
                                          <p id="comment-text-{{ $comment->id }}">{{ $comment->comment }}</p>
                                      </div>
                                      
                                      @auth
                                          @if(Auth::id() === $comment->user_id || Auth::user()->usertype === 'admin')
                                              <div class="comment_actions">
                                                  @if(Auth::id() === $comment->user_id)
                                                      <button class="btn btn-sm btn-outline-primary edit-comment-btn" data-comment-id="{{ $comment->id }}">Edit</button>
                                                  @endif
                                                  <button class="btn btn-sm btn-danger delete-comment-btn" data-comment-id="{{ $comment->id }}">Delete</button>
                                              </div>
                                              
                                              <!-- Edit Form (Hidden by default) -->
                                              @if(Auth::id() === $comment->user_id)
                                                  <div id="edit-form-{{ $comment->id }}" class="edit_comment_form" style="display: none;">
                                                      <form method="POST" action="{{ route('comments.update', $comment->id) }}">
                                                          @csrf
                                                          @method('PUT')
                                                          <textarea name="comment" class="comment_textarea" rows="3" required>{{ $comment->comment }}</textarea>
                                                          <div class="form_actions">
                                                              <button type="submit" class="btn btn-sm btn-primary">Update</button>
                                                              <button type="button" class="btn btn-sm btn-secondary cancel-edit-btn" data-comment-id="{{ $comment->id }}">Cancel</button>
                                                          </div>
                                                      </form>
                                                  </div>
                                              @endif
                                          @endif
                                      @endauth
                                  </div>
                              @empty
                                  <div class="no_comments">
                                      <p>No comments yet. Be the first to comment!</p>
                                  </div>
                              @endforelse
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
          
          @media (max-width: 768px) {          .post_details_content {
              padding: 20px;
          }
          
          .post_title_large {
              font-size: 24px;
          }
          
          .post_meta {
              flex-direction: column;
              gap: 10px;
          }
          
          /* Comments Section Styles */
          .comments_section {
              background: white;
              border-radius: 10px;
              box-shadow: 0 2px 10px rgba(0,0,0,0.1);
              padding: 30px;
              margin-top: 30px;
          }
          
          .comments_title {
              font-size: 24px;
              margin-bottom: 25px;
              color: #333;
              border-bottom: 2px solid #007bff;
              padding-bottom: 10px;
          }
          
          .add_comment_form {
              background: #f8f9fa;
              padding: 25px;
              border-radius: 8px;
              margin-bottom: 30px;
          }
          
          .add_comment_form h4 {
              margin-bottom: 15px;
              color: #333;
          }
          
          .form_group {
              margin-bottom: 15px;
          }
          
          .comment_textarea {
              width: 100%;
              padding: 12px;
              border: 1px solid #ddd;
              border-radius: 5px;
              font-size: 14px;
              resize: vertical;
              min-height: 100px;
          }
          
          .comment_textarea:focus {
              outline: none;
              border-color: #007bff;
              box-shadow: 0 0 5px rgba(0,123,255,0.3);
          }
          
          .form_actions {
              display: flex;
              gap: 10px;
          }
          
          .error_message {
              color: #dc3545;
              font-size: 12px;
              margin-top: 5px;
              display: block;
          }
          
          .login_prompt {
              background: #fff3cd;
              padding: 20px;
              border-radius: 8px;
              text-align: center;
              margin-bottom: 30px;
              border: 1px solid #ffeaa7;
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
              background: #fff;
              border: 1px solid #eee;
              border-radius: 8px;
              padding: 20px;
              margin-bottom: 15px;
              transition: box-shadow 0.3s ease;
          }
          
          .comment_item:hover {
              box-shadow: 0 2px 8px rgba(0,0,0,0.1);
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
              display: flex;
              align-items: center;
              gap: 10px;
          }
          
          .admin_badge {
              background: #dc3545;
              color: white;
              padding: 2px 8px;
              border-radius: 10px;
              font-size: 10px;
              font-weight: bold;
              text-transform: uppercase;
          }
          
          .comment_date {
              color: #666;
              font-size: 12px;
          }
          
          .comment_content {
              margin-bottom: 15px;
              line-height: 1.6;
          }
          
          .comment_actions {
              display: flex;
              gap: 10px;
              margin-top: 10px;
          }
          
          .edit_comment_form {
              margin-top: 15px;
              padding: 15px;
              background: #f8f9fa;
              border-radius: 5px;
          }
          
          .no_comments {
              text-align: center;
              padding: 40px;
              color: #666;
              background: #f8f9fa;
              border-radius: 8px;
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
          
          .alert-danger {
              color: #721c24;
              background-color: #f8d7da;
              border-color: #f5c6cb;
          }
          
          .btn-close {
              float: right;
              background: none;
              border: none;
              font-size: 20px;
              cursor: pointer;
          }
      }
      </style>
      
      <script>
          // Initialize event listeners when DOM is loaded
          document.addEventListener('DOMContentLoaded', function() {
              // Edit comment buttons
              document.querySelectorAll('.edit-comment-btn').forEach(button => {
                  button.addEventListener('click', function() {
                      const commentId = this.getAttribute('data-comment-id');
                      editComment(commentId);
                  });
              });
              
              // Delete comment buttons
              document.querySelectorAll('.delete-comment-btn').forEach(button => {
                  button.addEventListener('click', function() {
                      const commentId = this.getAttribute('data-comment-id');
                      deleteComment(commentId);
                  });
              });
              
              // Cancel edit buttons
              document.querySelectorAll('.cancel-edit-btn').forEach(button => {
                  button.addEventListener('click', function() {
                      const commentId = this.getAttribute('data-comment-id');
                      cancelEdit(commentId);
                  });
              });
          });
          
          function editComment(commentId) {
              // Hide comment text and show edit form
              document.getElementById('comment-text-' + commentId).style.display = 'none';
              document.getElementById('edit-form-' + commentId).style.display = 'block';
          }
          
          function cancelEdit(commentId) {
              // Show comment text and hide edit form
              document.getElementById('comment-text-' + commentId).style.display = 'block';
              document.getElementById('edit-form-' + commentId).style.display = 'none';
          }
          
          function deleteComment(commentId) {
              if (confirm('Are you sure you want to delete this comment? This action cannot be undone.')) {
                  fetch(`/comments/${commentId}`, {
                      method: 'DELETE',
                      headers: {
                          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                          'Content-Type': 'application/json',
                      }
                  })
                  .then(response => response.json())
                  .then(data => {
                      if (data.success) {
                          // Remove the comment from the page
                          const commentElement = document.getElementById('comment-' + commentId);
                          commentElement.remove();
                          
                          // Update comment count
                          updateCommentCount();
                          
                          // Show success message
                          showAlert('Comment deleted successfully!', 'success');
                      } else {
                          showAlert('Error deleting comment. Please try again.', 'danger');
                      }
                  })
                  .catch(error => {
                      console.error('Error:', error);
                      showAlert('Error deleting comment. Please try again.', 'danger');
                  });
              }
          }
          
          function updateCommentCount() {
              const commentsCount = document.querySelectorAll('.comment_item').length;
              const commentsTitle = document.querySelector('.comments_title');
              commentsTitle.textContent = `Comments (${commentsCount})`;
          }
          
          function showAlert(message, type) {
              const alertDiv = document.createElement('div');
              alertDiv.className = `alert alert-${type} alert-dismissible fade show`;
              alertDiv.innerHTML = `
                  ${message}
                  <button type="button" class="btn-close" onclick="this.parentElement.remove()" aria-label="Close"></button>
              `;
              
              const commentsSection = document.querySelector('.comments_section');
              commentsSection.insertBefore(alertDiv, commentsSection.firstChild.nextSibling);
              
              // Auto-dismiss after 5 seconds
              setTimeout(() => {
                  if (alertDiv.parentNode) {
                      alertDiv.remove();
                  }
              }, 5000);
          }
          
          // Auto-dismiss existing alerts after 5 seconds
          setTimeout(function() {
              var alerts = document.querySelectorAll('.alert');
              alerts.forEach(function(alert) {
                  alert.style.display = 'none';
              });
          }, 5000);
      </script>
   </body>
</html>
