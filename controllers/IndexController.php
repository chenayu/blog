<?php
namespace controllers;

class IndexController
{
    public function index()
    {
        $blog = new \models\Blog;
        $data = $blog->getNew();
        view('index.index',['blogs'=>$data]);
    }
}