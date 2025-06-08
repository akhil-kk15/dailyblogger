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
              
              @if(session('message'))
                  <div class="alert alert-success">
                      {{ session('message') }}
                  </div>
              @endif
              
              @if($posts->count() > 0)
                  <div class="posts_section_2">
                      <div class="row">
                          @foreach($posts as $post)
                              <div class="col-md-4 col-sm-6 mb-4" data-post-id="{{ $post->id }}">
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
                                                  <a href="{{ route('home.post_details', $post->id) }}" class="btn btn-primary btn-sm">View Post</a>
                                              @else
                                                  <span class="btn btn-secondary disabled btn-sm">{{ ucfirst($post->post_status) }}</span>
                                              @endif
                                              <a href="{{ route('home.edit_post', $post->id) }}" class="btn btn-warning btn-sm">
                                                  <i class="fa fa-edit"></i> Edit
                                              </a>
                                              <button onclick="deletePost({{ $post->id }})" class="btn btn-danger btn-sm">
                                                  <i class="fa fa-trash"></i> Delete
                                              </button>
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
              display: flex;
              gap: 8px;
              flex-wrap: wrap;
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
              flex: 1;
              text-align: center;
              min-width: auto;
          }
          
          .btn-sm {
              padding: 6px 12px;
              font-size: 12px;
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
          
          .btn-warning {
              background: #ffc107;
              color: #212529;
          }
          
          .btn-warning:hover {
              background: #e0a800;
              color: #212529;
              text-decoration: none;
          }
          
          .btn-danger {
              background: #dc3545;
              color: white;
          }
          
          .btn-danger:hover {
              background: #c82333;
              color: white;
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
          
          .alert-error {
              color: #721c24;
              background-color: #f8d7da;
              border-color: #f5c6cb;
          }
      </style>
      
      <script>
         function deletePost(postId) {
            if (confirm('Are you sure you want to delete this post? This action cannot be undone.')) {
               fetch(`/delete-post/${postId}`, {
                  method: 'DELETE',
                  headers: {
                     'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                     'Content-Type': 'application/json',
                     'Accept': 'application/json'
                  }
               })
               .then(response => response.json())
               .then(data => {
                  if (data.success) {
                     // Show success message
                     const alertDiv = document.createElement('div');
                     alertDiv.className = 'alert alert-success';
                     alertDiv.textContent = data.message;
                     
                     const container = document.querySelector('.container');
                     const title = container.querySelector('.services_taital');
                     title.parentNode.insertBefore(alertDiv, title.nextSibling.nextSibling);
                     
                     // Remove the post card
                     const postCard = document.querySelector(`[data-post-id="${postId}"]`);
                     if (postCard) {
                        postCard.style.opacity = '0';
                        setTimeout(() => {
                           postCard.remove();
                           // Check if no posts left
                           const remainingPosts = document.querySelectorAll('[data-post-id]');
                           if (remainingPosts.length === 0) {
                              location.reload(); // Reload to show "no posts" message
                           }
                        }, 300);
                     }
                  } else {
                     alert('Error: ' + data.message);
                  }
               })
               .catch(error => {
                  console.error('Error:', error);
                  alert('An error occurred while deleting the post.');
               });
            }
         }
      </script>
   </body>
</html>
