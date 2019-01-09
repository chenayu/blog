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
        {{-- <a class="navbar-brand" href="#">Mxy</a> --}}
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link nav-font" href="{{route('index')}}">Home
                <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">About</a>
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

                {{-- 标题 --}}
          {{-- <h4 class="mt-4">about</h4> --}}

          <!-- Author -->
          {{-- <p class="lead">
            by
            <a href="#">Start Bootstrap</a>
          </p> --}}

          <hr>

          <!-- Date/Time -->
          {{-- <p>热爱这个世界</p> --}}

          <hr>

          <!-- Preview Image -->
          {{-- <img class="img-fluid rounded" src="http://placehold.it/900x300" alt=""> --}}

          {{-- <hr> --}}

          <!-- Post Content -->
              {{-- {!!$data->content!!} --}}
              <p class="lead">  </p>

          <hr>

          <!-- Comments Form -->
           <div class="card my-4">
            {{-- <h5 class="card-header">Leave a Comment:</h5> --}}
            <h5 class="card-header">:</h5>

              @if($errors->any())
                      <span>
                @foreach($errors->all() as $e)
                        {{ $e }}
               @endforeach
                      </span>
                    @endif
      
            <div class="card-body">
              {{-- 发送信息到邮件 --}}
            <form action="{{route('mail')}}" method="post">
                {{csrf_field()}}
                <div class="form-group">
                  <textarea class="form-control" rows="3" name="message"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
              </form>

            </div>
          </div>
        </div>

        <!-- Sidebar Widgets Column -->
        <div class="col-md-4">

 
         

          <!-- Categories Widget -->
        
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
        <p class="m-0 text-center text-white"> &copy; 2018</p>
      </div>
      <!-- /.container -->
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  </body>

</html>
