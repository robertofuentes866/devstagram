@extends('layouts.app')

@section('titulo')
    Inicia sesión en Devstagram
@endsection

@section('contenido')
    
    <div class="md:flex md:justify-center md:items-center p-5">
        <div class="md:w-5/12 md:me-3 md:items-center">
            <img src="{{ asset('storage/login.jpg')}}" alt="Imagen login usuario">
        </div>

        <div class="md:w-4/12 bg-white p-6 rounded-lg shadow-lg">
            <form action="{{route('login')}}" method="POST" novalidate>
                @csrf
                @if (session('mensaje'))
                    <p class="text-white font-weight-bolder bg-red-500 rounded-sm p-2 my-2">{{session('mensaje')}}</p>
                @endif
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
                    <input type="checkbox" name="remember"><label class="text-gray-500 text-sm ms-2">Mantener sesion abierta</label>
                </div>
                <input type="submit"
                value="Inicia Sesión"
                class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg ">


            </form>
        </div>
    </div>
@endsection

