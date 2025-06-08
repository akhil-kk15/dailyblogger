<!DOCTYPE html>
<html lang="en">
   <head>
      @include('home.homecss')
      <style>
         .edit_post_section {
            background: #fff;
            padding: 80px 0;
            min-height: 80vh;
         }
         .post_form_container {
            max-width: 800px;
            margin: 0 auto;
            background: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
         }
         .post_form_title {
            color: #2c3e50;
            font-size: 2.5rem;
            font-weight: 700;
            text-align: center;
            margin-bottom: 10px;
         }
         .post_form_subtitle {
            color: #7f8c8d;
            text-align: center;
            margin-bottom: 40px;
            font-size: 1.1rem;
         }
         .form_group {
            margin-bottom: 25px;
         }
         .form_label {
            display: block;
            color: #2c3e50;
            font-weight: 600;
            margin-bottom: 8px;
            font-size: 1rem;
         }
         .form_input, .form_textarea {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e1e8ed;
            border-radius: 8px;
            font-size: 1rem;
            color: #2c3e50;
            transition: border-color 0.3s ease;
         }
         .form_input:focus, .form_textarea:focus {
            outline: none;
            border-color: #3498db;
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.1);
         }
         .form_textarea {
            min-height: 200px;
            resize: vertical;
         }
         .file_input_wrapper {
            position: relative;
            overflow: hidden;
            display: inline-block;
            width: 100%;
         }
         .file_input {
            position: absolute;
            left: -9999px;
         }
         .file_input_label {
            display: block;
            padding: 12px 15px;
            background: #f8f9fa;
            border: 2px dashed #dee2e6;
            border-radius: 8px;
            cursor: pointer;
            text-align: center;
            transition: all 0.3s ease;
            color: #6c757d;
         }
         .file_input_label:hover {
            background: #e9ecef;
            border-color: #3498db;
         }
         .current_image {
            max-width: 200px;
            max-height: 200px;
            border-radius: 8px;
            margin-bottom: 15px;
            display: block;
         }
         .submit_btn {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 15px 40px;
            border: none;
            border-radius: 8px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            width: 100%;
         }
         .submit_btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
         }
         .cancel_btn {
            background: #6c757d;
            color: white;
            padding: 15px 40px;
            border: none;
            border-radius: 8px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            width: 100%;
            margin-top: 10px;
            text-decoration: none;
            display: inline-block;
            text-align: center;
         }
         .cancel_btn:hover {
            background: #5a6268;
            text-decoration: none;
            color: white;
         }
         .alert {
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid transparent;
            border-radius: 8px;
         }
         .alert-success {
            color: #155724;
            background-color: #d4edda;
            border-color: #c3e6cb;
         }
         .alert-warning {
            color: #856404;
            background-color: #fff3cd;
            border-color: #ffeaa7;
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
            cursor: pointer;
            margin: 0;
         }
         .tag_checkbox input[type="checkbox"] {
            display: none;
         }
         .tag_label {
            padding: 8px 16px;
            border-radius: 20px;
            color: white;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.3s ease;
            border: 2px solid transparent;
         }
         .tag_checkbox input[type="checkbox"]:checked + .tag_label {
            border-color: #2c3e50;
            box-shadow: 0 0 0 2px rgba(44, 62, 80, 0.2);
            transform: scale(1.05);
         }
         .tag_label:hover {
            transform: scale(1.05);
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
         }
      </style>
   </head>
   <body>
      <!-- header section start -->
      <div class="header_section">
         @include('home.header')
      </div>
      <!-- header section end -->
      
      <!-- edit post section start -->
      <div class="edit_post_section">
         <div class="container">
            <div class="post_form_container">
               <h1 class="post_form_title">Edit Post</h1>
               <p class="post_form_subtitle">Update your blog post content</p>
               
               @if(session('message'))
                  <div class="alert alert-success">
                     {{ session('message') }}
                  </div>
               @endif
               
               @if($post->post_status == 'rejected')
                  <div class="alert alert-warning">
                     <strong>Note:</strong> This post was previously rejected. After editing, it will be submitted for review again.
                     @if($post->rejection_reason)
                        <br><strong>Previous rejection reason:</strong> {{ $post->rejection_reason }}
                     @endif
                  </div>
               @endif
               
               <form method="POST" action="{{ route('home.update_post', $post->id) }}" enctype="multipart/form-data">
                  @csrf
                  @method('PUT')
                  
                  <div class="form_group">
                     <label for="title" class="form_label">Post Title *</label>
                     <input type="text" id="title" name="title" class="form_input" 
                            value="{{ old('title', $post->title) }}" placeholder="Enter your post title..." required>
                     @error('title')
                        <span style="color: #e74c3c; font-size: 0.9rem;">{{ $message }}</span>
                     @enderror
                  </div>
                  
                  <div class="form_group">
                     <label for="description" class="form_label">Post Content *</label>
                     <textarea id="description" name="description" class="form_textarea" 
                               placeholder="Write your post content here..." required>{{ old('description', $post->description) }}</textarea>
                     @error('description')
                        <span style="color: #e74c3c; font-size: 0.9rem;">{{ $message }}</span>
                     @enderror
                  </div>
                  
                  <div class="form_group">
                     <label for="category_id" class="form_label">Category</label>
                     <select id="category_id" name="category_id" class="form_input">
                        <option value="">Select a category (optional)</option>
                        @foreach($categories as $category)
                           <option value="{{ $category->id }}" 
                                   {{ old('category_id', $post->category_id) == $category->id ? 'selected' : '' }}>
                              {{ $category->name }}
                           </option>
                        @endforeach
                     </select>
                     @error('category_id')
                        <span style="color: #e74c3c; font-size: 0.9rem;">{{ $message }}</span>
                     @enderror
                  </div>
                  
                  <div class="form_group">
                     <label class="form_label">Tags (optional)</label>
                     <div class="tags_container">
                        @foreach($tags as $tag)
                           <label class="tag_checkbox">
                              <input type="checkbox" name="tags[]" value="{{ $tag->id }}" 
                                     {{ in_array($tag->id, old('tags', $post->tags->pluck('id')->toArray())) ? 'checked' : '' }}>
                              <span class="tag_label" style="background-color: {{ $tag->color }}">
                                 {{ $tag->name }}
                              </span>
                           </label>
                        @endforeach
                     </div>
                     @error('tags')
                        <span style="color: #e74c3c; font-size: 0.9rem;">{{ $message }}</span>
                     @enderror
                  </div>
                  
                  <div class="form_group">
                     <label for="image" class="form_label">Post Image</label>
                     
                     @if($post->image)
                        <div style="margin-bottom: 15px;">
                           <label style="font-size: 0.9rem; color: #6c757d;">Current Image:</label>
                           <br>
                           <img src="{{ asset('postimage/' . $post->image) }}" alt="Current post image" class="current_image">
                        </div>
                     @endif
                     
                     <div class="file_input_wrapper">
                        <input type="file" id="image" name="image" class="file_input" accept="image/*">
                        <label for="image" class="file_input_label">
                           <i class="fa fa-cloud-upload" style="margin-right: 8px;"></i>
                           {{ $post->image ? 'Change Image' : 'Choose Image' }} (Optional)
                        </label>
                     </div>
                     <small style="color: #6c757d; font-size: 0.85rem;">
                        Supported formats: JPEG, PNG, JPG, GIF. Max size: 2MB
                     </small>
                     @error('image')
                        <br><span style="color: #e74c3c; font-size: 0.9rem;">{{ $message }}</span>
                     @enderror
                  </div>
                  
                  <div class="form_group">
                     <button type="submit" class="submit_btn">
                        <i class="fa fa-save" style="margin-right: 8px;"></i>
                        Update Post
                     </button>
                     <a href="{{ route('home.my_posts') }}" class="cancel_btn">
                        <i class="fa fa-times" style="margin-right: 8px;"></i>
                        Cancel
                     </a>
                  </div>
               </form>
            </div>
         </div>
      </div>
      <!-- edit post section end -->
      
      <!-- footer section start -->
      @include('home.footer')
      <!-- footer section end -->
      
      <script>
         // File input preview
         document.getElementById('image').addEventListener('change', function(e) {
            const file = e.target.files[0];
            const label = document.querySelector('.file_input_label');
            
            if (file) {
               label.innerHTML = '<i class="fa fa-check" style="margin-right: 8px;"></i>Image Selected: ' + file.name;
               label.style.background = '#d4edda';
               label.style.borderColor = '#c3e6cb';
               label.style.color = '#155724';
            }
         });
      </script>
   </body>
</html>
