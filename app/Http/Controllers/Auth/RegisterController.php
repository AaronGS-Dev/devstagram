<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RegisterController extends Controller
{
    public function index ()
     {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        // dd($request);

        //Modificar el Request
        $request->request->add(['username' => Str::slug($request->username)]);

        //validacion
        $this->validate($request, [
            'name' => 'required | min:2 | max:30',
            'username' => 'required | min:4 | max:30 | unique:users',
            'email' => 'required | email | unique:users',
            'password' => 'required | confirmed | min:6',
       ] );
            User::create([
                'name' => $request->name,
                'username' =>$request->username,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);

            //Autenticar un usuario
            // auth()->attempt([
            //     'email' => $request->email,
            //     'password' => $request->password
            // ]);

            //otra forma de autenticar
            auth()->attempt($request->only('email', 'password'));
            
            //redireccionar
            return redirect()->route('post.index', auth()->user()->username);
        }
}
?>