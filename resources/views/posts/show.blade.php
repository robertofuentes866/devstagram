@extends('layouts.app')

@section('titulo')
    {{$post->titulo}}
@endsection

@section('contenido')
    <div class="container mx-auto md:flex">

        <div class="md:w-1/2">
            <img src="{{asset('uploads'). '/'. $post->imagen}}" alt="Imagen del post {{$post->titulo}}">
            <div class="p-3 flex items-center gap-4">
                @auth
                    <livewire:like-post :post="$post" />
                @endauth
                
            </div>

            <div>
                <p class="font-bold">{{$post->user->username}}</p>
                <p class="text-sm text-gray-500">{{$post->created_at->diffForHumans()}}</p>
                <p class="mt-5">
                    {{$post->descripcion}}
                </p>
            </div>
            @auth
                 @if($post->user_id == auth()->user()->id)
                <div>
                    <form method="post" action="{{route('posts.destroy',$post)}}">
                        @csrf
                        @method('DELETE')
                        <input
                            type="submit"
                            value="Eliminar publicacion"
                            class="bg-red-500 hover:bg-red-600 p-2 rounded text-white font-bold mt-4 cursor-pointer"
                            >
                    </form>
                </div>
            @endif
            @endauth
           
        </div>
        
                <div class="md:w-1/2 p-5">
                    <div class="shadow bg-white p-5 mb-5">
                    @auth
                        <p class="text-xl font-bold text-center mb-4">Agrega un nuevo comentario</p>
                       @if(session('mensaje'))
                            <div class="bg-green-500 p-2 rounded-lg mb-6 text-white text-center font-bold">
                                {{session('mensaje')}}
                            </div>
                            
                        @endif
                        <form method="post" action="{{route('comentarios.store',['post'=>$post,'user'=>$user])}}">
                            @csrf
                            <div class="mb-5">
                                <label for="comentario" class="mb-2 block uppercase text-gray-500 font-bold">Agrega un comentario</label>

                                <textarea id="comentario" name="comentario" placeholder="Agrega un comentario" class="border p-3 w-full rounded-lg @error('comentario') border-red-700 @enderror"></textarea>
                                @error('comentario')
                                    <p class="text-white font-weight-bolder bg-red-500 rounded-sm p-2 my-2">{{$message}}</p>
                                @enderror
                            </div>
                        
                            <input type="submit"
                            value="Agregar comentario"
                            class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg ">
                        </form>
                    @endauth
                    <div class="bg-white shadow mb-5 max-h-96 overflow-y-scroll">
                        @if ($post->comentarios->count())
                            @foreach ($post->comentarios as $comentario)
                                <div class="p-5 border-gray-300 border-b">
                                    <a class="font-bold" href="{{route('posts.index',$comentario->user)}}">{{$comentario->user->username}}</a>
                                    <p class="">{{$comentario->comentario}}</p>
                                    <p class="text-sm text-gray-500">{{$comentario->created_at->diffForHumans()}}</p>

                                </div>
                                
                            @endforeach
                        @else
                            <p class="p-10 text-center mt-10">
                                No hay comentarios de este post.
                            </p>
                        @endif
                    </div>
                </div>
            </div> 
    </div>
@endsection