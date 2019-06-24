@extends('frontend.template.base')

@section('content')
    <section>
        <div class="container" id="pedidos">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-awesome">
                        <div class="card-body p-3 py-md-4 px-md-4">
                            <div class="row">
                                <div class="col-md-12">

                                    <button type="button" onclick="window.location='{{ route('init') }}'"
                                            class="btn  text-red m-0 mt-0 right">
                                        <i class="fas fa-times"></i> Salir
                                    </button>

                                    <h3 class="card-title text-center ml-2">Mis últimos pedidos</h3>

                                </div>
                                <div class="col-md-12 pt-4">
                                    <table class="table table-borderless table-cart">
                                        <thead>
                                        <tr>
                                            <th>FECHA</th>
                                            <!--th>ADIC.</th-->
                                            <th>PRODUCTOS</th>
                                            <th>TOTAL</th>
                                            <th>Tipo</th>
                                            <th>Repetir</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($orders as $order)
                                            <tr>
                                                <td style="white-space: nowrap; width: 1%; vertical-align: middle; ">
                                                    {{ date('d-m-Y', strtotime($order->created_at)) }}<br>
                                                    {{ date('H:i:s', strtotime($order->created_at)) }}
                                                </td>
                                                <!--td style="white-space: nowrap; width: 1%; vertical-align: middle; ">
                                                    <div>
                                                        <div>
                                                            @if($order->wasabi)
                                                                <i class="fa fa-check text-green"></i>
                                                            @else
                                                                <i class="fa fa-times text-red"></i>
                                                            @endif
                                                            Wasabi
                                                        </div>
                                                        <div>
                                                            @if($order->ginger)
                                                                <i class="fa fa-check text-green"></i>
                                                            @else
                                                                <i class="fa fa-times text-red"></i>
                                                            @endif
                                                            Jengibre
                                                        </div>
                                                        <div>
                                                            @if($order->sticks)
                                                                <i class="fa fa-check text-green"></i> {{ $order->sticks_quantity }}
                                                                Palitos
                                                            @else
                                                                <i class="fa fa-times text-red"></i> 0 Palitos
                                                            @endif
                                                        </div>
                                                    </div>
                                                </td-->
                                                <td style="white-space: nowrap; ">
                                                    <div class="row">
                                                        @foreach($order->items as $item)
                                                            <div class="col-md-12">
                                                                <strong>{{ $item->product_id ? $item->product->name : 'Producto No Disponible'}}</strong>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </td>
                                                <td style="white-space: nowrap; width: 1%; ">
                                                    <div>
                                                        $
                                                        <span class="right">  {{ number_format($order->total, 0 ,',','.') }} </span>
                                                    </div>
                                                </td>
                                                <td>
                                                    {{ $order->order_type->name }}
                                                </td>
                                                <td>
                                                    <div style="white-space: nowrap; ">
                                                        <form action="{{ route('cart.repeat_order') }}" method="POST">
                                                            @csrf()
                                                            <input type="hidden" name="id" value="{{ $order->id }}">
                                                            <button class="btn btn-dark main-bg btn-sm"
                                                                    title="Repetir pedido ">
                                                                <i class="fas fa-retweet"></i> Repetir Pedido
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6">
                                                    <div class="text-center"> Sin pedidos registrados.</div>
                                                </td>
                                            </tr>
                                        @endforelse
                                        </tbody>
                                    </table>
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