/**
 * Notification Badge JavaScript Enhancement
 * Adds dynamic notification count updates and visual feedback
 */

document.addEventListener('DOMContentLoaded', function() {
    // Function to update notification count
    function updateNotificationCount() {
        fetch('/notifications/count', {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            const badges = document.querySelectorAll('.notification-badge, .badge-danger');
            badges.forEach(badge => {
                if (data.count > 0) {
                    badge.textContent = data.count;
                    badge.style.display = 'inline';
                } else {
                    badge.style.display = 'none';
                }
            });
        })
        .catch(error => {
            console.log('Failed to update notification count:', error);
        });
    }

    // Function to mark notification as read
    function markNotificationRead(notificationId) {
        fetch(`/notifications/mark-read/${notificationId}`, {
            method: 'POST',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                updateNotificationCount();
            }
        })
        .catch(error => {
            console.log('Failed to mark notification as read:', error);
        });
    }

    // Function to mark all notifications as read
    function markAllNotificationsRead() {
        fetch('/notifications/mark-all-read', {
            method: 'POST',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                updateNotificationCount();
                // Hide all unread indicators on the page
                document.querySelectorAll('.notification-unread').forEach(el => {
                    el.classList.remove('notification-unread');
                });
            }
        })
        .catch(error => {
            console.log('Failed to mark all notifications as read:', error);
        });
    }

    // Add click handlers for notification items (if on notifications page)
    document.querySelectorAll('.notification-item').forEach(item => {
        item.addEventListener('click', function() {
            const notificationId = this.dataset.notificationId;
            if (notificationId && this.classList.contains('notification-unread')) {
                markNotificationRead(notificationId);
                this.classList.remove('notification-unread');
            }
        });
    });

    // Add click handler for mark all as read button
    const markAllBtn = document.getElementById('markAllAsRead');
    if (markAllBtn) {
        markAllBtn.addEventListener('click', function(e) {
            e.preventDefault();
            markAllNotificationsRead();
        });
    }

    // Add hover effect for notification bell
    const notificationLinks = document.querySelectorAll('a[href*="notifications"]');
    notificationLinks.forEach(link => {
        link.addEventListener('mouseenter', function() {
            const bell = this.querySelector('.fa-bell');
            if (bell) {
                bell.classList.add('fa-bell-o');
                bell.classList.remove('fa-bell');
            }
        });
        
        link.addEventListener('mouseleave', function() {
            const bell = this.querySelector('.fa-bell-o');
            if (bell) {
                bell.classList.add('fa-bell');
                bell.classList.remove('fa-bell-o');
            }
        });
    });

    // Auto-update notification count every 30 seconds
    setInterval(updateNotificationCount, 30000);
});
