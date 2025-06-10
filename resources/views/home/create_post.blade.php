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
      
      <!-- create post section start -->
      <div class="create_post_section layout_padding">
          <div class="container">
              <div class="create_post_header">
                  <h1 class="create_post_title">
                      <i class="fa fa-pen-fancy"></i>
                      Create New Post
                  </h1>
                  <p class="create_post_subtitle">Share your thoughts and stories with the community</p>
                  <div class="progress_indicator">
                      <div class="step active" data-step="1">
                          <div class="step_icon">✍️</div>
                          <span>Write</span>
                      </div>
                      <div class="step" data-step="2">
                          <div class="step_icon">🎨</div>
                          <span>Style</span>
                      </div>
                      <div class="step" data-step="3">
                          <div class="step_icon">🚀</div>
                          <span>Publish</span>
                      </div>
                  </div>
              </div>
              
              @if(session('message'))
                  <div class="alert alert-success alert-dismissible fade show" role="alert">
                      <i class="fa fa-check-circle"></i>
                      {{ session('message') }}
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
              @endif
              
              <div class="row justify-content-center">
                  <div class="col-md-10">
                      <div class="form_wizard">
                          <!-- Writing Tips Panel -->
                          <div class="tips_panel">
                              <h4><i class="fa fa-lightbulb"></i> Pro Writing Tips</h4>
                              <div class="tips_carousel">
                                  <div class="tip active">
                                      <i class="fa fa-quote-left"></i>
                                      <p>Start with a compelling hook to grab your readers' attention from the first sentence.</p>
                                  </div>
                                  <div class="tip">
                                      <i class="fa fa-quote-left"></i>
                                      <p>Use short paragraphs and bullet points to make your content easy to scan and read.</p>
                                  </div>
                                  <div class="tip">
                                      <i class="fa fa-quote-left"></i>
                                      <p>Add relevant images, videos, or infographics to make your post more engaging.</p>
                                  </div>
                                  <div class="tip">
                                      <i class="fa fa-quote-left"></i>
                                      <p>End with a call-to-action to encourage reader engagement and comments.</p>
                                  </div>
                              </div>
                          </div>
                          
                          <div class="create_post_card">
                              <form method="POST" action="{{ route('home.store_post') }}" enctype="multipart/form-data" id="createPostForm">
                                  @csrf
                                  
                                  <div class="form_step active" id="step1">
                                      <div class="step_header">
                                          <h3>📝 Basic Information</h3>
                                          <p>Let's start with the essentials</p>
                                      </div>
                                      
                                      <div class="form_row">
                                          <!-- Title -->
                                          <div class="form_group">
                                              <label for="title" class="form_label">
                                                  <i class="fa fa-heading"></i>
                                                  Post Title <span class="required">*</span>
                                              </label>
                                              <input type="text" 
                                                     id="title" 
                                                     name="title" 
                                                     value="{{ old('title') }}" 
                                                     class="form_input" 
                                                     placeholder="Enter a captivating title..."
                                                     required>
                                              <div class="input_feedback">
                                                  <span class="char_count">0/100 characters</span>
                                                  <span class="title_suggestions" style="display: none;">
                                                      <strong>Suggestions:</strong> Make it specific, use numbers, ask questions
                                                  </span>
                                              </div>
                                              @error('title')
                                                  <span class="error_message">{{ $message }}</span>
                                              @enderror
                                          </div>
                                      </div>
                                      
                                      <div class="form_row">
                                          <!-- Category -->
                                          <div class="form_group">
                                              <label for="category_id" class="form_label">
                                                  <i class="fa fa-folder"></i>
                                                  Category
                                              </label>
                                              <select id="category_id" name="category_id" class="form_select">
                                                  <option value="">Choose a category...</option>
                                                  @foreach($categories as $category)
                                                      <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                          {{ $category->name }}
                                                      </option>
                                                  @endforeach
                                              </select>
                                              @error('category_id')
                                                  <span class="error_message">{{ $message }}</span>
                                              @enderror
                                          </div>
                                          
                                          <!-- Tags -->
                                          <div class="form_group">
                                              <label for="tags" class="form_label">
                                                  <i class="fa fa-tags"></i>
                                                  Tags
                                              </label>
                                              <div class="tags_container">
                                                  @foreach($tags as $tag)
                                                      <div class="tag_item">
                                                          <input type="checkbox" 
                                                                 id="tag_{{ $tag->id }}" 
                                                                 name="tags[]" 
                                                                 value="{{ $tag->id }}" 
                                                                 {{ in_array($tag->id, old('tags', [])) ? 'checked' : '' }}>
                                                          <label for="tag_{{ $tag->id }}" class="tag_label">
                                                              {{ $tag->name }}
                                                          </label>
                                                      </div>
                                                  @endforeach
                                              </div>
                                              @error('tags')
                                                  <span class="error_message">{{ $message }}</span>
                                              @enderror
                                          </div>
                                      </div>
                                  </div>
                                  
                                  <div class="form_step" id="step2">
                                      <div class="step_header">
                                          <h3>🖼️ Visual Content</h3>
                                          <p>Add an eye-catching featured image</p>
                                      </div>
                                      
                                      <!-- Image Upload -->
                                      <div class="form_group">
                                          <label for="image" class="form_label">
                                              <i class="fa fa-image"></i>
                                              Featured Image
                                          </label>
                                          <div class="image_upload_area" onclick="document.getElementById('image').click()">
                                              <input type="file" 
                                                     id="image" 
                                                     name="image" 
                                                     class="hidden_input" 
                                                     accept="image/jpeg,image/png,image/jpg"
                                                     onchange="handleImageSelect(this)">
                                              <div class="upload_content" id="uploadContent">
                                                  <div class="upload_icon">🖼️</div>
                                                  <h4>Click to upload or drag & drop</h4>
                                                  <p>PNG, JPG, JPEG up to 5MB</p>
                                              </div>
                                              <div class="image_preview" id="imagePreview" style="display: none;">
                                                  <img id="previewImg" src="" alt="Preview">
                                                  <div class="image_info">
                                                      <span id="imageName"></span>
                                                      <button type="button" class="remove_image" onclick="removeImage()">
                                                          <i class="fa fa-times"></i>
                                                      </button>
                                                  </div>
                                              </div>
                                          </div>
                                          <small class="form_help">Maximum file size: 5MB. Supported formats: JPEG, PNG, JPG</small>
                                          @error('image')
                                              <span class="error_message">{{ $message }}</span>
                                          @enderror
                                      </div>
                                  </div>
                                  
                                  <div class="form_step" id="step3">
                                      <div class="step_header">
                                          <h3>✍️ Write Your Story</h3>
                                          <p>Share your thoughts with the world</p>
                                      </div>
                                      
                                      <!-- Content Editor -->
                                      <div class="form_group">
                                          <label for="description" class="form_label">
                                              <i class="fa fa-edit"></i>
                                              Post Content <span class="required">*</span>
                                          </label>
                                          <div class="editor_toolbar">
                                              <div class="toolbar_group">
                                                  <button type="button" class="toolbar_btn" onclick="formatText('bold')" title="Bold">
                                                      <i class="fa fa-bold"></i>
                                                  </button>
                                                  <button type="button" class="toolbar_btn" onclick="formatText('italic')" title="Italic">
                                                      <i class="fa fa-italic"></i>
                                                  </button>
                                                  <button type="button" class="toolbar_btn" onclick="formatText('underline')" title="Underline">
                                                      <i class="fa fa-underline"></i>
                                                  </button>
                                              </div>
                                              <div class="toolbar_group">
                                                  <button type="button" class="toolbar_btn" onclick="insertList('ul')" title="Bullet List">
                                                      <i class="fa fa-list-ul"></i>
                                                  </button>
                                                  <button type="button" class="toolbar_btn" onclick="insertList('ol')" title="Numbered List">
                                                      <i class="fa fa-list-ol"></i>
                                                  </button>
                                              </div>
                                              <div class="word_count">
                                                  <span id="wordCount">0 words</span>
                                              </div>
                                          </div>
                                          <textarea id="description" 
                                                    name="description" 
                                                    rows="15" 
                                                    class="form_textarea" 
                                                    required 
                                                    placeholder="Start writing your amazing content here...

Remember to:
• Use clear, engaging language
• Break up text with headings and paragraphs  
• Add examples and stories to illustrate your points
• Include a strong conclusion

Your audience is waiting to hear your unique perspective!">{{ old('description') }}</textarea>
                                          <div class="editor_footer">
                                              <div class="reading_time">
                                                  <i class="fa fa-clock"></i>
                                                  <span id="readingTime">0 min read</span>
                                              </div>
                                          </div>
                                          @error('description')
                                              <span class="error_message">{{ $message }}</span>
                                          @enderror
                                      </div>
                                  </div>
                                  
                                  <div class="form_navigation">
                                      <button type="button" class="btn btn_secondary" id="prevBtn" onclick="changeStep(-1)" style="display: none;">
                                          <i class="fa fa-arrow-left"></i>
                                          Previous
                                      </button>
                                      <button type="button" class="btn btn_primary" id="nextBtn" onclick="changeStep(1)">
                                          Next
                                          <i class="fa fa-arrow-right"></i>
                                      </button>
                                      <button type="submit" class="btn btn_submit" id="submitBtn" style="display: none;">
                                          <i class="fa fa-paper-plane"></i>
                                          Submit for Review
                                      </button>
                                      <a href="{{ route('home.my_posts') }}" class="btn btn_cancel">
                                          <i class="fa fa-times"></i>
                                          Cancel
                                      </a>
                                  </div>
                              </form>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <!-- create post section end -->
      
      <!-- footer section start -->
      @include('home.footer')
      <!-- footer section end -->
      
      <style>
          body {
              background: linear-gradient(120deg, #e0e7ff 0%, #f8fafc 100%);
              min-height: 100vh;
          }
          .create_post_section {
              padding: 40px 0 60px 0;
          }
          .create_post_header {
              text-align: center;
              margin-bottom: 40px;
          }
          .create_post_title {
              font-size: 2.5rem;
              font-weight: 700;
              color: #6f42c1;
              margin-bottom: 8px;
              letter-spacing: 1px;
              display: flex;
              align-items: center;
              justify-content: center;
              gap: 12px;
          }
          .create_post_title .fa-pen-fancy {
              color: #007bff;
              font-size: 2.2rem;
          }
          .create_post_subtitle {
              color: #555;
              font-size: 1.1rem;
              margin-bottom: 18px;
          }
          .progress_indicator {
              display: flex;
              justify-content: center;
              gap: 32px;
              margin-top: 18px;
              margin-bottom: 10px;
          }
          .progress_indicator .step {
              display: flex;
              flex-direction: column;
              align-items: center;
              position: relative;
              transition: color 0.3s;
          }
          .progress_indicator .step .step_icon {
              width: 44px;
              height: 44px;
              background: linear-gradient(90deg, #007bff 0%, #6f42c1 100%);
              color: #fff;
              border-radius: 50%;
              display: flex;
              align-items: center;
              justify-content: center;
              font-size: 1.5rem;
              margin-bottom: 6px;
              box-shadow: 0 2px 8px rgba(111,66,193,0.10);
              transition: background 0.3s, box-shadow 0.3s;
          }
          .progress_indicator .step.active .step_icon {
              background: linear-gradient(90deg, #6f42c1 0%, #007bff 100%);
              box-shadow: 0 4px 16px rgba(0,123,255,0.15);
          }
          .progress_indicator .step span {
              font-size: 0.95rem;
              color: #6f42c1;
              font-weight: 600;
          }
          .progress_indicator .step.active span {
              color: #007bff;
          }
          .form_wizard {
              background: #fff;
              border-radius: 18px;
              box-shadow: 0 8px 32px rgba(0,0,0,0.10);
              padding: 38px 30px 30px 30px;
              position: relative;
              z-index: 2;
              margin-bottom: 30px;
          }
          .tips_panel {
              background: linear-gradient(90deg, #e0e7ff 0%, #f8fafc 100%);
              border-radius: 12px;
              padding: 18px 22px;
              margin-bottom: 28px;
              box-shadow: 0 2px 8px rgba(111,66,193,0.06);
          }
          .tips_panel h4 {
              color: #6f42c1;
              font-size: 1.1rem;
              margin-bottom: 10px;
              font-weight: 700;
          }
          .tips_carousel {
              display: flex;
              gap: 18px;
              overflow-x: auto;
              scrollbar-width: thin;
          }
          .tip {
              background: #fff;
              border-radius: 10px;
              padding: 12px 18px;
              min-width: 220px;
              box-shadow: 0 2px 8px rgba(0,123,255,0.06);
              color: #333;
              font-size: 0.98rem;
              display: flex;
              align-items: flex-start;
              gap: 10px;
              transition: box-shadow 0.2s;
          }
          .tip.active {
              border: 2px solid #6f42c1;
              box-shadow: 0 4px 16px rgba(111,66,193,0.10);
          }
          .tip .fa-quote-left {
              color: #007bff;
              font-size: 1.2rem;
              margin-top: 2px;
          }
          .form_group {
              margin-bottom: 24px;
          }
          .form_label {
              font-weight: 600;
              color: #6f42c1;
              margin-bottom: 8px;
              display: flex;
              align-items: center;
              gap: 7px;
          }
          .form_input, .form_select, .form_textarea {
              width: 100%;
              padding: 14px 16px;
              border: 2px solid #e5e7eb;
              border-radius: 10px;
              background: #f8fafc;
              font-size: 1rem;
              transition: border-color 0.2s, box-shadow 0.2s;
              outline: none;
          }
          .form_input:focus, .form_select:focus, .form_textarea:focus {
              border-color: #6f42c1;
              background: #fff;
              box-shadow: 0 0 0 2px #c7d2fe;
          }
          .form_input::placeholder, .form_textarea::placeholder {
              color: #b0b3b8;
              font-size: 0.98rem;
          }
          .input_feedback {
              display: flex;
              justify-content: space-between;
              font-size: 0.92rem;
              color: #888;
              margin-top: 4px;
          }
          .char_count {
              color: #007bff;
          }
          .title_suggestions {
              color: #6f42c1;
          }
          .error_message {
              color: #dc3545;
              font-size: 0.95rem;
              margin-top: 4px;
              display: block;
          }
          .tags_container {
              display: flex;
              flex-wrap: wrap;
              gap: 10px;
              margin-top: 10px;
          }
          .tag_item {
              background: #f8f9fa;
              border-radius: 18px;
              padding: 7px 14px;
              display: flex;
              align-items: center;
              gap: 6px;
              border: 2px solid #e5e7eb;
              transition: background 0.2s, border-color 0.2s;
              cursor: pointer;
          }
          .tag_item input[type="checkbox"] {
              margin-right: 6px;
              accent-color: #6f42c1;
          }
          .tag_item input[type="checkbox"]:checked + .tag_label {
              color: #fff;
          }
          .tag_item:hover, .tag_item input[type="checkbox"]:checked ~ .tag_label {
              background: #6f42c1;
              color: #fff;
              border-color: #6f42c1;
          }
          .tag_label {
              font-size: 0.97rem;
              cursor: pointer;
              color: #6f42c1;
              transition: color 0.2s;
          }
          .image_upload_area {
              background: #f8fafc;
              border: 2px dashed #6f42c1;
              border-radius: 12px;
              padding: 32px 0;
              text-align: center;
              cursor: pointer;
              transition: border-color 0.2s, background 0.2s;
              margin-bottom: 10px;
          }
          .image_upload_area:hover {
              border-color: #007bff;
              background: #e0e7ff;
          }
          .upload_icon {
              font-size: 2.2rem;
              color: #6f42c1;
              margin-bottom: 8px;
          }
          .upload_content h4 {
              color: #007bff;
              font-size: 1.1rem;
              margin-bottom: 2px;
          }
          .upload_content p {
              color: #888;
              font-size: 0.97rem;
          }
          .image_preview {
              display: flex;
              align-items: center;
              gap: 16px;
              margin-top: 10px;
          }
          .image_preview img {
              max-width: 120px;
              max-height: 120px;
              border-radius: 10px;
              box-shadow: 0 2px 8px rgba(0,0,0,0.08);
          }
          .image_info {
              display: flex;
              align-items: center;
              gap: 10px;
          }
          .remove_image {
              background: #dc3545;
              color: #fff;
              border: none;
              border-radius: 8px;
              padding: 6px 14px;
              font-size: 0.95rem;
              cursor: pointer;
              transition: background 0.2s;
          }
          .remove_image:hover {
              background: #b52a37;
          }
          .form_navigation {
              display: flex;
              gap: 18px;
              justify-content: center;
              margin-top: 30px;
          }
          .btn {
              padding: 13px 28px;
              border-radius: 10px;
              font-size: 1.08rem;
              font-weight: 600;
              border: none;
              cursor: pointer;
              transition: all 0.2s;
              display: flex;
              align-items: center;
              gap: 8px;
          }
          .btn_primary {
              background: linear-gradient(90deg, #007bff 0%, #6f42c1 100%);
              color: #fff;
              box-shadow: 0 2px 8px rgba(111,66,193,0.12);
          }
          .btn_primary:hover {
              background: linear-gradient(90deg, #6f42c1 0%, #007bff 100%);
          }
          .btn_secondary {
              background: #f8fafc;
              color: #6f42c1;
              border: 2px solid #6f42c1;
          }
          .btn_secondary:hover {
              background: #e0e7ff;
          }
          .btn_submit {
              background: #28a745;
              color: #fff;
              border: none;
          }
          .btn_submit:hover {
              background: #218838;
          }
          .btn_cancel {
              background: #fff;
              color: #6c757d;
              border: 2px solid #e5e7eb;
          }
          .btn_cancel:hover {
              background: #f8fafc;
              color: #495057;
          }
          .editor_toolbar {
              display: flex;
              gap: 18px;
              align-items: center;
              margin-bottom: 8px;
          }
          .toolbar_group {
              display: flex;
              gap: 6px;
          }
          .toolbar_btn {
              background: #f8fafc;
              border: 1.5px solid #e5e7eb;
              color: #6f42c1;
              border-radius: 7px;
              padding: 7px 12px;
              font-size: 1.08rem;
              cursor: pointer;
              transition: background 0.2s, border-color 0.2s;
          }
          .toolbar_btn:hover {
              background: #e0e7ff;
              border-color: #6f42c1;
          }
          .word_count {
              color: #888;
              font-size: 0.97rem;
              margin-left: 18px;
          }
          .editor_footer {
              margin-top: 8px;
              display: flex;
              align-items: center;
              gap: 18px;
          }
          .reading_time {
              color: #007bff;
              font-size: 0.97rem;
              display: flex;
              align-items: center;
              gap: 6px;
          }
          @media (max-width: 900px) {
              .form_wizard {
                  padding: 18px 6px 18px 6px;
              }
              .create_post_section {
                  padding: 18px 0 30px 0;
              }
          }
      </style>
      <script>
          // Stepper navigation
          let currentStep = 1;
          const totalSteps = 3;
          function showStep(step) {
              document.querySelectorAll('.form_step').forEach((el, idx) => {
                  el.classList.toggle('active', idx === step - 1);
              });
              document.querySelectorAll('.progress_indicator .step').forEach((el, idx) => {
                  el.classList.toggle('active', idx === step - 1);
              });
              document.getElementById('prevBtn').style.display = step === 1 ? 'none' : 'inline-flex';
              document.getElementById('nextBtn').style.display = step === totalSteps ? 'none' : 'inline-flex';
              document.getElementById('submitBtn').style.display = step === totalSteps ? 'inline-flex' : 'none';
          }
          function changeStep(dir) {
              if (dir === 1 && currentStep < totalSteps) currentStep++;
              else if (dir === -1 && currentStep > 1) currentStep--;
              showStep(currentStep);
          }
          document.addEventListener('DOMContentLoaded', function() {
              showStep(currentStep);
              // Title char count
              const titleInput = document.getElementById('title');
              const charCount = document.querySelector('.char_count');
              titleInput.addEventListener('input', function() {
                  charCount.textContent = `${this.value.length}/100 characters`;
              });
              // Word count and reading time
              const desc = document.getElementById('description');
              const wordCount = document.getElementById('wordCount');
              const readingTime = document.getElementById('readingTime');
              desc.addEventListener('input', function() {
                  const words = this.value.trim().split(/\s+/).filter(Boolean);
                  wordCount.textContent = `${words.length} words`;
                  readingTime.textContent = `${Math.max(1, Math.round(words.length / 200))} min read`;
              });
          });
          // Image upload preview
          function handleImageSelect(input) {
              const file = input.files[0];
              if (!file) return;
              
              // Validate file type
              const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
              if (!allowedTypes.includes(file.type)) {
                  alert('Please select a JPEG or PNG image file only.');
                  input.value = '';
                  return;
              }
              
              // Validate file size (5MB = 5 * 1024 * 1024 bytes)
              const maxSize = 5 * 1024 * 1024;
              if (file.size > maxSize) {
                  alert('Image file size must not exceed 5MB. Please choose a smaller file.');
                  input.value = '';
                  return;
              }
              
              const reader = new FileReader();
              reader.onload = function(e) {
                  document.getElementById('uploadContent').style.display = 'none';
                  document.getElementById('imagePreview').style.display = 'flex';
                  document.getElementById('previewImg').src = e.target.result;
                  document.getElementById('imageName').textContent = file.name;
              };
              reader.readAsDataURL(file);
          }
          function removeImage() {
              document.getElementById('image').value = '';
              document.getElementById('imagePreview').style.display = 'none';
              document.getElementById('uploadContent').style.display = 'block';
          }
          // Editor toolbar actions (simple demo)
          function formatText(cmd) {
              document.execCommand(cmd, false, null);
          }
          function insertList(type) {
              document.execCommand(type === 'ul' ? 'insertUnorderedList' : 'insertOrderedList', false, null);
          }
      </script>
   </body>
</html>
