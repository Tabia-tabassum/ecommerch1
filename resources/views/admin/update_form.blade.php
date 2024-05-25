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
                        <i class="fas fa-chart-area fa-fw me-3"></i><span>All Items</span>
                      </a>

                    <a href="{{url('add-blog')}}" class="list-group-item list-group-item-action py-2 ripple">
                        <i class="fas fa-chart-area fa-fw me-3"></i><span>Add Item</span>
                      </a>
                      <a href="{{url('update')}}" class="list-group-item list-group-item-action py-2 ripple active">
                        <i class="fas fa-chart-area fa-fw me-3"></i><span>Update Item</span>
                        </a>

                    <a href="{{url('add-university')}}" class="list-group-item list-group-item-action py-2 ripple">
                        <i class="fas fa-chart-area fa-fw me-3"></i><span>Add Item</span>
                        </a>

                        <a href="{{url('all-university-admin')}}" class="list-group-item list-group-item-action py-2 ripple"
                        ><i class="fas fa-chart-line fa-fw me-3"></i><span>University Manage</span></a
                        >
                        <a href="{{url('add-services')}}" class="list-group-item list-group-item-action py-2 ripple"
                        ><i class="fas fa-chart-line fa-fw me-3"></i><span>Add services</span></a
                        >
                        <a href="{{url('manage-course')}}" class="list-group-item list-group-item-action py-2 ripple">
                        <i class="fas fa-chart-pie fa-fw me-3"></i><span>Manage Course</span>
                        </a>
                        <a href="{{url('manage-services')}}" class="list-group-item list-group-item-action py-2 ripple"
                        ><i class="fas fa-chart-bar fa-fw me-3"></i><span>Manage Services</span></a
                        >
                        <a href="{{url('manage-course')}}" class="list-group-item list-group-item-action py-2 ripple"
                        ><i class="fas fa-globe fa-fw me-3"></i><span>Edit Course</span></a
                        >
                        <a href="{{url('manage-services')}}" class="list-group-item list-group-item-action py-2 ripple"
                        ><i class="fas fa-globe fa-fw me-3"></i><span>Edit Services</span></a
                        >


                        <a href="{{url('user-maintain')}}" class="list-group-item list-group-item-action py-2 ripple"
                        ><i class="fas fa-users fa-fw me-3"></i><span>Users</span></a
                        >

                        <a href="{{url('add-seminer')}}" class="list-group-item list-group-item-action py-2 ripple"
                        ><i class="fas fa-money-bill fa-fw me-3"></i><span>Add Seminar</span></a
                        >
                        <a href="{{url('manage-seminer')}}" class="list-group-item list-group-item-action py-2 ripple"
                        ><i class="fas fa-money-bill fa-fw me-3"></i><span>Manage Seminar</span></a
                        >
                        <a type="button" id="userLogout" class="list-group-item list-group-item-action py-2 ripple "
                        ><i class="fa-solid fa-right-from-bracket me-3" style="font-size:20px"></i><span>Logout</span></a
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
                        <input id="blog_title" type="text" class="form-control" name="name" required  autofocus value="{{$blog_details->blog_title}}">
                    </div>
                <!-- this is form details -->
                    <div class="my-4">
                    <label class="form-label">Details</label>
                        <textarea class="form-control" id="summary-ckeditor" name="summary-ckeditor">{{$blog_details->details}}</textarea>

                    </div>
                <!-- this is form image -->
                    <div class="my-4">
                    <label class="form-label">Blog Image</label>

                    <input id="demo_img" type="file" class="form-control">

                         <img src="{{$blog_details->blog_image}}" class="w-100" style="height:300px" id="show_image" alt="">
                    </div>


                    <input type="text" class="d-none" id="blog_edit_id" value="{{$blog_details->id}}">

                    <button onclick="update_blog()" class="btn">
                                    Update
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
    const update_blog = () => {

    event.preventDefault();

    var blog_title = $("#blog_title").val() ? $("#blog_title").val() : false;
    var details = CKEDITOR.instances['summary-ckeditor'].getData();
    var blog_image = $("#demo_img").prop(
              "files"
          )[0];
    var blog_edit_id = $("#blog_edit_id").val() ? $("#blog_edit_id").val() : false;


    var formData = new FormData();

    formData.append("blog_title", blog_title);
    formData.append("details", details);
    formData.append("blog_image", blog_image);
    formData.append("blog_edit_id", blog_edit_id);

    axios
        .post("/update-blog-submit",formData)

       .then(function (response) {
           if(response.status == 200 && response.data == 1){
                Swal.fire({
                  position: "top-center",
                  icon: "success",
                  title: "Blog Update Successfully",
                  showConfirmButton: false,
                  timer: 1500,
              });
           }else{
              Swal.fire({
                  position: "top-center",
                  icon: "error",
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
                title: "Error",
                showConfirmButton: false,
                timer: 1500,
            });
        });
  }
</script>

@endsection()
