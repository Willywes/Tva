@extends('backoffice.template.base')

@section('content-title', $view_title)

@section('content-subtitle', $view_edit)

@section('breadcrumb')
    <li><a href="{{ route($route . 'index') }}">{{ $view_title }}</a></li>
    <li class="active">{{ $view_edit }}</li>
@endsection

@section('content')

    <div class="row">

        <div class="col-md-12">

            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ $view_edit }}</h3>

                    <div class="box-tools pull-right">
                        {{--<button type="button" class="btn btn-box-tool" data-widget="collapse">--}}
                        {{--<i class="fa fa-minus"></i>--}}
                        {{--</button>--}}
                    </div>
                </div>
                <div class="box-body">

                    <form action="{{ route($route . 'update', ['brand' => encrypt($product->id)]) }}"
                          method="POST">

                        {{ csrf_field() }}

                        <input type="hidden" name="_method" value="PUT">

                        <div class="row">
                            <div class="col-md-12">
                                @include('backoffice.template._errors')
                            </div>
                        </div>

                        <div class="row">
                            {{--<div class="col-md-3">--}}
                            {{--</div>--}}

                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->has('name') ? 'has-error':'' }}">
                                            <label for="name">Nombre (*)</label>
                                            <input required type="text"
                                                   class="form-control"
                                                   id="name"
                                                   name="name"
                                                   placeholder="Ingrese el nombre del producto"
                                                   value="{{ old('name') ?? $product->name }}">
                                            {!! $errors->first('name', '<span class="help-block">:message</span>') !!}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->has('slug') ? 'has-error':'' }}">
                                            <label for="slug">Slug (*)</label>
                                            <input required type="text"
                                                   class="form-control"
                                                   id="slug"
                                                   name="slug"
                                                   placeholder="Ingrese el nombre del producto"
                                                   value="{{ old('name') ?? $product->slug }}">
                                            {!! $errors->first('name', '<span class="help-block">:message</span>') !!}
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->has('price') ? 'has-error':'' }}">
                                            <label for="price">Precio de Producto</label>
                                            <input required type="numeric"
                                                   class="form-control"
                                                   id="price"
                                                   name="price"
                                                   placeholder="Ingrese el precio del producto"
                                                   value="{{ old('price') ?? $product->price }}">
                                            {!! $errors->first('price', '<span class="help-block">:message</span>') !!}
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->has('offer_price') ? 'has-error':'' }}">
                                            <label for="offer_price">Precio Oferta</label>
                                            <input type="numeric"
                                                   class="form-control"
                                                   id="offer_price"
                                                   name="offer_price"
                                                   placeholder="Ingrese el precio oferta del producto"
                                                   value="{{ old('offer_price') ?? $product->offer_price }}">
                                            {!! $errors->first('offer_price', '<span class="help-block">:message</span>') !!}
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->has('product_category_id') ? 'has-error':'' }}">
                                            <label for="product_category_id">Categoría</label>
                                            <select class="form-control"
                                                    name="product_category_id"
                                                    id="product_category_id">
                                                <option value="">Sin categoría </option>
                                                @foreach( $product_category as $pc)
                                                    <option value="{{ $pc->id }}" {{ $product->product_category_id == $pc->id ? 'selected' : '' }}>{{ $pc->name }}</option>
                                                @endforeach
                                            </select>
                                            {!! $errors->first('product_category_id', '<span class="help-block">:message</span>') !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group {{ $errors->has('description') ? 'has-error':'' }}">
                                            <label class="control-label" for="description">Descripción</label>
                                            <textarea class="textarea"
                                                      placeholder="Ingrese una descripción de la marca"
                                                      name="description"
                                                      id="description"
                                                      style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{!! old('description') ?? $product->description !!} </textarea>
                                            {!! $errors->first('description', '<span class="help-block">:message</span>') !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12" style="font-style: italic;">
                                Los campos con (*) son obligatorios.
                            </div>
                        </div>

                        <div class="row" style="margin-top: 15px;">
                            <div class="col-md-6">
                                <a href="{{  route( $route . 'index') }}" class="btn btn-primary"><i
                                            class="fa fa-arrow-left"></i> Atrás</a>
                            </div>
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-primary" style="float: right;"> {{ $btn_update }}
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')

    <link rel="stylesheet" href="/back-office/assets/plugins/bootstrap3-wysihtml5/bootstrap3-wysihtml5.min.css">

@endsection

@section('scripts')

    <script src="/back-office/assets/plugins/bootstrap3-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
    <script>
        $(function () {
            $('.textarea').wysihtml5()
        });

        $('#name').keyup(function () {
            $('#slug').val(string_to_slug($('#name').val()))
        });
    </script>
@endsection
