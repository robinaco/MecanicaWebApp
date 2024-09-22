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
            max-width: 90%;
        }
        .history{
            background-color: whitesmoke;
        }

    </style>
</head>
<body>
    <h4 class="text-black-50 text-center"><span class="badge badge bg-secondary bg-gradient">Listado Empleados Registrados</span></h4>
    <a href="/CreateMechanics" class="btn btn-secondary btn-sm">Crear Nuevo Empleado</a>
    <hr>
    @include("error")
    @include("notification")
    <div class="card border border-secondary history">
        <div class="card-body border border-secondary">
            <div class="input-group mb-3">
                <input type="text" class="form-control border border-default" id="txtbusca" placeholder="Ingrese Texto Busqueda" aria-label="Buscar"
                    aria-describedby="basic-addon2">
                <div class="input-group-append">
                    <span class="input-group-text" id="basic-addon2"><i class="fa fa-search"></i></span>
                </div>
            </div>
            <div id="no-more-tables">
                <table class="col-md-12 table-hoover table-condensed cf" id="clientes">
                    <thead class="cf thead-dark">
                        <tr>
                            <th># DOCUMENTO EMPLEADO</th>
                            <th>NOMBRE EMPLEADO</th>
                            <th>CELULAR EMPLEADO</th>
                            <th>ROL EMPLEADO</th>
                            <th>ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($mechanics as $item)
                        <tr>
                            <td  data-title="# Documento"><span class="fas fa-address-card"></span> {!! $item->numerodocumento !!}</td>
                            <td  data-title="Nombre">{!! $item->nombremecanico !!}</td>
                            <td  data-title="Celular">{!! $item->numerocelmecanico !!}</td>
                            <td  data-title="Rol Empleado">{!! $item->tipousuario !!}</td>
                            <td  data-title="Acciones">
                                <a href="/{{ $item->id }}/editEmployee" class="btn btn-secondary btn-sm" title="Editar información"><span
                                        class="fas fa-pen"></span> Editar Empleado
                                </a>
                                <a href="/{{ $item->id }}/deleteEmployee" class="btn btn-danger btn-sm" title="Inactivar Empleado"><span
                                    class="fas fa-trash"></span> Borrar Empleado
                                </a>
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
</body>
</html>
@endsection