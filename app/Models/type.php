<?php

namespace App\Models;
use DB;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    public $timestamps = false;

    //取出所有分类
    public static function getType()
    {
        return Type::get();
    }

    //取出分类和分类的文章数
    public static function getCategory()
    {
       return Type::select('types.*',DB::raw('COUNT(types.id) as num'))
       ->leftJoin('articles','types.id','=','articles.type_id')
       ->groupBy('types.id')
       ->get();
    }
   
}
