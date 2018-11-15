<!DOCTYPE html>
<html>

<head>
    <!-- 页面meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>分类管理</title>
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
                    <div class="box-header with-border">
                        <h5 class="box-title">分类管理</h5>
                    </div>

                    <div class="box-body">

                        <div class="table-box">

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

			                  <table id="dataList" class="table table-bordered table-striped table-hover dataTable">
			                      <thead>
			                          <tr>
			                              <th class="" style="padding-right:0px; width:20px;" >
			                                  <input id="selall" type="checkbox" class="icheckbox_square-blue">
			                              </th> 
										  <th class="sorting_asc">ID</th>
									      <th class="sorting">名称</th>
									      <th class="sorting">数</th>											     						
										  <th class="text-center">操作</th>
										  <th class="sorting"></th>
			                          </tr>
			                      </thead>
			                      <tbody>
									  @foreach($data as $v)
			                          <tr>
			                          <td><input  type="checkbox"></td>			                              
									  <td>{{$v->id}}</td>
                                      <td>{{$v->cat_name}}</td>
									  <td>{{$v->num}}</td>
									  <td> </td>		 
                                                                
		                                  <td class="text-center">                                           
										  {{-- <a href="{{route('article.edit',['id'=>$v->id])}}" class="btn bg-olive btn-xs">修改</a>					  --}}
										  <a href="{{route('category.delete',['id'=>$v->id])}}" class="btn bg-olive btn-xs">删除</a>                                     
											                                              
		                                  </td>
									  </tr>
									  @endforeach
									  <td></td>	
			                      </tbody>
							  </table>
                              <div class="list-page"> {{ $data->links() }} </div>
							  
                        </div>
                     </div>
                                    
<!-- 编辑窗口 -->

<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
  <div class="modal-dialog" style="width:1000px;" >
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			<h5 id="myModalLabel">添加</h5>
		</div>
	<form action="{{route('category.insert')}}" method="post" enctype="multipart/form-data">
			{{csrf_field() }}
		<div class="modal-body">							
			<table class="table table-bordered table-striped"  width="800px">
		      	  <tr>
		      		<td>标题:</td>
		      		<td><input  class="form-control" placeholder="商品类型" name="cat_name">  </td>
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