@extends('frontend.template.base')

@section('content')

    <section>
        <div class="container" id="carrito" style="margin-top: 140px;">
            <div class="row">
                <div class="col-md-12 text-center mb-3">
                    <h3 class="main-color">Finalizar Pedido</h3>
                </div>
                <div class="col-md-12">
                    <form action="{{ route('order.load-direccion') }}" method="POST">
                        @csrf()
                        <div class="card card-awesome">
                            <div class="card-body p-3 py-md-4 px-md-5">
                                <div class="row" style="padding: 20px 10px; ">

                                    {{--dddd--}}
                                    <div class="col-md-12">
                                        <h4 class="main-color mb-3">Entrega a domicilio</h4>
                                        <div class="mb-3">Para confirmar tu pedido a domicilio porfavor completa la siguiente información</div>
                                        <div class="box-inner-pedido mb-3">
                                            <button type="button" class="btn btn-dark main-bg mb-2"
                                                    data-toggle="modal" data-target="#modal-new-address">
                                                <i class="fas fa-plus"></i> Nueva Dirección
                                            </button>
                                            <div id="direcciones"></div>
                                        </div>
                                        <div class="box-inner-pedido">
                                            <div class="custom-control custom-checkbox mb-2">
                                                <input type="radio" class="custom-control-input"
                                                       id="efectivo"
                                                       name="payment"
                                                       value="{{ encrypt('1') }}"
                                                       checked>
                                                <label class="custom-control-label" for="efectivo"> Efectivo</label>
                                            </div>

                                            <div class="custom-control custom-checkbox mb-2">
                                                <input type="radio" class="custom-control-input "
                                                       id="tarjeta"
                                                       name="payment"
                                                       value="{{ encrypt('2') }}">
                                                <label class="custom-control-label" for="tarjeta"> Tarjeta de Débito/Crédito </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12 mt-4">
                                        <button type="button" onclick="location.href = '{{route('init')}}'"
                                                class="left btn btn-lg main-bg p-0 text-white">
                                            <div class="left text-left text-button px-3 py-2">
                                                Volver al inicio
                                            </div>
                                            <div class="right icon-button px-3 py-2 ">
                                                <i class="fas fa-home"></i>
                                            </div>
                                        </button>

                                        <button type="submit"
                                                id="finalizar"
                                                disabled="disabled"
                                                class="right btn btn-lg main-bg p-0 text-white">
                                            <div class="left text-left text-button px-3 py-2">
                                                Confirmar Pedido
                                            </div>
                                            <div class="right icon-button px-3 py-2 ">
                                                <i class="fas fa-check"></i>
                                            </div>
                                        </button>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    @include('frontend.profile._modal-new-address')

@endsection

@section('styles')

@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            runAddress();
        });

        function runAddress(){
            getAddresses(function (response) {
                renderDirecciones(response);
            });
        }

        function renderDirecciones(addresses){

            if (addresses.length) {
                $('#finalizar').removeAttr('disabled');
                $('#direcciones').html('');

                addresses.forEach(function (address, index) {
                    let selected = index == 0 ? 'checked':'';
                    $('#direcciones').append($('<div class="custom-control custom-checkbox mb-2">' +
                        '<input type="radio" class="custom-control-input "' +
                        'id="address_' + address.id + '"' +
                        'name="customer_address_id"' +
                        'value="' + address.id + '" ' + selected + '>' +
                        '<label class="custom-control-label" for="address_' + address.id + '">' + address.address + '</label>' +
                        ' </div>'));
                });
            } else {
                $('#direcciones').html('');
                $('#direcciones').append($('<div>Sin direcciones registradas, por favor registre na direccion o elija retiro en local. <a href="/pedido/seleccionar-delivery"> volver</a></div>'));
            }
        }
    </script>
@endsection