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

        $img =new Album;
        $img->insert($req);
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
