@extends('layouts.app')


@section('content')
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ordenes</title>
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
    <h4 class="text-black-50 text-center"><span class="badge badge bg-warning bg-gradient">Listado Ordenes Registradas</span></h4>

    <hr>
    @include("error")
    @include("notification")
    <div class="card border border-secondary">
        <div class="card-body">
            <div class="input-group mb-3">
                <input type="text" class="form-control border border-default" id="txtbusca" placeholder="Ingrese Texto Busqueda" aria-label="Buscar"
                    aria-describedby="basic-addon2">
                <div class="input-group-append">
                    <span class="input-group-text" id="basic-addon2"><i class="fa fa-search"></i></span>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-ligth  table-hover" id="ordenes">
                    <thead class="table-success">
                        <tr class="titulos_tabla">
                            <th scope="col">ITEM</th>
                            <th scope="col">PLACA</th>
                            <th scope="col"># ORDEN SERVICIO</th>
                            <th scope="col">ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($services as $item)
                        <tr>
                            <td class=""><span class="badge bg-success btn btn-lg">
                                    {{ $loop->index + 1 }}
                                </span></td>
                            <td class="text-center" style="background-color: yellow;border:2px solid black"><b>{!!
                                    $item->placa !!}</b></td>
                            <td class=""><span class="fas fa-file-contract"> </span> {!! $item->ordenservicio !!}</td>
                            <td>
                                <a href="/{{ $item->ordenservicio }}/ShowOr" class="btn btn-danger"
                                    title="Ver detalle"><span class="fas fa-print"></span> Imprimir Orden</a>
                                <a href="/{{ $item->ordenservicio}}/{{ $item->idvehiculo}}/EditOr"
                                    class="btn btn-success" title="Ver detalle"><span class="fas fa-plus"></span>
                                    Agregar Servicio</a>
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
    $('#ordenes').find('tr').each(function () {
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