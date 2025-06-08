<!DOCTYPE html>
<html>
  <head> 
   @include('admin.admincss')
   <style type ="text/css">

.page-content{
    align-items: center;
    display: flex;
    flex-direction: column;
    justify-content: center;
    min-height: 100vh;
}    
.announcement_title{
        font-size: 60px;
        text-align: center;
        padding: 30px;
        font-family: "Muli",sans-serif;
    }
     .div_center{
        text-align: center;
        padding: 10px;
        width: 100%;
    }
    
    .form-container {
        background: #fff;
        padding: 40px;
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        max-width: 800px;
        width: 100%;
    }
    
    .form-group {
        margin-bottom: 20px;
        text-align: left;
    }
    
    .form-group label {
        display: block;
        font-weight: 600;
        margin-bottom: 8px;
        color: #333;
    }
    
    .form-group input,
    .form-group select,
    .form-group textarea {
        width: 100%;
        padding: 12px;
        border: 1px solid #ddd;
        border-radius: 5px;
        font-size: 14px;
    }
    
    .form-group textarea {
        height: 120px;
        resize: vertical;
    }
    
    .priority-info, .type-info {
        font-size: 12px;
        color: #666;
        margin-top: 5px;
    }
    
    .btn-submit {
        background: #007bff;
        color: white;
        padding: 12px 30px;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
        margin-top: 20px;
    }
    
    .btn-submit:hover {
        background: #0056b3;
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
    </style>
  </head>
  <body>
    <header class="header">   
     @include('admin.header ')
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
                    <div class="priority-info">
                        Low: General information | Normal: Regular updates | High: Important notices | Urgent: Critical alerts
                    </div>
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
                    <div class="type-info">
                        General: Regular announcements | Maintenance: System updates | Feature: New features | Important: Critical information
                    </div>
                    @error('type')
                        <span style="color: #dc3545; font-size: 12px;">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="expires_at">Expiry Date (Optional)</label>
                    <input type="datetime-local" id="expires_at" name="expires_at" 
                           value="{{ old('expires_at') }}"
                           min="{{ now()->format('Y-m-d\TH:i') }}">
                    <div class="priority-info">
                        Leave empty for permanent announcement. After expiry, announcement will be automatically hidden.
                    </div>
                    @error('expires_at')
                        <span style="color: #dc3545; font-size: 12px;">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="div_center">
                    <button type="submit" class="btn-submit">
                        📢 Create Announcement & Notify Users
                    </button>
                </div>
            </form>
        </div>    
    </div>
      @include('admin.footer')
  </body>
</html>
