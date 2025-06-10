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
      
      <!-- edit post section start -->
      <div class="profile_section layout_padding">
          <div class="container">
              <h1 class="services_taital">Edit Post</h1>
              <p class="services_text">Update your post content and settings</p>
              
              @if(session('message'))
                  <div class="alert alert-success alert-dismissible fade show" role="alert">
                      {{ session('message') }}
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
              @endif
              
              <div class="row justify-content-center">
                  <div class="col-md-10">
                      <div class="profile_card">
                          <!-- Post Status Info -->
                          <div class="post_status_info">
                              <div class="status_item">
                                  <strong>Current Status:</strong>
                                  @if($post->post_status == 'active')
                                      <span class="status_badge status_active">Published</span>
                                  @elseif($post->post_status == 'pending')
                                      <span class="status_badge status_pending">Pending Review</span>
                                  @elseif($post->post_status == 'rejected')
                                      <span class="status_badge status_rejected">Rejected</span>
                                  @endif
                              </div>
                              
                              @if($post->post_status == 'rejected' && $post->rejection_reason)
                                  <div class="rejection_reason">
                                      <strong>Rejection Reason:</strong>
                                      <p>{{ $post->rejection_reason }}</p>
                                      <small class="text-muted">Note: Your post will be resubmitted for review after editing.</small>
                                  </div>
                              @endif
                          </div>
                          
                          <form method="POST" action="{{ route('home.update_post', $post->id) }}" enctype="multipart/form-data">
                              @csrf
                              @method('PUT')
                              
                              <!-- Title -->
                              <div class="profile_input_group">
                                  <label for="title" class="profile_label">Post Title</label>
                                  <input type="text" id="title" name="title" value="{{ old('title', $post->title) }}" class="profile_input" required>
                                  @error('title')
                                      <span class="profile_error">{{ $message }}</span>
                                  @enderror
                              </div>
                              
                              <!-- Category -->
                              <div class="profile_input_group">
                                  <label for="category_id" class="profile_label">Category</label>
                                  <select id="category_id" name="category_id" class="profile_input">
                                      <option value="">Select a category</option>
                                      @foreach($categories as $category)
                                          <option value="{{ $category->id }}" 
                                                  {{ old('category_id', $post->category_id) == $category->id ? 'selected' : '' }}>
                                              {{ $category->name }}
                                          </option>
                                      @endforeach
                                  </select>
                                  @error('category_id')
                                      <span class="profile_error">{{ $message }}</span>
                                  @enderror
                              </div>
                              
                              <!-- Tags -->
                              <div class="profile_input_group">
                                  <label for="tags" class="profile_label">Tags</label>
                                  <div class="tags_container">
                                      @foreach($tags as $tag)
                                          <div class="tag_checkbox">
                                              <input type="checkbox" id="tag_{{ $tag->id }}" name="tags[]" value="{{ $tag->id }}" 
                                                     {{ in_array($tag->id, old('tags', $post->tags->pluck('id')->toArray())) ? 'checked' : '' }}>
                                              <label for="tag_{{ $tag->id }}" class="tag_label">{{ $tag->name }}</label>
                                          </div>
                                      @endforeach
                                  </div>
                                  @error('tags')
                                      <span class="profile_error">{{ $message }}</span>
                                  @enderror
                              </div>
                              
                              <!-- Current Image -->
                              @if($post->image)
                                  <div class="profile_input_group">
                                      <label class="profile_label">Current Image</label>
                                      <div class="current_image">
                                          <img src="{{ asset('postimage/' . $post->image) }}" alt="Current post image" class="img-thumbnail">
                                      </div>
                                  </div>
                              @endif
                              
                              <!-- Image -->
                              <div class="profile_input_group">
                                  <label for="image" class="profile_label">
                                      {{ $post->image ? 'Replace Image' : 'Featured Image' }}
                                  </label>
                                  <input type="file" id="image" name="image" class="profile_input" accept="image/jpeg,image/png,image/jpg">
                                  <small class="text-muted">Maximum file size: 5MB. Supported formats: JPEG, PNG, JPG</small>
                                  @error('image')
                                      <span class="profile_error">{{ $message }}</span>
                                  @enderror
                              </div>
                              
                              <!-- Description -->
                              <div class="profile_input_group">
                                  <label for="description" class="profile_label">Content</label>
                                  <textarea id="description" name="description" rows="15" class="profile_input" required placeholder="Write your post content here...">{{ old('description', $post->description) }}</textarea>
                                  @error('description')
                                      <span class="profile_error">{{ $message }}</span>
                                  @enderror
                              </div>
                              
                              <div class="profile_actions">
                                  <button type="submit" class="btn btn-primary">
                                      {{ $post->post_status == 'rejected' ? 'Resubmit for Review' : 'Update Post' }}
                                  </button>
                                  <a href="{{ route('home.my_posts') }}" class="btn btn-secondary">Cancel</a>
                              </div>
                          </form>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <!-- edit post section end -->
      
      <!-- footer section start -->
      @include('home.footer')
      <!-- footer section end -->
      
      <style>
          .post_status_info {
              background: #f8f9fa;
              padding: 20px;
              border-radius: 8px;
              margin-bottom: 30px;
          }
          
          .status_item {
              margin-bottom: 15px;
          }
          
          .status_badge {
              padding: 4px 12px;
              border-radius: 20px;
              font-size: 12px;
              font-weight: bold;
              text-transform: uppercase;
              margin-left: 10px;
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
          
          .rejection_reason {
              background: #f8d7da;
              padding: 15px;
              border-radius: 5px;
              margin-top: 10px;
              color: #721c24;
          }
          
          .rejection_reason p {
              margin-bottom: 10px;
          }
          
          .current_image {
              margin-top: 10px;
          }
          
          .current_image img {
              max-width: 200px;
              max-height: 200px;
              object-fit: cover;
              border-radius: 8px;
          }
          
          .tags_container {
              display: flex;
              flex-wrap: wrap;
              gap: 10px;
              margin-top: 10px;
          }
          
          .tag_checkbox {
              display: flex;
              align-items: center;
              background: #f8f9fa;
              padding: 8px 12px;
              border-radius: 20px;
              border: 1px solid #dee2e6;
          }
          
          .tag_checkbox input[type="checkbox"] {
              margin-right: 8px;
              width: auto;
          }
          
          .tag_label {
              margin: 0;
              cursor: pointer;
              font-size: 14px;
          }
          
          .tag_checkbox:has(input:checked) {
              background: #007bff;
              color: white;
              border-color: #007bff;
          }
          
          .profile_input[name="description"] {
              min-height: 200px;
              resize: vertical;
          }
          
          .btn-secondary {
              background: #6c757d;
              border-color: #6c757d;
              color: white;
              padding: 10px 20px;
              border-radius: 5px;
              text-decoration: none;
              display: inline-block;
              margin-left: 10px;
          }
          
          .btn-secondary:hover {
              background: #5a6268;
              border-color: #545b62;
              color: white;
              text-decoration: none;
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
          
          .text-muted {
              color: #6c757d;
              font-size: 0.9em;
          }
          
          .img-thumbnail {
              padding: 4px;
              border: 1px solid #dee2e6;
              border-radius: 4px;
          }
      </style>
      
      <script>
          // Auto-dismiss alerts after 5 seconds
          setTimeout(function() {
              var alerts = document.querySelectorAll('.alert');
              alerts.forEach(function(alert) {
                  alert.style.display = 'none';
              });
          }, 5000);
          
          // Image validation for edit form
          document.getElementById('image').addEventListener('change', function(event) {
              const file = event.target.files[0];
              if (!file) return;
              
              // Validate file type
              const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
              if (!allowedTypes.includes(file.type)) {
                  alert('Please select a JPEG or PNG image file only.');
                  event.target.value = '';
                  return;
              }
              
              // Validate file size (5MB = 5 * 1024 * 1024 bytes)
              const maxSize = 5 * 1024 * 1024;
              if (file.size > maxSize) {
                  alert('Image file size must not exceed 5MB. Please choose a smaller file.');
                  event.target.value = '';
                  return;
              }
          });
      </script>
   </body>
</html>
