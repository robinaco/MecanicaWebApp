@extends('layouts.app')


@section('content')
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
</head>
<body>
    <h4 class="text-black-50 text-center"><span class="badge badge bg-secondary bg-gradient">Buscar Ordenes por Técnico</span></h4>
<div class="container">
    <div class="card bg-ligth bg-gradient border border-secondary">
        <div class="card-body">
            <form class="row g-3" action="buscarOrders" method="POST" enctype="multipart/form-data">
                @csrf
            <div class="row">
                <div class="col-md-4">
                    <label for="inputEmail4" class="form-label badge  badge  bg-success bg-light">* Nombre Técnico
                        </label>
                    <select name="tecnico" id="tecnico" class="form-control border border-secondary">
                        <option value=0>Seleccione Técnico</option>
                        @foreach ($empleados as $item)
                        <option value="{{$item->id}}">{{$item->nombremecanico}}</option>
                        @endforeach
                    </select>
                    @error('tecnico')<small>* {{ $message }}</small>@enderror
                </div>
                <div class="col-md-4">
                    <label for="date" class="form-label badge  badge  bg-success bg-light">* Fecha Inicial</label>
                        <input type="date" class="form-control" name="dateini" id="dateini" max="<?= date('Y-m-d'); ?>">
                        @error('dateini')<small>* {{ $message }}</small>@enderror 
                </div>
                <div class="col-md-4">
                    <label for="date" class="form-label badge  badge  bg-success bg-light">* Fecha Final</label>
                        <input type="date" class="form-control" name="dateend" id="dateend" max="<?= date('Y-m-d'); ?>">
                        @error('dateend')<small>* {{ $message }}</small>@enderror 
                </div>
               
            </div>
           
        </div>
        <div class="card-body">
            <div class="col-md-12">
                <button type="submit" class="btn btn-secondary bg- bg-gradient btn-sm" id="searchUser">Buscar Ordenes
                    </button>
            </div>
        </div>
    </form>
    </div>

</div>
</body>

</html>

@endsection


