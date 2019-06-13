<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="/tva/plugins/bootstrap/bootstrap.min.css">
    <!-- Font awesome -->
    {{--<link rel="stylesheet" href="/tva/plugins/font-awesome/all.css">--}}
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <!-- fonts -->
    <link href="https://fonts.googleapis.com/css?family=Barlow:100,200,300,400,500,600,700,800,900" rel="stylesheet">
    <!-- Slick -->
    <link rel="stylesheet" href="/tva/plugins/slick/slick.css">
    <link rel="stylesheet" href="/tva/plugins/slick/slick-theme.css">

    <!-- Animate css -->
    <link rel="stylesheet" type="text/css" href="/tva/plugins/animate-css/animate.css"/>

    <!-- Toastr -->
    <link rel="stylesheet" type="text/css" href="/tva/plugins/toastr/toastr.min.css"/>

    <!-- Custom -->
    <link rel="stylesheet" href="/tva/css/custom.css">

    @yield('styles')

    <title>Tienda Virtual Agrícola</title>

</head>
<body>
<div>

@include('frontend.template.layouts.header')

@yield('top')


<div class="mt-5">
    @yield('content')
</div>


@include('frontend.template.layouts.footer')

<!-- Modal Menu -->
    <div id="modal-menu" class="as-modal">
        <div class="close-as-modal"><i class="fas fa-times"></i></div>
        <div class="as-modal-content">
            <h3 class="light text-center">MENÚ</h3>
            <div class="as-modal-body ">
                <div class="text-center font-22">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a href="/#carta" onclick="closeASModal('modal-menu');" style="color: white; text-decoration: none;">Productos</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('profile.addresses') }}" style="color: white; text-decoration: none;">Mi Cuenta</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('profile.orders') }}" style="color: white; text-decoration: none;">Mis Pedidos</a>
                        </li>
                        {{--<li class="nav-item">--}}
                            {{--<a href="#" data-toggle="modal" data-target="#modal-check-address" style="color: white; text-decoration: none;">Zona de Reparto</a>--}}
                        {{--</li>--}}
                    </ul>
                </div>
            </div>
        </div>
    </div>

</div>


{{--<!-- Button to Open the Modal -->--}}
{{--<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-check-address">--}}
    {{--Open modal--}}
{{--</button>--}}



<div class="modal" id="modal-check-address">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Comprobar Dirección</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12" id="check-address-message"></div>
                </div>
                <label for="check-address">Ingrese Dirección</label>
                <div class="input-group mb-3">
                    <input type="text" id="check-address" class="form-control">
                    <div class="input-group-append">
                        <button class="btn btn-primary" onclick="checkAddress('check-address');">Comprobar</button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Jquery -->
<script src="/tva/plugins/jquery/jquery-3.4.0.min.js"></script>
<!-- Popper -->
<script src="/tva/plugins/popper/popper.min.js"></script>
<!-- Bootstrap -->
<script src="/tva/plugins/bootstrap/bootstrap.min.js"></script>
<!-- Slick -->
<script src="/tva/plugins/slick/slick.min.js"></script>
<!-- Toastr -->
<script src="/tva/plugins/toastr/toastr.min.js"></script>

<!-- app -->
<script src="/tva/js/app.js"></script>


@yield('scripts')

@include('frontend.carta._script-products')
<script>

    function renderMessage(div, title = null, message = null, alert = null) {
        var title = title ? title : 'Error';
        var message = message ? message : 'Algo no ha salido bien.';
        var alert = alert ? alert : 'danger';
        $('#' + div + '-message').html('');
        $('#' + div + '-message').append($('<div class="alert alert-' + alert + '" role="alert">' +
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
            '   <span aria-hidden="true">&times;</span>' +
            '</button>' +
            '<h4 class="alert-heading">' + title + '</h4>' +
            '<p>' + message + '</p>' +
            '</div>'));
    }

    function validateLogin() {
        var logged = '{{ auth()->guard('customer')->user() }}';
        if (!logged) {

            $('#modalProduct').modal('hide');
            $('#modalProduct').on('hidden.bs.modal', function (e) {
                $('#modal-login').addClass('active ultra-faster');
            });
            $('#modal-login').addClass('active ultra-faster');
            // animateCSS('#' + data, 'zoomIn');
            return false;
        }
        return true;
    }
</script>
</body>
</html>