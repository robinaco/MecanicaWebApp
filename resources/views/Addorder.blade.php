@extends('layouts.app')

@section('content')

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <style>
            .container {
                max-width: 600px;
            }
            .blockquote {

                border-radius: 0.2em;
                background-color:yellow  !important;
                border-radius: 0.2em;
               -webkit-box-shadow: 1px 0px 7px 0px rgb(0 0 0 / 75%);
               -moz-box-shadow: 1px 0px 7px 0px rgba(0,0,0,0.75);
               box-shadow: 1px 0px 7px 0px rgb(0 0 0 / 75%);
        }
            
    </style>
</head>
<body>
    <h4 class="text-black-50 text-center"><span class="badge badge bg-warning bg-gradient">Agregar Servicios:
            {{ $vehiculo->placa }}</span></h4>
    <a href="/VehiculesList" class="btn btn-primary btn-sm">
        << Atras</a>
            <hr>
            @include("error")
            @include("notification")
            @include("advertisement")
            <div class="card bg-ligth bg-gradient border border-secondary">
                <div class="card-body">
                    <i><span class="badge bg-danger bg-gradient">Campos marcados con * son obligatorios.</span></i>
                
                        <form class="row g-3" action="SaveOrder" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="col-md-1">
                                    <input type="hidden" value="{{$vehiculo->id}}" name="pkvehiculo" id="pkvehiculo"
                                    class="form-control" readonly>
                            </div>
                            <div class="col-md-6">
                                <h4><span class=""> # Orden:</span></h4><input type="text" value="{{$orden}}"
                                    class="form-control" readonly style="color: orangered" name="ordens" id="ordens">
                            </div>
                             <div class="col-md-5">
                                <h4><span class=""> Fecha Orden:</span></h4>
                                <input type="date" class="form-control" max="<?= date('Y-m-d'); ?>" value="<?php echo date('Y-m-d'); ?>" name="fechaorden">
                            </div>
                            <div>
                                <hr>
                            </div>
                            <blockquote class="blockquote"><span class="badge badge-primary"><i
                                        class="nav-icon fas fa-car-crash"></i></span> <b>Información Básica</b>
                            </blockquote>
                            
                            <div class="col-md-3">
                                <label for="inputEmail4" class="form-label badge  badge  bg-success bg-light">Nombre
                                    Propietario</label>
                                <input type="text" class="form-control border border-secondary" id="namecl"
                                    name="namecl" value="{{ $user->nombrecliente }}" readonly>
                            </div>
                            <div class="col-md-3">
                                <label for="inputPassword4" class="form-label  badge  bg-success bg-light">Nùmero
                                    Celular Propietario</label>
                                <input type="text" class="form-control border border-secondary" id="celularcl"
                                    name="celularcl" value="{{ $user->numerocel }}" readonly>
                            </div>
                            <div class="col-md-3">
                                <label for="inputEmail4" class="form-label badge  badge  bg-success bg-light">Marca
                                    Vehiculo</label>
                                <input type="text" class="form-control border border-secondary" id="marcavh"
                                    name="marcavh" value="{{$marca->description }}" readonly>
                            </div>
                            <div class="col-md-3">
                                <label for="inputEmail4"
                                    class="form-label badge  badge  bg-success bg-light">Placa</label>
                                <input type="text" class="form-control border border-secondary" id="placavh"
                                    name="placavh" value="{{ $vehiculo->placa }}" readonly>
                                @error('placa')<small>* {{ $message }}</small>@enderror
                            </div>
                            <div class="col-md-3">
                                <label for="inputEmail4"
                                    class="form-label badge  badge  bg-success bg-light">Kilometraje</label>
                                <input type="text" class="form-control border border-secondary" id="kms" name="kms"
                                    value="{{ old('kms') }}">
                                @error('kms')<small>* {{ $message }}</small>@enderror
                            </div>
                            <div class="col-md-3">
                                <label for="inputEmail4"
                                    class="form-label badge  badge  bg-success bg-light">Modelo</label>
                                <input type="text" class="form-control border border-secondary" id="modelvh" name="modelvh"
                                    value="{{  $vehiculo->modelo }}" readonly>
                            </div>
                          
                         <div class="col-md-3">
                                <label for="inputEmail4"
                                    class="form-label badge  badge  bg-success bg-light">Color</label>
                                <input type="text" class="form-control border border-secondary" id="color"
                                    name="color" value="{{ $vehiculo->color }}" readonly>
                                @error('color')<small>* {{ $message }}</small>@enderror
                            </div>
                            <div class="col-md-3">
                                <label for="inputEmail4" class="form-label badge  badge  bg-success bg-light"> * Nivel
                                    Combustible</label>
                                <select name="nivel" id="nivel" class="form-control border border-secondary">
                                    <option value="0">Seleccione un nivel</option>
                                    <option value="1/2" {{ old('nivel')=='1/2'  ? 'selected' : '' }}>1/2</option>
                                    <option value="1/4" {{ old('nivel')=='1/4'  ? 'selected' : '' }}>1/4</option>
                                    <option value="2/4" {{ old('nivel')=='2/4'  ? 'selected' : '' }}>2/4</option>
                                    <option value="4/4" {{ old('nivel')=='4/4'  ? 'selected' : '' }}>4/4</option>
                                    <option value="full"{{ old('nivel')=='full'  ? 'selected' : '' }}>Full</option>
                                    </option>
                                </select>
                                @error('nivel')<small>* {{ $message }}</small>@enderror
                            </div>
                            <div>
                                <hr>
                            </div>
                           
                            <blockquote class="blockquote"><span class="badge badge-primary"><i
                                        class="nav-icon fas fa-fire-extinguisher"></i></span> <b> Inventario del Vehiculo</b>
                            </blockquote>
                            <div class="col-md-2">
                                <label for="inputEmail4" class="form-label badge  badge  bg-secondary bg-light">*
                                    Antena?</label>
                                <select name="antena" id="antena" class="form-control border border-secondary">
                                     <option value="no" {{ old('antena')=='no' ? 'selected' : '' }}>NO</option>
                                    <option value="si" {{ old('antena')=='si' ? 'selected' : '' }}>SI</option>
                                   
                                </select>
                                @error('antena')<small>* {{ $message }}</small>@enderror
                            </div>
                            <div class="col-md-2">
                                <label for="inputEmail4" class="form-label badge  badge  bg-secondary bg-light">*
                                    Extintor?</label>
                                <select name="extintor" id="extintor" class="form-control border border-secondary">
                                    <option value="no" {{ old('extintor')=='no' ? 'selected' : '' }}>NO</option>
                                    <option value="si" {{ old('extintor')=='si' ? 'selected' : '' }}>SI</option>
                                    
                                </select>
                                @error('extintor')<small>* {{ $message }}</small>@enderror
                            </div>
                            <div class="col-md-2">
                                <label for="inputEmail4" class="form-label badge  badge  bg-secondary bg-light">*
                                    Gato?</label>
                                <select name="gato" id="gato" class="form-control border border-secondary">
                                    <option value="no" {{ old('gato')=='no' ? 'selected' : '' }}>NO</option>
                                    <option value="si" {{ old('gato')=='si' ? 'selected' : '' }}>SI</option>
                                    
                                </select>
                                @error('gato')<small>* {{ $message }}</small>@enderror
                            </div>
                            <div class="col-md-2">
                                <label for="inputEmail4" class="form-label badge  badge  bg-secondary bg-light">* LLanta
                                    Repuesto?</label>
                                <select name="llanta" id="llanta" class="form-control border border-secondary">
                                    <option value="no" {{ old('llanta')=='no' ? 'selected' : '' }}>NO</option>
                                    <option value="si" {{ old('llanta')=='si' ? 'selected' : '' }}>SI</option>
                                    
                                </select>
                                @error('llanta')<small>* {{ $message }}</small>@enderror
                            </div>
                            <div class="col-md-2">
                                <label for="inputEmail4"
                                    class="form-label badge  badge  bg-secondary bg-light">* Herramientas?</label>
                                <select name="herramienta" id="herramienta" class="form-control border border-secondary">
                                    <option value="no" {{ old('herramienta')=='no' ? 'selected' : '' }}>NO</option>
                                    <option value="si" {{ old('herramienta')=='si' ? 'selected' : '' }}>SI</option>
                                    
                                </select>
                                @error('herramienta')<small>* {{ $message }}</small>@enderror
                            </div>
                            <div class="col-md-2">
                                <label for="inputEmail4" class="form-label badge  badge  bg-secondary bg-light">* Kit
                                    Carretera?</label>
                                <select name="kit" id="kit" class="form-control border border-secondary">
                                    <option value="no" {{ old('kit')=='no' ? 'selected' : '' }}>NO</option>
                                    <option value="si" {{ old('kit')=='si' ? 'selected' : '' }}>SI</option>
                                    
                                </select>
                                @error('kit')<small>* {{ $message }}</small>@enderror
                            </div>
                            <div class="col-md-2">
                                <label for="inputEmail4"
                                    class="form-label badge  badge  bg-secondary bg-light">* Documentos
                                    carro?</label>
                                <select name="documentos" id="documentos" class="form-control border border-secondary">
                                    <option value="no" {{ old('documentos')=='no' ? 'selected' : '' }}>NO</option>
                                    <option value="si" {{ old('documentos')=='si' ? 'selected' : '' }}>SI</option>
                                    
                                </select>
                                @error('documentos')<small>* {{ $message }}</small>@enderror
                            </div>
                            <div class="col-md-2">
                                <label for="inputEmail4"
                                    class="form-label badge  badge  bg-secondary bg-light">* Radio?</label>
                                <select name="radio" id="radio" class="form-control border border-secondary">
                                    <option value="no" {{ old('radio')=='no' ? 'selected' : '' }}>NO</option>
                                    <option value="si" {{ old('radio')=='si' ? 'selected' : '' }}>SI</option>
                                    
                                </select>
                                @error('radio')<small>* {{ $message }}</small>@enderror

                            </div>
                            <div class="col-md-2">
                                <label for="inputEmail4"
                                    class="form-label badge  badge  bg-secondary bg-light">* Parlantes?</label>
                                <select name="parlantes" id="parlantes" class="form-control border border-secondary">
                                    <option value="no" {{ old('parlantes')=='no' ? 'selected' : '' }}>NO</option>
                                    <option value="si" {{ old('parlantes')=='si' ? 'selected' : '' }}>SI</option>
                                    
                                </select>
                                @error('parlantes')<small>* {{ $message }}</small>@enderror

                            </div>
                            <div class="col-md-2">
                                <label for="inputEmail4"
                                    class="form-label badge  badge  bg-secondary bg-light">* Tapetes?</label>
                                <select name="tapetes" id="tapetes" class="form-control border border-secondary">
                                    <option value="no" {{ old('tapetes')=='no' ? 'selected' : '' }}>NO</option>
                                    <option value="si" {{ old('tapetes')=='si' ? 'selected' : '' }}>SI</option>
                                    
                                </select>
                                @error('tapetes')<small>* {{ $message }}</small>@enderror

                            </div>
                            <div class="col-md-2">
                                <label for="inputEmail4"
                                    class="form-label badge  badge  bg-secondary bg-light">* Encendedor?</label>
                                <select name="encendedor" id="encendedor" class="form-control border border-secondary">
                                    <option value="no" {{ old('encendedor')=='no' ? 'selected' : '' }}>NO</option>
                                    <option value="si" {{ old('encendedor')=='si' ? 'selected' : '' }}>SI</option>
                                    
                                </select>
                                @error('encendedor')<small>* {{ $message }}</small>@enderror

                            </div>
                            <div class="col-md-2">
                                <label for="inputEmail4"
                                    class="form-label badge  badge  bg-secondary bg-light">* Espejos?</label>
                                <select name="espejos" id="espejos" class="form-control border border-secondary">
                                    <option value="no" {{ old('espejos')=='no' ? 'selected' : '' }}>NO</option>
                                    <option value="si" {{ old('espejos')=='si' ? 'selected' : '' }}>SI</option>
                                    
                                </select>
                                @error('espejos')<small>* {{ $message }}</small>@enderror

                            </div>
                            <div class="col-md-2">
                                <label for="inputEmail4"
                                    class="form-label badge  badge  bg-secondary bg-light">* Parasoles?</label>
                                <select name="parasoles" id="parasoles" class="form-control border border-secondary">
                                    <option value="no" {{ old('parasoles')=='no' ? 'selected' : '' }}>NO</option>
                                    <option value="si" {{ old('parasoles')=='si' ? 'selected' : '' }}>SI</option>
                                    
                                </select>
                                @error('parasoles')<small>* {{ $message }}</small>@enderror

                            </div>
                            <div class="col-md-2">
                                <label for="inputEmail4"
                                    class="form-label badge  badge  bg-secondary bg-light">* Limpiabrisas?</label>
                                <select name="limpiabrisas" id="limpiabrisas" class="form-control border border-secondary">
                                    <option value="no" {{ old('limpiabrisas')=='no' ? 'selected' : '' }}>NO</option>
                                    <option value="si" {{ old('limpiabrisas')=='si' ? 'selected' : '' }}>SI</option>
                                    
                                </select>
                                @error('limpiabrisas')<small>* {{ $message }}</small>@enderror

                            </div>
                            <div class="col-md-4">
                                <label for="inputEmail4"
                                    class="form-label badge  badge  bg-secondary bg-light">* Bateria?</label>
                                <select name="bateria" id="bateria" class="form-control border border-secondary">
                                    <option value="no" {{ old('bateria')=='no' ? 'selected' : '' }}>NO</option>
                                    <option value="si" {{ old('bateria')=='si' ? 'selected' : '' }}>SI</option>
                                    
                                </select>
                                @error('bateria')<small>* {{ $message }}</small>@enderror

                            </div>
                            <div class="col-md-2">
                                <label for="inputEmail4" class="form-label badge  badge  bg-secondary bg-light">* Pintura
                                    Fogueada?</label>
                                <select name="pintura" id="pintura" class="form-control border border-secondary">
                                    <option value="no" {{ old('pintura')=='no' ? 'selected' : '' }}>NO</option>
                                    <option value="si" {{ old('pintura')=='si' ? 'selected' : '' }}>SI</option>
                                    
                                </select>
                                @error('pintura')<small>* {{ $message }}</small>@enderror

                            </div>
                            <div class="col-md-2">
                                <label for="inputEmail4" class="form-label badge  badge  bg-secondary bg-light">* Vehiculo
                                    Sucio?</label>
                                <select name="suciedad" id="suciedad" class="form-control border border-secondary">
                                    <option value="no" {{ old('suciedad')=='no' ? 'selected' : '' }}>NO</option>
                                    <option value="si" {{ old('suciedad')=='si' ? 'selected' : '' }}>SI</option>
                                    
                                </select>
                                @error('suciedad')<small>* {{ $message }}</small>@enderror

                            </div>
                            <div>
                                <hr>
                            </div>
                            <blockquote class="blockquote"><span class="badge badge-primary"><i
                                        class="nav-icon fas fa-folder-open"></i></span><b> Cargar Fotos Vehiculo</b>
                            </blockquote>
                            <div class="card-body">
                                <div class="col-md-12">
                                    <label for="inputEmail4" class="form-label badge  badge  bg-secondary bg-light">* Seleccione las fotos para <br>
                                        cargar en formatos(jpeg,png,jpg)</label>
                                    <input type="file" id="fotos" name="fotos[]" accept="/image*" class="form-control {{ $errors->has('fotos') ? ' is-invalid' : '' }}" multiple>
                                    @if ($errors->has('fotos'))
                                        <div class="invalid-feedback">{{ $errors->first('fotos') }}</div>
                                    @endif
                                </div>
                              </div>
                              <div>
                                <!-- <hr> -->
                            </div>
                            <!-- <blockquote class="blockquote"><span class="badge badge-primary"><i
                                class="nav-icon fas fa-tools"></i></span> <b>Información Servicios a Realizar</b>
                        <button type="button" class="btn btn-primary bg-primary bg-gradient  btn-sm" data-toggle=""
                            data-target="" onclick="agregarProducto()">Agregar Servicio</button>
                    </blockquote> -->
                    <!-- <div class="card-body">
                        <from>
                            <div class="table-responsive">
                                <table id="TablaPro" class="table table-default table-bordered">
                                    <thead>
                                        <tr class="bg bg-success">
                                            <th>Servicio</th>
                                            <th>Descripción Servicio</th>
                                            <th>Cantidad</th>
                                            <th>Precio Unitario</th>
                                            <th>Subtotal</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody id="ProSelected">
                                        <tr>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td style="background-color:whitesmoke"><b style="color: orangered">Total:</b></td>
                                            <td style="background-color: whitesmoke">&nbsp;</td>
                                            <td style="background-color: whitesmoke">&nbsp;</td>
                                            <td style="background-color: whitesmoke">&nbsp;</td>
                                            <td style="background-color:whitesmoke"><span id="total" style="color: orangered">0</span><input class="form-control"
                                                    type="hidden" id="total_final" name="total_final" value="0"
                                                    readonly /></td>
                                            <td>&nbsp;</td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </from>
                    </div> -->
                    <div>
                        <hr>
                    </div>                         
                            <blockquote class="blockquote"><span class="badge badge-primary"><i
                                        class="nav-icon fas fa-dollar-sign"></i></span><b> Valor Abono </b>
                            </blockquote>
                            <div class="col-md-4">
                                <label for="inputEmail4"
                                    class="form-label badge  badge  bg-success bg-light">Valor</label>
                                <input type="text" class="form-control border border-secondary" id="cost" name="cost"
                                    value="0">
                                @error('cost')<small>* {{ $message }}</small>@enderror
                            </div>
                            <div class="col-md-4">
                                <label for="inputEmail4" class="form-label badge  badge  bg-success bg-light">
                                    Abona</label>
                                <input type="number" class="form-control border border-secondary" id="abono"
                                    name="abono" value="0">
                                @error('abono')<small>* {{ $message }}</small>@enderror
                            </div>
                            <div class="col-md-4">
                                <label for="inputEmail4"
                                    class="form-label badge  badge  bg-success bg-light">Resta</label>
                                <input type="number" class="form-control border border-secondary" id="resta"
                                    name="resta" value="0">
                                @error('resta')<small>* {{ $message }}</small>@enderror
                            </div>
                            <div>
                                <hr>
                            </div>
                            <blockquote class="blockquote"><span class="badge badge-primary"><i 
                                class="nav-icon fas fa-bullhorn"></i></span><b> Comentarios</b>
                    </blockquote>
                    <div class="col-md-12">
                        <label for="inputEmail4" class="form-label badge  badge  bg-secondary bg-light">Observaciones Adicionales</label>
                        <textarea name="descripcion" id="descripcion" cols="30" rows="5"
                            class="form-control border border-secondary">{{{ Request::old('descripcion') }}}</textarea>
                            @error('descripcion')<small>* {{ $message }}</small>@enderror

                    </div>
                    <div>
                        <hr>
                    </div>
                            <blockquote class="blockquote"><span class="badge badge-primary"><i
                                        class="nav-icon fas fa-key"></i></span><b> Recepcíon Vehiculo</b>
                            </blockquote>
                            <div class="col-md-6">
                                <label for="inputEmail4" class="form-label badge  badge  bg-success bg-light">Técnico
                                    que Recibe?</label>
                                <select name="receptor" id="receptor" class="form-control border border-secondary">
                                    @foreach ($empleados as $item)
                                    <option value="{{$item->id}}">{{$item->nombremecanico}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="inputEmail4" class="form-label badge  badge  bg-success bg-light">* Usuario
                                    que Entrega?</label>
                                <input type="text" class="form-control border border-secondary" id="nombreclentrega"
                                    name="nombreclentrega" value="{{ $user->nombrecliente }}">
                                    @error('nombreclentrega')<small>* {{ $message }}</small>@enderror
                            </div>
                            <div class="card-body">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-success bg-success bg-gradient btn-sm" id="registrar">Registrar Orden
                                        Servicio</button>
                                </div>
                            </div>
                            

                        </form>

                 

                </div>

            </div>
            
        
        </body>

</html>


        <script type="text/javascript">
            let costo = document.getElementById("cost")
	        let abono = document.getElementById("abono")
	        let resta = document.getElementById("resta")
		    abono.addEventListener("change", () => {
		    resta.value = parseFloat(costo.value) - parseFloat(abono.value)
            });
</script> 
</html>
@endsection