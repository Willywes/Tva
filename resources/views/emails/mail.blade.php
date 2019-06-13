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
             src=""
             {{--src="/tva/images/logo-negro.svg"--}}
             alt="">
    </div>

    <div class="card mb-4 mt-2" style="border-top: 5px solid #bb2f26;">
        <div class="card-body">

            <h4 class="text-center">Resumen pedido Nº {{ $order->id }}</h4>
            <h5 class="text-muted text-center">{{ date('d-m-Y H:i', strtotime($order->created_at)) }}</h5>

            <hr/>
            <h5 class="text-center"><strong>Detalle</strong></h5>
            <hr>
            <table class="table table-sm table-bordered">
                <tbody>
                <tr>
                    <td style="width: 30%">
                        <strong>Nombre Cliente</strong>
                    </td>
                    <td colspan="3">
                        {{ $order->customer->fullname }}
                    </td>
                </tr>
                <tr>
                    <td style="width: 30%">
                        <strong>Email</strong>
                    </td>
                    <td colspan="3">
                        {{ $order->customer->email }}
                    </td>
                </tr>
                <tr>
                    <td style="width: 30%">
                        <strong>Teléfono</strong>
                    </td>
                    <td colspan="3">
                        {{ $order->customer->phone }}
                    </td>
                </tr>
                @if($order->order_type_id == 2000)
                    <tr>
                        <td style="width: 30%">
                            <strong>Tipo Pedido</strong>
                        </td>
                        <td colspan="3">
                            {{ $order->order_type->name }} - {{  $order->address ? $order->address->address : ''}}
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 30%">
                            <strong>Forma de Pago</strong>
                        </td>
                        <td colspan="3">
                            {{ $order->payment }}
                        </td>
                    </tr>
                @else
                    <tr>
                        <td style="width: 30%">
                            <strong>Tipo Pedido</strong>
                        </td>
                        <td colspan="3">
                            {{ $order->order_type->name }}
                        </td>
                    </tr>
                @endif

                <tr>
                    <td style="width: 30%">
                        <strong>Adicional</strong>
                    </td>
                    <td colspan="3">
                        <div><strong>Wasabi</strong> {{ $order->wasabi ? 'SI' : 'NO' }} ,
                            <strong>Gengibre</strong> {{ $order->ginger ? 'SI' : 'NO' }},
                            <strong>Palitos</strong> {{ $order->sticks ? $order->sticks_quantity : 'NO'}}</div>
                    </td>
                </tr>

                <tr>
                    <td style="width: 30%">
                        <strong>Comentarios</strong>
                    </td>
                    <td colspan="3">
                        {{ $order->comments }}
                    </td>
                </tr>
                </tbody>
            </table>
            <hr/>
            <h5 class="text-center"><strong>Productos</strong></h5>
            <hr>
            <table class="table table-sm table-bordered">
                <thead>
                <tr class="text-center bg-danger" style="color:white;">
                    <th>Producto</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Subtotal</th>
                </tr>
                </thead>
                <tbody>
                @foreach($order->items as $item)
                    <tr>
                        <td>
                            {{ $item->product->name }}
                            {!! $item->extra_description ?? '' !!}
                        </td>
                        @php
                         $price = $item->price + $item->extra_price ?? 0;
                        @endphp
                        <td class="text-right">${{ number_format($price, 0 ,',','.') }}</td>
                        <td class="text-center">{{ $item->quantity }}</td>
                        <td class="text-right">${{ number_format($item->subtotal, 0 ,',','.') }}</td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="2" rowspan="3"></td>
                    <td><strong>Subtotal</strong></td>
                    <td class="text-right">${{ number_format($order->subtotal, 0 ,',','.') }}</td>
                </tr>
                <tr>
                    <td><strong>Despacho</strong></td>
                    <td class="text-right">{{ $order->dispatch_amount ? '$ '. number_format($order->dispatch_amount, 0 ,',','.') : 'Sin Despacho' }}</td>
                </tr>
                <tr>
                    <td><strong>Total</strong></td>
                    <td class="text-right"><strong>${{ number_format($order->total, 0 ,',','.') }}</strong></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="card w-100 mb-4">
        <div class="card-body">
            <h4 class="text-center">Gracias por preferir TVA.</h4>
            <br>
            <div class="text-center text-red"><a target="_blank" class="text-red" href="/">TVA</a></div>
            <div class="text-center text-red">Padre Alfredo Arteaga Barros 1929, Lo Barnechea, Región Metropolitana
            </div>
            <div class="text-center text-red mb-4">Teléfono Pedidos <strong><a target="_blank" href="tel:+56222163171">2 2216
                        3171</a></strong></div>
        </div>
    </div>

</div>

</body>
</html>