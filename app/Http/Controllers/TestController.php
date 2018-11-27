<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Type;
use App\Models\Tags;
use App\Models\article_tags;
use DB;
use App\Http\Controllers\PinyinController;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Storage;

class TestController extends Controller
{
    public function test1($id=5)
    {
        $data = Article::select('is_show')->where('id',$id)->first();
        $num = $data['is_show']==1 ? 0 : 1;
        $ret = Article::where('id',$id)->update(['is_show'=>$num]);
        if($ret)
        {
            return $num;
        }
        // var_dump($data['is_show']);
    }

    public function test2(){
        $data =  Type::select('types.*',DB::raw('COUNT(*) as num'))->leftJoin('articles','types.id','=','articles.type_id')->groupBy('types.id')->get();
        // select count(a.id) c,a.* from types a LEFT JOIN articles b on b.type_id=a.id group By a.id
     }

     //根据当前文章的id获取上一篇下一篇文章
     public function test3($id=19)
     {
         //取出总的记录数
        $num = Article::select('id')->count();
        
        $s= $id;
        for($s;$s>0;$s--)
        {    //根据当前id找到他的上一篇且公开的    
            $data = Article::where('id',--$s)->where('is_show',1)->count(); 
            if($data)
                break;         
        }
        echo $s;
   
        $x = $id;
        for($x;$x<$num;$x++)
        {        
            $data = Article::where('id',++$x)->where('is_show',1)->count(); 
            if($data)
                break; 
        }
        echo $x;
 
        $page = Article::select('title','id')->whereIn('id',[$s,$x])->get();
        
        $str = [];
        foreach($page as $k=>$v)
        {
            $str[$k]['id']=$v['id'];
            $str[$k]['title']=$v['title'];

        }
        $str[]=++$num;

        echo '<pre>';
        var_dump($str);
  
 
     }

     public function test22()
     {
        

         $article = new Article();
         $article->title = rand(1,9);
         $py = new PinyinController();
         $pinyin = $py->getpy("糗事",true);
         $article->content = $pinyin;
         $article->save();
         $id = $article->id;
         $rest = ['a','b','c'];

         foreach($rest as $v)
         {
             $tags = new Tags();
             $tags->tags=$v;
             $tags->save();
             $tags_id = $tags->id;

             $tags = new article_tags;
          
             $tags->article_id = $id;
             $tags->tags_id = $tags_id;
             $tags->save();
             
         }

     }

     public function test5()
     {
        $article = Article::get();
        foreach($article as $k=>$v)
        {
            $user = Article_tags::select('tags.*')->where('article_id',$v['id'])->leftJoin('tags','tags.id','=','article_tags.tags_id')->get();        
            $tag = [];
            foreach($user as $k1=>$v1)
            {
                $tag[$k1]=$v1['tags'];
            }
            $article[$k]['tags']=$tag;
        }
        
        echo '<pre>';
        // return $article;
        var_dump($article);
        exit;
    
        foreach($article as $v)
        {

           echo $v['id'];

            $user = Article_tags::where('article_id',$v)->leftJoin('tags','tags.id','=','articles.id')->get();
            $v[''];
            //SELECT * FROM article_tags a LEFT JOIN tags b ON a.tags_id = b.id
        }
        
        // echo '<pre>';
     }

     //图像处理
     public function test()
     {
    
     
        $manager = new ImageManager(array('driver' => 'GD')); 
        $image = $manager->make('uploads/uploads/20181127/1uaJgtq9nCX108wTRuXp3cfNPZihPUJOCThY2Ukr.jpeg');
        $c = $manager->make('uploads/uploads/20181127/1uaJgtq9nCX108wTRuXp3cfNPZihPUJOCThY2Ukr.jpeg')->width();
        $d = $manager->make('uploads/uploads/20181127/1uaJgtq9nCX108wTRuXp3cfNPZihPUJOCThY2Ukr.jpeg')->height();
        
        $image->resize(300, null, function ($c) {
            $c->aspectRatio();
        });
        // echo $c.$d;
        // var_dump($c,$d);
        // exit;
        $c = $image->save('uploads/new_avatar.jpeg');

        // echo asset('uploads/file.txt');
      
        // uploads/20181127/TMCO1GEwqHf8WmlGzm3ZEJXLeArv0a6Ik4udFRli.jpeg

     }



}
