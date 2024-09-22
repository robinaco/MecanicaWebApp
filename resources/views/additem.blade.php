@extends('layouts.app')

@section('content')

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registrar Servicio</title>
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
    <h5 class="text-black-50 text-center">Agregar Servicios Orden<br><span class="badge badge-warning">{{ $orden }}</span></h5>
    <a href="/OrdenesLatonerias" class="btn btn-warning btn-sm">
        << Atras</a>
            <hr>
            @include("error")
            @include("notification")
            @include("advertisement")
            @php
            $sumamano=0;
            $acumulado=0;
            @endphp
            <div class="card border border-secondary">
                <div class="card-body border border-secondary">
                    <div class="col-md-6">
                        <h3><span class=""></span></h3><b>@php echo date('Y-m-d');@endphp</b>
                    </div>               
                    <div>
                        <hr>
                    </div>
                    <blockquote class="blockquote"><span class="badge badge-primary"><i 
                        class="nav-icon fas fa-bullhorn"></i></span><b> Valores Actuales Orden</b>
                    </blockquote>

                    <div class="row g-3">
                        <div class="col-md-4">
                            <label for="inputEmail4"
                                class="form-label badge  badge  bg-success bg-light">Valor Total Orden Actual:</label>
                            <input type="text" class="form-control border border-secondary" id="cost" name="cost"
                                value="{{$inventario->valorcosto}}" readonly>
                            @error('kms')<small>* {{ $message }}</small>@enderror
                        </div>
                        <div class="col-md-4">
                            <label for="inputEmail4" class="form-label badge  badge  bg-success bg-light">
                                Abono Actual Orden:</label>
                            <input type="number" class="form-control border border-secondary" id="abonon"
                                name="abonon" value="{{$inventario->valorabono}}" readonly>
                            @error('kms')<small>* {{ $message }}</small>@enderror
                        </div>
                        <div class="col-md-4">
                            <label for="inputEmail4"
                                class="form-label badge  badge  bg-success bg-light">Total Saldo Restante Orden Actual:</label>
                            <input type="number" class="form-control border border-secondary" id="restan"
                                name="restan" value="{{$inventario->valorrestante}}" readonly>
                            @error('resta')<small>* {{ $message }}</small>@enderror
                        </div>
                    </div>
                    <div class="table-responsive">
                      <div class="card-body">
                        <hr>
                            <form  class="row g-3" method="POST" action="SaveNewLatoneria">
                                @csrf
                                <div class="col-md-3">
                                </div>
                                <div class="col-md-3">
                                </div>
                                <div class="col-md-6">
                                    <button type="button" class="btn btn-primary bg-primary bg-gradient btn-sm" data-toggle=""
                                    data-target="" onclick="agregarProducto()"> Agregar Servicio</button>
                                </div>
                         <div class="card-body">
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
                                                <td style="background-color:whitesmoke" colspan="4"><b style="color: orangered">Total:</b></td>
                                                <td style="background-color:whitesmoke"><span id="total" style="color: orangered">0</span><input class="form-control"
                                                        type="hidden" id="total_final" name="total_final" value="0"
                                                        readonly /></td>
                                                <td>&nbsp;</td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </from>
                        </div>
                        <div>
                            <hr>
                        </div>
                        <blockquote class="blockquote"><span class="badge badge-primary"><i 
                            class="nav-icon fas fa-bullhorn"></i></span><b> Valor de los Nuevos Servicios Agregados</b>
                        </blockquote>
                        <div class="col-md-4">
                        </div>
                        <div class="col-md-4">
                            <label for="inputEmail4"
                            class="form-label badge  badge  bg-success bg-light">Valor Nuevos  Servicios</label>
                        <input type="text" class="form-control border border-secondary" id="costo" name="costo"
                            value="" readonly>
                        @error('costo')<small>* {{ $message }}</small>@enderror
                        </div>
                        <div class="col-md-4">
                        </div>
                        <div>
                            <hr>
                        </div>
                        <blockquote class="blockquote"><span class="badge badge-primary"><i 
                            class="nav-icon fas fa-bullhorn"></i></span><b> Comentarios</b>
                        </blockquote>
                        <div class="col-md-12">
                            <label for="inputEmail4" class="form-label badge  badge  bg-secondary bg-light">* Observaciones Adicionales</label>
                            <textarea name="descripcion" id="descripcion" cols="30" rows="5"
                                class="form-control border border-secondary">{{$inventario->Descripcionactividad }}</textarea>
                                @error('descripcion')<small>* {{ $message }}</small>@enderror
                        </div>
                        <div class="card-body">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-success bg-success bg-gradient btn-sm" id="registrar">Registrar Nuevo
                                    Servicio</button>
                            </div>
                        </div>
                            </form>

                      </div>
                    </div>
                </div>
            </div>  





        <script type="text/javascript">
            $('#registrar').attr('disabled', true);
        
                function agregarProducto() {
                    
                    $('#abono').val('');
                    $('#resta').val('');
                    var sel = $('#pro_id').find(':selected').val(); //Capturo el Value del Producto
                    var text = $('#pro_id').find(':selected').text();
                    var sptext = text.split();
                    var newtr = '<tr class="item">';
                    newtr = newtr + '<td class="iProduct"><input type="hidden" value="{{$orden}}" name="odsl[]" id="odsl" class="form-control" readonly><input type="hidden" value="{{$car}}" name="idvehiculo[]" id="idvehiculo"class="form-control" readonly> <select name="pro_id[]" id="pro_id" class="selectpicker form-control border border-warning border-gradient border-gradient" style="background-color:whitesmoke">'
                    newtr = newtr +  '<option value="Mecanica General"><b>Mecanica General</b>'
                    newtr = newtr +  '</option>'
                    newtr = newtr +  '<option value="Cambio Aceite"><b>Cambio Aceite</b></option>'
                    newtr = newtr + '<option value="Lavado Vehiculo"><b>Lavado Vehiculo</b></option>'
                    newtr = newtr + '</select></td>';
                    newtr = newtr + '<td><input class="form-control border border-success border-gradient border-gradient" type="text"  min="1" id="concept[]" name="concept[]"/></td>';
                    newtr = newtr + '<td><input class="form-control border border-warning border-gradient border-gradient" type="number" min="1" id="cantidad[]" name="cantidad[]" onChange="Calcular(this);" value="1" /></td>';
                    newtr = newtr + '<td><input class="form-control border border-warning border-gradient border-gradient" type="number" min="1" id="precunit[]" name="precunit[]" onChange="Calcular(this);" value="0"/></td>';
                    newtr = newtr + '<td><input class="form-control border border-warning border-gradient border-gradient" type="text" id="totalitem[]" name="totalitem[]" readonly /></td>';
                    newtr = newtr + '<td><button type="button" class="btn btn-danger btn-sm remove-item" ><i class="fa fa-times" title="Borrar Item"></i></button> <button type="button" onclick="agregarProducto()" class="btn btn-primary btn-sm" title="Agregar Item"><i class="fa fa-plus"></i></button></td></tr>';
                    $('#ProSelected').append(newtr); //Agrego el Producto al tbody de la Tabla con el id=ProSelected
                    RefrescaProducto(); //Refresco Productos
                    $('.remove-item').off().click(function(e) {
                    location.reload(true);
                    var total = document.getElementById("total");
                    total.innerHTML = parseFloat(total.innerHTML) - parseFloat(this.parentNode.parentNode.childNodes[3].childNodes[0].value);
                    document.getElementById('costo').value = total.innerHTML; 
                    $(this).parent('td').parent('tr').remove(); //Accion para eliminar el Producto de la Tabla Dinamica.
                    if ($('#ProSelected tr.item').length == 0)
                        $('#ProSelected .no-item').slideDown(300);
                        $('#abono').val('');
                        $('#resta').val('');
                    RefrescaProducto();
                Calcular(e.target);
                });
                $('.iProduct').off().change(function(e) {
                RefrescaProducto();
                });
            }
          
           
    
   
           
            function Calcular(ele) {
                $('#registrar').attr('disabled', false);
                var cantidad = 0, precunit = 0, totalitem = 0 ;
                var tr = ele.parentNode.parentNode;
                var nodes = tr.childNodes;
               for (var x = 0; x<nodes.length;x++) {
                   if (nodes[x].firstChild.id == 'cantidad[]') {
                       cantidad = parseFloat(nodes[x].firstChild.value,10);
                   }
                    if (nodes[x].firstChild.id == 'precunit[]') {
                        precunit = parseFloat(nodes[x].firstChild.value,10);
                    }
                    if (nodes[x].firstChild.id == 'totalitem[]') {
                        anterior = nodes[x].firstChild.value;
                       totalitem = parseFloat((precunit*cantidad),10);
                       nodes[x].firstChild.value = totalitem;  
                    }
                }
               // Resultado final de cada fila ERROR, al editar o eliminar una fila
                var total = document.getElementById("total");
               if (total.innerHTML == 'NaN') {
                total.innerHTML = parseFloat(total.innerHTML)+ totalitem - anterior ;   
                document.getElementById('costo').value = total.innerHTML; 
                total.innerHTML = 0;
               }else{
                total.innerHTML = parseFloat(total.innerHTML)+ totalitem - anterior ;   
                document.getElementById('costo').value = total.innerHTML; 
               }
                     
           }
   
   
          function RefrescaProducto() {
                var ip = [];
                var i = 0;
                $('#guardar').attr('disabled', 'disabled'); //Deshabilito el Boton Guardar
                $('.iProduct').each(function(index, element) {
                    i++;
                    ip.push({
                        id_pro: $(this).val()
                    });
                });
                // Si la lista de Productos no es vacia Habilito el Boton Guardar
                if (i > 0) {
                    $('#guardar').removeAttr('disabled', 'disabled');
                }
                var ipt = JSON.stringify(ip); //Convierto la Lista de Productos a un JSON para procesarlo en tu controlador
                $('#ListaPro').val(encodeURIComponent(ipt));
            }
   </script>
</body>

</html>
@endsection