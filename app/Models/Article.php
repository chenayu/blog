<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\Type;

class Article extends Model
{
    protected  $fillable=['title','content','display','is_show','img','type_id','top'];

    public static function getArticle($req)
    {
       $data = Article::select('articles.*','types.cat_name')
       ->leftJoin('types','types.id','=','articles.type_id');
       if($req->keyword){
           $data->where(function($q) use ($req){
               $q->where('title','like',"%$req->keyword%")
               ->orWhere('content','like',"%$req->keyword%")
               ->orWhere('cat_name','like',"%$req->keyword%");
           });
       }
       return $data->orderBy('articles.id','desc')
       ->paginate(5);
    }

    //前台首页取数据
    public static function getData($req)
    {
       $data = Article::where('is_show',1)->select('articles.*','types.cat_name')
       ->leftJoin('types','types.id','=','articles.type_id');
       if($req->keyword){
           $data->where(function($q) use ($req){
               $q->where('title','like',"%$req->keyword%")
               ->orWhere('content','like',"%$req->keyword%")
               ->orWhere('cat_name','like',"%$req->keyword%");
           });
       }
       return $data->orderBy('articles.id','desc')
    //    ->paginate(5)->withPath('custom/url');
    ->paginate(5);

    }

    //获取文章内容
    public static function getContent($id)
    {
        //判断是否是公开的
       $data = Article::where('is_show',1)->where('id',$id)->count();
       if($data)
       {
           return Article::find($id);
       
       }else{

           return false;
       }
    }

    //获取内容页上下一篇
    public static function getPage($id)
    {
        $num = Article::select('id')->count();
        
        $s= $id;
        for($s;$s>0;$s--)
        {        
            $data = Article::where('id',--$s)->where('is_show',1)->count(); 
            if($data)
                break;         
        }
   
        $x = $id;
        for($x;$x<$num;$x++)
        {        
            $data = Article::where('id',++$x)->where('is_show',1)->count(); 
            if($data)
                break; 
        }
 
        $page = Article::select('title','id')->whereIn('id',[$s,$x])->get();
        
        //取出的上下一遍保存在数组
        $str = [];
        foreach($page as $k=>$v)
        {
            $str[$k]['id']=$v['id'];
            $str[$k]['title']=$v['title'];
        }
        $str[]=$num; 
        return $str;
    }

    //设置是否公开
    public static function is_show($id)
    {
        $data = Article::select('is_show')->where('id',$id)->first();
        $num = $data['is_show']==1 ? 0 : 1;
        $ret = Article::where('id',$id)->update(['is_show'=>$num]);
        if($ret)
        {
            return $num;
        }
    }

    //设置是否置顶
    public static function top($id)
    {
        $data = Article::select('top')->where('id',$id)->first();
        $num = $data['top']==1 ? 0 : 1;
        $ret = Article::where('id',$id)->update(['top'=>$num]);
        if($ret)
        {
            return $num;
        }
    }
}
