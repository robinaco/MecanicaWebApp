@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row justify-content-md-center">
        <div class="col col-lg-2">
        </div>
        <div class="col-md-auto" style="text-align: center">
            {{-- <span class=""><img src="/images/logo.jpg" alt="" style="width: 30%; border-radius:90%"></span> --}}
            <span class=""><img src="/images/logo1.png" alt="" style="width: 100%; border-radius:90%"></span>

        </div>
        <div class="col col-lg-2">
        </div>
    </div>
</div>
{{-- <h5 class="text-center">
    Taller Martin Barrera <br>
    NIT: 70.557.553-7 (Regimén Simplificado) <br>
    Direccion: Calle 44 c # 91 - 30 <br>
    Telefono: 2521264<br><br>
</h5> --}}
<h5 class="text-center">
   JYP Autos <br>
    {{-- NIT: 70.557.553-7 (Regimén Simplificado) <br> --}}
    Direccion: Calle 91  # 44c - 71 <br>
    Celular: 3002318873<br><br>
</h5>
@php
$sumamano=0;
$acumulado=0;
@endphp


<div class="card">
    <div class="card-body">
        <hr>
        <div class="table-responsive">
            <table class="table table-ligth table-bordered" id="clientes">
                <thead class="table-success">
                    <tr>
                        <th scope="col"># Orden Servicio Mecanica</th>
                        <th scope="col">Nombre Cliente</th>
                        <th scope="col">Vehiculo -- Referencia</th>
                        <th scope="col">Placa</th>
                        <th scope="col">KM - Actual</th>
                    </tr>
                </thead>



                <tbody>
                    @foreach ($servicios as $item)
                    <tr>
                        @if ($loop->first)
                        <td>{{$item->ordenservicio}}</td>
                        <td>{{$item->nombrecliente}}</td>
                        <td>{!! $item->referencia !!}</td>
                        <td class="text-center" style="background-color: yellow;border:2px solid black"><b>{!!
                                $item->placa !!}</b></td>
                        <td class="bg bg-ligth"> @php echo number_format($item->kilometraje ,0);@endphp
                        </td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <h3 class="text-black-100"><span class="badge badge bg-warning bg-gradient">Descripción Servicios
                    Realizados</span>
            </h3>
            <table class="table table-ligth  table-hover" id="clientes">
                    <tr>
                        <th scope="col">Item</th>
                        <th scope="col">Fecha Servicio</th>
                        <th scope="col">Concepto Servicio</th>
                        <th scope="col">Tipo Servicio</th>
                        <th scope="col">Descripción Servicio</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col" class="text-right">Valor Unitario</th>
                        <th scope="col" class="text-right">Valor Total</th>

                    </tr>

                <tbody>
                    @foreach ($servicios as $item1)
                    <tr>
                        <td class=""><span class="badge bg-warning btn btn-lg">
                                {{ $loop->index + 1 }}
                            </span></td>
                        <td>{!! $item1->created_at!!}</td>
                        <td><span>Reparacion Capo</span></td>
                        <td>Trabajo interno y Externo</td>
                        <td>Pintura, Latoneria y Polichada</td>
                        <td>1</td>
                        <td class="text-right"><b>@php echo number_format(1230000,0);@endphp</b></td>
                        <td class="text-right"><b>@php echo
                                number_format(1230000,0);@endphp</b></td>
                    </tr>
                    @php
                    // $acumulado=($item1->valormano*$item1->cantidad);
                    // $sumamano=$sumamano+$acumulado
                    $sumamano=1230000
                    @endphp
                    @endforeach
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="bg bg-warning bg-gradient"><b>Total</b></td>
                        <td class="bg bg-warning bg-gradient text-right"><b class="text-right"> @php
                                echo number_format($sumamano,0)
                                @endphp</b></td>
                    </tr>
                </tbody>


            </table>
        </div>

    </div>

</div>








@endsection