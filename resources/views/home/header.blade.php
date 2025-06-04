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
                            <li class="nav-item {{ request()->routeIs('admin.post_page') ? 'active' : '' }}">
                               <a class="nav-link" href="{{ route('admin.post_page') }}">Create Posts</a> 
                            </li>
                        @endif
                        <li class="nav-item">
                           <a class="nav-link " href="blog.html">My Posts</a>
                        </li>
                        @if(Auth::check())
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
                        <li class="{{ request()->routeIs('admin.post_page') ? 'active' : '' }}"><a href="{{ route('admin.post_page') }}">Create Posts</a></li>
                     @endif
                     <li><a href="blog.html">My Posts</a></li>
                     @if(Auth::check())
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