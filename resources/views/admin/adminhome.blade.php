<!DOCTYPE html>
<html>
  <head> 
   @include('admin.admincss')
  </head>
  <body>
    <div class="admin-layout-container">
      <!-- Header that spans full width -->
      <header class="header">   
        @include('admin.header ')
      </header>
      
      <!-- Main content area with sidebar and body -->
      <div class="admin-main-content d-flex align-items-stretch">
        <!-- Sidebar Navigation-->
        @include('admin.sidebar')
        <!-- Sidebar Navigation end-->
        
        <!-- Page Content -->
        @include('admin.body')
      </div>
      
      <!-- Footer -->
      @include('admin.footer')
    </div>
        
        <!-- Enhanced Admin Dashboard JavaScript -->
        <script>
            // Real-time clock
            function updateClock() {
                const now = new Date();
                const timeString = now.toLocaleTimeString('en-US', {
                    hour12: true,
                    hour: '2-digit',
                    minute: '2-digit',
                    second: '2-digit'
                });
                const clockElement = document.getElementById('current-time');
                if (clockElement) {
                    clockElement.textContent = timeString;
                }
            }
            
            // Update clock every second
            setInterval(updateClock, 1000);
            updateClock(); // Initial call
            
            // Enhanced dashboard animations
            document.addEventListener('DOMContentLoaded', function() {
                // Animate statistic numbers on load
                const statNumbers = document.querySelectorAll('.statistic-block .number');
                statNumbers.forEach(numberElement => {
                    const finalNumber = parseInt(numberElement.textContent);
                    if (!isNaN(finalNumber)) {
                        animateNumber(numberElement, 0, finalNumber, 2000);
                    }
                });
                
                // Animate welcome stats
                const welcomeStats = document.querySelectorAll('.stat-number');
                welcomeStats.forEach((statElement, index) => {
                    const finalNumber = parseInt(statElement.textContent);
                    if (!isNaN(finalNumber)) {
                        setTimeout(() => {
                            animateNumber(statElement, 0, finalNumber, 1500);
                        }, index * 200);
                    }
                });
                
                // Add hover effects to statistic blocks
                const statisticBlocks = document.querySelectorAll('.statistic-block');
                statisticBlocks.forEach(block => {
                    block.addEventListener('mouseenter', function() {
                        this.style.transform = 'translateY(-8px) scale(1.02)';
                    });
                    
                    block.addEventListener('mouseleave', function() {
                        this.style.transform = 'translateY(0) scale(1)';
                    });
                });
                
                // Progress bar animations
                const progressBars = document.querySelectorAll('.progress-bar-template');
                progressBars.forEach(bar => {
                    const width = bar.style.width;
                    bar.style.width = '0%';
                    
                    setTimeout(() => {
                        bar.style.transition = 'width 1.5s ease-out';
                        bar.style.width = width;
                    }, 500);
                });
                
                // Animation complete - no welcome notification needed
                
                // Start real-time updates
                startRealTimeUpdates();
            });
            
            // Real-time updates function
            function startRealTimeUpdates() {
                // Update every 30 seconds
                setInterval(updateDashboardStats, 30000);
            }
            
            function updateDashboardStats() {
                fetch('{{ route("admin.dashboard.stats") }}', {
                    method: 'GET',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    // Update welcome stats
                    const welcomeStats = document.querySelectorAll('.stat-number');
                    if (welcomeStats.length >= 4) {
                        animateNumber(welcomeStats[0], parseInt(welcomeStats[0].textContent), data.totalPosts, 1000);
                        animateNumber(welcomeStats[1], parseInt(welcomeStats[1].textContent), data.totalUsers, 1000);
                        animateNumber(welcomeStats[2], parseInt(welcomeStats[2].textContent), data.approvedPosts, 1000);
                        animateNumber(welcomeStats[3], parseInt(welcomeStats[3].textContent), data.pendingPosts, 1000);
                    }
                    
                    // Update main statistics
                    const statNumbers = document.querySelectorAll('.statistic-block .number');
                    if (statNumbers.length >= 4) {
                        animateNumber(statNumbers[0], parseInt(statNumbers[0].textContent), data.totalUsers, 1000);
                        animateNumber(statNumbers[1], parseInt(statNumbers[1].textContent), data.totalPosts, 1000);
                        animateNumber(statNumbers[2], parseInt(statNumbers[2].textContent), data.pendingPosts, 1000);
                        animateNumber(statNumbers[3], parseInt(statNumbers[3].textContent), data.approvedPosts, 1000);
                    }
                    
                    // Update progress bars
                    updateProgressBars(data);
                    
                    // Update "this month" text
                    updateMonthlyStats(data);
                })
                .catch(error => {
                    console.log('Failed to update dashboard stats:', error);
                });
            }
            
            function updateProgressBars(data) {
                const progressBars = document.querySelectorAll('.progress-bar-template');
                
                if (progressBars.length >= 4) {
                    // Calculate new progress values
                    const totalUsers = Math.max(data.totalUsers, 1);
                    const totalPosts = Math.max(data.totalPosts, 1);
                    
                    const userProgress = Math.min(Math.max((data.recentUsers / totalUsers) * 100, 0), 100);
                    const postProgress = Math.min(Math.max((data.recentPosts / totalPosts) * 100, 0), 100);
                    const pendingProgress = Math.min(Math.max((data.pendingPosts / totalPosts) * 100, 0), 100);
                    const approvedProgress = Math.min(Math.max((data.approvedPosts / totalPosts) * 100, 0), 100);
                    
                    // Animate progress bars
                    animateProgressBar(progressBars[0], userProgress);
                    animateProgressBar(progressBars[1], postProgress);
                    animateProgressBar(progressBars[2], pendingProgress);
                    animateProgressBar(progressBars[3], approvedProgress);
                }
            }
            
            function animateProgressBar(element, targetWidth) {
                element.style.transition = 'width 1s ease-in-out';
                element.style.width = targetWidth + '%';
                element.setAttribute('aria-valuenow', targetWidth);
            }
            
            function updateMonthlyStats(data) {
                const monthlyTexts = document.querySelectorAll('.text-muted');
                if (monthlyTexts.length >= 4) {
                    monthlyTexts[0].textContent = '+' + (data.recentUsers || 0) + ' this month';
                    monthlyTexts[1].textContent = '+' + (data.recentPosts || 0) + ' this month';
                    monthlyTexts[2].textContent = 'Needs attention';
                    monthlyTexts[3].textContent = '+' + (data.recentApproved || 0) + ' this month';
                }
            }
            
            // Enhanced Number animation function
            function animateNumber(element, start, end, duration) {
                // Ensure we have valid numbers
                start = parseInt(start) || 0;
                end = parseInt(end) || 0;
                duration = duration || 2000;
                
                // If end is 0 or negative, just set it directly
                if (end <= 0) {
                    element.textContent = end;
                    return;
                }
                
                // Use requestAnimationFrame for smoother animation
                const startTime = performance.now();
                
                function updateNumber(currentTime) {
                    const elapsed = currentTime - startTime;
                    const progress = Math.min(elapsed / duration, 1);
                    
                    // Use easeOutCubic for better animation feel
                    const easeProgress = 1 - Math.pow(1 - progress, 3);
                    const current = Math.floor(start + (end - start) * easeProgress);
                    
                    element.textContent = current;
                    
                    if (progress < 1) {
                        requestAnimationFrame(updateNumber);
                    } else {
                        // Ensure final value is correct
                        element.textContent = end;
                        
                        // Add a subtle bounce effect
                        element.style.transform = 'scale(1.1)';
                        setTimeout(() => {
                            element.style.transition = 'transform 0.3s ease';
                            element.style.transform = 'scale(1)';
                        }, 150);
                    }
                }
                
                requestAnimationFrame(updateNumber);
            }
            
            // Enhanced notification system
            function showAdminNotification(message, type, duration) {
                type = type || 'info';
                duration = duration || 4000;
                
                const notification = document.createElement('div');
                notification.className = 'admin-notification ' + type;
                
                const iconMap = {
                    'success': 'fa-check-circle',
                    'error': 'fa-exclamation-circle', 
                    'warning': 'fa-warning',
                    'info': 'fa-info-circle'
                };
                
                notification.innerHTML = '<div class="notification-content">' +
                    '<i class="notification-icon fa ' + (iconMap[type] || iconMap.info) + '"></i>' +
                    '<span class="notification-message">' + message + '</span>' +
                    '<button class="notification-close" onclick="this.parentElement.parentElement.remove()">' +
                    '<i class="fa fa-times"></i>' +
                    '</button>' +
                    '</div>';
                
                // Add notification styles if not already added
                if (!document.getElementById('notification-styles')) {
                    const style = document.createElement('style');
                    style.id = 'notification-styles';
                    style.textContent = '.admin-notification{position:fixed;top:20px;right:20px;max-width:400px;padding:15px 20px;border-radius:8px;box-shadow:0 8px 25px rgba(0,0,0,0.15);z-index:2000;transform:translateX(400px);transition:transform 0.3s ease;backdrop-filter:blur(10px);}.admin-notification.info{background:linear-gradient(135deg,#667eea 0%,#764ba2 100%);color:white;}.admin-notification.success{background:linear-gradient(135deg,#4facfe 0%,#00f2fe 100%);color:white;}.admin-notification.error{background:linear-gradient(135deg,#f093fb 0%,#f5576c 100%);color:white;}.notification-content{display:flex;align-items:center;gap:12px;}.notification-icon{font-size:18px;}.notification-message{flex:1;font-weight:500;}.notification-close{background:none;border:none;color:inherit;cursor:pointer;padding:4px;border-radius:4px;transition:background 0.3s ease;}.notification-close:hover{background:rgba(255,255,255,0.2);}';
                    document.head.appendChild(style);
                }
                
                document.body.appendChild(notification);
                
                // Animate in
                setTimeout(() => {
                    notification.style.transform = 'translateX(0)';
                }, 100);
                
                // Auto remove
                setTimeout(() => {
                    notification.style.transform = 'translateX(400px)';
                    setTimeout(() => {
                        if (notification.parentElement) {
                            notification.remove();
                        }
                    }, 300);
                }, duration);
            }
        </script>
  </body>
</html>