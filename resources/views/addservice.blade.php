@extends('layouts.app')

@section('content')

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registrar Servicios</title>
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
    <h4 class="text-black-50 text-center"><span class="badge badge bg-warning bg-gradient">Agregar Orden Servicio:
        {{ $vehiculo->placa }}</span></h4>
    <a href="/MecanicaApp/public/VehiculesList" class="btn btn-primary"><< Atras</a>
    <hr>
    @include("error")
    @include("notification")
    @include("advertisement")

    <div class="card border-secondary border-gradient border-gradient mb-3" style="padding:1%">
        <form class="row g-3" action="SaveService" method="POST">
            @csrf
            <div class="col-md-2">
                <h1><span class="badge badge-warning"><i class="nav-icon fas fa-tools"></i></span></h1>
            </div>
            <div class="col-md-6">
                <h4>Orden:<span style="color:orangered"> {{$ordens}}</span></h4>
            </div>
            <div class="col-md-4">
                <h3><span class="">Medellin, @php echo date('Y-m-d');@endphp</span></h3>
            </div>
            <i><span class="badge bg-danger bg-gradient">Campos marcados con * son obligatorios.</span></i>
            <div class="card border-secondary border-gradient border-gradient mb-3" style="padding:1%">
                <div class="row">
                    <div class="col-8">
                    </div>
                    <div class="col-4">
                        <button class="btn btn-warning bg-dark bg-gradient" id="addrows" type="button">Agregar</button>
                    </div>
                </div>
                <div class="row g-3">
                    <input type="hidden" value="{{$ordens}}" name="ods[]" id="ods" class="form-control" readonly>
                    <input type="hidden" value="{{$vehiculo->id}}" name="idvehiculo[]" id="idvehiculo"
                        class="form-control" readonly>
                    <div class="col-sm-2">
                        <label for="inputPassword4" class="form-label  badge  bg-success bg-light">*
                            Concepto Servicio</label>
                        <select name="conceptomo[]" id="conceptomo"
                            class="form-control border border-secondary border-gradient border-gradient">
                            <option value="0">Seleccione Concepto</option>
                            <option value="Mecanica General">Mecanica General</option>
                            <option value="Cambio Aceite">Cambio Aceite</option>
                            <option value="Escaneo">Escaneo</option>
                            <option value="Laboratorio Inyectores">Laboratorio Inyectores</option>
                            <option value="Verificación Niveles">Verificación Niveles</option>
                        </select>
                        @error('conceptomo')<small>* {{ $message }}</small>@enderror
                    </div>
                    <div class="col-sm-2">
                        <label for="inputPassword4" class="form-label  badge  bg-success bg-light">*
                            Tipo Servicio</label>
                        <select name="concepto[]" id="concepto"
                            class="form-control border border-secondary border-gradient border-gradient">
                            <option value="0">Seleccione Tipo</option>
                            <option value="Repuesto">Repuesto</option>
                            <option value="Trabajo Interno o Externo">Trabajo Interno ó Externo</option>
                        </select>
                        @error('concepto')<small>* {{ $message }}</small>@enderror
                    </div>

                    <div class="col-sm-2">
                        <label for="inputPassword4" class="form-label  badge  bg-success bg-light">*
                            Valor Unitario</label>
                        <input type="number"
                            class="form-control border border-secondary border-gradient border-gradient" name="valor1[]"
                            id="valor1" value="{{ old('valor1') }}" min="1">
                        @error('valor1')<small>* {{ $message }}</small>@enderror
                    </div>
                    <div class="col-sm-1">
                        <label for="inputPassword4" class="form-label  badge  bg-success bg-light">*
                            Cantidad</label>
                        <input type="number"
                            class="form-control border border-secondary border-gradient border-gradient"
                            name="cantidad[]" id="cantidad" value="1" min="1">
                        @error('cantidad')<small>* {{ $message }}</small>@enderror
                    </div>
                    <div class="col-sm-2">
                        <label for="inputPassword4" class="form-label  badge  bg-success bg-light">*
                            Operario</label>
                        <input type="text" class="form-control border border-secondary border-gradient border-gradient"
                            name="operario[]" id="operario" value="{{ old('operario') }}">
                        @error('operario')<small>* {{ $message }}</small>@enderror
                    </div>
                    <div class="col-md-3">
                        <label for="inputPassword4" class="form-label  badge  bg-success bg-light">*
                            Descripcion</label>
                        <input type="text" class="form-control border border-secondary border-gradient border-gradient"
                            name="descmo[]" id="descmo" value="{{ old('descmo') }}">
                        @error('descmo')<small>* {{ $message }}</small>@enderror
                    </div>
                </div>
                <div id="newRows"></div>

                <hr>
            </div>
            <div class="card-body">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-dark bg-dark bg-gradient">Guardar Orden Servicio</button>
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
        htmla += '<div class="row g-3">';
        htmla +='<input type="hidden" value="{{$ordens}}" name="ods[]" id="ods" class="form-control" readonly>'
        htmla +='<input type="hidden" value="{{$vehiculo->id}}" name="idvehiculo[]" id="idvehiculo" class="form-control" readonly>' 
        htmla += '<div class="col-md-2" id="">'; 
        htmla += '<select name="conceptomo[]" id="conceptomo" class="form-control border border-secondary border-gradient border-gradient">';
        htmla += '<option value="0">Seleccione Concepto</option>';
        htmla += '<option value="Mecanica General">Mecanica General</option>';
        htmla += '<option value="Cambio Aceite">Cambio Aceite</option>';
        htmla += '<option value="Verificación Niveles">Verificación Niveles</option>';                
        htmla += '<option value="Escaneo">Escaneo</option>';
        htmla += '<option value="Laboratorio Inyectores">Laboratorio Inyectores</option>';
        htmla += '</select>';
        htmla += '</div>'; 
        htmla += '<div class="col-md-2">';             
        htmla += '<select name="concepto[]" id="concepto" class="form-control border border-secondary border-gradient border-gradient">';
        htmla += '<option value="0">Seleccione Tipo</option>';
        htmla += '<option value="Repuesto">Repuesto</option>';
        htmla += '<option value="Trabajo Interno o Externo">Trabajo Interno ó Externo</option>';
        htmla += '</select>';
        htmla += '</div>';
        htmla += '<div class="col-md-2" id="">';
        htmla += ' <input type="number" class="form-control border border-secondary border-gradient border-gradient" name="valor1[]" id="valor1"  min="1">';
        htmla += '</div>';
        htmla += '<div class="col-md-1">';
        htmla += ' <input type="number" class="form-control border border-secondary border-gradient border-gradient" name="cantidad[]" id="cantidad" min="1" value="1"> ';
        htmla += '</div>';
        htmla += '<div class="col-md-2" id="">';
        htmla += ' <input type="text" class="form-control border border-secondary border-gradient border-gradient" name="operario[]" id="operario"> ';
        htmla += '</div>';
        htmla += '<div class="col-md-3">';
        htmla += ' <input type="text" class="form-control border border-secondary border-gradient border-gradient" name="descmo[]" id="descmo"> ';
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