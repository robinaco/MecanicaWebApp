<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informe Mano de Obra</title>
    <style>
        table {
                width: 96%;
                border-spacing: 0;
                margin: auto;
            }
            table.vehiculo {
                font-size: 0.975rem;
            }
            table .vehiculo tr {
                background-color: rgb(96 165 250);
            }
            table.vehiculo th {
                color: black;
                padding: 0.2rem;
                border: 0.5px  solid black;
                background-color:orange;
                text-align: left;
            }
            table tr.items {
                background-color: rgb(241 245 249);
            }
            table tr.items td {
                padding: 0.5rem;
                border: 0.5px  solid black;
                text-align: left;
            }
            table tr.items td.total {
                text-align: right;
                background-color: whitesmoke;

            }
            table tr.items td.totales {
                text-align: left;
                background-color: whitesmoke;
            }
            .blockquote{
                text-align: left;
            }
            .textos{
                text-align: center;
            }
            .actividad{
                margin: auto;
                background-color: whitesmoke;
                font-size: 0.675rem;
            }
            body.margen{
                width: 100%;
                border: 1px solid black;
            }
            hr{
                width: 50%;
                margin: auto;
            }
            .text-center{
                text-align: center;
            }

    </style>
</head>

<body class="margen">
    @php
    echo date('Y-m-d'); 
    @endphp
     <p class="text-center">
        <b>JE Car Pro</b> <br>
         Direccion: cra  91  # 44c - 65 <br>
         Celular: 3216793525<br>
         Medellin - Antioquia
    </p>
    <hr>    
    <h3 class="textos">Detalle Pago Mano de Obra # Orden:<br>{{$inventario->ordenlatoneria}}</h3>
    <blockquote class="blockquote"><span class="badge badge-primary"></span><b> Información Técnico</b>
    </blockquote>              
    <table class="vehiculo">
        <tr>
            <th>Tipo Documento Técnico</th>
            <th># Documento Técnico</th>
            <th>Nombre Completo Técnico</th>
            <th># Celular Técnico</th>
        </tr>
        <tbody>
            <tr class="items">
                <td>{{ $empleado->tipodocumentoempleado }}</td>
                <td>{{ $empleado->numerodocumento }}</td>
                <td>{{ $empleado->nombremecanico }}</td>
                <td>{{ $empleado->numerocelmecanico }}</td>
            </tr>
        </tbody>
    </table>
    <blockquote class="blockquote"><span class="badge badge-primary"></span><b> Información Vehiculo</b>
    </blockquote>
    <table class="vehiculo">
        <tr>
            <th>Celular Propietario</th>
            <th>Nombre Propietario</th>
            <th>Placa Vehiculo</th>
            <th>Linea Vehiculo</th>
            <th>Kilometros Vehiculo</th>
        </tr>
        <tbody>
            <tr class="items">
                <td>{{ $cliente->numerocel }}</td>
                <td>{{ $cliente->nombrecliente }}</td>
                <td>{{ $vehiculo->placa }}</td>
                <td>{{ $vehiculo->referencia }}</td>
                <td>{{ $vehiculo->kilometraje }}</td>
            </tr>
        </tbody>
    </table> 
    <blockquote class="blockquote"><span class="badge badge-primary"></span><b> Información Liquidación Mano de Obra</b>
    </blockquote>
    <table class="vehiculo">
        <tr>
            <th># Orden</th>
            <th>Valor Total Orden</th>
            <th>Porcentaje Aplicado</th>
            <th>Valor Mano de Obra</th>
            <th>Fecha Liquidacion</th>
        </tr>
        <tbody>
            <tr class="items">
                <td>{{ $inventario->ordenlatoneria }}</td>
                <td>@php echo
                    number_format($inventario->valorcosto ,0);@endphp
                </td>
                <td>{{ $liquidation->porcentaje }} %</td>
                <td>@php echo
                    number_format($liquidation->valorempleado ,0);@endphp
                </td>
                <td>{{$liquidation->created_at}}</td>
            </tr>
        </tbody>
    </table> 
    <br>
    <br>
    <br>
    <label for="">Entrega</label>
    <br>
    _______________________________

    <br>
    <br>
    <br>

    <label for="">Recibe</label>
    <br>
    _______________________________
</body>
</html>