@extends('layouts.app')

@section('content')

<h4 class="text-black-50 text-center"><span class="badge badge bg-secondary bg-gradient">Actualizar Información Empleado:<br>
    {{ $mechanic->nombremecanico }}</span></h4>
<a href="/MechanicList" class="btn btn-secondary btn-sm"><< Atras</a>
<hr>
<div class="card border border-secondary">
    <div class="card-body bg-light bg-gradient">
        <i><span class="badge bg-danger bg-gradient">Campos marcados con * son obligatorios.</span></i>
        <div class="card border border-secondary mb-3" style="padding:1%">
            <form class="row g-3" action="UpdateMechanic" method="POST">
                @csrf
                @method("PUT")
                <div class="col-md-3">
                    <label for="inputEmail4" class="form-label badge  badge  bg-success bg-light">* Nombre
                        Completo Empleado</label>
                    <input type="text" class="form-control bg-secondary bg-gradient" id="nameempleado" name="nameempleado" value="{{ $mechanic->nombremecanico }}">
                    @error('nameempleado')<small>* {{ $message }}</small>@enderror
                </div>
                <div class="col-md-2">
                    <label for="inputPassword4" class="form-label  badge  bg-success bg-light">* Tipo Documento Empleado</label>
                    <select name="tdoctoempleado" id="tdoctoempleado" class="form-control bg-secondary bg-gradient">
                        <option value="0">Seleccione Tipo</option>
                        <option value="NIT" {{ old('tdocto')=='NIT' ? 'selected' : '' }}>NIT</option>
                        <option value="Cedula Ciudadania" {{ old('tdoctoempleado')=='Cedula Ciudadania' ? 'selected' : '' }}>
                            Cedula Ciudadania</option>
                        <option value="Cedula Extranjeria" {{ old('tdoctoempleado')=='Cedula Extranjeria' ? 'selected' : '' }}>
                            Cedula Extranjeria</option>
                        <option value="Tarjeta Extrangeria Extranjeria" {{
                            old('tdoctoempleado')=='Tarjeta Extrangeria Extranjeria' ? 'selected' : '' }}>Tarjeta
                            Extrangeria Extranjeria</option>
                        <option value="Pasaporte" {{ old('tdoctoempleado')=='Pasaporte' ? 'selected' : '' }}>Pasaporte
                        </option>
                        <option value="Tarjeta identidad" {{ old('tdoctoempleado')=='Tarjeta identidad' ? 'selected' : '' }}>
                            Tarjeta de Identidad</option>
                        <option value="NUIP" {{ old('tdocto')=='NUIP' ? 'selected' : '' }}>NUIP</option>
                        <option value="Registro Civil" {{ old('tdoctoempleado')=='Registro Civil' ? 'selected' : '' }}>
                            Registro Civil</option>
                    </select>
                    @error('tdoctoempleado')<small>* {{ $message }}</small>@enderror
                </div>
                <div class="col-md-3">
                    <label for="inputEmail4" class="form-label badge  badge  bg-success bg-light">* Número
                        Documento</label>
                    <input type="text" class="form-control bg-secondary bg-gradient" id="numerocedulaempleado" name="numerocedulaempleado"
                        value="{{ $mechanic->numerodocumento }}">
                    @error('numerocedulaempleado')<small>* {{ $message }}</small>@enderror

                </div>
                <div class="col-md-2">
                    <label for="inputEmail4" class="form-label badge  badge  bg-success bg-light">* Número
                        Celular</label>
                    <input type="number" class="form-control bg-secondary bg-gradient" id="numerocelempleado" name="numerocelempleado"
                        value="{{ $mechanic->numerocelmecanico}}">
                    @error('numerocelempleado')<small>* {{ $message }}</small>@enderror
                </div>
                 <div class="col-md-2">
                    <label for="inputEmail4" class="form-label badge  badge  bg-success bg-light">* Tipo 
                        Empleado ?</label>
                        <select name="rolempleado" id="rolempleado" class="form-control bg-secondary bg-gradient">
                            <option value="0">Seleccione Tipo</option>
                            <option value="Administrador" {{ old('rolempleado')=='Administrador' ? 'selected' : '' }}>Administrador</option>
                            <option value="Tecnico" {{ old('rolempleado')=='Tecnico' ? 'selected' : '' }}>
                                Tecnico</option>
                        </select>
                        @error('rolempleado')<small>* {{ $message }}</small>@enderror
                </div>
                <div class="card-body">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-secondary btn-sm">Actualizar Información Empleado</button>
                    </div>
                </div>

            </form>

        </div>

    </div>

</div>






















@endsection