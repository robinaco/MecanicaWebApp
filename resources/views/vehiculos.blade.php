@extends('layouts.app')


@section('content')
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Vehiculos</title>
    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    {{--
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    --}}
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
    {{-- <script src="//code.jquery.com/jquery-1.11.1.min.js"></script> --}}
    <style>
        .container {
            max-width: 600px;
        }
    </style>
</head>

<body>
    <h4 class="text-black-50 text-center"><span class="badge badge bg-warning bg-gradient">Listado Vehiculos
            Registrados</span></h4>

    <hr>
    @include("error")
    @include("notification")
    @include("info")
    <div class="card border border-secondary">
        <div class="card-body border border-secondary">
            <div class="input-group mb-3">
                <input type="text" class="form-control border border-default" id="txtbuscarr"
                    placeholder="Ingrese Texto Busqueda" aria-label="Buscar" aria-describedby="basic-addon2">
                <div class="input-group-append">
                    <span class="input-group-text" id="basic-addon2"><i class="fa fa-search"></i></span>
                </div>
            </div>
            <div id="no-more-tables">
                <table class="col-md-12  table-hoover table-condensed cf" id="vehiculos">
                    <thead class="cf">
                        <tr>
                            <th scope="col" class="numeric">PLACA</th>
                            <th scope="col" class="numeric">MARCA</th>
                            <th scope="col" class="numeric">LINEA</th>
                            <th scope="col" class="numeric">KILOMETRAJE</th>
                            <th scope="col" class="numeric">ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($vehiculos as $item)
                        <tr>

                            <td class="" data-title="Placa"
                                style="background-color: yellow;border:2px solid black">
                                <b>{!!$item->placa !!}</b>
                            </td>
                            <td data-title="Descripcion" class="numeric">{!! $item->description !!}</td>
                            <td data-title="Referencia" class="numeric">{!! $item->referencia !!}</td>
                            <td data-title="Kilometraje" class="numeric"><b>@php echo
                                    number_format($item->kilometraje,0);@endphp</b></td>
                            <td class="numeric" data-title="Acciones">
                                
                               <a href="/{{ $item->id }}/Addorder" class="btn btn-warning btn-sm"><span
                                        class="fas fa-car-crash"></span> Add Orden</a>
                                
                                <a href="/{{ $item->id }}/Editvh" class="btn btn-success btn-sm"><span
                                        class="fas fa-pen"></span>
                                    Editar</a>
                               
                                     
                                <a href="/{{ $item->id }}/deletevehiculo" class="btn btn-danger btn-sm" title="Eliminar Vehiculo"><span
                                            class="fas fa-trash"></span>
                                        Borrar</a>
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
        $('#txtbuscarr').on('keyup', function () {
    var value = $(this).val();
    var patt = new RegExp(value, "i");
    $('#vehiculos').find('tr').each(function () {
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