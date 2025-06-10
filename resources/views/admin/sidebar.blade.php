<nav id="sidebar">
        <!-- Sidebar Header-->
        <div class="sidebar-header d-flex align-items-center">
          <div class="avatar"><img src="{{ asset('admincss/img/setting.png') }}" alt="..." class="img-fluid rounded-circle"></div>
          <div class="title">
            <h1 class="h5">{{ __('admin.admin_panel') }}</h1>
            <p>{{ __('admin.control_center') }}</p>
          </div>
        </div>
        
        <!-- Sidebar Navigation Menus-->
        <span class="heading">{{ __('admin.main_dashboard') }}</span>
        <ul class="list-unstyled">
                <li class="{{ request()->routeIs('home.homepage') || request()->routeIs('admin.index') ? 'active' : '' }}">
                    <a href="{{ url('home') }}"> <i class="icon-home"></i>{{ __('admin.dashboard_home') }} </a>
                </li>
                <li class="{{ request()->routeIs('admin.analytics') ? 'active' : '' }}"> 
                    <a href="{{ route('admin.analytics') }}"> <i class="fa fa-bar-chart"></i>{{ __('admin.analytics') }} </a>
                </li>
        </ul>
        
        <span class="heading">{{ __('admin.content_management') }}</span>
        <ul class="list-unstyled">
                <li class="{{ request()->routeIs('admin.show_posts') ? 'active' : '' }}">
                    <a href="{{ route('admin.show_posts') }}"> <i class="icon-grid"></i>{{ __('admin.manage_posts') }} </a>
                </li>
                <li class="{{ request()->routeIs('admin.categories_tags') ? 'active' : '' }}">
                    <a href="{{ route('admin.categories_tags') }}"> <i class="icon-tag"></i>{{ __('admin.categories_tags') }} </a>
                </li>
        </ul>
        
        <span class="heading">{{ __('admin.user_communication') }}</span>
        <ul class="list-unstyled">
                <li class="{{ request()->routeIs('admin.users.index') ? 'active' : '' }}">
                    <a href="{{ route('admin.users.index') }}"> <i class="icon-user"></i>{{ __('admin.user_management') }} </a>
                </li>
                <li class="{{ request()->routeIs('admin.comments.index') ? 'active' : '' }}">
                    <a href="{{ route('admin.comments.index') }}"> <i class="icon-speech"></i>{{ __('admin.comments') }} </a>
                </li>
                <li class="{{ request()->routeIs('admin.announcement_page') ? 'active' : '' }}">
                    <a href="{{ route('admin.announcement_page') }}"> <i class="icon-megaphone"></i>{{ __('admin.create_announcement') }} </a>
                </li>
                <li class="{{ request()->routeIs('admin.show_announcements') ? 'active' : '' }}">
                    <a href="{{ route('admin.show_announcements') }}"> <i class="icon-list"></i>{{ __('admin.manage_announcements') }} </a>
                </li>
        </ul>
        
        <span class="heading">{{ __('admin.reports_settings') }}</span>
        <ul class="list-unstyled">
          <li class="{{ request()->routeIs('admin.analytics') ? 'active' : '' }}">
            <a href="{{ route('admin.analytics') }}"> <i class="fa fa-line-chart"></i>{{ __('admin.analytics') }} </a>
          </li>
          <li class="{{ request()->routeIs('admin.settings') ? 'active' : '' }}">
            <a href="{{ route('admin.settings') }}"> <i class="icon-settings"></i>{{ __('admin.settings') }} </a>
          </li>
          <li> <a href="#" onclick="showComingSoon('Backup & Export')"> <i class="icon-cloud-download"></i>{{ __('admin.backup') }} </a></li>
        </ul>
        
        <span class="heading">{{ __('admin.quick_actions') }}</span>
        <ul class="list-unstyled">
          <li> <a href="{{ route('home.homepage') }}" target="_blank"> <i class="icon-eye"></i>{{ __('admin.view_website') }} </a></li>
          <li> <a href="{{ route('profile.show') }}"> <i class="icon-user"></i>{{ __('admin.my_profile') }} </a></li>
        </ul>
      </nav>

<script>
// Enhanced Coming Soon Function with Better UX
function showComingSoon(feature) {
    // Create custom modal instead of alert
    const modal = document.createElement('div');
    modal.className = 'coming-soon-modal';
    modal.innerHTML = `
        <div class="coming-soon-content">
            <div class="coming-soon-header">
                <i class="fa fa-rocket"></i>
                <h3>🚧 Coming Soon!</h3>
                <button class="close-modal" onclick="closeComingSoonModal()">&times;</button>
            </div>
            <div class="coming-soon-body">
                <p><strong>${feature}</strong> is currently under development and will be available in the next update.</p>
                <div class="coming-soon-features">
                    <div class="feature-item">
                        <i class="fa fa-check"></i>
                        <span>Enhanced functionality</span>
                    </div>
                    <div class="feature-item">
                        <i class="fa fa-check"></i>
                        <span>Modern interface</span>
                    </div>
                    <div class="feature-item">
                        <i class="fa fa-check"></i>
                        <span>Better user experience</span>
                    </div>
                </div>
                <div class="coming-soon-footer">
                    <button class="btn btn-primary" onclick="closeComingSoonModal()">Got it!</button>
                </div>
            </div>
        </div>
    `;
    
    // Add styles for the modal
    const style = document.createElement('style');
    style.textContent = `
        .coming-soon-modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 2000;
            animation: fadeIn 0.3s ease;
        }
        
        .coming-soon-content {
            background: #fff;
            border-radius: 12px;
            max-width: 400px;
            width: 90%;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            animation: slideIn 0.3s ease;
            overflow: hidden;
        }
        
        .coming-soon-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #fff;
            padding: 20px 25px;
            text-align: center;
            position: relative;
        }
        
        .coming-soon-header i {
            font-size: 2rem;
            margin-bottom: 10px;
            display: block;
        }
        
        .coming-soon-header h3 {
            margin: 0;
            font-size: 1.5rem;
            font-weight: 700;
        }
        
        .close-modal {
            position: absolute;
            top: 15px;
            right: 20px;
            background: none;
            border: none;
            color: #fff;
            font-size: 24px;
            cursor: pointer;
            opacity: 0.8;
            transition: opacity 0.3s ease;
        }
        
        .close-modal:hover {
            opacity: 1;
        }
        
        .coming-soon-body {
            padding: 25px;
            text-align: center;
        }
        
        .coming-soon-body p {
            color: #666;
            margin-bottom: 20px;
            line-height: 1.6;
        }
        
        .coming-soon-features {
            margin: 20px 0;
            text-align: left;
        }
        
        .feature-item {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
            color: #333;
        }
        
        .feature-item i {
            color: #28a745;
            margin-right: 12px;
            font-size: 14px;
        }
        
        .coming-soon-footer {
            margin-top: 25px;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        
        @keyframes slideIn {
            from { transform: translateY(-50px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
    `;
    
    document.head.appendChild(style);
    document.body.appendChild(modal);
    
    // Close modal when clicking outside
    modal.addEventListener('click', function(e) {
        if (e.target === modal) {
            closeComingSoonModal();
        }
    });
}

function closeComingSoonModal() {
    const modal = document.querySelector('.coming-soon-modal');
    if (modal) {
        modal.style.animation = 'fadeOut 0.3s ease';
        setTimeout(() => {
            modal.remove();
        }, 300);
    }
}

// Enhanced sidebar interactions
document.addEventListener('DOMContentLoaded', function() {
    // Add fade-in animation to sidebar items
    const sidebarItems = document.querySelectorAll('#sidebar ul li');
    sidebarItems.forEach((item, index) => {
        item.style.animationDelay = (index * 0.1) + 's';
        item.classList.add('fade-in');
    });
    
    // Add active state persistence
    const currentPath = window.location.pathname;
    sidebarItems.forEach(item => {
        const link = item.querySelector('a');
        if (link && link.getAttribute('href') === currentPath) {
            item.classList.add('active');
        }
    });
    
    // Add ripple effect to sidebar links
    sidebarItems.forEach(item => {
        const link = item.querySelector('a');
        if (link) {
            link.addEventListener('click', function(e) {
                if (this.getAttribute('onclick')) {
                    e.preventDefault();
                    const onclickAttr = this.getAttribute('onclick');
                    if (onclickAttr.includes('showComingSoon')) {
                        const feature = onclickAttr.match(/showComingSoon\('(.+?)'\)/)[1];
                        showComingSoon(feature);
                    }
                } else {
                    // Add ripple effect for navigation
                    const ripple = document.createElement('div');
                    ripple.className = 'ripple-effect';
                    ripple.style.cssText = `
                        position: absolute;
                        top: 50%;
                        left: 50%;
                        width: 0;
                        height: 0;
                        border-radius: 50%;
                        background: rgba(52, 152, 219, 0.3);
                        transform: translate(-50%, -50%);
                        animation: ripple 0.6s ease-out;
                        pointer-events: none;
                        z-index: 1;
                    `;
                    
                    this.style.position = 'relative';
                    this.appendChild(ripple);
                    
                    setTimeout(() => {
                        ripple.remove();
                    }, 600);
                }
            });
        }
    });
});

// Add ripple animation keyframes
const rippleStyle = document.createElement('style');
rippleStyle.textContent = `
    @keyframes ripple {
        to {
            width: 100px;
            height: 100px;
            opacity: 0;
        }
    }
    
    @keyframes fadeOut {
        from { opacity: 1; }
        to { opacity: 0; }
    }
`;
document.head.appendChild(rippleStyle);
</script>
