<!DOCTYPE html>
<html>
<head>
    @include('admin.admincss')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        body {
            background: linear-gradient(120deg, #e0e7ff 0%, #f8fafc 100%);
            min-height: 100vh;
        }
        .gradient-header {
            background: linear-gradient(90deg, #007bff 0%, #6f42c1 100%);
            color: #fff;
            padding: 40px 0 30px 0;
            text-align: center;
            border-radius: 0 0 40px 40px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.08);
            margin-bottom: 40px;
        }
        .gradient-header .fa-pen-nib {
            font-size: 2.5rem;
            margin-bottom: 10px;
        }
        .gradient-header h1 {
            font-size: 2.5rem;
            font-weight: 700;
            margin: 0;
            letter-spacing: 1px;
        }
        .gradient-header p {
            font-size: 1.1rem;
            margin-top: 10px;
            color: #e0e7ff;
        }
        .modern-card {
            max-width: 700px;
            margin: 0 auto 40px auto;
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.10);
            padding: 40px 35px 30px 35px;
            position: relative;
            z-index: 2;
        }
        .modern-card form {
            margin: 0;
        }
        .form-floating {
            position: relative;
            margin-bottom: 28px;
        }
        .form-floating input,
        .form-floating textarea,
        .form-floating select {
            width: 100%;
            padding: 18px 16px 10px 16px;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            background: #f8fafc;
            font-size: 1rem;
            transition: border-color 0.2s, box-shadow 0.2s;
            outline: none;
        }
        .form-floating input:focus,
        .form-floating textarea:focus,
        .form-floating select:focus {
            border-color: #6f42c1;
            background: #fff;
            box-shadow: 0 0 0 2px #c7d2fe;
        }
        .form-floating label {
            position: absolute;
            top: 16px;
            left: 18px;
            color: #6c757d;
            font-size: 1rem;
            pointer-events: none;
            background: transparent;
            transition: all 0.2s;
        }
        .form-floating input:not(:placeholder-shown) + label,
        .form-floating textarea:not(:placeholder-shown) + label,
        .form-floating input:focus + label,
        .form-floating textarea:focus + label,
        .form-floating select:focus + label {
            top: -10px;
            left: 12px;
            font-size: 0.85rem;
            color: #6f42c1;
            background: #fff;
            padding: 0 4px;
        }
        .form-floating textarea {
            min-height: 140px;
            resize: vertical;
        }
        .image-upload {
            margin-bottom: 28px;
        }
        .image-upload label {
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 8px;
            display: block;
        }
        .image-upload .preview {
            display: flex;
            align-items: center;
            gap: 18px;
            margin-top: 10px;
        }
        .image-upload .preview img {
            max-width: 120px;
            max-height: 120px;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }
        .image-upload .remove-btn {
            background: #dc3545;
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 6px 14px;
            font-size: 0.95rem;
            cursor: pointer;
            transition: background 0.2s;
        }
        .image-upload .remove-btn:hover {
            background: #b52a37;
        }
        .form-actions {
            display: flex;
            gap: 18px;
            justify-content: center;
            margin-top: 30px;
        }
        .btn-modern {
            padding: 14px 32px;
            border: none;
            border-radius: 10px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .btn-modern.primary {
            background: linear-gradient(90deg, #007bff 0%, #6f42c1 100%);
            color: #fff;
            box-shadow: 0 2px 8px rgba(111,66,193,0.12);
        }
        .btn-modern.primary:hover {
            background: linear-gradient(90deg, #6f42c1 0%, #007bff 100%);
        }
        .btn-modern.secondary {
            background: #f8fafc;
            color: #6f42c1;
            border: 2px solid #6f42c1;
        }
        .btn-modern.secondary:hover {
            background: #e0e7ff;
        }
        .btn-modern.cancel {
            background: #fff;
            color: #6c757d;
            border: 2px solid #e5e7eb;
        }
        .btn-modern.cancel:hover {
            background: #f8fafc;
            color: #495057;
        }
        .required {
            color: #dc3545;
            margin-left: 2px;
        }
        @media (max-width: 600px) {
            .modern-card {
                padding: 18px 6px 18px 6px;
            }
            .gradient-header {
                padding: 28px 0 18px 0;
            }
            .form-actions {
                flex-direction: column;
                gap: 12px;
            }
        }
    </style>
</head>
<body>
    <div class="gradient-header">
        <div><i class="fa fa-pen-nib"></i></div>
        <h1>Create a New Post</h1>
        <p>Share your knowledge, news, or story with the community!</p>
    </div>
    <div class="modern-card">
        @if(session()->has('message'))
            <div class="alert alert-success">
                <i class="fa fa-check-circle"></i>
                {{ session('message') }}
            </div>
        @endif
        <form action="{{ url('add_post') }}" method="POST" enctype="multipart/form-data" id="createPostForm">
            @csrf
            <div class="form-floating">
                <input type="text" id="title" name="title" class="form_input" placeholder=" " required>
                <label for="title">Post Title <span class="required">*</span></label>
            </div>
            <div class="form-floating">
                <select id="category" name="category" class="form_select" required>
                    <option value="" disabled selected>Select a category</option>
                    <option value="Technology">Technology</option>
                    <option value="Lifestyle">Lifestyle</option>
                    <option value="Business">Business</option>
                    <option value="Health">Health</option>
                    <option value="Travel">Travel</option>
                    <option value="Education">Education</option>
                </select>
                <label for="category">Category <span class="required">*</span></label>
            </div>
            <div class="image-upload">
                <label for="image">Featured Image</label>
                <input type="file" id="image" name="image" accept="image/jpeg,image/png,image/jpg" style="display:none;" onchange="previewImage(event)">
                <div class="file_input_content" onclick="document.getElementById('image').click()" style="cursor:pointer;">
                    <div class="file_icon">📸</div>
                    <div class="file_text">Click to select an image or drag and drop</div>
                </div>
                <div class="preview" id="imagePreview" style="display:none;"></div>
            </div>
            <div class="form-floating">
                <textarea id="description" name="description" class="form_textarea" placeholder=" " required></textarea>
                <label for="description">Post Content <span class="required">*</span></label>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn-modern primary">
                    <i class="fa fa-paper-plane"></i> Publish Post
                </button>
                <button type="button" class="btn-modern secondary" onclick="saveDraft()">
                    <i class="fa fa-save"></i> Save Draft
                </button>
                <a href="{{ route('admin.show_posts') }}" class="btn-modern cancel">
                    <i class="fa fa-times"></i> Cancel
                </a>
            </div>
        </form>
    </div>
    <script>
        function previewImage(event) {
            const input = event.target;
            const preview = document.getElementById('imagePreview');
            preview.innerHTML = '';
            
            if (input.files && input.files[0]) {
                const file = input.files[0];
                
                // Validate file type
                const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
                if (!allowedTypes.includes(file.type)) {
                    alert('Please select a JPEG or PNG image file only.');
                    input.value = '';
                    preview.style.display = 'none';
                    return;
                }
                
                // Validate file size (5MB = 5 * 1024 * 1024 bytes)
                const maxSize = 5 * 1024 * 1024;
                if (file.size > maxSize) {
                    alert('Image file size must not exceed 5MB. Please choose a smaller file.');
                    input.value = '';
                    preview.style.display = 'none';
                    return;
                }
                
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.innerHTML = `<img src="${e.target.result}" alt="Preview"> <button type='button' class='remove-btn' onclick='removeImage()'>Remove</button>`;
                    preview.style.display = 'flex';
                }
                reader.readAsDataURL(file);
            } else {
                preview.style.display = 'none';
            }
        }
        function removeImage() {
            const input = document.getElementById('image');
            input.value = '';
            document.getElementById('imagePreview').style.display = 'none';
        }
        function saveDraft() {
            alert('Draft saved successfully! (This is a placeholder - implement draft functionality as needed)');
        }
    </script>
</body>
</html>