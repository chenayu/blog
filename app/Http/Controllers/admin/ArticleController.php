<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Type;

class ArticleController extends Controller
{
    public function index(Request $req)
    {
        
        $type = Type::getType(); //取出分类
        $data = Article::getArticle($req); //取出文章
        return view('admin.article.index',['cat'=>$type,'data'=>$data]);
    }
    use App\Models\Tags;

    //添加
    public function insert(Request $req)
    {
        $article = new Article();
        $article->fill($req->all());
        $id = $article->save();
        return redirect()->route('article');
    }

    //显示修改页
    public function edit($id)
    {
        $data = Article::find($id);
        $cat = Type::getCategory();
        return view('admin.article.edit',['data'=>$data,'cat'=>$cat]);
    }

    //处理修改表单
    public function update(Request $req,$id)
    {
        $art = Article::find($id);
        $art->fill($req->all());
        $art->save();
        return redirect()->route('article');
    }

    //删除
    public function delete($id)
    {
        $data = Article::find($id);
        $data->delete();
        return redirect()->route('article');
    }

    //是否公开
    public function is_show($id)
    {
    //    echo $data = 1;
    //    exit;
        echo $data = Article::is_show($id);
    }

    //是否置顶
    public function top($id)
    {
        echo $data = Article::top($id);
    }
}
