<div class="header_main">
            <div class="mobile_menu">
               <nav class="navbar navbar-expand-lg navbar-light bg-light">
                  <div class="logo_mobile"><a href="index.html"><img src="{{ asset('images/logofile-cropped.svg') }}"></a></div>
                  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                  </button>
                  <div class="collapse navbar-collapse" id="navbarNav">
                     <ul class="navbar-nav">
                        <li class="nav-item">
                           <a class="nav-link" href="index.html">Home</a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link" href="about.html">about</a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link" href="services.html">Create Posts</a> 
                        </li>
                        <li class="nav-item">
                           <a class="nav-link " href="blog.html">My Posts</a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link " href="contact.html">Login/Register</a>
                        </li>
                     </ul>
                  </div>
               </nav>
            </div>
            <div class="container-fluid">
               <div class="logo"><a href="index.html"><img src="{{ asset('images/logofile-cropped.svg') }}"></a></div>
               <div class="menu_main">
                  <ul>
                     <li class="active"><a href="{{ route('home.homepage') }}">Home</a></li>
                     <li><a href="about.html">Create Posts</a></li>
                     <li><a href="services.html">My Posts</a></li>
                     <!-- user login recognition -->
                     @if(Auth::check())
                        <li>
                           <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                              @csrf
                              <button type="submit" style="background:none;border:none;padding:0;margin:0;color:inherit;cursor:pointer;">Logout</button>
                           </form>
                        </li>
                     @else
                        <li><a href="{{ route('login') }}">Login</a></li>
                        <li><a href="{{ route('register') }}">Register</a></li>
                     @endif
                  </ul>
               </div>
            </div>
         </div>