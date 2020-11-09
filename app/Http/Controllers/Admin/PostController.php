<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
Use App\Http\Requests\PostStoreRequest;
Use App\Http\Requests\PostUpdateeRequest;

use Illuminate\Support\Facades\Storage;

use App\Post;
use App\Tag;
use App\Category;

class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('id', 'DESC')->where('user_id', auth()->user()->id)->paginate();
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $categories = Category::orderBy('name', 'ASC')->pluck('name', 'id');
        $tags       = Tag::orderBy('name', 'ASC')->get();
        return view('admin.posts.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostStoreRequest $request)
    {

        $posts = Post::create($request->all());

        //IMAGE
        if($request->file('file')){
            $path = Storage::disk('public')->put('image',  $request->file('image'));
            $posts->fill(['file' => asset($path)])->save();
        }

        //TAGS
        $posts->tags()->attach($request->get('tags'));


        return redirect()->route('posts.edit', $posts->id)
                ->with('info', 'Post creado con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $posts = Post::find($id);
        $this->authorize('pass', $posts);

        return view('admin.posts.show', compact('posts'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $posts      = Post::find($id);
        $this->authorize('pass', $posts);

        $categories = Category::orderBy('name', 'ASC')->pluck('name', 'id');
        $tags       = Tag::orderBy('name', 'ASC')->get();

        return view('admin.posts.edit', compact('posts', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostUpdateeRequest $request, $id)
    {
        $posts = Post::find($id);
        $this->authorize('pass', $posts);

        $posts->fill($request->all())->save();

         //IMAGE
        if($request->file('file')){
            $path = Storage::disk('public')->put('image',  $request->file('image'));
            $posts->fill(['file' => asset($path)])->save();
        }

        //TAGS
        $posts->tags()->sync($request->get('tags'));

        return redirect()->route('posts.edit', $posts->id)
                ->with('info', 'Post actualizado con éxito');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $this->authorize('pass', $post);
        $post->delete();

        return back()->with('info', 'Eliminado correctamente');
    }
}
