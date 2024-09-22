@extends('layouts.app')

@section('content')

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Agregar Lavado</title>
       <!-- CSS -->
       <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">
       <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
       <style>
           .container {
               max-width: 600px;
           }
       </style>
</head>
<body>
    <h4 class="text-black-50 text-center">Agregar Lavado Orden 
        </h4>
        <a href="/OrdenesLatonerias" class="btn btn-primary"><< Atras</a>
        <hr>
    @include("error")
    @include("notification")
    <div class="card border-secondary border-gradient border-gradient mb-3" style="padding:1%">
        <form class="row g-3" action="SaveLavado" method="POST">
            @csrf
            <div class="col-md-4">
                <label for="inputPassword4" class="form-label  badge  bg-success bg-light">
                    Número de Orden </label>
                <input type="text" value="{{ $inventario->ordenlatoneria }}" class="form-control border border-secondary border-gradient border-gradient" readonly name="orden">
                @error('orden')<small>* {{ $message }}</small>@enderror
            </div>
            
            <div class="col-md-4">
                <label for="inputPassword4" class="form-label  badge  bg-success bg-light">*
                    Tipo de Lavado </label>
                    <select name="tipolavado" id="tipolavado" class="form-control border border-secondary">
                        <option value="0">Seleccione Tipo Lavado</option>
                        <option value="Sencilla" {{ old('tipolavado')=='Sencilla' ? 'selected' : '' }}>Sencilla</option>
                        <option value="Brillada" {{ old('tipolavado')=='Brillada' ? 'selected' : '' }}>Brillada</option>
                        <option value="Motor" {{ old('tipolavado')=='Motor' ? 'selected' : '' }}>Motor</option>
                        <option value="Polichada" {{ old('tipolavado')=='Polichada' ? 'selected' : '' }}>Polichada</option>
                   </select>
                @error('tipolavado')<small>* {{ $message }}</small>@enderror
            </div>
            <div class="col-md-4">
                <label for="inputPassword4" class="form-label  badge  bg-success bg-light">*
                    Valor Lavado</label>
                <input type="number"
                    class="form-control border border-secondary border-gradient border-gradient" name="valor"
                    id="valor" value="{{ old('valorclean') }}" min="1">
                @error('valor')<small>* {{ $message }}</small>@enderror
            </div>
            <div class="card-body">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-success bg-success bg-gradient">Registrar</button>
                </div>
            </div>
        </form>
    </div>
    
    
</body>
</html>
@endsection