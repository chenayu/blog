<!DOCTYPE html>
<html>

<head>
    <!-- 页面meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>文章修改</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no" name="viewport">
    <link rel="stylesheet" href="/plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/plugins/adminLTE/css/AdminLTE.css">
    <link rel="stylesheet" href="/plugins/adminLTE/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="/css/style.css">
	<script src="/plugins/jQuery/jquery-2.2.3.min.js"></script>
    <script src="/plugins/bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="/plugins/select2/select2.css" />
    <link rel="stylesheet" href="/plugins/select2/select2-bootstrap.css" />
    <script src="/plugins/select2/select2.min.js" type="text/javascript"></script>

</head>

<body class="hold-transition skin-red sidebar-mini" >

  <div class="modal-dialog" style="width:1000px;" >
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			<h5 id="myModalLabel">修改</h5>
		</div>
    <form action="{{route('article.update',['id'=>$data->id])}}" method="post" enctype="multipart/form-data">
			{{csrf_field() }}
		<div class="modal-body">							
			<table class="table table-bordered table-striped"  width="800px">
		      	<tr>
		      		<td>标题:</td>
                  <td><input  class="form-control" placeholder="标题" name="title" value="{{$data->title}}">  </td>
                  </tr>	
                  <tr>
                      <td>类别:</td>
                      <td>
                      <select name="type_id">
                            @foreach($cat as $v)
                      <option value="{{$v->id}}"  @if($v->id==$data->type_id) selected="selected" @else @endif>{{$v->cat_name}}</option>
                          @endforeach
                      </select>
                    </td>  
                  </tr>
                  <tr>
                    <td>是否公开</td>
                    <td>
                        <input type="radio" name="is_show" value="1" @if($data->is_show==1) checked @else @endif>公开
                        <input type="radio" name="is_show" value="0" @if($data->is_show==0) checked @else @endif>隐藏
                    </td>
                  </tr>

                  <tr>
                    <td>置顶</td>
                    <td>
                        <input type="radio" name="top" value="1" @if($data->top==1) checked @else @endif>是
                        <input type="radio" name="top" value="0" @if($data->top==0) ehecked @else @endif>否
                    </td>
                  </tr>

                  <tr>
                        <td>文章内容:</td>
                  <td><textarea name="content" id="editor" cols="30" rows="10">{{$data->content}}</textarea> </td>
                    </tr>		   
			 </table>	
		</div>
		<div class="modal-footer">						
			<input type="submit" class="btn btn-success" value="保存">		
			<button class="btn btn-default" data-dismiss="modal" aria-hidden="true">关闭</button>
		</div>
	</form>
	  </div>
	</div>

  
</body>

</html>
<link rel="stylesheet" type="text/css" href="/simditor-2.3.6/styles/simditor.css" />		
<script type="text/javascript" src="/simditor-2.3.6/scripts/jquery.min.js"></script>
<script type="text/javascript" src="/simditor-2.3.6/scripts/module.js"></script>
<script type="text/javascript" src="/simditor-2.3.6/scripts/hotkeys.js"></script>
<script type="text/javascript" src="/simditor-2.3.6/scripts/uploader.js"></script>
<script type="text/javascript" src="/simditor-2.3.6/scripts/simditor.js"></script>
<script>
  //文章编辑器
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
			      url:'/upload', 
			      params:'null',
			      fileKey:'image',
			      connectionCount:3,
			      leaveConfirm: '文件上传中，真要离开吗？'
			  }
        });
</script>