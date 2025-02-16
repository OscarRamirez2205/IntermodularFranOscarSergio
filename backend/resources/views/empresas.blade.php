@extends('partials.plantilla')

@section('titulo', 'Empresas')
@section('contenido')
    <h1 class="text-center">Listado de Empresas</h1>
    @isset($success)
        <div class="alert alert-success alert-dismissible fade show mx-3 mt-3" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>
            {{ $success }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endisset

    @isset($token)
        <div class="alert alert-info alert-dismissible fade show mx-3 mt-3" role="alert">
            <i class="bi bi-info-circle-fill me-2"></i>
            <strong>Formularios creados</strong><br>
            <span class="ms-3">Formulario Empresa: localhost:4200/form?token={{ $token->token }}</span><br>
            <span class="ms-3">Formulario Alumno: localhost:4200/form?token={{ $token_a->token }}</span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endisset
    <div class="container">
        <div class="mb-3">
            <a href="{{ route('empresas.create') }}" class="btn btn-success">Añadir Empresa</a>
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>CIF</th>
                    <th>Email</th>
                    <th>Teléfono</th>
                    <th>Provincia</th>
                    <th>Población</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($empresas as $empresa)
                    <tr>
                        <td>{{ $empresa->nombre }}</td>
                        <td>{{ $empresa->cif }}</td>
                        <td>{{ $empresa->email }}</td>
                        <td>{{ $empresa->telefono }}</td>
                        <td>{{ $empresa->direccion_provincia }}</td>
                        <td>{{ $empresa->poblacion }}</td>
                        <td>
                            <a href="{{ route('empresas.show', $empresa) }}" class="btn btn-info">Ver</a>
                            <a href="{{ route('empresas.edit', $empresa) }}" class="btn btn-warning">Editar</a>
                            <form action="{{ route('empresas.destroy', $empresa) }}" method="POST" class="d-inline">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="d-flex justify-content-center">
            {{ $empresas->links() }}
        </div>
    </div>
@endsection 