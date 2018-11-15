<?php

namespace App\Models;
use DB;

use Illuminate\Database\Eloquent\Model;

class type extends Model
{
    public $timestamps = false;

    public static function getCategory(){

       return Type::select('types.*',DB::raw('COUNT(types.id) as num'))
       ->leftJoin('articles','types.id','=','articles.type_id')
       ->groupBy('types.id')
       ->paginate(5);
    }
   
}
