<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Type;
use App\Models\Tags;
use App\Models\Article_tags;

class ArticleController extends Controller
{
    public function index(Request $req)
    {
        
        $type = Type::getType(); //取出分类
        $data = Article::getArticle($req); //取出文章
        return view('admin.article.index',['cat'=>$type,'data'=>$data]);
    }

    //添加
    public function insert(Request $req)
    {
        $article = new Article();
        $article->fill($req->all());
        $article->save();
        //获取已经添加的文章id
        $article_id = $article->id;

        //判断标签是否为空
        

        //把接收到的字符串以,分开成数组
        $str = str_replace("，",",",$req->tags);
        $tags = explode(',',$str);
        //循环把标签插入数据库
        foreach($tags as $v)
        {
            //判断接收的标签是否存在
            $tag = Tags::where('tags',$v)->first();
            $at = new Article_tags();
            //如果存在取出已存在的id存入标签关联表
            if($tag)
            {
                $at->tags_id = $tag['id'];
                $at->article_id = $article_id;
            }else{
                //如果不存在就添加到标签表
                $tag = new Tags();
                $tag->tags = $v;
                $tag->save();
                //取出刚插入的标签id存入到关联表
                $tag_id = $tag->id;
               
                $at->article_id = $article_id;
                $at->tags_id = $tag_id;
            }
            $at->save(); 
        }

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
