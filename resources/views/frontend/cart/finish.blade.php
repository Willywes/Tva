@extends('frontend.template.base')

@section('content')

    <section>
        <div class="container" id="carrito" style="margin-top: 140px;">
            <div class="row">
                <div class="col-md-12 text-center mb-3">
                    <h3 class="main-color">Finalizar Pedido</h3>
                </div>
                <div class="col-md-12">

                    <div class="card card-awesome">
                        <div class="card-body p-3 py-md-4 px-md-5">
                            <div class="row" style="padding: 20px 10px; ">

                                @if($order->order_type_id == 1000)
                                    {{--LOCAL--}}
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <h4 class="main-color mb-3">Retiro en local</h4>
                                                <div>Hemos registrado tu pedidpo por <span
                                                            class="semibold">$ {{ number_format($order->total, 0,',','.') }}</span></div>
                                                <div class="semibold"> Tú número de pedido es : {{ $order->id }}</div>
                                                <div class="mt-3 main-color">
                                                    <div style="width: 60px; float: left;">
                                                        <i class="far fa-clock fa-3x mr-3"></i>
                                                    </div>
                                                    <div>
                                                        Tu pedido estará listo en <br>
                                                        <span class="semibold">20 min. aprox.</span>
                                                    </div>
                                                </div>

                                                <div class="mt-3 main-color">
                                                    <div style="width: 60px; float: left;">
                                                        <i class="fas fa-map-marker-alt fa-3x mr-3"></i>
                                                    </div>
                                                    <div>
                                                        Te esperamos en <br>
                                                        <span class="">
                                                        <a target="_blank" class="link-finish"
                                                           href="https://www.google.com/maps?q=duoc+vi%C3%B1a&rlz=1C5CHFA_enCL803CL803&um=1&ie=UTF-8&sa=X&ved=0ahUKEwjL4fXNyeXiAhVdILkGHcYfAzsQ_AUIECgB"> Santiago, Región Metropolitana</a>
                                                    </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 text-center">
                                                <div class="bg-secondary text-white p-2 mb-2 semibold font-28"
                                                     style="background: darkslategrey; border-radius: 4px;">
                                                    Total $ {{ number_format($order->total, 0,',','.') }} <i class="fas fa-check"></i>
                                                </div>
                                                <div>Puedes cancelar con efectivo o</div>
                                                <div>
                                                    <img src="/tva/images/redcompra-full.png" width="100%">
                                                </div>
                                            </div>
                                        </div>
                                    </div>



                                @elseif($order->order_type_id == 2000)
                                    {{--DELIVERY--}}
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <h4 class="main-color mb-3">Despacho a domicilio</h4>
                                                <div>Hemos registrado tu pedidpo por <span
                                                            class="semibold">$ {{ number_format($order->total, 0,',','.') }}</span></div>
                                                <div class="semibold"> Tú número de pedido es : {{ $order->id }}</div>
                                                <div class="mt-3 main-color">
                                                    <div style="width: 60px; float: left;">
                                                        <i class="far fa-clock fa-3x mr-3"></i>
                                                    </div>
                                                    <div>
                                                        recibirás tu pedido en <br>
                                                        <span class="semibold">40 min. aprox.</span>
                                                    </div>
                                                </div>

                                                <div class="mt-3 main-color">
                                                    <div style="width: 60px; float: left;">
                                                        <i class="fas fa-map-marker-alt fa-3x mr-3"></i>
                                                    </div>
                                                    <div>
                                                        Dirección de entrega <br>
                                                        <span class="">
                                                         {{ $order->address->address }}
                                                    </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 text-center">
                                                <div class="bg-secondary text-white p-2 mb-2 semibold font-28"
                                                     style="background: darkslategrey; border-radius: 4px;">
                                                    Total $ {{ number_format($order->total, 0,',','.') }} <i class="fas fa-check"></i>
                                                </div>
                                                <div>Forma de Pago : <span class="semibold">{{ $order->payment }}</span></div>

                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <div class="col-md-12 text-center mt-3">
                                    <button type="button" onclick="location.href = '{{route('init')}}'"
                                            class="btn btn-lg main-bg p-0 text-white">
                                        <div class="left text-left text-button px-3 py-2">
                                            Volver al inicio
                                        </div>
                                        <div class="right icon-button px-3 py-2 ">
                                            <i class="fas fa-home"></i>
                                        </div>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('styles')

@endsection

@section('scripts')

@endsection