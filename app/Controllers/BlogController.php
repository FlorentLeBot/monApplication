<?php

namespace App\Controllers;

use App\Models\BlogModel;

class BlogController extends Controller
{   
    public function welcome(){
        return $this->view('blog.welcome');
    }
    public function index()
    {
        $post = new \App\Models\BlogModel($this->getDB());
        $posts = $post->allPosts();

        return $this->view('blog.index', compact('posts'));
    }
    public function show(int $id)
    {   
        $post = new BlogModel($this->getDB());
        $post = $post->findById($id);
 
        return $this->view('blog.show', compact('post'));
    }
   
}
