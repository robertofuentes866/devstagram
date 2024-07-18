@extends('layouts.app')

@section('titulo')
    Crea una nueva publicación
@endsection

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
@endpush

@section('contenido')
    <div class="md:flex md:items-center">
        <div class="md:w-1/2 px-10">
           <form enctype="multipart/form-data" method="post" action="{{route('imagenes.store')}}" id="dropzone" class="dropzone border-dashed border-2 border-blue-800 w-full h-96 rounded flex flex-col justify-center items-center">
            @csrf
           </form>
        </div>

        <div class="md:w-1/2 px-10 mt-10 md:mt-0 p-10 bg-white rounded-lg shadow-lg">
            <form action="{{route('posts.store')}}" method="POST" novalidate>
                @csrf
                
                <div class="mb-5">
                    <label for="titulo" class="mb-2 block uppercase text-gray-500 font-bold">Título</label>

                    <input id="titulo" name="titulo" type="text" placeholder="Título de la publicación" value="{{old('titulo')}}" class="border p-3 w-full rounded-lg @error('titulo') border-red-700 @enderror">
                    @error('titulo')
                        <p class="text-white font-weight-bolder bg-red-500 rounded-sm p-2 my-2">{{$message}}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="descripcion" class="mb-2 block uppercase text-gray-500 font-bold">Descripcion</label>

                    <textarea id="descripcion" name="descripcion" placeholder="Descripción" class="border p-3 w-full rounded-lg @error('descripcion') border-red-700 @enderror">{{old('descripcion')}}</textarea>
                    @error('descripcion')
                        <p class="text-white font-weight-bolder bg-red-500 rounded-sm p-2 my-2">{{$message}}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <input name="imagen" type="hidden" value="{{ old('imagen') }}">
                </div>
                @error('imagen')
                        <p class="text-white font-weight-bolder bg-red-500 rounded-sm p-2 my-2">{{$message}}</p>
                @enderror

                <input type="submit"
                value="Crear publicacion"
                class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg ">
            </form>
        </div>
    </div>
@endsection