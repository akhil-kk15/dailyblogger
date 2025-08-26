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
      
      <!-- CRITICAL CSS FOR FOUC PREVENTION -->
      <style>
          /* IMMEDIATE DARK THEME APPLICATION */
          body.dark-mode {
              background-color: #1a1a1a !important;
              color: #e1e1e1 !important;
          }
          
          body.dark-mode .header_section {
              background: #2d2d2d !important;
              color: #e1e1e1 !important;
          }
          
          body.dark-mode .services_section,
          body.dark-mode .posts_section,
          body.dark-mode .featured_section,
          body.dark-mode .about_section,
          body.dark-mode .blog_section {
              background-color: #1a1a1a !important;
              color: #e1e1e1 !important;
          }
          
          body.dark-mode h1,
          body.dark-mode h2,
          body.dark-mode h3,
          body.dark-mode h4,
          body.dark-mode p {
              color: #e1e1e1 !important;
          }
          
          body.dark-mode .post_card,
          body.dark-mode .featured_box {
              background-color: #2d2d2d !important;
              color: #e1e1e1 !important;
          }
      </style>
      
      <!-- IMMEDIATE THEME APPLICATION SCRIPT -->
      <script>
          // Apply saved theme IMMEDIATELY to prevent FOUC
          (function() {
              const savedTheme = localStorage.getItem('app-theme');
              if (savedTheme === 'dark') {
                  // Set class on documentElement immediately
                  if (document.documentElement) {
                      document.documentElement.style.cssText = 'background-color: #1a1a1a !important; color: #e1e1e1 !important;';
                  }
                  
                  // Apply to body when it becomes available
                  function applyToBody() {
                      if (document.body) {
                          document.body.classList.add('dark-mode');
                          document.body.style.cssText = 'background-color: #1a1a1a !important; color: #e1e1e1 !important;';
                      }
                  }
                  
                  if (document.body) {
                      applyToBody();
                  } else {
                      // Apply as soon as body becomes available
                      const observer = new MutationObserver(function() {
                          if (document.body) {
                              applyToBody();
                              observer.disconnect();
                          }
                      });
                      observer.observe(document.documentElement, { childList: true });
                  }
              }
          })();
      </script>
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
      
      <!-- Notification JavaScript -->
      <script src="{{ asset('js/notifications.js') }}" defer></script>
      
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
          
          /* Main Content Areas Dark Mode */
          body.dark-mode .layout_padding {
              background-color: #1a1a1a;
          }
          
          body.dark-mode .services_section,
          body.dark-mode .posts_section,
          body.dark-mode .featured_section,
          body.dark-mode .about_section,
          body.dark-mode .profile_section,
          body.dark-mode .post_details_section,
          body.dark-mode .search_section,
          body.dark-mode .announcements_section {
              background-color: #1a1a1a;
          }
          
          body.dark-mode .services_taital,
          body.dark-mode .featured_taital,
          body.dark-mode .about_taital,
          body.dark-mode .search_title,
          body.dark-mode h1,
          body.dark-mode h2,
          body.dark-mode h3,
          body.dark-mode h4 {
              color: #e1e1e1 !important;
          }
          
          body.dark-mode .services_text,
          body.dark-mode .featured_text,
          body.dark-mode .about_text,
          body.dark-mode .search_subtitle,
          body.dark-mode p {
              color: #b0b0b0 !important;
          }
          
          /* Post Cards Dark Mode */
          body.dark-mode .post_card,
          body.dark-mode .featured_box,
          body.dark-mode .announcement_card,
          body.dark-mode .profile_card,
          body.dark-mode .post_details_card,
          body.dark-mode .comments_section {
              background-color: #2d2d2d !important;
              border-color: #444 !important;
              box-shadow: 0 2px 10px rgba(0,0,0,0.3) !important;
          }
          
          body.dark-mode .post_content,
          body.dark-mode .featured_content {
              background-color: #2d2d2d;
          }
          
          body.dark-mode .post_title,
          body.dark-mode .featured_title,
          body.dark-mode .post_title_large,
          body.dark-mode .comments_title {
              color: #e1e1e1 !important;
          }
          
          body.dark-mode .post_description,
          body.dark-mode .featured_description,
          body.dark-mode .post_excerpt,
          body.dark-mode .post_description_full {
              color: #b0b0b0 !important;
          }
          
          body.dark-mode .post_author,
          body.dark-mode .featured_author,
          body.dark-mode .post_date,
          body.dark-mode .featured_date,
          body.dark-mode .post_meta,
          body.dark-mode .featured_meta {
              color: #888 !important;
          }
          
          /* Footer Dark Mode */
          body.dark-mode .footer_section {
              background-color: #2d2d2d !important;
              color: #e1e1e1;
          }
          
          body.dark-mode .footer_section .mail_text {
              background-color: #1a1a1a;
              color: #e1e1e1;
              border-color: #444;
          }
          
          body.dark-mode .footer_section a {
              color: #b0b0b0;
          }
          
          body.dark-mode .footer_section a:hover {
              color: #e1e1e1;
          }
          
          body.dark-mode .copyright_section {
              background-color: #1a1a1a !important;
              color: #888;
          }
          
          /* About Section Dark Mode */
          body.dark-mode .about_section_2 {
              background-color: #2d2d2d;
          }
          
          /* Form Elements Dark Mode */
          body.dark-mode input,
          body.dark-mode textarea,
          body.dark-mode select,
          body.dark-mode .form-control {
              background-color: #2d2d2d;
              color: #e1e1e1;
              border-color: #444;
          }
          
          body.dark-mode input::placeholder,
          body.dark-mode textarea::placeholder {
              color: #888;
          }
          
          /* Button Adjustments for Dark Mode */
          body.dark-mode .btn_main a,
          body.dark-mode .featured_btn_main a {
              background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
              color: white;
          }
          
          /* Search Form Dark Mode */
          body.dark-mode .search_form_container,
          body.dark-mode .advanced_search_form {
              background-color: #2d2d2d;
              border-color: #444;
          }
          
          body.dark-mode .search_input,
          body.dark-mode .search_select,
          body.dark-mode .filter_select {
              background-color: #1a1a1a;
              color: #e1e1e1;
              border-color: #444;
          }
          
          body.dark-mode .search_input:focus,
          body.dark-mode .filter_select:focus {
              border-color: #667eea;
              box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.2);
          }
          
          body.dark-mode .filter_select:hover {
              border-color: #667eea;
              background-color: #2d2d2d;
          }
          
          body.dark-mode .search_label {
              color: #e1e1e1;
          }
          
          /* Filter Selection Highlighting */
          .filter_select option:checked,
          .filter_select option[selected] {
              background: #007bff !important;
              background-color: #007bff !important;
              color: white !important;
              font-weight: 600 !important;
          }
          
          .filter_select option {
              background: white !important;
              background-color: white !important;
              color: #333 !important;
              padding: 10px 12px !important;
              border: none !important;
          }
          
          .filter_select option:hover {
              background: #e3f2fd !important;
              background-color: #e3f2fd !important;
              color: #007bff !important;
          }
          
          /* Custom Dropdown Support */
          .custom_dropdown_container {
              position: relative;
              width: 100%;
          }
          
          .custom_dropdown_trigger {
              display: flex;
              justify-content: space-between;
              align-items: center;
              padding: 12px 16px;
              background: white;
              border: 2px solid #ddd;
              border-radius: 8px;
              cursor: pointer;
              transition: all 0.3s ease;
              min-height: 50px;
              font-size: 14px;
              color: #333;
          }
          
          .custom_dropdown_trigger:hover {
              border-color: #007bff;
              background: #f8f9fa;
              box-shadow: 0 2px 8px rgba(0,123,255,0.1);
          }
          
          .custom_dropdown_trigger.active {
              border-color: #007bff;
              background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%);
              box-shadow: 0 0 0 3px rgba(0,123,255,0.1);
          }
          
          .custom_dropdown_menu {
              position: absolute;
              top: 100%;
              left: 0;
              right: 0;
              background: white;
              border: 2px solid #007bff;
              border-top: none;
              border-radius: 0 0 8px 8px;
              box-shadow: 0 8px 25px rgba(0,123,255,0.2);
              max-height: 300px;
              overflow-y: auto;
              z-index: 1050;
              display: none;
          }
          
          .custom_dropdown_menu.show {
              display: block;
              animation: dropdownSlideDown 0.2s ease-out;
          }
          
          .dropdown_option {
              padding: 12px 16px;
              cursor: pointer;
              border-bottom: 1px solid #f0f0f0;
              transition: all 0.2s ease;
              font-size: 14px;
              color: #333;
          }
          
          .dropdown_option:hover {
              background: #e3f2fd;
              color: #007bff;
              font-weight: 600;
          }
          
          .dropdown_option.selected {
              background: #007bff;
              color: white;
              font-weight: 700;
              position: relative;
          }
          
          .dropdown_option.selected::after {
              content: '✓';
              position: absolute;
              right: 16px;
              top: 50%;
              transform: translateY(-50%);
              font-weight: bold;
              font-size: 16px;
          }
          body.dark-mode .filter_select option:checked,
          body.dark-mode .filter_select option[selected] {
              background-color: #667eea !important;
              background: #667eea !important;
              color: white !important;
              font-weight: 600 !important;
          }
          
          body.dark-mode .filter_select option {
              background-color: #1a1a1a !important;
              background: #1a1a1a !important;
              color: #e1e1e1 !important;
              padding: 10px 12px !important;
              border: none !important;
          }
          
          body.dark-mode .filter_select option:hover {
              background-color: #2d2d2d !important;
              background: #2d2d2d !important;
              color: #667eea !important;
          }
          
          /* Dark mode custom dropdown styling */
          body.dark-mode .custom_dropdown_trigger {
              background: #1a1a1a;
              border-color: #444;
              color: #e1e1e1;
          }
          
          body.dark-mode .custom_dropdown_trigger:hover {
              border-color: #667eea;
              background: #2d2d2d;
          }
          
          body.dark-mode .custom_dropdown_trigger.active {
              border-color: #667eea;
              background: linear-gradient(135deg, #2d2d2d 0%, #3d3d3d 100%);
              box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.2);
          }
          
          body.dark-mode .custom_dropdown_menu {
              background: #2d2d2d;
              border-color: #667eea;
              box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
          }
          
          body.dark-mode .dropdown_option {
              color: #e1e1e1;
              border-bottom-color: #444;
          }
          
          body.dark-mode .dropdown_option:hover {
              background: #444;
              color: #667eea;
          }
          
          body.dark-mode .dropdown_option.selected {
              background: #667eea;
              color: white;
          }
          
          body.dark-mode .dropdown_option.selected:hover {
              background: #5a67d8;
          }
          
          /* Firefox specific dark mode option styling */
          @-moz-document url-prefix() {
              body.dark-mode .filter_select option:checked {
                  background-color: #667eea !important;
                  color: white !important;
                  font-weight: bold !important;
              }
              
              body.dark-mode .filter_select option {
                  background-color: #1a1a1a !important;
                  color: #e1e1e1 !important;
              }
          }
          
          /* Tag Filtering Dark Mode */
          body.dark-mode .tag_checkbox {
              background: #2d2d2d;
              border-color: #444;
              color: #e1e1e1;
          }
          
          body.dark-mode .tag_checkbox:hover {
              background: #3d3d3d;
              border-color: #667eea;
          }
          
          body.dark-mode .tag_checkbox:has(input:checked) {
              background: #667eea;
              color: white;
              border-color: #5a67d8;
              box-shadow: 0 0 10px rgba(102, 126, 234, 0.3);
          }
          
          body.dark-mode .tag_label {
              color: inherit;
          }
          
          /* Search Suggestions Dark Mode */
          body.dark-mode .search_suggestions {
              background: #2d2d2d;
              border-color: #444;
          }
          
          body.dark-mode .suggestion_item {
              border-bottom-color: #444;
          }
          
          body.dark-mode .suggestion_item:hover {
              background: #3d3d3d;
          }
          
          body.dark-mode .suggestion_title {
              color: #e1e1e1;
          }
          
          body.dark-mode .suggestion_meta {
              color: #888;
          }
          
          /* Applied Filters Dark Mode */
          body.dark-mode .applied_filters {
              background: #2d2d2d;
              color: #e1e1e1;
              border: 1px solid #444;
          }
          
          body.dark-mode .filter_tag {
              background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
              color: white;
              border: 1px solid #5a67d8;
          }
          
          body.dark-mode .filters_label {
              color: #e1e1e1;
          }
          
          body.dark-mode .remove_filter {
              color: rgba(255,255,255,0.8);
              background: rgba(255,255,255,0.1);
          }
          
          body.dark-mode .remove_filter:hover {
              color: white;
              background: rgba(255,255,255,0.2);
          }
          
          /* Search Labels Dark Mode */
          body.dark-mode .search_label {
              color: #e1e1e1;
          }
          
          body.dark-mode .search_label::after {
              background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
          }
          
          /* Search Buttons Dark Mode */
          body.dark-mode .search_btn {
              background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
          }
          
          body.dark-mode .search_btn:hover {
              background: linear-gradient(135deg, #5a67d8 0%, #6c63ff 100%);
          }
          
          body.dark-mode .clear_btn {
              background: linear-gradient(135deg, #495057 0%, #343a40 100%);
          }
          
          body.dark-mode .clear_btn:hover {
              background: linear-gradient(135deg, #343a40 0%, #23272b 100%);
          }
          
          /* Loading Overlay Dark Mode */
          body.dark-mode .loading-overlay {
              background: rgba(45,45,45,0.9) !important;
              color: #e1e1e1;
          }
          
          /* Admin Controls Dark Mode */
          body.dark-mode .admin_add_btn,
          body.dark-mode .admin_manage_btn {
              background: #28a745;
              color: white;
              border: 1px solid #20c997;
          }
          
          body.dark-mode .admin_add_btn:hover,
          body.dark-mode .admin_manage_btn:hover {
              background: #20c997;
          }
          
          body.dark-mode .admin_category_list {
              background: #2d2d2d;
              border-color: #444;
          }
          
          body.dark-mode .admin_item {
              background: #3d3d3d;
              color: #e1e1e1;
          }
          
          body.dark-mode .admin_delete_btn,
          body.dark-mode .admin_tag_delete {
              background: #dc3545;
              color: white;
          }
          
          body.dark-mode .admin_delete_btn:hover,
          body.dark-mode .admin_tag_delete:hover {
              background: #c82333;
          }
          
          /* Active Filter Indicators in Dark Mode */
          body.dark-mode .active_filter_indicator {
              color: #20c997;
          }
          
          /* Better selection highlighting in dark mode */
          body.dark-mode .filter_select option:checked,
          body.dark-mode .filter_select option[selected] {
              background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
              color: white !important;
          }
          
          body.dark-mode .filter_select[data-has-selection="true"] {
              background: linear-gradient(135deg, #2d3748 0%, #4a5568 100%);
              border-color: #667eea;
              color: #e1e1e1;
          }
          
          /* Pagination Dark Mode */
          body.dark-mode .pagination_wrapper .pagination li a {
              background-color: #2d2d2d;
              color: #e1e1e1;
              border-color: #444;
          }
          
          body.dark-mode .pagination_wrapper .pagination li.active a {
              background-color: #667eea;
              color: white;
          }
          
          /* Status Badges Dark Mode Adjustments */
          body.dark-mode .status_badge,
          body.dark-mode .tag_item,
          body.dark-mode .post_category {
              border: 1px solid #444;
          }
          
          /* Banner Section Dark Mode */
          body.dark-mode .banner_section {
              background-color: #1a1a1a;
          }
          
          body.dark-mode .banner_taital,
          body.dark-mode .banner_text {
              color: #e1e1e1 !important;
          }
          
          /* Additional Container and Background Overrides */
          body.dark-mode .container,
          body.dark-mode .container-fluid {
              background-color: transparent;
          }
          
          /* Ensure all text elements in dark mode */
          body.dark-mode .row,
          body.dark-mode .col-md-12,
          body.dark-mode .col-md-4,
          body.dark-mode .col-md-6,
          body.dark-mode .col-md-8,
          body.dark-mode .col-lg-4,
          body.dark-mode .col-lg-6,
          body.dark-mode .col-lg-8,
          body.dark-mode .col-sm-12 {
              background-color: transparent;
          }
          
          /* Override any white backgrounds */
          body.dark-mode .bg-white,
          body.dark-mode [style*="background: white"],
          body.dark-mode [style*="background: #fff"],
          body.dark-mode [style*="background-color: white"],
          body.dark-mode [style*="background-color: #fff"] {
              background-color: #2d2d2d !important;
          }
          
          /* Table Dark Mode */
          body.dark-mode .table,
          body.dark-mode table {
              background-color: #2d2d2d;
              color: #e1e1e1;
          }
          
          body.dark-mode .table td,
          body.dark-mode .table th,
          body.dark-mode table td,
          body.dark-mode table th {
              background-color: #2d2d2d;
              color: #e1e1e1;
              border-color: #444;
          }
          
          /* Alert and Modal Dark Mode */
          body.dark-mode .alert {
              background-color: #2d2d2d;
              color: #e1e1e1;
              border-color: #444;
          }
          
          body.dark-mode .modal-content {
              background-color: #2d2d2d;
              color: #e1e1e1;
          }
          
          /* Breadcrumb and Navigation Dark Mode */
          body.dark-mode .breadcrumb {
              background-color: #2d2d2d;
              color: #e1e1e1;
          }
          
          /* Dropdown Dark Mode */
          body.dark-mode .dropdown-menu {
              background-color: #2d2d2d;
              border-color: #444;
          }
          
          body.dark-mode .dropdown-item {
              color: #e1e1e1;
          }
          
          body.dark-mode .dropdown-item:hover {
              background-color: #444;
              color: #e1e1e1;
          }
          
          /* Additional Content Sections */
          body.dark-mode .choose_section,
          body.dark-mode .contact_section,
          body.dark-mode .client_section,
          body.dark-mode .blog_section {
              background-color: #1a1a1a;
          }
          
          body.dark-mode .choose_taital,
          body.dark-mode .contact_taital,
          body.dark-mode .client_taital,
          body.dark-mode .blog_taital {
              color: #e1e1e1 !important;
          }
          
          body.dark-mode .choose_text,
          body.dark-mode .contact_text,
          body.dark-mode .client_text,
          body.dark-mode .blog_text {
              color: #b0b0b0 !important;
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
          
          /* Additional Text Visibility Fixes */
          
          /* Ensure text-light class is visible in dark mode */
          body.dark-mode .text-light {
              color: #f8f9fa !important;
          }
          
          /* Ensure text-dark class is visible in light mode */
          body:not(.dark-mode) .text-dark {
              color: #212529 !important;
          }
          
          /* Fix any white text on white background issues */
          body:not(.dark-mode) .text-white {
              color: #333333 !important;
          }
          
          /* Fix any black text on black background issues */
          body.dark-mode .text-black {
              color: #e1e1e1 !important;
          }
          
          /* Ensure muted text is visible in both modes */
          body.dark-mode .text-muted {
              color: #888 !important;
          }
          
          body:not(.dark-mode) .text-muted {
              color: #6c757d !important;
          }
          
          /* Fix link visibility issues */
          body.dark-mode a:not(.btn):not(.nav-link):not(.dropdown-item) {
              color: #6db4fd !important;
          }
          
          body.dark-mode a:not(.btn):not(.nav-link):not(.dropdown-item):hover {
              color: #8ac5ff !important;
          }
          
          /* Fix button text visibility */
          body.dark-mode .btn-light {
              color: #212529 !important;
              background-color: #e9ecef !important;
              border-color: #e9ecef !important;
          }
          
          body.dark-mode .btn-dark {
              color: #ffffff !important;
              background-color: #495057 !important;
              border-color: #495057 !important;
          }
          
          /* Fix badge visibility */
          body.dark-mode .badge-light {
              color: #212529 !important;
              background-color: #e9ecef !important;
          }
          
          body.dark-mode .badge-dark {
              color: #ffffff !important;
              background-color: #495057 !important;
          }
          
          /* Fix card text visibility */
          body.dark-mode .card-text {
              color: #b0b0b0 !important;
          }
          
          body.dark-mode .card-title {
              color: #e1e1e1 !important;
          }
          
          /* Fix list group item visibility */
          body.dark-mode .list-group-item {
              background-color: #2d2d2d !important;
              color: #e1e1e1 !important;
              border-color: #444 !important;
          }
          
          /* Fix navbar text visibility */
          body.dark-mode .navbar-light .navbar-nav .nav-link {
              color: #e1e1e1 !important;
          }
          
          body.dark-mode .navbar-light .navbar-brand {
              color: #e1e1e1 !important;
          }
          
          /* Fix form label visibility */
          body.dark-mode label {
              color: #e1e1e1 !important;
          }
          
          body.dark-mode .form-label {
              color: #e1e1e1 !important;
          }
          
          /* Fix help text visibility */
          body.dark-mode .form-text {
              color: #888 !important;
          }
          
          body.dark-mode small {
              color: #888 !important;
          }
          
          /* Fix code and pre visibility */
          body.dark-mode code {
              color: #ff6b6b !important;
              background-color: #2d2d2d !important;
          }
          
          body.dark-mode pre {
              color: #e1e1e1 !important;
              background-color: #2d2d2d !important;
          }
          
          /* Fix blockquote visibility */
          body.dark-mode blockquote {
              color: #b0b0b0 !important;
              border-left-color: #444 !important;
          }
          
          /* Fix hr visibility */
          body.dark-mode hr {
              border-color: #444 !important;
          }
          
          /* Fix caption and figure text */
          body.dark-mode .figure-caption,
          body.dark-mode caption {
              color: #888 !important;
          }
          
          /* Fix mark/highlight visibility */
          body.dark-mode mark {
              background-color: #ffc107 !important;
              color: #212529 !important;
          }
          
          /* Fix strong emphasis visibility */
          body.dark-mode strong,
          body.dark-mode b {
              color: #ffffff !important;
          }
          
          /* Fix emphasis visibility */
          body.dark-mode em,
          body.dark-mode i {
              color: #e1e1e1 !important;
          }
          
          /* Fix span text visibility */
          body.dark-mode span {
              color: inherit !important;
          }
          
          /* Fix div text visibility */
          body.dark-mode div {
              color: inherit;
          }
          
          /* Override any inline styles that might cause visibility issues */
          body.dark-mode [style*="color: white"],
          body.dark-mode [style*="color: #fff"],
          body.dark-mode [style*="color: #ffffff"] {
              color: #e1e1e1 !important;
          }
          
          body:not(.dark-mode) [style*="color: black"],
          body:not(.dark-mode) [style*="color: #000"],
          body:not(.dark-mode) [style*="color: #000000"] {
              color: #212529 !important;
          }
          
          /* Fix any text that might be invisible due to matching background */
          body.dark-mode .bg-dark {
              color: #e1e1e1 !important;
          }
          
          body:not(.dark-mode) .bg-light {
              color: #212529 !important;
          }
          
          /* Fix input placeholder visibility */
          body.dark-mode input::placeholder,
          body.dark-mode textarea::placeholder,
          body.dark-mode select::placeholder {
              color: #888 !important;
              opacity: 1 !important;
          }
          
          /* Fix select option visibility */
          body.dark-mode select option {
              background-color: #2d2d2d !important;
              color: #e1e1e1 !important;
          }
          
          /* Fix disabled element visibility */
          body.dark-mode .disabled,
          body.dark-mode [disabled] {
              color: #666 !important;
          }
          
          /* Fix readonly element visibility */
          body.dark-mode [readonly] {
              background-color: #3d3d3d !important;
              color: #b0b0b0 !important;
          }
          
          /* Ensure minimum contrast ratios */
          body.dark-mode .text-success {
              color: #5cb85c !important;
          }
          
          body.dark-mode .text-info {
              color: #5bc0de !important;
          }
          
          body.dark-mode .text-warning {
              color: #f0ad4e !important;
          }
          
          body.dark-mode .text-danger {
              color: #d9534f !important;
          }
          
          /* Fix any remaining visibility issues with utility classes */
          body.dark-mode .text-primary {
              color: #667eea !important;
          }
          
          body.dark-mode .text-secondary {
              color: #a0a0a0 !important;
          }
          
          /* Fix border visibility */
          body.dark-mode .border {
              border-color: #444 !important;
          }
          
          body.dark-mode .border-light {
              border-color: #666 !important;
          }
          
          body.dark-mode .border-dark {
              border-color: #666 !important;
          }
          
          /* Fix shadow visibility */
          body.dark-mode .shadow,
          body.dark-mode .shadow-sm,
          body.dark-mode .shadow-lg {
              box-shadow: 0 0.125rem 0.25rem rgba(255, 255, 255, 0.075) !important;
          }
          
          /* Enhanced Input Field Styling */
          input.profile_input,
          input.form_input,
          select.profile_input,
          select.form_input,
          .form-control {
              padding: 12px 16px !important;
              border: 2px solid #e1e8ed !important;
              border-radius: 8px !important;
              font-size: 14px !important;
              transition: all 0.3s ease !important;
              background-color: #ffffff !important;
              color: #2c3e50 !important;
              box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05) !important;
          }
          
          input.profile_input:focus,
          input.form_input:focus,
          select.profile_input:focus,
          select.form_input:focus,
          .form-control:focus {
              outline: none !important;
              border-color: #667eea !important;
              box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.15), 0 4px 8px rgba(0, 0, 0, 0.1) !important;
              transform: translateY(-1px) !important;
          }
          
          /* Dark Mode Input Fields */
          body.dark-mode input.profile_input,
          body.dark-mode input.form_input,
          body.dark-mode select.profile_input,
          body.dark-mode select.form_input,
          body.dark-mode .form-control {
              background-color: #2d2d2d !important;
              color: #e1e1e1 !important;
              border-color: #495057 !important;
              box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2) !important;
          }
          
          body.dark-mode input.profile_input:focus,
          body.dark-mode input.form_input:focus,
          body.dark-mode select.profile_input:focus,
          body.dark-mode select.form_input:focus,
          body.dark-mode .form-control:focus {
              border-color: #667eea !important;
              box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.25), 0 4px 8px rgba(0, 0, 0, 0.3) !important;
              background-color: #343a40 !important;
          }
          
          /* Placeholder Text Improvements */
          input.profile_input::placeholder,
          input.form_input::placeholder,
          select.profile_input::placeholder,
          select.form_input::placeholder,
          .form-control::placeholder {
              color: #8492a6 !important;
              font-style: italic !important;
          }
          
          body.dark-mode input.profile_input::placeholder,
          body.dark-mode input.form_input::placeholder,
          body.dark-mode select.profile_input::placeholder,
          body.dark-mode select.form_input::placeholder,
          body.dark-mode .form-control::placeholder {
              color: #adb5bd !important;
          }
          
          /* Form Label Improvements */
          .profile_label,
          .form_label,
          label {
              color: #2c3e50 !important;
              font-weight: 600 !important;
              margin-bottom: 8px !important;
              font-size: 14px !important;
          }
          
          body.dark-mode .profile_label,
          body.dark-mode .form_label,
          body.dark-mode label {
              color: #e1e1e1 !important;
          }
          
          /* Button Hover Effects for All Buttons */
          .btn:not(.btn-close) {
              transition: all 0.3s ease !important;
              border-radius: 8px !important;
              font-weight: 600 !important;
              padding: 10px 20px !important;
              box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1) !important;
          }
          
          .btn:not(.btn-close):hover {
              transform: translateY(-1px) !important;
              box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15) !important;
          }
          
          .btn-primary {
              background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
              border: none !important;
              color: #ffffff !important;
          }
          
          .btn-primary:hover {
              background: linear-gradient(135deg, #5a67d8 0%, #6c63ff 100%) !important;
              box-shadow: 0 4px 8px rgba(102, 126, 234, 0.3) !important;
          }
          
          .btn-secondary {
              background: #6c757d !important;
              border: none !important;
              color: #ffffff !important;
          }
          
          .btn-secondary:hover {
              background: #5a6268 !important;
              box-shadow: 0 4px 8px rgba(108, 117, 125, 0.3) !important;
          }
          
          .btn-danger {
              background: linear-gradient(135deg, #dc3545 0%, #c82333 100%) !important;
              border: none !important;
              color: #ffffff !important;
          }
          
          .btn-danger:hover {
              background: linear-gradient(135deg, #c82333 0%, #a71e2a 100%) !important;
              box-shadow: 0 4px 8px rgba(220, 53, 69, 0.3) !important;
          }
          
          /* Alert Styling Improvements */
          .alert {
              border-radius: 12px !important;
              padding: 16px 20px !important;
              border: none !important;
              box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1) !important;
              font-weight: 500 !important;
          }
          
          .alert-success {
              background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%) !important;
              color: #155724 !important;
              border-left: 4px solid #28a745 !important;
          }
          
          .alert-danger {
              background: linear-gradient(135deg, #f8d7da 0%, #f5c6cb 100%) !important;
              color: #721c24 !important;
              border-left: 4px solid #dc3545 !important;
          }
          
          .alert-warning {
              background: linear-gradient(135deg, #fff3cd 0%, #ffeeba 100%) !important;
              color: #856404 !important;
              border-left: 4px solid #ffc107 !important;
          }
          
          body.dark-mode .alert-success {
              background: linear-gradient(135deg, rgba(25, 135, 84, 0.2) 0%, rgba(25, 135, 84, 0.15) 100%) !important;
              color: #5cb85c !important;
              border-left-color: #28a745 !important;
          }
          
          body.dark-mode .alert-danger {
              background: linear-gradient(135deg, rgba(220, 53, 69, 0.2) 0%, rgba(220, 53, 69, 0.15) 100%) !important;
              color: #ff6b6b !important;
              border-left-color: #dc3545 !important;
          }
          
          body.dark-mode .alert-warning {
              background: linear-gradient(135deg, rgba(255, 193, 7, 0.2) 0%, rgba(255, 193, 7, 0.15) 100%) !important;
              color: #ffc107 !important;
              border-left-color: #ffc107 !important;
          }
      </style>
      
      <script>
          // IMMEDIATE FOUC PREVENTION FOR BLOG THEME SWITCHING
          (function() {
              'use strict';
              
              // Apply theme IMMEDIATELY - before any rendering
              function applyThemeImmediate() {
                  const savedTheme = localStorage.getItem('app-theme');
                  const body = document.body;
                  
                  if (savedTheme === 'dark' && body) {
                      body.classList.add('dark-mode');
                  } else if (body) {
                      body.classList.remove('dark-mode');
                  }
              }
              
              // Apply immediately if body exists
              if (document.body) {
                  applyThemeImmediate();
              } else {
                  // Apply as soon as body is available
                  const observer = new MutationObserver(function(mutations) {
                      if (document.body) {
                          applyThemeImmediate();
                          observer.disconnect();
                      }
                  });
                  observer.observe(document.documentElement, { childList: true });
              }
          })();
          
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
                      if (iconDesktop) iconDesktop.className = 'fa fa-sun-o';
                      if (iconMobile) iconMobile.className = 'fa fa-sun-o';
                      if (textDesktop) textDesktop.textContent = 'Light';
                      if (textMobile) textMobile.textContent = 'Light Mode';
                      localStorage.setItem('app-theme', 'dark');
                  } else {
                      body.classList.remove('dark-mode');
                      if (iconDesktop) iconDesktop.className = 'fa fa-moon-o';
                      if (iconMobile) iconMobile.className = 'fa fa-moon-o';
                      if (textDesktop) textDesktop.textContent = 'Dark';
                      if (textMobile) textMobile.textContent = 'Dark Mode';
                      localStorage.setItem('app-theme', 'light');
                  }
              }
              
              // Initialize theme (redundant but ensures UI elements are updated)
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
      
      <!-- Notification Badge Styles -->
      <style>
          .notification-badge {
              background: #ff4757 !important;
              color: white !important;
              border-radius: 120%;
              padding: 2px 6px;
              font-size: 10px;
              position: absolute;
              top: 10px;
              right: -10px;
              min-width: 16px;
              text-align: center;
              font-weight: bold;
              border: 2px solid white;
              box-shadow: 0 2px 4px rgba(0,0,0,0.2);
          }
          
          .nav-link {
              position: relative;
          }
          
          .menu_main ul li a {
              position: relative;
          }
          
          /* Dark mode notification badge */
          .dark-mode .notification-badge {
              border-color: #1a1a1a;
          }
          
          /* Mobile notification styling */
          @media (max-width: 991px) {
              .notification-badge {
                  position: static;
                  margin-left: 5px;
                  top: auto;
                  right: auto;
              }
          }
          
          /* Profile Dropdown Styles */
          .dropdown-menu-custom {
              transition: all 0.3s ease;
          }
          
          .dropdown-menu-custom a:hover {
              background-color: #f8f9fa !important;
          }
          
          .dropdown-menu-custom a:last-child:hover {
              background-color: #f5f5f5 !important;
          }
          
          /* Dark Mode Profile Dropdown */
          body.dark-mode .dropdown-menu-custom {
              background: #2d2d2d !important;
              border-color: #444 !important;
              box-shadow: 0 4px 6px rgba(0,0,0,0.3) !important;
          }
          
          body.dark-mode .dropdown-menu-custom a {
              color: #e1e1e1 !important;
              border-bottom: 1px solid #444 !important;
          }
          
          body.dark-mode .dropdown-menu-custom a:hover {
              background-color: #3a3a3a !important;
              color: #f0f0f0 !important;
          }
          
          body.dark-mode .dropdown-menu-custom a:last-child {
              border-bottom: none !important;
          }
          
          body.dark-mode .dropdown-menu-custom a:last-child:hover {
              background-color: #3a3a3a !important;
          }
          
          /* Mobile dropdown styling */
          @media (max-width: 991px) {
              .dropdown-menu {
                  border: none;
                  box-shadow: none;
                  background: rgba(248, 249, 250, 0.95);
                  margin-top: 5px;
              }
              
              .dropdown-item {
                  padding: 10px 20px;
                  color: #333 !important;
              }
              
              .dropdown-item:hover {
                  background-color: rgba(0, 123, 255, 0.1) !important;
              }
              
              /* Dark mode mobile dropdown */
              body.dark-mode .dropdown-menu {
                  background: rgba(45, 45, 45, 0.95) !important;
              }
              
              body.dark-mode .dropdown-item {
                  color: #e1e1e1 !important;
              }
              
              body.dark-mode .dropdown-item:hover {
                  background-color: rgba(255, 255, 255, 0.1) !important;
                  color: #f0f0f0 !important;
              }
          }
      </style>
      
      <!-- Profile Dropdown JavaScript -->
      <script>
          function toggleDropdown(event) {
              event.preventDefault();
              event.stopPropagation();
              
              const dropdown = document.getElementById('profileDropdownDesktop');
              const isVisible = dropdown.style.display !== 'none';
              
              // Close all other dropdowns first
              document.querySelectorAll('.dropdown-menu-custom').forEach(function(menu) {
                  menu.style.display = 'none';
              });
              
              // Toggle current dropdown
              dropdown.style.display = isVisible ? 'none' : 'block';
          }
          
          // Close dropdown when clicking outside
          document.addEventListener('click', function(event) {
              const dropdown = document.getElementById('profileDropdownDesktop');
              const dropdownParent = dropdown ? dropdown.closest('.dropdown') : null;
              
              if (dropdown && dropdownParent && !dropdownParent.contains(event.target)) {
                  dropdown.style.display = 'none';
              }
          });
          
          // Close dropdown on window resize
          window.addEventListener('resize', function() {
              const dropdown = document.getElementById('profileDropdownDesktop');
              if (dropdown) {
                  dropdown.style.display = 'none';
              }
          });
      </script>
      
      <!-- Enhanced Dark Mode Styling -->
      <style>
          /* Enhanced Status Badge Dark Mode Visibility */
          body.dark-mode .status_badge {
              border: 1px solid rgba(255, 255, 255, 0.2) !important;
              box-shadow: 0 2px 4px rgba(0, 0, 0, 0.3) !important;
          }
          
          body.dark-mode .status_active {
              background: #198754 !important;
              color: #ffffff !important;
              border-color: rgba(25, 135, 84, 0.3) !important;
          }
          
          body.dark-mode .status_pending {
              background: #ffc107 !important;
              color: #212529 !important;
              border-color: rgba(255, 193, 7, 0.3) !important;
              font-weight: 700 !important;
          }
          
          body.dark-mode .status_rejected {
              background: #dc3545 !important;
              color: #ffffff !important;
              border-color: rgba(220, 53, 69, 0.3) !important;
          }
          
          /* Enhanced Comment Input Styling */
          .comment_textarea,
          .form_textarea,
          textarea.profile_input,
          textarea.form_input {
              width: 100% !important;
              padding: 15px 18px !important;
              border: 2px solid #e1e8ed !important;
              border-radius: 12px !important;
              font-size: 15px !important;
              font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif !important;
              line-height: 1.6 !important;
              resize: vertical !important;
              min-height: 120px !important;
              transition: all 0.3s ease !important;
              background-color: #ffffff !important;
              color: #2c3e50 !important;
              box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05) !important;
          }
          
          .comment_textarea:focus,
          .form_textarea:focus,
          textarea.profile_input:focus,
          textarea.form_input:focus {
              outline: none !important;
              border-color: #667eea !important;
              box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.15), 0 4px 8px rgba(0, 0, 0, 0.1) !important;
              transform: translateY(-1px) !important;
          }
          
          .comment_textarea::placeholder,
          .form_textarea::placeholder,
          textarea.profile_input::placeholder,
          textarea.form_input::placeholder {
              color: #8492a6 !important;
              font-style: italic !important;
          }
          
          /* Dark Mode Comment Input Styling */
          body.dark-mode .comment_textarea,
          body.dark-mode .form_textarea,
          body.dark-mode textarea.profile_input,
          body.dark-mode textarea.form_input {
              background-color: #2d2d2d !important;
              color: #e1e1e1 !important;
              border-color: #495057 !important;
              box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2) !important;
          }
          
          body.dark-mode .comment_textarea:focus,
          body.dark-mode .form_textarea:focus,
          body.dark-mode textarea.profile_input:focus,
          body.dark-mode textarea.form_input:focus {
              border-color: #667eea !important;
              box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.25), 0 4px 8px rgba(0, 0, 0, 0.3) !important;
              background-color: #343a40 !important;
          }
          
          body.dark-mode .comment_textarea::placeholder,
          body.dark-mode .form_textarea::placeholder,
          body.dark-mode textarea.profile_input::placeholder,
          body.dark-mode textarea.form_input::placeholder {
              color: #adb5bd !important;
          }
          
          /* Comment Form Container Styling */
          .add_comment_form {
              background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%) !important;
              border: 1px solid #e9ecef !important;
              border-radius: 16px !important;
              padding: 30px !important;
              margin-bottom: 30px !important;
              box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08) !important;
              transition: all 0.3s ease !important;
          }
          
          .add_comment_form:hover {
              box-shadow: 0 6px 20px rgba(0, 0, 0, 0.12) !important;
              transform: translateY(-2px) !important;
          }
          
          .add_comment_form h4 {
              color: #2c3e50 !important;
              font-weight: 600 !important;
              margin-bottom: 20px !important;
              font-size: 18px !important;
          }
          
          /* Dark Mode Comment Form */
          body.dark-mode .add_comment_form {
              background: linear-gradient(135deg, #2d2d2d 0%, #343a40 100%) !important;
              border-color: #495057 !important;
              box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3) !important;
          }
          
          body.dark-mode .add_comment_form:hover {
              box-shadow: 0 6px 20px rgba(0, 0, 0, 0.4) !important;
          }
          
          body.dark-mode .add_comment_form h4 {
              color: #e1e1e1 !important;
          }
          
          /* Enhanced Form Button Styling */
          .form_actions .btn,
          .add_comment_form .btn {
              padding: 12px 24px !important;
              border-radius: 8px !important;
              font-weight: 600 !important;
              font-size: 14px !important;
              transition: all 0.3s ease !important;
              border: none !important;
              cursor: pointer !important;
              display: inline-flex !important;
              align-items: center !important;
              gap: 8px !important;
              box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1) !important;
          }
          
          .form_actions .btn-primary,
          .add_comment_form .btn-primary {
              background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
              color: #ffffff !important;
          }
          
          .form_actions .btn-primary:hover,
          .add_comment_form .btn-primary:hover {
              background: linear-gradient(135deg, #5a67d8 0%, #6c63ff 100%) !important;
              transform: translateY(-1px) !important;
              box-shadow: 0 4px 8px rgba(102, 126, 234, 0.3) !important;
          }
          
          .form_actions .btn-secondary,
          .add_comment_form .btn-secondary {
              background: #6c757d !important;
              color: #ffffff !important;
          }
          
          .form_actions .btn-secondary:hover,
          .add_comment_form .btn-secondary:hover {
              background: #5a6268 !important;
              transform: translateY(-1px) !important;
              box-shadow: 0 4px 8px rgba(108, 117, 125, 0.3) !important;
          }
          
          /* Comment Item Styling Improvements */
          .comment_item {
              background: #ffffff !important;
              border: 1px solid #e9ecef !important;
              border-radius: 12px !important;
              padding: 24px !important;
              margin-bottom: 20px !important;
              transition: all 0.3s ease !important;
              box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08) !important;
          }
          
          .comment_item:hover {
              box-shadow: 0 4px 16px rgba(0, 0, 0, 0.12) !important;
              transform: translateY(-2px) !important;
              border-color: #667eea !important;
          }
          
          /* Dark Mode Comment Items */
          body.dark-mode .comment_item {
              background: #2d2d2d !important;
              border-color: #495057 !important;
              box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2) !important;
          }
          
          body.dark-mode .comment_item:hover {
              background: #343a40 !important;
              border-color: #667eea !important;
              box-shadow: 0 4px 16px rgba(0, 0, 0, 0.3) !important;
          }
          
          /* Form Error Message Styling */
          .error_message {
              color: #dc3545 !important;
              font-size: 13px !important;
              margin-top: 8px !important;
              padding: 8px 12px !important;
              background: #f8d7da !important;
              border: 1px solid #f5c6cb !important;
              border-radius: 6px !important;
              display: block !important;
          }
          
          body.dark-mode .error_message {
              background: rgba(220, 53, 69, 0.2) !important;
              border-color: rgba(220, 53, 69, 0.3) !important;
              color: #ff6b6b !important;
          }
          
          /* Login Prompt Styling */
          .login_prompt {
              background: linear-gradient(135deg, #fff3cd 0%, #fef9e7 100%) !important;
              border: 2px solid #ffeaa7 !important;
              border-radius: 12px !important;
              padding: 24px !important;
              text-align: center !important;
              margin-bottom: 30px !important;
              box-shadow: 0 4px 12px rgba(255, 234, 167, 0.3) !important;
          }
          
          .login_prompt a {
              color: #667eea !important;
              font-weight: 600 !important;
              text-decoration: none !important;
              border-bottom: 2px solid transparent !important;
              transition: all 0.3s ease !important;
          }
          
          .login_prompt a:hover {
              color: #5a67d8 !important;
              border-bottom-color: #5a67d8 !important;
          }
          
          body.dark-mode .login_prompt {
              background: linear-gradient(135deg, #3d3d3d 0%, #495057 100%) !important;
              border-color: #6c757d !important;
              box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3) !important;
              color: #e1e1e1 !important;
          }
          
          /* Additional Badge Improvements */
          .admin_badge {
              background: linear-gradient(135deg, #dc3545 0%, #c82333 100%) !important;
              color: #ffffff !important;
              padding: 4px 10px !important;
              border-radius: 12px !important;
              font-size: 11px !important;
              font-weight: 700 !important;
              text-transform: uppercase !important;
              letter-spacing: 0.5px !important;
              box-shadow: 0 2px 4px rgba(220, 53, 69, 0.3) !important;
              border: 1px solid rgba(220, 53, 69, 0.2) !important;
          }
          
          body.dark-mode .admin_badge {
              background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%) !important;
              border-color: rgba(231, 76, 60, 0.3) !important;
              box-shadow: 0 2px 4px rgba(231, 76, 60, 0.4) !important;
          }
          
          /* Status Badge Text Enhancement */
          .status_badge {
              font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif !important;
              letter-spacing: 0.5px !important;
              text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1) !important;
              position: relative !important;
              overflow: hidden !important;
          }
          
          .status_badge::before {
              content: '' !important;
              position: absolute !important;
              top: -50% !important;
              left: -50% !important;
              width: 200% !important;
              height: 200% !important;
              background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%) !important;
              opacity: 0 !important;
              transition: opacity 0.3s ease !important;
          }
          
          .status_badge:hover::before {
              opacity: 1 !important;
          }
          
          /* Light Mode Status Badge Improvements */
          body:not(.dark-mode) .status_active {
              background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%) !important;
              color: #155724 !important;
              border: 1px solid #c3e6cb !important;
              text-shadow: 0 1px 1px rgba(21, 87, 36, 0.1) !important;
          }
          
          body:not(.dark-mode) .status_pending {
              background: linear-gradient(135deg, #fff3cd 0%, #ffeeba 100%) !important;
              color: #856404 !important;
              border: 1px solid #ffeeba !important;
              text-shadow: 0 1px 1px rgba(133, 100, 4, 0.1) !important;
              font-weight: 700 !important;
          }
          
          body:not(.dark-mode) .status_rejected {
              background: linear-gradient(135deg, #f8d7da 0%, #f5c6cb 100%) !important;
              color: #721c24 !important;
              border: 1px solid #f5c6cb !important;
              text-shadow: 0 1px 1px rgba(114, 28, 36, 0.1) !important;
          }
          
          /* Post Card Layout Fixes */
          .post_card {
              display: flex !important;
              flex-direction: column !important;
              height: 100% !important;
              min-height: 450px !important; /* Ensure consistent height */
          }
          
          /* Fix post content layout to push button to bottom */
          .post_card .post_content {
              display: flex !important;
              flex-direction: column !important;
              flex: 1 !important;
              padding: 20px !important;
              position: relative !important;
          }
          
          /* Ensure button is always at the bottom */
          .post_card .btn_main {
              margin-top: auto !important;
              padding-top: 15px !important;
          }
          
          /* For posts without images, add consistent spacing */
          .post_card:not(:has(.post_image)) {
              min-height: 450px !important;
          }
          
          .post_card:not(:has(.post_image)) .post_content {
              padding-top: 30px !important;
          }
          
          /* Fix for CSS :has() support fallback */
          @supports not selector(:has(*)) {
              .post_card .post_content {
                  min-height: 250px !important;
              }
          }
          
          /* Dark mode category and tag text fixes */
          body.dark-mode .post_category span {
              color: #87ceeb !important; /* Light blue for dark mode */
              background: none !important;
              text-shadow: none !important;
              font-weight: 600 !important;
          }
          
          body.dark-mode .post_category {
              color: #e1e1e1 !important;
              background: none !important;
              background-color: transparent !important;
          }
          
          /* Reset any conflicting post_category styles */
          .post_category {
              background: none !important;
              background-color: transparent !important;
              padding: 0 !important;
              border-radius: 0 !important;
          }
          
          body.dark-mode .tag_badge {
              border: 1px solid rgba(255, 255, 255, 0.2) !important;
              box-shadow: 0 2px 4px rgba(0, 0, 0, 0.3) !important;
          }
          
          /* Light mode category styling */
          body:not(.dark-mode) .post_category span {
              color: #007bff !important;
              font-weight: 600 !important;
          }
          
          body:not(.dark-mode) .post_category {
              background: none !important;
              background-color: transparent !important;
          }
          
          /* Category icon styling */
          .category_icon {
              margin-right: 5px !important;
              color: inherit !important;
              background: none !important;
              background-color: transparent !important;
          }
          
          body.dark-mode .category_icon {
              color: #87ceeb !important;
              background: none !important;
              background-color: transparent !important;
          }
          
          body:not(.dark-mode) .category_icon {
              color: #007bff !important;
              background: none !important;
              background-color: transparent !important;
          }
          
          /* Category text styling */
          .category_text {
              background: none !important;
              background-color: transparent !important;
              border: none !important;
              box-shadow: none !important;
              text-shadow: none !important;
          }
          
          body.dark-mode .category_text {
              color: #87ceeb !important;
              background: none !important;
              background-color: transparent !important;
          }
          
          body:not(.dark-mode) .category_text {
              color: #007bff !important;
              background: none !important;
              background-color: transparent !important;
          }
          
          /* Responsive improvements */
          @media (max-width: 768px) {
              .post_card {
                  min-height: 400px !important;
              }
              
              .post_card .post_content {
                  padding: 15px !important;
              }
              
              .post_card:not(:has(.post_image)) .post_content {
                  padding-top: 20px !important;
              }
          }
          
          @media (max-width: 480px) {
              .post_card {
                  min-height: 350px !important;
              }
              
              .post_card .post_content {
                  padding: 12px !important;
              }
          }
      </style>
  </head>
  <body>
      <!-- Your body content here -->
  </body>
</html>
