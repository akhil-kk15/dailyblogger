<!DOCTYPE html>
<html lang="en">
   <head>
      @include('home.homecss')
       </head>
   <body>
      <!-- header section start -->
      <div class="header_section">
         @include('home.header')
         <!-- banner section start -->
        @include('home.banner')
         <!-- banner section end -->
      </div>
      <!-- header section end -->
      
      <!-- announcements section start -->
      @if(isset($announcements) && $announcements->count() > 0)
      <div class="announcements_section layout_padding">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <h2 class="announcements_title">📢 Latest Announcements</h2>
                  <div class="announcements_container">
                     @foreach($announcements as $announcement)
                     <div class="announcement_card announcement_{{ $announcement->priority }} announcement_{{ $announcement->type }}">
                        <div class="announcement_header">
                           <h4 class="announcement_title">{{ $announcement->title }}</h4>
                           <div class="announcement_meta">
                              <span class="announcement_priority priority_{{ $announcement->priority }}">{{ ucfirst($announcement->priority) }}</span>
                              <span class="announcement_type type_{{ $announcement->type }}">{{ ucfirst($announcement->type) }}</span>
                              <span class="announcement_date">{{ $announcement->created_at->format('M d, Y') }}</span>
                           </div>
                        </div>
                        <div class="announcement_content">
                           <p>{{ $announcement->content }}</p>
                        </div>
                     </div>
                     @endforeach
                  </div>
               </div>
            </div>
         </div>
      </div>
      @endif
      <!-- announcements section end -->
      
      <!-- services section start -->
      @include('home.services')
      <!-- services section end -->
      <!-- about section start -->
      @include('home.about')
      <!-- about section end -->
      <!-- blog section start -->
     @include('home.blog')
      <!-- blog section end -->
      <!-- client section start -->
     
      <!-- client section start -->
      <!-- choose section start -->
      <!-- <div class="choose_section layout_padding">
         <div class="container">
            <h1 class="choose_taital">Why Choose Us</h1>
            <p class="choose_text">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text. All </p>
            <div class="read_bt_1"><a href="#">Read More</a></div>
            <div class="newsletter_box">
               <h1 class="let_text">Let Start Talk with Us</h1>
               <div class="getquote_bt"><a href="#">Get A Quote</a></div>
            </div>
         </div>
      </div> -->
      <!-- choose section end -->
      <!-- footer section start -->
      @include('home.footer')
      <!-- footer section end -->
      
      <style>
      /* Announcements Section Styles */
      .announcements_section {
          background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
          color: white;
      }
      
      .announcements_title {
          color: white;
          text-align: center;
          margin-bottom: 40px;
          font-size: 2.5rem;
          font-weight: bold;
      }
      
      .announcements_container {
          display: flex;
          flex-direction: column;
          gap: 20px;
      }
      
      .announcement_card {
          background: rgba(255, 255, 255, 0.95);
          border-radius: 12px;
          padding: 25px;
          box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
          color: #333;
          border-left: 5px solid;
          transition: transform 0.3s ease, box-shadow 0.3s ease;
      }
      
      .announcement_card:hover {
          transform: translateY(-5px);
          box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
      }
      
      /* Priority Colors */
      .announcement_card.announcement_urgent {
          border-left-color: #dc3545;
          background: linear-gradient(135deg, rgba(220, 53, 69, 0.1), rgba(255, 255, 255, 0.95));
      }
      
      .announcement_card.announcement_high {
          border-left-color: #fd7e14;
          background: linear-gradient(135deg, rgba(253, 126, 20, 0.1), rgba(255, 255, 255, 0.95));
      }
      
      .announcement_card.announcement_normal {
          border-left-color: #0d6efd;
          background: linear-gradient(135deg, rgba(13, 110, 253, 0.1), rgba(255, 255, 255, 0.95));
      }
      
      .announcement_card.announcement_low {
          border-left-color: #198754;
          background: linear-gradient(135deg, rgba(25, 135, 84, 0.1), rgba(255, 255, 255, 0.95));
      }
      
      .announcement_header {
          margin-bottom: 15px;
      }
      
      .announcement_title {
          font-size: 1.4rem;
          font-weight: bold;
          margin-bottom: 10px;
          color: #2c3e50;
      }
      
      .announcement_meta {
          display: flex;
          flex-wrap: wrap;
          gap: 10px;
          align-items: center;
      }
      
      .announcement_priority,
      .announcement_type {
          padding: 4px 12px;
          border-radius: 20px;
          font-size: 0.75rem;
          font-weight: bold;
          text-transform: uppercase;
      }
      
      /* Priority Badge Colors */
      .priority_urgent {
          background: #dc3545;
          color: white;
      }
      
      .priority_high {
          background: #fd7e14;
          color: white;
      }
      
      .priority_normal {
          background: #0d6efd;
          color: white;
      }
      
      .priority_low {
          background: #198754;
          color: white;
      }
      
      /* Type Badge Colors */
      .type_general {
          background: #6f42c1;
          color: white;
      }
      
      .type_maintenance {
          background: #fd7e14;
          color: white;
      }
      
      .type_feature {
          background: #0dcaf0;
          color: white;
      }
      
      .type_important {
          background: #dc3545;
          color: white;
      }
      
      .announcement_date {
          color: #6c757d;
          font-size: 0.85rem;
          font-style: italic;
      }
      
      .announcement_content {
          font-size: 1rem;
          line-height: 1.6;
          color: #495057;
      }
      
      /* Responsive Design */
      @media (max-width: 768px) {
          .announcements_title {
              font-size: 2rem;
              margin-bottom: 30px;
          }
          
          .announcement_card {
              padding: 20px;
          }
          
          .announcement_meta {
              flex-direction: column;
              align-items: flex-start;
              gap: 8px;
          }
          
          .announcement_title {
              font-size: 1.2rem;
          }
      }
      </style>
      
      </body>
</html>