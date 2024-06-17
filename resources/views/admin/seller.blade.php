@extends('layouts.app')
@php
$title = \Illuminate\Support\Facades\Cookie::get('role')==1?'Admin':'Seller';
 @endphp
@section('title',$title)
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
            <a class="list-group-item list-group-item-action py-2 ripple active mb-2">
                <i class="fas fa-chart-area fa-fw me-3"></i><span>{{\Illuminate\Support\Facades\Cookie::get('role')==1?'Admin Dashboard':'Seller Dashboard'}}</span>
            </a>
                  <!-- side navbar start -->
                  <nav id="sidebarMenu" class="d-lg-block sidebar bg-white">
                    <div class="position-sticky">
                    <div class="list-group list-group-flush mx-3">

                    <a href="{{url('admin')}}" class="list-group-item list-group-item-action py-2 ripple active">
                        <i class="fas fa-chart-area fa-fw me-3"></i><span>All Items</span>
                      </a>

                    <a href="{{url('add-blog')}}" class="list-group-item list-group-item-action py-2 ripple ">
                        <i class="fas fa-chart-area fa-fw me-3"></i><span>Add Item</span>
                      </a>
                      <a href="{{url('update')}}" class="list-group-item list-group-item-action py-2 ripple">
                        <i class="fas fa-chart-area fa-fw me-3"></i><span>Update Item</span>
                        </a>

                        <a href="{{route('show-order-details')}}" class="list-group-item list-group-item-action py-2 ripple">
                            <i class="fa fa-list-alt me-3"></i><span>Order</span>
                        </a>

                        @if(\Illuminate\Support\Facades\Cookie::get('role') == 1)

                            <a href="{{route('admin.category')}}" class="list-group-item list-group-item-action py-2 ripple">
                                <i class="fa fa-list-alt me-3"></i><span>Category</span>
                            </a>
                        @endif

                        @if(\Illuminate\Support\Facades\Cookie::get('role') == 1)

                            <a href="{{route('admin.seller')}}" class="list-group-item list-group-item-action py-2 ripple">
                                <i class="fa fa-user me-3"></i><span>Seller</span>
                            </a>
                            <a href="{{route('admin.seller.add')}}" class="list-group-item list-group-item-action py-2 ripple">
                                <i class="fa fa-user me-3"></i><span>Add Seller</span>
                            </a>
                        @endif

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
                            <th class="th-sm">Name</th>
                            <th class="th-sm">Email</th>
                            <th class="th-sm">Role</th>
                            <th class="th-sm">Action</th>

                          </tr>
                         </thead>
                       <!-- this is table body  end-->

                       <tbody>
                       @foreach ($all_blog as $blog)
            <tr>
                <td class="th-sm "><b>{{$blog->name}}</b></td>
                <td class="th-sm "><b>{{$blog->email}}</b></td>
                <td class="th-sm "><b>{{__('SELLER')}}</b></td>

                <td class="th-sm ">
                <button onclick="remove_blog({!!$blog->id!!})"  class="btn btn-danger">Delete</button>
                    <a href="{{route('admin.seller.store',$blog->id)}}"  class="btn btn-primary">Edit</a>
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

<script>
         const remove_blog = (id) => {

Swal.fire({
  title: 'Are you sure?',
  text: "Remove Blog",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, Remove'
}).then((result) => {
  if (result.isConfirmed) {
    axios
           .get("/delete-seller", { params: { id: id } })
         .then(function (response) {

           if(response.status == 200 && response.data == 1){
             Swal.fire({
                   position: 'top-center',
                   icon: 'success',
                   title: 'Successfully Delete',
                   showConfirmButton: false,
                   timer: 1500
                 })

             location.reload();

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
})



}
</script>

@endsection()
