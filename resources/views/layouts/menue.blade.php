<!-- main header area  -->
<style>
    .navbar .form-container {
        margin-left: auto;
    }
    .form-inline .form-control {
        display: inline-block;
        width: auto;
        vertical-align: middle;
    }
    .form-inline .btn {
        display: inline-block;
        vertical-align: middle;
    }
</style>

<header class="andfood-header">


    <!-- navbar  -->
    <div class="andfood-navbar">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">
            <a class="navbar-brand pb-0 text-primary" href="{{ url('/') }}">Online Bazer</a>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <a class="nav-link active" aria-current="page" href="{{ url('/') }}">Home</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Category
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown" style="background: #fff3cd">
                                @foreach(getCategory() as $category)
                                    <a class="dropdown-item" href="{{route('admin.category.details',['id'=>$category->id])}}">{{$category->name}}</a>
                                @endforeach

                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{ url('/about') }}">About</a>
                        </li>
                    </ul>
                    <div class="form-container">
                        <form class="form-inline" action="{{route('home')}}" method="get">
                            <input class="form-control" name="search" type="search" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-success" type="submit">Search</button>
                        </form>
                    </div>

                    <div class="form-container">
                        <a href="{{route('admin.login')}}" class="btn btn-primary">Login</a>
                    </div>
                </div>
            </div>
        </nav>
    </div>




</header>
