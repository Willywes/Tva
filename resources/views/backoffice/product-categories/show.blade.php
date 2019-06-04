@extends('template.base')

@section('content-title', $view_title)

@section('content-subtitle', $view_show)

@section('breadcrumb')
    <li><a href="{{ route($route . 'index') }}">{{ $view_title }}</a></li>
    <li class="active">{{ $view_show }}</li>
@endsection

@section('content')

    <div class="row">

        <div class="col-md-9">

            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ $view_show }}</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <ul class="list-group">
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-md-3">
                                    <strong>Nombre</strong>
                                </div>
                                <div class="col-md-9">
                                    {{ $brand->name }}
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-md-3">
                                    <strong>Descripción</strong>
                                </div>
                                <div class="col-md-9">
                                    {{ $brand->description }}
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-md-3">
                                    <strong>Estado</strong>
                                </div>
                                <div class="col-md-9">
                                    {{ $brand->status == 1 ? 'Activada':'Desactivada' }}
                                </div>
                            </div>
                        </li>
                    </ul>

                    <div class="row" style="margin-top: 15px;">
                        <div class="col-md-6" >
                            <a href="{{  route( $route . 'index') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Atrás</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')


@endsection

@section('scripts')


@endsection
