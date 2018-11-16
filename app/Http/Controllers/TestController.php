<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Type;
use DB;

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
        var_dump($data);
        // select count(a.id) c,a.* from types a LEFT JOIN articles b on b.type_id=a.id group By a.id
     }

     public function test($id=2)
     {
        // $data = Article::where('is_show',1)->where('id',$id)->first();
        // if($data==NULL)
        // {
        //     return redirect()->route('index');
        // }
       echo $id = session('id');
    //    $date = date('Y-m');
    //    @mkdir('access');
    //    @mkdir('access/'.$date);


      
     }

}
