@extends('layouts.app')


@section('content')
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cambios</title>
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
    <h4 class="text-black-50 text-center"><span class="badge badge bg-warning bg-gradient">Cambios de Aceite
            Realizados</span></h4>

    {{-- <a href="/CreateCustomers" class="btn btn-primary">Crear Nuevo Cliente</a> --}}
    <hr>
    @include("error")
    @include("notification")
    <div class="card border border-secondary">
        <div class="card-body">
            <div class="input-group mb-3">
                <input type="text" class="form-control border border-default" id="txtbusca"
                    placeholder="Ingrese Texto Busqueda" aria-label="Buscar" aria-describedby="basic-addon2">
                <div class="input-group-append">
                    <span class="input-group-text" id="basic-addon2"><i class="fa fa-search"></i></span>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table  table-hover table-bordered" id="clientes">
                    <thead class="table-warning">
                        <tr>
                            <th scope="col">SERVICIO REALIZADO</th>
                            <th scope="col">PLACA</th>
                            <th scope="col">NOMBRE PROPIETARIO</th>
                            <th scope="col">CELULAR</th>
                            <th scope="col">CORREO ELECTRONICO</th>
                            <th scope="col">FECHA CAMBIO</th>
                            <th scope="col">GESTIONAR</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($services as $item)
                        <tr>
                            <td>{!! $item->conceptomano !!}</td>
                            <td style="background-color: yellow;border:2px solid black;color:black" class="text-center">
                                {!! $item->placa !!}</td>
                            <td>{!! $item->nombrecliente !!}</td>
                            <td>{!! $item->numerocel !!}</td>
                            <td>{!! $item->email !!}</td>
                            <td style="background-color: yellow;border:2px solid black;color:black" class="text-center">
                                {{ date('d-M-y', strtotime($item->created_at)) }}</td>
                            <td>
                                <a href="https://wa.me/57{{ $item->numerocel }}?text=Hola Recuerda tu cambio de Aceite, Taller Martin Barrera" class="btn btn-success" target="_blank"><span
                                        class="fas fa-phone"></span>
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

</html>
@endsection