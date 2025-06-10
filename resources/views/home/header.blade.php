<div class="header_main">
            <div class="mobile_menu">
               <nav class="navbar navbar-expand-lg navbar-light bg-light">
                  <a class="navbar-brand" href="{{ route('home.homepage') }}">
                     <img src="{{ asset('images/logofile-cropped.svg') }}" alt="Daily Blogger" class="logo-img">
                  </a>
                  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                  </button>
                  <div class="collapse navbar-collapse" id="navbarNav">
                     <ul class="navbar-nav">
                        <li class="nav-item {{ request()->routeIs('home.homepage') ? 'active' : '' }}">
                           <a class="nav-link" href="{{ route('home.homepage') }}">Home</a>
                        </li>
                        <li class="nav-item {{ request()->routeIs('home.posts') ? 'active' : '' }}">
                           <a class="nav-link" href="{{ route('home.posts') }}">All Posts</a>
                        </li>
                         <li class="nav-item {{ request()->routeIs('home.search') ? 'active' : '' }}">
                           <a class="nav-link" href="{{ route('home.search') }}">Search</a>
                        </li>
                        @if(Auth::check())
                            @if(Auth::user()->usertype == 'admin')
                                <li class="nav-item {{ request()->routeIs('admin.post_page') ? 'active' : '' }}">
                                   <a class="nav-link" href="{{ route('admin.post_page') }}">Create Posts</a> 
                                </li>
                            @else
                                <li class="nav-item {{ request()->routeIs('home.create_post') ? 'active' : '' }}">
                                   <a class="nav-link" href="{{ route('home.create_post') }}">Create Posts</a> 
                                </li>
                            @endif
                        @endif
                        @if(Auth::check())
                            <li class="nav-item {{ request()->routeIs('home.my_posts') ? 'active' : '' }}">
                               <a class="nav-link" href="{{ route('home.my_posts') }}">My Posts</a>
                            </li>
                            <li class="nav-item {{ request()->routeIs('home.notifications') ? 'active' : '' }}">
                               <a class="nav-link" href="{{ route('home.notifications') }}">
                                  <i class="fa fa-bell"></i> Notifications
                                  @php
                                     $unreadCount = \App\Services\NotificationService::getUnreadCount(Auth::id());
                                  @endphp
                                  @if($unreadCount > 0)
                                     <span class="badge badge-danger notification-badge">{{ $unreadCount }}</span>
                                  @endif
                               </a>
                            </li>
                            <!-- Profile Dropdown for Mobile -->
                            <li class="nav-item dropdown">
                               <a class="nav-link dropdown-toggle" href="#" id="profileDropdownMobile" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  <i class="fa fa-user"></i> {{ Auth::user()->name }}
                               </a>
                               <div class="dropdown-menu" aria-labelledby="profileDropdownMobile">
                                  <a class="dropdown-item" href="{{ route('profile.show') }}">
                                     <i class="fa fa-user"></i> Profile
                                  </a>
                                  @if(Auth::user()->usertype == 'admin')
                                     <a class="dropdown-item" href="/home">
                                        <i class="fa fa-cog"></i> Admin Panel
                                     </a>
                                  @endif
                                  <div class="dropdown-divider"></div>
                                  <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form-mobile').submit();">
                                     <i class="fa fa-sign-out"></i> Logout
                                  </a>
                                  <form id="logout-form-mobile" action="{{ route('logout') }}" method="POST" style="display: none;">
                                     @csrf
                                  </form>
                               </div>
                            </li>
                        @endif
                        @if(!Auth::check())
                            <li class="nav-item {{ request()->routeIs('login') || request()->routeIs('register') ? 'active' : '' }}">
                               <a class="nav-link " href="{{ route('login') }}">Login/Register</a>
                            </li>
                        @endif
                        <!-- Dark Mode Toggle for Mobile -->
                        <li class="nav-item">
                           <button id="darkModeToggleMobile" class="nav-link" style="background: none; border: none; cursor: pointer;">
                              <i id="darkModeIconMobile" class="fa fa-moon-o"></i>
                              <span id="darkModeTextMobile">Dark Mode</span>
                           </button>
                        </li>
                     </ul>
                  </div>
               </nav>
            </div>
            <div class="container-fluid">
               <div class="menu_main">
                  <div class="navbar-brand-desktop">
                     <a href="{{ route('home.homepage') }}">
                        <img src="{{ asset('images/logofile-cropped.svg') }}" alt="Daily Blogger" class="logo-img-desktop">
                     </a>
                  </div>
                  <ul>
                     <li class="{{ request()->routeIs('home.homepage') ? 'active' : '' }}"><a href="{{ route('home.homepage') }}">Home</a></li>
                     <li class="{{ request()->routeIs('home.posts') ? 'active' : '' }}"><a href="{{ route('home.posts') }}">All Posts</a></li>
                     <li class="{{ request()->routeIs('home.search') ? 'active' : '' }}"><a href="{{ route('home.search') }}">Search</a></li>
                     @if(Auth::check())
                        @if(Auth::user()->usertype == 'admin')
                            <li class="{{ request()->routeIs('admin.post_page') ? 'active' : '' }}"><a href="{{ route('admin.post_page') }}">Create Posts</a></li>
                        @else
                            <li class="{{ request()->routeIs('home.create_post') ? 'active' : '' }}"><a href="{{ route('home.create_post') }}">Create Posts</a></li>
                        @endif
                        <li class="{{ request()->routeIs('home.my_posts') ? 'active' : '' }}"><a href="{{ route('home.my_posts') }}">My Posts</a></li>
                        <li class="{{ request()->routeIs('home.notifications') ? 'active' : '' }}">
                           <a href="{{ route('home.notifications') }}" style="position: relative;">
                              <i class="fa fa-bell" style="margin-right: 8px;"></i>Notifications
                              @php
                                 $unreadCount = \App\Services\NotificationService::getUnreadCount(Auth::id());
                              @endphp
                              @if($unreadCount > 0)
                                 <span style="background: #ff4757; color: white; border-radius: 50%; padding: 2px 6px; font-size: 12px; position: absolute; top: -5px; right: -10px; min-width: 18px; text-align: center;">{{ $unreadCount }}</span>
                              @endif
                           </a>
                        </li>
                     @endif
                     <!-- user login recognition -->
                     @if(Auth::check())
                        <!-- Profile Dropdown for Desktop -->
                        <li class="dropdown" style="position: relative;">
                           <a href="#" style="color: #fff; text-decoration: none; padding: 15px 20px; display: block; cursor: pointer;" onclick="toggleDropdown(event)">
                              <i class="fa fa-user" style="margin-right: 8px;"></i>{{ Auth::user()->name }}
                              <i class="fa fa-chevron-down" style="margin-left: 8px; font-size: 12px;"></i>
                           </a>
                           <div id="profileDropdownDesktop" class="dropdown-menu-custom" style="display: none; position: absolute; top: 100%; right: 0; background: white; border: 1px solid #ddd; border-radius: 4px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); min-width: 180px; z-index: 1000;">
                              <a href="{{ route('profile.show') }}" style="color: #333; text-decoration: none; padding: 10px 15px; display: block; border-bottom: 1px solid #eee;">
                                 <i class="fa fa-user" style="margin-right: 8px;"></i>Profile
                              </a>
                              @if(Auth::user()->usertype == 'admin')
                                 <a href="/home" style="color: #333; text-decoration: none; padding: 10px 15px; display: block; border-bottom: 1px solid #eee;">
                                    <i class="fa fa-cog" style="margin-right: 8px;"></i>Admin Panel
                                 </a>
                              @endif
                              <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form-desktop').submit();" style="color: #dc3545; text-decoration: none; padding: 10px 15px; display: block;">
                                 <i class="fa fa-sign-out" style="margin-right: 8px;"></i>Logout
                              </a>
                              <form id="logout-form-desktop" action="{{ route('logout') }}" method="POST" style="display: none;">
                                 @csrf
                              </form>
                           </div>
                        </li>
                     @else
                        <li class="{{ request()->routeIs('login') ? 'active' : '' }}"><a href="{{ route('login') }}">Login</a></li>
                        <li class="{{ request()->routeIs('register') ? 'active' : '' }}"><a href="{{ route('register') }}">Register</a></li>
                     @endif
                     <!-- Dark Mode Toggle for Desktop -->
                     <li>
                        <button id="darkModeToggleDesktop" style="background:none;border:none;padding:15px 20px;margin:0;color:#fff;cursor:pointer;font-size:16px;font-weight:500;transition:all 0.3s ease;border-radius:6px;border:2px solid transparent;">
                           <i id="darkModeIconDesktop" class="fa fa-moon-o" style="margin-right:8px;"></i>
                           <span id="darkModeTextDesktop">Dark</span>
                        </button>
                     </li>
                  </ul>
               </div>
            </div>
         </div>