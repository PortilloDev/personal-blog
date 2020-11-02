<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;

class PageController extends Controller
{

    public function blog(){
        $posts = Post::orderBy('id', 'DESC')
            ->where('status', 'PUBLISHED')->paginate(3);
        return view('web.posts', compact('posts'));
    }
}
