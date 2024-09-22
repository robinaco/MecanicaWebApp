@extends('layouts.app')

@section('content')

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Agregar Trabajos</title>
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
    <h4 class="text-black-50 text-center">Agregar Trabajos - Repuestos:
        {{ $vehiculo->placa }}</h4>
    <a href="/VehiculesList" class="btn btn-primary"><< Atras</a>
    <hr>
    @include("error")
    @include("notification")
    <div class="card border-secondary border-gradient border-gradient mb-3" style="padding:1%">
        <form class="row g-3" action="SaveJobs" method="POST">
            @csrf
            <div class="col-md-8">
                <h1> <span class=""><i class="nav-icon fas fa-tools"></i></span></h1>
            </div>
            <div class="col-md-1">
            </div>
            <div class="col-md-3">
                <h3><span class="">Medellin, @php echo date('Y-m-d');@endphp</span></h3>
            </div>
            <div class="card border-secondary border-gradient border-gradient mb-3" style="padding:1%">
                <h3 class="text-black-50 text-center">Registro Trabajos -
                        Repuestos
                </h3>
                <hr>
                <div class="row">
                    <div class="col-3">
                        <i><span class="badge bg-danger bg-gradient">Campos marcados con * son obligatorios.</span></i>
                    </div>
                    <div class="col-6">
                    </div>
                    <div class="col-3">
                        <button class="btn btn-warning bg-dark bg-gradient" id="addrows" type="button" onclick="create_UUID()">+
                            Agregar</button>
                    </div>
                </div>
                <div class="row g-3" id="trabajos">
                    <div class="col-sm-1">
                        <label for="inputPassword4" class="form-label  badge  bg-success bg-light">
                            IdVehiculo</label>
                        <input type="text" value="{{$vehiculo->id}}" name="idvehiculo[]" id="idvehiculo"
                            class="form-control" readonly>
                    </div>
                    <div class="col-md-3">
                        <label for="inputPassword4" class="form-label  badge  bg-success bg-light">*
                            Concepto Trabajo</label>
                        <select name="concepto[]" id="concepto"
                            class="form-control border border-secondary border-gradient border-gradient">
                            <option value="0">Seleccione Concepto</option>
                            <option value="Repuesto">Repuesto</option>
                            <option value="Trabajo Externo">Trabajo Externo</option>
                        </select>
                        @error('concepto')<small>* {{ $message }}</small>@enderror
                    </div>
                    <div class="col-md-4">
                        <label for="inputPassword4" class="form-label  badge  bg-success bg-light">*
                            Descripcion</label>
                        <input type="text" class="form-control border border-secondary border-gradient border-gradient"
                            name="describework[]" id="describework" value="{{ old('describework') }}">
                        @error('describework')<small>* {{ $message }}</small>@enderror

                    </div>
                    <div class="col-md-1">
                        <label for="inputPassword4" class="form-label  badge  bg-success bg-light">*
                            Cantidad</label>
                        <input type="number"
                            class="form-control border border-secondary border-gradient border-gradient"
                            name="cantidad[]" id="cantidad" value="1" min="1">
                        @error('cantidad')<small>* {{ $message }}</small>@enderror

                    </div>
                    <div class="col-md-3">
                        <label for="inputPassword4" class="form-label  badge  bg-success bg-light">*
                            Valor Unitario</label>
                        <input type="number"
                            class="form-control border border-secondary border-gradient border-gradient" name="valor2[]"
                            id="valor2" value="{{ old('valor2') }}" min="1">
                        @error('valor2')<small>* {{ $message }}</small>@enderror
                    </div>
                    <div id="newRows"></div>
                </div>
                <hr>
            </div>
            <div class="card-body">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-dark bg-dark bg-gradient">Guardar Trabajo - Repuesto</button>
                </div>
            </div>
        </form>
    </div>
</html>



</body>
<!-- JavaScript -->
<script type="text/javascript">
    $("#addrows").click(function () {

        var htmla = '';
        htmla += '<div id="manitos1">';
        htmla += '<br>';
        htmla += '<button type="button" class="btn btn-danger" id="quitar1">X</button>';
        htmla += '<div id="trabajos" class="row g-3">';
        htmla += '<div class="col-sm-1">'
        htmla += '<input type="text" value="{{$vehiculo->id}}" name="idvehiculo[]" id="idvehiculo" class="form-control" readonly>';
        htmla += '</div>'    
        htmla += '<div class="col-md-3">';             
        htmla += '<select name="concepto[]" id="concepto" class="form-control border border-secondary border-gradient border-gradient">';
        htmla += '<option value="0">Seleccione Concepto</option>';
        htmla += '<option value="Repuesto">Repuesto</option>';
        htmla += '<option value="Trabajo Externo">Trabajo Externo</option>';
        htmla+= '</select>';
        htmla += '</div>';
        htmla += '<div class="col-md-4">';
        htmla += ' <input type="text" class="form-control border border-secondary border-gradient border-gradient" name="describework[]" id="describework"> ';
        htmla += '</div>';
        htmla += '<div class="col-md-1">';
        htmla+= ' <input type="number" class="form-control border border-secondary border-gradient border-gradient" name="cantidad[]" id="cantidad" min="1" value="1"> ';
        htmla += '</div>';
        htmla += '<div class="col-md-3">';
        htmla+= ' <input type="number" class="form-control border border-secondary border-gradient border-gradient" name="valor2[]" id="valor2" min="1"> ';
        htmla += '</div>';
        htmla += '</div>';
        $('#newRows').append(htmla);


    });

    // remove row
    $(document).on('click', '#quitar1   ', function () {
        $('#manitos1').remove();
    });
</script>

</html>
@endsection