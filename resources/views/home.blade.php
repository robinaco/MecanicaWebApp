@extends('layouts.app')

@section('content')
<div class="container-fluid">
   <h3 class="text-center"><span class="badge badge bg-warning bg-gradient">Resumen General Taller</span></h3> 
</div>
<hr>
<div class="row">
    <div class="col-sm-6">
        <div class="card text-dark bg-danger  mb-3">
            <div class="card-body text-center">
                <h5 class="card-title"><i><span class="fas fa-money-bill"></span></i> <b class="badge badge-dark"> 
                        Ordenes Liquidadas</b> </h5>
                <h3 class="card-text"> Total: <span class="badge bg-dark btn btn-lg"
                    title="Ordenes Liquidadas">@php echo
                    number_format($liquidadas,0);@endphp</span></h3>
                <hr>

                {{-- <a href="" class="btn btn-info">Generar Reporte</a> --}}
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="card text-dark bg-danger  mb-3">
            <div class="card-body text-center">
                <h5 class="card-title"><i><span class="fas fa-money-bill"></span></i> <b class="badge badge-dark"> 
                        Ordenes Sin Liquidar</b> </h5>
                <h3 class="card-text"> Total: <span class="badge bg-dark btn btn-lg"
                    title="Ordenes Sin Liquidar">@php echo
                    number_format($Noliquidadas,0);@endphp</span></h3>
                <hr>

                {{-- <a href="" class="btn btn-info">Generar Reporte</a> --}}
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-4">
        <div class="card text-dark bg-warning  mb-3">
            <div class="card-body text-center">
                <h5 class="card-title"><i><span class="fas fa-money-bill"></span></i> <b class="badge badge-dark">Total 
                        Ordenes Dia</b> </h5>
                <h3 class="card-text"> Total: <span class="badge bg-dark btn btn-lg"
                    title="Suma Total Valor Ordenes por Dia">$@php echo
                    number_format($inventario ,0);@endphp</span></h3>
                <hr>

                {{-- <a href="" class="btn btn-info">Generar Reporte</a> --}}
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="card text-dark bg-warning  mb-3">
            <div class="card-body text-center">
                <h5 class="card-title"><i><span class="fas fa-money-bill"></span></i> <b class="badge badge-dark">$ 
                        Liquidadas Técnicos</b> </h5>
                <h3 class="card-text"> Total: <span class="badge bg-dark btn btn-lg"
                    title="Suma Total Valor Mano de Obra por Dia">$@php echo
                    number_format($liquidation ,0);@endphp</span></h3>
                <hr>

                {{-- <a href="" class="btn btn-info">Generar Reporte</a> --}}
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="card text-dark bg-warning  mb-3">
            <div class="card-body text-center">
                <h5 class="card-title"><i><span class="fas fa-money-bill"></span></i> <b class="badge badge-dark">$ 
                        Utilidad Liquidadas</b> </h5>
                <h3 class="card-text"> Total: <span class="badge bg-dark btn btn-lg"
                    title="Suma Total Utilidad Taller por Dia">$@php echo
                    number_format($liquidations ,0);@endphp</span></h3>
                <hr>

                {{-- <a href="" class="btn btn-info">Generar Reporte</a> --}}
            </div>
        </div>
    </div>

</div>
<div class="row">
    <div class="col-sm-4">
        <div class="card text-dark bg-success  mb-3">
            <div class="card-body text-center">
                <h5 class="card-title"><i><span class="fas fa-address-book"></span></i> <b class="badge badge-dark">Resumen
                        Clientes</b> </h5>
                <h3 class="card-text"> Total: <span class="badge bg-dark btn btn-lg"
                    title="Acumulado Total Clientes Registrados">@php echo
                    number_format($clientes ,0);@endphp</span></h3>
                <hr>
                {{-- <a href="" class="btn btn-secondary">Generar Reporte</a> --}}
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="card text-dark bg-success  mb-3">
            <div class="card-body text-center">
                <h5 class="card-title"><i><span class="fas fa-car-crash"></span></i> <b class="badge badge-dark">Resumen
                        Carros</b> </h5>
                <h3 class="card-text"> Total: <span class="badge bg-dark btn btn-lg"
                    title="Acumulado Total Vehiculos Registrados">@php echo
                    number_format($vehicules ,0);@endphp</span></h3>
                <hr>
                {{-- <a href="" class="btn btn-success">Generar Reporte</a> --}}
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="card text-dark bg-success  mb-3">
            <div class="card-body text-center">
                <h5 class="card-title"><i><span class="fas fa-file-contract"></span></i> <b class="badge badge-dark">Resumen 
                        Ordenes</b> </h5>
                <h3 class="card-text"> Total: <span class="badge bg-dark btn btn-lg"
                    title="Acumulado Total Ordenes Registradas">@php echo
                    number_format($ordens ,0);@endphp</span></h3>
                <hr>

                {{-- <a href="" class="btn btn-info">Generar Reporte</a> --}}
            </div>
        </div>
    </div>
</div>


@endsection