<!DOCTYPE HTML>
<html>

<head>
  <meta charset="utf-8">

  <title>Lorem Ipsum | Light</title>
  <meta name="author" content="SkyArrow">

  <meta name="description" content="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed enim turpis, sodales ac ullamcorper quis, blandit sed augue. Vivamus eu tortor id elit suscipit convallis. Nam lorem nunc, tristique eget mattis eget, pharetra in est. Pellentesque ac nisi nulla, et vulputate lectus. Ut egestas sodales tortor, vel fringilla mauris ornare quis. Ut nunc nulla, blandit id laoreet facilisis, lobortis eget mauris. Morbi lorem urna, ornare condimentum faucibus at, ullamcorper non turpis.
    

All the world&amp;#39;s a stage, and all the men and women merely players: they have their exits and their entrances; and one man in his time plays many parts…
William ShakespeareAs You Like It

Ut dui velit, dapibus vitae scelerisque id, tincidunt vel arcu. Aenean ornare leo in orci pretium eu porttitor nibh venenatis. Curabitur rutrum dolor ac sapien vestibulum interdum in ut felis. Cras ut nisl justo. Suspendisse a lectus enim, vel rutrum urna. Morbi eget sem dui, ac consectetur turpis. Vestibulum ultrices ornare augue at bibendum. Etiam viverra ligula leo. Vestibulum eleifend nulla id leo convallis at bibendum lacus hendrerit. Maecenas placerat feugiat urna, gravida dignissim odio ultrices nec. Maecenas quis adipiscing erat.">


  <meta name="viewport" content="width=device-width; initial-scale=1; maximum-scale=1">

  <meta property="og:title" content="Lorem Ipsum" />
  <meta property="og:site_name" content="Light" />

  <link rel="alternate" href="/hexo-theme-light/atom.xml" title="Light" type="application/atom+xml">
  <link rel="stylesheet" href="/css/style.css" media="screen" type="text/css">
  <!--[if lt IE 9]><script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
  <script src="/js/jquery.min.js"></script>

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


        <article class="post">

          <div class="post-content">

            <header>

              <div class="icon"></div>
              <time datetime="2011-08-09T09:21:37.000Z"><a href="/hexo-theme-light/2011/08/09/lorem-ipsum/">
                  xx1</a></time>

              <h4 class="title">
                {{$data->title}}
              </h4>
            </header>
            <div class="entry">
              {{$data->content}}
            </div>
            <footer>
              <div class="tags">
                <a href="/hexo-theme-light/tags/dolor/">dolor</a>, <a href="/hexo-theme-light/tags/amet/">amet</a>
              </div>


              <div class="addthis addthis_toolbox addthis_default_style">

                <a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>


                <a class="addthis_button_tweet"></a>


                <a class="addthis_button_google_plusone" g:plusone:size="medium"></a>


                <a class="addthis_button_pinterest_pinit" pi:pinit:layout="horizontal"></a>

                <a class="addthis_counter addthis_pill_style"></a>
              </div>
              <script type="text/javascript" src="js/addthis_widget.js"></script>


              <div class="clearfix"></div>
            </footer>
          </div>
        </article>

      </div>
    </div>
    <aside id="sidebar" class="alignright">
      <!-- 搜索框 -->
      <div class="search">
        <form action="/index/index" method="get" accept-charset="utf-8">
          <input type="text" name="keyword" results="0" value="<?=isset($_GET['keyword'])? $_GET['keyword'] : ''; ?>"
            placeholder="Search">
          <input class="inp" type="submit" value="搜索">
        </form>
      </div>
      <!-- 搜索框end -->

      <div class="widget tag">
        <h3 class="title">Tags</h3>
        <ul class="entry">
        @foreach($cat as $v)
          <li><a href="/hexo-theme-light/tags/amet/">
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
      <script src="/js/twitter.js"></script>

    </aside>
    <div class="clearfix"></div>
  </div>
  <footer id="footer" class="inner">
 
    
      <div class="list-page">
        <a href="{{route('content',['id'=>$page[0]['id']])}}">  {{$page[0]['title']}} </a>
      </div>

      <div class="list-page">
        <a href="{{route('content',['id'=>$page[1]['id']])}}">  {{$page[1]['title']}} </a>
      </div>
    <div class="alignleft">

      &copy; 2018 SkyArrow

    </div>
    <div class="clearfix"></div>
  </footer>
  <script src="/js/jquery.imagesloaded.min.js"></script>
  <script src="/js/gallery.js"></script>




  <link rel="stylesheet" href="/css/jquery.fancybox.css" media="screen" type="text/css">
  <script src="/js/jquery.fancybox.pack.js"></script>
  <script type="text/javascript">
    (function ($) {
      $('.fancybox').fancybox();
    })(jQuery);
  </script>


  <!-- <a href="https://github.com/tommy351/hexo-theme-light" target="_blank"><img style="position: absolute; top: 0; right: 0; border: 0;"
      src="https://s3.amazonaws.com/github/ribbons/forkme_right_gray_6d6d6d.png" alt="Fork me on GitHub"></a> -->
</body>

</html>