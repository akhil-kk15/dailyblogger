<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>📊 Daily Blogger - Admin Dashboard</title>
    <meta name="description" content="Professional admin dashboard for Daily Blogger platform">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="/admincss/vendor/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="/admincss/vendor/font-awesome/css/font-awesome.min.css">
    <!-- Custom Font Icons CSS-->
    <link rel="stylesheet" href="/admincss/css/font.css">
    <!-- Google fonts - Muli-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Muli:300,400,700">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="/admincss/css/style.default.css" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="/admincss/css/custom.css">
    <!-- Favicon-->
    <link rel="shortcut icon" href="/admincss/img/favicon.ico">
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
    
    <!-- Custom Admin Panel Styles -->
    <style>
    /* Enhanced Admin Panel Design System */
    :root {
        --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        --secondary-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        --success-gradient: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        --sidebar-gradient: linear-gradient(180deg, #2c3e50 0%, #34495e 100%);
        --shadow-soft: 0 4px 20px rgba(0,0,0,0.08);
        --shadow-hover: 0 8px 30px rgba(0,0,0,0.12);
        --border-radius: 12px;
        --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    /* Improved Admin Panel Organization */
    #sidebar {
        box-shadow: 2px 0 20px rgba(0,0,0,0.1);
        background: var(--sidebar-gradient);
        position: relative;
        overflow: hidden;
    }
    
    #sidebar::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: var(--primary-gradient);
        z-index: 10;
    }
    
    #sidebar .sidebar-header {
        padding: 30px 20px;
        border-bottom: 1px solid rgba(255,255,255,0.1);
        background: rgba(0,0,0,0.15);
        position: relative;
    }
    
    #sidebar .sidebar-header .avatar img {
        width: 50px;
        height: 50px;
        border: 3px solid rgba(52, 152, 219, 0.3);
        transition: var(--transition);
    }
    
    #sidebar .sidebar-header:hover .avatar img {
        border-color: #3498db;
        transform: scale(1.05);
    }
    
    #sidebar .sidebar-header .title h1 {
        color: #ecf0f1;
        font-weight: 700;
        margin-bottom: 5px;
        font-size: 18px;
    }
    
    #sidebar .sidebar-header .title p {
        color: #bdc3c7;
        font-size: 12px;
        opacity: 0.8;
    }
    
    #sidebar .heading {
        display: block;
        padding: 25px 20px 12px 20px;
        color: #3498db;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1.2px;
        border-top: 1px solid rgba(255,255,255,0.05);
        margin-top: 15px;
        position: relative;
    }
    
    #sidebar .heading::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 20px;
        right: 20px;
        height: 2px;
        background: linear-gradient(90deg, #3498db, transparent);
        border-radius: 1px;
    }
    
    #sidebar .heading:first-of-type {
        border-top: none;
        margin-top: 5px;
    }
    
    #sidebar ul.list-unstyled {
        margin-bottom: 15px;
    }
    
    #sidebar ul li {
        border-bottom: 1px solid rgba(255,255,255,0.03);
        position: relative;
        overflow: hidden;
    }
    
    #sidebar ul li::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(52, 152, 219, 0.1), transparent);
        transition: left 0.5s ease;
        z-index: 1;
    }
    
    #sidebar ul li:hover::before {
        left: 100%;
    }
    
    #sidebar ul li a {
        display: flex;
        align-items: center;
        padding: 16px 20px;
        color: #ecf0f1;
        text-decoration: none;
        transition: var(--transition);
        border-left: 3px solid transparent;
        position: relative;
        z-index: 2;
        font-weight: 500;
    }
    
    #sidebar ul li a:hover {
        background: rgba(52, 152, 219, 0.15);
        border-left-color: #3498db;
        color: #ffffff;
        transform: translateX(8px);
        box-shadow: inset 0 0 0 1px rgba(52, 152, 219, 0.2);
    }
    
    #sidebar ul li.active a {
        background: rgba(52, 152, 219, 0.25);
        border-left-color: #3498db;
        color: #ffffff;
        font-weight: 600;
        box-shadow: inset 0 0 0 1px rgba(52, 152, 219, 0.3);
    }
    
    #sidebar ul li a i {
        width: 22px;
        margin-right: 15px;
        text-align: center;
        font-size: 16px;
        transition: var(--transition);
    }
    
    #sidebar ul li a:hover i {
        transform: scale(1.1);
        color: #74b9ff;
    }
    
    /* Enhanced Header Design */
    .header {
        box-shadow: var(--shadow-soft);
        border-bottom: 1px solid #e9ecef;
        background: #ffffff;
        position: relative;
        z-index: 1000;
    }
    
    .navbar-brand {
        font-weight: 700 !important;
        background: var(--primary-gradient);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    
    /* Enhanced Page Content */
    .page-content {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        min-height: calc(100vh - 70px);
        position: relative;
    }
    
    .page-content::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 1px;
        background: var(--primary-gradient);
        z-index: 1;
    }
    
    /* Enhanced Card and Block Styling */
    .block {
        background: #ffffff;
        border-radius: var(--border-radius);
        box-shadow: var(--shadow-soft);
        border: 1px solid rgba(0,0,0,0.05);
        margin-bottom: 30px;
        transition: var(--transition);
        overflow: hidden;
    }
    
    .block:hover {
        box-shadow: var(--shadow-hover);
        transform: translateY(-2px);
    }
    
    .block .title {
        background: var(--primary-gradient);
        color: #fff;
        padding: 18px 25px;
        border-radius: var(--border-radius) var(--border-radius) 0 0;
        font-weight: 600;
        border-bottom: none;
        position: relative;
        overflow: hidden;
    }
    
    .block .title::after {
        content: '';
        position: absolute;
        top: 0;
        right: -50px;
        width: 100px;
        height: 100%;
        background: linear-gradient(45deg, transparent, rgba(255,255,255,0.1), transparent);
        transform: translateX(-100px);
        transition: transform 0.6s ease;
    }
    
    .block:hover .title::after {
        transform: translateX(300px);
    }
    
    /* Enhanced Button Styling */
    .btn {
        border-radius: 8px;
        font-weight: 600;
        transition: var(--transition);
        box-shadow: var(--shadow-soft);
        position: relative;
        overflow: hidden;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-size: 13px;
    }
    
    .btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        transition: left 0.5s ease;
    }
    
    .btn:hover::before {
        left: 100%;
    }
    
    .btn:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-hover);
    }
    
    .btn-primary {
        background: var(--primary-gradient);
        border: none;
    }
    
    .btn-success {
        background: var(--success-gradient);
        border: none;
    }
    
    .btn-danger {
        background: var(--secondary-gradient);
        border: none;
    }
    
    /* Enhanced Table Styling */
    .table {
        border-radius: var(--border-radius);
        overflow: hidden;
        box-shadow: var(--shadow-soft);
        background: #ffffff;
    }
    
    .table thead th {
        background: var(--primary-gradient);
        color: #fff;
        border: none;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 12px;
        letter-spacing: 0.8px;
        padding: 18px 15px;
        position: relative;
    }
    
    .table tbody tr {
        transition: var(--transition);
    }
    
    .table tbody tr:hover {
        background: rgba(52, 152, 219, 0.05);
        transform: scale(1.002);
    }
    
    .table tbody td {
        padding: 15px;
        border-bottom: 1px solid rgba(0,0,0,0.05);
        vertical-align: middle;
    }
    
    /* Enhanced Alert Styling */
    .alert {
        border-radius: var(--border-radius);
        border: none;
        box-shadow: var(--shadow-soft);
        position: relative;
        overflow: hidden;
        font-weight: 500;
    }
    
    .alert::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        bottom: 0;
        width: 4px;
        background: rgba(255,255,255,0.7);
    }
    
    .alert-success {
        background: var(--success-gradient);
        color: #fff;
    }
    
    .alert-danger {
        background: var(--secondary-gradient);
        color: #fff;
    }
    
    .alert-info {
        background: var(--primary-gradient);
        color: #fff;
    }
    
    /* Enhanced Status Badge Styling */
    .status_badge {
        padding: 8px 16px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        position: relative;
        overflow: hidden;
        transition: var(--transition);
    }
    
    .status_badge::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(255,255,255,0.2) 0%, transparent 70%);
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    
    .status_badge:hover::before {
        opacity: 1;
    }
    
    .status_active {
        background: var(--success-gradient);
        color: #fff;
    }
    
    .status_pending {
        background: linear-gradient(135deg, #ffecd2 0%, #fcb69f 100%);
        color: #8b4513;
    }
    
    .status_rejected {
        background: var(--secondary-gradient);
        color: #fff;
    }
    
    /* Enhanced Page Header Styling */
    .page-header {
        background: #ffffff;
        border-radius: 0 0 var(--border-radius) var(--border-radius);
        box-shadow: var(--shadow-soft);
        margin-bottom: 30px;
        position: relative;
        overflow: hidden;
    }
    
    .page-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: var(--primary-gradient);
    }
    
    .page-header h2 {
        color: #2c3e50;
        font-weight: 700;
        margin-bottom: 5px;
        font-size: 24px;
        position: relative;
        z-index: 2;
    }
    
    /* Enhanced Stats Cards */
    .stats-card {
        background: #ffffff;
        border-radius: var(--border-radius);
        padding: 30px 25px;
        box-shadow: var(--shadow-soft);
        border: 1px solid rgba(0,0,0,0.05);
        transition: var(--transition);
        position: relative;
        overflow: hidden;
        text-align: center;
    }
    
    .stats-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: var(--primary-gradient);
        transform: scaleX(0);
        transition: transform 0.3s ease;
        transform-origin: left;
    }
    
    .stats-card:hover::before {
        transform: scaleX(1);
    }
    
    .stats-card:hover {
        transform: translateY(-8px);
        box-shadow: var(--shadow-hover);
    }
    
    .stats-card .icon {
        width: 70px;
        height: 70px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
        color: #fff;
        margin: 0 auto 20px;
        background: var(--primary-gradient);
        position: relative;
        overflow: hidden;
    }
    
    .stats-card .icon::after {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(255,255,255,0.3) 0%, transparent 70%);
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    
    .stats-card:hover .icon::after {
        opacity: 1;
    }
    
    .stats-card .number {
        font-size: 32px;
        font-weight: 800;
        color: #2c3e50;
        margin-bottom: 8px;
        line-height: 1;
    }
    
    .stats-card .label {
        color: #7f8c8d;
        font-size: 14px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    /* Enhanced Form Styling */
    .form-control {
        border-radius: 8px;
        border: 2px solid #e9ecef;
        padding: 12px 16px;
        transition: var(--transition);
        background: #ffffff;
    }
    
    .form-control:focus {
        border-color: #3498db;
        box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.1);
        background: #ffffff;
    }
    
    .form-group label {
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 8px;
        font-size: 14px;
    }
    
    /* Enhanced Navigation Breadcrumbs */
    .breadcrumb {
        background: #ffffff;
        border-radius: var(--border-radius);
        box-shadow: var(--shadow-soft);
        padding: 15px 20px;
        margin-bottom: 20px;
        border: 1px solid rgba(0,0,0,0.05);
    }
    
    .breadcrumb-item a {
        color: #3498db;
        text-decoration: none;
        font-weight: 500;
    }
    
    .breadcrumb-item.active {
        color: #6c757d;
    }
    
    /* Enhanced Statistic Blocks */
    .statistic-block {
        background: #ffffff;
        border-radius: var(--border-radius);
        padding: 25px;
        box-shadow: var(--shadow-soft);
        border: 1px solid rgba(0,0,0,0.05);
        transition: var(--transition);
        position: relative;
        overflow: hidden;
    }
    
    .statistic-block::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 4px;
        height: 100%;
        background: var(--primary-gradient);
        transform: scaleY(0);
        transition: transform 0.3s ease;
        transform-origin: bottom;
    }
    
    .statistic-block:hover::before {
        transform: scaleY(1);
    }
    
    .statistic-block:hover {
        transform: translateY(-5px);
        box-shadow: var(--shadow-hover);
    }
    
    .progress-template {
        height: 8px;
        border-radius: 4px;
        background: #e9ecef;
        overflow: hidden;
    }
    
    .progress-bar-template {
        background: var(--primary-gradient);
        transition: width 0.6s ease;
    }
    
    /* Enhanced Modal Styling */
    .modal-content {
        border-radius: var(--border-radius);
        border: none;
        box-shadow: 0 20px 60px rgba(0,0,0,0.2);
    }
    
    .modal-header {
        background: var(--primary-gradient);
        color: #ffffff;
        border-radius: var(--border-radius) var(--border-radius) 0 0;
        border-bottom: none;
    }
    
    .modal-title {
        font-weight: 700;
    }
    
    /* Enhanced Responsive Design */
    @media (max-width: 1199px) {
        #sidebar {
            transform: translateX(-100%);
            transition: var(--transition);
            position: fixed;
            z-index: 1050;
            height: 100vh;
        }
        
        #sidebar.active {
            transform: translateX(0);
        }
        
        .page-content {
            margin-left: 0;
            width: 100%;
        }
        
        .sidebar-toggle {
            display: block !important;
            z-index: 1051;
        }
        
        /* Backdrop for mobile sidebar */
        #sidebar.active::after {
            content: '';
            position: fixed;
            top: 0;
            left: 280px;
            right: 0;
            bottom: 0;
            background: rgba(0,0,0,0.5);
            z-index: -1;
        }
    }
    
    @media (max-width: 768px) {
        .stats-card {
            margin-bottom: 20px;
        }
        
        .stats-card .number {
            font-size: 28px;
        }
        
        .stats-card .icon {
            width: 60px;
            height: 60px;
            font-size: 24px;
        }
        
        #sidebar .heading {
            padding: 20px 15px 10px 15px;
        }
        
        #sidebar ul li a {
            padding: 14px 15px;
        }
        
        .block {
            margin-bottom: 20px;
        }
        
        .page-header h2 {
            font-size: 20px;
        }
    }
    
    @media (max-width: 576px) {
        .page-content {
            padding: 15px;
        }
        
        .stats-card {
            padding: 20px 15px;
        }
        
        .block .title {
            padding: 15px 20px;
        }
        
        .table-responsive {
            border-radius: var(--border-radius);
        }
    }
    
    /* Enhanced Animation Classes */
    .fade-in {
        animation: fadeIn 0.5s ease-in;
    }
    
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    .slide-in-left {
        animation: slideInLeft 0.3s ease-out;
    }
    
    @keyframes slideInLeft {
        from { transform: translateX(-100%); }
        to { transform: translateX(0); }
    }
    
    /* Enhanced Loading States */
    .loading {
        position: relative;
        overflow: hidden;
    }
    
    .loading::after {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.4), transparent);
        animation: loading 1.5s infinite;
    }
    
    @keyframes loading {
        0% { left: -100%; }
        100% { left: 100%; }
    }
    
    /* Enhanced Dark Mode Support */
    .dark-mode #sidebar {
        background: linear-gradient(180deg, #1a1a1a 0%, #2d2d2d 100%);
    }
    
    .dark-mode .page-content {
        background: #121212;
        color: #ffffff;
    }
    
    .dark-mode .block {
        background: #1e1e1e;
        border-color: #333333;
        color: #ffffff;
    }
    
    .dark-mode .stats-card {
        background: #1e1e1e;
        border-color: #333333;
        color: #ffffff;
    }
    
    /* Print Styles */
    @media print {
        #sidebar {
            display: none !important;
        }
        
        .page-content {
            margin-left: 0 !important;
            box-shadow: none !important;
        }
        
        .btn {
            display: none !important;
        }
    }
    
    /* Enhanced Dashboard Welcome Section */
    .dashboard-welcome {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: #ffffff;
        padding: 40px 30px;
        border-radius: var(--border-radius);
        margin-bottom: 30px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        box-shadow: var(--shadow-hover);
        position: relative;
        overflow: hidden;
    }
    
    .dashboard-welcome::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
        animation: float 6s ease-in-out infinite;
    }
    
    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-20px); }
    }
    
    .welcome-content {
        flex: 1;
        z-index: 2;
        position: relative;
    }
    
    .dashboard-title {
        font-size: 32px;
        font-weight: 800;
        margin-bottom: 10px;
        text-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    
    .dashboard-title i {
        margin-right: 15px;
        color: #74b9ff;
    }
    
    .dashboard-subtitle {
        font-size: 16px;
        opacity: 0.9;
        margin-bottom: 25px;
        font-weight: 500;
    }
    
    .dashboard-subtitle i {
        margin-right: 8px;
        color: #74b9ff;
    }
    
    .quick-actions {
        display: flex;
        gap: 15px;
        flex-wrap: wrap;
    }
    
    .quick-action-btn {
        background: rgba(255,255,255,0.2);
        color: #ffffff;
        padding: 12px 20px;
        border-radius: 25px;
        text-decoration: none;
        font-weight: 600;
        font-size: 14px;
        transition: var(--transition);
        border: 2px solid transparent;
        backdrop-filter: blur(10px);
    }
    
    .quick-action-btn:hover {
        background: rgba(255,255,255,0.3);
        transform: translateY(-2px);
        border-color: rgba(255,255,255,0.4);
        color: #ffffff;
        text-decoration: none;
    }
    
    .quick-action-btn i {
        margin-right: 8px;
    }
    
    .welcome-stats {
        display: flex;
        gap: 30px;
        z-index: 2;
        position: relative;
    }
    
    .stat-item {
        text-align: center;
        min-width: 80px;
    }
    
    .stat-number {
        font-size: 28px;
        font-weight: 800;
        margin-bottom: 5px;
        color: #74b9ff;
        text-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    
    .stat-label {
        font-size: 12px;
        opacity: 0.9;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-weight: 600;
    }
    
    /* Enhanced Section Headers */
    .section-header {
        margin-bottom: 25px;
        text-align: center;
        padding: 20px 0;
    }
    
    .section-title {
        font-size: 24px;
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 8px;
        position: relative;
        display: inline-block;
    }
    
    .section-title::after {
        content: '';
        position: absolute;
        bottom: -5px;
        left: 50%;
        transform: translateX(-50%);
        width: 50px;
        height: 3px;
        background: var(--primary-gradient);
        border-radius: 2px;
    }
    
    .section-title i {
        margin-right: 12px;
        color: #3498db;
    }
    
    .section-subtitle {
        color: #7f8c8d;
        font-size: 14px;
        margin: 0;
        font-weight: 500;
    }
    
    /* Enhanced Statistic Blocks */
    .statistic-block .title {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-bottom: 15px;
    }
    
    .statistic-block .title .icon {
        width: 50px;
        height: 50px;
        border-radius: 12px;
        background: var(--primary-gradient);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #ffffff;
        font-size: 20px;
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
    }
    
    .statistic-block .title strong {
        font-size: 16px;
        color: #2c3e50;
        font-weight: 700;
    }
    
    .statistic-block .number {
        font-size: 36px;
        font-weight: 800;
        color: #2c3e50;
        text-align: right;
        margin-bottom: 10px;
    }
    
    /* Responsive Enhancements for Dashboard */
    @media (max-width: 992px) {
        .dashboard-welcome {
            flex-direction: column;
            text-align: center;
            gap: 25px;
        }
        
        .welcome-stats {
            justify-content: center;
        }
        
        .dashboard-title {
            font-size: 28px;
        }
        
        .quick-actions {
            justify-content: center;
        }
    }
    
    @media (max-width: 576px) {
        .dashboard-welcome {
            padding: 25px 20px;
        }
        
        .dashboard-title {
            font-size: 24px;
        }
        
        .welcome-stats {
            gap: 20px;
        }
        
        .stat-number {
            font-size: 24px;
        }
        
        .quick-action-btn {
            padding: 10px 16px;
            font-size: 13px;
        }
    }
    
    /* Real-time Clock Animation */
    #current-time {
        font-weight: 700;
        color: #74b9ff;
    }
    
    /* Enhanced Sidebar Toggle Button */
    .sidebar-toggle {
        background: var(--primary-gradient);
        border: none;
        border-radius: 8px;
        color: #ffffff;
        padding: 10px 12px;
        font-size: 16px;
        cursor: pointer;
        transition: var(--transition);
        box-shadow: var(--shadow-soft);
        position: relative;
        overflow: hidden;
    }
    
    .sidebar-toggle::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        transition: left 0.5s ease;
    }
    
    .sidebar-toggle:hover::before {
        left: 100%;
    }
    
    .sidebar-toggle:hover {
        transform: scale(1.05);
        box-shadow: var(--shadow-hover);
    }
    
    .sidebar-toggle:active {
        transform: scale(0.95);
    }
    
    /* Enhanced Sidebar Animations */
    #sidebar.slide-out {
        animation: slideOut 0.3s ease-in;
    }
    
    @keyframes slideOut {
        from { transform: translateX(0); }
        to { transform: translateX(-100%); }
    }
    
    /* Enhanced Tooltip System */
    .tooltip {
        position: relative;
        display: inline-block;
    }
    
    .tooltip::after {
        content: attr(data-tooltip);
        position: absolute;
        bottom: 150%;
        left: 50%;
        transform: translateX(-50%);
        background: #2c3e50;
        color: #ffffff;
        padding: 8px 12px;
        border-radius: 6px;
        font-size: 12px;
        white-space: nowrap;
        opacity: 0;
        visibility: hidden;
        transition: var(--transition);
        z-index: 1000;
    }
    
    .tooltip::before {
        content: '';
        position: absolute;
        bottom: 142%;
        left: 50%;
        transform: translateX(-50%);
        border: 6px solid transparent;
        border-top-color: #2c3e50;
        opacity: 0;
        visibility: hidden;
        transition: var(--transition);
        z-index: 1000;
    }
    
    .tooltip:hover::after,
    .tooltip:hover::before {
        opacity: 1;
        visibility: visible;
    }
    
    /* Enhanced Language Selector Styling */
    .language-selector {
        position: relative;
    }
    
    .language-selector .nav-link {
        display: flex;
        align-items: center;
        padding: 8px 12px;
        border-radius: 6px;
        transition: var(--transition);
        background: rgba(255,255,255,0.1);
        border: 1px solid rgba(255,255,255,0.2);
    }
    
    .language-selector .nav-link:hover {
        background: rgba(255,255,255,0.2);
        transform: translateY(-1px);
        box-shadow: var(--shadow-soft);
    }
    
    .language-selector img {
        width: 20px;
        height: 15px;
        margin-right: 8px;
        border-radius: 2px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.3);
    }
    
    .language-menu {
        min-width: 150px;
        border: none;
        border-radius: 8px;
        background: var(--card-bg);
        box-shadow: var(--shadow-hover);
        padding: 8px 0;
    }
    
    .language-option {
        display: flex;
        align-items: center;
        padding: 10px 15px;
        color: var(--text-color);
        text-decoration: none;
        transition: var(--transition);
        border-radius: 0;
    }
    
    .language-option:hover {
        background: var(--primary-gradient);
        color: #ffffff;
        text-decoration: none;
        transform: translateX(5px);
    }
    
    .language-option img {
        width: 18px;
        height: 13px;
        margin-right: 10px;
    }
    
    /* Mobile Responsive Language Selector */
    @media (max-width: 576px) {
        .language-selector .nav-link span {
            display: none !important;
        }
        
        .language-selector .nav-link {
            padding: 8px;
            min-width: 40px;
            justify-content: center;
        }
        
        .language-selector img {
            margin-right: 0;
            width: 24px;
            height: 18px;
        }
        
        .language-menu {
            right: 0;
            left: auto;
            min-width: 120px;
        }
        
        .language-option {
            padding: 8px 12px;
        }
        
        .language-option span {
            font-size: 14px;
        }
    }
    
    /* Language selector animations */
    .language-selector .dropdown-menu {
        opacity: 0;
        visibility: hidden;
        transform: translateY(-10px);
        transition: all 0.3s ease;
    }
    
    .language-selector .dropdown-menu.show {
        opacity: 1;
        visibility: visible;
        transform: translateY(0);
    }
    
    /* Flag hover effects */
    .language-option img {
        transition: transform 0.2s ease;
    }
    
    .language-option:hover img {
        transform: scale(1.1);
    }
    </style>