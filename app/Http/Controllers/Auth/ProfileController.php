<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return view('profile.index');
    }

    public function store(Request $request)
    {
    //Modificar el Request
    $request->request->add(['username' => Str::slug($request->username)]);

        $this->validate($request, [
            'username' => ['required', 'unique:users,username,'.auth()->user()->id, 'min:3', 'max:20', 'not_in:crear-usuario,editar-perfil'],
             //el not in es para crear una lista negra de nombres de usuario
             'email' => ['required', 'unique:users,email,'.auth()->user()->id],

        ]);

        if($request->image){
            
        $image =$request->file('image');

        $nombreImage = Str::uuid() . "." . $image->extension();


        $imageServidor =Image::make($image)->fit(1000, 1000);

        $imagePath = public_path('profiles') . '/' . $nombreImage;
        $imageServidor->save($imagePath);
        } 

        //guardar cambios

        $user = User::find(auth()->user()->id);

        $user->username = $request->username;
        $user->email =$request->email;
        $user->image = $nombreImage ??auth()->user()->image ?? '';
        $user->save();



        //redireccionar 
        return redirect()->route('post.index', $user->username);
    }
}
