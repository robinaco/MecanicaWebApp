<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle Tecnico</title>
    <style>
        table {
                width: 96%;
                border-spacing: 0;
                margin: auto;
            }
            table.vehiculo {
                font-size: 0.675rem;
            }
            table .vehiculo tr {
                background-color: rgb(96 165 250);
            }
            table.vehiculo th {
                color: black;
                padding: 0.2rem;
                border: 0.5px  solid black;
                background-color: orange;
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
$sumamano=0;
$acumulado=0;
$sumalavado=0;
$acumuladol=0;

$restantefinal=0;
$totalvalue=0;
$abonovalue=0;
echo date('Y-m-d'); 
@endphp

<div class="margen">
    
        <p class="text-center">
            <b>JE Car Pro</b> <br>
             Direccion: cra  91  # 44c - 65 <br>
             Celular: 3216793525<br>
             Medellin - Antioquia
        </p>
   
    <hr>                
    <h5 class="textos">Reporte Ingresos Taller<br> </h5>
    <blockquote class="blockquote"><span class="badge badge-primary"></span><b>ORDENES LIQUIDADAS</b>
    </blockquote>
    <table class="vehiculo">
        <tr>
            <th scope="col" class="numeric text-center" style="border: 1px solid">Item</th>
            <th scope="col" class="numeric text-center" style="border: 1px solid"># Orden</th>
            <th scope="col" class="numeric text-center" style="border: 1px solid">Consecutivo Orden</th>
            <th scope="col" class="numeric text-center" style="border: 1px solid">Placa Vehiculo</th>
            <th scope="col" class="numeric text-center" style="border: 1px solid">Linea </th> 
            <th scope="col" class="numeric text-center" style="border: 1px solid">Fecha Orden</th>
            <th scope="col" class="numeric text-center" style="border: 1px solid">Valor Orden</th>
        </tr>
        <tbody>
            @foreach ($getSales as $item)
            <tr class="items">
                <td>
                    {{ $loop->index + 1 }}
                </td>
                 <td>
                     {!!$item->ordenlatoneria !!}
                 </td>
                <td>
                    CO_ {!!$item->id !!}
                 </td>
                
                <td>
                    {!!$item->placa !!}
                </td>
                <td>
                    {!!$item->referencia !!}
                </td>
                <td>
                    {!!$item->created_at !!}
                </td>
                <td>
                    @php echo
                         number_format($item->valorcosto ,0);
                    @endphp
                </td>
            </tr>
            @php
            $acumulado=($acumulado+$item->valorcosto);
            @endphp
            @endforeach
        </tbody>
        <p><b>Total Ingresos Taller:</b>$@php echo number_format($acumulado,0) @endphp</p>
    </table> 
    
</div>
</body>
</html>