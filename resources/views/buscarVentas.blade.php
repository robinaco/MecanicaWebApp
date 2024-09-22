@extends('layouts.app')


@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Buscar Ingresos</title>
</head>
<body>
    <h4 class="text-black-50 text-center"><span class="badge badge bg-secondary bg-gradient">Buscar Ventas Taller</span></h4>

<div class="container">

    <div class="card bg-ligth bg-gradient border border-secondary">
        <div class="card-body">
            <form class="row g-3" action="buscarSales" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <label for="date" class="form-label badge  badge  bg-success bg-light">* Fecha Inicial</label>
                            <input type="date" class="form-control" name="dateini" id="dateini" max="<?= date('Y-m-d'); ?>">
                            @error('dateini')<small>* {{ $message }}</small>@enderror 
                    </div>
                    <div class="col-md-6">
                        <label for="date" class="form-label badge  badge  bg-success bg-light">* Fecha Final</label>
                            <input type="date" class="form-control" name="dateend" id="dateend" max="<?= date('Y-m-d'); ?>">
                            @error('dateend')<small>* {{ $message }}</small>@enderror 
                    </div>  
                </div>
               
         </div>
        <div class="card-body">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-secondary bg- bg-gradient btn-sm" id="searchSales">Buscar Ventas
                        </button>
                </div>
            </div>
            </form>
        
    </div>

</div>
    
</body>
</html>


@endsection