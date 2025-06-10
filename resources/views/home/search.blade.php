<!DOCTYPE html>
<html lang="en">
   <head>
      @include('home.homecss')
   </head>
   <body>
      <!-- header section start -->
      <div class="header_section">
         @include('home.header')
      </div>
      <!-- header section end -->
      
      <!-- search section start -->
      <div class="search_section layout_padding">
          <div class="container">
              <div class="search_header">
                  <h1 class="search_title">Search Posts</h1>
                  <p class="search_subtitle">Find the content you're looking for with our advanced search</p>
              </div>
              
              <!-- Advanced Search Form -->
              <div class="search_form_container">
                  <form method="GET" action="{{ route('home.search') }}" class="advanced_search_form">
                      <div class="search_form_row">
                          <!-- Search Input -->
                          <div class="search_input_group">
                              <label for="search_input" class="search_label">Search Keywords</label>
                              <div class="search_input_wrapper">
                                  <input type="text" 
                                         id="search_input" 
                                         name="q" 
                                         class="search_input" 
                                         placeholder="Search by title or content..." 
                                         value="{{ $searchTerm }}"
                                         autocomplete="off">
                                  <div id="search_suggestions" class="search_suggestions"></div>
                              </div>
                          </div>
                          
                          <!-- Category Filter -->
                          <div class="filter_group">
                              <label for="category_filter" class="search_label">
                                  Category
                                  @if($selectedCategory)
                                      <span class="active_filter_indicator">✓</span>
                                  @endif
                                  @if(Auth::check() && Auth::user()->usertype == 'admin')
                                      <button type="button" class="admin_add_btn" onclick="showAddCategoryModal()">
                                          <i class="fa fa-plus"></i>
                                      </button>
                                  @endif
                              </label>
                              
                              <!-- Custom Dropdown Container -->
                              <div class="custom_dropdown_container" id="category_dropdown_container">
                                  <div class="custom_dropdown_trigger" onclick="toggleCustomDropdown('category')" 
                                       role="combobox" aria-expanded="false" aria-haspopup="listbox" 
                                       tabindex="0" aria-label="Select category filter">
                                      <span class="selected_text" id="category_selected_text">
                                          @if($selectedCategory)
                                              @foreach($categories as $category)
                                                  @if($category->id == $selectedCategory)
                                                      {{ $category->name }}
                                                      @break
                                                  @endif
                                              @endforeach
                                          @else
                                              All Categories
                                          @endif
                                      </span>
                                      <i class="dropdown_arrow fas fa-chevron-down" aria-hidden="true"></i>
                                  </div>
                                  <div class="custom_dropdown_menu" id="category_dropdown_menu" role="listbox" aria-label="Category options">
                                      <div class="dropdown_option {{ !$selectedCategory ? 'selected' : '' }}" 
                                           onclick="selectCustomOption('category', '', 'All Categories')"
                                           role="option" tabindex="-1">
                                          All Categories
                                      </div>
                                      @foreach($categories as $category)
                                          <div class="dropdown_option {{ $selectedCategory == $category->id ? 'selected' : '' }}" 
                                               onclick="selectCustomOption('category', '{{ $category->id }}', '{{ $category->name }}')"
                                               role="option" tabindex="-1">
                                              {{ $category->name }}
                                          </div>
                                      @endforeach
                                  </div>
                              </div>
                              
                              <!-- Hidden select for form submission -->
                              <select name="category" id="category_filter" class="filter_select hidden_select" 
                                      {{ $selectedCategory ? 'data-has-selection="true"' : '' }} style="display: none;">
                                  <option value="">All Categories</option>
                                  @foreach($categories as $category)
                                      <option value="{{ $category->id }}" 
                                              {{ $selectedCategory == $category->id ? 'selected' : '' }}>
                                          {{ $category->name }}
                                      </option>
                                  @endforeach
                              </select>
                              @if(Auth::check() && Auth::user()->usertype == 'admin')
                                  <div class="admin_category_list" style="margin-top: 10px; display: none;">
                                      @foreach($categories as $category)
                                          <div class="admin_item">
                                              <span>{{ $category->name }}</span>
                                              <button type="button" class="admin_delete_btn" onclick="deleteCategory({{ $category->id }})">
                                                  <i class="fa fa-trash"></i>
                                              </button>
                                          </div>
                                      @endforeach
                                  </div>
                                  <button type="button" class="admin_manage_btn" onclick="toggleCategoryManage()">
                                      <i class="fa fa-cog"></i> Manage
                                  </button>
                              @endif
                          </div>
                          
                          <!-- Sort Options -->
                          <div class="filter_group">
                              <label for="sort_filter" class="search_label">
                                  Sort By
                                  @if($sortBy && $sortBy !== 'latest')
                                      <span class="active_filter_indicator">✓</span>
                                  @endif
                              </label>
                              
                              <!-- Custom Dropdown Container -->
                              <div class="custom_dropdown_container" id="sort_dropdown_container">
                                  <div class="custom_dropdown_trigger" onclick="toggleCustomDropdown('sort')"
                                       role="combobox" aria-expanded="false" aria-haspopup="listbox" 
                                       tabindex="0" aria-label="Select sort order">
                                      <span class="selected_text" id="sort_selected_text">
                                          @switch($sortBy)
                                              @case('oldest')
                                                  Oldest First
                                                  @break
                                              @case('title')
                                                  Title A-Z
                                                  @break
                                              @case('most_commented')
                                                  Most Commented
                                                  @break
                                              @default
                                                  Latest First
                                          @endswitch
                                      </span>
                                      <i class="dropdown_arrow fas fa-chevron-down" aria-hidden="true"></i>
                                  </div>
                                  <div class="custom_dropdown_menu" id="sort_dropdown_menu" role="listbox" aria-label="Sort options">
                                      <div class="dropdown_option {{ $sortBy == 'latest' || !$sortBy ? 'selected' : '' }}" 
                                           onclick="selectCustomOption('sort', 'latest', 'Latest First')"
                                           role="option" tabindex="-1">
                                          Latest First
                                      </div>
                                      <div class="dropdown_option {{ $sortBy == 'oldest' ? 'selected' : '' }}" 
                                           onclick="selectCustomOption('sort', 'oldest', 'Oldest First')"
                                           role="option" tabindex="-1">
                                          Oldest First
                                      </div>
                                      <div class="dropdown_option {{ $sortBy == 'title' ? 'selected' : '' }}" 
                                           onclick="selectCustomOption('sort', 'title', 'Title A-Z')"
                                           role="option" tabindex="-1">
                                          Title A-Z
                                      </div>
                                      <div class="dropdown_option {{ $sortBy == 'most_commented' ? 'selected' : '' }}" 
                                           onclick="selectCustomOption('sort', 'most_commented', 'Most Commented')"
                                           role="option" tabindex="-1">
                                          Most Commented
                                      </div>
                                  </div>
                              </div>
                              
                              <!-- Hidden select for form submission -->
                              <select name="sort" id="sort_filter" class="filter_select hidden_select"
                                      {{ ($sortBy && $sortBy !== 'latest') ? 'data-has-selection="true"' : '' }} style="display: none;">
                                  <option value="latest" {{ $sortBy == 'latest' ? 'selected' : '' }}>
                                      Latest First
                                  </option>
                                  <option value="oldest" {{ $sortBy == 'oldest' ? 'selected' : '' }}>
                                      Oldest First
                                  </option>
                                  <option value="title" {{ $sortBy == 'title' ? 'selected' : '' }}>
                                      Title A-Z
                                  </option>
                                  <option value="most_commented" {{ $sortBy == 'most_commented' ? 'selected' : '' }}>
                                      Most Commented
                                  </option>
                              </select>
                          </div>
                      </div>
                      
                      <!-- Tags Filter -->
                      <div class="tags_filter_section">
                          <label class="search_label">
                              Filter by Tags
                              @if(Auth::check() && Auth::user()->usertype == 'admin')
                                  <button type="button" class="admin_add_btn" onclick="showAddTagModal()">
                                      <i class="fa fa-plus"></i>
                                  </button>
                                  <button type="button" class="admin_manage_btn" onclick="toggleTagManage()">
                                      <i class="fa fa-cog"></i> Manage
                                  </button>
                              @endif
                          </label>
                          <div class="tags_container">
                              @foreach($tags as $tag)
                                  <div class="tag_checkbox" id="tag_container_{{ $tag->id }}">
                                      <input type="checkbox" 
                                             id="tag_{{ $tag->id }}" 
                                             name="tags[]" 
                                             value="{{ $tag->id }}"
                                             {{ in_array($tag->id, $selectedTags) ? 'checked' : '' }}>
                                      <label for="tag_{{ $tag->id }}" class="tag_label">{{ $tag->name }}</label>
                                      @if(Auth::check() && Auth::user()->usertype == 'admin')
                                          <button type="button" class="admin_tag_delete" onclick="deleteTag({{ $tag->id }})" style="display: none;">
                                              <i class="fa fa-times"></i>
                                          </button>
                                      @endif
                                  </div>
                              @endforeach
                          </div>
                      </div>
                      
                      <!-- Search Actions -->
                      <div class="search_actions">
                          <button type="submit" class="btn btn-primary search_btn">
                              <i class="fa fa-search"></i> Search Posts
                          </button>
                          <a href="{{ route('home.search') }}" class="btn btn-secondary clear_btn">
                              <i class="fa fa-refresh"></i> Clear Filters
                          </a>
                      </div>
                  </form>
              </div>
              
              <!-- Search Results -->
              <div class="search_results_section">
                  @if($hasResults)
                      <div class="results_header">
                          <h3 class="results_title">
                              Search Results 
                              @if($posts->total() > 0)
                                  <span class="results_count">({{ $posts->total() }} {{ Str::plural('post', $posts->total()) }} found)</span>
                              @endif
                          </h3>
                          
                          @if($searchTerm || $selectedCategory || count($selectedTags) > 0)
                              <div class="applied_filters">
                                  <span class="filters_label">Applied Filters:</span>
                                  @if($searchTerm)
                                      <span class="filter_tag">
                                          Keywords: "{{ $searchTerm }}"
                                          <a href="{{ request()->fullUrlWithQuery(['q' => null]) }}" class="remove_filter">×</a>
                                      </span>
                                  @endif
                                  @if($selectedCategory)
                                      @php 
                                          $categoryName = 'Unknown';
                                          if (isset($categories) && is_object($categories) && method_exists($categories, 'where')) {
                                              $selectedCategoryObj = $categories->where('id', $selectedCategory)->first();
                                              $categoryName = $selectedCategoryObj ? $selectedCategoryObj->name : 'Unknown';
                                          }
                                      @endphp
                                      <span class="filter_tag">
                                          Category: {{ $categoryName }}
                                          <a href="{{ request()->fullUrlWithQuery(['category' => null]) }}" class="remove_filter">×</a>
                                      </span>
                                  @endif
                                  @if(count($selectedTags) > 0)
                                      @foreach($selectedTags as $tagId)
                                          @php 
                                              $tagName = 'Unknown';
                                              if (isset($tags) && is_object($tags) && method_exists($tags, 'where')) {
                                                  $selectedTagObj = $tags->where('id', $tagId)->first();
                                                  $tagName = $selectedTagObj ? $selectedTagObj->name : 'Unknown';
                                              }
                                          @endphp
                                          <span class="filter_tag">
                                              Tag: {{ $tagName }}
                                              <a href="{{ request()->fullUrlWithQuery(['tags' => array_diff($selectedTags, [$tagId])]) }}" class="remove_filter">×</a>
                                          </span>
                                      @endforeach
                                  @endif
                              </div>
                          @endif
                      </div>
                      
                      @if($posts->count() > 0)
                          <div class="search_results_grid">
                              @foreach($posts as $post)
                                  <div class="search_result_card">
                                      @if($post->image)
                                          <div class="result_image">
                                              <img src="{{ asset('postimage/' . $post->image) }}" alt="{{ $post->title }}" class="img-fluid">
                                              <div class="result_overlay">
                                                  <a href="{{ route('home.post_details', $post->id) }}" class="view_post_btn">View Post</a>
                                              </div>
                                          </div>
                                      @endif
                                      
                                      <div class="result_content">
                                          <div class="result_meta">
                                              @if($post->category)
                                                  <span class="result_category">{{ $post->category->name }}</span>
                                              @endif
                                              <span class="result_date">{{ $post->created_at->format('M d, Y') }}</span>
                                          </div>
                                          
                                          <h3 class="result_title">
                                              <a href="{{ route('home.post_details', $post->id) }}">{{ $post->title }}</a>
                                          </h3>
                                          
                                          <p class="result_excerpt">{{ Str::limit(strip_tags($post->description), 120) }}</p>
                                          
                                          <div class="result_footer">
                                              <div class="result_author">
                                                  By: {{ $post->name }}
                                                  @if($post->usertype === 'admin')
                                                      <span class="admin_badge">Admin</span>
                                                  @endif
                                              </div>
                                              
                                              @if($post->tags->count() > 0)
                                                  <div class="result_tags">
                                                      @foreach($post->tags->take(3) as $tag)
                                                          <span class="result_tag">{{ $tag->name }}</span>
                                                      @endforeach
                                                      @if($post->tags->count() > 3)
                                                          <span class="more_tags">+{{ $post->tags->count() - 3 }}</span>
                                                      @endif
                                                  </div>
                                              @endif
                                              
                                              @if($post->comments_count ?? 0 > 0)
                                                  <div class="result_comments">
                                                      <i class="fa fa-comments"></i> {{ $post->comments_count }}
                                                  </div>
                                              @endif
                                          </div>
                                      </div>
                                  </div>
                              @endforeach
                          </div>
                          
                          <!-- Pagination -->
                          <div class="search_pagination">
                              {{ $posts->links() }}
                          </div>
                      @else
                          <div class="no_results">
                              <div class="no_results_icon">🔍</div>
                              <h3>No posts found</h3>
                              <p>Try adjusting your search criteria or browse all posts.</p>
                              <div class="no_results_actions">
                                  <a href="{{ route('home.posts') }}" class="btn btn-primary">Browse All Posts</a>
                                  <a href="{{ route('home.search') }}" class="btn btn-secondary">Clear Search</a>
                              </div>
                          </div>
                      @endif
                  @else
                      <div class="search_placeholder">
                          <div class="placeholder_icon">🔎</div>
                          <h3>Ready to find something amazing?</h3>
                          <p>Use the search form above to find posts by keywords, categories, or tags.</p>
                          <div class="quick_links">
                              <h4>Quick Links:</h4>
                              <a href="{{ route('home.posts') }}" class="quick_link">All Posts</a>
                              @if(isset($categories) && is_object($categories) && method_exists($categories, 'take'))
                                  @foreach($categories->take(4) as $category)
                                      <a href="{{ route('home.search', ['category' => $category->id]) }}" class="quick_link">{{ $category->name }}</a>
                                  @endforeach
                              @endif
                          </div>
                      </div>
                  @endif
              </div>
          </div>
      </div>
      <!-- search section end -->
      
      <!-- footer section start -->
      @include('home.footer')
      <!-- footer section end -->
      
      <style>
          .search_section {
              background: #f8f9fa;
              min-height: calc(100vh - 200px);
          }
          
          .search_header {
              text-align: center;
              margin-bottom: 40px;
          }
          
          .search_title {
              font-size: 36px;
              color: #333;
              margin-bottom: 10px;
          }
          
          .search_subtitle {
              color: #666;
              font-size: 18px;
          }
          
          .search_form_container {
              background: white;
              padding: 40px;
              border-radius: 15px;
              box-shadow: 0 4px 20px rgba(0,0,0,0.1);
              margin-bottom: 40px;
          }
          
          .search_form_row {
              display: grid;
              grid-template-columns: 2fr 1fr 1fr;
              gap: 20px;
              margin-bottom: 30px;
          }
          
          .search_input_group {
              position: relative;
          }
          
          .search_input_wrapper {
              position: relative;
          }
          
          .search_label {
              display: block;
              font-weight: 700;
              margin-bottom: 10px;
              color: #495057;
              font-size: 14px;
              text-transform: uppercase;
              letter-spacing: 0.5px;
              position: relative;
          }
          
          .search_label::after {
              content: '';
              position: absolute;
              bottom: -2px;
              left: 0;
              width: 30px;
              height: 2px;
              background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
              border-radius: 1px;
          }
          
          .active_filter_indicator {
              color: #28a745;
              font-weight: bold;
              margin-left: 8px;
              animation: pulse 2s infinite;
              font-size: 12px;
          }
          
          @keyframes pulse {
              0% { opacity: 1; transform: scale(1); }
              50% { opacity: 0.7; transform: scale(1.1); }
              100% { opacity: 1; transform: scale(1); }
          }
          
          .filter_group {
              margin-bottom: 25px;
          }
          
          .search_input, .filter_select {
              width: 100%;
              padding: 12px 15px;
              border: 2px solid #ddd;
              border-radius: 8px;
              font-size: 16px;
              transition: all 0.3s ease;
              cursor: pointer;
              background-color: white;
          }
          
          .search_input:focus, .filter_select:focus {
              outline: none;
              border-color: #007bff;
              box-shadow: 0 0 0 3px rgba(0,123,255,0.1);
          }
          
          .filter_select:hover {
              border-color: #007bff;
              background-color: #f8f9fa;
          }
          
          /* Enhanced Selection Highlighting - Cross-browser approach */
          .filter_select option:checked,
          .filter_select option[selected] {
              background: #007bff !important;
              background-color: #007bff !important;
              color: white !important;
              font-weight: bold !important;
          }
          
          .filter_select option {
              padding: 8px 12px !important;
              background: white !important;
              background-color: white !important;
              color: #333 !important;
              font-size: 14px !important;
          }
          
          .filter_select option:hover {
              background: #e3f2fd !important;
              background-color: #e3f2fd !important;
              color: #007bff !important;
          }
          
          /* Firefox specific styling */
          @-moz-document url-prefix() {
              .filter_select option:checked,
              .filter_select option[selected] {
                  background: #007bff !important;
                  color: white !important;
                  font-weight: bold !important;
              }
          }
          
          /* WebKit specific styling */
          @media screen and (-webkit-min-device-pixel-ratio:0) {
              .filter_select option:checked {
                  background: linear-gradient(#007bff, #007bff) !important;
                  background-color: #007bff !important;
                  color: white !important;
              }
          }
          
          /* WebKit browsers specific styling for better option highlighting */
          select.filter_select {
              -webkit-appearance: none;
              -moz-appearance: none;
              appearance: none;
              background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6,9 12,15 18,9'%3e%3c/polyline%3e%3c/svg%3e");
              background-repeat: no-repeat;
              background-position: right 12px center;
              background-size: 16px;
              padding-right: 40px;
          }
          
          /* Firefox specific styling */
          @-moz-document url-prefix() {
              .filter_select option:checked {
                  background-color: #007bff !important;
                  color: white !important;
                  font-weight: bold !important;
              }
              
              .filter_select option {
                  background-color: white !important;
                  color: #333 !important;
              }
          }
          
          /* Dropdown Animation */
          @keyframes dropdownPulse {
              0% { transform: scale(1); }
              50% { transform: scale(1.05); box-shadow: 0 0 0 5px rgba(0,123,255,0.2); }
              100% { transform: scale(1); }
          }
          
          /* Enhanced dropdown interaction styles */
          .filter_select:focus {
              outline: none;
              border-color: #007bff !important;
              box-shadow: 0 0 0 3px rgba(0,123,255,0.1) !important;
              transition: all 0.3s ease;
          }
          
          /* Active Filter Visual Feedback */
          .filter_select[data-has-selection="true"] {
              border-color: #007bff;
              background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%);
              box-shadow: 0 0 0 2px rgba(0,123,255,0.15);
              font-weight: 600;
              color: #0056b3;
          }
          
          /* Better styling for filter groups */
          .filter_group {
              position: relative;
          }
          
          /* Simple but effective visual feedback for selected filters */
          .filter_select[data-has-selection="true"] {
              border-color: #007bff !important;
              background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%) !important;
              box-shadow: 0 0 0 2px rgba(0,123,255,0.15) !important;
              font-weight: 600 !important;
              color: #0056b3 !important;
          }
          
          .filter_select:disabled {
              opacity: 0.6;
              cursor: not-allowed;
              background-color: #e9ecef;
          }
          
          .search_suggestions {
              position: absolute;
              top: 100%;
              left: 0;
              right: 0;
              background: white;
              border: 1px solid #ddd;
              border-radius: 0 0 8px 8px;
              max-height: 300px;
              overflow-y: auto;
              z-index: 1000;
              display: none;
          }
          
          .suggestion_item {
              padding: 12px 15px;
              border-bottom: 1px solid #f0f0f0;
              cursor: pointer;
              transition: background-color 0.2s ease;
          }
          
          .suggestion_item:hover {
              background: #f8f9fa;
          }
          
          .suggestion_title {
              font-weight: 600;
              color: #333;
              margin-bottom: 4px;
          }
          
          .suggestion_meta {
              font-size: 12px;
              color: #666;
          }
          
          .tags_filter_section {
              margin-bottom: 30px;
          }
          
          .tags_container {
              display: flex;
              flex-wrap: wrap;
              gap: 12px;
              margin-top: 10px;
          }
          
          /* Custom Dropdown Styles */
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
          
          .selected_text {
              flex: 1;
              text-align: left;
              font-weight: 500;
          }
          
          .dropdown_arrow {
              font-size: 12px;
              color: #666;
              transition: transform 0.3s ease;
          }
          
          .custom_dropdown_trigger.active .dropdown_arrow {
              transform: rotate(180deg);
              color: #007bff;
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
              animation: dropdownSlideDown 0.2s ease-out;
          }
          
          .custom_dropdown_menu.show {
              display: block;
          }
          
          @keyframes dropdownSlideDown {
              from {
                  opacity: 0;
                  transform: translateY(-10px);
              }
              to {
                  opacity: 1;
                  transform: translateY(0);
              }
          }
          
          .dropdown_option {
              padding: 12px 16px;
              cursor: pointer;
              border-bottom: 1px solid #f0f0f0;
              transition: all 0.2s ease;
              font-size: 14px;
              color: #333;
              position: relative;
          }
          
          .dropdown_option:last-child {
              border-bottom: none;
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
          
          .custom_dropdown_trigger:focus {
              outline: 2px solid #007bff;
              outline-offset: 2px;
          }
          
          .dropdown_option:focus {
              outline: 2px solid #007bff;
              outline-offset: -2px;
              background: #e3f2fd;
              color: #007bff;
              font-weight: 600;
          }
          
          .dropdown_option.selected:hover {
              background: #0056b3;
              color: white;
          }
          
          /* Dark Mode Custom Dropdown Styles */
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
          
          body.dark-mode .dropdown_arrow {
              color: #b0b0b0;
          }
          
          body.dark-mode .custom_dropdown_trigger.active .dropdown_arrow {
              color: #667eea;
          }
          
          /* Responsive Custom Dropdown Styles */
          @media (max-width: 768px) {
              .custom_dropdown_trigger {
                  padding: 10px 12px;
                  min-height: 44px;
                  font-size: 13px;
              }
              
              .dropdown_option {
                  padding: 10px 12px;
                  font-size: 13px;
              }
              
              .custom_dropdown_menu {
                  max-height: 250px;
              }
              
              .search_form_row {
                  flex-direction: column;
                  gap: 15px;
              }
              
              .filter_group {
                  width: 100%;
              }
          }

          .tag_checkbox {
              display: flex;
              align-items: center;
              background: #f8f9fa;
              padding: 8px 12px;
              border-radius: 20px;
              border: 2px solid transparent;
              cursor: pointer;
              transition: all 0.3s ease;
              position: relative;
          }
          
          .tag_checkbox:hover {
              background: #e9ecef;
              border-color: #007bff;
              transform: translateY(-1px);
              box-shadow: 0 2px 8px rgba(0,123,255,0.15);
          }
          
          .tag_checkbox:has(input:checked) {
              background: #007bff;
              color: white;
              border-color: #0056b3;
              transform: translateY(-2px);
              box-shadow: 0 4px 15px rgba(0,123,255,0.3);
          }
          
          .tag_checkbox input[type="checkbox"] {
              margin-right: 8px;
              width: auto;
              accent-color: #007bff;
          }
          
          .tag_checkbox:has(input:checked) input[type="checkbox"] {
              accent-color: white;
          }
          
          .tag_label {
              margin: 0;
              cursor: pointer;
              font-size: 14px;
              font-weight: 500;
          }
          
          .tag_checkbox:has(input:checked) .tag_label {
              font-weight: 600;
          }
          
          .search_actions {
              display: flex;
              gap: 15px;
              justify-content: center;
          }
          
          .search_btn, .clear_btn {
              padding: 14px 32px;
              border-radius: 10px;
              font-weight: 700;
              text-decoration: none;
              display: inline-flex;
              align-items: center;
              gap: 10px;
              transition: all 0.3s ease;
              text-transform: uppercase;
              letter-spacing: 0.5px;
              font-size: 14px;
              box-shadow: 0 4px 12px rgba(0,0,0,0.15);
          }
          
          .search_btn {
              background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
              color: white;
              border: none;
          }
          
          .search_btn:hover {
              background: linear-gradient(135deg, #0056b3 0%, #004085 100%);
              transform: translateY(-3px);
              box-shadow: 0 8px 20px rgba(0,123,255,0.3);
          }
          
          .clear_btn {
              background: linear-gradient(135deg, #6c757d 0%, #495057 100%);
              color: white;
          }
          
          .clear_btn:hover {
              background: linear-gradient(135deg, #545b62 0%, #343a40 100%);
              color: white;
              text-decoration: none;
              transform: translateY(-3px);
              box-shadow: 0 8px 20px rgba(108,117,125,0.3);
          }
          
          .search_results_section {
              margin-top: 40px;
          }
          
          .results_header {
              margin-bottom: 30px;
          }
          
          .results_title {
              font-size: 28px;
              color: #333;
              margin-bottom: 15px;
          }
          
          .results_count {
              color: #666;
              font-weight: normal;
              font-size: 18px;
          }
          
          .applied_filters {
              display: flex;
              flex-wrap: wrap;
              align-items: center;
              gap: 12px;
              margin-top: 20px;
              padding: 15px;
              background: #f8f9fa;
              border-radius: 10px;
              border: 1px solid #e9ecef;
          }
          
          .filters_label {
              font-weight: 700;
              color: #495057;
              font-size: 14px;
              margin-right: 5px;
          }
          
          .filter_tag {
              background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
              color: white;
              padding: 6px 12px;
              border-radius: 20px;
              font-size: 12px;
              font-weight: 600;
              display: inline-flex;
              align-items: center;
              gap: 8px;
              box-shadow: 0 2px 4px rgba(0,123,255,0.2);
              transition: all 0.3s ease;
              box-shadow: 0 2px 4px rgba(0,123,255,0.2);
              transition: all 0.3s ease;
          }
          
          .filter_tag:hover {
              transform: translateY(-1px);
              box-shadow: 0 4px 8px rgba(0,123,255,0.3);
          }
          
          .remove_filter {
              color: rgba(255,255,255,0.8);
              text-decoration: none;
              font-weight: bold;
              font-size: 16px;
              display: flex;
              align-items: center;
              justify-content: center;
              width: 18px;
              height: 18px;
              border-radius: 50%;
              background: rgba(255,255,255,0.2);
              transition: all 0.2s ease;
          }
          
          .remove_filter:hover {
              background: rgba(255,255,255,0.3);
              color: white;
              transform: scale(1.1);
          }
          
          .search_results_grid {
              display: grid;
              grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
              gap: 30px;
              margin-bottom: 40px;
          }
          
          .search_result_card {
              background: white;
              border-radius: 12px;
              overflow: hidden;
              box-shadow: 0 4px 15px rgba(0,0,0,0.1);
              transition: transform 0.3s ease, box-shadow 0.3s ease;
          }
          
          .search_result_card:hover {
              transform: translateY(-5px);
              box-shadow: 0 8px 25px rgba(0,0,0,0.15);
          }
          
          .result_image {
              position: relative;
              height: 200px;
              overflow: hidden;
          }
          
          .result_image img {
              width: 100%;
              height: 100%;
              object-fit: cover;
              transition: transform 0.3s ease;
          }
          
          .result_overlay {
              position: absolute;
              top: 0;
              left: 0;
              right: 0;
              bottom: 0;
              background: rgba(0,0,0,0.7);
              display: flex;
              align-items: center;
              justify-content: center;
              opacity: 0;
              transition: opacity 0.3s ease;
          }
          
          .search_result_card:hover .result_overlay {
              opacity: 1;
          }
          
          .view_post_btn {
              background: #007bff;
              color: white;
              padding: 10px 20px;
              border-radius: 5px;
              text-decoration: none;
              font-weight: 600;
          }
          
          .result_content {
              padding: 20px;
          }
          
          .result_meta {
              display: flex;
              justify-content: space-between;
              margin-bottom: 12px;
          }
          
          .result_category {
              background: #007bff;
              color: white;
              padding: 2px 8px;
              border-radius: 10px;
              font-size: 12px;
          }
          
          .result_date {
              color: #666;
              font-size: 12px;
          }
          
          .result_title {
              margin-bottom: 15px;
          }
          
          .result_title a {
              color: #333;
              text-decoration: none;
              font-size: 18px;
              font-weight: 600;
              line-height: 1.4;
          }
          
          .result_title a:hover {
              color: #007bff;
          }
          
          .result_excerpt {
              color: #666;
              line-height: 1.6;
              margin-bottom: 15px;
          }
          
          .result_footer {
              display: flex;
              flex-direction: column;
              gap: 10px;
          }
          
          .result_author {
              font-size: 14px;
              color: #666;
              display: flex;
              align-items: center;
              gap: 8px;
          }
          
          .admin_badge {
              background: #dc3545;
              color: white;
              padding: 2px 6px;
              border-radius: 8px;
              font-size: 10px;
              text-transform: uppercase;
          }
          
          .result_tags {
              display: flex;
              flex-wrap: wrap;
              gap: 5px;
          }
          
          .result_tag {
              background: #f8f9fa;
              padding: 2px 6px;
              border-radius: 8px;
              font-size: 11px;
              color: #666;
          }
          
          .more_tags {
              color: #007bff;
              font-size: 11px;
              font-weight: 600;
          }
          
          .result_comments {
              color: #666;
              font-size: 12px;
              display: flex;
              align-items: center;
              gap: 5px;
          }
          
          .no_results, .search_placeholder {
              text-align: center;
              padding: 60px 20px;
              background: white;
              border-radius: 12px;
              box-shadow: 0 4px 15px rgba(0,0,0,0.1);
          }
          
          .no_results_icon, .placeholder_icon {
              font-size: 80px;
              margin-bottom: 20px;
          }
          
          .no_results h3, .search_placeholder h3 {
              margin-bottom: 15px;
              color: #333;
          }
          
          .no_results p, .search_placeholder p {
              color: #666;
              margin-bottom: 30px;
          }
          
          .no_results_actions {
              display: flex;
              gap: 15px;
              justify-content: center;
          }
          
          .quick_links {
              margin-top: 30px;
          }
          
          .quick_links h4 {
              margin-bottom: 15px;
              color: #333;
          }
          
          .quick_link {
              display: inline-block;
              background: #007bff;
              color: white;
              padding: 8px 15px;
              margin: 5px;
              border-radius: 20px;
              text-decoration: none;
              font-size: 14px;
              transition: background 0.3s ease;
          }
          
          .quick_link:hover {
              background: #0056b3;
              color: white;
              text-decoration: none;
          }
          
          .search_pagination {
              display: flex;
              justify-content: center;
              margin-top: 40px;
          }
          
          @media (max-width: 768px) {
              .search_form_row {
                  grid-template-columns: 1fr;
                  gap: 15px;
              }
              
              .search_results_grid {
                  grid-template-columns: 1fr;
                  gap: 20px;
              }
              
              .search_actions {
                  flex-direction: column;
                  align-items: center;
              }
              
              .applied_filters {
                  flex-direction: column;
                  align-items: flex-start;
              }
          }
          
          /* Admin Controls Styles */
          .admin_add_btn, .admin_manage_btn {
              background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
              color: white;
              border: none;
              padding: 6px 10px;
              border-radius: 6px;
              margin-left: 10px;
              cursor: pointer;
              font-size: 11px;
              font-weight: 600;
              transition: all 0.3s ease;
              display: inline-flex;
              align-items: center;
              gap: 4px;
              box-shadow: 0 2px 4px rgba(40, 167, 69, 0.2);
          }
          
          .admin_add_btn:hover, .admin_manage_btn:hover {
              background: linear-gradient(135deg, #218838 0%, #17a2b8 100%);
              transform: translateY(-1px);
              box-shadow: 0 4px 8px rgba(40, 167, 69, 0.3);
          }
          
          .admin_manage_btn {
              background: linear-gradient(135deg, #6c757d 0%, #495057 100%);
              margin-left: 5px;
              box-shadow: 0 2px 4px rgba(108, 117, 125, 0.2);
          }
          
          .admin_manage_btn:hover {
              background: linear-gradient(135deg, #545b62 0%, #343a40 100%);
              box-shadow: 0 4px 8px rgba(108, 117, 125, 0.3);
          }
          
          .admin_category_list {
              background: #f8f9fa;
              border: 1px solid #ddd;
              border-radius: 8px;
              padding: 12px;
              max-height: 200px;
              overflow-y: auto;
              margin-top: 10px;
              box-shadow: 0 2px 8px rgba(0,0,0,0.1);
          }
          
          .admin_item {
              display: flex;
              justify-content: space-between;
              align-items: center;
              padding: 5px 10px;
              margin-bottom: 5px;
              background: white;
              border-radius: 3px;
              border: 1px solid #e9ecef;
          }
          
          .admin_delete_btn, .admin_tag_delete {
              background: #dc3545;
              color: white;
              border: none;
              padding: 2px 6px;
              border-radius: 3px;
              cursor: pointer;
              font-size: 10px;
              margin-left: 8px;
          }
          
          .admin_delete_btn:hover, .admin_tag_delete:hover {
              background: #c82333;
          }
          
          .admin_tag_delete {
              background: #dc3545;
              color: white;
              border: none;
              padding: 2px 4px;
              border-radius: 50%;
              cursor: pointer;
              font-size: 8px;
              margin-left: 8px;
              width: 16px;
              height: 16px;
              display: flex;
              align-items: center;
              justify-content: center;
          }
          
          /* Modal Styles */
          .admin_modal {
              display: none;
              position: fixed;
              z-index: 9999;
              left: 0;
              top: 0;
              width: 100%;
              height: 100%;
              background-color: rgba(0,0,0,0.5);
          }
          
          .admin_modal_content {
              background-color: white;
              margin: 15% auto;
              padding: 30px;
              border-radius: 10px;
              width: 400px;
              max-width: 90%;
              box-shadow: 0 4px 20px rgba(0,0,0,0.3);
          }
          
          .admin_modal_header {
              display: flex;
              justify-content: space-between;
              align-items: center;
              margin-bottom: 20px;
              padding-bottom: 10px;
              border-bottom: 1px solid #eee;
          }
          
          .admin_modal_title {
              font-size: 18px;
              font-weight: 600;
              color: #333;
          }
          
          .admin_modal_close {
              background: none;
              border: none;
              font-size: 24px;
              cursor: pointer;
              color: #999;
          }
          
          .admin_modal_close:hover {
              color: #333;
          }
          
          .admin_form_group {
              margin-bottom: 20px;
          }
          
          .admin_form_label {
              display: block;
              margin-bottom: 8px;
              font-weight: 600;
              color: #333;
          }
          
          .admin_form_input {
              width: 100%;
              padding: 10px 12px;
              border: 2px solid #ddd;
              border-radius: 5px;
              font-size: 14px;
              transition: border-color 0.3s ease;
          }
          
          .admin_form_input:focus {
              outline: none;
              border-color: #007bff;
          }
          
          .admin_form_actions {
              display: flex;
              gap: 10px;
              justify-content: flex-end;
          }
          
          .admin_btn_primary, .admin_btn_secondary {
              padding: 10px 20px;
              border: none;
              border-radius: 5px;
              cursor: pointer;
              font-weight: 600;
              transition: all 0.3s ease;
          }
          
          .admin_btn_primary {
              background: #007bff;
              color: white;
          }
          
          .admin_btn_primary:hover {
              background: #0056b3;
          }
          
          .admin_btn_secondary {
              background: #6c757d;
              color: white;
          }
          
          .admin_btn_secondary:hover {
              background: #545b62;
          }
          
          .manage_mode .admin_tag_delete {
              display: flex !important;
          }
          
          .manage_mode .tag_checkbox {
              position: relative;
              padding-right: 25px;
          }
      </style>
      
      <!-- Admin Modals -->
      @if(Auth::check() && Auth::user()->usertype == 'admin')
          <!-- Add Category Modal -->
          <div id="addCategoryModal" class="admin_modal">
              <div class="admin_modal_content">
                  <div class="admin_modal_header">
                      <h3 class="admin_modal_title">Add New Category</h3>
                      <button class="admin_modal_close" onclick="closeModal('addCategoryModal')">&times;</button>
                  </div>
                  <form id="addCategoryForm">
                      @csrf
                      <div class="admin_form_group">
                          <label class="admin_form_label">Category Name</label>
                          <input type="text" name="name" class="admin_form_input" placeholder="Enter category name" required>
                      </div>
                      <div class="admin_form_actions">
                          <button type="button" class="admin_btn_secondary" onclick="closeModal('addCategoryModal')">Cancel</button>
                          <button type="submit" class="admin_btn_primary">Add Category</button>
                      </div>
                  </form>
              </div>
          </div>
          
          <!-- Add Tag Modal -->
          <div id="addTagModal" class="admin_modal">
              <div class="admin_modal_content">
                  <div class="admin_modal_header">
                      <h3 class="admin_modal_title">Add New Tag</h3>
                      <button class="admin_modal_close" onclick="closeModal('addTagModal')">&times;</button>
                  </div>
                  <form id="addTagForm">
                      @csrf
                      <div class="admin_form_group">
                          <label class="admin_form_label">Tag Name</label>
                          <input type="text" name="name" class="admin_form_input" placeholder="Enter tag name" required>
                      </div>
                      <div class="admin_form_actions">
                          <button type="button" class="admin_btn_secondary" onclick="closeModal('addTagModal')">Cancel</button>
                          <button type="submit" class="admin_btn_primary">Add Tag</button>
                      </div>
                  </form>
              </div>
          </div>
      @endif
      
      <script>
          // Live search suggestions
          let searchTimeout;
          const searchInput = document.getElementById('search_input');
          const suggestionsContainer = document.getElementById('search_suggestions');
          
          searchInput.addEventListener('input', function() {
              clearTimeout(searchTimeout);
              const query = this.value.trim();
              
              if (query.length < 2) {
                  hideSuggestions();
                  return;
              }
              
              searchTimeout = setTimeout(() => {
                  fetchSuggestions(query);
              }, 300);
          });
          
          searchInput.addEventListener('focus', function() {
              if (this.value.trim().length >= 2) {
                  fetchSuggestions(this.value.trim());
              }
          });
          
          // Hide suggestions when clicking outside
          document.addEventListener('click', function(e) {
              if (!e.target.closest('.search_input_wrapper')) {
                  hideSuggestions();
              }
          });
          
          function fetchSuggestions(query) {
              fetch(`{{ route('search.suggestions') }}?q=${encodeURIComponent(query)}`)
                  .then(response => response.json())
                  .then(data => {
                      displaySuggestions(data);
                  })
                  .catch(error => {
                      console.error('Error fetching suggestions:', error);
                  });
          }
          
          function displaySuggestions(suggestions) {
              if (suggestions.length === 0) {
                  hideSuggestions();
                  return;
              }
              
              const html = suggestions.map(suggestion => `
                  <div class="suggestion_item" onclick="selectSuggestion('${suggestion.url}')">
                      <div class="suggestion_title">${suggestion.title}</div>
                      <div class="suggestion_meta">
                          ${suggestion.category ? suggestion.category + ' • ' : ''}${suggestion.date}
                      </div>
                  </div>
              `).join('');
              
              suggestionsContainer.innerHTML = html;
              suggestionsContainer.style.display = 'block';
          }
          
          function hideSuggestions() {
              suggestionsContainer.style.display = 'none';
          }
          
          function selectSuggestion(url) {
              window.location.href = url;
          }
          
          // Auto-submit form when filters change
          document.querySelectorAll('.filter_select').forEach(select => {
              // Add initial visual feedback for selected filters
              updateFilterVisualFeedback(select);
              
              select.addEventListener('change', function() {
                  // Update visual feedback immediately
                  updateFilterVisualFeedback(this);
                  // Show loading state
                  showLoadingState();
                  // Auto-submit the form when any filter changes
                  this.form.submit();
              });
          });
          
          // Auto-submit when tag checkboxes change
          document.querySelectorAll('input[name="tags[]"]').forEach(checkbox => {
              checkbox.addEventListener('change', function() {
                  // Show loading state
                  showLoadingState();
                  // Small delay to allow multiple tag selections
                  setTimeout(() => {
                      this.form.submit();
                  }, 300);
              });
          });
          
          // Function to update visual feedback for filter selections
          function updateFilterVisualFeedback(selectElement) {
              if (selectElement.value && selectElement.value !== '') {
                  // Apply active selection styling to the select element
                  selectElement.setAttribute('data-has-selection', 'true');
                  selectElement.style.fontWeight = '600';
                  selectElement.style.borderColor = '#007bff';
                  selectElement.style.backgroundColor = '#e3f2fd';
                  selectElement.style.color = '#0056b3';
                  selectElement.style.boxShadow = '0 0 0 2px rgba(0,123,255,0.15)';
                  
                  // Update the select element's displayed text to show selection
                  const selectedOption = selectElement.options[selectElement.selectedIndex];
                  if (selectedOption) {
                      selectElement.style.background = 'linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%)';
                      
                      // Add visual indicator to the label
                      const label = selectElement.closest('.filter_group').querySelector('.search_label');
                      if (label && !label.querySelector('.selection_indicator')) {
                          const indicator = document.createElement('span');
                          indicator.className = 'selection_indicator';
                          indicator.innerHTML = ' ✓';
                          indicator.style.cssText = 'color: #28a745; font-weight: bold; margin-left: 5px;';
                          label.appendChild(indicator);
                      }
                  }
              } else {
                  // Remove active selection styling
                  selectElement.removeAttribute('data-has-selection');
                  selectElement.style.fontWeight = 'normal';
                  selectElement.style.borderColor = '#ddd';
                  selectElement.style.backgroundColor = 'white';
                  selectElement.style.color = '#333';
                  selectElement.style.boxShadow = 'none';
                  selectElement.style.background = 'white';
                  
                  // Remove visual indicator from label
                  const label = selectElement.closest('.filter_group').querySelector('.search_label');
                  if (label) {
                      const indicator = label.querySelector('.selection_indicator');
                      if (indicator) {
                          indicator.remove();
                      }
                  }
              }
              
              // Update for dark mode
              if (document.body.classList.contains('dark-mode')) {
                  if (selectElement.value && selectElement.value !== '') {
                      selectElement.style.backgroundColor = '#2d2d2d';
                      selectElement.style.color = '#667eea';
                      selectElement.style.borderColor = '#667eea';
                      selectElement.style.background = 'linear-gradient(135deg, #2d2d2d 0%, #3d3d3d 100%)';
                  } else {
                      selectElement.style.backgroundColor = '#1a1a1a';
                      selectElement.style.color = '#e1e1e1';
                      selectElement.style.borderColor = '#444';
                      selectElement.style.background = '#1a1a1a';
                  }
              }
          }
          
          // Custom Dropdown Functions
          function toggleCustomDropdown(type) {
              const container = document.getElementById(type + '_dropdown_container');
              const trigger = container.querySelector('.custom_dropdown_trigger');
              const menu = container.querySelector('.custom_dropdown_menu');
              
              // Close other dropdowns first
              document.querySelectorAll('.custom_dropdown_menu').forEach(otherMenu => {
                  if (otherMenu !== menu) {
                      otherMenu.classList.remove('show');
                      const otherTrigger = otherMenu.closest('.custom_dropdown_container').querySelector('.custom_dropdown_trigger');
                      otherTrigger.classList.remove('active');
                      otherTrigger.setAttribute('aria-expanded', 'false');
                  }
              });
              
              // Toggle current dropdown
              const isOpen = menu.classList.contains('show');
              if (isOpen) {
                  menu.classList.remove('show');
                  trigger.classList.remove('active');
                  trigger.setAttribute('aria-expanded', 'false');
              } else {
                  menu.classList.add('show');
                  trigger.classList.add('active');
                  trigger.setAttribute('aria-expanded', 'true');
                  
                  // Focus first option for keyboard navigation
                  const selectedOption = menu.querySelector('.dropdown_option.selected') || menu.querySelector('.dropdown_option');
                  if (selectedOption) {
                      selectedOption.focus();
                  }
              }
          }
          
          function selectCustomOption(type, value, text) {
              const selectedTextElement = document.getElementById(type + '_selected_text');
              const hiddenSelect = document.getElementById(type + '_filter');
              const menu = document.getElementById(type + '_dropdown_menu');
              const trigger = document.querySelector(`#${type}_dropdown_container .custom_dropdown_trigger`);
              
              // Update the display text
              selectedTextElement.textContent = text;
              
              // Update the hidden select value
              hiddenSelect.value = value;
              
              // Update option states
              menu.querySelectorAll('.dropdown_option').forEach(option => {
                  option.classList.remove('selected');
              });
              
              // Mark the selected option - find by matching the onclick attribute or data
              const clickedOption = menu.querySelector(`[onclick*="${value}"]`);
              if (clickedOption) {
                  clickedOption.classList.add('selected');
              }
              
              // Close the dropdown
              menu.classList.remove('show');
              trigger.classList.remove('active');
              
              // Update visual feedback for the form
              updateCustomDropdownVisualFeedback(type, value);
              
              // Trigger change event on hidden select
              const changeEvent = new Event('change', { bubbles: true });
              hiddenSelect.dispatchEvent(changeEvent);
              
              // Update visual feedback
              updateFilterVisualFeedback(hiddenSelect);
          }
          
          function updateCustomDropdownVisualFeedback(type, value) {
              const trigger = document.querySelector(`#${type}_dropdown_container .custom_dropdown_trigger`);
              const label = document.querySelector(`#${type}_dropdown_container`).closest('.filter_group').querySelector('.search_label');
              
              if (value && value !== '' && value !== 'latest') {
                  // Add active styling
                  trigger.style.borderColor = '#007bff';
                  trigger.style.background = 'linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%)';
                  trigger.style.fontWeight = '600';
                  trigger.style.color = '#0056b3';
                  
                  // Add checkmark to label if not already present
                  if (label && !label.querySelector('.active_filter_indicator')) {
                      const indicator = document.createElement('span');
                      indicator.className = 'active_filter_indicator';
                      indicator.innerHTML = '✓';
                      indicator.style.cssText = 'color: #28a745; font-weight: bold; margin-left: 5px;';
                      label.appendChild(indicator);
                  }
              } else {
                  // Remove active styling
                  trigger.style.borderColor = '#ddd';
                  trigger.style.background = 'white';
                  trigger.style.fontWeight = '500';
                  trigger.style.color = '#333';
                  
                  // Remove checkmark from label
                  if (label) {
                      const indicator = label.querySelector('.active_filter_indicator');
                      if (indicator) {
                          indicator.remove();
                      }
                  }
              }
              
              // Dark mode adjustments
              if (document.body.classList.contains('dark-mode')) {
                  if (value && value !== '' && value !== 'latest') {
                      trigger.style.background = 'linear-gradient(135deg, #2d2d2d 0%, #3d3d3d 100%)';
                      trigger.style.borderColor = '#667eea';
                      trigger.style.color = '#667eea';
                  } else {
                      trigger.style.background = '#1a1a1a';
                      trigger.style.borderColor = '#444';
                      trigger.style.color = '#e1e1e1';
                  }
              }
          }
          
          // Close dropdowns when clicking outside
          document.addEventListener('click', function(event) {
              if (!event.target.closest('.custom_dropdown_container')) {
                  document.querySelectorAll('.custom_dropdown_menu').forEach(menu => {
                      menu.classList.remove('show');
                      menu.closest('.custom_dropdown_container').querySelector('.custom_dropdown_trigger').classList.remove('active');
                  });
              }
          });
          
          // Initialize custom dropdowns on page load
          document.addEventListener('DOMContentLoaded', function() {
              // Set initial visual feedback for existing selections
              const categorySelect = document.getElementById('category_filter');
              const sortSelect = document.getElementById('sort_filter');
              
              if (categorySelect && categorySelect.value) {
                  updateCustomDropdownVisualFeedback('category', categorySelect.value);
              }
              
              if (sortSelect && sortSelect.value && sortSelect.value !== 'latest') {
                  updateCustomDropdownVisualFeedback('sort', sortSelect.value);
              }
              
              // Add form submission handler to ensure hidden selects are included
              const form = document.querySelector('.advanced_search_form');
              if (form) {
                  form.addEventListener('submit', function(e) {
                      // Ensure all custom dropdown values are synced
                      const customDropdowns = document.querySelectorAll('.custom_dropdown_container');
                      customDropdowns.forEach(container => {
                          const type = container.id.replace('_dropdown_container', '');
                          const trigger = container.querySelector('.custom_dropdown_trigger');
                          const hiddenSelect = document.getElementById(type + '_filter');
                          
                          // Ensure the form includes the current values
                          if (hiddenSelect) {
                              console.log(`${type} filter value:`, hiddenSelect.value);
                          }
                      });
                  });
              }
              
              // Initialize enhancement functions
              enhanceDropdownOptions();
              
              // Add keyboard support for dropdowns
              document.addEventListener('keydown', function(e) {
                  if (e.key === 'Escape') {
                      document.querySelectorAll('.custom_dropdown_menu.show').forEach(menu => {
                          menu.classList.remove('show');
                          menu.closest('.custom_dropdown_container').querySelector('.custom_dropdown_trigger').classList.remove('active');
                      });
                  }
              });
          });

          // Function to create custom option highlighting
          function enhanceDropdownOptions() {
              document.querySelectorAll('.filter_select').forEach(select => {
                  // Create a custom approach for better option visibility
                  select.addEventListener('focus', function() {
                      // Style the select when focused
                      this.style.outline = 'none';
                      this.style.borderColor = '#007bff';
                      this.style.boxShadow = '0 0 0 3px rgba(0,123,255,0.1)';
                  });
                  
                  select.addEventListener('blur', function() {
                      // Reset focus styles but keep selection styles
                      if (!this.getAttribute('data-has-selection')) {
                          this.style.borderColor = '#ddd';
                          this.style.boxShadow = 'none';
                      }
                  });
                  
                  select.addEventListener('change', function() {
                      // Force a visual update of the options
                      const selectedValue = this.value;
                      Array.from(this.options).forEach((option, index) => {
                          if (option.value === selectedValue) {
                              option.style.backgroundColor = '#007bff';
                              option.style.color = 'white';
                              option.style.fontWeight = 'bold';
                          } else {
                              option.style.backgroundColor = 'white';
                              option.style.color = '#333';
                              option.style.fontWeight = 'normal';
                          }
                      });
                  });
                  
                  // Initial highlighting
                  const selectedValue = select.value;
                  if (selectedValue) {
                      Array.from(select.options).forEach(option => {
                          if (option.value === selectedValue) {
                              option.style.backgroundColor = '#007bff';
                              option.style.color = 'white';
                              option.style.fontWeight = 'bold';
                          }
                      });
                  }
              });
          }
          
          // Initialize visual feedback on page load
          document.addEventListener('DOMContentLoaded', function() {
              document.querySelectorAll('.filter_select').forEach(select => {
                  updateFilterVisualFeedback(select);
              });
              
              // Add smooth scroll to results when searching
              const form = document.querySelector('.advanced_search_form');
              if (form) {
                  form.addEventListener('submit', function(e) {
                      setTimeout(() => {
                          const resultsSection = document.querySelector('.search_results_section');
                          if (resultsSection) {
                              resultsSection.scrollIntoView({ 
                                  behavior: 'smooth', 
                                  block: 'start' 
                              });
                          }
                      }, 100);
                  });
              }
              
              // Add hover effects to filter tags
              document.querySelectorAll('.filter_tag').forEach(tag => {
                  tag.addEventListener('mouseenter', function() {
                      this.style.transform = 'translateY(-2px) scale(1.05)';
                  });
                  
                  tag.addEventListener('mouseleave', function() {
                      this.style.transform = 'translateY(0) scale(1)';
                  });
              });
              
              // Enhanced dropdown interaction
              document.querySelectorAll('.filter_select').forEach(select => {
                  // Add focus event to highlight dropdown
                  select.addEventListener('focus', function() {
                      this.style.borderColor = '#007bff';
                      this.style.boxShadow = '0 0 0 3px rgba(0,123,255,0.1)';
                      this.style.transform = 'scale(1.02)';
                  });
                  
                  select.addEventListener('blur', function() {
                      if (!this.getAttribute('data-has-selection')) {
                          this.style.borderColor = '#ddd';
                          this.style.boxShadow = 'none';
                      }
                      this.style.transform = 'scale(1)';
                  });
                  
                  // Add click event to show visual feedback
                  select.addEventListener('click', function() {
                      this.style.animation = 'dropdownPulse 0.3s ease';
                  });
                  
                  // Remove animation after it completes
                  select.addEventListener('animationend', function() {
                      this.style.animation = '';
                  });
              });
              
              // Add pulse animation to active filters
              const activeFilters = document.querySelectorAll('.filter_select[data-has-selection="true"]');
              activeFilters.forEach(filter => {
                  filter.style.animation = 'pulse 2s infinite';
              });
          });
          
          // Add CSS animation for pulse effect
          const style = document.createElement('style');
          style.textContent = `
              @keyframes pulse {
                  0% { box-shadow: 0 0 0 0 rgba(0, 123, 255, 0.4); }
                  50% { box-shadow: 0 0 0 10px rgba(0, 123, 255, 0.1); }
                  100% { box-shadow: 0 0 0 0 rgba(0, 123, 255, 0); }
              }
              
              .filter-loading {
                  position: relative;
                  overflow: hidden;
              }
              
              .filter-loading::after {
                  content: '';
                  position: absolute;
                  top: 0;
                  left: -100%;
                  width: 100%;
                  height: 100%;
                  background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
                  animation: shimmer 1.5s infinite;
              }
              
              @keyframes shimmer {
                  0% { left: -100%; }
                  100% { left: 100%; }
              }
          `;
          document.head.appendChild(style);
          
          // Show loading state function
          function showLoadingState() {
              // Add loading class to form elements
              document.querySelectorAll('.filter_select, input[name="tags[]"]').forEach(element => {
                  element.disabled = true;
                  element.classList.add('filter-loading');
              });
              
              // Show loading overlay on results area
              const resultsSection = document.querySelector('.search_results_section');
              if (resultsSection) {
                  resultsSection.style.opacity = '0.6';
                  resultsSection.style.pointerEvents = 'none';
                  resultsSection.style.filter = 'blur(2px)';
                  
                  // Add loading spinner overlay
                  const loadingOverlay = document.createElement('div');
                  loadingOverlay.className = 'loading-overlay';
                  loadingOverlay.innerHTML = `
                      <div class="loading-spinner">
                          <i class="fa fa-spinner fa-spin fa-2x"></i>
                          <p>Updating search results...</p>
                      </div>
                  `;
                  loadingOverlay.style.cssText = `
                      position: absolute;
                      top: 0;
                      left: 0;
                      right: 0;
                      bottom: 0;
                      background: rgba(255,255,255,0.8);
                      display: flex;
                      align-items: center;
                      justify-content: center;
                      z-index: 1000;
                      border-radius: 10px;
                  `;
                  
                  resultsSection.style.position = 'relative';
                  resultsSection.appendChild(loadingOverlay);
              }
              
              // Animate search button if it exists
              const searchBtn = document.querySelector('.search_btn');
              if (searchBtn) {
                  searchBtn.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Searching...';
                  searchBtn.disabled = true;
                  searchBtn.style.background = 'linear-gradient(135deg, #6c757d 0%, #495057 100%)';
              }
          }
          
          // Highlight search terms in results
          const searchTerm = '{{ $searchTerm }}';
          if (searchTerm) {
              highlightSearchTerms(searchTerm);
          }
          
          function highlightSearchTerms(term) {
              const regex = new RegExp(`(${term})`, 'gi');
              document.querySelectorAll('.result_title a, .result_excerpt').forEach(element => {
                  if (element.textContent.toLowerCase().includes(term.toLowerCase())) {
                      element.innerHTML = element.innerHTML.replace(regex, '<mark>$1</mark>');
                  }
              });
          }
          
          @if(Auth::check() && Auth::user()->usertype == 'admin')
          // Admin Functions
          function showAddCategoryModal() {
              document.getElementById('addCategoryModal').style.display = 'block';
          }
          
          function showAddTagModal() {
              document.getElementById('addTagModal').style.display = 'block';
          }
          
          function closeModal(modalId) {
              document.getElementById(modalId).style.display = 'none';
          }
          
          // Close modal when clicking outside
          window.onclick = function(event) {
              const modals = ['addCategoryModal', 'addTagModal'];
              modals.forEach(modalId => {
                  const modal = document.getElementById(modalId);
                  if (event.target == modal) {
                      modal.style.display = 'none';
                  }
              });
          }
          
          // Category management
          let categoryManageMode = false;
          function toggleCategoryManage() {
              const categoryList = document.querySelector('.admin_category_list');
              categoryManageMode = !categoryManageMode;
              
              if (categoryManageMode) {
                  categoryList.style.display = 'block';
              } else {
                  categoryList.style.display = 'none';
              }
          }
          
          // Tag management
          let tagManageMode = false;
          function toggleTagManage() {
              const tagsContainer = document.querySelector('.tags_container');
              tagManageMode = !tagManageMode;
              
              if (tagManageMode) {
                  tagsContainer.classList.add('manage_mode');
              } else {
                  tagsContainer.classList.remove('manage_mode');
              }
          }
          
          // Add Category Form Handler
          document.getElementById('addCategoryForm').addEventListener('submit', function(e) {
              e.preventDefault();
              const formData = new FormData(this);
              
              fetch('{{ route("admin.add_category") }}', {
                  method: 'POST',
                  headers: {
                      'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                      'Content-Type': 'application/json',
                  },
                  body: JSON.stringify({
                      name: formData.get('name')
                  })
              })
              .then(response => response.json())
              .then(data => {
                  if (data.success) {
                      // Add new option to select
                      const select = document.getElementById('category_filter');
                      const option = document.createElement('option');
                      option.value = data.category.id;
                      option.textContent = data.category.name;
                      select.appendChild(option);
                      
                      // Add to admin list
                      const adminList = document.querySelector('.admin_category_list');
                      const adminItem = document.createElement('div');
                      adminItem.className = 'admin_item';
                      adminItem.innerHTML = `
                          <span>${data.category.name}</span>
                          <button type="button" class="admin_delete_btn" onclick="deleteCategory(${data.category.id})">
                              <i class="fa fa-trash"></i>
                          </button>
                      `;
                      adminList.appendChild(adminItem);
                      
                      closeModal('addCategoryModal');
                      this.reset();
                      
                      // Show success message
                      showNotification('Category added successfully!', 'success');
                  } else {
                      showNotification('Error adding category: ' + data.message, 'error');
                  }
              })
              .catch(error => {
                  console.error('Error:', error);
                  showNotification('Error adding category', 'error');
              });
          });
          
          // Add Tag Form Handler
          document.getElementById('addTagForm').addEventListener('submit', function(e) {
              e.preventDefault();
              const formData = new FormData(this);
              
              fetch('{{ route("admin.add_tag") }}', {
                  method: 'POST',
                  headers: {
                      'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                      'Content-Type': 'application/json',
                  },
                  body: JSON.stringify({
                      name: formData.get('name')
                  })
              })
              .then(response => response.json())
              .then(data => {
                  if (data.success) {
                      // Add new tag to container
                      const tagsContainer = document.querySelector('.tags_container');
                      const tagDiv = document.createElement('div');
                      tagDiv.className = 'tag_checkbox';
                      tagDiv.id = `tag_container_${data.tag.id}`;
                      tagDiv.innerHTML = `
                          <input type="checkbox" 
                                 id="tag_${data.tag.id}" 
                                 name="tags[]" 
                                 value="${data.tag.id}">
                          <label for="tag_${data.tag.id}" class="tag_label">${data.tag.name}</label>
                          <button type="button" class="admin_tag_delete" onclick="deleteTag(${data.tag.id})" style="display: none;">
                              <i class="fa fa-times"></i>
                          </button>
                      `;
                      tagsContainer.appendChild(tagDiv);
                      
                      // Add event listener to new checkbox
                      const newCheckbox = tagDiv.querySelector('input[type="checkbox"]');
                      newCheckbox.addEventListener('change', function() {
                          showLoadingState();
                          setTimeout(() => {
                              this.form.submit();
                          }, 300);
                      });
                      
                      closeModal('addTagModal');
                      this.reset();
                      
                      showNotification('Tag added successfully!', 'success');
                  } else {
                      showNotification('Error adding tag: ' + data.message, 'error');
                  }
              })
              .catch(error => {
                  console.error('Error:', error);
                  showNotification('Error adding tag', 'error');
              });
          });
          
          // Delete Category
          function deleteCategory(categoryId) {
              if (confirm('Are you sure you want to delete this category?')) {
                  fetch(`{{ url('admin/categories') }}/${categoryId}`, {
                      method: 'DELETE',
                      headers: {
                          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                          'Content-Type': 'application/json',
                      }
                  })
                  .then(response => response.json())
                  .then(data => {
                      if (data.success) {
                          // Remove from select dropdown
                          const option = document.querySelector(`#category_filter option[value="${categoryId}"]`);
                          if (option) option.remove();
                          
                          // Remove from admin list
                          const adminItem = event.target.closest('.admin_item');
                          if (adminItem) adminItem.remove();
                          
                          showNotification(data.message, 'success');
                          
                          // Refresh page if this category was selected
                          const currentCategory = document.getElementById('category_filter').value;
                          if (currentCategory == categoryId) {
                              window.location.reload();
                          }
                      } else if (data.require_confirmation) {
                          // Show confirmation dialog for force delete
                          if (confirm(`${data.message}\n\nDo you want to proceed? This will move all posts to 'Uncategorized'.`)) {
                              // Retry with force flag
                              fetch(`{{ url('admin/categories') }}/${categoryId}`, {
                                  method: 'DELETE',
                                  headers: {
                                      'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                      'Content-Type': 'application/json',
                                  },
                                  body: JSON.stringify({ force: true })
                              })
                              .then(response => response.json())
                              .then(data => {
                                  if (data.success) {
                                      // Remove from select dropdown
                                      const option = document.querySelector(`#category_filter option[value="${categoryId}"]`);
                                      if (option) option.remove();
                                      
                                      // Remove from admin list
                                      const adminItem = event.target.closest('.admin_item');
                                      if (adminItem) adminItem.remove();
                                      
                                      showNotification(data.message, 'success');
                                      
                                      // Refresh page if this category was selected
                                      const currentCategory = document.getElementById('category_filter').value;
                                      if (currentCategory == categoryId) {
                                          window.location.reload();
                                      }
                                  } else {
                                      showNotification('Error: ' + data.message, 'error');
                                  }
                              })
                              .catch(error => {
                                  showNotification('Error deleting category', 'error');
                              });
                          }
                      } else {
                          showNotification('Error: ' + data.message, 'error');
                      }
                  })
                  .catch(error => {
                      showNotification('Error deleting category', 'error');
                  });
              }
          }
          
          // Delete Tag
          function deleteTag(tagId) {
              if (confirm('Are you sure you want to delete this tag?')) {
                  fetch(`{{ url('admin/tags') }}/${tagId}`, {
                      method: 'DELETE',
                      headers: {
                          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                          'Content-Type': 'application/json',
                      }
                  })
                  .then(response => response.json())
                  .then(data => {
                      if (data.success) {
                          // Remove tag from container
                          const tagContainer = document.getElementById(`tag_container_${tagId}`);
                          if (tagContainer) tagContainer.remove();
                          
                          showNotification(data.message, 'success');
                          
                          // Refresh page if this tag was selected
                          const selectedTags = Array.from(document.querySelectorAll('input[name="tags[]"]:checked')).map(cb => cb.value);
                          if (selectedTags.includes(tagId.toString())) {
                              window.location.reload();
                          }
                      } else if (data.require_confirmation) {
                          // Show confirmation dialog for force delete
                          if (confirm(`${data.message}\n\nDo you want to proceed? This will remove the tag from all associated posts.`)) {
                              // Retry with force flag
                              fetch(`{{ url('admin/tags') }}/${tagId}`, {
                                  method: 'DELETE',
                                  headers: {
                                      'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                      'Content-Type': 'application/json',
                                  },
                                  body: JSON.stringify({ force: true })
                              })
                              .then(response => response.json())
                              .then(data => {
                                  if (data.success) {
                                      // Remove tag from container
                                      const tagContainer = document.getElementById(`tag_container_${tagId}`);
                                      if (tagContainer) tagContainer.remove();
                                      
                                      showNotification(data.message, 'success');
                                      
                                      // Refresh page if this tag was selected
                                      const selectedTags = Array.from(document.querySelectorAll('input[name="tags[]"]:checked')).map(cb => cb.value);
                                      if (selectedTags.includes(tagId.toString())) {
                                          window.location.reload();
                                      }
                                  } else {
                                      showNotification('Error: ' + data.message, 'error');
                                  }
                              })
                              .catch(error => {
                                  showNotification('Error deleting tag', 'error');
                              });
                          }
                      } else {
                          showNotification('Error: ' + data.message, 'error');
                      }
                  })
                  .catch(error => {
                      showNotification('Error deleting tag', 'error');
                  });
              }
          }
          
          // Notification system
          function showNotification(message, type) {
              const notification = document.createElement('div');
              notification.className = `notification notification-${type}`;
              notification.style.cssText = `
                  position: fixed;
                  top: 20px;
                  right: 20px;
                  padding: 15px 20px;
                  border-radius: 5px;
                  color: white;
                  font-weight: 600;
                  z-index: 10000;
                  animation: slideIn 0.3s ease;
                  background: ${type === 'success' ? '#28a745' : '#dc3545'};
              `;
              notification.textContent = message;
              document.body.appendChild(notification);
              
              setTimeout(() => {
                  notification.style.animation = 'slideOut 0.3s ease';
                  setTimeout(() => {
                      if (notification.parentNode) {
                          notification.parentNode.removeChild(notification);
                      }
                  }, 300);
              }, 3000);
          }
          
          // Add CSS for notifications
          const notificationCSS = `
              @keyframes slideIn {
                  from { transform: translateX(100%); opacity: 0; }
                  to { transform: translateX(0); opacity: 1; }
              }
              @keyframes slideOut {
                  from { transform: translateX(0); opacity: 1; }
                  to { transform: translateX(100%); opacity: 0; }
              }
          `;
          const style = document.createElement('style');
          style.textContent = notificationCSS;
          document.head.appendChild(style);
          @endif
      </script>
   </body>
</html>
