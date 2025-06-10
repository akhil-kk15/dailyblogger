<nav class="navbar navbar-expand-lg">
        <div class="search-panel">
          <div class="search-inner d-flex align-items-center justify-content-center">
            <div class="close-btn">Close <i class="fa fa-close"></i></div>
            <form id="searchForm" action="#">
              <div class="form-group">
                <input type="search" name="search" placeholder="What are you searching for...">
                <button type="submit" class="submit">Search</button>
              </div>
            </form>
          </div>
        </div>
        <div class="container-fluid d-flex align-items-center justify-content-between">
          <div class="navbar-header">
            <!-- Navbar Header--><a href="/home" class="navbar-brand">
              <div class="brand-text brand-big visible text-uppercase"><strong class="text-primary">daily</strong><strong>Blogger</strong></div>
              <div class="brand-text brand-sm"><strong class="text-primary">D</strong><strong>A</strong></div></a>
            <!-- Sidebar Toggle Btn-->
            <button class="sidebar-toggle" onclick="toggleSidebar()">
                <i class="fa fa-bars"></i>
            </button>
          </div>
          <div class="right-menu list-inline no-margin-bottom">    
            <div class="list-inline-item"><a href="#" class="search-open nav-link"><i class="icon-magnifying-glass-browser"></i></a></div>
            <div class="list-inline-item dropdown"><a id="navbarDropdownMenuLink1" href="http://example.com" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link messages-toggle"><i class="icon-email"></i><span class="badge dashbg-1">5</span></a>
              <div aria-labelledby="navbarDropdownMenuLink1" class="dropdown-menu messages" style="margin-top:-27px;"><a href="#" class="dropdown-item message d-flex align-items-center">
                  <div class="profile"><img src="admincss/img/avatar-3.jpg" alt="..." class="img-fluid">
                    <div class="status online"></div>
                  </div>
                  <div class="content">   <strong class="d-block">Nadia Halsey</strong><span class="d-block">lorem ipsum dolor sit amit</span><small class="date d-block">9:30am</small></div></a><a href="#" class="dropdown-item message d-flex align-items-center">
                  <div class="profile"><img src="admincss/img/avatar-2.jpg" alt="..." class="img-fluid">
                    <div class="status away"></div>
                  </div>
                  <div class="content">   <strong class="d-block">Peter Ramsy</strong><span class="d-block">lorem ipsum dolor sit amit</span><small class="date d-block">7:40am</small></div></a><a href="#" class="dropdown-item message d-flex align-items-center">
                  <div class="profile"><img src="admincss/img/avatar-1.jpg" alt="..." class="img-fluid">
                    <div class="status busy"></div>
                  </div>
                  <div class="content">   <strong class="d-block">Sam Kaheil</strong><span class="d-block">lorem ipsum dolor sit amit</span><small class="date d-block">6:55am</small></div></a><a href="#" class="dropdown-item message d-flex align-items-center">
                  <div class="profile"><img src="admincss/img/avatar-5.jpg" alt="..." class="img-fluid">
                    <div class="status offline"></div>
                  </div>
                  <div class="content">   <strong class="d-block">Sara Wood</strong><span class="d-block">lorem ipsum dolor sit amit</span><small class="date d-block">10:30pm</small></div></a><a href="#" class="dropdown-item text-center message"> <strong>See All Messages <i class="fa fa-angle-right"></i></strong></a></div>
            </div>
            <!-- Tasks-->
            <div class="list-inline-item dropdown"><a id="navbarDropdownMenuLink2" href="http://example.com" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link tasks-toggle"><i class="icon-new-file"></i><span class="badge dashbg-3">9</span></a>
              <div aria-labelledby="navbarDropdownMenuLink2" class="dropdown-menu tasks-list" style="margin-top:-27px;">
                <a href="#" class="dropdown-item">
                  <div class="text d-flex justify-content-between"><strong>Task 1</strong><span>40% complete</span></div>
                  <div class="progress">
                    <div role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" class="progress-bar dashbg-1"></div>
                  </div></a><a href="#" class="dropdown-item">
                  <div class="text d-flex justify-content-between"><strong>Task 2</strong><span>20% complete</span></div>
                  <div class="progress">
                    <div role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" class="progress-bar dashbg-3"></div>
                  </div></a><a href="#" class="dropdown-item">
                  <div class="text d-flex justify-content-between"><strong>Task 3</strong><span>70% complete</span></div>
                  <div class="progress">
                    <div role="progressbar" style="width: 70%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" class="progress-bar dashbg-2"></div>
                  </div></a><a href="#" class="dropdown-item">
                  <div class="text d-flex justify-content-between"><strong>Task 4</strong><span>30% complete</span></div>
                  <div class="progress">
                    <div role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" class="progress-bar dashbg-4"></div>
                  </div></a><a href="#" class="dropdown-item">
                  <div class="text d-flex justify-content-between"><strong>Task 5</strong><span>65% complete</span></div>
                  <div class="progress">
                    <div role="progressbar" style="width: 65%" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100" class="progress-bar dashbg-1"></div>
                  </div></a><a href="#" class="dropdown-item text-center"> <strong>See All Tasks <i class="fa fa-angle-right"></i></strong></a>
              </div>
            </div>
            <!-- Tasks end-->
            <!-- Megamenu
            <div class="list-inline-item dropdown menu-large">
    <a href="#" data-toggle="dropdown" class="nav-link">Mega <i class="fa fa-ellipsis-v"></i></a>
    <div class="dropdown-menu megamenu" style="margin-top:-27px;">
                <div class="row">
                  <div class="col-lg-3 col-md-6"><strong class="text-uppercase">Elements Heading</strong>
                    <ul class="list-unstyled mb-3">
                      <li><a href="#">Lorem ipsum dolor</a></li>
                      <li><a href="#">Sed ut perspiciatis</a></li>
                      <li><a href="#">Voluptatum deleniti</a></li>
                      <li><a href="#">At vero eos</a></li>
                      <li><a href="#">Consectetur adipiscing</a></li>
                      <li><a href="#">Duis aute irure</a></li>
                      <li><a href="#">Necessitatibus saepe</a></li>
                      <li><a href="#">Maiores alias</a></li>
                    </ul>
                  </div>
                  <div class="col-lg-3 col-md-6"><strong class="text-uppercase">Elements Heading</strong>
                    <ul class="list-unstyled mb-3">
                      <li><a href="#">Lorem ipsum dolor</a></li>
                      <li><a href="#">Sed ut perspiciatis</a></li>
                      <li><a href="#">Voluptatum deleniti</a></li>
                      <li><a href="#">At vero eos</a></li>
                      <li><a href="#">Consectetur adipiscing</a></li>
                      <li><a href="#">Duis aute irure</a></li>
                      <li><a href="#">Necessitatibus saepe</a></li>
                      <li><a href="#">Maiores alias</a></li>
                    </ul>
                  </div>
                  <div class="col-lg-3 col-md-6"><strong class="text-uppercase">Elements Heading</strong>
                    <ul class="list-unstyled mb-3">
                      <li><a href="#">Lorem ipsum dolor</a></li>
                      <li><a href="#">Sed ut perspiciatis</a></li>
                      <li><a href="#">Voluptatum deleniti</a></li>
                      <li><a href="#">At vero eos</a></li>
                      <li><a href="#">Consectetur adipiscing</a></li>
                      <li><a href="#">Duis aute irure</a></li>
                      <li><a href="#">Necessitatibus saepe</a></li>
                      <li><a href="#">Maiores alias</a></li>
                    </ul>
                  </div>
                  <div class="col-lg-3 col-md-6"><strong class="text-uppercase">Elements Heading</strong>
                    <ul class="list-unstyled mb-3">
                      <li><a href="#">Lorem ipsum dolor</a></li>
                      <li><a href="#">Sed ut perspiciatis</a></li>
                      <li><a href="#">Voluptatum deleniti</a></li>
                      <li><a href="#">At vero eos</a></li>
                      <li><a href="#">Consectetur adipiscing</a></li>
                      <li><a href="#">Duis aute irure</a></li>
                      <li><a href="#">Necessitatibus saepe</a></li>
                      <li><a href="#">Maiores alias</a></li>
                    </ul>
                  </div>
                </div>
                <div class="row megamenu-buttons text-center">
                  <div class="col-lg-2 col-md-4"><a href="#" class="d-block megamenu-button-link dashbg-1"><i class="fa fa-clock-o"></i><strong>Demo 1</strong></a></div>
                  <div class="col-lg-2 col-md-4"><a href="#" class="d-block megamenu-button-link dashbg-2"><i class="fa fa-clock-o"></i><strong>Demo 2</strong></a></div>
                  <div class="col-lg-2 col-md-4"><a href="#" class="d-block megamenu-button-link dashbg-3"><i class="fa fa-clock-o"></i><strong>Demo 3</strong></a></div>
                  <div class="col-lg-2 col-md-4"><a href="#" class="d-block megamenu-button-link dashbg-4"><i class="fa fa-clock-o"></i><strong>Demo 4</strong></a></div>
                  <div class="col-lg-2 col-md-4"><a href="#" class="d-block megamenu-button-link bg-danger"><i class="fa fa-clock-o"></i><strong>Demo 5</strong></a></div>
                  <div class="col-lg-2 col-md-4"><a href="#" class="d-block megamenu-button-link bg-info"><i class="fa fa-clock-o"></i><strong>Demo 6</strong></a></div>
                </div>
              </div>
            </div> -->
            <!-- Megamenu end     -->
            <!-- Languages dropdown    -->
            <div class="list-inline-item dropdown language-selector">
                <a id="languages" rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link language dropdown-toggle">
                    <div id="current-flag" class="flag-icon flag-gb"></div>
                    <span class="d-none d-sm-inline-block" id="current-language">English</span>
                </a>
                <div aria-labelledby="languages" class="dropdown-menu language-menu" style="margin-top:-29px;">
                    <a rel="nofollow" href="#" class="dropdown-item language-option" data-lang="en" data-flag="flag-gb" data-name="English">
                        <div class="flag-icon flag-gb mr-2"></div>
                        <span>English</span>
                    </a>
                    <a rel="nofollow" href="#" class="dropdown-item language-option" data-lang="de" data-flag="flag-de" data-name="German">
                        <div class="flag-icon flag-de mr-2"></div>
                        <span>German</span>
                    </a>
                    <a rel="nofollow" href="#" class="dropdown-item language-option" data-lang="fr" data-flag="flag-fr" data-name="French">
                        <div class="flag-icon flag-fr mr-2"></div>
                        <span>French</span>
                    </a>
                </div>
            </div>
            <!-- User menu dropdown -->
            <div class="list-inline-item dropdown">
    <a href="#" class="nav-link dropdown-toggle" id="adminUserDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="icon-user"></i> {{ Auth::user()->name ?? 'Account' }}
    </a>
    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="adminUserDropdown" style="margin-top:-29px;">
        <a class="dropdown-item" href="{{ route('profile.show') }}">Edit Profile</a>
        <div class="dropdown-divider"></div>
        <form method="POST" action="{{ route('logout') }}" style="margin:0;">
            @csrf
            <button type="submit" class="dropdown-item" style="color:#dc3545;">Logout</button>
        </form>
    </div>
</div>
          </div>
        </div>
      </nav>
      <!-- Make sure jQuery and Bootstrap JS are loaded in your admin layout before </body> -->
<script src="{{ asset('admincss/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('admincss/vendor/bootstrap/js/bootstrap.min.js') }}"></script>

<!-- Enhanced Sidebar Toggle Script -->
<script>
function toggleSidebar() {
    const sidebar = document.getElementById('sidebar');
    const pageContent = document.querySelector('.page-content');
    
    if (sidebar.classList.contains('active')) {
        sidebar.classList.remove('active');
        sidebar.classList.add('slide-out');
        setTimeout(() => {
            sidebar.classList.remove('slide-out');
        }, 300);
    } else {
        sidebar.classList.add('active');
        sidebar.classList.add('slide-in-left');
        setTimeout(() => {
            sidebar.classList.remove('slide-in-left');
        }, 300);
    }
}

// Enhanced mobile responsiveness
document.addEventListener('DOMContentLoaded', function() {
    // Auto-hide sidebar on mobile
    if (window.innerWidth <= 1199) {
        const sidebar = document.getElementById('sidebar');
        sidebar.classList.remove('active');
    }
    
    // Handle window resize
    window.addEventListener('resize', function() {
        const sidebar = document.getElementById('sidebar');
        if (window.innerWidth > 1199) {
            sidebar.classList.remove('active');
            sidebar.style.transform = '';
        } else if (window.innerWidth <= 1199 && !sidebar.classList.contains('active')) {
            sidebar.style.transform = 'translateX(-100%)';
        }
    });
    
    // Close sidebar when clicking outside on mobile
    document.addEventListener('click', function(event) {
        const sidebar = document.getElementById('sidebar');
        const toggleBtn = document.querySelector('.sidebar-toggle');
        
        if (window.innerWidth <= 1199 && 
            sidebar.classList.contains('active') &&
            !sidebar.contains(event.target) &&
            !toggleBtn.contains(event.target)) {
            toggleSidebar();
        }
    });
});

// Language Selector Functionality
document.addEventListener('DOMContentLoaded', function() {
    // Initialize language from Laravel's current locale
    const currentLocale = '{{ app()->getLocale() }}';
    let flagClass = 'flag-gb';
    let languageName = 'English';
    
    switch(currentLocale) {
        case 'fr':
            flagClass = 'flag-fr';
            languageName = 'Français';
            break;
        case 'de':
            flagClass = 'flag-de';
            languageName = 'Deutsch';
            break;
        default:
            flagClass = 'flag-gb';
            languageName = 'English';
    }
    
    // Set initial language display
    updateLanguageDisplay(flagClass, languageName);
    
    // Language option click handlers
    document.querySelectorAll('.language-option').forEach(option => {
        option.addEventListener('click', function(e) {
            e.preventDefault();
            
            const lang = this.getAttribute('data-lang');
            const flag = this.getAttribute('data-flag');
            const name = this.getAttribute('data-name');
            
            // Send AJAX request to switch language
            fetch('/switch-language', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ language: lang })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Update display
                    updateLanguageDisplay(flag, name);
                    
                    // Save to localStorage
                    localStorage.setItem('admin_language', lang);
                    localStorage.setItem('admin_flag', flag);
                    localStorage.setItem('admin_language_name', name);
                    
                    // Close dropdown
                    const dropdown = document.querySelector('.language-selector .dropdown-menu');
                    dropdown.classList.remove('show');
                    
                    // Show notification
                    showLanguageNotification(name);
                    
                    // Reload page to apply new language
                    setTimeout(() => {
                        location.reload();
                    }, 1000);
                } else {
                    console.error('Language switching failed:', data.message);
                }
            })
            .catch(error => {
                console.error('Error switching language:', error);
            });
        });
    });
    
    function updateLanguageDisplay(flag, name) {
        const currentFlag = document.getElementById('current-flag');
        const currentLanguage = document.getElementById('current-language');
        
        if (currentFlag) currentFlag.src = flag;
        if (currentLanguage) currentLanguage.textContent = name;
    }
    
    function showLanguageNotification(languageName) {
        // Create notification element
        const notification = document.createElement('div');
        notification.className = 'language-notification';
        notification.innerHTML = `
            <i class="fa fa-globe"></i>
            <span>Language switched to ${languageName}</span>
        `;
        
        // Add notification styles
        notification.style.cssText = `
            position: fixed;
            top: 20px;
            right: 20px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 12px 20px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
            z-index: 9999;
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
            font-weight: 500;
            opacity: 0;
            transform: translateX(100%);
            transition: all 0.3s ease;
        `;
        
        document.body.appendChild(notification);
        
        // Animate in
        setTimeout(() => {
            notification.style.opacity = '1';
            notification.style.transform = 'translateX(0)';
        }, 100);
        
        // Remove after 3 seconds
        setTimeout(() => {
            notification.style.opacity = '0';
            notification.style.transform = 'translateX(100%)';
            setTimeout(() => {
                if (notification.parentNode) {
                    notification.parentNode.removeChild(notification);
                }
            }, 300);
        }, 3000);
    }
});
</script>