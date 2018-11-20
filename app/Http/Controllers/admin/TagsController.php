<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Tags;

class TagsController extends Controller
{
    public function index()
    {
        return view('admin.tags.index');
    }

    public function insert(Request $req)
    {
        $tags = new Tags();
        $tags->tags = $req->tags;
        $tags->save();
        return redirect()->route('tags');
    }
}
