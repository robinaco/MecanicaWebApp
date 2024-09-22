@extends('layouts.app')


@section('content')

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Detalle Orden</title>
    <style>
        .col-md-4 {

            text-align: center !important;
        }
        .blockquote {

            border-radius: 0.2em;
            color: white;
            background-color:rgb(127, 120, 120)  !important;
            -webkit-box-shadow: 1px 0px 7px 0px rgb(0 0 0 / 75%);
            -moz-box-shadow: 1px 0px 7px 0px rgba(0,0,0,0.75);
             box-shadow: 1px 0px 7px 0px rgb(0 0 0 / 75%);
        }
        #latonerias{
            border-radius: 0.2em;
            background-color:whitesmoke  !important;
            -webkit-box-shadow: 1px 0px 7px 0px rgb(0 0 0 / 75%);
            -moz-box-shadow: 1px 0px 7px 0px rgba(0,0,0,0.75);
            box-shadow: 1px 0px 7px 0px rgb(0 0 0 / 75%);
        }

        .imgs {
            padding: 2% !important;
            background-color:#EEF8F6  !important;
            -webkit-box-shadow: 1px 0px 7px 0px rgba(0,0,0,0.75);
            -moz-box-shadow: 1px 0px 7px 0px rgba(0,0,0,0.75);
            box-shadow: 1px 0px 7px 0px rgba(0,0,0,0.75);
            width: 60%;
            height: 80%;
            margin: auto;
        }
        .badge {
            font-size: 66%  !important;
        }

         @media all {
            div.saltopagina{
                display: none;
            }
            
        }

            @media print {
               .noprint {
                  visibility: hidden;
               }
            }

            .estado{
                text-align: center;
                font-family:'Times New Roman', Times, serif;
                font-size:large;
                color:red;
            }
            .textestado{
                margin: auto;
                padding-top:0% 
            }
        
    </style>
</head>
<body>
    <p class="text-center">
        <span class="imgsl"><img src="/images/logo.jpeg" width="50%"></span><br>
        <b>JE Car Pro</b> <br>
         Direccion: cra  91  # 44c - 65 <br>
         Celular: 3216793525<br>
         Medellin - Antioquia
    </p>

@php
$sumamano=0;
$acumulado=0;
$sumalavado=0;
$acumuladol=0;

$restantefinal=0;
$totalvalue=0;
$abonovalue=0;
@endphp
@include("error")
@include("notification")
        <div class="card">
            <div class="card-body border border-secondary">
                
                <div class="card border border-secondary">
                    <div class="row g-3 card-body">
                        <div class="col-md-3">
                            <label for="inputEmail4" class="">
                                Fecha Orden :</label>
                            <span class=""></span><b>{{$inventario->fechaorden}}</b>
                        </div>
                        <div class="col-md-3">
                            <h5 class="text-black-80 text-center">Detalle Orden # <br>{{ $numorden }}</h5>
                        </div>
                         <div class="col-md-3">                            
                                <a href="/{{$inventario->id}}/getPdf" class="btn btn-danger btn-sm"><span
                                    class="fas fa-file-pdf" target="_blank" data-title="tooltip" > </span> Descargar Orden
                                </a>
                        </div>
                        <div class="col-md-3 estado">                            
                           <p class="textestado"><span>{{$inventario->liquidacion}}</span></p>
                        </div>
                    </div>
                    <hr style="color: red">
                    <blockquote class="blockquote"><span class="badge badge-primary"><i
                    class="nav-icon fas fa-user"></i></span><b> Información Básica</b>
                    </blockquote>
                    <div class="row g-3 card-body">
                        <div class="col-md-4">
                            <label for="inputEmail4" class="">
                                Placa</label>
                                 <input type="text" value="{{ $vh->placa }}" class="form-control border border-secondary" readonly>
                        </div>
                        <div class="col-md-4">
                            <label for="inputEmail4" class="">
                                Kilometraje</label>
                                 <input type="text" value="{{ $inventario->Kilometraje }}" class="form-control border border-secondary" readonly>
                        </div>
                        <div class="col-md-4">
                            <label for="inputEmail4" class="">
                                Referencia</label>
                                 <input type="text" value="{{ $vh->referencia }}" class="form-control border border-secondary" readonly>
                        </div>
                        <div class="col-md-4">
                            <label for="inputEmail4" class="">
                                Modelo</label>
                                <input type="text" value="{{ $inventario->modelo }}" class="form-control border border-secondary" readonly>
                        </div>
                        <div class="col-md-4">
                            <label for="inputEmail4" class="">
                                Color</label>
                                <input type="text" value="{{ $inventario->color }}" class="form-control border border-secondary" readonly>
                        </div>
                        <div class="col-md-4">
                            <label for="inputEmail4" class="">
                                Nivel</label>
                                <input type="text" value="{{ $inventario->nivelfuel }}" class="form-control border border-secondary" readonly>
                        </div>
                    </div>
                </div>
                <blockquote class="blockquote"><span class="badge badge-primary"><i
                    class="nav-icon fas fa-car-crash"></i></span><b> Imagenes Vehículo </b>
                </blockquote>
                <div class="card border border-secondary">
                    <div class="row g-3 card-body">
                        @php $contador=1;@endphp
                        @foreach($imagenes as $imagen) 
                        <div class="col-md-4"> 
                            <img src="{{('http://serviciosla92.com.co/storage/app/public/images/'.$imagen->namefile)}}" alt="" class="img-thumbail imgs" width="70%" height="80%"><br>
                            @php echo "Imagen ".'<span class="badge badge-danger">' .$contador++ .'</span>'    @endphp
                        </div>
                        @endforeach
                    </div>
                </div>
                <blockquote class="blockquote noprint"><span class="badge badge-primary"><i
                    class="nav-icon fas fa-fire-extinguisher"></i></span><b> Inventario Vehículo</b>
                    </blockquote>
                <div class="card border border-secondary noprint    ">
                    <div class="row g-3 card-body">
                        <div class="col-md-2">
                            <label for="inputEmail4" class="">
                                Antena</label>
                                <input type="text" value="{{ $inventario->antena }}" class="form-control border border-secondary" readonly>
                        </div>
                        <div class="col-md-2">
                            <label for="inputEmail4" class="">
                                Extintor</label>
                                <input type="text" value="{{ $inventario->extintor }}" class="form-control border border-secondary" readonly>
                        </div>
                        <div class="col-md-2">
                            <label for="inputEmail4" class="">
                                Gato</label>
                                <input type="text" value="{{ $inventario->gato }}" class="form-control border border-secondary" readonly>
                        </div>
                        <div class="col-md-2">
                            <label for="inputEmail4" class="">
                                Llantas</label>
                                <input type="text" value="{{ $inventario->llanta }}" class="form-control border border-secondary" readonly>
                        </div>
                        <div class="col-md-2">
                            <label for="inputEmail4" class="">
                                Herramientas</label>
                                <input type="text" value="{{ $inventario->herramientas }}" class="form-control border border-secondary" readonly>
                        </div>
                        <div class="col-md-2">
                            <label for="inputEmail4" class="">
                                Kit</label>
                                <input type="text" value="{{ $inventario->kit }}" class="form-control border border-secondary" readonly>
                        </div>
                        <div class="col-md-2">
                            <label for="inputEmail4" class="">
                                Documentos</label>
                                <input type="text" value="{{ $inventario->documentos }}" class="form-control border border-secondary" readonly>
                        </div>
                        <div class="col-md-2">
                            <label for="inputEmail4" class="">
                                Radio</label>
                                <input type="text" value="{{ $inventario->radio }}" class="form-control border border-secondary" readonly>
                        </div>
                        <div class="col-md-2">
                            <label for="inputEmail4" class="">
                                Parlantes</label>
                                <input type="text" value="{{ $inventario->parlantes }}" class="form-control border border-secondary" readonly>
                        </div>
                        <div class="col-md-2">
                            <label for="inputEmail4" class="">
                                Tapetes</label>
                                <input type="text" value="{{ $inventario->tapetes }}" class="form-control border border-secondary" readonly>
                        </div>
                        <div class="col-md-2">
                            <label for="inputEmail4" class="">
                                Encendedor</label>
                                <input type="text" value="{{ $inventario->encendedor }}" class="form-control border border-secondary" readonly>
                        </div>
                        <div class="col-md-2">
                            <label for="inputEmail4" class="">
                                Espejos</label>
                                <input type="text" value="{{ $inventario->espejos }}" class="form-control border border-secondary" readonly>
                        </div>
                        <div class="col-md-2">
                            <label for="inputEmail4" class="">
                                Parasoles</label>
                                <input type="text" value="{{ $inventario->parasoles }}" class="form-control border border-secondary" readonly>
                        </div>
                        <div class="col-md-2">
                            <label for="inputEmail4" class="">
                                Limpiabrisas</label>
                                <input type="text" value="{{ $inventario->limpiabrisas }}" class="form-control border border-secondary" readonly>
                        </div>
                        <div class="col-md-4">
                            <label for="inputEmail4" class="">
                                Bateria</label>
                                <input type="text" value="{{ $inventario->bateria }}" class="form-control border border-secondary" readonly>
                        </div>
                        <div class="col-md-2">
                            <label for="inputEmail4" class="">
                                Pintura Fogueada</label>
                                <input type="text" value="{{ $inventario->pinturafogueada }}" class="form-control border border-secondary" readonly>
                        </div>
                        <div class="col-md-2">
                            <label for="inputEmail4" class="">
                                Vehiculo Sucio</label>
                                <input type="text" value="{{ $inventario->suciedad }}" class="form-control border border-secondary" readonly>
                        </div>

                        
                        
                    </div> 

                </div>
             

                <blockquote class="blockquote"><span class="badge badge-primary"><i
                    class="nav-icon fas fa-tools"></i></span> <b>Servicios Facturados</b>
                </blockquote>
                
                   <div class="table-responsive">
                        <table class="table table-dark table-bordered" id="latonerias">
                            <thead class="">
                                <tr>
                                    <th scope="col" class="numeric text-center">ITEM</th>
                                    <th scope="col" class="numeric text-center">FECHA REGISTRO</th>
                                    <th scope="col" class="numeric text-center">SERVICIO REALIZADO</th>
                                    <th scope="col" class="numeric text-center">DESCRIPCION SERVICIO</th>
                                    <th scope="col" class="numeric text-center">CANTIDAD</th>
                                    <th scope="col" class="numeric text-center">VALOR SERVICIO</th>
                                    <th scope="col" class="numeric text-center">SUBTOTAL</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($latonerias as $item)
                                <tr>
                                    <td class="text-center" ><span class="badge bg-danger btn btn-sm" >
                                        {{ $loop->index + 1 }}
                                    </span></td>
                                    <td class="text-center" data-title="placa">
                                        <b>{!!$item->updated_at !!}</b>
                                    </td>
                                     <td class="text-center" data-title="placa">
                                        <b>{!!$item->descripcionservicio !!}</b>
                                    </td>
                                    <td class="text-center" data-title="placa">
                                        <b>{!!$item->conceptoservicio !!}</b>
                                    </td>
                                    <td class="text-center numeric" data-title="date">
                                        {!!$item->cantidad!!}
                                </td>
                                    <td data-title="description" class="text-right numeric bg bg-default">@php echo
                                         number_format($item->preciounidad ,0);@endphp</td>
                                    <td data-title="description" class="text-right numeric bg bg-default">@php echo
                                          number_format($item->subtotal,0);@endphp
                                </td>
                                </tr>
                                @php
                                $acumulado=($item->preciounidad*$item->cantidad);
                                $sumamano=$sumamano+$acumulado
                                @endphp
                                @endforeach
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td class="bg bg-danger bg-gradient text-right">TOTAL = </td>
                                    <td class="bg bg-danger bg-gradient text-right">
                                        @php
                                            echo  number_format($sumamano,0)
                                            @endphp</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                
                <blockquote class="blockquote"><span class="badge badge-primary"><i
                    class="nav-icon fas fa-dollar-sign"></i></span><b> Valor Servicios y Abonos</b>
                </blockquote>
                <div class="card border border-secondary">
                    <div class="row g-3 card-body">
                        <div class="col-md-4">
                            <label for="inputEmail4" class="">
                                Valor Total</label>
                                <input type="text" value="@php
                                echo '$'. number_format($inventario->valorcosto+$sumalavado ,0)
                                @endphp" class="form-control border border-secondary" readonly>
                                @php
                                $totalvalue=$inventario->valorcosto+$sumalavado
                                @endphp
                        </div>
                        <div class="col-md-4">
                            <label for="inputEmail4" class="">
                                Valor Abonado</label>
                                @if ($inventario->valorabono !="" && $inventario->valorabono!=0)
                                @php
                                $abonovalue=$inventario->valorabono
                                @endphp
                                <input type="text" value="@php echo '$'. number_format($abonovalue,0) @endphp "class="form-control border border-secondary" readonly>
                                @else
                                @php
                                $abonovalue=0;
                                @endphp
                                <input type="text" value="0" class="form-control border border-secondary" readonly>
                                @endif     
                        </div>
                        <div class="col-md-4">
                            <label for="inputEmail4" class="">
                                Valor Restante</label>
                                @if ($inventario->valorrestante!=0 )
                                @php
                                $restantefinal=$totalvalue-$abonovalue
                                @endphp
                                <input type="text" value="@php
                                echo '$'. number_format($restantefinal,0)
                                @endphp" class="form-control border border-secondary" readonly> 
                                @else
                                <input type="text" value="0" class="form-control border border-secondary" readonly>
                                @endif


                                
                               
                        </div>
                    </div>

                </div>  
                
                <blockquote class="blockquote"><span class="badge badge-primary"><i
                    class="nav-icon fas fa-pen"></i></span><b> Comentarios Orden</b>
                </blockquote>
                <div class="card border border-secondary">
                    <div class=" row g-3 card-body">
                    <div class="col-md-12">
                          <textarea name="descripcion" id="descripcion" cols="30" rows="5"
                          class="form-control border border-secondary" readonly>{{ $inventario->Descripcionactividad }}</textarea>
                  </div>
                </div>
            </div>


                <blockquote class="blockquote"><span class="badge badge-primary"><i
                    class="nav-icon fas fa-key"></i></span><b> Recepcíon Vehículo</b>
                </blockquote>
                <div class="card border border-secondary">
                    <div class=" row g-3 card-body">
                        <div class="col-md-6">                   
                            <label for="inputEmail4" class="">
                                Operario Recibe:</label>
                                <input type="text" value="{{ $mechanic->nombremecanico }}" class="form-control border border-secondary" readonly>
                            </div>
                        <div class="col-md-6">
                            <label for="inputEmail4" class="">
                                Usuario Entrega:</label>
                                <input type="text" value="{{ $inventario->usuario }}" class="form-control border border-secondary" readonly>
                        </div>
                </div>  
            </div>
               
        </div>
</body>
</html>
@endsection
