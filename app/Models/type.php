<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class type extends Model
{
    public $timestamps = false;
    public static function getCategory(){
       return $data =  Type::get();
    }
   
}
