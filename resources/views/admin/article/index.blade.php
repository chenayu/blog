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
  <!-- .box-body -->
                
                    <div class="box-header with-border">
                        <h3 class="box-title">文章管理</h3>
                    </div>

                    <div class="box-body">

                        <!-- 数据表格 -->
                        <div class="table-box">

                            <!--工具栏-->
                            <div class="pull-left">
                                <div class="form-group form-inline">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-default" title="新建" data-toggle="modal" data-target="#editModal" ><i class="fa fa-file-o"></i> 新建</button>
                                        <button type="button" class="btn btn-default" title="删除"><i class="fa fa-trash-o"></i> 删除</button>
                                       
                                        <button type="button" class="btn btn-default" title="刷新" onclick="window.location.reload();"><i class="fa fa-refresh"></i> 刷新</button>
                                    </div>
                                </div>
                            </div>
                            <div class="box-tools pull-right">
                                <div class="has-feedback">
                                        <form action="">
                                                关键字：
                                                <input type="text" name="keyword" id="" value="">
                                                <a href="#">重置</a>
                                                <input class="btn btn-default" type="submit" value="搜索">
                                            </form>
                                </div>
                            </div>
                            <!--工具栏/-->

			                  <!--数据列表-->
			                  <table id="dataList" class="table table-bordered table-striped table-hover dataTable">
			                      <thead>
			                          <tr>
			                              <th class="" style="padding-right:0px; width:20px;" >
			                                  <input id="selall" type="checkbox" class="icheckbox_square-blue">
			                              </th> 
                                          <th class="sorting_asc">ID</th>
									      <th class="sorting">标题</th>
										  <th class="sorting">类型</th>
										  <th class="sorting">状态</th>
										  {{-- <th class="sorting">访问</th> --}}
                                          <th class="sorting">创建日期</th>												     						
										  <th class="text-center">操作</th>
										  <th class="sorting"></th>
			                          </tr>
			                      </thead>
			                      <tbody>
									  @foreach($data as $v)
			                          <tr>
                                      <td><input  type="checkbox"></td>	
                                      <td>{{$v->id}}</td>		                              
                                      <td>{{$v->title}}</td>
                                      <td>{{$v->cat_name}}</td>
                                      <td>{{$v->is_show}}</td>
                                      <td>{{$v->created_at}}</td>		                                                                 
		                                  <td class="text-center">
                                          @if($v->is_show==1)
                                          <a href="javascript:;" onClick="show({{$v->id}})" class="btn bg-olive btn-xs is_show{{$v->id}}">隐藏</a>
                                          @else 
                                          <a href="javascript:;" onClick="show({{$v->id}})" class="btn bg-olive btn-xs is_show{{$v->id}}">公开</a>
                                          @endif
                                          {{-- 置顶 --}}
                                          @if($v->top==1)
                                          <a href="javascript:;" onClick="top1({{$v->id}})" class="btn bg-olive btn-xs top{{$v->id}}">取消置顶</a>
                                          @else 
                                          <a href="javascript:;" onClick="top1({{$v->id}})" class="btn bg-olive btn-xs top{{$v->id}}">置顶</a>
                                          @endif
                                          {{-- 置顶 --}}

									      <a href="{{route('article.edit',['id'=>$v->id])}}" class="btn bg-olive btn-xs">修改</a>				 
										  <a href="{{route('article.delete',['id'=>$v->id])}}" class="btn bg-olive btn-xs">删除</a>                                            
		                                  </td>
									  </tr>
									  @endforeach
								 
			                      </tbody>
                              </table>   
                              <div class="list-page"> {{ $data->links() }} </div>
                                               
                        </div>         
                     </div>
                    <!-- /.box-body -->		    
<!-- 编辑窗口 -->

<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
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
		      		<td>标题:</td>
		      		<td><input  class="form-control" placeholder="标题" name="title">  </td>
                  </tr>	
                  <tr>
                      <td>类别:</td>
                      <td>
                      <select name="type_id">
                            @foreach($cat as $v)
                      <option value="{{$v->id}}">{{$v->cat_name}}</option>
                          @endforeach
                      </select>
                    </td>  
                  </tr>
                  <tr>
                    <td>是否公开</td>
                    <td>
                        <input type="radio" name="is_show" value="1" checked>公开
                        <input type="radio" name="is_show" value="0">隐藏
                    </td>
                  </tr>

                  <tr>
                    <td>置顶</td>
                    <td>
                        <input type="radio" name="top" value="0"  checked>否
                        <input type="radio" name="top" value="1">是

                        
                    </td>
                  </tr>

                  <tr>
                        <td>文章内容:</td>
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

    // 是否公开
    function show(id){
        // alert(id);
         $(function () {
        $.ajax({
            type:"GET",
            url:"/is_show/"+id,
            dataType:"json",
            success:function(data)
            {
                if(data==1)
                {
                    $(".is_show"+id).html('隐藏');
                }else{
                    $(".is_show"+id).html('公开');
                }
            }
          })
       })
    }  

    //是否置顶
    function top1(id){
        alert(id);
         $(function () {
        $.ajax({
            type:"GET",
            url:"/top/"+id,
            dataType:"json",
            success:function(data)
            {
                if(data==1)
                {
                    $(".top"+id).html('取消置顶');
                }else{
                    $(".top"+id).html('置顶');
                }
            }
          })
       })
    }  


//编辑器
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