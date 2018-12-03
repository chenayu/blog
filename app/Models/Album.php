<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Storage;
use Intervention\Image\ImageManager;

class Album extends Model
{
//    public $timestamps = false;
   protected  $fillable=['img','img_name','categor','img_s'];


   public function insert($req)
   {

        $data = $req->all();
        $album = new Album();
        if($req->has('img') && $req->img->isValid())
        {
        $date = date('Ymd');
        //上传图片到目录
        $logo = $req->img->store('uploads/'.$date);

        //取出/出现的下标
        $xb = strrpos($logo,"/");
        //根据下标截取出原图片的名称作为缩略图的名称
        $img_sname = substr($logo,$xb+1);
        //实例化图片处理对象
        $manager = new ImageManager(array('driver' => 'GD')); 
        //创建存储缩略图的目录
        Storage::makeDirectory('img_s/'.$date);

        //获取要修改的图片
        $image = $manager->make('uploads/'.$logo);
        //获取原图片的宽高
        $c = $manager->make('uploads/'.$logo)->width();
        $d = $manager->make('uploads/'.$logo)->height();
        //根据原图片的宽度 约束当前图像的宽高比
        $image->resize(300, null, function ($c) {
            $c->aspectRatio();
        });

        //保存缩略图位置
        $image->save('uploads/img_s/'.$date.'/'.$img_sname);
        }

        $album->fill($data);  
        //保存缩略图路径
        $album->img_s = "img_s/$date/$img_sname";
        //保存原图片路径
        $album->img=$logo;
        $album->save();

        // return redirect()->route('blog.list'); 
   }
}
