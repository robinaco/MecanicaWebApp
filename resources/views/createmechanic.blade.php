@extends('layouts.app')
@section('content')
<h4 class="text-black-50 text-center"><span class="badge badge bg-secondary bg-gradient">Registrar Nuevo Empleado</span></h4>

<a href="/MechanicList" class="btn btn-secondary btn-sm"> << Atras</a>
<hr>
@include("error")
@include("notification")
@include("advertisement")
<div class="card bg-ligth bg-gradient border border-secondary">
    <div class="card-body">
        <h1><span class="badge badge-secondary"><i class="nav-icon fas fa-user"></i></span></h1>
        <i><span class="badge bg-danger bg-gradient">Campos marcados con * son obligatorios.</span></i>
        <div class="card border border-secondary mb-3" style="padding:1%">
            <form class="row g-3" action="SaveMechanic" method="POST">
                @csrf
                <div class="col-md-3">
                    <label for="inputEmail4" class="form-label badge  badge  bg-success bg-light">* Nombre
                        Completo Empleado</label>
                    <input type="text" class="form-control border border-secondary" id="name" name="nameempleado"
                        value="{{ old('nameempleado') }}">
                    @error('nameempleado')<small>* {{ $message }}</small>@enderror
                </div>
                <div class="col-md-2">
                    <label for="inputPassword4" class="form-label  badge  bg-success bg-light">* Tipo Documento Empleado</label>
                    <select name="tdoctoempleado" id="tdocto" class="form-control border border-secondary">
                        <option value="0">Seleccione Tipo</option>
                        <option value="NIT" {{ old('tdoctoempleado')=='NIT' ? 'selected' : '' }}>NIT</option>
                        <option value="Cedula Ciudadania" {{ old('tdoctoempleado')=='Cedula Ciudadania' ? 'selected' : '' }}>
                            Cedula Ciudadania</option>
                        <option value="Cedula Extranjeria" {{ old('tdoctoempleado')=='Cedula Extranjeria' ? 'selected' : '' }}>
                            Cedula Extranjeria</option>
                        <option value="Tarjeta Extrangeria" {{
                            old('tdoctoempleado')=='Tarjeta Extrangeria' ? 'selected' : '' }}>Tarjeta
                            Extrangeria</option>
                        <option value="Pasaporte" {{ old('tdoctoempleado')=='Pasaporte' ? 'selected' : '' }}>Pasaporte
                        </option>
                        <option value="Tarjeta identidad" {{ old('tdoctoempleado')=='Tarjeta identidad' ? 'selected' : '' }}>
                            Tarjeta de Identidad</option>
                        <option value="NUIP" {{ old('tdoctoempleado')=='NUIP' ? 'selected' : '' }}>NUIP</option>
                        <option value="Registro Civil" {{ old('tdoctoempleado')=='Registro Civil' ? 'selected' : '' }}>
                            Registro Civil</option>
                    </select>
                    @error('tdoctoempleado')<small>* {{ $message }}</small>@enderror
                </div>
                <div class="col-md-3">
                    <label for="inputEmail4" class="form-label badge  badge  bg-secondary bg-light">* Número
                        Documento Empleado</label>
                    <input type="number" class="form-control border border-secondary" id="numerocedula"
                        name="numerocedulaempleado" value="{{ old('numerocedulaempleado') }}">
                    @error('numerocedulaempleado')<small>* {{ $message }}</small>@enderror

                </div>
                <div class="col-md-2">
                    <label for="inputEmail4" class="form-label badge  badge  bg-success bg-light">* Número
                        Celular Empleado</label>
                    <input type="number" class="form-control border border-secondary" id="numerocel" name="numerocelempleado"
                        value="{{ old('numerocelempleado') }}">
                    @error('numerocelempleado')<small>* {{ $message }}</small>@enderror
                </div>
                <div class="col-md-2">
                    <label for="inputEmail4" class="form-label badge  badge  bg-success bg-light">* Tipo 
                        Empleado ?</label>
                        <select name="rolempleado" id="rolempleado" class="form-control border border-secondary">
                            <option value="0">Seleccione Tipo</option>
                            <option value="Administrador" {{ old('rolempleado')=='Administrador' ? 'selected' : '' }}>Administrador</option>
                            <option value="Tecnico" {{ old('rolempleado')=='Tecnico' ? 'selected' : '' }}>
                                Técnico</option>
                        </select>
                        @error('rolempleado')<small>* {{ $message }}</small>@enderror
                </div>
                <div class="card-body">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-secondary btn-sm">Registrar Empleado</button>
                    </div>
                </div>

            </form>

        </div>

    </div>

</div>


@endsection