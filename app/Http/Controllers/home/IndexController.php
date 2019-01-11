<?php

namespace App\Http\Controllers\home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Type;

class IndexController extends Controller
{
    //获取首页数据
    public function index(Request $req)
    {
        $data = Article::getData($req);
        $cat = Type::getCategory();
        return view('home.index.index',['data'=>$data,'cat'=>$cat]);
    }

    //获取文章内容页的数据
    public function content($id)
    {   
        //获取分类
        $cat = Type::getCategory();
        //判断是否公开
        $con = Article::getContent($id);
        if(!$con)
        {
            //如果不是就跳回首页
            return redirect()->route('index');
        }

        //获取上一页下一页
        $page = Article::getPage($id);
        // echo '<pre>';
        // var_dump($page);
        // exit;

        return view('home.index.content',['data'=>$con,'cat'=>$cat,'page'=>$page]);
    }

    //关于
    public function about(){
        return view('home.index.about');
    }
}
