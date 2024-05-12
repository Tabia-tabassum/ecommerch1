@extends('layouts.app')
@section('title','Admin')
@section('content')


<style>
.list-group-item.active {
  z-index: 2;
  color: #fff;
  background-color: var(--main-color);
  border-color: var(--main-color);
}
#sidebarMenu{
    height: 100%;
}
</style>

<div class="container-fluid ps-0">
    <div class="row">
        <!-- Sidebar start -->
        <div class="col-lg-3 pe-0">

                  <nav id="sidebarMenu" class="d-lg-block sidebar bg-white">
                    <div class="position-sticky">
                    <div class="list-group list-group-flush mx-3">

                    <a href="{{url('admin')}}" class="list-group-item list-group-item-action py-2 ripple">
                        <i class="fas fa-chart-area fa-fw me-3"></i><span>All Blogs</span>
                      </a>

                    <a href="{{url('add-blog')}}" class="list-group-item list-group-item-action py-2 ripple active">
                        <i class="fas fa-chart-area fa-fw me-3"></i><span>Add Blog</span>
                      </a>
                      <a href="{{url('update')}}" class="list-group-item list-group-item-action py-2 ripple">
                        <i class="fas fa-chart-area fa-fw me-3"></i><span>Update Blog</span>
                        </a>

                        </i><span>Logout</span></a
                        >

                    </div>
                    </div>
                </nav>


        </div>
 <!-- sidebar end -->

 <!-- main content start -->
       <div class="col-lg-9">
       <article class="card">
                <div class="card-header text-center">Add Blog</div>

                <div class="row">
                    <div class="col-lg-8 mx-auto">
                    <div class="card-body p-5">
                    <form>
                        <!-- this is form title -->
                    <div class="my-4">
                    <label class="form-label">Blog Title</label>
                        <input id="blog_title" type="text" class="form-control" name="name" required  autofocus placeholder="Blog Title">
                    </div>
                <!-- this is form details -->
                    <div class="my-4">
                    <label class="form-label">Details</label>
                        <textarea class="form-control" id="summary-ckeditor" name="summary-ckeditor"></textarea>

                    </div>
                <!-- this is form image -->
                    <div class="my-4">
                    <label class="form-label">Blog Image</label>

                    <input id="demo_img" type="file" class="form-control">

                         <img src="{{asset('img/blank_image.png')}}" class="w-100" style="height:300px" id="show_image" alt="">
                    </div>



                    <button onclick="add_university()" class="btn">
                                    Submit
                     </button>



                    </div>
                </form>
                </div>
             </div>
        </article>
       </div>
 <!-- main content end -->


    </div>

</div>

<script>

     const add_university = () => {

    event.preventDefault();

    var blog_title = $("#blog_title").val() ? $("#blog_title").val() : false;
    var details = CKEDITOR.instances['summary-ckeditor'].getData();
    var blog_image = $("#demo_img").prop(
              "files"
          )[0];



    var formData = new FormData();

    formData.append("blog_title", blog_title);
    formData.append("details", details);
    formData.append("blog_image", blog_image);

    axios
        .post("/add-blog-submit",formData)


        .then(function (response) {
           if(response.status == 200 && response.data == 1){
                Swal.fire({
                  position: "top-center",
                  icon: "success",
                  title: "Blog Add Successfully",
                  showConfirmButton: false,
                  timer: 1500,
              });
           }else{
              Swal.fire({
                  position: "top-center",
                  icon: "success",
                  title: "Faild",
                  showConfirmButton: false,
                  timer: 1500,
              });
           }

        })
        .catch(function (error) {
            Swal.fire({
                position: "top-center",
                icon: "error",
                title: "Your form submission is not complete",
                showConfirmButton: false,
                timer: 1500,
            });
        });
  }
</script>

@endsection()