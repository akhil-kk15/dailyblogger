<nav id="sidebar">
        <!-- Sidebar Header-->
        <div class="sidebar-header d-flex align-items-center">
          <div class="avatar"><img src="admincss/img/setting.png" alt="..." class="img-fluid rounded-circle"></div>
          <div class="title">
            <h1 class="h5">Admin Panel</h1>
            <p>Control Center</p>
          </div>
        </div>
        <!-- Sidebar Navidation Menus-->
         <span class="heading">Main</span>
        <ul class="list-unstyled">
                <li class="{{ request()->routeIs('home.homepage') || request()->routeIs('admin.index') ? 'active' : '' }}">
                    <a href="{{ url('home') }}"> <i class="icon-home"></i>Home </a>
                </li>
                <li class="{{ request()->routeIs('admin.post_page') ? 'active' : '' }}">
                    <a href="{{ route('admin.post_page') }}"> <i class="icon-grid"></i>Add Posts </a>
                </li>
                <li class="{{ request()->routeIs('admin.show_posts') ? 'active' : '' }}">
                    <a href="{{ route('admin.show_posts') }}"> <i class="icon-windows"></i>Show Posts </a>
                </li>
                <li class="{{ request()->routeIs('admin.comments.index') ? 'active' : '' }}">
                    <a href="{{ route('admin.comments.index') }}"> <i class="icon-speech"></i>Comments </a>
                </li>
                <li class="{{ request()->routeIs('admin.users.index') ? 'active' : '' }}">
                    <a href="{{ route('admin.users.index') }}"> <i class="icon-user"></i>User Management </a>
                </li>
                <li class="{{ request()->routeIs('admin.announcement_page') ? 'active' : '' }}">
                    <a href="{{ route('admin.announcement_page') }}"> <i class="icon-megaphone"></i>Announcements </a>
                </li>
        </ul><span class="heading">Analytics</span>
        <ul class="list-unstyled">
          <li> <a href="#" onclick="showComingSoon('Stats')"> <i class="fa fa-bar-chart"></i>Stats </a></li>
          <li> <a href="#" onclick="showComingSoon('Charts')"> <i class="fa fa-line-chart"></i>Charts </a></li>
        </ul><span class="heading">Settings</span>
        <ul class="list-unstyled">
          <li> <a href="#" onclick="showComingSoon('Settings')"> <i class="icon-settings"></i>Settings </a></li>
          <li> <a href="#" onclick="showComingSoon('Reports')"> <i class="icon-writing-whiteboard"></i>Reports </a></li>
        </ul>
      </nav>
