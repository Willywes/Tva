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
                        <div class="card-body p-3 py-md-4 px-md-4">
                            <table class="table table-borderless table-cart" cellspacing="2">
                                <thead>
                                <tr>
                                    <th colspan="2" class="text-center">Producto</th>
                                    <th class="text-center">Precio</th>
                                    <th class="text-center">Cantidad</th>
                                    <th class="text-center">Subtotal</th>
                                    <th class="text-center">Quitar</th>
                                </tr>
                                </thead>
                                <tbody id="cart-list"></tbody>
                            </table>

                            <table class="table table-borderless table-cart">
                                <thead>
                                <tr>
                                    {{--<th style="width: 25%">--}}
                                        {{--<div class="custom-control custom-checkbox mb-2">--}}
                                            {{--<input type="checkbox" class="custom-control-input send wasabi"--}}
                                                   {{--id="wasabi2"--}}
                                                   {{--name="wasabi" {{ $cart->wasabi == true ? 'checked': '' }}>--}}
                                            {{--<label class="custom-control-label" for="wasabi2">Wasabi</label>--}}
                                        {{--</div>--}}
                                    {{--</th>--}}
                                    {{--<th style="width: 25%">--}}
                                        {{--<div class="custom-control custom-checkbox mb-2">--}}
                                            {{--<input type="checkbox" class="custom-control-input send ginger"--}}
                                                   {{--id="ginger2"--}}
                                                   {{--name="ginger" {{ $cart->ginger == true ? 'checked': '' }}>--}}
                                            {{--<label class="custom-control-label" for="ginger2">Jengibre</label>--}}
                                        {{--</div>--}}
                                    {{--</th>--}}
                                    {{--<th style="width: 25%">--}}
                                        {{--<div class="row">--}}
                                            {{--<div class="col-md-6">--}}
                                                {{--<div class="custom-control custom-checkbox mb-2">--}}
                                                    {{--<input type="checkbox" class="custom-control-input send sticks"--}}
                                                           {{--id="sticks2"--}}
                                                           {{--name="sticks" {{ $cart->sticks == true ? 'checked': '' }}>--}}
                                                    {{--<label class="custom-control-label" for="sticks2">Palitos</label>--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                            {{--<div class="col-md-6">--}}
                                                {{--<div class="number-input" id="palitosCounter">--}}
                                                    {{--<div class="number-input">--}}
                                                        {{--<button type="button"--}}
                                                                {{--onclick="oneLessCart(this.parentNode.querySelector('input[type=number]'))">--}}
                                                            {{-----}}
                                                        {{--</button>--}}
                                                        {{--<input class="quantity sticks_quantity" min="1" name="sticks_quantity"--}}
                                                               {{--value="{{ $cart->sticks_quantity }}" type="number">--}}
                                                        {{--<button type="button"--}}
                                                                {{--onclick="oneMoreCart(this.parentNode.querySelector('input[type=number]'))"--}}
                                                                {{--class="plus">+--}}
                                                        {{--</button>--}}
                                                    {{--</div>--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--</th>--}}
                                    <th colspan="3" style="background:white;"></th>

                                    <th colsp="4" style="width: 25%; padding: 0px;" class="bold font-20">
                                        <div style="background: #bc2d27; color: white;  border-radius: 3px; padding: 13px;">
                                            $<span class="right totals">{{  number_format($cart->totals, 0, ',', '.')  }}</span>
                                        </div>
                                    </th>
                                </tr>
                                </thead>
                            </table>
                            <div class="row">
                                <div class="col-md-12 px-4">
                                    <div class="form-group">
                                        <label for="comments">Comentarios Adicionales</label>
                                        <textarea id="comments" name="comments" class="form-control">{{$cart->comments}}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 pt-3 text-center mt-4">
                                    <button type="button" onclick="location.href = '{{route('init')}}'"
                                            class="left btn btn-lg main-bg p-0 text-white">
                                        <div class="left text-left text-button px-3 py-2">
                                            Volver al inicio
                                        </div>
                                        <div class="right icon-button px-3 py-2 ">
                                            <i class="fas fa-home"></i>
                                        </div>
                                    </button>

                                    <button type="button" onclick="location.href = '{{route('order.select-delivery')}}'"
                                            class="right btn btn-lg main-bg p-0 text-white">
                                        <div class="left text-left text-button px-3 py-2">
                                            Finalizar pedido
                                        </div>
                                        <div class="right icon-button px-3 py-2 ">
                                            <i class="fas fa-check"></i>
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