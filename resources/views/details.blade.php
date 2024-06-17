@extends('layouts.app')
@section('title') {{'Details'}} @endsection

@section('content')

    @if(session()->has('success'))
        <div class="alert alert-success" role="alert">
            {{session()->get('success')}}
        </div>
    @endif

<div id="home">

<div class="container">
    <div class="row">
         <div class="col-lg-8">
            <h2>{{$blog_details->blog_title}}</h2>
           @php
           echo $blog_details->details

           @endphp
         </div>

         <div class="col-lg-4">
            <img src="{{$blog_details->blog_image}}" alt="">
         </div>

        <div class="row d-flex mt-3">
            <div class="col-auto">
              Price:  <span><del>TK {{$blog_details->product_actual_price}}</del></span>
            </div>
            <div class="col-auto">
                <span class="badge rounded-pill text-bg-primary">Offer Price: TK {{$blog_details->product_offer_price}}</span>
            </div>
        </div>

    </div>

    <div class="row mt-3">
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <form method="post" action="{{route('orderProduct',$blog_details->id)}}">
                        @csrf
                        <input type="hidden" name="offerPrice" value="{{$blog_details->product_offer_price}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">

                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Quantity</label>
                            <input type="number" name="quantity" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">

                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Address</label>
                            <textarea name="address" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Phone Number</label>
                            <input type="text" name="phoneNumber" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">

                        </div>
                        @if(\Illuminate\Support\Facades\Cookie::get('admin'))
                            <button type="submit" class="btn btn-primary">Order Now</button>
                            <input type="hidden" name="userId" class="form-control" value="{{\Illuminate\Support\Facades\Cookie::get('adminId')}}" id="exampleInputEmail1" aria-describedby="emailHelp">
                        @else
                                <a href="{{route('admin.login')}}" class="btn btn-primary"> Login</a>
                        @endif

                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
</div>
    <script>
        document.querySelector('input[name="quantity"]').addEventListener('input',(event)=>{
            let quantity = event.target.closest('.form-control').value
            if(quantity < 0){
                event.target.closest('.form-control').value = 1
            }
        })
    </script>

@endsection
