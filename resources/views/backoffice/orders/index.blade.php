@extends('backoffice.template.base')

@section('content-title', $view_title)

@section('content-subtitle', $view_index)

@section('breadcrumb')
    <li><a href="{{ route($route . 'index') }}">{{ $view_title }}</a></li>
    <li class="active">{{ $view_index }}</li>
@endsection

@section('content')
    <div class="row">

        @include('backoffice.template._alerts')

        <div class="col-md-12">
            @include('backoffice.template._errors')
        </div>

        <div class="col-md-12">

            <div class="box box-primary">
                <div class="box-body">
                    <div id="toolbar" class="">
                        {{--<a href="{{ route($route . 'create') }}" class="btn btn-success"><i--}}
                        {{--class="fa fa-plus"></i> {{ $btn_new }}--}}
                        {{--</a>--}}

                        {{--<button type="button" class="btn btn-info" data-toggle="modal" data-target="#orderBy"><i--}}
                        {{--class="fa fa-retweet"></i> {{ $order }}--}}
                        {{--</button>--}}
                    </div>

                    <table
                            id="table"
                            data-toggle="table"
                            data-search="true"
                            data-pagination="true"
                            data-striped="true"
                            data-show-refresh="true"
                            data-show-toggle="false"
                            data-show-columns="true"
                            data-show-export="false"
                            data-detail-view="false"
                            data-detail-formatter="detailFormatter"
                            data-minimum-count-columns="2"
                            data-show-pagination-switch="true"
                            data-id-field="id"
                            data-page-list="[5, 10, 20, 50, 100, 200]"
                            data-toolbar="#toolbar">
                        <thead>
                        <tr>
                            <th data-cell-style="cellStyle" data-sortable="true">Nº</th>
                            <th data-cell-style="cellStyle" data-sortable="true">Fecha</th>
                            <th data-cell-style="midAling" data-sortable="true">Cliente - Comentarios</th>
                            <th data-cell-style="cellStyle" data-sortable="true">Adicionales</th>
                            <th data-cell-style="cellStyle" data-sortable="true">Delivery</th>
                            <th data-cell-style="cellStyle" data-sortable="true">Estado</th>
                            <th data-cell-style="cellStyle" data-sortable="true">Total</th>
                            <th data-cell-style="cellStyle" data-sortable="true">Detalle</th>
                            <th data-cell-style="cellStyle" data-sortable="true"></th>


                        </tr>
                        </thead>
                        <tbody>

                        @foreach($orders as $object)
                            <tr>
                                <td>
                                    {{ $object->id }}
                                </td>
                                <td>
                                    {{ date('d-m-Y', strtotime($object->created_at)) }}
                                    <br>
                                    {{ date('H:i:s', strtotime($object->created_at)) }}
                                </td>
                                <td>
                                    {{ $object->customer->fullname }}<br>
                                    <div>
                                        <strong>Commentarios</strong> - {{ $object->comments ?? 'Sin comentarios.' }}
                                    </div>

                                </td>

                                <td>
                                    <div>
                                        <div>
                                            @if($object->wasabi)
                                                <i class="fa fa-check text-green"></i>
                                            @else
                                                <i class="fa fa-times text-red"></i>
                                            @endif
                                            Wasabi
                                        </div>
                                        <div>
                                            @if($object->ginger)
                                                <i class="fa fa-check text-green"></i>
                                            @else
                                                <i class="fa fa-times text-red"></i>
                                            @endif
                                            Jengibre
                                        </div>
                                        <div>
                                            @if($object->sticks)
                                                <i class="fa fa-check text-green"></i> {{ $object->sticks_quantity }}
                                                Palitos
                                            @else
                                                <i class="fa fa-times text-red"></i> 0 Palitos
                                            @endif
                                        </div>
                                    </div>
                                <td>
                                    @if($object->order_type_id == 1000)
                                        <span class="badge bg-awesome bg-blue">
                                            <i class="fa fa-home"></i> Retiro Local
                                        </span>
                                    @else
                                        <span class="badge bg-awesome bg-red">
                                            <i class="fa fa-motorcycle"></i> A Domicilio
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge bg-awesome"
                                          style="color:{{$object->order_status->color}}; background: {{$object->order_status->background}}">
                                        {{ $object->order_status->name }}
                                    </span>
                                </td>
                                <td>
                                    <span class="right">
                                        {{ '$ ' .  number_format($object->total, 0, ',', '.') }}
                                    </span>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                            data-target="#modal-detail-{{ $object->id }}"><i class="fa fa-eye"></i> Ver
                                    </button>

                                    <div id="modal-detail-{{ $object->id }}" class="modal fade" role="dialog">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;
                                                    </button>
                                                    <h4 class="modal-title">Detalle del Pedido Nº {{ $object->id }}</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <table class="table table-bordered">
                                                        <thead>
                                                        <tr>
                                                            <th style="width: 30%;">Producto</th>
                                                            <th>Precio</th>
                                                            <th>Cantidad</th>
                                                            <th>Subtotal</th>
                                                        </tr>
                                                        </thead>

                                                        <tbody>
                                                        @foreach($object->items as $item)

                                                            <tr>
                                                                <td style="width: 30%; max-width: 30%; word-break: normal;">
                                                                    <h5>{{ $item->product_id ?? $item->product_id }}</h5>
                                                                    {{--<div class="font-10">--}}
                                                                    {{--{{ $item->product->description }}--}}
                                                                    {{--</div>--}}
                                                                </td>
                                                                <td>
                                                                    $<span class="pull-right">{{  number_format($item->price, 0, ',', '.')  }}
                                                                </td>
                                                                <td class="text-center">{{ $item->quantity }}</td>
                                                                <td>
                                                                    $<span class="right">{{  number_format($item->subtotal, 0, ',', '.')  }}
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>

                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </td>
                                <td>

                                    @if($object->status == 1)
                                        <form action="{{ route('backoffice.pedidos.change-status') }}" method="post">
                                            @csrf()
                                            <input type="hidden" name="order_id" value="{{ $object->id }}">
                                            <button class="btn btn-success btn-sm" title="Marcar como Terminado"><i
                                                        class="fa fa-check"></i></button>
                                        </form>
                                    @else
                                        <form action="{{ route('backoffice.pedidos.change-status') }}" method="post">
                                            @csrf()
                                            <input type="hidden" name="order_id" value="{{ $object->id }}">
                                            <button class="btn btn-danger btn-sm" title="Marcar como nuevo"><i
                                                        class="fa fa-plus"></i></button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('styles')

    <link rel="stylesheet" href="/back-office/assets/plugins/bootstraptable/dragtable.css">
    <link rel="stylesheet" href="/back-office/assets/plugins/bootstraptable/bootstrap-table-reorder-rows.css">
    <link rel="stylesheet" href="/back-office/assets/plugins/bootstraptable/bootstrap-table-fixed-columns.css">
    <link rel="stylesheet" href="/back-office/assets/plugins/bootstraptable/bootstrap-table.min.css">
    <link rel="stylesheet" href="/back-office/assets/plugins/bootstrap-toogle/bootstrap-toggle.min.css">
    <link rel="stylesheet" href="/back-office/assets/plugins/jquery-nestable/nestable.css">

@endsection

@section('scripts')
    <script src="/back-office/assets/plugins/bootstraptable/bootstrap-table.min.js"></script>
    <script src="/back-office/assets/plugins/bootstraptable/bootstrap-table-es-ES.min.js"></script>
    <script src="/back-office/assets/plugins/bootstraptable/bootstrap-table-export.min.js"></script>
    <script src="/back-office/assets/plugins/bootstraptable/tableExport.min.js"></script>
    <script src="/back-office/assets/plugins/bootstrap-toogle/bootstrap-toggle.min.js"></script>

    <script src="/back-office/assets/plugins/jquery-nestable/jquery.nestable.js"></script>


    <script>


    </script>

@endsection
