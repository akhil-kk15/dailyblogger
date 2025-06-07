<!DOCTYPE html>
<html lang="en">
   <head>
      @include('home.homecss')
      <style>
         .create_post_section {
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
         }
         .form_textarea {
            min-height: 120px;
            resize: vertical;
         }
         .file_input_wrapper {
            position: relative;
            display: inline-block;
            width: 100%;
         }
         .file_input {
            width: 100%;
            padding: 12px 15px;
            border: 2px dashed #e1e8ed;
            border-radius: 8px;
            background: #f8f9fa;
            color: #7f8c8d;
            cursor: pointer;
            transition: all 0.3s ease;
         }
         .file_input:hover {
            border-color: #3498db;
            background: #e3f2fd;
         }
         .submit_btn {
            background: linear-gradient(45deg, #3498db, #2980b9);
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
            background: linear-gradient(45deg, #2980b9, #21618c);
            transform: translateY(-2px);
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
         .error_message {
            color: #e74c3c;
            font-size: 0.9rem;
            margin-top: 5px;
         }
         .requirements {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 30px;
         }
         .requirements h4 {
            color: #2c3e50;
            margin-bottom: 15px;
         }
         .requirements ul {
            margin: 0;
            padding-left: 20px;
         }
         .requirements li {
            color: #7f8c8d;
            margin-bottom: 5px;
         }
      </style>
   </head>
   <body>
      <!-- header section start -->
      <div class="header_section">
         @include('home.header')
      </div>
      <!-- header section end -->
      
      <!-- create post section start -->
      <div class="create_post_section">
         <div class="container">
            <div class="post_form_container">
               <h1 class="post_form_title">Create New Post</h1>
               <p class="post_form_subtitle">Share your thoughts and ideas with the community</p>
               
               @if(session()->has('message'))
                   <div class="alert alert-success">
                       {{ session('message') }}
                   </div>
               @endif
               
               <div class="requirements">
                  <h4>📝 Submission Guidelines</h4>
                  <ul>
                     <li>Your post will be reviewed by our admin team before publication</li>
                     <li>Please ensure your content is original and follows community guidelines</li>
                     <li>Images should be in JPEG, PNG, JPG, or GIF format (max 2MB)</li>
                     <li>Use a clear and descriptive title for better engagement</li>
                  </ul>
               </div>
               
               <form action="{{ route('home.store_post') }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  
                  <div class="form_group">
                     <label for="title" class="form_label">Post Title *</label>
                     <input type="text" id="title" name="title" class="form_input" 
                            placeholder="Enter an engaging title for your post" 
                            value="{{ old('title') }}" required>
                     @error('title')
                         <div class="error_message">{{ $message }}</div>
                     @enderror
                  </div>
                  
                  <div class="form_group">
                     <label for="description" class="form_label">Post Content *</label>
                     <textarea id="description" name="description" class="form_textarea" 
                               placeholder="Write your post content here..." 
                               required>{{ old('description') }}</textarea>
                     @error('description')
                         <div class="error_message">{{ $message }}</div>
                     @enderror
                  </div>
                  
                  <div class="form_group">
                     <label for="image" class="form_label">Featured Image *</label>
                     <input type="file" id="image" name="image" class="file_input" 
                            accept="image/*" required>
                     @error('image')
                         <div class="error_message">{{ $message }}</div>
                     @enderror
                  </div>
                  
                  <div class="form_group">
                     <button type="submit" class="submit_btn">
                        📤 Submit Post for Review
                     </button>
                  </div>
               </form>
            </div>
         </div>
      </div>
      
      <!-- footer section start -->
      @include('home.footer')
      <!-- footer section end -->
   </body>
</html>
