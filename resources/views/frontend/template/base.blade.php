<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="/hsushi/plugins/bootstrap/bootstrap.min.css">
    <!-- Font awesome -->
    {{--<link rel="stylesheet" href="/hsushi/plugins/font-awesome/all.css">--}}
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <!-- fonts -->
    <link href="https://fonts.googleapis.com/css?family=Barlow:100,200,300,400,500,600,700,800,900" rel="stylesheet">
    <!-- Slick -->
    <link rel="stylesheet" href="/hsushi/plugins/slick/slick.css">
    <link rel="stylesheet" href="/hsushi/plugins/slick/slick-theme.css">

    <!-- Animate css -->
    <link rel="stylesheet" type="text/css" href="/hsushi/plugins/animate-css/animate.css"/>

    <!-- Toastr -->
    <link rel="stylesheet" type="text/css" href="/hsushi/plugins/toastr/toastr.min.css"/>

    <!-- Custom -->
    <link rel="stylesheet" href="/hsushi/css/custom.css">

    @yield('styles')

    <title>Tienda Virtual Agrícola</title>

</head>
<body>
<div>

@include('frontend.template.layouts.header')

@yield('top')


@yield('content')


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
                        <li class="nav-item">
                            <a href="#" data-toggle="modal" data-target="#modal-check-address" style="color: white; text-decoration: none;">Zona de Reparto</a>
                        </li>
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
<script src="/hsushi/plugins/jquery/jquery-3.4.0.min.js"></script>
<!-- Popper -->
<script src="/hsushi/plugins/popper/popper.min.js"></script>
<!-- Bootstrap -->
<script src="/hsushi/plugins/bootstrap/bootstrap.min.js"></script>
<!-- Slick -->
<script src="/hsushi/plugins/slick/slick.min.js"></script>
<!-- Toastr -->
<script src="/hsushi/plugins/toastr/toastr.min.js"></script>

<!-- app -->
<script src="/hsushi/js/app.js"></script>

<!-- maps api -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCAAmAT7uLBgkV8LJnual7nFtM41k4ajC0&sensor=false&libraries=geocoder,places,geometry&callback=initAutocomplete"
        async defer></script>


<script>


    // function fillInAddress() {
    //
    //     try{
    //
    //         var place = autocomplete.getPlace();
    //         var lat = autocomplete.getPlace().geometry.location.lat();
    //         var lng = autocomplete.getPlace().geometry.location.lng();
    //
    //         console.log(place);
    //         console.log(lat);
    //         console.log(lng);
    //         if(!streetNumberExists(place)){
    //             showToastWarning('Para ser más preciso por favor ingrese su número de dirección.','¡Aviso!' );
    //             return;
    //         }
    //
    //         if(!localityExists(place)){
    //             showToastWarning('Para ser más preciso por favor ingrese su ciudad.','¡Aviso!' );
    //             return;
    //         }
    //
    //
    //         if(!checkInSidePolygon(lat, lng)){
    //             showToastWarning('Lamentablemente su dirección no está dentro de la zona de reparto, de igual manera podrá comprar y retirar en el local.','¡Aviso!');
    //             getCity(place);
    //         }else{
    //             getCity(place);
    //         }
    //
    //
    //     }catch(e){
    //         showToastError('Por favor, selecciona una dirección válida.', '¡Error!');
    //     }
    //
    // }
    //
    // function streetNumberExists(place){
    //     var flag = false;
    //     for (var i = 0; i < place.address_components.length; i++) {
    //         var addressType = place.address_components[i].types[0];
    //
    //         if(addressType == 'street_number'){
    //             flag = true;
    //         }
    //     }
    //
    //     return flag;
    // }
    //
    // function localityExists(place){
    //     var flag = false;
    //     for (var i = 0; i < place.address_components.length; i++) {
    //         var addressType = place.address_components[i].types[0];
    //
    //         if(addressType == 'locality'){
    //             flag = true;
    //         }
    //     }
    //
    //     return flag;
    // }
    //
    // function getCity(place){
    //
    //     try{
    //         for (var i = 0; i < place.address_components.length; i++) {
    //             var addressType = place.address_components[i].types[0];
    //             console.log(addressType);
    //
    //             if( addressType == 'administrative_area_level_3'){
    //                 document.getElementById("city").value = place.address_components[i].long_name;
    //             }else if(addressType == 'administrative_area_level_2'){
    //                 document.getElementById("city").value = place.address_components[i].long_name;
    //             }
    //         }
    //     }catch(error){
    //         console.log(error);
    //     }
    // }


    function initAutocomplete() {

        var options = {
            types: ['geocode'],
            componentRestrictions: {country: "cl"}
        };

        new google.maps.places.Autocomplete((document.getElementById("check-address")), options);
        if ($('#new-address').length) {
            new google.maps.places.Autocomplete((document.getElementById("new-address")), options);
        }
    }

    $('#modal-check-address').on('hidden.bs.modal', function () {
        $('#check-address').val('');
        $('#check-address-message').html('');
    });

    function checkAddress(input) {
        var address = $('#' + input).val();
        if (address) {
            validateAddress(input, function (response) {
                renderMessage(input, response.title, response.message, response.alert);
                $('#' + input).val('');
            });
        } else {
            renderMessage(input, '¡Error!', 'Ingrese una direccion.', 'danger');
        }
    }

    function validateAddress(input, callback) {

        try {

            var geocoder = new google.maps.Geocoder();
            var address = $('#' + input).val();

            geocoder.geocode({'address': address}, function (results, status) {

                if (status == google.maps.GeocoderStatus.OK) {

                    if (results[0].types) {

                        var check_type = false;
                        results[0].types.forEach(function (dir) {
                            if (dir == 'street_address') {
                                check_type = true;
                            }
                        });

                        if (check_type) {

                            var latitude = results[0].geometry.location.lat();
                            var longitude = results[0].geometry.location.lng();

                            if (!checkInSidePolygon(latitude, longitude)) {
                                response = {
                                    status: 'error',
                                    title: '¡Lo sentimos!',
                                    message: 'Lamentablemente, la dirección no cuenta con reparto, por favor pruebe con otra dirección o también puede optar por retirar en local',
                                    alert: 'warning'
                                };
                            } else {
                                response = {
                                    status: 'success',
                                    title: '¡Excelente!',
                                    message: 'Ud. cuenta con reparto a domicilio.',
                                    alert: 'success'
                                };
                            }
                        }
                        else {
                            response = {
                                status: 'error',
                                title: '¡Error!',
                                message: 'La dirección ingresada no esta completa o bien no esta registrada en nuestro sistema.',
                                alert: 'danger'
                            };
                        }
                    } else {
                        response = {
                            status: 'error',
                            title: '¡Error!',
                            message: 'Error al intentar procesar la dirección',
                            alert: 'danger'
                        };
                    }

                } else {
                    response = {
                        status: 'error',
                        title: '¡Error!',
                        message: 'Ingrese una direccion válida.',
                        alert: 'danger'
                    };
                }
                callback(response);
            });


        } catch (error) {
            response = {
                status: 'error',
                title: '¡Error!',
                message: 'Ingrese una direccion válida.',
                alert: 'danger'
            };
            callback(response);
        }
    }


    function checkInSidePolygon(lat, lng) {
        try {
            var point = new google.maps.LatLng(lat, lng);
            var polygon = new google.maps.Polygon({paths: getPolygon()});

            var res = google.maps.geometry.poly.containsLocation(point, polygon);
            if (res) {
                return true;
            }
            return false;
        } catch (error) {
            return false;
        }
    }

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

    function getPolygon() {
        return [
            {"lng": -70.5560486, "lat": -33.3202159},
            {"lng": -70.5498324, "lat": -33.3278548},
            {"lng": -70.5500898, "lat": -33.3308668},
            {"lng": -70.5547676, "lat": -33.3307592},
            {"lng": -70.5624065, "lat": -33.3354921},
            {"lng": -70.5625353, "lat": -33.3395794},
            {"lng": -70.5624924, "lat": -33.3410852},
            {"lng": -70.5584154, "lat": -33.3448137},
            {"lng": -70.5570421, "lat": -33.3487931},
            {"lng": -70.5509052, "lat": -33.3482553},
            {"lng": -70.5479441, "lat": -33.3629881},
            {"lng": -70.5449829, "lat": -33.362092},
            {"lng": -70.5454979, "lat": -33.3660347},
            {"lng": -70.5448542, "lat": -33.3677192},
            {"lng": -70.5465708, "lat": -33.3716258},
            {"lng": -70.5442963, "lat": -33.3746004},
            {"lng": -70.5416784, "lat": -33.3756397},
            {"lng": -70.5395756, "lat": -33.3760698},
            {"lng": -70.5386314, "lat": -33.3796176},
            {"lng": -70.5338249, "lat": -33.3848137},
            {"lng": -70.5270443, "lat": -33.3906187},
            {"lng": -70.5223665, "lat": -33.3876446},
            {"lng": -70.513998, "lat": -33.3828787},
            {"lng": -70.5059514, "lat": -33.3789726},
            {"lng": -70.5015311, "lat": -33.3789188},
            {"lng": -70.4996214, "lat": -33.3777362},
            {"lng": -70.4986987, "lat": -33.3766969},
            {"lng": -70.4988489, "lat": -33.3743675},
            {"lng": -70.4998574, "lat": -33.3745467},
            {"lng": -70.4995356, "lat": -33.3761952},
            {"lng": -70.5004368, "lat": -33.3769836},
            {"lng": -70.5017886, "lat": -33.3743854},
            {"lng": -70.499321, "lat": -33.3736866},
            {"lng": -70.4974971, "lat": -33.3741345},
            {"lng": -70.4971109, "lat": -33.3733102},
            {"lng": -70.4964028, "lat": -33.3732565},
            {"lng": -70.4935274, "lat": -33.373364},
            {"lng": -70.4935918, "lat": -33.3725218},
            {"lng": -70.4943214, "lat": -33.3705148},
            {"lng": -70.4934416, "lat": -33.3695113},
            {"lng": -70.4919825, "lat": -33.3690632},
            {"lng": -70.4918966, "lat": -33.368436},
            {"lng": -70.4958449, "lat": -33.3674683},
            {"lng": -70.5001578, "lat": -33.3685973},
            {"lng": -70.5005441, "lat": -33.3682748},
            {"lng": -70.4969821, "lat": -33.3661064},
            {"lng": -70.4931197, "lat": -33.3631852},
            {"lng": -70.4928837, "lat": -33.3622354},
            {"lng": -70.493742, "lat": -33.3617156},
            {"lng": -70.4967461, "lat": -33.3615185},
            {"lng": -70.4986558, "lat": -33.3622354},
            {"lng": -70.5015955, "lat": -33.3610167},
            {"lng": -70.5033121, "lat": -33.3608733},
            {"lng": -70.5049429, "lat": -33.3613034},
            {"lng": -70.5074105, "lat": -33.3540806},
            {"lng": -70.507153, "lat": -33.3534712},
            {"lng": -70.5057583, "lat": -33.3521449},
            {"lng": -70.5062518, "lat": -33.3513562},
            {"lng": -70.5025182, "lat": -33.3521986},
            {"lng": -70.5021534, "lat": -33.3528977},
            {"lng": -70.5010805, "lat": -33.3530231},
            {"lng": -70.5011234, "lat": -33.3521269},
            {"lng": -70.4989115, "lat": -33.3510203},
            {"lng": -70.5003706, "lat": -33.3469694},
            {"lng": -70.4954522, "lat": -33.3458883},
            {"lng": -70.4906457, "lat": -33.3420164},
            {"lng": -70.4976838, "lat": -33.3289654},
            {"lng": -70.51073, "lat": -33.3256665},
            {"lng": -70.5199997, "lat": -33.3250928},
            {"lng": -70.5212014, "lat": -33.3314037},
            {"lng": -70.5260079, "lat": -33.3302563},
            {"lng": -70.5332177, "lat": -33.3292523},
            {"lng": -70.5373375, "lat": -33.3303997},
            {"lng": -70.5407708, "lat": -33.3296826},
            {"lng": -70.5402558, "lat": -33.326814},
            {"lng": -70.5414574, "lat": -33.3217937},
            {"lng": -70.5443757, "lat": -33.3177773},
            {"lng": -70.5486672, "lat": -33.3176339},
            {"lng": -70.5560486, "lat": -33.3202159}]
    }

</script>

<script>
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

@yield('scripts')

@include('frontend.carta._script-products')

</body>
</html>