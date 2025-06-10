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
                                  @if(Auth::check() && Auth::user()->usertype == 'admin')
                                      <button type="button" class="admin_add_btn" onclick="showAddCategoryModal()">
                                          <i class="fa fa-plus"></i>
                                      </button>
                                  @endif
                              </label>
                              <select name="category" id="category_filter" class="filter_select">
                                  <option value="">All Categories</option>
                                  @foreach($categories as $category)
                                      <option value="{{ $category->id }}" 
                                              {{ $selectedCategory == $category->id ? 'selected' : '' }}>
                                          {{ $category->name }}
                                          @if(Auth::check() && Auth::user()->usertype == 'admin')
                                              
                                          @endif
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
                              <label for="sort_filter" class="search_label">Sort By</label>
                              <select name="sort" id="sort_filter" class="filter_select">
                                  <option value="latest" {{ $sortBy == 'latest' ? 'selected' : '' }}>Latest First</option>
                                  <option value="oldest" {{ $sortBy == 'oldest' ? 'selected' : '' }}>Oldest First</option>
                                  <option value="title" {{ $sortBy == 'title' ? 'selected' : '' }}>Title A-Z</option>
                                  <option value="most_commented" {{ $sortBy == 'most_commented' ? 'selected' : '' }}>Most Commented</option>
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
                                      @php $categoryName = $categories->find($selectedCategory)->name ?? 'Unknown' @endphp
                                      <span class="filter_tag">
                                          Category: {{ $categoryName }}
                                          <a href="{{ request()->fullUrlWithQuery(['category' => null]) }}" class="remove_filter">×</a>
                                      </span>
                                  @endif
                                  @if(count($selectedTags) > 0)
                                      @foreach($selectedTags as $tagId)
                                          @php $tagName = $tags->find($tagId)->name ?? 'Unknown' @endphp
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
                                                          <span class="result_tag">{{ $tag->tag_name }}</span>
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
                              @foreach($categories->take(4) as $category)
                                  <a href="{{ route('home.search', ['category' => $category->id]) }}" class="quick_link">{{ $category->name }}</a>
                              @endforeach
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
              font-weight: 600;
              margin-bottom: 8px;
              color: #333;
          }
          
          .search_input, .filter_select {
              width: 100%;
              padding: 12px 15px;
              border: 2px solid #ddd;
              border-radius: 8px;
              font-size: 16px;
              transition: all 0.3s ease;
              cursor: pointer;
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
          
          .tag_checkbox {
              display: flex;
              align-items: center;
              background: #f8f9fa;
              padding: 8px 12px;
              border-radius: 20px;
              border: 2px solid transparent;
              cursor: pointer;
              transition: all 0.3s ease;
          }
          
          .tag_checkbox:hover {
              background: #e9ecef;
          }
          
          .tag_checkbox:has(input:checked) {
              background: #007bff;
              color: white;
              border-color: #0056b3;
          }
          
          .tag_checkbox input[type="checkbox"] {
              margin-right: 8px;
              width: auto;
          }
          
          .tag_label {
              margin: 0;
              cursor: pointer;
              font-size: 14px;
          }
          
          .search_actions {
              display: flex;
              gap: 15px;
              justify-content: center;
          }
          
          .search_btn, .clear_btn {
              padding: 12px 30px;
              border-radius: 8px;
              font-weight: 600;
              text-decoration: none;
              display: inline-flex;
              align-items: center;
              gap: 8px;
              transition: all 0.3s ease;
          }
          
          .search_btn {
              background: #007bff;
              color: white;
              border: none;
          }
          
          .search_btn:hover {
              background: #0056b3;
              transform: translateY(-2px);
          }
          
          .clear_btn {
              background: #6c757d;
              color: white;
          }
          
          .clear_btn:hover {
              background: #545b62;
              color: white;
              text-decoration: none;
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
              gap: 10px;
              margin-top: 15px;
          }
          
          .filters_label {
              font-weight: 600;
              color: #333;
          }
          
          .filter_tag {
              background: #e9ecef;
              padding: 4px 8px;
              border-radius: 15px;
              font-size: 12px;
              display: inline-flex;
              align-items: center;
              gap: 5px;
          }
          
          .remove_filter {
              color: #dc3545;
              text-decoration: none;
              font-weight: bold;
              font-size: 14px;
          }
          
          .remove_filter:hover {
              color: #c82333;
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
              background: #28a745;
              color: white;
              border: none;
              padding: 4px 8px;
              border-radius: 4px;
              margin-left: 10px;
              cursor: pointer;
              font-size: 12px;
              transition: all 0.3s ease;
          }
          
          .admin_add_btn:hover, .admin_manage_btn:hover {
              background: #218838;
          }
          
          .admin_manage_btn {
              background: #6c757d;
              margin-left: 5px;
          }
          
          .admin_manage_btn:hover {
              background: #545b62;
          }
          
          .admin_category_list {
              background: #f8f9fa;
              border: 1px solid #ddd;
              border-radius: 5px;
              padding: 10px;
              max-height: 200px;
              overflow-y: auto;
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
              select.addEventListener('change', function() {
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
          
          // Show loading state function
          function showLoadingState() {
              // Disable form elements temporarily
              document.querySelectorAll('.filter_select, input[name="tags[]"]').forEach(element => {
                  element.disabled = true;
              });
              
              // Show loading text in results area
              const resultsSection = document.querySelector('.search_results_section');
              if (resultsSection) {
                  resultsSection.style.opacity = '0.6';
                  resultsSection.style.pointerEvents = 'none';
              }
              
              // Add loading spinner to search button if it exists
              const searchBtn = document.querySelector('.search_btn');
              if (searchBtn) {
                  searchBtn.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Searching...';
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
