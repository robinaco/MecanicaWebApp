@extends('layouts.app')

@section('content')
<h4 class="text-black-50 text-center"><span class="badge badge bg-warning bg-gradient">Agregar Vehiculo a: <br>{{ $cliente->nombrecliente }}</span></h4>

<a href="/CustomerList" class="btn btn-primary btn-sm"><< Atras</a>
<hr>

<div class="card bg-ligth bg-gradient border border-secondary">
    <span class="imgsl"><img src="/images/coche.png"></span>
    <div class="card-body">
        
        
        <i><span class="badge bg-danger bg-gradient">Campos marcados con * son obligatorios.</span></i>
        <div class="card border border-secondary mb-3" style="padding:1%">
        <!-- <div class="col-sm-3 col-md-3 search-header">
                <form class="navbar-form" role="search">
                    <div class="input-group">
                        <input type="text" class="form-control search-box " placeholder="Ingrese Placa" name="srch-term" id="srch-term">
                        <div class="input-group-btn">
                            <button class="btn btn-success btn-search" onclick="return ss();"><i class="fa fa-search"> </i> BUSCAR VEHICULO</button>
                        </div>
                    </div>
                </form>
            </div> 
            <hr>-->
            <form class="row g-3" action="SaveVehiculo" method="POST">
                <input type="hidden" value="{{$cliente->id}}" name="idcliente" id="idcliente">
                @csrf
                <div class="col-md-4">
                    <label for="inputEmail4" class="form-label badge  badge  bg-success bg-light">* Marca
                    </label>
                    <select name="marca" id="marca" class="form-control border border-secondary">
                        <option value="0">Seleccione una Marca</option>
                        @foreach ($marcasvh as $marca)
                        <option value="{{$marca->id}}">{{$marca->description}}</option>
                        @endforeach
                    </select>
                    @error('marca')<small>* {{ $message }}</small>@enderror
                </div>
                <div class="col-md-4">
                    <label for="inputPassword4" class="form-label  badge  bg-success bg-light">* Referencia</label>
                    <input type="text" class="form-control border border-secondary" name="ref" id="ref" value="{{ old('ref') }}">
                    @error('ref')<small>* {{ $message }}</small>@enderror
                </div>
                <div class="col-md-4">
                    <label for="inputEmail4" class="form-label badge  badge  bg-success bg-light">* Placa</label>
                    <input type="text" class="form-control border border-secondary" id="placa" name="placa" value="{{ old('placa') }}" min="6"
                        max="7">
                    @error('placa')<small>* {{ $message }}</small>@enderror
                </div>
                <div class="col-md-4">
                    <label for="inputEmail4" class="form-label badge  badge  bg-success bg-light">* Kilometraje</label>
                    <input type="number" class="form-control border border-secondary" id="kms" name="kms" value="{{ old('kms') }}">
                    @error('kms')<small>* {{ $message }}</small>@enderror
                </div>
                <div class="col-md-4">
                    <label for="inputEmail4" class="form-label badge  badge  bg-secondary bg-light">*
                        Modelo</label>
                    <select name="modelvh" id="modelvh" class="form-control border border-secondary">
                        <option value="0">Seleccione un Modelo</option>
                        @foreach($modelos as $modelo)
                        <option value="{{ $modelo }}">{{ $modelo }}</option>
                        @endforeach
                    </select>
                    @error('modelvh')<small>* {{ $message }}</small>@enderror
                </div>
                <div class="col-md-4">
                    <label for="inputEmail4" class="form-label badge  badge  bg-success bg-light">*
                        Color</label>
                    <select name="color" id="color" class="form-control border border-secondary">
                        <option value="0">Seleccione un color</option>
                        <option value="Amarillo" {{ old('color')=='Amarillo'  ? 'selected' : '' }}>Amarillo</option>
                        <option value="Azul" {{ old('color')=='Azul'  ? 'selected' : '' }}>Azul</option>
                        <option value="Beige" {{ old('color')=='Beige'  ? 'selected' : '' }}>Beige</option>
                        <option value="Blanco" {{ old('color')=='Blanco'  ? 'selected' : '' }}>Blanco</option>
                        <option value="Gris" {{ old('color')=='Gris'  ? 'selected' : '' }}>Gris</option>
                        <option value="Marron" {{ old('color')=='Marron'  ? 'selected' : '' }}>Marron</option>
                        <option value="Negro" {{ old('color')=='Negro'  ? 'selected' : '' }}>Negro</option>
                        <option value="Plata" {{ old('color')=='Plata'  ? 'selected' : '' }}>Plata</option>
                        <option value="Rojo" {{ old('color')=='Rojo'  ? 'selected' : '' }}>Rojo</option>
                        <option value="Verde" {{ old('color')=='Verde'  ? 'selected' : '' }}>Verde</option>
                        <option value="Vinotinto" {{ old('color')=='Vinotinto'  ? 'selected' : '' }}>Vinotinto</option>
                        </option>
                    </select>
                    @error('color')<small>* {{ $message }}</small>@enderror
                </div>
                <div class="col-md-12">
                    <label for="inputEmail4" class="form-label badge  badge  bg-success bg-light"> Observaciones</label>
                    <textarea name="obs" id="obs" cols="30" rows="3" class="form-control border border-secondary" value="{{ old('obs') }}"></textarea>
                    @error('obs')<small>* {{ $message }}</small>@enderror
                </div>
                <div class="card-body">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-warning btn-sm">Asignar Vehiculo</button>
                    </div>
                </div>

            </form>

        </div>

    </div>

</div>




@endsection