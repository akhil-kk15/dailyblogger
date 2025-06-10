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
      
      <!-- profile section start -->
      <div class="profile_section layout_padding">
          <div class="container">
              <h1 class="services_taital">My Profile</h1>
              <p class="services_text">Manage your account information and settings</p>
              
              <div class="row justify-content-center">
                  <div class="col-md-8">
                      <div class="profile_card">
                          <!-- Profile Information Section -->
                          <div class="profile_section_item">
                              <h3 class="profile_section_title">Profile Information</h3>
                              <p class="profile_section_description">Update your account's profile information and email address.</p>
                              
                              <form method="POST" action="{{ route('user-profile-information.update') }}" enctype="multipart/form-data">
                                  @csrf
                                  @method('PUT')
                                  
                                  <!-- Name -->
                                  <div class="profile_input_group">
                                      <label for="name" class="profile_label">Name</label>
                                      <input type="text" id="name" name="name" value="{{ old('name', Auth::user()->name) }}" class="profile_input" required>
                                      @error('name')
                                          <span class="profile_error">{{ $message }}</span>
                                      @enderror
                                  </div>
                                  
                                  <!-- Email -->
                                  <div class="profile_input_group">
                                      <label for="email" class="profile_label">Email</label>
                                      <input type="email" id="email" name="email" value="{{ old('email', Auth::user()->email) }}" class="profile_input" required>
                                      @error('email')
                                          <span class="profile_error">{{ $message }}</span>
                                      @enderror
                                  </div>
                                  
                                  <div class="profile_actions">
                                      <button type="submit" class="btn btn-primary">Save Changes</button>
                                  </div>
                              </form>
                          </div>
                          
                          <!-- Update Password Section -->
                          <div class="profile_section_item">
                              <h3 class="profile_section_title">Update Password</h3>
                              <p class="profile_section_description">Ensure your account is using a long, random password to stay secure.</p>
                              
                              <form method="POST" action="{{ route('user-password.update') }}">
                                  @csrf
                                  @method('PUT')
                                  
                                  <!-- Current Password -->
                                  <div class="profile_input_group">
                                      <label for="current_password" class="profile_label">Current Password</label>
                                      <input type="password" id="current_password" name="current_password" class="profile_input" required>
                                      @error('current_password')
                                          <span class="profile_error">{{ $message }}</span>
                                      @enderror
                                  </div>
                                  
                                  <!-- New Password -->
                                  <div class="profile_input_group">
                                      <label for="password" class="profile_label">New Password</label>
                                      <input type="password" id="password" name="password" class="profile_input" required>
                                      @error('password')
                                          <span class="profile_error">{{ $message }}</span>
                                      @enderror
                                  </div>
                                  
                                  <!-- Confirm Password -->
                                  <div class="profile_input_group">
                                      <label for="password_confirmation" class="profile_label">Confirm Password</label>
                                      <input type="password" id="password_confirmation" name="password_confirmation" class="profile_input" required>
                                  </div>
                                  
                                  <div class="profile_actions">
                                      <button type="submit" class="btn btn-primary">Update Password</button>
                                  </div>
                              </form>
                          </div>
                          
                          <!-- Account Actions -->
                          <div class="profile_section_item">
                              <h3 class="profile_section_title">Account Actions</h3>
                              <p class="profile_section_description">Additional account management options.</p>
                              
                              <div class="account_actions">
                                  <a href="{{ route('home.posts') }}" class="btn btn-secondary">View All Posts</a>
                                  @if(Auth::check())
                                      @if(Auth::user()->usertype == 'admin')
                                          <a href="{{ route('admin.post_page') }}" class="btn btn-secondary">Create New Post</a>
                                      @else
                                          <a href="{{ route('home.create_post') }}" class="btn btn-secondary">Create New Post</a>
                                      @endif
                                  @endif
                                  <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                                      @csrf
                                      <button type="submit" class="btn btn-danger">Logout</button>
                                  </form>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <!-- profile section end -->
      
      <!-- footer section start -->
      @include('home.footer')
      <!-- footer section end -->
      
      <style>
          .profile_card {
              background: #fff;
              border-radius: 8px;
              box-shadow: 0 0 15px rgba(0,0,0,0.1);
              padding: 30px;
              margin-bottom: 30px;
          }
          
          .profile_section_item {
              margin-bottom: 40px;
              padding-bottom: 30px;
              border-bottom: 1px solid #eee;
          }
          
          .profile_section_item:last-child {
              margin-bottom: 0;
              padding-bottom: 0;
              border-bottom: none;
          }
          
          .profile_section_title {
              font-size: 24px;
              color: #333;
              margin-bottom: 10px;
          }
          
          .profile_section_description {
              color: #666;
              margin-bottom: 20px;
          }
          
          .profile_input_group {
              margin-bottom: 20px;
          }
          
          .profile_label {
              display: block;
              margin-bottom: 5px;
              color: #333;
          }
          
          .profile_input {
              width: 100%;
              padding: 8px 12px;
              border: 1px solid #ddd;
              border-radius: 4px;
              font-size: 16px;
          }
          
          .profile_error {
              color: #dc3545;
              font-size: 14px;
              margin-top: 5px;
              display: block;
          }
          
          .profile_actions {
              margin-top: 20px;
          }
          
          .account_actions {
              display: flex;
              gap: 10px;
              flex-wrap: wrap;
          }
          
          .btn {
              padding: 8px 16px;
              border-radius: 4px;
              font-size: 16px;
              cursor: pointer;
              border: none;
          }
          
          .btn-primary {
              background: #007bff;
              color: #fff;
          }
          
          .btn-secondary {
              background: #6c757d;
              color: #fff;
          }
          
          .btn-danger {
              background: #dc3545;
              color: #fff;
          }
          
          .btn:hover {
              opacity: 0.9;
          }
      </style>
   </body>
</html>
