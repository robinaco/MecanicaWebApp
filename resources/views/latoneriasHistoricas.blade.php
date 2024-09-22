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
    <style>
        .container {
            max-width: 600px;
        }
        .history{

            background-color: whitesmoke;
        }
    </style>
</head>

<body>
    <h4 class="text-black-50 text-center"><span class="badge badge bg-secondary bg-gradient">Listado Ordenes de
            Servicio Historicas</span></h4>

    <hr>
    @include("error")
    @include("notification")
    <div class="card border border-secondary history">
        <div class="card-body border border-secondary">
            <div class="input-group mb-3">
                <input type="text" class="form-control border border-default" id="txtbusca"
                    placeholder="Ingrese Texto Busqueda" aria-label="Buscar" aria-describedby="basic-addon2">
                <div class="input-group-append">
                    <span class="input-group-text" id="basic-addon2"><i class="fa fa-search"></i></span>
                </div>
            </div>
            <div id="no-more-tables">
                <table class="col-md-12 table-hoover table-condensed cf" id="latonerias">
                    <thead class="cf">
                        <tr>
                            <th scope="col" class="numeric">ITEM</th>
                            <th scope="col" class="numeric">PLACA</th>
                            <th scope="col" class="numeric">FECHA REGISTRO</th>
                            <th scope="col" class="numeric"># ORDEN</th>
                            <th scope="col" class="numeric">ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($services as $item)
                        <tr>
                            <td class=""  data-title="Item"><span class="badge bg-secondary btn btn-lg">
                                {{ $loop->index + 1 }}
                            </span></td>
                            <td
                                style="background-color: gray;border:1px solid yellow;color:white">
                                {!!$item->placa !!}
                            </td>
                            <td>
                                {!!$item->created_at!!}
                             </td>
                            <td data-title="# Orden" class="numeric bg bg-default"><b>{!! $item->ordenlatoneria !!}</b></td>
                            <td class="numeric" data-title="Acciones" colspan="4"> 
                                <a href="/{{ $item->id }}/verlt" class="btn btn-secondary btn-sm" title="Ver Orden Historica"><span
                                    class="fas fa-eye"></span>
                                Visualizar</a>                                
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
    $('#latonerias').find('tr').each(function () {
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