@extends('layouts.app')


@section('content')


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Herramienta</title>
</head>
<body>
    
<h4 class="text-black-50 text-center"><span class="badge badge bg-secondary bg-gradient">Actualizar Información Producto Inventario</span></h4>

<a href="/ProductList" class="btn btn-secondary btn-sm"> << Atras</a>
<hr>
@include("error")
@include("notification")
@include("advertisement")
<div class="card bg-ligth bg-gradient border border-secondary">
    <div class="card-body">
        <i><span class="badge bg-danger bg-gradient">Campos marcados con * son obligatorios.</span></i>
        <div class="card border border-secondary mb-3" style="padding:1%">
            <form class="row g-3" action="UpdateProduct" method="POST">
            @csrf
            @method("PUT")
                <div class="col-md-5">
                    <label for="inputPassword4" class="form-label  badge  bg-success bg-light">* Categoria Producto</label>
                    <select name="categoriaproduct" id="categoriaproduct" class="form-control border border-secondary bg-secondary bg-gradient">
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
                    <input type="text" class="form-control border border-secondary bg-secondary bg-gradient" id="codigo"
                        name="codigo" value="{{$product->codigoproducto}}">
                    @error('codigo')<small>* {{ $message }}</small>@enderror

                </div>
                <div class="col-md-5">
                    <label for="inputEmail4" class="form-label badge  badge  bg-secondary bg-light">* Descripción Producto</label>
                    <input type="text" class="form-control border border-secondary bg-secondary bg-gradient" id="descripcionproducto"
                        name="descripcionproducto" value="{{$product->descripcionproducto}}">
                    @error('descripcionproducto')<small>* {{ $message }}</small>@enderror

                </div>
                <div class="col-md-4">
                    <label for="inputEmail4" class="form-label badge  badge  bg-secondary bg-light">* Cantidad</label>
                    <input type="number" class="form-control border border-secondary bg-secondary bg-gradient" id="cantidadproducto"
                        name="cantidadproducto" value="{{$product->cantidadproducto}}" min="1">
                    @error('cantidadproducto')<small>* {{ $message }}</small>@enderror
                </div>
                <div class="col-md-4">
                    <label for="inputEmail4" class="form-label badge  badge  bg-success bg-light">* Valor Compra</label>
                    <input type="number" class="form-control border border-secondary bg-secondary bg-gradient" id="valorcompraproducto" name="valorcompraproducto"
                        value="{{$product->valornetounidad}}" min="1">
                    @error('valorcompraproducto')<small>* {{ $message }}</small>@enderror
                </div>
                <div class="col-md-4">
                    <label for="inputEmail4" class="form-label badge  badge  bg-success bg-light">* Valor Comercial</label>
                    <input type="number" class="form-control border border-secondary bg-secondary bg-gradient" id="valorventaproducto" name="valorventaproducto"
                    value="{{$product->valorventacomercial}}" min="1">
                        @error('valorventaproducto')<small>* {{ $message }}</small>@enderror
                </div>
                <div class="card-body">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-secondary btn-sm">Actualizar Información Producto</button>
                    </div>
                </div>

            </form>

        </div>

    </div>

</div>


</body>
</html>

@endsection