<!DOCTYPE html>
<html>
  <head> 
   @include('admin.admincss')
   <style type="text/css">
    .page-content {
        padding: 30px;
    }
    .posts_title {
        font-size: 30px;
        text-align: center;
        padding: 20px;
        font-family: "Muli", sans-serif;
        color: #333;
    }
    .posts_table {
        width: 100%;
        margin-top: 20px;
        border-collapse: collapse;
        background: #fff;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 0 20px rgba(0,0,0,0.1);
    }
    .posts_table th {
        background: #343a40;
        color: #fff;
        padding: 15px;
        text-align: left;
        font-weight: 600;
    }
    .posts_table td {
        padding: 15px;
        border-bottom: 1px solid #eee;
        vertical-align: middle;
    }
    .posts_table tr:hover {
        background: #f8f9fa;
    }
    .post_image {
        width: 80px;
        height: 60px;
        object-fit: cover;
        border-radius: 4px;
    }
    .post_title {
        font-weight: 600;
        max-width: 200px;
        word-wrap: break-word;
    }
    .post_description {
        max-width: 250px;
        word-wrap: break-word;
        line-height: 1.4;
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
    .status_pending {
        background: #ffc107;
        color: #212529;
    }
    .status_rejected {
        background: #dc3545;
        color: white;
    }
    .action_buttons {
        display: flex;
        gap: 5px;
        flex-wrap: wrap;
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
    }
    .btn_approve {
        background: #28a745;
        color: white;
    }
    .btn_approve:hover {
        background: #218838;
        color: white;
    }
    .btn_reject {
        background: #ffc107;
        color: #212529;
    }
    .btn_reject:hover {
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
    .no_posts {
        text-align: center;
        padding: 50px;
        color: #666;
        font-size: 18px;
    }
    .reject_dropdown {
        position: relative;
        display: inline-block;
    }
    .reject_btn {
        background: #ffc107;
        color: #212529;
        padding: 8px 12px;
        border: none;
        border-radius: 4px;
        font-size: 12px;
        cursor: pointer;
        text-decoration: none;
        display: inline-block;
        text-align: center;
        min-width: 70px;
    }
    .reject_btn:hover {
        background: #e0a800;
        color: #212529;
    }
    .reject_content {
        display: none;
        position: absolute;
        background-color: #f9f9f9;
        min-width: 300px;
        box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
        z-index: 1000;
        right: 0;
        border-radius: 4px;
        padding: 15px;
        top: 100%;
        margin-top: 5px;
    }
    .reject_content.show {
        display: block;
    }
    .reject_form_group {
        margin-bottom: 15px;
    }
    .reject_form_group label {
        display: block;
        font-weight: 600;
        margin-bottom: 5px;
        color: #333;
    }
    .reject_form_group select,
    .reject_form_group textarea {
        width: 100%;
        padding: 8px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 14px;
    }
    .reject_form_group textarea {
        height: 60px;
        resize: vertical;
    }
    .reject_form_buttons {
        display: flex;
        gap: 10px;
        justify-content: flex-end;
    }
    .reject_form_buttons button {
        padding: 8px 15px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 12px;
    }
    .btn_reject_confirm {
        background: #dc3545;
        color: white;
    }
    .btn_reject_cancel {
        background: #6c757d;
        color: white;
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
        <h1 class="posts_title">Manage Posts</h1>
        
        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
        
        @if($posts->count() > 0)
            <div style="overflow-x: auto;">
                <table class="posts_table">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Category/Tags</th>
                            <th>Author</th>
                            <th>Status</th>
                            <th>Created</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($posts as $post)
                            <tr>
                                <td>
                                    @if($post->image)
                                        <img src="{{ asset('postimage/' . $post->image) }}" alt="Post Image" class="post_image">
                                    @else
                                        <div style="width: 80px; height: 60px; background: #f8f9fa; border-radius: 4px; display: flex; align-items: center; justify-content: center; color: #666; font-size: 12px;">No Image</div>
                                    @endif
                                </td>
                                <td class="post_title">{{ $post->title }}</td>
                                <td class="post_description">{{ Str::limit($post->description, 100) }}</td>
                                <td>
                                    @if($post->category)
                                        <div style="margin-bottom: 8px;">
                                            <i class="fa fa-folder" style="color: #007bff; margin-right: 4px;"></i>
                                            <span style="color: #007bff; font-weight: 600; font-size: 12px;">{{ $post->category->name }}</span>
                                        </div>
                                    @endif
                                    @if($post->tags->count() > 0)
                                        <div>
                                            @foreach($post->tags->take(2) as $tag)
                                                <span style="background-color: {{ $tag->color }}; color: #fff; padding: 2px 6px; border-radius: 8px; font-size: 10px; margin-right: 2px; display: inline-block;">
                                                    {{ $tag->name }}
                                                </span>
                                            @endforeach
                                            @if($post->tags->count() > 2)
                                                <span style="font-size: 10px; color: #666;">+{{ $post->tags->count() - 2 }}</span>
                                            @endif
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    <strong>{{ $post->name }}</strong><br>
                                    <small style="color: #666;">{{ ucfirst($post->usertype) }}</small>
                                </td>
                                <td>
                                    <span class="status_badge status_{{ $post->post_status }}">
                                        {{ ucfirst($post->post_status) }}
                                    </span>
                                </td>
                                <td>{{ $post->created_at->format('M d, Y') }}</td>
                                <td>
                                    <div class="action_buttons">
                                        @if($post->post_status == 'pending')
                                            <form action="{{ route('admin.approve_post', $post->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                <button type="submit" class="btn_action btn_approve" onclick="return confirm('Are you sure you want to approve this post?')">Approve</button>
                                            </form>
                                            <div class="reject_dropdown">
                                                <button type="button" class="reject_btn" onclick="toggleRejectForm('{{ $post->id }}')">Reject</button>
                                                <div id="rejectForm{{ $post->id }}" class="reject_content">
                                                    <form action="{{ route('admin.reject_post_with_reason', $post->id) }}" method="POST">
                                                        @csrf
                                                        <div class="reject_form_group">
                                                            <label for="rejection_reason_{{ $post->id }}">Rejection Reason:</label>
                                                            <select id="rejection_reason_select_{{ $post->id }}" onchange="handleReasonSelect('{{ $post->id }}')">
                                                                <option value="">Select a reason...</option>
                                                                <option value="Inappropriate content">Inappropriate content</option>
                                                                <option value="Spam or low quality">Spam or low quality</option>
                                                                <option value="Copyright violation">Copyright violation</option>
                                                                <option value="Incorrect information">Incorrect information</option>
                                                                <option value="Does not meet guidelines">Does not meet guidelines</option>
                                                                <option value="custom">Custom reason...</option>
                                                            </select>
                                                        </div>
                                                        <div class="reject_form_group">
                                                            <textarea name="rejection_reason" id="rejection_reason_{{ $post->id }}" placeholder="Enter rejection reason..." required></textarea>
                                                        </div>
                                                        <div class="reject_form_buttons">
                                                            <button type="button" class="btn_reject_cancel" onclick="toggleRejectForm('{{ $post->id }}')">Cancel</button>
                                                            <button type="submit" class="btn_reject_confirm">Reject Post</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        @elseif($post->post_status == 'active')
                                            <div class="reject_dropdown">
                                                <button type="button" class="reject_btn" onclick="toggleRejectForm('{{ $post->id }}')">Reject</button>
                                                <div id="rejectForm{{ $post->id }}" class="reject_content">
                                                    <form action="{{ route('admin.reject_post_with_reason', $post->id) }}" method="POST">
                                                        @csrf
                                                        <div class="reject_form_group">
                                                            <label for="rejection_reason_{{ $post->id }}">Rejection Reason:</label>
                                                            <select id="rejection_reason_select_{{ $post->id }}" onchange="handleReasonSelect('{{ $post->id }}')">
                                                                <option value="">Select a reason...</option>
                                                                <option value="Inappropriate content">Inappropriate content</option>
                                                                <option value="Spam or low quality">Spam or low quality</option>
                                                                <option value="Copyright violation">Copyright violation</option>
                                                                <option value="Incorrect information">Incorrect information</option>
                                                                <option value="Does not meet guidelines">Does not meet guidelines</option>
                                                                <option value="custom">Custom reason...</option>
                                                            </select>
                                                        </div>
                                                        <div class="reject_form_group">
                                                            <textarea name="rejection_reason" id="rejection_reason_{{ $post->id }}" placeholder="Enter rejection reason..." required></textarea>
                                                        </div>
                                                        <div class="reject_form_buttons">
                                                            <button type="button" class="btn_reject_cancel" onclick="toggleRejectForm('{{ $post->id }}')">Cancel</button>
                                                            <button type="submit" class="btn_reject_confirm">Reject Post</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        @elseif($post->post_status == 'rejected')
                                            <form action="{{ route('admin.approve_post', $post->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                <button type="submit" class="btn_action btn_approve" onclick="return confirm('Are you sure you want to approve this post?')">Approve</button>
                                            </form>
                                            @if($post->rejection_reason)
                                                <div style="margin-top: 10px;">
                                                    <small style="color: #dc3545; font-weight: 600;">Reason: {{ $post->rejection_reason }}</small>
                                                </div>
                                            @endif
                                        @endif
                                        
                                        <form action="{{ route('admin.delete_post', $post->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn_action btn_delete" onclick="return confirm('Are you sure you want to delete this post? This action cannot be undone.')">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="pagination_wrapper">
                {{ $posts->links() }}
            </div>
        @else
            <div class="no_posts">
                <p>No posts found.</p>
                <a href="{{ route('admin.post_page') }}" class="btn btn-primary">Create First Post</a>
            </div>
        @endif
        
      </div>
    </div>
    @include('admin.footer')
    
    <script>
        function toggleRejectForm(postId) {
            const form = document.getElementById('rejectForm' + postId);
            const allForms = document.querySelectorAll('.reject_content');
            
            // Close all other forms
            allForms.forEach(f => {
                if (f.id !== 'rejectForm' + postId) {
                    f.classList.remove('show');
                }
            });
            
            // Toggle current form
            form.classList.toggle('show');
        }
        
        function handleReasonSelect(postId) {
            const select = document.getElementById('rejection_reason_select_' + postId);
            const textarea = document.getElementById('rejection_reason_' + postId);
            
            if (select.value === 'custom') {
                textarea.value = '';
                textarea.placeholder = 'Enter custom rejection reason...';
                textarea.focus();
            } else if (select.value !== '') {
                textarea.value = select.value;
            } else {
                textarea.value = '';
                textarea.placeholder = 'Enter rejection reason...';
            }
        }
        
        // Close dropdowns when clicking outside
        document.addEventListener('click', function(event) {
            if (!event.target.closest('.reject_dropdown')) {
                document.querySelectorAll('.reject_content').forEach(form => {
                    form.classList.remove('show');
                });
            }
        });
    </script>
  </body>
</html>
