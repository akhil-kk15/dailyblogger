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
                        <!-- change this from  redirecting to adminpage  -->
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
                        <li class="nav-item {{ request()->routeIs('home.my_posts') ? 'active' : '' }}">
                           <a class="nav-link " href="{{ route('home.my_posts') }}">My Posts</a>
                        </li>
                        @if(Auth::check())
                            <li class="nav-item {{ request()->routeIs('home.notifications') ? 'active' : '' }}">
                               <a class="nav-link" href="{{ route('home.notifications') }}" id="mobile-notifications-link">
                                   <i class="fa fa-bell"></i> Notifications 
                                   <span class="badge badge-danger" id="mobile-notification-count" style="display: none;">0</span>
                               </a>
                            </li>
                            <li class="nav-item dropdown {{ request()->routeIs('profile.show') ? 'active' : '' }}">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ Auth::user()->name }}
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('profile.show') }}">My Profile</a>
                                    @if(Auth::user()->usertype == 'admin')
                                        <a class="dropdown-item" href="/home">Admin Panel</a>
                                        <div class="dropdown-divider"></div>
                                    @endif
                                    <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                                        @csrf
                                        <button type="submit" class="dropdown-item" style="background:none;border:none;width:100%;text-align:left;cursor:pointer;">Logout</button>
                                    </form>
                                </div>
                            </li>
                        @endif
                        @if(!Auth::check())
                            <li class="nav-item {{ request()->routeIs('login') || request()->routeIs('register') ? 'active' : '' }}">
                               <a class="nav-link " href="{{ route('login') }}">Login/Register</a>
                            </li>
                        @endif
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
                     @if(Auth::check())
                        @if(Auth::user()->usertype == 'admin')
                            <li class="{{ request()->routeIs('admin.post_page') ? 'active' : '' }}"><a href="{{ route('admin.post_page') }}">Create Posts</a></li>
                        @else
                            <li class="{{ request()->routeIs('home.create_post') ? 'active' : '' }}"><a href="{{ route('home.create_post') }}">Create Posts</a></li>
                        @endif
                     @endif
                     <li class="{{ request()->routeIs('home.my_posts') ? 'active' : '' }}"><a href="{{ route('home.my_posts') }}">My Posts</a></li>
                     @if(Auth::check())
                        <li class="{{ request()->routeIs('home.notifications') ? 'active' : '' }}" style="position: relative;">
                            <a href="{{ route('home.notifications') }}" id="desktop-notifications-link">
                                <i class="fa fa-bell"></i> Notifications
                                <span class="badge badge-danger" id="desktop-notification-count" style="position: absolute; top: -5px; right: -10px; min-width: 18px; height: 18px; line-height: 18px; font-size: 11px; text-align: center; border-radius: 50%; background: #dc3545; color: white; display: none;">0</span>
                            </a>
                        </li>
                        <li class="dropdown {{ request()->routeIs('profile.show') ? 'active' : '' }}">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ Auth::user()->name }} </a>
                            <ul class="dropdown-menu">
                                <li><a href="{{ route('profile.show') }}">My Profile</a></li>
                                @if(Auth::user()->usertype == 'admin')
                                    <li><a href="/home">Admin Panel</a></li>
                                    
                                @endif
                                <li>
                                    <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                                        @csrf
                                        <button type="submit" style="background:none;border:none;padding:0;margin:0;color:inherit;cursor:pointer;width:100%;text-align:left;padding:10px 20px;">Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                     @else
                        <li class="{{ request()->routeIs('login') ? 'active' : '' }}"><a href="{{ route('login') }}">Login</a></li>
                        <li class="{{ request()->routeIs('register') ? 'active' : '' }}"><a href="{{ route('register') }}">Register</a></li>
                     @endif
                  </ul>
               </div>
            </div>
         </div>

@if(Auth::check())
<script>
    // Real-time notification count updates
    function updateNotificationCount() {
        $.get('{{ route("api.notifications.count") }}', function(data) {
            var count = data.count;
            var countElements = [
                $('#desktop-notification-count'),
                $('#mobile-notification-count')
            ];
            
            countElements.forEach(function(element) {
                if (count > 0) {
                    element.text(count).show();
                } else {
                    element.hide();
                }
            });
        }).fail(function() {
            console.log('Failed to fetch notification count');
        });
    }

    // Update notification count on page load
    $(document).ready(function() {
        updateNotificationCount();
        
        // Update notification count every 30 seconds
        setInterval(updateNotificationCount, 30000);
    });
</script>
@endif