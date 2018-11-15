<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Type;
class CategoryController extends Controller
{
    public function index()
    {
        return view('admin.category.index');
    }

    public function insert(Request $req)
    {
        $data = new Type();
        $data->cat_name = $req->cat_name;
        $data->save();
        return redirect()->route('category');          

    }

    public function edit($id)
    {
        $data = Type::find($id);
        return view('admin.category.edit',['cat'=>$data]);
    }

    public function update(Request $req,$id)
    {
        $data = Type::find($id);
        $data->cat_name = $req->$req->name;
        $data->save();
        return redirect()->route('category');
    }


}
