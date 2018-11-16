<?php

namespace App\Http\Controllers\home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Type;
class IndexController extends Controller
{
    public function index(Request $req)
    {
        $data = Article::getData($req);
        $cat = Type::getCategory();
        return view('home.index.index',['data'=>$data,'cat'=>$cat]);
    }
}
