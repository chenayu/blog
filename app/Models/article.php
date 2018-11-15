<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Type;

class article extends Model
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
       ->paginate(10);
    }

    //是否公开
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

    //是否置顶
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
