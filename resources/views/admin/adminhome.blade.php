<!DOCTYPE html>
<html>
  <head> 
   @include('admin.admincss')
  </head>
  <body>
    <header class="header">   
     @include('admin.header ')
    </header>
    <div class="d-flex align-items-stretch">
      <!-- Sidebar Navigation-->
      @include('admin.sidebar')
      <!-- Sidebar Navigation end-->
      @include('admin.body')
      @include('admin.footer')
        
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
                
                // Show welcome notification
                setTimeout(() => {
                    showAdminNotification('Welcome to your admin dashboard! Everything is running smoothly.', 'success');
                }, 1000);
            });
            
            // Number animation function
            function animateNumber(element, start, end, duration) {
                const range = end - start;
                const increment = end > start ? 1 : -1;
                const stepTime = Math.abs(Math.floor(duration / range));
                let current = start;
                
                const timer = setInterval(() => {
                    current += increment;
                    element.textContent = current;
                    
                    if (current === end) {
                        clearInterval(timer);
                        // Add a subtle bounce effect
                        element.style.transform = 'scale(1.1)';
                        setTimeout(() => {
                            element.style.transition = 'transform 0.3s ease';
                            element.style.transform = 'scale(1)';
                        }, 150);
                    }
                }, stepTime);
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