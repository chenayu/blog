<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Type;

class article extends Model
{
    protected  $fillable=['title','content','display','is_show','img','type_id','top'];

    public static function getArticle()
    {
       return $data = Article::select('articles.*','types.cat_name')->leftJoin('types','types.id','=','articles.type_id')->get();
    }
}
