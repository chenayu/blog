<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tags extends Model
{
   public $timestamps = false;

   //取出所有标签
   public function getTags()
   {
      return Tags::get();
   }
}
