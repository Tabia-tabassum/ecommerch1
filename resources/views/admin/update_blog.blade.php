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

                  <!-- side navbar start -->
                  <nav id="sidebarMenu" class="d-lg-block sidebar bg-white">
                    <div class="position-sticky">
                    <div class="list-group list-group-flush mx-3">

                    <a href="{{url('admin')}}" class="list-group-item list-group-item-action py-2 ripple">
                        <i class="fas fa-chart-area fa-fw me-3"></i><span>All Items</span>
                      </a>

                    <a href="{{url('add-blog')}}" class="list-group-item list-group-item-action py-2 ripple ">
                        <i class="fas fa-chart-area fa-fw me-3"></i><span>Add Item</span>
                      </a>
                    <a href="{{url('update')}}" class="list-group-item list-group-item-action py-2 ripple active">
                        <i class="fas fa-chart-area fa-fw me-3"></i><span>Update Item</span>
                        </a>

                        <a href="{{route('show-order-details')}}" class="list-group-item list-group-item-action py-2 ripple">
                            <i class="fa fa-list-alt me-3"></i><span>Order</span>
                        </a>

                        <a href="{{route('admin.category')}}" class="list-group-item list-group-item-action py-2 ripple">
                            <i class="fa fa-list-alt me-3"></i><span>Category</span>
                        </a>


                        <a type="button" id="userLogout" class="list-group-item list-group-item-action py-2 ripple "
                        ><i class="fa-solid fa-right-from-bracket me-3" style="font-size:20px"></i><span>Logout</span></a
                        >

                    </div>
                    </div>
                </nav>
                  <!-- side navbar end -->


        </div>
 <!-- sidebar end -->

 <!-- main content start -->
   <div class="col-lg-9">
   <table class="table table-bordered border-primary">
                          <!-- this is table head -->
                        <thead class="table-dark ">
                          <tr>
                            <th class="th-sm">Image</th>
                            <th class="th-sm">Blog Title</th>
                            <th class="th-sm">Details</th>
                            <th class="th-sm">Update</th>

                          </tr>
                         </thead>
                       <!-- this is table body  end-->

                       <tbody>

                       @foreach ($all_blog as $blog)
            <tr>
                <td class="th-sm ">
                <img src="{{$blog->blog_image}}" class="card-img-top" alt="Image">
                </td>
                <td class="th-sm "><b>{{$blog->blog_title}}</b></td>
                <td class="th-sm ">
                  @php
                  echo substr($blog->details,0,500)
                  @endphp

                </td>

                <td class="th-sm ">
                <a href="{{url('update-form',['id' => $blog->id])}}" class="btn btn-primary">Edit</a>
                </td>


              </tr>
              @endforeach

            </tbody>
                       <!-- this is table body  end-->

                        </table>

   </div>


 <!-- main content end -->


    </div>

</div>

</script>

@endsection()
