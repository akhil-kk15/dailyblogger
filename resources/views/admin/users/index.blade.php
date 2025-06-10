<!DOCTYPE html>
<html>
<head>
  @include('admin.admincss')
  <style>
    .user-table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
      background: #ffffff !important;
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    .user-table th, .user-table td {
      border: 1px solid #e9ecef !important;
      padding: 15px 12px;
      text-align: left;
    }
    .user-table th {
      background: linear-gradient(135deg, rgba(102, 126, 234, 0.9) 0%, rgba(118, 75, 162, 0.9) 100%) !important;
      color: #ffffff !important;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      font-size: 0.85rem;
    }
    .user-table tbody tr {
      background-color: #ffffff !important;
    }
    .user-table tbody tr:nth-child(even) {
      background-color: #ffffff !important;
    }
    .user-table tbody tr:nth-child(odd) {
      background-color: #ffffff !important;
    }
    .user-table tr:hover {
      background-color: rgba(102, 126, 234, 0.08) !important;
      transform: translateY(-1px);
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
    .user-table td {
      color: #333333 !important;
      font-weight: 500;
      vertical-align: middle;
    }
    .role-form {
      display: inline;
    }
    .role-select {
      background-color: #ffffff !important;
      color: #333333 !important;
      border: 2px solid #e9ecef !important;
      padding: 8px 12px;
      border-radius: 6px;
      font-weight: 500;
      transition: all 0.3s ease;
    }
    .role-select:focus {
      border-color: #667eea !important;
      box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1) !important;
      outline: none;
    }
    .role-submit {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
      color: #ffffff !important;
      border: none !important;
      padding: 8px 16px;
      border-radius: 6px;
      cursor: pointer;
      font-weight: 600;
      margin-left: 8px;
      transition: all 0.3s ease;
    }
    .role-submit:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4) !important;
    }
    .alert {
      padding: 15px 20px;
      margin-bottom: 20px;
      border: none;
      border-radius: 8px;
      font-weight: 500;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    .alert-success {
      background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
      color: #155724;
      border-left: 4px solid #28a745;
    }
    .alert-danger {
      background: linear-gradient(135deg, #f8d7da 0%, #f5c6cb 100%);
      color: #721c24;
      border-left: 4px solid #dc3545;
    }
    .block-btn {
      background: linear-gradient(135deg, #dc3545 0%, #c82333 100%) !important;
      color: #ffffff !important;
      border: none !important;
      padding: 6px 12px;
      border-radius: 4px;
      cursor: pointer;
      font-weight: 500;
      font-size: 0.8rem;
      margin-left: 5px;
      transition: all 0.3s ease;
    }
    .block-btn:hover {
      transform: translateY(-1px);
      box-shadow: 0 4px 12px rgba(220, 53, 69, 0.4) !important;
    }
    .unblock-btn {
      background: linear-gradient(135deg, #28a745 0%, #20c997 100%) !important;
      color: #ffffff !important;
      border: none !important;
      padding: 6px 12px;
      border-radius: 4px;
      cursor: pointer;
      font-weight: 500;
      font-size: 0.8rem;
      margin-left: 5px;
      transition: all 0.3s ease;
    }
    .unblock-btn:hover {
      transform: translateY(-1px);
      box-shadow: 0 4px 12px rgba(40, 167, 69, 0.4) !important;
    }
    .status-blocked {
      background: #dc3545;
      color: white;
      padding: 4px 8px;
      border-radius: 4px;
      font-size: 0.8rem;
      font-weight: 500;
    }      .status-active {
      background: #28a745;
      color: white;
      padding: 4px 8px;
      border-radius: 4px;
      font-size: 0.8rem;
      font-weight: 500;
    }
  </style>
  
  <script>
    function toggleBlockReason(selectElement, userId) {
      const blockReasonDiv = document.getElementById('blockReason' + userId);
      if (selectElement.value === 'blocked') {
        blockReasonDiv.style.display = 'flex';
      } else {
        blockReasonDiv.style.display = 'none';
      }
    }
  </script>
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
      <div class="page-header">
        <div class="container-fluid">
          <h2 class="h5 no-margin-bottom">User Management</h2>
        </div>
      </div>
      <section class="no-padding-bottom">
        <div class="container-fluid">
          @if(session('message'))
            <div class="alert alert-success">
              {{ session('message') }}
            </div>
          @endif
          
          @if(session('error'))
            <div class="alert alert-danger">
              {{ session('error') }}
            </div>
          @endif

          <div class="table-responsive">
            <table class="user-table">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Current Role</th>
                  <th>Status</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach($users as $user)
                <tr>
                  <td>{{ $user->name }}</td>
                  <td>{{ $user->email }}</td>
                  <td>{{ ucfirst($user->usertype) }}</td>
                  <td>
                    @if($user->usertype === 'blocked')
                      <span class="status-blocked">Blocked</span>
                    @else
                      <span class="status-active">Active</span>
                    @endif
                  </td>
                  <td>
                    @if(auth()->id() !== $user->id)
                      <form method="POST" action="{{ route('admin.users.updateRole', $user) }}" class="role-form">
                        @csrf
                        @method('PUT')
                        
                        <div style="display: flex; flex-direction: column; gap: 10px;">
                          <!-- Role Selection -->
                          <div style="display: flex; align-items: center; gap: 8px;">
                            <label style="font-weight: 600; min-width: 40px; font-size: 0.85rem;">Role:</label>
                            <select name="usertype" class="role-select" style="flex: 1;" onchange="toggleBlockReason(this, '{{ $user->id }}')">
                              <option value="user" {{ $user->usertype === 'user' ? 'selected' : '' }}>User</option>
                              <option value="admin" {{ $user->usertype === 'admin' ? 'selected' : '' }}>Admin</option>
                              <option value="blocked" {{ $user->usertype === 'blocked' ? 'selected' : '' }}>Blocked</option>
                            </select>
                          </div>
                          
                          <!-- Block Reason (shown only when blocked is selected) -->
                          <div id="blockReason{{ $user->id }}" style="display: {{ $user->usertype === 'blocked' ? 'flex' : 'none' }}; align-items: center; gap: 8px;">
                            <label style="font-weight: 600; min-width: 40px; font-size: 0.85rem;">Reason:</label>
                            <input type="text" name="blocked_reason" placeholder="Reason for blocking" 
                                   value="{{ $user->blocked_reason }}"
                                   style="flex: 1; padding: 4px 8px; border: 1px solid #ddd; border-radius: 4px; font-size: 0.8rem;">
                          </div>
                          
                          <!-- Submit Button -->
                          <button type="submit" class="role-submit" style="align-self: flex-start;">Update Role</button>
                        </div>
                      </form>
                    @else
                      <em>Current User</em>
                    @endif
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          
          <div class="mt-4">
            {{ $users->links() }}
          </div>
        </div>
      </section>
    </div>
  </div>

  <!-- JavaScript files-->
  <script src="/admincss/vendor/jquery/jquery.min.js"></script>
  <script src="/admincss/vendor/popper.js/umd/popper.min.js"></script>
  <script src="/admincss/vendor/bootstrap/js/bootstrap.min.js"></script>
  <script src="/admincss/js/front.js"></script>
  
  <!-- Fix Bootstrap Dropdowns -->
  <script>
  $(document).ready(function() {
    // Initialize Bootstrap dropdowns
    $('.dropdown-toggle').dropdown();
    
    // Fix dropdown click handlers
    $('.dropdown-toggle').on('click', function(e) {
      e.preventDefault();
      $(this).parent().find('.dropdown-menu').toggle();
    });
    
    // Close dropdowns when clicking outside
    $(document).on('click', function(e) {
      if (!$(e.target).closest('.dropdown').length) {
        $('.dropdown-menu').hide();
      }
    });
  });
  </script>
</body>
</html>
