@extends('layouts.app')
@section('titulo')
    Perfil: {{$user->username}}
@endsection

@section('contenido')
    <div class="flex justify-center">
        <div class="w-full flex md:flex-row flex-col ">
            <div class=" md:w-6/12 flex justify-center md:justify-end px-5 font-bold">
                @if (! $user->imagen)
                <img class="w-40" src="{{asset('storage/usuario.svg')}}" alt="Imagen usuario">
                @else
                <img class="w-40 rounded-full" src="{{asset('perfiles/'.$user->imagen)}}" alt="Imagen usuario">
                @endif
            </div>

            <div class=" md:w-6/12 px-5 flex flex-col items-center md:items-start md:justify-center">

                <div class="flex items-center gap-2">
                    <p class="text-gray-700 text-2xl">{{$user->username}} </p>
                    @auth
                        @if ($user->id === auth()->user()->id)
                            <a href="{{route('perfil.index')}}"
                            class="text-gray-500 hover:text-gray-600 cursor-pointer"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                          </svg></a>
                          
                        @endif
                    @endauth
                </div>
                
               

                <p class="text-gray-800 text-sm font-bold mb-3">{{$user->followers->count()}} <span class="font-normal">@choice('Seguidor|Seguidores',$user->followers->count())</span></p>
                <p class="text-gray-800 text-sm font-bold mb-3">{{$user->following->count()}}<span class="font-normal"> siguiendo </span></p>
                <p class="text-gray-800 text-sm font-bold mb-3">{{$user->posts->count()}} <span class="font-normal">posts </span></p>
                @auth
                    @if (auth()->user()->id != $user->id)
                        @if (! auth()->user()->is_follower($user))
                            <form method="post" action="{{ route('users.follower',$user)}}">
                                @csrf
                                <input type="submit" class="bg-blue-600 text-white uppercase rounded-lg text-sm font-bold cursor-pointer px-3 py-1" value="Seguir">
                            </form>
                        @else
                            <form method="post" action="{{ route('users.unfollower',$user)}}">
                                @csrf
                                @method('DELETE')
                                <input type="submit" class="bg-red-600 text-white uppercase rounded-lg text-sm font-bold cursor-pointer px-3 py-1" value="Dejar de seguir">
                            </form>
                        @endif
                    @endif
                    
                @endauth
                
            </div>
        </div>
    </div>

    <section class="container mx-auto mt-10">
        <h2 class="text-4xl text-center font-black my-10">Publicaciones</h2>
        <x-listar-posts :posts="$posts"/>
        
    </section>
@endsection