<?php
namespace controllers;

use models\Blog;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class BlogController
{


    public function makeExcel()
    {

        $blog = new \models\Blog;
        $data = $blog->getNew();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // 设置第1行内容
        $sheet->setCellValue('A1', '标题');
        $sheet->setCellValue('B1', '内容');
        $sheet->setCellValue('C1', '发表时间');
        $sheet->setCellValue('D1', '是发公开');
    
        // 从第2行写入数据
        $i = 2;
        foreach($data as $v)
        {
            $sheet->setCellValue('A'.$i, $v['title']);
            $sheet->setCellValue('B'.$i, $v['content']);
            $sheet->setCellValue('C'.$i, $v['created_at']);
            $sheet->setCellValue('D'.$i, $v['is_show']==1?'公开':'私有');
    
            $i++;
        }
        $date = date('Ymd');
        // 生成 Excel 文件
        $writer = new Xlsx($spreadsheet);
        $writer->save(ROOT . 'excel/'.$date.'.xlsx');
        
        $file = ROOT . 'excel/'.$date.'.xlsx';
    // 下载时文件名
    $fileName = '最新的20条日志-'.$date.'.xlsx';

    // 告诉浏览器这是一个二进程文件流    
    Header ( "Content-Type: application/octet-stream" ); 
    // 请求范围的度量单位  
    Header ( "Accept-Ranges: bytes" );  
    // 告诉浏览器文件尺寸    
    Header ( "Accept-Length: " . filesize ( $file ) );  
    // 开始下载，下载时的文件名
    Header ( "Content-Disposition: attachment; filename=" . $fileName );    

    // 读取服务器上的一个文件并以文件流的形式输出给浏览器
    readfile($file);

    }

    // 日志列表
    public function index()
    {
        $blog = new Blog;
        $data = $blog->search();
        view('blogs.index', $data);
    }
    public function content_to_html()
    {
        $blog = new Blog;
        $blog->content2html();
    }
    public function index2html()
    {
        $blog = new Blog;
        $blog->index2html();
    }

    public function display()
    {
        $id = (int)$_GET['id'];
        $blog = new Blog;
        echo $blog->getDisplay($id);
        
    }

    public function displayToDb()
    {
        $blog = new Blog;
        $blog->displayToDb();
    }

    //显示添加日志表单
    public function create()
    {
        view('blog.create');
    }

    //删除日志
    public function delete()
    {
        $id = $_POST['id'];
        $blog = new Blog;
        $blog->del($id);
        echo "删除成功!";
        $blog->deleteHtml($id);
        // message('删除成功',2,'/index/index');
    }

    public function edit()
    {
        $id = $_GET['id'];
        $blog = new Blog;
        $data = $blog->find($id);
        view('blogs.edit',['data'=>$data]);
    }

    public function update()
    {
        $title = $_POST['title'];
        $content=$_POST['content'];
        $is_show = $_POST['is_show'];
        $id = $_POST['id'];
        $blog = new Blog;
        $blog->update($title,$content,$is_show,$id);

        if($is_show ==1)
        {
            $blog->makeHtml($id);

        }else{
            $blog->deleteHtml($id);
        }
    }
}
