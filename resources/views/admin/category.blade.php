@extends('layouts.app')
@php
    $title = \Illuminate\Support\Facades\Cookie::get('role')==1?'Admin':'Seller';
@endphp
@section('title',$title)@section('content')

    <style>
        .list-group-item.active {
            z-index: 2;
            color: #fff;
            background-color: var(--main-color);
            border-color: var(--main-color);
        }

        #sidebarMenu {
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
                            <a class="list-group-item list-group-item-action py-2 ripple active mb-2">
                                <i class="fas fa-chart-area fa-fw me-3"></i><span>{{\Illuminate\Support\Facades\Cookie::get('role')==1?'Admin Dashboard':'Seller Dashboard'}}</span>
                            </a>

                            <a href="{{url('admin')}}" class="list-group-item list-group-item-action py-2 ripple">
                                <i class="fas fa-chart-area fa-fw me-3"></i><span>All Items</span>
                            </a>
                            <a href="{{route('admin.seller')}}" class="list-group-item list-group-item-action py-2 ripple">
                                <i class="fa fa-user me-3"></i><span>Seller</span>
                            </a>
                            <a href="{{route('admin.seller.add')}}" class="list-group-item list-group-item-action py-2 ripple">
                                <i class="fa fa-user me-3"></i><span>Add Seller</span>
                            </a>

                            <a href="{{url('add-blog')}}" class="list-group-item list-group-item-action py-2 ripple ">
                                <i class="fas fa-chart-area fa-fw me-3"></i><span>Add Item</span>
                            </a>
                            <a href="{{url('update')}}" class="list-group-item list-group-item-action py-2 ripple">
                                <i class="fas fa-chart-area fa-fw me-3"></i><span>Update Item</span>
                            </a>

                            <a href="{{route('show-order-details')}}"
                               class="list-group-item list-group-item-action py-2 ripple active">
                                <i class="fa fa-list-alt me-3"></i><span>Order</span>
                            </a>

                            <a type="button" id="userLogout" class="list-group-item list-group-item-action py-2 ripple "
                            ><i class="fa-solid fa-right-from-bracket me-3"
                                style="font-size:20px"></i><span>Logout</span></a
                            >

                        </div>
                    </div>
                </nav>
                <!-- side navbar end -->


            </div>
            <!-- sidebar end -->

            <!-- main content start -->
            <div class="col-lg-9">
                <button type="button" class="btn btn-primary m-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Create New Category
                </button>
                <table class="table table-bordered border-primary">
                    <!-- this is table head -->
                    <thead class="table-dark ">
                    <tr>
                        <th class="th-sm">Id</th>
                        <th class="th-sm">Category Name</th>
                        <th class="th-sm">Sub Category Name</th>
                        <th class="th-sm">Action</th>

                    </tr>
                    </thead>
                    <!-- this is table body  end-->

                    <tbody>
                    @foreach ($allCategories as $key => $blog)
                        <tr>
                            <td class="th-sm "><b>{{++$key}}</b></td>
                            <td class="th-sm ">{{$blog->name}}</td>
                            <td class="th-sm "></td>
                            <td class="th-sm ">
                                <button onclick="remove_blog({!!$blog->id!!})" class="btn btn-danger">Delete</button>
                                <button data-bs-toggle="modal" data-CategoryId="{{$blog->id}}" data-CategoryName="{{$blog->name}}" data-bs-target="#exampleModal1" class="btn btn-secondary editBtn">Edit</button>
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

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create New Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form class="row g-3" action="{{route('admin.category.store')}}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="inputState" class="form-label">Parent Category</label>
                                <select id="inputState" class="form-select" name="parentCategoryId">
                                    <option value="" selected>Choose Parent Category</option>
                                   @foreach($allCategories as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                   @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="inputEmail4" class="form-label">Category Name</label>
                                <input type="text" class="form-control" id="inputEmail4" name="categoryName">
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form class="row g-3" action="{{route('admin.category.update')}}" method="post">
                    @csrf
                    <input type="hidden" class="form-control" id="categoryIdInput" name="categoryId" value="">
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="inputState" class="form-label">Parent Category</label>
                                <select id="inputState" class="form-select" name="parentCategoryId">
                                    <option value="" selected>Choose Parent Category</option>
                                   @foreach($allCategories as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                   @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="inputEmail4" class="form-label">Category Name</label>
                                <input type="text" class="form-control" id="categoryInput" name="categoryName">
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
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
                        .get('/delete-post-category', {params: {id: id}})
                        .then(function (response) {

                            if (response.status == 200 && response.data == 1) {
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

        document.querySelectorAll('.editBtn').forEach(button => {
            button.addEventListener('click', (event) => {
                let categoryId = button.getAttribute('data-CategoryId');
                let categoryName = button.getAttribute('data-CategoryName');

                document.querySelector('#categoryInput').value = categoryName
                document.querySelector('#categoryIdInput').value = categoryId
            });
        });

    </script>

@endsection()
