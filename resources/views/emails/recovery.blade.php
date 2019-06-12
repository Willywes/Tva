<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <style>
        html, body{
            margin :  0 auto;
            font-family: Sans-Serif;
            background: #f5f5f5;
        }
        h4{
            font-size: 30px;
            margin: 10px;
        }
        h3{
            font-size: 36px;
        }
        h5{
            font-size: 16px;
        }
        .container{
            width: 100%;
            max-width: 700px;
            margin : 0 auto;
        }

        thead tr{
            background: #bb2f26;
        }
        .card{
            background: white;
            padding: 20px;
            border-radius: 5px;
        }
        .text-center{
            text-align: center;
        }

        .text-right{
            text-align: right;
        }
        .table {
            width: 100%;
            margin-bottom: 1rem;
            color: #212529;
            border-spacing: 0;
        }

        .table th,
        .table td {
            padding: 0.75rem;
            vertical-align: top;
            border-top: 1px solid #dee2e6;
        }

        .table thead th {
            vertical-align: bottom;
            border-bottom: 1px solid #dee2e6;
        }

        .table tbody + tbody {
            border-top: 1px solid #dee2e6;
        }

        .table-sm th,
        .table-sm td {
            padding: 0.3rem;
        }

        .table-bordered {
            border: 1px solid #dee2e6;
        }

        .table-bordered th,
        .table-bordered td {
            border: 1px solid #dee2e6;
        }

        .table-bordered thead th,
        .table-bordered thead td {
            border-bottom-width: 2px;
        }

        .mb-4{
          margin-bottom: 1.5em;
        }

        .font-12{
            font-size: 12;
        }

        .italic{
            font-style: italic;
        }
    </style>
</head>

<body class="bg-light">

<div class="container">

    <div class="text-center">
        <img style="width: 200px;"
             src="https://www.hsushi.cl/img/hsushi-logo-1521781079.jpg"
             {{--src="/hsushi/images/logo-negro.svg"--}}
             alt="">
    </div>

    <div class="card mb-4 mt-2" style="border-top: 5px solid #bb2f26;">
        <div class="card-body">

            <h4 class="text-center">Hola {{ $customer->fullname }}</h4>
            <hr/>
            <p>
                Estimado {{ $customer->fullname }}:
            </p>
            <p>
                Su nueva contraseña para acceder a nuestro sitio es <b>{{ $pass }}</b>, para acceder ingrese en <a href="{{ url('/') }}" target="_blank">{{url('/')}}</a>
            </p>

        </div>
    </div>

    <div class="card w-100 mb-4">
        <div class="card-body">
            <h4 class="text-center">Gracias por preferir Hollywood Sushi.</h4>
            <br>
            <div class="text-center text-red"><a target="_blank" class="text-red" href="https://www.hsushi.cl">Hollywood Sushi</a></div>
            <div class="text-center text-red">Padre Alfredo Arteaga Barros 1929, Lo Barnechea, Región Metropolitana
            </div>
            <div class="text-center text-red mb-4">Teléfono Pedidos <strong><a target="_blank" href="tel:+56222163171">2 2216
                        3171</a></strong></div>
        </div>
    </div>

</div>

</body>
</html>