<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Album;
use Intervention\Image\ImageManager;

class AlbumController extends Controller
{
    public function index()
    {
        $data = Album::get();

        return view('admin.album.index',['data'=>$data]);
    }

    public function uploads(Request $req)
    {
        //上传图片
        $img =new Album;
        $image =  $img->insert($req);
        return json_encode([
            'success'=>false,
            'msg'=>'上传成功',  //如果上面为false 就显示这句话
            'file_path'=>$image  //返回图片保存的路径，如果上传失败就没有这一项
        ]);
    }

    public function img_cat()
    {
        return view('admin.album.index');
    }

    // public function doadd(Request $req)
    // {
    //     // $file = $req->file('img');
    //     // dd($file);
    //     $date = date('Ymd');
    //     $req->img->store('uploads/'.$date);
        
    // }
}
