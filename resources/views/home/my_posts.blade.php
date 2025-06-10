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
      
      <!-- my posts section start -->
      <div class="profile_section layout_padding">
          <div class="container">
              <div class="d-flex justify-content-between align-items-center mb-4">
                  <div>
                      <h1 class="services_taital">My Posts</h1>
                      <p class="services_text">Manage and track your published content</p>
                  </div>
                  <a href="{{ route('home.create_post') }}" class="btn btn-primary">Create New Post</a>
              </div>
              
              @if(session('message'))
                  <div class="alert alert-success alert-dismissible fade show" role="alert">
                      {{ session('message') }}
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
              @endif
              
              @if($posts->count() > 0)
                  <div class="row">
                      @foreach($posts as $post)
                          <div class="col-md-6 col-lg-4 mb-4">
                              <div class="post_card">
                                  @if($post->image)
                                      <div class="post_image">
                                          <img src="{{ asset('postimage/' . $post->image) }}" alt="{{ $post->title }}" class="img-fluid">
                                      </div>
                                  @endif
                                  
                                  <div class="post_content">
                                      <div class="post_status">
                                          @if($post->post_status == 'active')
                                              <span class="status_badge status_active">Published</span>
                                          @elseif($post->post_status == 'pending')
                                              <span class="status_badge status_pending">Pending Review</span>
                                          @elseif($post->post_status == 'rejected')
                                              <span class="status_badge status_rejected">Rejected</span>
                                          @endif
                                      </div>
                                      
                                      <h3 class="post_title">{{ Str::limit($post->title, 50) }}</h3>
                                      
                                      <div class="post_meta">
                                          @if($post->category)
                                              <span class="post_category">{{ $post->category->name }}</span>
                                          @endif
                                          <span class="post_date">{{ $post->created_at->format('M d, Y') }}</span>
                                      </div>
                                      
                                          @if($post->tags->count() > 0)
                                          <div class="post_tags">
                                              @foreach($post->tags as $tag)
                                                  <span class="tag_item">{{ $tag->name }}</span>
                                              @endforeach
                                          </div>
                                      @endif
                                      
                                      <p class="post_excerpt">{{ Str::limit(strip_tags($post->description), 100) }}</p>
                                      
                                      @if($post->post_status == 'rejected' && $post->rejection_reason)
                                          <div class="rejection_reason">
                                              <strong>Rejection Reason:</strong>
                                              <p>{{ $post->rejection_reason }}</p>
                                          </div>
                                      @endif
                                      
                                      <div class="post_actions">
                                          @if($post->post_status == 'active')
                                              <a href="{{ route('home.post_details', $post->id) }}" class="btn btn-sm btn-outline-primary">View</a>
                                          @endif
                                          <a href="{{ route('home.edit_post', $post->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                          <button class="btn btn-sm btn-danger delete-post-btn" data-post-id="{{ $post->id }}">Delete</button>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      @endforeach
                  </div>
                  
                  <!-- Pagination -->
                  <div class="d-flex justify-content-center">
                      {{ $posts->links() }}
                  </div>
              @else
                  <div class="empty_state">
                      <div class="empty_icon">📝</div>
                      <h3>No Posts Yet</h3>
                      <p>You haven't created any posts yet. Start sharing your thoughts with the community!</p>
                      <a href="{{ route('home.create_post') }}" class="btn btn-primary">Create Your First Post</a>
                  </div>
              @endif
          </div>
      </div>
      <!-- my posts section end -->
      
      <!-- footer section start -->
      @include('home.footer')
      <!-- footer section end -->
      
      <style>
          .post_card {
              background: white;
              border-radius: 10px;
              box-shadow: 0 2px 10px rgba(0,0,0,0.1);
              overflow: hidden;
              transition: transform 0.3s ease;
              height: 100%;
              display: flex;
              flex-direction: column;
          }
          
          .post_card:hover {
              transform: translateY(-5px);
              box-shadow: 0 5px 20px rgba(0,0,0,0.15);
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
              flex: 1;
              display: flex;
              flex-direction: column;
          }
          
          .post_status {
              margin-bottom: 10px;
          }
          
          .status_badge {
              padding: 4px 12px;
              border-radius: 20px;
              font-size: 12px;
              font-weight: bold;
              text-transform: uppercase;
          }
          
          .status_active {
              background: #d4edda;
              color: #155724;
          }
          
          .status_pending {
              background: #fff3cd;
              color: #856404;
          }
          
          .status_rejected {
              background: #f8d7da;
              color: #721c24;
          }
          
          .post_title {
              font-size: 18px;
              margin-bottom: 10px;
              line-height: 1.4;
          }
          
          .post_meta {
              display: flex;
              justify-content: space-between;
              margin-bottom: 10px;
              font-size: 14px;
              color: #666;
          }
          
          .post_category {
              color: #007bff;
              font-weight: 600;
              font-size: 14px;
              margin-bottom: 10px;
          }
          
          .post_tags {
              margin-bottom: 10px;
          }
          
          .tag_item {
              display: inline-block;
              background: #f8f9fa;
              padding: 2px 8px;
              border-radius: 10px;
              font-size: 12px;
              margin-right: 5px;
              margin-bottom: 5px;
          }
          
          .post_excerpt {
              flex: 1;
              margin-bottom: 15px;
              color: #666;
              line-height: 1.5;
          }
          
          .rejection_reason {
              background: #f8d7da;
              padding: 10px;
              border-radius: 5px;
              margin-bottom: 15px;
              font-size: 14px;
              color: #721c24;
          }
          
          .post_actions {
              display: flex;
              gap: 5px;
              flex-wrap: wrap;
          }
          
          .btn-sm {
              padding: 5px 10px;
              font-size: 12px;
              border-radius: 3px;
              text-decoration: none;
              border: none;
              cursor: pointer;
          }
          
          .btn-outline-primary {
              background: transparent;
              color: #007bff;
              border: 1px solid #007bff;
          }
          
          .btn-outline-primary:hover {
              background: #007bff;
              color: white;
          }
          
          .btn-primary {
              background: #007bff;
              color: white;
          }
          
          .btn-primary:hover {
              background: #0056b3;
          }
          
          .btn-danger {
              background: #dc3545;
              color: white;
          }
          
          .btn-danger:hover {
              background: #c82333;
          }
          
          .empty_state {
              text-align: center;
              padding: 60px 20px;
          }
          
          .empty_icon {
              font-size: 80px;
              margin-bottom: 20px;
          }
          
          .empty_state h3 {
              margin-bottom: 10px;
              color: #333;
          }
          
          .empty_state p {
              color: #666;
              margin-bottom: 30px;
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
          
          .btn-close {
              float: right;
              background: none;
              border: none;
              font-size: 20px;
              cursor: pointer;
          }
      </style>
      
      <script>
          // Add event listeners for delete buttons
          document.addEventListener('DOMContentLoaded', function() {
              const deleteButtons = document.querySelectorAll('.delete-post-btn');
              deleteButtons.forEach(button => {
                  button.addEventListener('click', function() {
                      const postId = this.getAttribute('data-post-id');
                      deletePost(postId);
                  });
              });
          });
          
          function deletePost(postId) {
              if (confirm('Are you sure you want to delete this post? This action cannot be undone.')) {
                  fetch(`/delete-post/${postId}`, {
                      method: 'DELETE',
                      headers: {
                          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                          'Content-Type': 'application/json',
                      }
                  })
                  .then(response => response.json())
                  .then(data => {
                      if (data.success) {
                          location.reload();
                      } else {
                          alert('Error deleting post. Please try again.');
                      }
                  })
                  .catch(error => {
                      console.error('Error:', error);
                      alert('Error deleting post. Please try again.');
                  });
              }
          }
          
          // Auto-dismiss alerts after 5 seconds
          setTimeout(function() {
              var alerts = document.querySelectorAll('.alert');
              alerts.forEach(function(alert) {
                  alert.style.display = 'none';
              });
          }, 5000);
      </script>
   </body>
</html>
