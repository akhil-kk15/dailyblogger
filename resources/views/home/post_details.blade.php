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
                              <div class="post_image_large" onclick="openImageModal('{{ asset('postimage/' . $post->image) }}', '{{ $post->title }}')">
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
      
      <!-- Image Modal -->
      <div id="imageModal" class="image_modal">
          <span class="image_modal_close" onclick="closeImageModal()">&times;</span>
          <div class="image_modal_content">
              <img id="modalImage" src="" alt="">
              <div id="modalCaption" class="image_modal_caption"></div>
          </div>
      </div>
      
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
              max-height: none;
              overflow: visible;
              border-radius: 12px;
              margin-bottom: 30px;
              box-shadow: 0 8px 25px rgba(0,0,0,0.1);
              position: relative;
              cursor: pointer;
              transition: all 0.3s ease;
              display: flex;
              align-items: center;
              justify-content: center;
          }
          
          .post_image_large:hover {
              box-shadow: 0 12px 35px rgba(0,0,0,0.15);
              transform: translateY(-2px);
          }
          
          .post_image_large img {
              width: 100%;
              height: auto;
              max-width: 100%;
              object-fit: contain;
              transition: transform 0.3s ease;
              display: block;
              opacity: 1;
              border-radius: 12px;
          }
          
          .post_image_large:hover img {
              transform: scale(1.05);
          }
          
          /* Image Modal for Full Size Display */
          .image_modal {
              display: none;
              position: fixed;
              z-index: 9999;
              left: 0;
              top: 0;
              width: 100%;
              height: 100%;
              background-color: rgba(0,0,0,0.9);
              overflow: auto;
              animation: fadeIn 0.3s ease;
          }
          
          .image_modal_content {
              position: relative;
              margin: 2% auto;
              max-width: 95%;
              max-height: 95%;
              animation: zoomIn 0.3s ease;
          }
          
          .image_modal_content img {
              width: 100%;
              height: auto;
              max-height: 90vh;
              object-fit: contain;
              border-radius: 8px;
              box-shadow: 0 20px 60px rgba(0,0,0,0.5);
          }
          
          .image_modal_close {
              position: absolute;
              top: 20px;
              right: 35px;
              color: #fff;
              font-size: 40px;
              font-weight: bold;
              cursor: pointer;
              background: rgba(0,0,0,0.5);
              border-radius: 50%;
              width: 50px;
              height: 50px;
              display: flex;
              align-items: center;
              justify-content: center;
              transition: all 0.3s ease;
          }
          
          .image_modal_close:hover {
              background: rgba(255,255,255,0.2);
              transform: scale(1.1);
          }
          
          .image_modal_caption {
              text-align: center;
              color: #fff;
              padding: 20px;
              font-size: 18px;
              font-weight: 600;
              margin-top: 10px;
          }
          
          @keyframes fadeIn {
              from { opacity: 0; }
              to { opacity: 1; }
          }
          
          @keyframes zoomIn {
              from { transform: scale(0.8); opacity: 0; }
              to { transform: scale(1); opacity: 1; }
          }
          
          /* Responsive Image Improvements */
          @media (max-width: 768px) {
              .post_image_large {
                  margin-bottom: 20px;
                  border-radius: 8px;
              }
              
              .post_image_large img {
                  border-radius: 8px;
              }
              
              .image_modal_content {
                  margin: 5% auto;
                  max-width: 98%;
              }
              
              .image_modal_close {
                  top: 10px;
                  right: 20px;
                  font-size: 30px;
                  width: 40px;
                  height: 40px;
              }
              
              .image_modal_caption {
                  font-size: 16px;
                  padding: 15px;
              }
          }
          
          @media (max-width: 480px) {
              .post_image_large {
                  border-radius: 6px;
              }
              
              .post_image_large img {
                  border-radius: 6px;
              }
              
              .image_modal_close {
                  font-size: 24px;
                  width: 35px;
                  height: 35px;
              }
          }
          
          /* Ensure images maintain aspect ratio */
          .post_image_large img {
              max-height: 70vh;
              object-position: center;
          }
          
          /* Responsive Image Improvements */
          @media (max-width: 768px) {
              .post_image_large {
                  max-height: 300px;
                  margin-bottom: 20px;
                  border-radius: 8px;
              }
              
              .image_modal_content {
                  margin: 5% auto;
                  max-width: 98%;
              }
              
              .image_modal_close {
                  top: 10px;
                  right: 20px;
                  font-size: 30px;
                  width: 40px;
                  height: 40px;
              }
              
              .image_modal_caption {
                  font-size: 16px;
                  padding: 15px;
              }
          }
          
          @media (max-width: 480px) {
              .post_image_large {
                  max-height: 250px;
                  border-radius: 8px;
              }
              
              .image_modal_close {
                  font-size: 24px;
                  width: 35px;
                  height: 35px;
              }
          }
          
          /* Responsive Image Improvements */
          @media (max-width: 768px) {
              .post_image_large {
                  max-height: 300px;
                  margin-bottom: 20px;
                  border-radius: 8px;
              }
              
              .image_modal_content {
                  margin: 5% auto;
                  max-width: 98%;
              }
              
              .image_modal_close {
                  top: 10px;
                  right: 20px;
                  font-size: 30px;
                  width: 40px;
                  height: 40px;
              }
              
              .image_modal_caption {
                  font-size: 16px;
                  padding: 15px;
              }
              
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
          
          @media (max-width: 480px) {
              .post_image_large {
                  max-height: 250px;
                  border-radius: 6px;
                  margin-bottom: 15px;
              }
              
              .image_modal_close {
                  font-size: 24px;
                  width: 35px;
                  height: 35px;
                  top: 5px;
                  right: 15px;
              }
              
              .image_modal_caption {
                  font-size: 14px;
                  padding: 10px;
              }
              
              .post_details_content {
                  padding: 15px;
              }
              
              .post_title_large {
                  font-size: 20px;
                  line-height: 1.4;
              }
              
              .post_actions {
                  flex-direction: column;
                  gap: 10px;
              }
              
              .post_actions .btn {
                  text-align: center;
                  width: 100%;
              }
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
          
          // Image Modal Functions
          function openImageModal(imageSrc, caption) {
              const modal = document.getElementById('imageModal');
              const modalImg = document.getElementById('modalImage');
              const modalCaption = document.getElementById('modalCaption');
              
              modal.style.display = 'block';
              modalImg.src = imageSrc;
              modalCaption.textContent = caption;
              
              // Prevent body scroll when modal is open
              document.body.style.overflow = 'hidden';
          }
          
          function closeImageModal() {
              const modal = document.getElementById('imageModal');
              modal.style.display = 'none';
              
              // Restore body scroll
              document.body.style.overflow = 'auto';
          }
          
          // Close modal when clicking outside the image
          window.onclick = function(event) {
              const modal = document.getElementById('imageModal');
              if (event.target === modal) {
                  closeImageModal();
              }
          }
          
          // Close modal with Escape key
          document.addEventListener('keydown', function(event) {
              if (event.key === 'Escape') {
                  closeImageModal();
              }
          });
          
          // Optimize image loading
          document.addEventListener('DOMContentLoaded', function() {
              const postImage = document.querySelector('.post_image_large img');
              if (postImage) {
                  // Only add loading animation if image is not already loaded
                  if (!postImage.complete) {
                      postImage.style.opacity = '0';
                      postImage.style.transition = 'opacity 0.3s ease';
                      
                      postImage.onload = function() {
                          this.style.opacity = '1';
                      };
                  } else {
                      // Image is already loaded, make sure it's visible
                      postImage.style.opacity = '1';
                  }
                  
                  // Add error handling
                  postImage.onerror = function() {
                      this.style.opacity = '1';
                      this.src = 'data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNDAwIiBoZWlnaHQ9IjMwMCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KICAgIDxyZWN0IHdpZHRoPSIxMDAlIiBoZWlnaHQ9IjEwMCUiIGZpbGw9IiNlZWVlZWUiLz4KICAgIDx0ZXh0IHg9IjUwJSIgeT0iNTAlIiBmb250LWZhbWlseT0iQXJpYWwsIHNhbnMtc2VyaWYiIGZvbnQtc2l6ZT0iMTgiIGZpbGw9IiM5OTk5OTkiIHRleHQtYW5jaG9yPSJtaWRkbGUiIGR5PSIuM2VtIj5JbWFnZSBub3QgZm91bmQ8L3RleHQ+Cjwvc3ZnPg==';
                      this.alt = 'Image not found';
                  };
              }
          });
      </script>
   </body>
</html>
