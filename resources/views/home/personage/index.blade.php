<!DOCTYPE html>
<html>

<head>
    <!-- 页面meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>文章管理</title>
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
    
<!-- 编辑窗口 -->

  <div class="modal-dialog" style="width:1000px;" >
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			<h5 id="myModalLabel">添加</h5>
		</div>
    <form action="{{route('article.insert')}}" method="post" enctype="multipart/form-data">
			{{csrf_field() }}
		<div class="modal-body">							
			<table class="table table-bordered table-striped"  width="800px">
		      	  <tr>
		      		<td>联系方式:</td>
		      		<td><input  class="form-control" placeholder="联系方式" name="title"> </td>
                  </tr>

                  <tr>
                        <td>内容:</td>
                        <td><textarea name="content" id="editor" cols="30" rows="10"></textarea> </td>
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
<script>
    $('.form-control').click(function (){
        alert(1);
        $.ajax({
        type:"GET",
        url:"/top/"+id,
        dataType:"json",
        success:function(data)
        {
            alert(data);
        }
    })
    })

</script>
