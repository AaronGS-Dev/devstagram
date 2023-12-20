<?php

namespace App\Http\Controllers\Auth;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    //Se usa para proteger la ruta a dashboard
public function __construct()
{
    $this->middleware('auth')->except(['show', 'index']);
}

    public function index(User $user)
    {
       $posts = Post::where('user_id', $user->id)->latest()->paginate(20);

      
    return view('dashboard', [
        'user'=>$user,
        'posts'=>$posts,
    ]);
    }
    public function create()
    {
        return view('posts.create');
    }
    public function store(Request $request) 
    {
       $this->validate($request, [
        'title' =>'required|max:255',
        'description'=>'required',
        'image'=>'required'
       ]) ;

       //primera forma de crear un post

    //    Post::create([
    //     'title' => $request->title,
    //     'description' =>$request->description,
    //     'image' =>$request->image,
    //     'user_id' => auth()->user()->id
    //    ]);

       //Segunda forma de crear un post

    //    $post=new Post;
    //    $post->title=$request->title;
    //    $post->description=$request->description;
    //    $post->image=$request->image;
    //    $post->user_id=auth()->user()->id;



    //Tercera forma

       $request->user()->posts()->create([
        'title' => $request->title,
        'description' =>$request->description,
        'image' =>$request->image,
        'user_id' => auth()->user()->id
       ]);


       return redirect()->route('post.index', auth()->user()->username);
    }

public function show(User $user, Post $post)
{
    return view('posts.show', [
        'post' => $post,
        'user' => $user
    ]);
}

public function destroy(Post $post)
{
    $this->authorize('delete',$post);
    $post->delete();

    // Eliminar la imagen
    $image_path = public_path('uploads/' . $post->image);

    if(File::exists($image_path)){
        unlink($image_path);

    }

    return redirect()->route('post.index', auth()->user()->username);
}

}
 