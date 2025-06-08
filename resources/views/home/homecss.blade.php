<!-- basic -->
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <!-- mobile metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="viewport" content="initial-scale=1, maximum-scale=1">
      <!-- site metas -->
      <title>Daily Blogger</title>
      <meta name="keywords" content="">
      <meta name="description" content="">
      <meta name="author" content="">
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <!-- bootstrap css -->
      <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
      <!-- style css -->
      <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
      <!-- Responsive-->
      <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
      <!-- fevicon -->
      <link rel="icon" href="{{ asset('images/fevicon.png') }}" type="image/gif" />
      <!-- Scrollbar Custom CSS -->
      <link rel="stylesheet" href="{{ asset('css/jquery.mCustomScrollbar.min.css') }}">
      <!-- Tweaks for older IEs-->
      <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
      <!-- fonts -->
      <link href="https://fonts.googleapis.com/css?family=Poppins:400,700|Righteous&display=swap" rel="stylesheet">
      <!-- owl stylesheets --> 
      <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
      <link rel="stylesheet" href="{{ asset('css/owl.theme.default.min.css') }}">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
      
      <!-- Custom Navbar and Header Styles -->
      <style>
          /* Header Section Styles */
          .header_section {
              background: #fff;
              position: relative;
              z-index: 999;
              box-shadow: 0 2px 10px rgba(0,0,0,0.1);
          }
          
          .header_main {
              padding: 0;
          }
          
          /* Logo Styles */
          .navbar-brand {
              padding: 0.5rem 1rem;
          }
          
          .logo-img {
              height: 40px;
              width: auto;
              max-width: 150px;
          }
          
          .navbar-brand-desktop {
              display: flex;
              align-items: center;
              margin-right: 30px;
          }
          
          .logo-img-desktop {
              height: 50px;
              width: auto;
              max-width: 180px;
              filter: brightness(0) invert(1); /* Makes logo white for dark navbar */
          }
          
          /* Mobile Menu Styles */
          .mobile_menu {
              display: block;
              padding: 0;
              background: #fff;
              border-bottom: 1px solid #eee;
          }
          
          .mobile_menu .navbar {
              background-color: #fff !important;
              padding: 1rem;
              box-shadow: none;
          }
          
          .mobile_menu .navbar-toggler {
              border: 1px solid #ddd;
              padding: 0.25rem 0.5rem;
          }
          
          .mobile_menu .navbar-nav {
              width: 100%;
              margin-top: 1rem;
          }
          
          .mobile_menu .nav-item {
              margin: 0.25rem 0;
          }
          
          .mobile_menu .nav-link {
              color: #333 !important;
              font-weight: 500;
              padding: 0.75rem 1rem;
              border-radius: 6px;
              transition: all 0.3s ease;
              border: 1px solid transparent;
          }
          
          .mobile_menu .nav-link:hover,
          .mobile_menu .nav-item.active .nav-link {
              background-color: #667eea;
              color: #fff !important;
              border-color: #667eea;
          }
          
          .mobile_menu .nav-item.active .nav-link {
              background-color: #007bff;
              color: #fff !important;
          }
          
          /* Desktop Menu Styles */
          .container-fluid {
              padding: 0;
          }
          
          .menu_main {
              background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
              padding: 0;
              margin: 0;
              display: flex;
              align-items: center;
              justify-content: space-between;
              min-height: 70px;
              padding: 0 30px;
          }
          
          .menu_main ul {
              list-style: none;
              margin: 0;
              padding: 0;
              display: flex;
              justify-content: center;
              align-items: center;
              flex-wrap: wrap;
              flex: 1;
          }
          
          .menu_main ul li {
              margin: 0 15px;
              position: relative;
          }
          
          .menu_main ul li a {
              color: #fff;
              text-decoration: none;
              font-size: 16px;
              font-weight: 500;
              padding: 15px 20px;
              display: block;
              transition: all 0.3s ease;
              border-radius: 6px;
              border: 2px solid transparent;
          }
          
          .menu_main ul li.active a,
          .menu_main ul li a:hover {
              background-color: rgba(255,255,255,0.2);
              border-color: rgba(255,255,255,0.3);
              transform: translateY(-2px);
              box-shadow: 0 4px 15px rgba(0,0,0,0.2);
          }
          
          .menu_main ul li form button {
              background: none !important;
              border: 2px solid transparent !important;
              padding: 15px 20px !important;
              margin: 0 !important;
              color: #fff !important;
              cursor: pointer !important;
              font-size: 16px;
              font-weight: 500;
              transition: all 0.3s ease;
              border-radius: 6px;
          }
          
          .menu_main ul li form button:hover {
              background-color: rgba(255,255,255,0.2) !important;
              border-color: rgba(255,255,255,0.3) !important;
              transform: translateY(-2px);
              box-shadow: 0 4px 15px rgba(0,0,0,0.2);
          }
          
          /* Responsive Styles */
          @media (max-width: 768px) {
              .navbar-brand-desktop {
                  display: none;
              }
              
              .menu_main {
                  display: none;
              }
              
              .mobile_menu {
                  display: block !important;
              }
          }
          
          @media (min-width: 769px) {
              .mobile_menu {
                  display: none !important;
              }
              
              .navbar-brand-desktop {
                  display: flex !important;
              }
          }
          
          /* Modern navbar enhancements */
          .navbar-brand:hover .logo-img-desktop {
              transform: scale(1.05);
              transition: transform 0.3s ease;
          }
          
          .navbar-brand:hover .logo-img {
              transform: scale(1.05);
              transition: transform 0.3s ease;
          }
          
          /* Posts Page Specific Styles */
          .posts_section {
              padding-top: 50px;
              padding-bottom: 50px;
              background-color: #f8f9fa;
          }
          
          .services_taital {
              text-align: center;
              font-size: 40px;
              color: #333;
              font-weight: bold;
              margin-bottom: 20px;
          }
          
          .services_text {
              text-align: center;
              color: #666;
              font-size: 18px;
              margin-bottom: 50px;
          }
          
          /* Ensure proper spacing and layout */
          body {
              margin: 0;
              padding: 0;
              font-family: 'Poppins', sans-serif;
          }
          
          .layout_padding {
              padding: 90px 0;
          }
          
          /* Dropdown Styles */
          .dropdown {
              position: relative;
              display: inline-block;
          }
          
          .dropdown-toggle {
              cursor: pointer;
              text-decoration: none;
              color: #fff !important;
              display: flex;
              align-items: center;
              gap: 5px;
          }
          
          .dropdown-menu {
              display: none;
              position: absolute;
              top: 100%;
              right: 0;
              background-color: #fff;
              min-width: 200px;
              box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
              z-index: 1000;
              border-radius: 4px;
              overflow: hidden;
              list-style: none;
              margin: 0;
              padding: 0;
          }
          
          .dropdown-menu.show {
              display: block;
          }
          
          .dropdown-menu li {
              margin: 0;
          }
          
          .dropdown-menu li a {
              color: #333 !important;
              padding: 12px 16px;
              text-decoration: none;
              display: block;
              transition: background-color 0.3s ease;
          }
          
          .dropdown-menu li a:hover {
              background-color: #f1f1f1;
          }
          
          .dropdown-divider,
          .divider {
              height: 1px;
              background-color: #e9ecef;
              margin: 5px 0;
          }
          
          /* Desktop dropdown menu styles */
          .menu_main .dropdown {
              position: relative;
          }
          
          .menu_main .dropdown-menu {
              position: absolute;
              top: 100%;
              left: 0;
              z-index: 1000;
              display: none;
              float: left;
              min-width: 200px;
              padding: 0.5rem 0;
              margin: 0.125rem 0 0;
              font-size: 1rem;
              color: #212529;
              text-align: left;
              list-style: none;
              background-color: #fff;
              background-clip: padding-box;
              border: 1px solid rgba(0,0,0,.15);
              border-radius: 0.375rem;
              box-shadow: 0 0.5rem 1rem rgba(0,0,0,.175);
          }
          
          .menu_main .dropdown-menu.show {
              display: block;
          }
          
          .menu_main .dropdown-menu li {
              margin: 0;
          }
          
          .menu_main .dropdown-menu li a {
              color: #212529 !important;
              padding: 0.5rem 1rem;
              display: block;
              white-space: nowrap;
              background-color: transparent;
              text-decoration: none;
              font-size: 14px;
              font-weight: normal;
              border: none !important;
          }
          
          .menu_main .dropdown-menu li a:hover {
              background-color: #f8f9fa;
              color: #16181b !important;
          }
          
          .menu_main .dropdown-menu li button {
              color: #212529 !important;
              padding: 0.5rem 1rem;
              display: block;
              white-space: nowrap;
              background-color: transparent;
              text-decoration: none;
              font-size: 14px;
              font-weight: normal;
              border: none !important;
              width: 100%;
              text-align: left;
              cursor: pointer;
          }
          
          .menu_main .dropdown-menu li button:hover {
              background-color: #f8f9fa;
              color: #16181b !important;
          }
          
          .menu_main .dropdown-menu .divider {
              height: 1px;
              margin: 0.5rem 0;
              overflow: hidden;
              background-color: #e9ecef;
          }
          
          .caret {
              display: inline-block;
              width: 0;
              height: 0;
              margin-left: 2px;
              vertical-align: middle;
              border-top: 4px solid;
              border-right: 4px solid transparent;
              border-left: 4px solid transparent;
          }
          
          /* Mobile dropdown styles */
          .nav-item.dropdown .dropdown-menu {
              position: absolute;
              top: 100%;
              left: 0;
              z-index: 1000;
              display: none;
              float: left;
              min-width: 200px;
              padding: 0.5rem 0;
              margin: 0.125rem 0 0;
              font-size: 1rem;
              color: #212529;
              text-align: left;
              list-style: none;
              background-color: #fff;
              background-clip: padding-box;
              border: 1px solid rgba(0,0,0,.15);
              border-radius: 0.375rem;
              box-shadow: 0 0.5rem 1rem rgba(0,0,0,.175);
          }
          
          .nav-item.dropdown:hover .dropdown-menu,
          .nav-item.dropdown .dropdown-menu.show {
              display: block;
          }
          
          .nav-item.dropdown .dropdown-item {
              color: #212529;
              padding: 0.5rem 1rem;
              display: block;
              background-color: transparent;
              text-decoration: none;
              font-weight: normal;
          }
          
          .nav-item.dropdown .dropdown-item:hover {
              background-color: #f8f9fa;
              color: #16181b;
          }
          
          @media (max-width: 768px) {
              .nav-item.dropdown .dropdown-menu {
                  position: static;
                  display: none;
                  float: none;
                  width: 100%;
                  margin-top: 0;
                  background-color: #f8f9fa;
                  border: 0;
                  box-shadow: none;
              }
              
              .nav-item.dropdown .dropdown-menu.show {
                  display: block !important;
              }
              
              .nav-item.dropdown .dropdown-menu .dropdown-item {
                  color: #333 !important;
                  padding-left: 2rem;
              }
          }
      </style>
