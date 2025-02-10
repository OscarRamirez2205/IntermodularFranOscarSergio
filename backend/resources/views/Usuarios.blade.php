@extends('partials.plantilla')

@section('titulo', 'Empresas')
@section('contenido')
    <h1 class="text-center">Listado de Empresas</h1>
    <div class="d-flex flex-wrap justify-content-start">
        @foreach ($empresas as $empresa)
        @include('empresas.empresaCard', ['empresa' => $empresa])
    @endforeach
</div>

@endsection
