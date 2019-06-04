@extends('backoffice.template.base')

@section('content-title','title')

@section('content-subtitle', 'subtitle')

@section('breadcrumb')

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
                    <div id="toolbar" class="btn-group">
                        <a href="{{ route($route . 'create') }}" class="btn btn-success"><i
                                    class="fa fa-plus"></i> {{ $btn_new }}
                        </a>
                        {{--<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#modal-create">Open Modal</button>--}}
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
                            {{--<th data-field="status" data-checkbox="true"></th>--}}
                            <th data-cell-style="cellStyle" data-sortable="true">Id</th>
                            <th data-cell-style="cellStyle" data-sortable="true">Rut</th>
                            <th data-cell-style="midAling" data-sortable="true">Nombre</th>
                            <th data-cell-style="midAling" data-sortable="true">Razón Social</th>
                            <th data-cell-style="cellStyle" data-sortable="true">Email</th>
                            <th data-cell-style="cellStyle" data-sortable="true">Cant. Usu.</th>
                            <th data-cell-style="cellStyle" data-sortable="true">Estado</th>
                            <th data-cell-style="cellStyle">Acciones</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($clients as $object)
                            <tr>
                                <td>{{ $object->id }}</td>
                                <td>{{ $object->rut }}</td>
                                <td>{{ $object->name }}</td>
                                <td>{{ $object->business_name }}</td>
                                <td>{{ $object->email }}</td>
                                <td>{{ count($object->users) }}</td>
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

    <link rel="stylesheet" href="/assets/bootstraptable/dragtable.css">
    <link rel="stylesheet" href="/assets/bootstraptable/bootstrap-table-reorder-rows.css">
    <link rel="stylesheet" href="/assets/bootstraptable/bootstrap-table-fixed-columns.css">
    <link rel="stylesheet" href="/assets/bootstraptable/bootstrap-table.min.css">
    <link rel="stylesheet" href="/assets/bootstrap-toogle/bootstrap-toggle.min.css">

@endsection

@section('scripts')
    <script src="/assets/bootstraptable/bootstrap-table.min.js"></script>
    <script src="/assets/bootstraptable/bootstrap-table-es-ES.min.js"></script>
    <script src="/assets/bootstraptable/bootstrap-table-export.min.js"></script>
    <script src="/assets/bootstraptable/tableExport.min.js"></script>
    <script src="/assets/bootstrap-toogle/bootstrap-toggle.min.js"></script>


    @include('resources.script_status')
    @include('resources.script_delete')

@endsection
