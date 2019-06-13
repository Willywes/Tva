@extends('frontend.template.base')

@section('content')

    <section>
        <div class="container" id="carrito" style="margin-top: 140px;">
            <div class="row">
                <div class="col-md-12 text-center mb-3">
                    <h3 class="main-color">Finalizar Pedido</h3>
                </div>
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-10 offset-1">
                            <div class="row">
                                <div class="col-md-12 red-banner">
                                    <div class="p-2 font-18 semibold text-center">
                                        Bienvenido, {{ auth()->guard('customer')->user()->fullname }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card card-awesome">
                        <div class="card-body p-3 py-md-4 px-md-5">
                            <div class="row">
                                <div class="col-4 offset-md-4 text-center">
                                    <div style=" height:55px; background: darkslategrey; color: white;  border-radius: 3px; padding: 13px;">
                                        <h3 class="thin">Total : <span
                                                    class="semibold">${{  number_format($cart->total, 0, ',', '.')  }}</span>
                                        </h3>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4 offset-md-4 text-center">
                                    {{--<p class="py-3">Para finalizar, elige entre estas opciones.</p>--}}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4 offset-md-4 mt-5">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <form action="{{ route('order.dispatch-delivery') }}" method="POST">
                                                <input type="hidden" name="type" value="{{ encrypt(1000) }}">
                                                @csrf()
                                                <button style="" class="btn btn-block btn-lg main-bg p-0 text-white">
                                                    <div class="left text-left text-button px-3 py-1">
                                                        Retirar <br>
                                                        <span class="semibold">en tienda</span>
                                                    </div>
                                                    <div class="right icon-button font-40"
                                                         style="padding: 5px 23px!important;">
                                                        <i class="fas fa-store-alt"></i>
                                                    </div>
                                                </button>
                                            </form>
                                        </div>

                                        {{--<div class="col-md-6">--}}
                                            {{--<form action="{{ route('order.dispatch-delivery') }}" method="POST">--}}
                                                {{--@csrf()--}}
                                                {{--<input type="hidden" name="type" value="{{ encrypt(2000) }}">--}}
                                                {{--<button style=" float: right;"--}}
                                                        {{--class="btn btn-block btn-lg main-bg p-0 text-white">--}}
                                                    {{--<div class="left text-left text-button px-3 py-1">--}}
                                                        {{--Entrega a <br>--}}
                                                        {{--<span class="semibold">domicilio</span>--}}
                                                    {{--</div>--}}
                                                    {{--<div class="right icon-button font-40"--}}
                                                         {{--style="padding: 5px 23px!important;">--}}
                                                        {{--<i class="fas fa-motorcycle"></i>--}}
                                                    {{--</div>--}}
                                                {{--</button>--}}
                                            {{--</form>--}}

                                        {{--</div>--}}
                                    </div>
                                </div>
                                <div class="col-md-12 mt-4 text-center">
                                    <button type="button" onclick="location.href = '{{route('init')}}'"
                                            class="left btn btn-lg main-bg p-0 text-white">
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