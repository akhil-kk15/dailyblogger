<!DOCTYPE html>
<html>
  <head> 
   @include('admin.admincss')
   <style type ="text/css">

.page-content{
    align-items: center;
    display: flex;
    flex-direction: column;
    justify-content: center;
    height: 100vh;
}    
.post_title{
        font-size: 60px;
        text-align: center;
        padding: 30px;
        font-family: "Muli",sans-serif;
   

    }
     .div_center{
        text-align: center;
        padding: 10px;
        width: 100%;
    }
    </style>
  </head>
  <body>
    <header class="header">   
     @include('admin.header ')
    </header>
    <div class="d-flex align-items-stretch">
      <!-- Sidebar Navigation-->
      @include('admin.sidebar')
      <!-- Sidebar Navigation end-->
       <!-- @include('admin.body') -->
     <div class="page-content">
        <h1 class="post_title">Add Post</h1>
        <div>
            <form action="{{url('add_post')  }}" method="POST" enctype="multipart/form-data">
                <div class="div_center">
                  @csrf
                <label>Post Title</label>
                <input type="text" name="title" placeholder="Enter Post Title" required>
                </div>
                <div class="div_center">
                <label>Post Description</label>
                <textarea name="description" placeholder="Enter Post Desc" required></textarea>
                </div>
                <div class="div_center">
                <label>Post Image</label>
                <input type="file" name="image" accept="image/*" required>
                </div>
                <div class="div_center">
                    <input type="submit" class="btn btn-primary" value="Add Post">
                </div>
            </form>
        </div>    
    </div>
      @include('admin.footer')
  </body>
</html>