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

                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#orderBy"><i
                                    class="fa fa-retweet"></i> {{ $order }}
                        </button>
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
                            {{--<th data-cell-style="cellStyle" data-sortable="true">Id</th>--}}
                            {{--<th data-cell-style="cellStyle" data-sortable="true">Posición</th>--}}
                            <th data-cell-style="cellStyle" data-sortable="true">Nombre</th>
                            <th data-cell-style="midAling" data-sortable="true">Descripción</th>
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

                        @foreach($product_categories as $object)
                            <tr>
                                {{--<td>{{ $object->id }}</td>--}}
                                {{--<td><span style="float: left;">{{ $object->position }}</span></td>--}}
                                <td>{{ $object->name }}</td>
                                <td>{{ str_limit($object->description, 150, '...') }}</td>
                                <td><span style="float: right;">{{ $object->products_count }}</span></td>

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

    <!-- Modal OrderBy -->
    <div id="orderBy" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title uppercase">{{ $order }}</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="cf nestable-lists">
                                <div class="dd" id="nestable">
                                    <ol class="dd-list" id="sort_0">
                                        <li class="dd-item" data-id="1">
                                            <div class="dd-handle">Item 1</div>
                                        </li>
                                        <li class="dd-item" data-id="2">
                                            <div class="dd-handle">Item 2</div>
                                        </li>
                                        <li class="dd-item" data-id="3">
                                            <div class="dd-handle">Item 3</div>
                                            <ol class="dd-list">
                                                <li class="dd-item" data-id="4">
                                                    <div class="dd-handle">Item 4</div>
                                                </li>
                                                <li class="dd-item" data-id="5">
                                                    <div class="dd-handle">Item 5</div>
                                                    <ol class="dd-list">
                                                        <li class="dd-item" data-id="8">
                                                            <div class="dd-handle">Item 8</div>
                                                        </li>
                                                        <li class="dd-item" data-id="9">
                                                            <div class="dd-handle">Item 9</div>
                                                        </li>
                                                    </ol>
                                                </li>
                                            </ol>
                                        </li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
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

        function getNestedChildren(arr, parent) {
            var out = [];
            for (var i in arr) {
                if (arr[i].parent == parent) {
                    var top = $('#sort_'+ parent);
                    var children = getNestedChildren(arr, arr[i].id);
                    if (children.length) {
                        arr[i].children = children
                    }
                    out.push(arr[i]);
                    var item = $('<li class="dd-item" id="sort_' + arr[i].id + '" data-id="' + arr[i].id + '">\n' +
                        '<div class="dd-handle">' + arr[i].title + '</div>\n' +
                        '</li>');
                    top.append(item);
                }
            }

            return out
        }


        function renderSortable(data, top = null) {
            // var top = top  ? $('#sortable') : $(top);
            // data.forEach(function (cat) {
            //     var item = $('<li class="dd-item" id="sort_' + cat.id + '" data-id="' + cat.id + '">\n' +
            //         '<div class="dd-handle">' + cat.title + '</div>\n' +
            //         '</li>');
            //
            //     if(cat.children){
            //         renderSortable(data, '#sort_' + cat.id);
            //         var ol = $('<ol class="dd-list"></ol>');
            //         ol.append($(' <li class="dd-item" id="sort_' + cat.id + '" data-id="' + cat.id + '">\n' +
            //             '<div class="dd-handle">' + cat.title + '</div>\n' +
            //             '</li>'));
            //         item.append(ol)
            //     }
            //
            //     top.append(item);
            // });

        }

        $(document).ready(function () {
            let cats =
                    {!! json_encode($product_categories) !!}
            const catsFiltered = [];

            cats.forEach(function (cat) {
                let item = {
                    id: cat.id,
                    title: cat.name,
                    parent: cat.parent
                };
                catsFiltered.push(item);
            });
            const catsSortable = getNestedChildren(catsFiltered, 0);
            console.log(catsSortable);
            renderSortable(catsSortable);


            var updateOutput = function (e) {
                var list = e.length ? e : $(e.target),
                    output = list.data('output');
                if (window.JSON) {
                    output.val(window.JSON.stringify(list.nestable('serialize')));//, null, 2));
                    // console.log(list.nestable('serialize'));
                } else {
                    output.val('JSON browser support required for this demo.');
                }
            };

            // activate Nestable for list 1
            $('#nestable').nestable({
                group: 1
            }).on('change', updateOutput);

            // output initial serialised data
            updateOutput($('#nestable').data('output', $('#nestable-output')));


        });
    </script>

@endsection
