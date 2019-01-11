<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Blog Post - Start Bootstrap Template</title>

    <!-- Bootstrap core CSS -->
    <link href="/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/css/blog-post.css" rel="stylesheet">

  </head>

  <body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
        <a class="navbar-brand" href="#"> ..</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link" href="{{route('index')}}">Home
                <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="{{route('about')}}">About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Services</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Contact</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Page Content -->
    <div class="container">

      <div class="row">

        <!-- Post Content Column -->
        <div class="col-lg-8">

          <!-- Title -->
                
          <h4 class="mt-4">{{$data->title}}</h4>

          <hr>

          <!-- Date/Time -->
          <p>{{$data->created_at}}</p>

  

          <!-- Preview Image -->
          {{-- <img class="img-fluid rounded" src="http://placehold.it/900x300" alt=""> --}}

          {{-- <hr> --}}

          <!-- Post Content -->
              {!!$data->content!!}
              <p class="lead">  </p>
          <hr>
                     <!-- Pagination -->
                     <ul class="pagination justify-content-center mb-4">
                       
                        <li class="page-item">
                        <a class="page-link" href="{{route('content',['id'=>$page[0]['id']])}}">&larr; {{str_limit($page[0]['title'],10,'..')}}</a>
                        </li>
                       
                        <li class="page-item">  {{-- disabled --}}
                          <a class="page-link" href="{{route('content',['id'=>$page[1]['id']])}}">{{str_limit($page[1]['title'],10,'..')}} &rarr;</a>
                        </li>
                        
                      </ul>
        </div>


        <!-- Sidebar Widgets Column -->
        <div class="col-md-4">

          <!-- Search Widget -->
          <div class="card my-4">
            {{-- <h5 class="card-header">Search</h5> --}}
            <div class="card-body">
                <form action="/" method="get" accept-charset="utf-8">
                    {{csrf_field()}}
                          <div class="input-group">
                            <input type="text" class="form-control" name="keyword" placeholder="Search for..." value="<?=isset($_GET['keyword'])? $_GET['keyword'] : ''; ?>">
                            <span class="input-group-btn">
                              <button class="btn btn-secondary" type="submit">搜索</button>
                            </span>
                          </div>
                    </form>
            </div>
          </div>

          <!-- Categories Widget -->
          <div class="card my-4">
            <h5 class="card-header">Categories</h5>
            <div class="card-body">
              <div class="row">
                <div class="col-lg-6">
                  <ul class="list-unstyled mb-0">
        @foreach($cat as $v)
                    <li>
                      <a class="title" href="{{route('index',['keyword'=>$v->cat_name])}}"> {{$v->cat_name}} &nbsp;<small>({{$v->num}})</small></a>
                    </li>
        @endforeach
                  </ul>
                </div>
              </div>
            </div>
          </div>
          
          <!-- Side Widget -->
          <div class="card my-4">
            <h5 class="card-header">Side Widget</h5>
            <div class="card-body">
              You can put anything you want inside of these side widgets. They are easy to use, and feature the new Bootstrap 4 card containers!
            </div>
          </div>

        </div>

      </div>
      <!-- /.row -->

    </div>
    <!-- /.container -->

    <!-- Footer -->
    <footer class="py-5 bg-dark">
      <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; Your Website 2018</p>
      </div>
      <!-- /.container -->
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  </body>

</html>
