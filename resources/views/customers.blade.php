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
    <style>
        .container {
            max-width: 600px;
        }
    </style>
</head>

<body>
    <h4 class="text-black-50 text-center"><span class="badge badge bg-warning bg-gradient">Listado Clientes Registrados</span></h4>

    <a href="/CreateCustomers" class="btn btn-primary btn-sm">Crear Nuevo Cliente</a>
    <hr>
    @include("error")
    @include("notification")
    
    <div class="card border border-secondary">
        <div class="card-body border border-secondary">
            <div class="input-group mb-3">
                <input type="text" class="form-control border border-default" id="txtbusca" placeholder="Ingrese Texto Busqueda" aria-label="Buscar"
                    aria-describedby="basic-addon2">
                <div class="input-group-append">
                    <span class="input-group-text" id="basic-addon2"><i class="fa fa-search"></i></span>
                </div>
            </div>
            <div id="no-more-tables">
                <table class="col-md-12 table-hoover  table-bordered table-striped cf" id="clientes">
                    <thead class="cf thead-dark">
                        <tr>
                            <th># DOCUMENTO</th>
                            <th>NOMBRE</th>
                            <th>EMAIL</th>
                            <th>CELULAR</th>
                            <th>ACEPTA TRATAMIENTO DATOS?</th>
                            <th>ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($clientes as $item)
                        <tr>
                            <td  data-title="# Documento"><span class="fas fa-address-card"></span> {!! $item->numcedula !!}</td>
                            <td  data-title="Nombre">{!! $item->nombrecliente !!}</td>
                            <td  data-title="Email">{!! $item->email !!}</td>
                            <td  data-title="Celular">{!! $item->numerocel !!}</td>
                             @if($item->aceptaTTO =='1')
                                <td  data-title="Tratamiento Datos?">SI</td>                                
                                @else 
                                <td  data-title="Tratamiento Datos?">NO</td>  
                                @endif
                            <td  data-title="Acciones">
                                <a href="/{{ $item->id }}/Show" class="btn btn-info btn-sm" title="Ver detalle"><span
                                        class="fas fa-eye"></span> Ver</a>
                                <a href="/{{ $item->id }}/Edit" class="btn btn-success btn-sm" title="Editar información"><span
                                        class="fas fa-pen"></span> Editar</a>
                                <a href="/{{ $item->id }}/AddVh" class="btn btn-warning btn-sm" title="Agregar vehiculo"><span
                                        class="fas fa-car"></span> Agregar</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
       </div>
    </div>
</body>
<script>
    $(document).ready(function(){
        $('#txtbusca').on('keyup', function () {
    var value = $(this).val();
    var patt = new RegExp(value, "i");
    $('#clientes').find('tr').each(function () {
        if (!($(this).find('td').text().search(patt) >= 0)) {
            $(this).not('.titulos_tabla').hide();
        }
        if (($(this).find('td').text().search(patt) >= 0)) {
            $(this).show();
        }
    });
});
})
</script>

</html>
@endsection