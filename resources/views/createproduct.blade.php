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

<h4 class="text-black-50 text-center"><span class="badge badge bg-success bg-gradient">Registrar Nuevo Producto</span></h4>

<a href="/ProductList" class="btn btn-success btn-sm"> << Atras</a>
<hr>
@include("error")
@include("notification")
@include("advertisement")
<div class="card bg-ligth bg-gradient border border-secondary">
<span class="imgsl"><img src="/images/oil.png"></span>
    <div class="card-body">
        <i><span class="badge bg-danger bg-gradient">Campos marcados con * son obligatorios.</span></i>
        <div class="card border border-secondary mb-3" style="padding:1%">
            <form class="row g-3" action="SaveProduct" method="POST">
                @csrf
                <div class="col-md-5">
                    <label for="inputPassword4" class="form-label  badge  bg-success bg-light">* Categoria Producto</label>
                    <select name="categoriaproduct" id="categoriaproduct" class="form-control border border-secondary">
                        <option value="0">Seleccione Categoria</option>
                        <option value="ACEITES" {{ old('categoriaproduct')=='ACEITES' ? 'selected' : '' }}>ACEITES</option>
                        <option value="ACCESORIOS" {{ old('categoriaproduct')=='ACCESORIOS' ? 'selected' : '' }}>
                        ACCESORIOS</option>
                        
                        <option value="REPUESTOS MECANICOS" {{ old('categoriaproduct')=='REPUESTOS MECANICOS' ? 'selected' : '' }}>
                        REPUESTOS MECANICOS</option>
                        <option value="REPUESTOS ELECTRICOS" {{ old('categoriaproduct')=='REPUESTOS ELECTRICOS' ? 'selected' : '' }}>
                        REPUESTOS ELECTRICOS</option>
                   </select>
                    @error('categoriaproduct')<small>* {{ $message }}</small>@enderror
                </div>
                <div class="col-md-2">
                    <label for="inputEmail4" class="form-label badge  badge  bg-secondary bg-light">* Codigo Producto</label>
                    <input type="text" class="form-control border border-secondary" id="codigo"
                        name="codigo" value="{{ old('codigo')}}">
                    @error('codigo')<small>* {{ $message }}</small>@enderror
                </div>
                <div class="col-md-5">
                    <label for="inputEmail4" class="form-label badge  badge  bg-secondary bg-light">* Descripción Producto</label>
                    <input type="text" class="form-control border border-secondary" id="descripcionproducto"
                        name="descripcionproducto" value="{{ old('descripcionproducto')}}">
                    @error('descripcionproducto')<small>* {{ $message }}</small>@enderror
                </div>
                <div class="col-md-4">
                    <label for="inputEmail4" class="form-label badge  badge  bg-secondary bg-light">* Cantidad Producto</label>
                    <input type="number" class="form-control border border-secondary" id="cantidadproducto"
                        name="cantidadproducto" value="{{ old('cantidadproducto') }}" min="1">
                    @error('cantidadproducto')<small>* {{ $message }}</small>@enderror

                </div>
                <div class="col-md-4">
                    <label for="inputEmail4" class="form-label badge  badge  bg-success bg-light">* Valor Compra Producto</label>
                    <input type="number" class="form-control border border-secondary" id="valorcompraproducto" name="valorcompraproducto"
                        value="{{ old('valorcompraproducto') }}" min="1">
                    @error('valorcompraproducto')<small>* {{ $message }}</small>@enderror
                </div>
                <div class="col-md-4">
                    <label for="inputEmail4" class="form-label badge  badge  bg-success bg-light">* Valor Comercial Producto</label>
                    <input type="number" class="form-control border border-secondary" id="valorventaproducto" name="valorventaproducto"
                    value="{{ old('valorventaproducto') }}" min="1">
                        @error('valorventaproducto')<small>* {{ $message }}</small>@enderror
                </div>
                <div class="card-body">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-success btn-sm">Registrar Producto</button>
                    </div>
                </div>

            </form>

        </div>

    </div>

</div>

    
</body>
</html>


@endsection