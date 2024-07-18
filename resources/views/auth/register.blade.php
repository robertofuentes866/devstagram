@extends('layouts.app')

@section('titulo')
    Regístrate en Devstagram
@endsection

@section('contenido')
    <div class="md:flex md:justify-center md:items-center p-5">
        <div class="md:w-5/12 md:me-3 md:items-center">
            <img src="{{ asset('storage/registrar.jpg')}}" alt="Imagen registro usuario">
        </div>

        <div class="md:w-4/12 bg-white p-6 rounded-lg shadow-lg">
            <form action="{{route('crearCuenta')}}" method="POST" novalidate>
                @csrf

                <div class="mb-5">
                    <label for="name" class="mb-2 block uppercase text-gray-500 font-bold">Name</label>

                    <input id="name" name="name" type="text" placeholder="Tu nombre" value="{{old('name')}}" class="border p-3 w-full rounded-lg @error('name') border-red-700 @enderror">
                    @error('name')
                        <p class="text-white font-weight-bolder bg-red-500 rounded-sm p-2 my-2">{{$message}}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="username" class="mb-2 block uppercase text-gray-500 font-bold">Username</label>

                    <input id="username" name="username" type="text" placeholder="Tu nombre de usuario" value="{{old('username')}}" class="border p-3 w-full rounded-lg @error('username') border-red-700 @enderror">
                    @error('username')
                        <p class="text-white font-weight-bolder bg-red-500 rounded-sm p-2 my-2">{{$message}}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">Email</label>

                    <input id="email" name="email" type="email" placeholder="Tu correo electronico" value="{{ old('email')}}" class="border p-3 w-full rounded-lg @error('email') border-red-700 @enderror">

                    @error('email')
                        <p class="text-white font-weight-bolder bg-red-500 rounded-sm p-2 my-2">{{$message}}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="password" class="mb-2 block uppercase text-gray-500 font-bold">Password</label>

                    <input id="password" name="password" type="password" placeholder="Tu nuevo password" class="border p-3 w-full rounded-lg @error('password') border-red-700 @enderror">

                    @error('password')
                        <p class="text-white font-weight-bolder bg-red-500 rounded-sm p-2 my-2">{{$message}}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="password_confirmation" class="mb-2 block uppercase text-gray-500 font-bold">Password</label>

                    <input id="password_confirmation" name="password_confirmation" type="password" placeholder="Repite tu password" class="border p-3 w-full rounded-lg @error('password_confirmation') border-red-700 @enderror">

                    @error('password_confirmation')
                        <p class="text-white font-weight-bolder bg-red-500 rounded-sm p-2 my-2">{{$message}}</p>
                    @enderror
                </div>

                <input type="submit"
                value="Crear cuenta"
                class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg ">


            </form>
        </div>
    </div>
@endsection

