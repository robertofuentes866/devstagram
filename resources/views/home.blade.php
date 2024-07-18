@extends('layouts.app')

@section('titulo')
    Página Principal
@endsection

@section('contenido')
    <x-listar-posts :posts="$posts"/>
@endsection