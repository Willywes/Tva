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
                        <a href="{{ route($route . 'create') }}" class="btn btn-success"><i
                                    class="fa fa-plus"></i> {{ $btn_new }}
                        </a>

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
                            <th data-cell-style="cellStyle" data-sortable="true">Foto</th>
                            <th data-cell-style="midAlign" data-sortable="true">Nombre</th>
                            <th data-cell-style="cellStyle" data-sortable="true">Precio Normal</th>
                            <th data-cell-style="cellStyle" data-sortable="true">Precio Oferta</th>
                            <th data-cell-style="cellStyle" data-sortable="true">Cant. Prod.</th>


                            @if($active)
                                <th data-cell-style="cellStyle" data-sortable="true">Estado</th>
                            @endif
                            @if($actions)
                                <th data-cell-style="cellStyle">Acciones</th>
                            @endif

                        </tr>
                        </thead>
                        <tbody>

                        @foreach($products as $object)
                            <tr>
                                <td>
                                    <div>
                                        <img src="#" alt="" width="30px">
                                    </div>
                                </td>
                                <td>{{ $object->name }}</td>
                                <td>
                                    <span class="right">
                                        {{ '$ ' .  number_format($object->price, 0, ',', '.') }}
                                    </span>
                                </td>
                                <td>
                                    <span class="right">
                                        {{ ($object->offer_price and $object->offer_price != 0) ? '$ ' .number_format($object->offer_price, 0, ',', '.') : '-' }}
                                    </span>
                                </td>

                                <td><span style="float: right;">{{ $object->product_category->name }}</span></td>

                                @include('backoffice.resources.html_status')
                                @include('backoffice.resources.html_actions')
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

    @include('backoffice.resources.script_status')
    @include('backoffice.resources.script_delete')

    <script>


    </script>

@endsection
