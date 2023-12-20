@extends('layouts.app')

@section('title')
    Editar perfil: {{ auth()->user()->username }}
@endsection


@section('content')
    <div class="md:flex md:justify-center">
        <div class="md:w-1/2 bg-white shadow p-6">
            <form method="POST" action="{{ route('profile.store') }}" enctype="multipart/form-data" class="mt-10 md:mt-0">
                @csrf
                <div class="mb-5">
                    <label for="username" class="mb-2 flex uppercase text-gray-500 font-bold" >
                        Apodo 
                    </label>
                    <input id="username" name="username" type="text" placeholder="Tu nombre de usuario" class="border p-3 w-full rounded-lg @error('username') border-red-500
                        
                    @enderror"
                    value="{{auth()->user()->username}}">

                    @error('username')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                    @enderror

                    <div class="mb-5">
                        <label for="email" class="mb-2 flex uppercase text-gray-500 font-bold" >
                           Correo
                        </label>
                        <input id="email" name="email" type="email" placeholder="Tu correo" class="border p-3 w-full rounded-lg @error('email') border-red-500
                            
                        @enderror"
                        value="{{auth()->user()->email}}">
    
                        @error('email')
                            <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                        @enderror
    
                 </div>

                 <div class="mb-5">
                    <label for="image" class="mb-2 flex uppercase text-gray-500 font-bold" >
                        Imagen perfil
                    </label>
                    <input id="image" name="image" type="file"  class="border p-3 w-full rounded-lg"
                    value="" accept=".jpg, .jpeg, .png">

                 </div>
                 <input type="submit" value="Guardar cambios" class="bg-sky-600 hover:bg-sky-700 transition-colors  uppercase font-bold w-full p-3 text-white rounded-lg">

            </form>
        </div>
        <div class="pt-3">
            <a href=" {{ route('post.index', auth()->user()->username ) }}" class="bg-sky-600 hover:bg-sky-700 transition-colors uppercase font-bold w-full p-2 text-white rounded-lg">perfil</a>

        </div>
    </div>

    
@endsection