@extends('backoffice.template.base')

@section('content-title', $view_title)

@section('content-subtitle', $view_create)

@section('breadcrumb')
    <li><a href="{{ route($route . 'index') }}">{{ $view_title }}</a></li>
    <li class="active">{{ $view_create }}</li>
@endsection

@section('content')

    <div class="row">

        <div class="col-md-12">

            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ $view_create }}</h3>

                    <div class="box-tools pull-right">
                        {{--<button type="button" class="btn btn-box-tool" data-widget="collapse">--}}
                            {{--<i class="fa fa-minus"></i>--}}
                        {{--</button>--}}
                    </div>
                </div>
                <div class="box-body">


                    <form action="{{ route($route . 'store') }}" method="POST">

                        {{ csrf_field() }}

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
                                                  placeholder="Ingrese el nombre de la categoría"
                                                  value="{{ old('name') }}">
                                           {!! $errors->first('name', '<span class="help-block">:message</span>') !!}
                                       </div>
                                   </div>
                                   <div class="col-md-6">
                                       <div class="form-group {{ $errors->has('parent') ? 'has-error':'' }}">
                                           <label for="parent">Categoría Padre (*)</label>
                                           <select class="form-control"
                                                   name="parent"
                                                   id="parent">
                                               <option value="">Sin categoría padre</option>
                                               @foreach( $product_categories as $pc)
                                                   <option value="{{ $pc->id }}">{{ $pc->name }}</option>
                                               @endforeach
                                           </select>
                                           {!! $errors->first('parent', '<span class="help-block">:message</span>') !!}
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
                                                     style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{ old('description') }}</textarea>
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
                            <div class="col-md-6" >
                                <a href="{{  route( $route . 'index') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Atrás</a>
                            </div>
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-primary" style="float: right;">{{ $btn_save }}</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')


@endsection

@section('scripts')


@endsection
