@extends('layouts.app')

@section('content')

<h4 class="text-black-50 text-center"><span class="badge badge bg-warning bg-gradient">Actualizar Información:
    {{ $cliente->nombrecliente }}</span></h4>
<a href="/CustomerList" class="btn btn-primary btn-sm"><< Atras</a>
<hr>
<div class="card border border-secondary">
    <div class="card-body bg-light bg-gradient">
        <i><span class="badge bg-danger bg-gradient">Campos marcados con * son obligatorios.</span></i>
        <div class="card border border-secondary mb-3" style="padding:1%">
            <form class="row g-3" action="UpdateCustomer" method="POST">
                @csrf
                @method("PUT")
                <div class="col-md-4">
                    <label for="inputEmail4" class="form-label badge  badge  bg-success bg-light">* Nombre
                        Completo</label>
                    <input type="text" class="form-control bg-secondary bg-gradient" id="name" name="name" value="{{ $cliente->nombrecliente }}">
                    @error('name')<small>* {{ $message }}</small>@enderror
                </div>
                <div class="col-md-4">
                    <label for="inputPassword4" class="form-label  badge  bg-success bg-light">* Tipo Documento</label>
                    <select name="tdocto" id="tdocto" class="form-control bg-secondary bg-gradient">
                        <option value="0">Seleccione Tipo</option>
                        <option value="NIT" {{ old('tdocto')=='NIT' ? 'selected' : '' }}>NIT</option>
                        <option value="Cedula Ciudadania" {{ old('tdocto')=='Cedula Ciudadania' ? 'selected' : '' }}>
                            Cedula Ciudadania</option>
                        <option value="Cedula Extranjeria" {{ old('tdocto')=='Cedula Extranjeria' ? 'selected' : '' }}>
                            Cedula Extranjeria</option>
                        <option value="Tarjeta Extrangeria Extranjeria" {{
                            old('tdocto')=='Tarjeta Extrangeria Extranjeria' ? 'selected' : '' }}>Tarjeta
                            Extrangeria Extranjeria</option>
                        <option value="Pasaporte" {{ old('tdocto')=='Pasaporte' ? 'selected' : '' }}>Pasaporte
                        </option>
                        <option value="Tarjeta identidad" {{ old('tdocto')=='Tarjeta identidad' ? 'selected' : '' }}>
                            Tarjeta de Identidad</option>
                        <option value="NUIP" {{ old('tdocto')=='NUIP' ? 'selected' : '' }}>NUIP</option>
                        <option value="Registro Civil" {{ old('tdocto')=='Registro Civil' ? 'selected' : '' }}>
                            Registro Civil</option>
                    </select>
                    @error('tdocto')<small>* {{ $message }}</small>@enderror
                </div>
                <div class="col-md-4">
                    <label for="inputEmail4" class="form-label badge  badge  bg-success bg-light">* Número
                        Documento</label>
                    <input type="text" class="form-control bg-secondary bg-gradient" id="numerocedula" name="numerocedula"
                        value="{{ $cliente->numcedula }}">
                    @error('numerocedula')<small>* {{ $message }}</small>@enderror

                </div>
                <div class="col-md-6">
                    <label for="inputEmail4" class="form-label badge  badge  bg-success bg-light">* Correo
                        Electrónico</label>
                    <input type="email" class="form-control bg-secondary bg-gradient" id="email" name="email" value="{{ $cliente->email }}">
                    @error('email')<small>* {{ $message }}</small>@enderror
                </div>
                <div class="col-md-6">
                    <label for="inputEmail4" class="form-label badge  badge  bg-success bg-light">* Número
                        Celular</label>
                    <input type="number" class="form-control bg-secondary bg-gradient" id="numerocel" name="numerocel"
                        value="{{ $cliente->numerocel}}">
                    @error('numerocel')<small>* {{ $message }}</small>@enderror
                </div>
                <div class="card-body">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-warning btn-sm">Actualizar Información</button>
                    </div>
                </div>

            </form>

        </div>

    </div>

</div>






















@endsection