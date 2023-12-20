<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class ImagenController extends Controller
{
    public function store(Request $request)
    {
        //    $input = $request->all();

        $image =$request->file('file');

        $nombreImage = Str::uuid() . "." . $image->extension();


        $imageServidor =Image::make($image)->fit(1000, 1000);

        $imagePath = public_path('uploads') . '/' . $nombreImage;
        $imageServidor->save($imagePath);
        
        return response()->json(['image' => $nombreImage]);
        
    }
}
