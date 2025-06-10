<div class="featured_section layout_padding">
   <div class="container">
      <div class="row">
         <div class="col-sm-12">
            <h1 class="featured_taital">Featured Posts</h1>
            <p class="featured_text">Discover our handpicked featured articles and trending content</p>
         </div>
      </div>
      <div class="featured_section_2">
         <div class="row">
            @foreach($featuredPosts as $post)
               <div class="col-md-4">
                  <div class="featured_box">
                     <div class="featured_badge">
                        <i class="fa fa-star"></i> Featured
                     </div>
                     @if($post->image)
                        <div class="featured_img">
                           <img src="{{ asset('postimage/' . $post->image) }}" class="featured_image" alt="{{ $post->title }}">
                        </div>
                     @endif
                     <div class="featured_content">
                        <h4 class="featured_title">{{ \Illuminate\Support\Str::limit($post->title, 60) }}</h4>
                        <p class="featured_description">{{ \Illuminate\Support\Str::limit($post->description, 120) }}</p>
                        <div class="featured_meta">
                           <span class="featured_author">By: {{ $post->name }}</span>
                           @if($post->usertype === 'admin')
                              <span class="admin_badge_small">Admin</span>
                           @endif
                           <span class="featured_date">{{ $post->created_at->format('M d, Y') }}</span>
                        </div>
                        @if($post->category)
                           <div class="featured_category">
                              <i class="fa fa-folder"></i> {{ $post->category->name }}
                           </div>
                        @endif
                        <div class="featured_btn_main">
                           <a href="{{ route('home.post_details', $post->id) }}">Read Featured Post</a>
                        </div>
                     </div>
                  </div>
               </div>
            @endforeach
         </div>
      </div>
   </div>
</div>

<style>
.featured_section {
   background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
   color: white;
}

.featured_taital {
   color: white;
   font-size: 40px;
   text-align: center;
   padding-bottom: 20px;
}

.featured_text {
   color: rgba(255,255,255,0.9);
   font-size: 17px;
   text-align: center;
   margin-bottom: 50px;
}

.featured_box {
   background: white;
   border-radius: 15px;
   overflow: hidden;
   box-shadow: 0 10px 30px rgba(0,0,0,0.2);
   margin-bottom: 30px;
   transition: transform 0.3s ease, box-shadow 0.3s ease;
   position: relative;
}

.featured_box:hover {
   transform: translateY(-10px);
   box-shadow: 0 20px 40px rgba(0,0,0,0.3);
}

.featured_badge {
   position: absolute;
   top: 15px;
   right: 15px;
   background: #ffc107;
   color: #212529;
   padding: 8px 12px;
   border-radius: 20px;
   font-size: 12px;
   font-weight: 700;
   z-index: 2;
   box-shadow: 0 2px 10px rgba(255,193,7,0.3);
}

.featured_img {
   height: 200px;
   overflow: hidden;
   position: relative;
}

.featured_image {
   width: 100%;
   height: 100%;
   object-fit: cover;
   transition: transform 0.3s ease;
}

.featured_box:hover .featured_image {
   transform: scale(1.1);
}

.featured_content {
   padding: 25px;
   color: #333;
}

.featured_title {
   font-size: 20px;
   font-weight: 700;
   margin-bottom: 15px;
   line-height: 1.4;
   color: #2c3e50;
}

.featured_description {
   color: #666;
   line-height: 1.6;
   margin-bottom: 20px;
   font-size: 15px;
}

.featured_meta {
   display: flex;
   flex-wrap: wrap;
   gap: 10px;
   margin-bottom: 15px;
   font-size: 13px;
}

.featured_author {
   color: #007bff;
   font-weight: 600;
}

.admin_badge_small {
   background: #dc3545;
   color: white;
   padding: 2px 6px;
   border-radius: 8px;
   font-size: 10px;
   font-weight: 600;
   text-transform: uppercase;
}

.featured_date {
   color: #999;
}

.featured_category {
   color: #28a745;
   font-size: 13px;
   font-weight: 600;
   margin-bottom: 20px;
}

.featured_category i {
   margin-right: 5px;
}

.featured_btn_main {
   text-align: center;
}

.featured_btn_main a {
   display: inline-block;
   background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
   color: white;
   padding: 12px 25px;
   border-radius: 25px;
   text-decoration: none;
   font-weight: 600;
   transition: all 0.3s ease;
   box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
}

.featured_btn_main a:hover {
   transform: translateY(-2px);
   box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
   color: white;
   text-decoration: none;
}

@media (max-width: 768px) {
   .featured_taital {
      font-size: 30px;
   }
   
   .featured_content {
      padding: 20px;
   }
   
   .featured_title {
      font-size: 18px;
   }
}
</style>
