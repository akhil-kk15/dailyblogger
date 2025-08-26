<!DOCTYPE html>
<html>
  <head> 
   @include('admin.admincss')
   <style type="text/css">
    .page-content {
        padding: 30px;
    }
    .comments_title {
        font-size: 30px;
        text-align: center;
        padding: 20px;
        font-family: "Muli", sans-serif;
        color: #333;
    }
    .comments_table {
        width: 100%;
        margin-top: 20px;
        border-collapse: collapse;
        background: #f8f9fa;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 0 20px rgba(0,0,0,0.1);
    }
    .comments_table th {
        background: #343a40;
        color: #fff;
        padding: 15px;
        text-align: left;
        font-weight: 600;
    }
    .comments_table td {
        padding: 15px;
        border-bottom: 1px solid #eee;
        vertical-align: middle;
    }
    .comments_table tr:hover {
        background: #f8f9fa;
    }
    .comment_text {
        max-width: 300px;
        word-wrap: break-word;
        line-height: 1.4;
    }
    .comment_author {
        font-weight: 600;
        color: #333;
    }
    .comment_post {
        font-weight: 600;
        color: #007bff;
        max-width: 200px;
        word-wrap: break-word;
    }
    .admin_badge {
        background: #dc3545;
        color: white;
        padding: 2px 8px;
        border-radius: 10px;
        font-size: 10px;
        font-weight: bold;
        text-transform: uppercase;
        margin-left: 5px;
    }
    .btn_action {
        padding: 8px 12px;
        border: none;
        border-radius: 4px;
        font-size: 12px;
        cursor: pointer;
        text-decoration: none;
        display: inline-block;
        text-align: center;
        min-width: 70px;
        margin-right: 5px;
    }
    .btn_delete {
        background: #dc3545;
        color: white;
    }
    .btn_delete:hover {
        background: #c82333;
        color: white;
    }
    .btn_view {
        background: #007bff;
        color: white;
    }
    .btn_view:hover {
        background: #0056b3;
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
        margin-top: 30px;
        margin-bottom: 20px;
        display: flex;
        justify-content: center;
    }
    
    .pagination_wrapper .pagination {
        display: flex;
        list-style: none;
        padding: 0;
        gap: 12px;
    }
    
    .pagination_wrapper .pagination li {
        margin: 0;
    }
    
    .pagination_wrapper .pagination li a,
    .pagination_wrapper .pagination li span {
        display: flex;
        align-items: center;
        justify-content: center;
        min-width: 50px;
        height: 45px;
        padding: 10px 16px;
        background-color: #2b2278;
        color: #ffffff;
        text-decoration: none;
        border-radius: 30px;
        font-weight: bold;
        font-size: 16px;
        text-transform: uppercase;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(43, 34, 120, 0.3);
    }
    
    .pagination_wrapper .pagination li a:hover {
        background-color: #000d10;
        color: #ffffff;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(0, 13, 16, 0.4);
    }
    
    .pagination_wrapper .pagination li.active a,
    .pagination_wrapper .pagination li.active span {
        background-color: #000d10;
        color: #ffffff;
        box-shadow: 0 6px 20px rgba(0, 13, 16, 0.4);
    }
    
    .pagination_wrapper .pagination li.disabled a,
    .pagination_wrapper .pagination li.disabled span {
        background-color: #6c757d;
        color: #ffffff;
        cursor: not-allowed;
        opacity: 0.6;
    }
    
    .pagination_wrapper .pagination li.disabled a:hover {
        background-color: #6c757d;
        transform: none;
        box-shadow: 0 4px 15px rgba(108, 117, 125, 0.3);
    }
    
    /* Previous/Next button styling */
    .pagination_wrapper .pagination li:first-child a,
    .pagination_wrapper .pagination li:last-child a {
        min-width: 80px;
        font-size: 14px;
    }
    
    /* Responsive pagination for mobile */
    @media (max-width: 768px) {
        .pagination_wrapper {
            margin-top: 20px;
            margin-bottom: 15px;
        }
        
        .pagination_wrapper .pagination li a,
        .pagination_wrapper .pagination li span {
            min-width: 40px;
            height: 40px;
            padding: 8px 12px;
            font-size: 14px;
        }
        
        .pagination_wrapper .pagination li:first-child a,
        .pagination_wrapper .pagination li:last-child a {
            min-width: 70px;
            font-size: 12px;
        }
        
        .pagination_wrapper .pagination {
            gap: 8px;
        }
    }
    .no_comments {
        text-align: center;
        padding: 50px;
        color: #666;
        font-size: 18px;
    }
    .comment_meta {
        font-size: 12px;
        color: #666;
    }
    .stats_cards {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }
    .stat_card {
        background: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        text-align: center;
    }
    .stat_number {
        font-size: 32px;
        font-weight: bold;
        color: #007bff;
        margin-bottom: 5px;
    }
    .stat_label {
        color: #666;
        font-size: 14px;
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
        <h1 class="comments_title">Comment Moderation</h1>
        
        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
        
        <!-- Statistics Cards -->
        <div class="stats_cards">
            <div class="stat_card">
                <div class="stat_number">{{ $comments->total() }}</div>
                <div class="stat_label">Total Comments</div>
            </div>
            <div class="stat_card">
                <div class="stat_number">{{ $comments->where('created_at', '>=', now()->subDay())->count() }}</div>
                <div class="stat_label">Today's Comments</div>
            </div>
            <div class="stat_card">
                <div class="stat_number">{{ $comments->where('created_at', '>=', now()->subWeek())->count() }}</div>
                <div class="stat_label">This Week</div>
            </div>
        </div>
        
        @if($comments->count() > 0)
            <div style="overflow-x: auto;">
                <table class="comments_table">
                    <thead>
                        <tr>
                            <th>Author</th>
                            <th>Comment</th>
                            <th>Post</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($comments as $comment)
                            <tr id="comment-row-{{ $comment->id }}">
                                <td>
                                    <div class="comment_author">
                                        {{ $comment->user_name }}
                                        @if($comment->user && $comment->user->usertype === 'admin')
                                            <span class="admin_badge">Admin</span>
                                        @endif
                                    </div>
                                    @if($comment->user)
                                        <div class="comment_meta">{{ $comment->user->email }}</div>
                                    @endif
                                </td>
                                <td>
                                    <div class="comment_text">{{ Str::limit($comment->comment, 150) }}</div>
                                </td>
                                <td>
                                    @if($comment->post)
                                        <div class="comment_post">
                                            <a href="{{ route('home.post_details', $comment->post->id) }}" target="_blank">
                                                {{ Str::limit($comment->post->title, 50) }}
                                            </a>
                                        </div>
                                        <div class="comment_meta">by {{ $comment->post->name }}</div>
                                    @else
                                        <span style="color: #dc3545;">Post Deleted</span>
                                    @endif
                                </td>
                                <td>
                                    <div>{{ $comment->created_at->format('M d, Y') }}</div>
                                    <div class="comment_meta">{{ $comment->created_at->format('h:i A') }}</div>
                                </td>
                                <td>
                                    <div style="display: flex; gap: 5px; flex-wrap: wrap;">
                                        @if($comment->post)
                                            <a href="{{ route('home.post_details', $comment->post->id) }}" target="_blank" class="btn_action btn_view">View Post</a>
                                        @endif
                                        <button class="btn_action btn_delete delete-comment-btn" data-comment-id="{{ $comment->id }}">Delete</button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="pagination_wrapper">
                {{ $comments->links('custom-pagination') }}
            </div>
        @else
            <div class="no_comments">
                <p>No comments found.</p>
            </div>
        @endif
        
      </div>
    </div>
    @include('admin.footer')
    
    <script>
        // Initialize event listeners when DOM is loaded
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.delete-comment-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const commentId = this.getAttribute('data-comment-id');
                    deleteComment(commentId);
                });
            });
        });
        
        function deleteComment(commentId) {
            if (confirm('Are you sure you want to delete this comment? This action cannot be undone.')) {
                // Check if CSRF token exists
                const csrfToken = document.querySelector('meta[name="csrf-token"]');
                if (!csrfToken) {
                    alert('CSRF token not found. Please refresh the page and try again.');
                    return;
                }
                
                fetch(`/admin/comments/${commentId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken.getAttribute('content'),
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        // Remove the comment row from the table
                        const commentRow = document.getElementById('comment-row-' + commentId);
                        if (commentRow) {
                            commentRow.remove();
                        }
                        
                        // Show success message
                        showAlert('Comment deleted successfully!');
                        
                        // Reload page if no comments left
                        const remainingRows = document.querySelectorAll('[id^="comment-row-"]');
                        if (remainingRows.length === 0) {
                            setTimeout(() => location.reload(), 2000);
                        }
                    } else {
                        alert('Error deleting comment: ' + (data.message || 'Unknown error'));
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error deleting comment: ' + error.message);
                });
            }
        }
        
        function showAlert(message) {
            const alertDiv = document.createElement('div');
            alertDiv.className = 'alert alert-success';
            alertDiv.textContent = message;
            
            const pageContent = document.querySelector('.page-content');
            const title = document.querySelector('.comments_title');
            pageContent.insertBefore(alertDiv, title.nextSibling);
            
            // Auto-dismiss after 5 seconds
            setTimeout(() => {
                if (alertDiv.parentNode) {
                    alertDiv.remove();
                }
            }, 5000);
        }
    </script>
  </body>
</html>
