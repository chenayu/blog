<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="/plugins/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="/css/style.css" media="screen" type="text/css">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!--[if lt IE 9]><script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
  <script src="/js/jquery.min.js"></script>
  <title>Document</title>
</head>

<body>

  {{-- <ul class="nav nav-pills">
    <li role="presentation" class="active"><a href="#">Home</a></li>
    <li role="presentation"><a href="#">Profile</a></li>
    <li role="presentation"><a href="#">Messages</a></li>
  </ul> --}}

  <table>
     
  </table>

  <tbody>
      {{-- @foreach($data as $v) --}}
    <tr>
      <td>
          {{-- <div class="row">
              <div class="col-xs-6 col-md-3">
                <a href="#" class="thumbnail">
                  <img src="{{ Storage::url($v->img_s)}}" alt="...">
                </a>
              </div>
              {{ Storage::url($v->img_s)}}
              ...
            </div> --}}
      </td>

    </tr>
    {{-- @endforeach --}}
  </tbody>

  <div id="editor">
      <p>欢迎使用 <b>wangEditor</b> 富文本编辑器</p>
  </div>

  
{{-- <form action="{{route("album.uploads")}}" method="post"  enctype="multipart/form-data">
		{{ csrf_field() }}
    <input type="file" name="img">
    <input type="submit" value="t">
  </form> --}}


</body>
</html>
<script src="/js/base.js"></script>
<script type="text/javascript" src="js/wangEditor.min.js"></script>
<script type="text/javascript">
 
    var E = window.wangEditor
    var editor = new E('#editor')
    // 或者 var editor = new E( document.getElementById('editor') )
    // 隐藏“网络图片”tab
    editor.customConfig.showLinkImg = false
    //显示上传本地图片按钮
    editor.customConfig.debug = true
    editor.customConfig.uploadImgServer = '/album/uploads'
    editor.customConfig.uploadFileName = 'img'

    editor.customConfig.uploadImgHeaders = {
    'Accept':$('meta[name ="csrf-token"]').attr('content')
}
    editor.create()
</script>
