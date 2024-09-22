<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ config('', 'MecanicaApp') }}</title>

    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css"
          integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog=="
          crossorigin="anonymous"/>

    <link href="{{ mix('css/app.css') }}" rel="stylesheet">

</head>
<body class="hold-transition login-page">
<div class="login-box">

    <!-- /.login-logo -->

    <!-- /.login-box-body -->
            <h1 class="text-center"><span class="fas fa-tools"></span> MecanicWebApp</h1>
    <div class="card card border-secondary">

          <div class="flex justify-center pt-8 sm:justify-start sm:pt-0">
                
               
            </div>
        <div class="card-body login-card-body">
            <p class="login-box-msg"><b>Datos de Acceso</b></p>

            <form method="post" action="{{ url('/login') }}">
                @csrf

                <div class="input-group mb-3">
                    <input type="email"
                           name="email"
                           value="{{ old('email') }}"
                           placeholder="Email"
                           class="form-control @error('email') is-invalid @enderror">
                    <div class="input-group-append">
                        <div class="input-group-text"><span class="fas fa-envelope"></span></div>
                    </div>
                    @error('email')
                    <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="input-group mb-3">
                    <input type="password"
                           name="password"
                           placeholder="Password"
                            id="password"
                           class="form-control @error('password') is-invalid @enderror">
                            <span class="password-toggle-icon"><i class="fas fa-eye" title="ver password"></i></span>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                    @error('password')
                    <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror

                </div>

                <div class="row">
                    <div class="col-8">
                        <div class="icheck-primary">
                          
                        </div>
                    </div>

                    <div class="col-4">
                        <button type="submit" class="btn btn-secondary btn-block">Ingresar</button>
                    </div>

                </div>
            </form>

           
        </div>
         
        <!-- /.login-card-body -->
    </div>
    <hr>
    <p class="mb-0">
                Herramienta Web para la Administracion y Gestion de Servicios de Mecanica.
            </p>

</div>
<!-- /.login-box -->

<script src="{{ mix('js/app.js') }}" defer></script>

</body>
</html>
