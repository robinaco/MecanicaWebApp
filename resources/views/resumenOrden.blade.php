<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informe Orden {{$vh->placa}}</title>
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
                background-color: yellow;
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
        <b>Omar Castaño</b> <br>
         Direccion: calle 36 # 53B - 43<br>
         Celular: 3046578518<br>
         Itagui - Antioquia
    </p>
<hr>                
    <h5 class="textos">Detalle Orden de Servicio # <br> {{ $numorden }}</h5>
    <blockquote class="blockquote"><span class="badge badge-primary"></span><b> Información Vehículo</b>
    </blockquote>
    <table class="vehiculo">
            <tr>
                <th>Propietario</th>
                <th># Documento Propietario</th>
                <th># Celular Propietario</th>
                <th>Placa Vehiculo</th>
                <th>Kilometraje</th>
                <th>Linea</th>
                <th>Modelo</th>
                <th>Color</th>
            </tr>
        <tbody>
            <tr class="items">
                <td>{{ $infocustomer->nombrecliente }}</td>
                <td>{{ $infocustomer->numcedula }}</td>
                <td>{{ $infocustomer->numerocel }}</td>
                <td>{{ $vh->placa }}</td>
                <td>{{ $vh->kilometraje }}</td>
                <td>{{ $vh->referencia }}</td>
                <td>{{ $inventario->modelo }}</td>
                <td>{{ $inventario->color }}</td>
            </tr>
        </tbody>
    </table>  
    <blockquote class="blockquote"><span class="badge badge-primary"></span> <b>Servicios Realizados Orden</b>
    </blockquote>
        <table class="vehiculo">
                <tr>
                    <th scope="col" class="numeric text-center" style="border: 1px solid">Item</th>
                    <th scope="col" class="numeric text-center" style="border: 1px solid">Fecha Registro</th>
                    <th scope="col" class="numeric text-center" style="border: 1px solid">Servicio Realizado</th>
                    <th scope="col" class="numeric text-center" style="border: 1px solid">Descripción Servicio</th>
                    <th scope="col" class="numeric text-center" style="border: 1px solid">Cantidad</th>
                    <th scope="col" class="numeric text-center" style="border: 1px solid">Valor Servicio</th>
                    <th scope="col" class="numeric text-center" style="border: 1px solid">Subtotal</th>
                </tr>
            <tbody>
                @foreach ($latonerias as $item)
                <tr class="items">
                    <td>
                        {{ $loop->index + 1 }}
                    </td>
                    <td>
                        {!!$item->updated_at !!}
                    </td>
                     <td>
                        {!!$item->descripcionservicio !!}
                    </td>
                    <td>
                        {!!$item->conceptoservicio !!}
                    </td>
                    <td>
                        {!!$item->cantidad!!}
                     </td>
                    <td class="total">@php echo
                         number_format($item->preciounidad ,0);@endphp</td>
                    <td class="total">@php echo
                          number_format($item->subtotal,0);@endphp</td>
                </tr>
                @php
                $acumulado=($item->preciounidad*$item->cantidad);
                $sumamano=$sumamano+$acumulado
                @endphp
                @endforeach
                <tr class="items">
                    <td class="totales" colspan="6"><b> TOTAL ORDEN:<b></td> 
                    <td class="total" colspan="1">
                         
                            @php
                                echo  number_format($sumamano,0)
                            @endphp
                        
                    </td>
                </tr>
            </tbody>
        </table> 
        <blockquote class="blockquote"><span class="badge badge-primary"></span> <b>Comentarios Registro Orden</b>
        </blockquote>
        

        <table class="vehiculo">
            <tr>
                <th>Observaciones del Usuario</th>
            </tr>
        <tbody>
            <tr class="items">
                <td><p>{{$inventario->Descripcionactividad }}</p></td>
            </tr>
        </tbody>
    </table>
        
    
        <blockquote class="blockquote"><span class="badge badge-primary"></span> <b>Recepción Vehículo</b>
        </blockquote>
        <table class="vehiculo">
            <tr>
                <th>Técnico Especializado que Recibe</th>
                <th>Usuario que Entrega</th>
                <th>Fecha Recepción Vehiculo</th>
            </tr>
        <tbody>
            <tr class="items">
                <td> {{$mechanic->nombremecanico }}</td>
                <td>{{ $inventario->usuario }}</td>
                <td>{{ $inventario->created_at }}</td>
            </tr>
        </tbody>
    </table> 

</div>
                    

                         
    </body>
</html>