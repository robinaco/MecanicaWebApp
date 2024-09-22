@extends('layouts.app')


@section('content')


{{-- <h5 class="text-center">
    Taller Martin Barrera <br>
    NIT: 70.557.553-7 (Regimén Simplificado) <br>
    Direccion: Calle 44 c # 91 - 30 <br>
    Telefono: 2521264<br><br>
</h5> --}}
<h4 class="text-center"><span class="badge badge bg-warning bg-gradient">Historico Servicios Realizados</span><br><br>
    <b class="" style="background-color: yellow;border:3px solid black;padding:1%">{!! $vehicule->placa !!}</b>
</h4>
<br>
@php
@endphp
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col">
                <a href="/VehiculesList" class="btn btn-primary">Volver</a>
            </div>
            <div class="col-6">
            </div>
            <div class="col">
            </div>
        </div>
        <hr>

        <div class="table-responsive">
            {{-- <h5 class="text-black-100"> Orden de Servicio: {{ $servicios->id}}</h5> --}}
            <table class="table table-ligth  table-hover table-bordered" id="clientes">
                <thead class="table-success">
                    <tr>
                        <th scope="col">Nombre Cliente</th>
                        <th scope="col">Vehiculo Marca -- Referencia</th>
                        <th scope="col">Placa</th>
                        <th scope="col">KM - Actual</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{!! $cliente->nombrecliente !!}</td>
                        <td>{!! $vehicule->referencia !!}</td>
                        <td>{!! $vehicule->placa !!}</td>
                        <td class="bg bg-ligth"> @php echo number_format($vehicule->kilometraje ,0);@endphp</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <h3 class="text-black-100"><span class="badge badge bg-warning bg-gradient">Servicios Realizados</span>
            </h3>
            <table class="table table-ligth  table-hover" id="clientes">
                <thead class="table-success">
                    <tr>
                        <th scope="col">ITEM</th>
                        <th scope="col"># Orden</th>
                        <th scope="col">Fecha Servicio</th>
                        <th scope="col">Operario Técnico</th>
                        <th scope="col">Concepto Servicio</th>
                        <th scope="col">Descripción Servicio</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($servicios as $item1)
                    <tr>
                        <td class=""><span class="badge bg-warning btn btn-lg">
                                {{ $loop->index + 1 }}
                            </span></td>
                        <td>{!! $item1->ordenservicio!!}</td>
                        <td>{!! $item1->created_at!!}</td>
                        <td>{!! $item1->mecanico!!}</td>
                        <td><span class="badge bg-warning">{!! $item1->conceptomano !!}</span></td>
                        <td>{!! $item1->describemano !!}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</div>

@endsection