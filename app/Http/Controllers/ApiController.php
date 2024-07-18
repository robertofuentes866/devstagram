<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ApiController extends Controller
{
    public function fitImage(Request $request,$handler,$path,$tamano)
    {
        
        $imagen = $request->file("$handler");
        $nombreImagen = Str::uuid().".".$imagen->extension();
        $imagenServidor = Image::make($imagen);
        $imagenServidor->fit($tamano,$tamano);
        $imagenPath = public_path("$path"). '/'.$nombreImagen;
        $imagenServidor->save($imagenPath);

        return $nombreImagen;
    }
}
