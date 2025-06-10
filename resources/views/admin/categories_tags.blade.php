<!DOCTYPE html>
<html>
  <head> 
    @include('admin.admincss')
    <style>
        .management_section {
            background: #fff;
            border-radius: 12px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 4px 16px rgba(0,0,0,0.1);
        }
        
        .section_header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 2px solid #f1f3f4;
        }
        
        .section_title {
            font-size: 1.8rem;
            font-weight: 700;
            color: #2c3e50;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .add_btn {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .add_btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
        }
        
        .items_grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }
        
        .item_card {
            background: #f8f9fa;
            border: 2px solid #e9ecef;
            border-radius: 12px;
            padding: 20px;
            transition: all 0.3s ease;
            position: relative;
        }
        
        .item_card:hover {
            border-color: #667eea;
            transform: translateY(-3px);
            box-shadow: 0 6px 25px rgba(102, 126, 234, 0.15);
        }
        
        .item_name {
            font-size: 1.2rem;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 8px;
        }
        
        .item_meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
            font-size: 0.9rem;
            color: #6c757d;
        }
        
        .item_slug {
            background: #e3f2fd;
            color: #1565c0;
            padding: 4px 8px;
            border-radius: 6px;
            font-family: monospace;
            font-size: 0.8rem;
        }
        
        .posts_count {
            background: #e8f5e8;
            color: #2e7d32;
            padding: 4px 8px;
            border-radius: 6px;
            font-weight: 600;
        }
        
        .item_actions {
            display: flex;
            gap: 10px;
        }
        
        .action_btn {
            padding: 8px 16px;
            border: none;
            border-radius: 6px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 0.9rem;
        }
        
        .edit_btn {
            background: #ffc107;
            color: #212529;
        }
        
        .edit_btn:hover {
            background: #e0a800;
        }
        
        .delete_btn {
            background: #dc3545;
            color: white;
        }
        
        .delete_btn:hover {
            background: #c82333;
        }
        
        .status_badge {
            position: absolute;
            top: 15px;
            right: 15px;
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 0.75rem;
            font-weight: 600;
        }
        
        .status_active {
            background: #d4edda;
            color: #155724;
        }
        
        .status_inactive {
            background: #f8d7da;
            color: #721c24;
        }
        
        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.5);
        }
        
        .modal_content {
            background-color: #fff;
            margin: 5% auto;
            padding: 30px;
            border-radius: 12px;
            width: 90%;
            max-width: 500px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
        }
        
        .modal_header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 2px solid #f1f3f4;
        }
        
        .modal_title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #2c3e50;
        }
        
        .close_btn {
            background: none;
            border: none;
            font-size: 24px;
            color: #6c757d;
            cursor: pointer;
            transition: color 0.3s ease;
        }
        
        .close_btn:hover {
            color: #dc3545;
        }
        
        .form_group {
            margin-bottom: 20px;
        }
        
        .form_label {
            display: block;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 8px;
        }
        
        .form_input {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid #e9ecef;
            border-radius: 8px;
            font-size: 1rem;
            transition: border-color 0.3s ease;
        }
        
        .form_input:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }
        
        .form_actions {
            display: flex;
            gap: 15px;
            justify-content: flex-end;
            margin-top: 30px;
        }
        
        .btn_primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .btn_primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
        }
        
        .btn_secondary {
            background: #6c757d;
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .btn_secondary:hover {
            background: #5a6268;
        }
        
        .notification {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 15px 20px;
            border-radius: 8px;
            color: white;
            font-weight: 600;
            z-index: 1001;
            transform: translateX(400px);
            transition: transform 0.3s ease;
        }
        
        .notification.show {
            transform: translateX(0);
        }
        
        .notification.success {
            background: #28a745;
        }
        
        .notification.error {
            background: #dc3545;
        }
        
        .empty_state {
            text-align: center;
            padding: 60px 20px;
            color: #6c757d;
        }
        
        .empty_icon {
            font-size: 4rem;
            margin-bottom: 20px;
            opacity: 0.5;
        }
        
        @media (max-width: 768px) {
            .items_grid {
                grid-template-columns: 1fr;
            }
            
            .section_header {
                flex-direction: column;
                gap: 15px;
                align-items: stretch;
            }
            
            .modal_content {
                margin: 10% auto;
                width: 95%;
            }
        }
    </style>
  </head>
  <body>
    <header class="header">   
      @include('admin.header')
    </header>
    <div class="d-flex align-items-stretch">
      @include('admin.sidebar')
      
      <div class="page-content">
        <div class="page-header">
          <div class="container-fluid">
            <h2 class="h5 no-margin-bottom">Categories & Tags Management</h2>
          </div>
        </div>
        
        @if(session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
        
        <!-- Categories Section -->
        <div class="management_section">
            <div class="section_header">
                <h3 class="section_title">
                    <i class="fa fa-folder"></i>
                    Categories
                </h3>
                <button class="add_btn" onclick="showAddCategoryModal()">
                    <i class="fa fa-plus"></i>
                    Add Category
                </button>
            </div>
            
            <div class="items_grid" id="categoriesGrid">
                @forelse($categories as $category)
                    <div class="item_card" id="category_{{ $category->id }}">
                        <div class="status_badge {{ $category->is_active ? 'status_active' : 'status_inactive' }}">
                            {{ $category->is_active ? 'Active' : 'Inactive' }}
                        </div>
                        
                        <div class="item_name">{{ $category->name }}</div>
                        
                        <div class="item_meta">
                            <span class="item_slug">{{ $category->slug }}</span>
                            <span class="posts_count">{{ $category->posts()->count() }} posts</span>
                        </div>
                        
                        @if($category->description)
                            <div style="color: #6c757d; margin-bottom: 15px; font-size: 0.9rem;">
                                {{ Str::limit($category->description, 100) }}
                            </div>
                        @endif
                        
                        <div class="item_actions">
                            <button class="action_btn edit_btn" 
                                    data-id="{{ $category->id }}" 
                                    data-name="{{ $category->name }}" 
                                    data-description="{{ $category->description ?? '' }}"
                                    onclick="editCategory(this)">
                                <i class="fa fa-edit"></i> Edit
                            </button>
                            <button class="action_btn delete_btn" 
                                    data-id="{{ $category->id }}"
                                    onclick="deleteCategory(this)">
                                <i class="fa fa-trash"></i> Delete
                            </button>
                        </div>
                    </div>
                @empty
                    <div class="empty_state">
                        <div class="empty_icon">📁</div>
                        <h4>No categories yet</h4>
                        <p>Start by creating your first category</p>
                    </div>
                @endforelse
            </div>
        </div>
        
        <!-- Tags Section -->
        <div class="management_section">
            <div class="section_header">
                <h3 class="section_title">
                    <i class="fa fa-tags"></i>
                    Tags
                </h3>
                <button class="add_btn" onclick="showAddTagModal()">
                    <i class="fa fa-plus"></i>
                    Add Tag
                </button>
            </div>
            
            <div class="items_grid" id="tagsGrid">
                @forelse($tags as $tag)
                    <div class="item_card" id="tag_{{ $tag->id }}">
                        <div class="status_badge {{ $tag->is_active ? 'status_active' : 'status_inactive' }}">
                            {{ $tag->is_active ? 'Active' : 'Inactive' }}
                        </div>
                        
                        <div class="item_name">{{ $tag->name }}</div>
                        
                        <div class="item_meta">
                            <span class="item_slug">{{ $tag->slug }}</span>
                            <span class="posts_count">{{ $tag->posts()->count() }} posts</span>
                        </div>
                        
                        <div class="item_actions">
                            <button class="action_btn edit_btn" 
                                    data-id="{{ $tag->id }}" 
                                    data-name="{{ $tag->name }}"
                                    onclick="editTag(this)">
                                <i class="fa fa-edit"></i> Edit
                            </button>
                            <button class="action_btn delete_btn" 
                                    data-id="{{ $tag->id }}"
                                    onclick="deleteTag(this)">
                                <i class="fa fa-trash"></i> Delete
                            </button>
                        </div>
                    </div>
                @empty
                    <div class="empty_state">
                        <div class="empty_icon">🏷️</div>
                        <h4>No tags yet</h4>
                        <p>Start by creating your first tag</p>
                    </div>
                @endforelse
            </div>
        </div>
      </div>
    </div>
    
    <!-- Add Category Modal -->
    <div id="addCategoryModal" class="modal">
        <div class="modal_content">
            <div class="modal_header">
                <h3 class="modal_title">Add New Category</h3>
                <button class="close_btn" onclick="closeModal('addCategoryModal')">&times;</button>
            </div>
            <form id="addCategoryForm">
                @csrf
                <div class="form_group">
                    <label class="form_label">Category Name *</label>
                    <input type="text" name="name" class="form_input" placeholder="Enter category name" required>
                </div>
                <div class="form_group">
                    <label class="form_label">Description</label>
                    <input type="text" name="description" class="form_input" placeholder="Enter category description (optional)">
                </div>
                <div class="form_actions">
                    <button type="button" class="btn_secondary" onclick="closeModal('addCategoryModal')">Cancel</button>
                    <button type="submit" class="btn_primary">Add Category</button>
                </div>
            </form>
        </div>
    </div>
    
    <!-- Edit Category Modal -->
    <div id="editCategoryModal" class="modal">
        <div class="modal_content">
            <div class="modal_header">
                <h3 class="modal_title">Edit Category</h3>
                <button class="close_btn" onclick="closeModal('editCategoryModal')">&times;</button>
            </div>
            <form id="editCategoryForm">
                @csrf
                @method('PUT')
                <input type="hidden" id="editCategoryId" name="id">
                <div class="form_group">
                    <label class="form_label">Category Name *</label>
                    <input type="text" id="editCategoryName" name="name" class="form_input" required>
                </div>
                <div class="form_group">
                    <label class="form_label">Description</label>
                    <input type="text" id="editCategoryDescription" name="description" class="form_input">
                </div>
                <div class="form_actions">
                    <button type="button" class="btn_secondary" onclick="closeModal('editCategoryModal')">Cancel</button>
                    <button type="submit" class="btn_primary">Update Category</button>
                </div>
            </form>
        </div>
    </div>
    
    <!-- Add Tag Modal -->
    <div id="addTagModal" class="modal">
        <div class="modal_content">
            <div class="modal_header">
                <h3 class="modal_title">Add New Tag</h3>
                <button class="close_btn" onclick="closeModal('addTagModal')">&times;</button>
            </div>
            <form id="addTagForm">
                @csrf
                <div class="form_group">
                    <label class="form_label">Tag Name *</label>
                    <input type="text" name="name" class="form_input" placeholder="Enter tag name" required>
                </div>
                <div class="form_actions">
                    <button type="button" class="btn_secondary" onclick="closeModal('addTagModal')">Cancel</button>
                    <button type="submit" class="btn_primary">Add Tag</button>
                </div>
            </form>
        </div>
    </div>
    
    <!-- Edit Tag Modal -->
    <div id="editTagModal" class="modal">
        <div class="modal_content">
            <div class="modal_header">
                <h3 class="modal_title">Edit Tag</h3>
                <button class="close_btn" onclick="closeModal('editTagModal')">&times;</button>
            </div>
            <form id="editTagForm">
                @csrf
                @method('PUT')
                <input type="hidden" id="editTagId" name="id">
                <div class="form_group">
                    <label class="form_label">Tag Name *</label>
                    <input type="text" id="editTagName" name="name" class="form_input" required>
                </div>
                <div class="form_actions">
                    <button type="button" class="btn_secondary" onclick="closeModal('editTagModal')">Cancel</button>
                    <button type="submit" class="btn_primary">Update Tag</button>
                </div>
            </form>
        </div>
    </div>
    
    @include('admin.footer')
    
    <script>
        // Modal functions
        function showAddCategoryModal() {
            document.getElementById('addCategoryModal').style.display = 'block';
        }
        
        function showAddTagModal() {
            document.getElementById('addTagModal').style.display = 'block';
        }
        
        function closeModal(modalId) {
            document.getElementById(modalId).style.display = 'none';
        }
        
        function editCategory(button) {
            const id = button.getAttribute('data-id');
            const name = button.getAttribute('data-name');
            const description = button.getAttribute('data-description');
            
            document.getElementById('editCategoryId').value = id;
            document.getElementById('editCategoryName').value = name;
            document.getElementById('editCategoryDescription').value = description || '';
            document.getElementById('editCategoryModal').style.display = 'block';
        }
        
        function editTag(button) {
            const id = button.getAttribute('data-id');
            const name = button.getAttribute('data-name');
            
            document.getElementById('editTagId').value = id;
            document.getElementById('editTagName').value = name;
            document.getElementById('editTagModal').style.display = 'block';
        }
        
        // Close modal when clicking outside
        window.onclick = function(event) {
            const modals = ['addCategoryModal', 'editCategoryModal', 'addTagModal', 'editTagModal'];
            modals.forEach(modalId => {
                const modal = document.getElementById(modalId);
                if (event.target == modal) {
                    modal.style.display = 'none';
                }
            });
        }
        
        // Notification system
        function showNotification(message, type) {
            const notification = document.createElement('div');
            notification.className = `notification ${type}`;
            notification.textContent = message;
            document.body.appendChild(notification);
            
            setTimeout(() => notification.classList.add('show'), 100);
            
            setTimeout(() => {
                notification.classList.remove('show');
                setTimeout(() => document.body.removeChild(notification), 300);
            }, 3000);
        }
        
        // Add Category Form Handler
        document.getElementById('addCategoryForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            
            fetch('{{ route("admin.add_category") }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    name: formData.get('name'),
                    description: formData.get('description')
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload(); // Refresh to show new category
                } else {
                    showNotification('Error adding category: ' + data.message, 'error');
                }
            })
            .catch(error => {
                showNotification('Error adding category', 'error');
            });
        });
        
        // Add Tag Form Handler
        document.getElementById('addTagForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            
            fetch('{{ route("admin.add_tag") }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    name: formData.get('name')
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload(); // Refresh to show new tag
                } else {
                    showNotification('Error adding tag: ' + data.message, 'error');
                }
            })
            .catch(error => {
                showNotification('Error adding tag', 'error');
            });
        });
        
        // Delete Category
        function deleteCategory(button) {
            const categoryId = button.getAttribute('data-id');
            if (confirm('Are you sure you want to delete this category?')) {
                fetch(`{{ url('admin/categories') }}/${categoryId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json',
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById(`category_${categoryId}`).remove();
                        showNotification(data.message, 'success');
                    } else if (data.require_confirmation) {
                        if (confirm(`${data.message}\n\nDo you want to proceed? This will move all posts to 'Uncategorized'.`)) {
                            // Retry with force flag
                            fetch(`{{ url('admin/categories') }}/${categoryId}`, {
                                method: 'DELETE',
                                headers: {
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                    'Content-Type': 'application/json',
                                },
                                body: JSON.stringify({ force: true })
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    document.getElementById(`category_${categoryId}`).remove();
                                    showNotification(data.message, 'success');
                                } else {
                                    showNotification('Error: ' + data.message, 'error');
                                }
                            });
                        }
                    } else {
                        showNotification('Error: ' + data.message, 'error');
                    }
                })
                .catch(error => {
                    showNotification('Error deleting category', 'error');
                });
            }
        }
        
        // Delete Tag
        function deleteTag(button) {
            const tagId = button.getAttribute('data-id');
            if (confirm('Are you sure you want to delete this tag?')) {
                fetch(`{{ url('admin/tags') }}/${tagId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json',
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById(`tag_${tagId}`).remove();
                        showNotification(data.message, 'success');
                    } else if (data.require_confirmation) {
                        if (confirm(`${data.message}\n\nDo you want to proceed? This will remove the tag from all posts.`)) {
                            // Retry with force flag
                            fetch(`{{ url('admin/tags') }}/${tagId}`, {
                                method: 'DELETE',
                                headers: {
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                    'Content-Type': 'application/json',
                                },
                                body: JSON.stringify({ force: true })
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    document.getElementById(`tag_${tagId}`).remove();
                                    showNotification(data.message, 'success');
                                } else {
                                    showNotification('Error: ' + data.message, 'error');
                                }
                            });
                        }
                    } else {
                        showNotification('Error: ' + data.message, 'error');
                    }
                })
                .catch(error => {
                    showNotification('Error deleting tag', 'error');
                });
            }
        }
    </script>
  </body>
</html>
