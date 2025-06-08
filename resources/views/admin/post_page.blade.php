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
    
    .tag-label:hover {
        background: #e9ecef !important;
        border-color: #6c757d !important;
    }
    
    .tag-label input[type="checkbox"]:checked + span {
        color: #fff;
        font-weight: bold;
    }
    
    .tag-label:has(input[type="checkbox"]:checked) {
        background: #007bff !important;
        border-color: #007bff !important;
        color: #fff;
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
                    <label>Category</label>
                    <select name="category_id" required style="width: 300px; padding: 8px; margin: 10px;">
                        <option value="">Select a Category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="div_center">
                    <label>Tags</label>
                    <div style="display: flex; flex-wrap: wrap; gap: 10px; justify-content: center; max-width: 600px; margin: 10px auto;">
                        @foreach($tags as $tag)
                            <label class="tag-label" style="display: flex; align-items: center; cursor: pointer; background: #f8f9fa; padding: 8px 12px; border-radius: 20px; border: 2px solid #e9ecef; transition: all 0.3s;">
                                <input type="checkbox" name="tags[]" value="{{ $tag->id }}" style="margin-right: 8px;">
                                <span>{{ $tag->name }}</span>
                            </label>
                        @endforeach
                    </div>
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