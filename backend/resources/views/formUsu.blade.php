<div>


        @isset($usuario)
        <h1>Editar Usuario</h1>

        <form action="{{ route('usuarios.update', $usuario->id) }}" method="POST">
            @method('PUT')
            @csrf
            <input type="text" name="nombre" placeholder="Nombre" value="{{ $usuario->nombre }}">
            <input type="text" name="NIF" placeholder="NIF" value="{{ $usuario->NIF }}">
            <input type="text" name="email" placeholder="Email" value="{{ $usuario->email }}">
            <select name="centros" id="centros">
                @foreach ($centros as $centro)
                    <option value="{{ $centro->id }}" @if ($usuario->id_centro == $centro->id) selected @endif>{{ $centro->nombre }}</option>
                @endforeach
            </select>
            <select name="empresas" id="empresas">
                @foreach ($empresas as $empresa)
                    <option value="{{ $empresa->id }}" @if ($usuario->id_empresa == $empresa->id) selected @endif>{{ $empresa->nombre }}</option>
                @endforeach
            </select>
            <label><input type="checkbox" name="roles[]" value="1" {{ in_array(1, $usuario->roles->pluck('id')->toArray()) ? 'checked' : '' }}> Centro</label>
            <label><input type="checkbox" name="roles[]" value="2" {{ in_array(2, $usuario->roles->pluck('id')->toArray()) ? 'checked' : '' }}> Empresa</label>
            <label><input type="checkbox" name="roles[]" value="3" {{ in_array(3, $usuario->roles->pluck('id')->toArray()) ? 'checked' : '' }}> Tutor</label>

            <button type="submit">Guardar Cambios</button>
        @else

        <h1>Crear Usuario</h1>
        <form action="post">
            @csrf
            <input type="text" name="nombre" placeholder="Nombre">
            <input type="text" name="NIF" placeholder="NIF">
            <input type="text" name="email" placeholder="Email">
            <input type="text" name="password" placeholder="Password">
            <select name="centros" id="centros">
                @foreach ($centros as $centro)
                    <option value="{{ $centro->id }}">{{ $centro->nombre }}</option>
                @endforeach
            </select>
            <select name="empresas" id="empresas">
                @foreach ($empresas as $empresa)
                    <option value="{{ $empresa->id }}">{{ $empresa->nombre }}</option>
                @endforeach
            </select>
            <input type="checkbox" name="roles[]" value="1">Centro
            <input type="checkbox" name="roles[]" value="2">Empresa
            <input type="checkbox" name="roles[]" value="3">Tutor

            <button type="submit">Guardar Usuario</button>
        @endif
    </form>
</div>
