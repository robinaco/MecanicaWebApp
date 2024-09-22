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
    <h4 class="text-black-50 text-center">Liquidar Orden Mecanico <br><span class="badge badge bg-warning bg-gradient">
        {{$inventario->ordenlatoneria}}</span></h4>
        <div class="card bg-ligth bg-gradient border border-secondary">
            <div class="card-body">
                <form class="row g-3" action="SaveUtility" method="POST" enctype="multipart/form-data">
                    @csrf
                    <blockquote class="blockquote"><span class="badge badge-warning"><i
                        class="fas fa-wrench"></i></span> Información Empleado - Técnico
                    </blockquote>
                    <div class="col-md-3">
                        <input type="hidden" value="{{$employee->id}}" name="employee" id="employee" class="form-control" readonly>
                        <label for="inputEmail4" class="form-label badge  badge  bg-success bg-light">Tipo Documento Empleado:</label>
                        <input type="text" value="{{$employee->tipodocumentoempleado}}" name="tipodoctoemp" id="tipodoctoemp"
                        class="form-control" readonly>
                    </div>
                    <div class="col-md-3">
                        <label for="inputEmail4" class="form-label badge  badge  bg-success bg-light"># Documento Empleado:</label>
                        <input type="text" value="{{$employee->numerodocumento}}" name="numdoctoemp" id="numdoctoemp"
                        class="form-control" readonly>
                    </div>
                    <div class="col-md-3">
                        <label for="inputEmail4" class="form-label badge  badge  bg-success bg-light">Nombre Empleado:</label>
                        <input type="text" value="{{$employee->nombremecanico}}" name="nameemp" id="nameemp"
                        class="form-control" readonly>
                    </div>
                    <div class="col-md-3">
                        <label for="inputEmail4" class="form-label badge  badge  bg-success bg-light"># Celular Empleado:</label>
                        <input type="text" value="{{$employee->numerocelmecanico}}" name="celemp" id="celemp"
                        class="form-control" readonly>
                    </div>
                    <div>
                        <hr>
                    </div>
                    <div class="card-body ">
                        <blockquote class="blockquote"><span class="badge badge-warning"><i
                            class="fas fa-money-bill"></i></span> Valores Orden
                        </blockquote>
                        <div class="row g-3">
                            <div class="col-md-3">
                                <input type="hidden" value="{{$inventario->id}}" name="order" id="order" class="form-control" readonly>
                                <div class="card text-link bg-link  mb-3 border-warning">
                                    <div class="card-body text-center">
                                        <h5 class="card-title text-center"><b class="badge badge bg-warning bg-gradient">Valor Total Orden de Servicio:</b> </h5>
                                        <input type="text" value="{{$inventario->valorcosto}}" class="form-control text-center" id="valororden" name="valororden" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card text-link bg-link  mb-3 border-warning">
                                    <div class="card-body text-center">
                                        <h5 class="card-title text-center"><b class="badge badge bg-warning bg-gradient">Valor Porcentaje %  Pago Mecanico:</b> </h5>
                                        <select name="porcentaje" id="porcentaje" class="form-control text-center" onChange="calculateDiscount();"> 
                                            <option value="0">Seleccione una Opción</option>
                                            <option value="5">5 %</option>
                                            <option value="10">10 %</option>
                                            <option value="15">15 %</option>
                                            <option value="20">20 %</option>
                                            <option value="25">25 %</option>
                                            <option value="30">30 %</option>
                                            <option value="35">35 %</option>
                                            <option value="40">40 %</option>
                                            <option value="45">45 %</option>
                                            <option value="50">50 %</option>
                                        </select>
                                    </div>  
                                </div> 
                                @error('porcentaje')<small>* {{ $message }}</small>@enderror                          
                            </div>
                            <div class="col-md-3">
                                <div class="card text-link bg-link  mb-3 border-warning">
                                    <div class="card-body text-center">
                                        <h5 class="card-title text-center"><b class="badge badge bg-warning bg-gradient">Valor Ingreso Mecanico:</b> </h5>
                                        <input type="text"  name="valormecanico" id="valormecanico" class="form-control text-center" readonly>
                                    </div>
                                </div>                               
                            </div>
                            <div class="col-md-3">
                                <div class="card text-link bg-link  mb-3 border-warning">
                                    <div class="card-body text-center">
                                        <h5 class="card-title text-center"><b class="badge badge bg-warning bg-gradient">Valor Ingreso Taller:</b> </h5>
                                        <input type="text"  name="utilidad" id="utilidad" class="form-control text-center" readonly>
                                    </div>
                                </div> 
                                
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-warning bg-warning bg-gradient btn-sm" id="registrar">Grabar Liquidación Orden
                                </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    
</body>
</html>
<script type="text/javascript">
    function calculateDiscount()
        {
            let cost = document.getElementById('valororden').value;
            let discount = document.getElementById('porcentaje').value;
            let neto= document.getElementById('valormecanico').value;
            let net = document.getElementById('valormecanico').innerHTML = cost*(discount/100);
            document.getElementById('valormecanico').value = net.toLocaleString("es-CO"); 
            let utilidad=document.getElementById('utilidad').innerHTML=cost-net;
            document.getElementById('utilidad').value=utilidad.toLocaleString("es-CO");
        }
</script>
@endsection