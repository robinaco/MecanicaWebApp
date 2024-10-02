@extends('layouts.app')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cambio Propietario</title>
    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    {{--
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    --}}
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
    {{-- <script src="//code.jquery.com/jquery-1.11.1.min.js"></script> --}}
</head>
<body>
<h4 class="text-black-50 text-center"><span class="badge badge bg-secondary bg-gradient">Asignar Nuevo Propietario</span></h4>

<a href="/VehiculesList" class="btn btn-secondary btn-sm"> << Atras</a>
<hr>
@include("error")
@include("notification")
@include("advertisement")
<div class="card bg-ligth bg-gradient border border-secondary">
     <span class="imgsl"><img src="/images/transferir.png"></span>
    <div class="card-body">
            <div class="col-sm-6 col-md-6 search-header">
                <form class="navbar-form" role="search">
                    <div class="input-group">
                        <input type="number" min="1" class="form-control search-box " placeholder="Ingrese Cedula" name="srch-term" id="srch-term" autocomplete="false">
                        <div class="input-group-btn">
                            <button class="btn btn-success btn-search" onclick="searchPersonFunction();"><i class="fa fa-search"> </i> BUSCAR</button>
                        </div>
                    </div>
                </form>
            </div> 
            <hr>       
            <div class="card border border-secondary mb-3" style="padding:1%">
            <form class="row g-3" action="SaveCustomer" method="POST">
                @csrf
                <div class="col-md-4">
                    <label for="inputEmail4" class="form-label badge  badge  bg-success bg-light">* Nombre
                        Completo</label>
                    <input type="text" class="form-control border border-secondary" id="name" name="name"
                        value="{{ old('name') }}">
                    @error('name')<small>* {{ $message }}</small>@enderror
                </div>
                <div class="col-md-4">
                    <label for="inputPassword4" class="form-label  badge  bg-success bg-light">* Tipo Documento</label>
                    <input type="text" class="form-control border border-secondary" id="tdocto" name="tdocto"
                    value="{{ old('name') }}">
                    <!-- <select name="tdocto" id="tdocto" class="form-control border border-secondary">
                        <option value="0">Seleccione Tipo</option>
                        <option value="NIT" {{ old('tdocto')=='NIT' ? 'selected' : '' }}>NIT</option>
                        <option value="Cedula Ciudadania" {{ old('tdocto')=='Cedula Ciudadania' ? 'selected' : '' }}>
                            Cedula Ciudadania</option>
                        <option value="Cedula Extranjeria" {{ old('tdocto')=='Cedula Extranjeria' ? 'selected' : '' }}>
                            Cedula Extranjeria</option>
                        <option value="Tarjeta Extrangeria" {{
                            old('tdocto')=='Tarjeta Extrangeria' ? 'selected' : '' }}>Tarjeta
                            Extrangeria</option>
                        <option value="Pasaporte" {{ old('tdocto')=='Pasaporte' ? 'selected' : '' }}>Pasaporte
                        </option>
                        <option value="Tarjeta identidad" {{ old('tdocto')=='Tarjeta identidad' ? 'selected' : '' }}>
                            Tarjeta de Identidad</option>
                        <option value="NUIP" {{ old('tdocto')=='NUIP' ? 'selected' : '' }}>NUIP</option>
                        <option value="Registro Civil" {{ old('tdocto')=='Registro Civil' ? 'selected' : '' }}>
                            Registro Civil</option>
                    </select> -->
                    @error('tdocto')<small>* {{ $message }}</small>@enderror
                </div>
                <div class="col-md-4">
                    <label for="inputEmail4" class="form-label badge  badge  bg-secondary bg-light">* Número
                        Documento</label>
                    <input type="text" class="form-control border border-secondary" id="numerocedula"
                        name="numerocedula" value="{{ old('numerocedula') }}" value = "numero">
                    @error('numerocedula')<small>* {{ $message }}</small>@enderror

                </div>
                <div class="col-md-6">
                    <label for="inputEmail4" class="form-label badge  badge  bg-success bg-light">* Correo
                        Electrónico</label>
                    <input type="email" class="form-control border border-secondary" id="email" name="email"
                        value="{{ old('email') }}">
                    @error('email')<small>* {{ $message }}</small>@enderror
                </div>
                <div class="col-md-6">
                    <label for="inputEmail4" class="form-label badge  badge  bg-success bg-light">* Número
                        Celular</label>
                    <input type="number" class="form-control border border-secondary" id="numerocel" name="numerocel"
                        value="{{ old('numerocel') }}">
                    @error('numerocel')<small>* {{ $message }}</small>@enderror
                </div>
                <div class="card-body">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-secondary btn-sm">Registrar Nuevo Propietario</button>
                    </div>
                </div>

            </form>

        </div>

    </div>

</body>
</html>

</div>
<script>
    $(document).ready(function(){
        $('#txtbuscarr').on('keyup', function () {
    var value = $(this).val();
    var patt = new RegExp(value, "i");
    $('#vehiculos').find('tr').each(function () {
        if (!($(this).find('td').text().search(patt) >= 0)) {
            $(this).not('.titulos_tabla').hide();
        }
        if (($(this).find('td').text().search(patt) >= 0)) {
            $(this).show();
        }
    });
});
})
</script>

@endsection