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
              transition: background-color 0.3s ease, color 0.3s ease;
          }
          
          .layout_padding {
              padding: 90px 0;
          }
          
          /* Dark Mode Styles */
          body.dark-mode {
              background-color: #1a1a1a;
              color: #e1e1e1;
          }
          
          body.dark-mode .header_section {
              background: #2d2d2d;
              box-shadow: 0 2px 10px rgba(0,0,0,0.3);
          }
          
          body.dark-mode .menu_main {
              background: linear-gradient(135deg, #2d2d2d 0%, #1a1a1a 100%);
          }
          
          body.dark-mode .mobile_menu {
              background: #2d2d2d;
              border-bottom: 1px solid #444;
          }
          
          body.dark-mode .mobile_menu .navbar {
              background-color: #2d2d2d !important;
          }
          
          body.dark-mode .mobile_menu .nav-link {
              color: #e1e1e1 !important;
          }
          
          body.dark-mode .mobile_menu .nav-link:hover,
          body.dark-mode .mobile_menu .nav-item.active .nav-link {
              background-color: #667eea;
              color: #fff !important;
          }
          
          body.dark-mode .services_section {
              background-color: #2d2d2d;
          }
          
          body.dark-mode .services_taital {
              color: #e1e1e1;
          }
          
          body.dark-mode .services_text {
              color: #b0b0b0;
          }
          
          /* Dark Mode Toggle Button Styles */
          #darkModeToggleDesktop:hover {
              background-color: rgba(255,255,255,0.2) !important;
              border-color: rgba(255,255,255,0.3) !important;
              transform: translateY(-2px);
              box-shadow: 0 4px 15px rgba(0,0,0,0.2);
          }
          
          body.dark-mode #darkModeToggleDesktop {
              color: #ffd700 !important;
          }
          
          body.dark-mode #darkModeToggleMobile {
              color: #ffd700 !important;
          }
      </style>
      
      <script>
          // Dark mode functionality for home layout
          document.addEventListener('DOMContentLoaded', function() {
              const html = document.documentElement;
              const body = document.body;
              const toggleDesktop = document.getElementById('darkModeToggleDesktop');
              const toggleMobile = document.getElementById('darkModeToggleMobile');
              const iconDesktop = document.getElementById('darkModeIconDesktop');
              const iconMobile = document.getElementById('darkModeIconMobile');
              const textDesktop = document.getElementById('darkModeTextDesktop');
              const textMobile = document.getElementById('darkModeTextMobile');
              
              // Clean up old theme keys
              localStorage.removeItem('theme'); // Remove old key
              
              // Initialize with light mode as default
              let isDarkMode = localStorage.getItem('app-theme') === 'dark';
              
              function updateTheme() {
                  if (isDarkMode) {
                      body.classList.add('dark-mode');
                      iconDesktop.className = 'fa fa-sun-o';
                      iconMobile.className = 'fa fa-sun-o';
                      textDesktop.textContent = 'Light';
                      textMobile.textContent = 'Light Mode';
                      localStorage.setItem('app-theme', 'dark');
                  } else {
                      body.classList.remove('dark-mode');
                      iconDesktop.className = 'fa fa-moon-o';
                      iconMobile.className = 'fa fa-moon-o';
                      textDesktop.textContent = 'Dark';
                      textMobile.textContent = 'Dark Mode';
                      localStorage.setItem('app-theme', 'light');
                  }
              }
              
              // Initialize theme
              updateTheme();
              
              // Add event listeners
              if (toggleDesktop) {
                  toggleDesktop.addEventListener('click', function() {
                      isDarkMode = !isDarkMode;
                      updateTheme();
                  });
              }
              
              if (toggleMobile) {
                  toggleMobile.addEventListener('click', function() {
                      isDarkMode = !isDarkMode;
                      updateTheme();
                  });
              }
          });
      </script>
