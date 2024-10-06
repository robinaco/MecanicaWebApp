@extends('layouts.app')


@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Herramienta</title>
</head>
<body>

<h4 class="text-black-50 text-center"><span class="badge badge bg-secondary bg-gradient">Registrar Nueva Herramienta</span></h4>

<a href="/ToolList" class="btn btn-secondary btn-sm"> << Atras</a>
<hr>
@include("error")
@include("notification")
@include("advertisement")
<div class="card bg-ligth bg-gradient border border-secondary">
<span class="imgsl"><img src="/images/tool-box.png"></span>
    <div class="card-body">
    <i><span class="badge bg-danger bg-gradient">Campos marcados con * son obligatorios.</span></i>
        <div class="card border border-secondary mb-3" style="padding:1%">
            <form class="row g-3" action="SaveTool" method="POST">
                @csrf
                <div class="col-md-3">
                    <label for="inputPassword4" class="form-label  badge  bg-success bg-light">* Categoria Herramienta</label>
                    <select name="categoriatool" id="categoriatool" class="form-control border border-secondary">
                        <option value="0">Seleccione Categoria</option>
                        <option value="Oficina" {{ old('categoriatool')=='Oficina' ? 'selected' : '' }}>OFICINA</option>
                        <option value="Taller" {{ old('categoriatool')=='Taller' ? 'selected' : '' }}>
                            TALLER</option>
                   </select>
                    @error('categoriatool')<small>* {{ $message }}</small>@enderror
                </div>
                <div class="col-md-3">
                    <label for="inputEmail4" class="form-label badge  badge  bg-secondary bg-light">* Descripción</label>
                    <input type="text" class="form-control border border-secondary" id="descripciontool"
                        name="descripciontool" value="{{ old('descripciontool')}}">
                    @error('descripciontool')<small>* {{ $message }}</small>@enderror

                </div>
                <div class="col-md-2">
                    <label for="inputEmail4" class="form-label badge  badge  bg-secondary bg-light">* Cantidad</label>
                    <input type="number" class="form-control border border-secondary" id="cantidadtool"
                        name="cantidadtool" value="{{ old('cantidadtool') }}" min="1">
                    @error('cantidadtool')<small>* {{ $message }}</small>@enderror

                </div>
                <div class="col-md-2">
                    <label for="inputEmail4" class="form-label badge  badge  bg-success bg-light">* Valor Compra</label>
                    <input type="number" class="form-control border border-secondary" id="valorcompratool" name="valorcompratool"
                        value="{{ old('valorcompratool') }}" min="1">
                    @error('valorcompratool')<small>* {{ $message }}</small>@enderror
                </div>
                <div class="col-md-2">
                    <label for="inputEmail4" class="form-label badge  badge  bg-success bg-light">* Valor Comercial</label>
                    <input type="number" class="form-control border border-secondary" id="valorventatool" name="valorventatool"
                    value="{{ old('valorventatool') }}" min="1">
                        @error('valorventatool')<small>* {{ $message }}</small>@enderror
                </div>
                <div class="card-body">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-secondary btn-sm">Registrar Herramienta</button>
                    </div>
                </div>

            </form>

        </div>

    </div>

</div>

    
</body>
</html>


@endsection