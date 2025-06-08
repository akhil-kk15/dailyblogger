<!DOCTYPE html>
<html>
  <head> 
   @include('admin.admincss')
   <style type="text/css">
    .page-content {
        padding: 30px;
    }
    .announcements_title {
        font-size: 30px;
        text-align: center;
        padding: 20px;
        font-family: "Muli", sans-serif;
        color: #333;
    }
    .announcements_table {
        width: 100%;
        margin-top: 20px;
        border-collapse: collapse;
        background: #fff;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 0 20px rgba(0,0,0,0.1);
    }
    .announcements_table th {
        background: #343a40;
        color: #fff;
        padding: 15px;
        text-align: left;
        font-weight: 600;
    }
    .announcements_table td {
        padding: 15px;
        border-bottom: 1px solid #eee;
        vertical-align: middle;
    }
    .announcements_table tr:hover {
        background: #f8f9fa;
    }
    .announcement_title {
        font-weight: 600;
        max-width: 200px;
        word-wrap: break-word;
    }
    .announcement_content {
        max-width: 300px;
        word-wrap: break-word;
        line-height: 1.4;
    }
    .priority_badge, .type_badge {
        padding: 4px 8px;
        border-radius: 12px;
        font-size: 11px;
        font-weight: 600;
        text-transform: uppercase;
        color: white;
    }
    .status_badge {
        padding: 5px 10px;
        border-radius: 15px;
        font-size: 12px;
        font-weight: 600;
        text-transform: uppercase;
    }
    .status_active {
        background: #28a745;
        color: white;
    }
    .status_inactive {
        background: #6c757d;
        color: white;
    }
    .action_buttons {
        display: flex;
        gap: 5px;
        flex-wrap: wrap;
    }
    .btn_action {
        padding: 6px 10px;
        border: none;
        border-radius: 3px;
        font-size: 11px;
        cursor: pointer;
        text-decoration: none;
        display: inline-block;
        text-align: center;
        min-width: 60px;
    }
    .btn_toggle {
        background: #ffc107;
        color: #212529;
    }
    .btn_toggle:hover {
        background: #e0a800;
        color: #212529;
    }
    .btn_delete {
        background: #dc3545;
        color: white;
    }
    .btn_delete:hover {
        background: #c82333;
        color: white;
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
    .pagination_wrapper {
        margin-top: 20px;
        display: flex;
        justify-content: center;
    }
    .no_announcements {
        text-align: center;
        padding: 50px;
        color: #666;
        font-size: 18px;
    }
    .expired_text {
        color: #dc3545;
        font-size: 11px;
        font-style: italic;
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
        <h1 class="announcements_title">Manage Announcements</h1>
        
        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
        
        @if($announcements->count() > 0)
            <div style="overflow-x: auto;">
                <table class="announcements_table">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Content</th>
                            <th>Priority</th>
                            <th>Type</th>
                            <th>Status</th>
                            <th>Created By</th>
                            <th>Expires</th>
                            <th>Created</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($announcements as $announcement)
                            <tr>
                                <td class="announcement_title">{{ $announcement->title }}</td>
                                <td class="announcement_content">{{ Str::limit($announcement->content, 100) }}</td>
                                <td>
                                    <span class="priority_badge" style="background-color: {{ $announcement->priority_color }}">
                                        {{ ucfirst($announcement->priority) }}
                                    </span>
                                </td>
                                <td>
                                    <span class="type_badge" style="background-color: {{ $announcement->type_color }}">
                                        {{ ucfirst($announcement->type) }}
                                    </span>
                                </td>
                                <td>
                                    <span class="status_badge {{ $announcement->is_active ? 'status_active' : 'status_inactive' }}">
                                        {{ $announcement->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                    @if($announcement->expires_at && $announcement->expires_at->isPast())
                                        <br><small class="expired_text">Expired</small>
                                    @endif
                                </td>
                                <td>
                                    <strong>{{ $announcement->creator->name }}</strong><br>
                                    <small style="color: #666;">{{ ucfirst($announcement->creator->usertype) }}</small>
                                </td>
                                <td>
                                    @if($announcement->expires_at)
                                        {{ $announcement->expires_at->format('M d, Y H:i') }}
                                        @if($announcement->expires_at->isPast())
                                            <br><small class="expired_text">Expired</small>
                                        @elseif($announcement->expires_at->isToday())
                                            <br><small style="color: #ffc107;">Expires today</small>
                                        @endif
                                    @else
                                        <small style="color: #28a745;">Permanent</small>
                                    @endif
                                </td>
                                <td>{{ $announcement->created_at->format('M d, Y') }}</td>
                                <td>
                                    <div class="action_buttons">
                                        <form action="{{ route('admin.toggle_announcement', $announcement->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            <button type="submit" class="btn_action btn_toggle" 
                                                    onclick="return confirm('Are you sure you want to {{ $announcement->is_active ? 'deactivate' : 'activate' }} this announcement?')">
                                                {{ $announcement->is_active ? 'Deactivate' : 'Activate' }}
                                            </button>
                                        </form>
                                        
                                        <form action="{{ route('admin.delete_announcement', $announcement->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn_action btn_delete" 
                                                    onclick="return confirm('Are you sure you want to delete this announcement? This action cannot be undone.')">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="pagination_wrapper">
                {{ $announcements->links() }}
            </div>
        @else
            <div class="no_announcements">
                <p>No announcements found.</p>
                <a href="{{ route('admin.announcement_page') }}" class="btn btn-primary">Create First Announcement</a>
            </div>
        @endif
        
      </div>
    </div>
    @include('admin.footer')
  </body>
</html>
