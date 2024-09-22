@extends('layouts.app')

@section('content')
<h4 class="text-black-50 text-center"><span class="badge badge bg-warning bg-gradient">Detalle Información Cliente: <br>
    {{ $cliente->nombrecliente }}</span></h4>
<a href="/CustomerList" class="btn btn-primary btn-sm"><< Atras</a>
<hr>
<div class="card">
    <div class="card-body border border-secondary">
        <form class="row g-3" action="" method="">
            <div class="col-md-4">
                <label for="inputEmail4" class="form-label badge  badge  bg-success bg-light">Nombre
                    Completo</label>
                <input type="text" class="form-control bg-ligth bg-gradient" id="" name=""
                    value="{{ $cliente->nombrecliente }}" readonly>
            </div>
            <div class="col-md-4">
                <label for="inputPassword4" class="form-label  badge  bg-success bg-light">Tipo Documento</label>
                <input type="text" class="form-control bg-ligth bg-gradient" id="" name=""
                    value="{{ $cliente->tipodocumento }}" readonly>
            </div>
            <div class="col-md-4">
                <label for="inputEmail4" class="form-label badge  badge  bg-success bg-light">Número
                    Documento</label>
                <input type="text" class="form-control bg-ligth bg-gradient" id="" name=""
                    value="{{ $cliente->numcedula }}" readonly>
            </div>
            <div class="col-md-6">
                <label for="inputEmail4" class="form-label badge  badge  bg-success bg-light">Correo
                    Electrónico</label>
                <input type="email" class="form-control bg-ligth bg-gradient" id="" name=""
                    value="{{ $cliente->email }}" readonly>
            </div>
            <div class="col-md-6">
                <label for="inputEmail4" class="form-label badge  badge  bg-success bg-light">* Número
                    Celular</label>
                <input type="number" class="form-control bg-ligth bg-gradient" id="" name=""
                    value="{{ $cliente->numerocel}}" readonly>
            </div>
        </form>
        <hr>
        <h4 class="text-black-50 text-center">Vehiculos Registrados <a href="/{{ $cliente->id }}/AddVh"
                class="btn btn-success bg bg-gradient btn-sm" title="Agregar vehiculo">Agregar Vehiculo</a>
        </h4>
        <div class="card border border-secondary">
            <div class="card-body">
                <div id="no-more-tables">
                    <table class="col-md-12 table-hoover table-condensed cf" id="clientes">
                        <thead class="cf">
                            <tr>
                                <th scope="col">PLACA</th>
                                <th scope="col">MARCA</th>
                                <th scope="col">REFERENCIA</th>
                                <th scope="col">KILOMETRAJE</th>
                                {{-- <th scope="col">ACCIONES</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($vehiculos as $item)
                            <tr>
                                <td class="text-center" style="background-color: yellow;border:2px solid black"  data-title="Placa"><b>{!!
                                        $item->placa !!}</b></td>
                                <td  data-title="Descripcion">{!! $item->description !!}</td>
                                <td  data-title="Referencia">{!! $item->referencia !!}</td>
                                <td  data-title="Kilometraje">{!! $item->kilometraje !!}</td>
                                {{-- <td>
                                    {{-- <a href="/{{ $item->id }}/Editvh" class="btn btn-success"><span
                                            class="fas fa-pen"></span> Editar</a> </td> --}}
                                
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>






</div>


@endsection