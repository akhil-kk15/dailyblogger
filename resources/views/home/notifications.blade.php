<!DOCTYPE html>
<html lang="en">
<head>
    <!-- basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- mobile metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <!-- site metas -->
    <title>Daily Blogger - Notifications</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- bootstrap css -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <!-- style css -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <!-- Responsive-->
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
    <!-- fevicon -->
    <link rel="icon" href="{{ asset('images/fevicon.png') }}" type="image/gif" />
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/jquery.mCustomScrollbar.min.css') }}">
    <!-- Tweaks for older IEs-->
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
</head>
<body class="main-layout">
    <!-- header -->
    <div class="header_section">
        @include('home.homecss')
        @include('home.header')
    </div>
    <!-- end header -->

    <!-- notifications section start -->
    <div class="services_section layout_padding" style="background: #f8f9fa; min-height: 70vh;">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h1 class="services_taital" style="text-align: center; margin-bottom: 50px;">
                        <i class="fa fa-bell"></i> Your Notifications
                    </h1>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-12">
                    @if($notifications->count() > 0)
                        <!-- Mark All as Read Button -->
                        <div class="text-right mb-4">
                            <button id="markAllReadBtn" class="btn btn-primary btn-sm">
                                <i class="fa fa-check"></i> Mark All as Read
                            </button>
                        </div>

                        <!-- Notifications List -->
                        <div class="notifications-container">
                            @foreach($notifications as $notification)
                                <div class="notification-item {{ $notification->is_read ? 'read' : 'unread' }}" 
                                     data-notification-id="{{ $notification->id }}"
                                     style="border: 1px solid; 
                                            border-radius: 8px; 
                                            padding: 20px; 
                                            margin-bottom: 15px; 
                                            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
                                            border-left-width: 4px;">
                                    <div class="row">
                                        <div class="col-md-1">
                                            @if($notification->type == 'post_approved')
                                                <i class="fa fa-check-circle text-success" style="font-size: 24px;"></i>
                                            @elseif($notification->type == 'post_rejected')
                                                <i class="fa fa-times-circle text-danger" style="font-size: 24px;"></i>
                                            @elseif($notification->type == 'comment_added')
                                                <i class="fa fa-comment text-info" style="font-size: 24px;"></i>
                                            @elseif($notification->type == 'announcement')
                                                <i class="fa fa-bullhorn text-warning" style="font-size: 24px;"></i>
                                            @else
                                                <i class="fa fa-bell text-primary" style="font-size: 24px;"></i>
                                            @endif
                                        </div>
                                        <div class="col-md-11">
                                            <div class="notification-content">
                                                <h5 style="margin-bottom: 10px; font-weight: 600;">
                                                    {{ $notification->title }}
                                                    @if(!$notification->is_read)
                                                        <span class="badge badge-primary ml-2">New</span>
                                                    @endif
                                                </h5>
                                                <p style="margin-bottom: 10px; line-height: 1.5;">
                                                    {{ $notification->message }}
                                                </p>
                                                <div class="notification-footer d-flex justify-content-between align-items-center">
                                                    <small class="text-muted">
                                                        <i class="fa fa-clock-o"></i> 
                                                        {{ $notification->created_at->diffForHumans() }}
                                                    </small>
                                                    @if($notification->post_id)
                                                        <a href="{{ route('home.post_details', $notification->post_id) }}" 
                                                           class="btn btn-sm btn-outline-primary">
                                                            <i class="fa fa-eye"></i> View Post
                                                        </a>
                                                    @elseif($notification->type == 'announcement')
                                                        <span class="badge badge-warning">
                                                            <i class="fa fa-bullhorn"></i> Announcement
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Pagination if needed -->
                        @if($notifications instanceof \Illuminate\Pagination\LengthAwarePaginator)
                            <div class="d-flex justify-content-center mt-4">
                                {{ $notifications->links() }}
                            </div>
                        @endif
                    @else
                        <!-- No Notifications -->
                        <div class="text-center" style="padding: 60px 20px;">
                            <i class="fa fa-bell-o" style="font-size: 64px; color: #ccc; margin-bottom: 20px;"></i>
                            <h3 style="color: #999; margin-bottom: 15px;">No Notifications Yet</h3>
                            <p style="color: #666; font-size: 16px;">
                                You'll receive notifications when your posts are approved/rejected or when someone comments on your posts.
                            </p>
                            <a href="{{ route('home.homepage') }}" class="btn btn-primary mt-3">
                                <i class="fa fa-home"></i> Go to Homepage
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- notifications section end -->

    <!-- footer start -->
    @include('home.footer')
    <!-- footer end -->

    <script>
        $(document).ready(function() {
            // Check if dark mode is active
            function isDarkMode() {
                return document.body.classList.contains('dark-mode');
            }

            // Get appropriate colors based on theme
            function getThemeColors() {
                if (isDarkMode()) {
                    return {
                        readBackground: '#2d2d2d',
                        readBorderLeft: '#666',
                        unreadBackground: '#2a3f5f',
                        unreadBorderLeft: '#67a3ff'
                    };
                } else {
                    return {
                        readBackground: '#ffffff',
                        readBorderLeft: '#ccc',
                        unreadBackground: '#e3f2fd',
                        unreadBorderLeft: '#2196F3'
                    };
                }
            }

            // Mark individual notification as read when clicked
            $('.notification-item.unread').click(function() {
                var notificationId = $(this).data('notification-id');
                var notificationItem = $(this);
                
                $.ajax({
                    url: '/notifications/mark-read/' + notificationId,
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.success) {
                            var colors = getThemeColors();
                            notificationItem.removeClass('unread').addClass('read');
                            notificationItem.css({
                                'background': colors.readBackground,
                                'border-left-color': colors.readBorderLeft
                            });
                            notificationItem.find('.badge-primary').remove();
                            updateNotificationCount();
                        }
                    }
                });
            });

            // Mark all notifications as read
            $('#markAllReadBtn').click(function() {
                $.ajax({
                    url: '{{ route("notifications.mark_all_read") }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.success) {
                            var colors = getThemeColors();
                            $('.notification-item.unread').each(function() {
                                $(this).removeClass('unread').addClass('read');
                                $(this).css({
                                    'background': colors.readBackground,
                                    'border-left-color': colors.readBorderLeft
                                });
                                $(this).find('.badge-primary').remove();
                            });
                            $('#markAllReadBtn').hide();
                            updateNotificationCount();
                        }
                    }
                });
            });

            // Hide mark all read button if no unread notifications
            if ($('.notification-item.unread').length === 0) {
                $('#markAllReadBtn').hide();
            }
        });

        function updateNotificationCount() {
            $.get('{{ route("notifications.count") }}', function(data) {
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
            });
        }
    </script>

    <style>
        .notification-item {
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .notification-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.15) !important;
        }

        .notification-item.unread:hover {
            background: #bbdefb !important;
        }

        .notification-content h5 {
            margin-bottom: 8px;
        }

        .notification-footer {
            margin-top: 15px;
            padding-top: 10px;
            border-top: 1px solid #eee;
        }

        @media (max-width: 768px) {
            .notification-item {
                padding: 15px;
            }
            
            .notification-item .col-md-1 {
                text-align: center;
                margin-bottom: 10px;
            }
        }

        /* Dark Mode Styling for Notifications */
        body.dark-mode {
            background-color: #1a1a1a !important;
            color: #e1e1e1 !important;
        }

        body.dark-mode .services_section {
            background: #1a1a1a !important;
        }

        body.dark-mode .services_taital {
            color: #e1e1e1 !important;
        }

        /* Dark Mode Notification Items */
        body.dark-mode .notification-item {
            background: #2d2d2d !important;
            border-color: #495057 !important;
            box-shadow: 0 2px 4px rgba(0,0,0,0.3) !important;
        }

        body.dark-mode .notification-item.unread {
            background: #2a3f5f !important;
            border-left-color: #67a3ff !important;
        }

        body.dark-mode .notification-item.read {
            background: #2d2d2d !important;
            border-left-color: #666 !important;
        }

        body.dark-mode .notification-item:hover {
            background: #3a3a3a !important;
            box-shadow: 0 4px 8px rgba(0,0,0,0.4) !important;
        }

        body.dark-mode .notification-item.unread:hover {
            background: #3d5a85 !important;
        }

        /* Dark Mode Text Colors */
        body.dark-mode .notification-content h5 {
            color: #e1e1e1 !important;
        }

        body.dark-mode .notification-content p {
            color: #b0b0b0 !important;
        }

        body.dark-mode .text-muted {
            color: #888 !important;
        }

        body.dark-mode .notification-footer {
            border-top-color: #495057 !important;
        }

        /* Dark Mode Icons */
        body.dark-mode .text-success {
            color: #5cb85c !important;
        }

        body.dark-mode .text-danger {
            color: #d9534f !important;
        }

        body.dark-mode .text-info {
            color: #5bc0de !important;
        }

        body.dark-mode .text-warning {
            color: #f0ad4e !important;
        }

        body.dark-mode .text-primary {
            color: #67a3ff !important;
        }

        /* Dark Mode Badges */
        body.dark-mode .badge-primary {
            background-color: #67a3ff !important;
            color: #fff !important;
        }

        body.dark-mode .badge-warning {
            background-color: #f0ad4e !important;
            color: #333 !important;
        }

        /* Dark Mode Buttons */
        body.dark-mode .btn-primary {
            background-color: #67a3ff !important;
            border-color: #67a3ff !important;
            color: #fff !important;
        }

        body.dark-mode .btn-primary:hover {
            background-color: #5a91e6 !important;
            border-color: #5a91e6 !important;
        }

        body.dark-mode .btn-outline-primary {
            color: #67a3ff !important;
            border-color: #67a3ff !important;
            background-color: transparent !important;
        }

        body.dark-mode .btn-outline-primary:hover {
            background-color: #67a3ff !important;
            border-color: #67a3ff !important;
            color: #fff !important;
        }

        /* Dark Mode Empty State */
        body.dark-mode .text-center i {
            color: #666 !important;
        }

        body.dark-mode .text-center h3 {
            color: #b0b0b0 !important;
        }

        body.dark-mode .text-center p {
            color: #888 !important;
        }

        /* Dark Mode Container */
        body.dark-mode .container {
            background-color: transparent !important;
        }

        /* Dark Mode Pagination */
        body.dark-mode .pagination .page-link {
            background-color: #2d2d2d !important;
            border-color: #495057 !important;
            color: #e1e1e1 !important;
        }

        body.dark-mode .pagination .page-link:hover {
            background-color: #3a3a3a !important;
            border-color: #67a3ff !important;
            color: #67a3ff !important;
        }

        body.dark-mode .pagination .page-item.active .page-link {
            background-color: #67a3ff !important;
            border-color: #67a3ff !important;
            color: #fff !important;
        }

        /* Dark Mode Responsive Adjustments */
        @media (max-width: 768px) {
            body.dark-mode .notification-item {
                background: #2d2d2d !important;
                border-color: #495057 !important;
            }

            body.dark-mode .notification-item.unread {
                background: #2a3f5f !important;
            }
        }
    </style>
</body>
</html>
