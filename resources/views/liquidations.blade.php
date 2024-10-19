@extends('layouts.app')


@section('content')
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>
<body>
    <h4 class="text-black-50 text-center"><span class="badge badge bg-success bg-gradient">Listado Ordenes
        Liquidadas Tecnicos</span></h4>
        <hr>
        <div class="card border border-secondary">
            <div class="card-body border border-secondary">
                <div class="input-group mb-3">
                    <input type="text" class="form-control border border-default" id="txtbuscar"
                        placeholder="Ingrese Texto Busqueda" aria-label="Buscar" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <span class="input-group-text" id="basic-addon2"><i class="fa fa-search"></i></span>
                    </div>
                </div>
                <div id="no-more-tables">
                    <table class="col-md-12 table-hoover table-striped table-bordered"  id="liquidaciones">
                        <thead class="cf">
                            <tr>
                                <th scope="col" class="numeric">ITEM</th>
                                <th scope="col" class="numeric">PLACA</th>
                                <th scope="col" class="numeric">LINEA</th>
                                <th scope="col" class="numeric">NOMBRE TECNICO</th>
                                <th scope="col" class="numeric"># ORDEN</th>
                                <th scope="col" class="numeric">TOTAL ORDEN</th>
                                <th scope="col" class="numeric">PORCENTAJE APLICADO</th>
                                <th scope="col" class="numeric">COSTO MANO DE OBRA</th>
                                <th scope="col" class="numeric">VALOR UTILIDAD TALLER</th>
                                <th scope="col" class="numeric">FECHA REGISTRO</th>
                                <th scope="col" class="numeric">ACCIONES</th>
                            </tr>
                        </thead>
                         <tbody>
                            @foreach ($liquidations as $item)
                            <tr>
                                <td data-title="Item"><span class="badge bg-success btn btn-lg">
                                    {{ $loop->index + 1 }}
                                </span></td>
                                <td data-title="Placa Vehiculo">
                                    {!!$item->placa !!}
                                </td>
                                <td data-title="Linea Vehiculo">
                                    {!!$item->referencia !!}
                                </td>
                                <td data-title="Nombre Técnico">
                                    {!!$item->nombremecanico !!}
                                </td>
                                <td data-title="# Orden">
                                    {!!$item->ordenlatoneria !!}
                                </td>
                                <td data-title="Total Orden"><b>$</b>
                                    @php echo
                                         number_format($item->valorcosto ,0);
                                    @endphp
                                </td>
                                <td data-title="% Mano de Obra"> 
                                    {!!$item->porcentaje !!}<b>%</b> 
                                </td>
                                <td data-title="Valor Mano de Obra"><b>$</b>
                                    @php echo
                                         number_format($item->valorempleado ,0);
                                    @endphp
                                </td>
                                <td data-title="Valor Utilidad Taller"><b>$</b>
                                    @php echo
                                         number_format($item->valorutilidad ,0);
                                    @endphp
                                </td>
                                <td data-title="Fecha Registro">
                                    {!!$item->date !!}
                                </td>
                                 <td class="numeric" data-title="Acciones" colspan="4">
                                    <a href="/{{$item->idInventario}}/getliquidationpdf" class="btn btn-danger btn-sm"><span
                                        class="fas fa-file-pdf" target="_blank" data-title="tooltip" > </span> Descargar
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
        $('#txtbuscar').on('keyup', function () {
    var value = $(this).val();
    var patt = new RegExp(value, "i");
    $('#liquidaciones').find('tr').each(function () {
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