@extends('layouts.app')


@section('content')

<!DOCTYPE html>
<html lang="en">
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
<h4 class="text-black-50 text-center"><span class="badge badge bg-success bg-gradient">Listado Productos Inventario</span></h4>

<a href="/createProduct" class="btn btn-success btn-sm">Crear Nuevo Producto

</a>
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
                <table class="col-md-12 table-hoover table-condensed cf" id="products">
                    <thead class="cf thead-dark">
                        <tr>
                            <th>Cod. Producto</th>
                            <th>Categoria</th>
                            <th>Descripción Producto</th>
                            <th>Cantidad</th>
                            <th>Valor Neto</th>
                            <th>Valor Venta</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $item)
                        <tr>
                            <td  data-title="# Registro"><span class="fas fa-product"></span> {!! $item->codigoproducto !!}</td>
                            <td  data-title="Categoria">{!! $item->categoriaproducto !!}</td>
                            <td  data-title="Descripcion">{!! $item->descripcionproducto !!}</td>
                            <td  data-title="Cantidad">{!! $item->cantidadproducto !!}</td>
                            <td  data-title="Valor Compra"><b>$</b>
                                @php echo
                                         number_format($item->valornetounidad ,0);
                                @endphp
                            </td>
                            <td  data-title="Valor Venta"><b>$</b>
                                @php echo
                                         number_format($item->valorventacomercial,0);
                                @endphp
                            </td>
                             <td  data-title="Acciones">
                                <a href="/{{ $item->id }}/editProduct" class="btn btn-secondary btn-sm" title="Editar Información"><span
                                        class="fas fa-pen"></span> Editar Producto
                                </a>
                                <a href="/{{ $item->id }}/deleteProduct" class="btn btn-danger btn-sm" title="Borrar Producto"><span
                                    class="fas fa-trash"></span> Borrar Producto
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
    $('#products').find('tr').each(function () {
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