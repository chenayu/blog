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
        $cat = Type::getCategory();
        $con = Article::getContent($id);
        if(!$con)
        {
            return redirect()->route('index');
        }
        $page = Article::getPage($id);

        return view('home.index.content',['data'=>$con,'cat'=>$cat,'page'=>$page]);
    }
}
