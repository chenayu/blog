<?php 
namespace controllers;
use models\Blog;
    class BlogController
    {
        public function index()
        {
            $blog = new Blog;
            $data = $blog->search();

            foreach($data as $v)
            { 
            view('blogs.index',['data'=>$data]);
            $str = ob_get_contents();
            file_put_contents(ROOT.'public/contents/'.$v['id'].'html',$str);
            ob_clean();
        }
        }
    }
?>