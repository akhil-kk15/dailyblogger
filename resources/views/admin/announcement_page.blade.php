<!DOCTYPE html>
<html>
  <head> 
   @include('admin.admincss')
   <style type="text/css">
    .page-content {
        padding: 30px;
        min-height: 80vh;
    }
    .announcement_title {
        font-size: 30px;
        text-align: center;
        padding: 20px;
        font-family: "Muli", sans-serif;
        color: #333;
        margin-bottom: 30px;
    }
    .form-container {
        max-width: 800px;
        margin: 0 auto;
        background: #fff;
        padding: 40px;
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    .form-group {
        margin-bottom: 25px;
    }
    .form-group label {
        display: block;
        color: #2c3e50;
        font-weight: 600;
        margin-bottom: 8px;
        font-size: 1rem;
    }
    .form-group input,
    .form-group select,
    .form-group textarea {
        width: 100%;
        padding: 12px 15px;
        border: 2px solid #e1e8ed;
        border-radius: 8px;
        font-size: 1rem;
        color: #2c3e50;
        transition: border-color 0.3s ease;
    }
    .form-group input:focus,
    .form-group select:focus,
    .form-group textarea:focus {
        outline: none;
        border-color: #3498db;
        box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.1);
    }
    .form-group textarea {
        min-height: 120px;
        resize: vertical;
    }
    .submit-btn {
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
    .submit-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
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
    <header class="header">   
     @include('admin.header')
    </header>
    <div class="d-flex align-items-stretch">
      <!-- Sidebar Navigation-->
      @include('admin.sidebar')
      <!-- Sidebar Navigation end-->
     <div class="page-content">
        <h1 class="announcement_title">Create Announcement</h1>
        
        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
        
        <div class="requirements">
            <h4>📢 Announcement Guidelines</h4>
            <ul>
                <li>Announcements will be visible to all users on the platform</li>
                <li>Use appropriate priority levels - urgent should be used sparingly</li>
                <li>Set expiration dates for time-sensitive announcements</li>
                <li>Keep content clear and concise for better user engagement</li>
            </ul>
        </div>
        
        <div class="form-container">
            <form action="{{ route('admin.store_announcement') }}" method="POST">
                @csrf
                
                <div class="form-group">
                    <label for="title">Announcement Title *</label>
                    <input type="text" id="title" name="title" value="{{ old('title') }}" 
                           placeholder="Enter announcement title" required>
                    @error('title')
                        <span style="color: #dc3545; font-size: 12px;">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="content">Announcement Content *</label>
                    <textarea id="content" name="content" placeholder="Enter announcement content" 
                              required>{{ old('content') }}</textarea>
                    @error('content')
                        <span style="color: #dc3545; font-size: 12px;">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="priority">Priority *</label>
                    <select id="priority" name="priority" required>
                        <option value="">Select Priority</option>
                        <option value="low" {{ old('priority') == 'low' ? 'selected' : '' }}>Low</option>
                        <option value="normal" {{ old('priority') == 'normal' ? 'selected' : '' }}>Normal</option>
                        <option value="high" {{ old('priority') == 'high' ? 'selected' : '' }}>High</option>
                        <option value="urgent" {{ old('priority') == 'urgent' ? 'selected' : '' }}>Urgent</option>
                    </select>
                    @error('priority')
                        <span style="color: #dc3545; font-size: 12px;">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="type">Announcement Type *</label>
                    <select id="type" name="type" required>
                        <option value="">Select Type</option>
                        <option value="general" {{ old('type') == 'general' ? 'selected' : '' }}>General</option>
                        <option value="maintenance" {{ old('type') == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                        <option value="feature" {{ old('type') == 'feature' ? 'selected' : '' }}>New Feature</option>
                        <option value="important" {{ old('type') == 'important' ? 'selected' : '' }}>Important</option>
                    </select>
                    @error('type')
                        <span style="color: #dc3545; font-size: 12px;">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="expires_at">Expiration Date (Optional)</label>
                    <input type="datetime-local" id="expires_at" name="expires_at" 
                           value="{{ old('expires_at') }}" 
                           min="{{ now()->format('Y-m-d\TH:i') }}">
                    @error('expires_at')
                        <span style="color: #dc3545; font-size: 12px;">{{ $message }}</span>
                    @enderror
                    <small style="color: #6c757d; font-size: 0.85rem;">Leave blank if the announcement should not expire</small>
                </div>
                
                <div class="form-group">
                    <button type="submit" class="submit-btn">
                        📢 Create Announcement
                    </button>
                </div>
            </form>
        </div>
        
      </div>
    </div>
    @include('admin.footer')
  </body>
</html>
