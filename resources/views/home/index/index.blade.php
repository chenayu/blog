<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="/css/style.css" media="screen" type="text/css">
  <!--[if lt IE 9]><script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
  <script src="/js/jquery.min.js"></script>
  <title>Document</title>
</head>

<body>

  <div class="navtop">
    <div class="navbar">
      <ul class="nav">
        <li class="item">
          <a href="#">Home</a>
        </li>

        <li class="item">
          <a href="#">Blog</a>
        </li>

        <li class="item">
          <a href="#">About</a>
        </li>

        <li class="item">
          <!-- <a href="#" class="contact">Contact</a> -->
          <a href="#">Contact</a>

        </li>
      </ul>

      <div class="logo">
        <img src="#">
      </div>
    </div>
  </div>

  <div id="content" class="inner">
    <div id="main-col" class="alignleft">
      <div id="wrapper">
          @foreach($data as $v)
        <article class="post">
          <div class="post-content">

            
            <header>
              <!-- <div class="icon"></div> -->

              <h1 class="title">
              <a href="/index/content?id=">{{$v->title}}</a>
              </h1>

              <time datetime="xx2">
              <a href="">{{$v->created_at}}</a>
              </time>
            </header>

            <div class="entry">
              {{$v->content}}
            </div>
         


            <footer>
              <div class="alignleft">
                <a href="" class="more-link">
                {{$v->cat_name}}</a>
              </div>
              <div class="clearfix">xx</div>
            </footer>

          </div>
        </article>
        @endforeach
        <nav id="pagination">

          <div class="clearfix"></div>
        </nav>
      </div>

    </div>
    <aside id="sidebar" class="alignright">
      <!-- 搜索框 -->
      <div class="search">
        <form action="" method="get" accept-charset="utf-8">
          <input type="text" name="keyword" results="0" value="xx5" placeholder="Search">
          <input class="inp" type="submit" value="搜索">
        </form>
      </div>
      <!-- 搜索框end -->


      <div class="widget tag">
        <h3 class="title">Tags</h3>
        <ul class="entry">
            @foreach($cat as $v)
          <li><a href="">
          {{$v->cat_name}}</a><small>
          {{$v->num}}</small></li>
              @endforeach
        </ul>
      </div>

      <div class="widget twitter">
        <h3 class="title">Tweets</h3>
        <ul id="tweets"></ul>
      </div>

      <script type="text/javascript">
        var twitter_stream = ['tommy351', 5, false];
      </script>
      <!-- <script src="js/twitter.js"></script> -->

    </aside>
  
    <div class="clearfix"></div>
  </div>
  <footer id="footer" class="inner">
    <div class="list-page"> 2 条 1/1 页
    </div>
    <div class="alignleft">

      &copy; 2018 xin

    </div>
    <div class="clearfix"></div>
  </footer>
  <!-- <script src="js/jquery.imagesloaded.min.js"></script> -->
  <!-- <script src="js/gallery.js"></script> -->




  <link rel="stylesheet" href="css/jquery.fancybox.css" media="screen" type="text/css">
  <!-- <script src="js/jquery.fancybox.pack.js"></script> -->
  <!-- <script type="text/javascript">
        (function ($) {
          $('.fancybox').fancybox();
        })(jQuery);
      </script> -->


  <!-- <a href="https://github.com/tommy351/hexo-theme-light" target="_blank"><img style="position: absolute; top: 0; right: 0; border: 0;"
          src="https://s3.amazonaws.com/github/ribbons/forkme_right_gray_6d6d6d.png" alt="Fork me on GitHub"></a> -->
</body>

</html>
<script src="/js/base.js"></script>