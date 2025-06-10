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
        --bg-main: #f8f9fa;
        --bg-secondary: #e9ecef;
        --bg-dark: #343a40;
        --bg-darker: #2c3034;
    }

    /* Fix for transparent dropdowns */
    .dropdown-menu {
        background-color: #ffffff !important;
        border: 1px solid rgba(0,0,0,0.15) !important;
        box-shadow: 0 6px 20px rgba(0,0,0,0.15) !important;
        opacity: 1 !important;
        backdrop-filter: blur(10px) !important;
        -webkit-backdrop-filter: blur(10px) !important;
    }

    .dropdown-menu.language-menu {
        background-color: #ffffff !important;
        border: 1px solid rgba(0,0,0,0.15) !important;
        min-width: 150px;
        box-shadow: 0 8px 25px rgba(0,0,0,0.18) !important;
        border-radius: 8px !important;
        overflow: hidden;
    }

    .dropdown-item {
        background-color: transparent !important;
        color: #333 !important;
        padding: 8px 16px !important;
        transition: all 0.2s ease !important;
    }

    .dropdown-item:hover,
    .dropdown-item:focus {
        background-color: #f8f9fa !important;
        color: #495057 !important;
    }

    /* Page layout fixes - Remove white space between sidebar and content */
    .d-flex.align-items-stretch {
        margin: 0 !important;
        padding: 0 !important;
        width: 100% !important;
        min-height: 100vh;
    }

    .page-content {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
        min-height: 100vh;
        position: relative;
        flex: 1 !important;
        margin: 0 !important;
        padding: 0 !important;
        width: auto !important; /* Let flexbox handle the width */
        max-width: none !important;
        overflow-x: hidden !important;
    }

    .page-content::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(52, 58, 64, 0.95);
        z-index: 0;
    }

    .page-content > * {
        position: relative;
        z-index: 1;
    }
    
    /* Improved Admin Panel Organization - Optimized for Space */
    #sidebar {
        width: 260px; /* Reduced from default 280px */
        box-shadow: 2px 0 20px rgba(0,0,0,0.1);
        background: var(--sidebar-gradient);
        position: relative;
        overflow: hidden;
        height: 100vh;
        overflow-y: auto;
        flex-shrink: 0 !important; /* Prevent sidebar from shrinking */
        margin: 0 !important;
        padding: 0 !important;
        /* Custom scrollbar for better aesthetics */
        scrollbar-width: thin;
        scrollbar-color: rgba(52, 152, 219, 0.3) transparent;
    }
    
    /* Webkit browsers scrollbar styling */
    #sidebar::-webkit-scrollbar {
        width: 6px;
    }
    
    #sidebar::-webkit-scrollbar-track {
        background: transparent;
    }
    
    #sidebar::-webkit-scrollbar-thumb {
        background: rgba(52, 152, 219, 0.3);
        border-radius: 3px;
    }
    
    #sidebar::-webkit-scrollbar-thumb:hover {
        background: rgba(52, 152, 219, 0.5);
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
        padding: 12px 15px; /* Reduced padding for compactness */
        border-bottom: 1px solid rgba(255,255,255,0.1);
        background: rgba(0,0,0,0.15);
        position: relative;
        flex-shrink: 0;
    }
    
    #sidebar .sidebar-header .avatar img {
        width: 35px; /* Reduced from 40px */
        height: 35px;
        border: 2px solid rgba(52, 152, 219, 0.3);
        transition: var(--transition);
    }
    
    #sidebar .sidebar-header:hover .avatar img {
        border-color: #3498db;
        transform: scale(1.05);
    }
    
    #sidebar .sidebar-header .title h1 {
        color: #ecf0f1;
        font-weight: 700;
        margin-bottom: 2px;
        font-size: 15px; /* Reduced from 16px */
        line-height: 1.2;
    }
    
    #sidebar .sidebar-header .title p {
        color: #bdc3c7;
        font-size: 10px; /* Reduced from 11px */
        opacity: 0.8;
        margin-bottom: 0;
    }
    
    #sidebar .heading {
        display: block;
        padding: 8px 15px 5px 15px; /* Reduced padding */
        color: #3498db;
        font-size: 9px; /* Reduced from 10px */
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        border-top: 1px solid rgba(255,255,255,0.05);
        margin-top: 6px; /* Reduced margin */
        position: relative;
    }
    
    #sidebar .heading::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 15px; /* Adjusted for reduced padding */
        right: 15px;
        height: 1px;
        background: linear-gradient(90deg, #3498db, transparent);
        border-radius: 1px;
    }
    
    #sidebar .heading:first-of-type {
        border-top: none;
        margin-top: 0;
        padding-top: 8px; /* Reduced padding */
    }
    
    #sidebar ul.list-unstyled {
        margin-bottom: 5px; /* Reduced margin */
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
        padding: 10px 15px; /* Reduced padding */
        color: #ecf0f1;
        text-decoration: none;
        transition: var(--transition);
        border-left: 3px solid transparent;
        position: relative;
        z-index: 2;
        font-weight: 500;
        font-size: 13px; /* Reduced from 14px */
        line-height: 1.4;
    }
    
    #sidebar ul li a:hover {
        background: rgba(52, 152, 219, 0.15);
        border-left-color: #3498db;
        color: #ffffff;
        transform: translateX(5px); /* Reduced transform */
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
        width: 16px; /* Reduced width */
        margin-right: 10px; /* Reduced margin */
        text-align: center;
        font-size: 13px; /* Reduced from 14px */
        transition: var(--transition);
        flex-shrink: 0;
    }
    
    #sidebar ul li a:hover i {
        transform: scale(1.1);
        color: #74b9ff;
    }
    
    /* Adjust page content for new sidebar width */
    .page-content {
        margin-left: 260px; /* Match new sidebar width */
        width: calc(100% - 260px);
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
            width: 260px; /* Maintain compact width on mobile */
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
        
        /* Backdrop for mobile sidebar - updated for new width */
        #sidebar.active::after {
            content: '';
            position: fixed;
            top: 0;
            left: 260px; /* Updated to match new sidebar width */
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
            padding: 6px 12px 4px 12px; /* Further reduced for mobile */
            font-size: 8px;
        }
        
        #sidebar ul li a {
            padding: 8px 12px; /* Further reduced for mobile */
            font-size: 12px;
        }
        
        #sidebar ul li a i {
            width: 14px;
            font-size: 12px;
            margin-right: 8px;
        }
        
        #sidebar .sidebar-header {
            padding: 10px 12px;
        }
        
        #sidebar .sidebar-header .avatar img {
            width: 30px;
            height: 30px;
        }
        
        #sidebar .sidebar-header .title h1 {
            font-size: 14px;
        }
        
        #sidebar .sidebar-header .title p {
            font-size: 9px;
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
        color: #7f8c8d;
        font-size: 14px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
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
    
    /* Enhanced Sidebar Toggle Button - Improved Alignment */
    .sidebar-toggle {
        background: var(--primary-gradient);
        border: none;
        border-radius: 8px;
        color: #ffffff;
        padding: 8px 10px; /* More balanced padding */
        font-size: 16px;
        cursor: pointer;
        transition: var(--transition);
        box-shadow: var(--shadow-soft);
        position: relative;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        min-width: 40px;
        height: 40px;
    }
    
    .sidebar-toggle i {
        margin: 0; /* Remove any default margins */
        line-height: 1;
        display: block;
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
    
    /* Dynamic Statistics Card Styles */
    .statistic-link {
        text-decoration: none;
        color: inherit;
        display: block;
        transition: var(--transition);
    }
    
    .statistic-link:hover {
        text-decoration: none;
        color: inherit;
        transform: translateY(-3px);
    }
    
    .statistic-link .statistic-block {
        transition: var(--transition);
        border: 1px solid transparent;
    }
    
    .statistic-link:hover .statistic-block {
        box-shadow: var(--shadow-hover);
        border-color: rgba(102, 126, 234, 0.2);
    }
    
    .statistic-block .progress-details .number {
        font-size: 1.8rem;
        font-weight: 700;
        transition: var(--transition);
    }
    
    .statistic-link:hover .number {
        transform: scale(1.05);
    }
    
    .statistic-block small {
        display: block;
        margin-top: 8px;
        font-size: 0.75rem;
        opacity: 0.7;
    }
    
    .statistic-block .icon {
        width: 40px;
        height: 40px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 8px;
        transition: var(--transition);
    }
    
    .statistic-link:hover .icon {
        transform: rotate(5deg) scale(1.1);
    }
    
    /* Welcome stats enhancement */
    .welcome-stats .stat-item {
        transition: var(--transition);
        cursor: pointer;
        padding: 15px;
        border-radius: var(--border-radius);
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
    }
    
    .welcome-stats .stat-item:hover {
        transform: translateY(-2px);
        background: rgba(255, 255, 255, 0.2);
    }
    
    .stat-number {
        font-size: 2rem;
        font-weight: 700;
        background: linear-gradient(45deg, #667eea, #764ba2);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    
    /* Progress bar enhancements */
    .progress-template {
        height: 6px;
        border-radius: 3px;
        overflow: hidden;
        background: rgba(0, 0, 0, 0.1);
    }
    
    .progress-bar-template {
        transition: width 1.5s ease-in-out;
        border-radius: 3px;
    }
    
    /* Responsive improvements */
    @media (max-width: 768px) {
        .statistic-block {
            margin-bottom: 20px;
        }
        
        .statistic-link:hover {
            transform: none;
        }
        
        .welcome-stats {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
        }
    }
    
    @media (max-width: 576px) {
        .welcome-stats {
            grid-template-columns: 1fr;
        }
        
        .stat-number {
            font-size: 1.5rem;
        }
    }
    
    /* Additional Sidebar Optimizations for Compact Layout */
    
    /* Ensure sidebar fits in viewport without scrolling on most screens */
    @media (min-height: 700px) {
        #sidebar {
            height: 100vh;
            max-height: 100vh;
        }
    }
    
    @media (max-height: 699px) {
        #sidebar {
            height: 100vh;
            overflow-y: auto;
        }
        
        #sidebar .sidebar-header {
            padding: 8px 12px;
        }
        
        #sidebar .heading {
            padding: 4px 12px 3px 12px;
            font-size: 8px;
            margin-top: 4px;
        }
        
        #sidebar ul li a {
            padding: 6px 12px;
            font-size: 11px;
        }
    }
    
    /* Navbar brand alignment improvements */
    .navbar-header {
        display: flex;
        align-items: center;
        gap: 15px;
    }
    
    .navbar-brand {
        margin-right: 0; /* Remove default margin */
    }
    
    /* Enhanced hamburger menu centering */
    .sidebar-toggle {
        margin-left: auto; /* Push to the right if needed */
    }
    
    /* Compact layout utility class */
    .compact-sidebar #sidebar {
        width: 240px;
    }
    
    .compact-sidebar .page-content {
        margin-left: 240px;
        width: calc(100% - 240px);
    }
    
    /* Animation improvements for better performance */
    #sidebar ul li a,
    #sidebar .heading,
    .sidebar-toggle {
        will-change: transform;
    }
    
    /* Enhanced Dark Theme for Admin Panel */
    .page-header {
        background: rgba(52, 58, 64, 0.95) !important;
        border-bottom: 2px solid rgba(102, 126, 234, 0.3);
        margin-bottom: 20px !important;
        padding: 20px 0 !important;
    }

    .dashboard-welcome {
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.9) 0%, rgba(118, 75, 162, 0.9) 100%);
        border-radius: 15px;
        padding: 25px;
        margin-bottom: 0 !important;
        box-shadow: 0 10px 30px rgba(0,0,0,0.2);
    }

    .dashboard-title {
        color: #ffffff !important;
        font-size: 2rem !important;
        font-weight: 700 !important;
        text-shadow: 0 2px 4px rgba(0,0,0,0.3);
    }

    .dashboard-subtitle {
        color: rgba(255,255,255,0.9) !important;
        font-size: 1rem !important;
    }

    /* Improve text visibility throughout the admin panel */
    .section-title {
        color: #ffffff !important;
        font-weight: 700 !important;
        text-shadow: 0 2px 4px rgba(0,0,0,0.3);
    }

    .section-subtitle {
        color: rgba(255,255,255,0.8) !important;
        font-weight: 500 !important;
    }

    /* Fix text colors in blocks */
    .block .title strong {
        color: #333333 !important;
        font-weight: 700 !important;
    }

    .block .title {
        color: #333333 !important;
    }

    /* Fix muted text colors */
    .text-muted {
        color: #6c757d !important;
    }

    /* Improve stat text visibility */
    .stat-row span {
        color: #495057 !important;
        font-weight: 500 !important;
    }

    /* Reduce white space and improve blocks */
    .block {
        background: rgba(255, 255, 255, 0.95) !important;
        border-radius: 12px !important;
        padding: 20px !important;
        margin-bottom: 20px !important;
        box-shadow: 0 8px 25px rgba(0,0,0,0.15) !important;
        border: 1px solid rgba(255,255,255,0.2);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
    }

    .statistic-block {
        background: linear-gradient(135deg, rgba(255,255,255,0.95) 0%, rgba(248,249,250,0.95) 100%) !important;
        transition: all 0.3s ease !important;
    }

    .statistic-block:hover {
        transform: translateY(-5px) !important;
        box-shadow: 0 15px 35px rgba(0,0,0,0.2) !important;
    }

    /* Compact sections */
    section {
        padding: 15px 0 !important;
    }

    section.no-padding-bottom {
        padding-bottom: 0 !important;
    }

    section.no-padding-top {
        padding-top: 0 !important;
    }

    /* Enhanced cards */
    .recent-posts-block,
    .recent-users-block,
    .quick-stats-block,
    .activity-summary-block,
    .action-center-block {
        background: rgba(255, 255, 255, 0.95) !important;
        border-radius: 12px !important;
        box-shadow: 0 8px 25px rgba(0,0,0,0.15) !important;
        border: 1px solid rgba(255,255,255,0.3);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        margin-bottom: 20px !important;
    }

    /* Quick action buttons */
    .quick-action-btn,
    .action-btn {
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.9) 0%, rgba(118, 75, 162, 0.9) 100%) !important;
        color: #ffffff !important;
        border: none !important;
        border-radius: 8px !important;
        padding: 10px 20px !important;
        font-weight: 600 !important;
        text-decoration: none !important;
        transition: all 0.3s ease !important;
        display: inline-flex !important;
        align-items: center !important;
        gap: 8px !important;
        margin: 5px !important;
    }

    .quick-action-btn:hover,
    .action-btn:hover {
        transform: translateY(-2px) !important;
        box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4) !important;
        color: #ffffff !important;
        text-decoration: none !important;
    }

    /* Progress bars */
    .progress {
        background-color: rgba(52, 58, 64, 0.2) !important;
        border-radius: 8px !important;
        overflow: hidden;
    }

    .progress-bar {
        border-radius: 8px !important;
        transition: width 0.6s ease !important;
    }

    /* Enhanced table styling with consistent colors */
    .table {
        background: rgba(255, 255, 255, 0.98) !important;
        border-radius: 12px !important;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1) !important;
    }

    .table thead th {
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.9) 0%, rgba(118, 75, 162, 0.9) 100%) !important;
        color: #ffffff !important;
        border: none !important;
        font-weight: 600 !important;
        text-transform: uppercase !important;
        letter-spacing: 0.5px !important;
        font-size: 0.85rem !important;
        padding: 15px 12px !important;
    }

    .table tbody tr {
        transition: all 0.2s ease !important;
        background-color: #ffffff !important; /* Consistent white background for all rows */
    }

    .table tbody tr:hover {
        background-color: rgba(102, 126, 234, 0.08) !important; /* Light purple hover effect */
        transform: translateY(-1px) !important;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1) !important;
    }

    .table tbody tr:nth-child(even) {
        background-color: #ffffff !important; /* Override alternating colors - keep all white */
    }

    .table tbody tr:nth-child(odd) {
        background-color: #ffffff !important; /* Override alternating colors - keep all white */
    }

    .table tbody td {
        padding: 15px 12px !important;
        border-top: 1px solid rgba(0,0,0,0.08) !important;
        vertical-align: middle !important;
        color: #333333 !important;
        font-weight: 500 !important;
    }

    /* Improve table text visibility */
    .table tbody td strong {
        color: #2c3e50 !important;
        font-weight: 600 !important;
    }

    .table tbody td small {
        color: #6c757d !important;
        font-weight: 400 !important;
    }

    /* Body and html reset for admin pages */
    body {
        margin: 0 !important;
        padding: 0 !important;
        overflow-x: hidden !important;
    }

    /* Remove any default Bootstrap margins/padding that might cause gaps */
    * {
        box-sizing: border-box !important;
    }

    /* Header styling */
    .header {
        width: 100% !important;
        margin: 0 !important;
        padding: 0 !important;
        z-index: 1000;
        position: relative;
    }

    /* Main container adjustments */
    .d-flex.align-items-stretch {
        margin: 0 !important;
        padding: 0 !important;
        gap: 0 !important;
        width: 100vw !important;
        height: 100vh !important;
    }

    /* Remove any potential margins from main wrapper */
    .d-flex.align-items-stretch > * {
        margin: 0 !important;
    }

    /* Container adjustments */
    .container-fluid {
        padding-left: 20px !important;
        padding-right: 20px !important;
        margin: 0 !important;
        max-width: 100% !important;
    }

    /* Row spacing */
    .row {
        margin-left: -10px !important;
        margin-right: -10px !important;
    }

    .row > [class*="col-"] {
        padding-left: 10px !important;
        padding-right: 10px !important;
    }

    /* Recent items styling with better visibility */
    .recent-post-item,
    .recent-user-item {
        padding: 15px !important;
        border-bottom: 1px solid rgba(0,0,0,0.08) !important;
        transition: all 0.2s ease !important;
    }

    .recent-post-item:hover,
    .recent-user-item:hover {
        background-color: rgba(102, 126, 234, 0.08) !important;
        transform: translateX(5px) !important;
    }

    .recent-post-item strong,
    .recent-user-item strong {
        color: #2c3e50 !important;
        font-weight: 600 !important;
    }

    .recent-post-item .text-muted,
    .recent-user-item .text-muted {
        color: #6c757d !important;
    }

    .recent-post-item .date,
    .recent-user-item .date {
        color: #95a5a6 !important;
    }

    /* Status badges with better visibility */
    .status-badge {
        padding: 4px 8px !important;
        border-radius: 12px !important;
        font-size: 10px !important;
        font-weight: 600 !important;
        text-transform: uppercase !important;
        letter-spacing: 0.5px !important;
    }

    .status-active {
        background-color: #27ae60 !important;
        color: #ffffff !important;
    }

    .status-pending {
        background-color: #f39c12 !important;
        color: #ffffff !important;
    }

    .status-rejected {
        background-color: #e74c3c !important;
        color: #ffffff !important;
    }

    /* User type badges */
    .user-type-badge {
        padding: 4px 8px !important;
        border-radius: 12px !important;
        font-size: 10px !important;
        font-weight: 600 !important;
        text-transform: uppercase !important;
        background-color: #3498db !important;
        color: #ffffff !important;
    }

    /* Badges in general */
    .badge {
        font-weight: 600 !important;
        font-size: 10px !important;
        padding: 6px 10px !important;
    }

    .badge-primary {
        background-color: #667eea !important;
        color: #ffffff !important;
    }

    .badge-success {
        background-color: #27ae60 !important;
        color: #ffffff !important;
    }

    /* Activity items */
    .activity-item {
        display: flex !important;
        align-items: center !important;
        padding: 10px 0 !important;
        border-bottom: 1px solid rgba(0,0,0,0.05) !important;
        gap: 15px !important;
    }

    .activity-icon {
        width: 40px !important;
        height: 40px !important;
        border-radius: 50% !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        color: #ffffff !important;
        font-weight: bold !important;
        flex-shrink: 0 !important;
    }

    /* Stat numbers */
    .stat-number {
        font-size: 2rem !important;
        font-weight: 700 !important;
        color: rgba(102, 126, 234, 1) !important;
        line-height: 1 !important;
    }

    .stat-label {
        font-size: 0.85rem !important;
        color: rgba(52, 58, 64, 0.7) !important;
        font-weight: 500 !important;
        text-transform: uppercase !important;
        letter-spacing: 0.5px !important;
    }

    /* Welcome stats */
    .welcome-stats {
        display: grid !important;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)) !important;
        gap: 20px !important;
        margin-top: 20px !important;
    }

    .stat-item {
        text-align: center !important;
        padding: 15px !important;
        background: rgba(255, 255, 255, 0.2) !important;
        border-radius: 10px !important;
        backdrop-filter: blur(10px) !important;
        border: 1px solid rgba(255, 255, 255, 0.3) !important;
    }

    .stat-item .stat-number {
        color: #ffffff !important;
        font-size: 1.5rem !important;
    }

    .stat-item .stat-label {
        color: rgba(255, 255, 255, 0.9) !important;
        font-size: 0.75rem !important;
    }
    
    /* Reduce motion for users who prefer it */
    @media (prefers-reduced-motion: reduce) {
        #sidebar ul li a,
        #sidebar .heading,
        .sidebar-toggle,
        #sidebar ul li::before {
            transition: none;
            animation: none;
        }
    }
    
    /* Text Visibility Fixes for Admin Panel */
    
    /* Ensure text-light class is visible in dark backgrounds */
    .text-light {
        color: #f8f9fa !important;
    }
    
    /* Ensure text-dark class is visible in light backgrounds */
    .text-dark {
        color: #212529 !important;
    }
    
    /* Fix any white text on white background issues */
    .bg-light .text-white {
        color: #333333 !important;
    }
    
    /* Fix any black text on black background issues */
    .bg-dark .text-black {
        color: #e1e1e1 !important;
    }
    
    /* Ensure muted text is visible */
    .text-muted {
        color: #6c757d !important;
    }
    
    .bg-dark .text-muted {
        color: #adb5bd !important;
    }
    
    /* Fix link visibility on dark backgrounds */
    .bg-dark a:not(.btn):not(.nav-link):not(.dropdown-item) {
        color: #6db4fd !important;
    }
    
    .bg-dark a:not(.btn):not(.nav-link):not(.dropdown-item):hover {
        color: #8ac5ff !important;
    }
    
    /* Fix button text visibility */
    .btn-light {
        color: #212529 !important;
        background-color: #e9ecef !important;
        border-color: #e9ecef !important;
    }
    
    .btn-dark {
        color: #ffffff !important;
        background-color: #495057 !important;
        border-color: #495057 !important;
    }
    
    /* Fix badge visibility */
    .badge-light {
        color: #212529 !important;
        background-color: #e9ecef !important;
    }
    
    .badge-dark {
        color: #ffffff !important;
        background-color: #495057 !important;
    }
    
    /* Fix card text visibility on different backgrounds */
    .bg-dark .card-text {
        color: #e1e1e1 !important;
    }
    
    .bg-dark .card-title {
        color: #ffffff !important;
    }
    
    /* Fix list group item visibility */
    .bg-dark .list-group-item {
        background-color: #495057 !important;
        color: #e1e1e1 !important;
        border-color: #6c757d !important;
    }
    
    /* Fix form label visibility on dark backgrounds */
    .bg-dark label,
    .bg-dark .form-label {
        color: #e1e1e1 !important;
    }
    
    /* Fix help text visibility */
    .bg-dark .form-text,
    .bg-dark small {
        color: #adb5bd !important;
    }
    
    /* Fix code and pre visibility */
    .bg-dark code {
        color: #ff6b6b !important;
        background-color: #495057 !important;
    }
    
    .bg-dark pre {
        color: #e1e1e1 !important;
        background-color: #495057 !important;
    }
    
    /* Fix blockquote visibility */
    .bg-dark blockquote {
        color: #e1e1e1 !important;
        border-left-color: #6c757d !important;
    }
    
    /* Fix hr visibility */
    .bg-dark hr {
        border-color: #6c757d !important;
    }
    
    /* Fix caption and figure text */
    .bg-dark .figure-caption,
    .bg-dark caption {
        color: #adb5bd !important;
    }
    
    /* Fix mark/highlight visibility */
    .bg-dark mark {
        background-color: #ffc107 !important;
        color: #212529 !important;
    }
    
    /* Fix strong emphasis visibility */
    .bg-dark strong,
    .bg-dark b {
        color: #ffffff !important;
    }
    
    /* Fix emphasis visibility */
    .bg-dark em,
    .bg-dark i {
        color: #e1e1e1 !important;
    }
    
    /* Fix input placeholder visibility on dark backgrounds */
    .bg-dark input::placeholder,
    .bg-dark textarea::placeholder,
    .bg-dark select::placeholder {
        color: #adb5bd !important;
        opacity: 1 !important;
    }
    
    /* Fix select option visibility */
    .bg-dark select option {
        background-color: #495057 !important;
        color: #e1e1e1 !important;
    }
    
    /* Fix disabled element visibility */
    .bg-dark .disabled,
    .bg-dark [disabled] {
        color: #6c757d !important;
    }
    
    /* Fix readonly element visibility */
    .bg-dark [readonly] {
        background-color: #6c757d !important;
        color: #e1e1e1 !important;
    }
    
    /* Ensure minimum contrast ratios for colored text */
    .bg-dark .text-success {
        color: #5cb85c !important;
    }
    
    .bg-dark .text-info {
        color: #5bc0de !important;
    }
    
    .bg-dark .text-warning {
        color: #f0ad4e !important;
    }
    
    .bg-dark .text-danger {
        color: #d9534f !important;
    }
    
    /* Fix utility class text visibility */
    .bg-dark .text-primary {
        color: #6db4fd !important;
    }
    
    .bg-dark .text-secondary {
        color: #adb5bd !important;
    }
    
    /* Fix border visibility on dark backgrounds */
    .bg-dark .border {
        border-color: #6c757d !important;
    }
    
    .bg-dark .border-light {
        border-color: #adb5bd !important;
    }
    
    .bg-dark .border-dark {
        border-color: #495057 !important;
    }
    
    /* Fix shadow visibility on dark backgrounds */
    .bg-dark .shadow,
    .bg-dark .shadow-sm,
    .bg-dark .shadow-lg {
        box-shadow: 0 0.125rem 0.25rem rgba(255, 255, 255, 0.175) !important;
    }
    
    /* Admin specific visibility fixes */
    
    /* Sidebar text visibility */
    #sidebar .nav-link {
        color: #ecf0f1 !important;
    }
    
    #sidebar .nav-link:hover {
        color: #ffffff !important;
    }
    
    /* Content area text visibility */
    .content-wrapper {
        background-color: #f4f4f4;
        color: #333;
    }
    
    .content-wrapper.dark-theme {
        background-color: #2c3e50;
        color: #ecf0f1;
    }
    
    .content-wrapper.dark-theme h1,
    .content-wrapper.dark-theme h2,
    .content-wrapper.dark-theme h3,
    .content-wrapper.dark-theme h4,
    .content-wrapper.dark-theme h5,
    .content-wrapper.dark-theme h6 {
        color: #ffffff !important;
    }
    
    .content-wrapper.dark-theme p,
    .content-wrapper.dark-theme span,
    .content-wrapper.dark-theme div {
        color: #ecf0f1 !important;
    }
    
    /* Table visibility improvements */
    .table-dark {
        background-color: #495057 !important;
        color: #e1e1e1 !important;
    }
    
    .table-dark th,
    .table-dark td {
        border-color: #6c757d !important;
        color: #e1e1e1 !important;
    }
    
    .table-dark thead th {
        background-color: #343a40 !important;
        color: #ffffff !important;
    }
    
    /* Modal visibility improvements */
    .modal-content.dark-theme {
        background-color: #495057;
        color: #e1e1e1;
    }
    
    .modal-content.dark-theme .modal-header {
        border-bottom-color: #6c757d;
    }
    
    .modal-content.dark-theme .modal-footer {
        border-top-color: #6c757d;
    }
    
    /* Alert visibility improvements */
    .alert.dark-theme {
        background-color: #495057;
        color: #e1e1e1;
        border-color: #6c757d;
    }
    
    .alert-success.dark-theme {
        background-color: #155724;
        color: #d4edda;
        border-color: #c3e6cb;
    }
    
    .alert-danger.dark-theme {
        background-color: #721c24;
        color: #f8d7da;
        border-color: #f5c6cb;
    }
    
    .alert-warning.dark-theme {
        background-color: #856404;
        color: #fff3cd;
        border-color: #ffeaa7;
    }
    
    .alert-info.dark-theme {
        background-color: #0c5460;
        color: #d1ecf1;
        border-color: #bee5eb;
    }
    </style>