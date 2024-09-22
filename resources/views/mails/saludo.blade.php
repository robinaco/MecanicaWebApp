<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buen Tecnico</title>
</head>
<body>

<div class="card">
        <div class="card-body border border-secondary">
            <p>Recibimos una solicitud de consulta de tus ordenes realizadas en nuestro taller de <b>JE Car Pro</b>, a continuacion puedes ver el historico.</p>
                <h5>Gracias por confiar en nosotros.!</h5>
                <p>Si deseas ampliar el detalle de la informacion contactanos al celular: <b>3216793525</b></p>
            <div id="no-more-tables">
                <table class="col-md-12 table-hoover table-bordered cf" id="latonerias">
                    <thead class="cf">
                        <tr>
                            <th scope="col" class="numeric">Placa</th>
                            <th scope="col" class="numeric">Fecha</th>
                            <th scope="col" class="numeric">Servicio</th>
                            <th scope="col" class="numeric">Descripcion</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                        <tr>
                            <td class="" data-title="Placa"
                                style="background-color: yellow;border:0.5px solid black">
                                <b>{!!$item->placa !!}</b>
                            </td>
                            <td class="" data-title="Fecha" style="border:0.5px solid black">
                                {!!$item->created_at!!}
                             </td>
                            <td data-title="" class="" style="word-wrap: break-word;border:0.5px solid black">{!! $item->descripcionservicio !!}</td>
                            <td data-title="" class="" style="word-wrap: break-word;border:0.5px solid black">{!! $item->conceptoservicio !!}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

</body>
</html>