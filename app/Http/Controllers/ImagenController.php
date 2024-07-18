<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class ImagenController extends ApiController
{
    public function store(Request $request)
    {
        $nombreImagen = $this->fitImage($request,'file','uploads',1000);
        return response()->json(['imagen'=>$nombreImagen]);
    
    }
}
