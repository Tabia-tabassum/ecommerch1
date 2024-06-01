@extends('layouts.app')
@section('title') {{'Home'}} @endsection

@section('content')

<div class="">
{{--    <div class="container">--}}
{{--        <div class="row">--}}
{{--            <div class="col-lg-12">--}}
{{--                <!-- this is slider section start-->--}}

{{--                <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">--}}
{{--  <div class="carousel-indicators">--}}
{{--    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>--}}

{{--  </div>--}}
{{--  <div class="carousel-inner">--}}
{{--    <div class="carousel-item active">--}}
{{--      <img src="{{asset('img/banner/p5.jpg')}}" class="d-block w-100" alt="...">--}}
{{--    </div>--}}

{{--  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">--}}
{{--    <span class="carousel-control-prev-icon" aria-hidden="true"></span>--}}
{{--    <span class="visually-hidden">Previous</span>--}}
{{--  </button>--}}
{{--  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">--}}
{{--    <span class="carousel-control-next-icon" aria-hidden="true"></span>--}}
{{--    <span class="visually-hidden">Next</span>--}}
{{--  </button>--}}
{{--</div>--}}
{{--                <!-- this is slider section end -->--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}

<div id="home">
<div class="container-fluid">
    <div class="row">

    @foreach ($all_blog as $blog)
    <div class="col-lg-2">
            <div class="card home-card">
            <img src="{{$blog->blog_image}}" class="card-img-top" alt="Image">
            <div class="card-body">
                <h5 class="card-title">{{\Illuminate\Support\Str::limit($blog->blog_title,48,'...')}}</h5>
                <div class="row d-flex">
                    <div class="col-auto">
                        <span><del>TK {{$blog->product_actual_price}}</del></span>
                    </div>
                    <div class="col-auto">
                        <span class="badge rounded-pill text-bg-primary">TK {{$blog->product_offer_price}}</span>
                    </div>
                    <span class="mt-2">Category: {{isset($blog->category->postCategory) && !empty($blog->category->postCategory) ? $blog->category->postCategory->name : ''}}</span>

                </div>
                <a href="{{url('details',['id' => $blog->id])}}" class="btn btn-primary">Details</a>

                <a href="tel:0123456789" class="btn btn-primary mt-2"><i class="fa-solid fa-phone"></i></a>
            </div>
            </div>
        </div>
@endforeach


    </div>
</div>
</div>

@endsection
