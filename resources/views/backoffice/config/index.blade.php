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

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group {{ $errors->has('store_name') ? 'has-error':'' }}">
                                <label for="store_name">Nombre Tienda</label>
                                <input required type="store_name"
                                       class="form-control"
                                       id="store_name"
                                       name="store_name"
                                       placeholder="Ingrese Nombre de la Tienda"
                                       value="{{ old('store_name') ?? old('store_name') ?? $config->store_name }}">
                                {!! $errors->first('store_name', '<span class="help-block">:message</span>') !!}
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group {{ $errors->has('store_description') ? 'has-error':'' }}">
                                <label for="store_description">Descripción Tienda</label>
                                <textarea required type="store_description"
                                       class="form-control"
                                       id="store_description"
                                       name="store_description"
                                       placeholder="Ingrese Descripción de la Tienda">{{ old('store_description') ?? old('store_description') ?? $config->store_description }}</textarea>
                                {!! $errors->first('store_description', '<span class="help-block">:message</span>') !!}
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group {{ $errors->has('store_phone_one') ? 'has-error':'' }}">
                                <label for="store_phone_one">Teléfono 1</label>
                                <input required type="store_phone_one"
                                       class="form-control"
                                       id="store_phone_one"
                                       name="store_phone_one"
                                       placeholder="Ingrese Teléfono 1"
                                       value="{{ old('store_phone_one') ?? old('store_phone_one') ?? $config->store_phone_one }}">
                                {!! $errors->first('store_phone_one', '<span class="help-block">:message</span>') !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group {{ $errors->has('store_phone_two') ? 'has-error':'' }}">
                                <label for="store_phone_two">Teléfono 2</label>
                                <input required type="store_phone_two"
                                       class="form-control"
                                       id="store_phone_two"
                                       name="store_phone_two"
                                       placeholder="Ingrese Teléfono 2"
                                       value="{{ old('store_phone_two') ?? old('store_phone_two') ?? $config->store_phone_two }}">
                                {!! $errors->first('store_phone_two', '<span class="help-block">:message</span>') !!}
                            </div>
                        </div>

                    </div>


                </div>
            </div>
        </div>
    </div>

@endsection

@section('styles')

    <link rel="stylesheet" href="/back-office/assets/bootstraptable/dragtable.css">
    <link rel="stylesheet" href="/back-office/assets/bootstraptable/bootstrap-table-reorder-rows.css">
    <link rel="stylesheet" href="/back-office/assets/bootstraptable/bootstrap-table-fixed-columns.css">
    <link rel="stylesheet" href="/back-office/assets/bootstraptable/bootstrap-table.min.css">
    <link rel="stylesheet" href="/back-office/assets/bootstrap-toogle/bootstrap-toggle.min.css">

@endsection

@section('scripts')
    <script src="/back-office/assets/bootstraptable/bootstrap-table.min.js"></script>
    <script src="/back-office/assets/bootstraptable/bootstrap-table-es-ES.min.js"></script>
    <script src="/back-office/assets/bootstraptable/bootstrap-table-export.min.js"></script>
    <script src="/back-office/assets/bootstraptable/tableExport.min.js"></script>
    <script src="/back-office/assets/bootstrap-toogle/bootstrap-toggle.min.js"></script>

@endsection
