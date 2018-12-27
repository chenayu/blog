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
 
  </tbody>

  <div id="editor">
      <p>欢迎使用 <b>wangEditor</b> 富文本编辑器</p>
  </div>

  
 


</body>
</html>
<script src="/js/base.js"></script>
<link rel="stylesheet" type="text/css" href="/simditor-2.3.6/styles/simditor.css" />		
<script type="text/javascript" src="/simditor-2.3.6/scripts/jquery.min.js"></script>
<script type="text/javascript" src="/simditor-2.3.6/scripts/module.js"></script>
<script type="text/javascript" src="/simditor-2.3.6/scripts/hotkeys.js"></script>
<script type="text/javascript" src="/simditor-2.3.6/scripts/uploader.js"></script>
<script type="text/javascript" src="/simditor-2.3.6/scripts/simditor.js"></script>

<script type="text/javascript">
$.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
 var editor = new Simditor({
		  textarea: $('#editor'),
		  toolbar:[
					    'title',
					    'bold',
					    'italic',
					    'underline',
					    'strikethrough',
					    'fontScale',
					    'color',
					    'ol'    ,       
					    'ul'         ,
					    'blockquote',
					    'code'       ,
					    'table',
					    'link',
					    'image',
					    'hr'          , 
					    'indent',
					    'outdent',
					    'alignment'
					    ],
                  upload:{
			      url:'/album/uploads', 
			      params:'null',
			      fileKey:'img',
			      connectionCount:3,
			      leaveConfirm: '文件上传中，真要离开吗？'
			  }
        });
</script>
