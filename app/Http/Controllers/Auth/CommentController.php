<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, User $user, Post $post)
    {
      //validar
        $this->validate($request, [
            'comment' => 'required| max:255'
        ]);


      //almacenar resultado
        Comment::create([
            'user_id' => auth()->user()->id,
            'post_id' => $post->id,
            'comment' =>$request->comment ,
        ]);


      //imprimir un mensaje
      return back()->with('mensaje', 'Commentario Realizado');
    }
}
