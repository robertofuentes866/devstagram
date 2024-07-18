@extends('layouts.app')

@section('titulo')
    Editar perfil:  {{auth()->user()->username}}
@endsection

@section('contenido')
    <div class="md:flex md:justify-center">
        <div class="md:w-1/2 bg-white shadow p-6">
            <form method="post" action="{{route('perfil.store')}}" enctype="multipart/form-data" class="mt-10 md:mt-0">
                @csrf
                <div class="mb-5">
                    <label for="username" class="mb-2 block uppercase text-gray-500 font-bold">Username</label>

                    <input id="username" name="username" type="text" placeholder="Tu nombre de usuario" value="{{auth()->user()->username}}" class="border p-3 w-full rounded-lg @error('username') border-red-700 @enderror">
                    @error('username')
                        <p class="text-white font-weight-bolder bg-red-500 rounded-sm p-2 my-2">{{$message}}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="imagen" class="mb-2 block uppercase text-gray-500 font-bold">Imagen Perfil</label>

                    <input id="imagen" name="imagen" type="file" class="border p-3 w-full rounded-lg">
                </div>

                <input type="submit"
                value="Guardar cambios"
                class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg ">
            </form>
        </div>
    </div>
@endsection