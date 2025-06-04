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

                <li><a href="#{{ url('/show_post') }}" aria-expanded="false" data-toggle="collapse"> <i class="icon-windows"></i>Show Posts </a>
                <li><a href="charts.html"> <i class="fa fa-bar-chart"></i>Stats </a></li>
                <li><a href="forms.html"> <i class="icon-padnote"></i>Approval list </a></li>
                  <ul id="exampledropdownDropdown" class="collapse list-unstyled ">
                    <li><a href="#">Page</a></li>
                    <li><a href="#">Page</a></li>
                    <li><a href="#">Page</a></li>
                  </ul>
                </li>
                <li><a href="login.html"> <i class="icon-logout"></i>Login page </a></li>
        </ul><span class="heading">Extras</span>
        <ul class="list-unstyled">
          <li> <a href="#"> <i class="icon-settings"></i>Demo </a></li>
          <li> <a href="#"> <i class="icon-writing-whiteboard"></i>Demo </a></li>
          <li> <a href="#"> <i class="icon-chart"></i>Demo </a></li>
        </ul>
      </nav>
