@extends('partials.plantilla')

@section('titulo', 'UsuEdit')
@section('contenido')
<div class="container mt-4">
    @isset($usuario)
        <h1 class="mb-4">Editar Usuario</h1>

        <form action="{{ route('usuarios.update', $usuario->id) }}" method="POST" class="card p-4 shadow-sm">
            @method('PUT')
            @csrf

            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" name="nombre" placeholder="Nombre" value="{{ $usuario->nombre }}">
            </div>

            <div class="mb-3">
                <label for="NIF" class="form-label">NIF</label>
                <input type="text" class="form-control" name="NIF" placeholder="NIF" value="{{ $usuario->NIF }}">
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" placeholder="Email" value="{{ $usuario->email }}">
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Nueva Contraseña</label>
                <input type="text" class="form-control" name="password" placeholder="Dejar en blanco para no modificar">
            </div>

            <div class="mb-3">
                <label for="centros" class="form-label">Centro</label>
                <select class="form-select" name="centros" id="centros">
                    @foreach ($centros as $centro)
                        <option value="{{ $centro->id }}" @if ($usuario->id_centro == $centro->id) selected @endif>{{ $centro->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="empresas" class="form-label">Empresa</label>
                <select class="form-select" name="empresas" id="empresas">
                    @foreach ($empresas as $empresa)
                        <option value="{{ $empresa->id }}" @if ($usuario->id_empresa == $empresa->id) selected @endif>{{ $empresa->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Roles</label><br>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" name="roles[]" value="1" {{ in_array(1, $usuario->roles->pluck('id')->toArray()) ? 'checked' : '' }}>
                    <label class="form-check-label">Centro</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" name="roles[]" value="2" {{ in_array(2, $usuario->roles->pluck('id')->toArray()) ? 'checked' : '' }}>
                    <label class="form-check-label">Empresa</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" name="roles[]" value="3" {{ in_array(3, $usuario->roles->pluck('id')->toArray()) ? 'checked' : '' }}>
                    <label class="form-check-label">Tutor</label>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        </form>
    @else

        <h1 class="mb-4">Crear Usuario</h1>

        <form action="post" method="POST" class="card p-4 shadow-sm">
            @csrf

            <div class="mb-3">
                <input type="text" class="form-control" name="nombre" placeholder="Nombre">
            </div>
            <div class="mb-3">
                <input type="text" class="form-control" name="NIF" placeholder="NIF">
            </div>
            <div class="mb-3">
                <input type="email" class="form-control" name="email" placeholder="Email">
            </div>
            <div class="mb-3">
                <input type="text" class="form-control" name="password" placeholder="Password">
            </div>
            <div class="mb-3">
                <select class="form-select" name="centros" id="centros">
                    @foreach ($centros as $centro)
                        <option value="{{ $centro->id }}">{{ $centro->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <select class="form-select" name="empresas" id="empresas">
                    @foreach ($empresas as $empresa)
                        <option value="{{ $empresa->id }}">{{ $empresa->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" name="roles[]" value="1">
                    <label class="form-check-label">Centro</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" name="roles[]" value="2">
                    <label class="form-check-label">Empresa</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" name="roles[]" value="3">
                    <label class="form-check-label">Tutor</label>
                </div>
            </div>

            <button type="submit" class="btn btn-success">Guardar Usuario</button>
        </form>
    @endif
</div>
@endsection
