<!DOCTYPE html>
<html>
<head>
  @include('admin.admincss')
  <style>
    .user-table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }
    .user-table th, .user-table td {
      border: 1px solid #444;
      padding: 10px;
      text-align: left;
    }
    .user-table th {
      background-color: #333;
      color: white;
    }
    .user-table tr:nth-child(even) {
      background-color: #2a2a2a;
    }
    .user-table tr:hover {
      background-color: #3a3a3a;
    }
    .role-form {
      display: inline;
    }
    .role-select {
      background-color: #333;
      color: white;
      border: 1px solid #555;
      padding: 5px;
      border-radius: 4px;
    }
    .role-submit {
      background-color: #007bff;
      color: white;
      border: none;
      padding: 5px 10px;
      border-radius: 4px;
      cursor: pointer;
    }
    .role-submit:hover {
      background-color: #0056b3;
    }
    .alert {
      padding: 15px;
      margin-bottom: 20px;
      border: 1px solid transparent;
      border-radius: 4px;
    }
    .alert-success {
      color: #28a745;
      background-color: #1a2d21;
      border-color: #28a745;
    }
    .alert-danger {
      color: #dc3545;
      background-color: #2d1a1a;
      border-color: #dc3545;
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
                    @if(auth()->id() !== $user->id)
                      <form method="POST" action="{{ route('admin.users.update-role', $user) }}" class="role-form">
                        @csrf
                        @method('PATCH')
                        <select name="usertype" class="role-select">
                          <option value="user" {{ $user->usertype === 'user' ? 'selected' : '' }}>User</option>
                          <option value="admin" {{ $user->usertype === 'admin' ? 'selected' : '' }}>Admin</option>
                        </select>
                        <button type="submit" class="role-submit">Update Role</button>
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
</body>
</html>
