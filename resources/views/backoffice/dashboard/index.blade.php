@extends('backoffice.template.base')

@section('content-title','Hollywood Sushi')

@section('content-subtitle', 'Dashboard')

@section('breadcrumb')

@endsection

@section('content')
    <div class="row">

        @include('backoffice.template._alerts')

        <div class="col-md-12">
            @include('backoffice.template._errors')
        </div>


        <div class="col-md-12">


            <div class="row">

                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Total Clientes</span>
                            <span class="info-box-number">{{ number_format($customers_count, 0 ,',','.') }}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>

                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Total Pedidos</span>
                            <span class="info-box-number">{{ number_format($orders_count, 0 ,',','.') }}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>

                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Total Productos Vendidos</span>
                            <span class="info-box-number">{{ number_format($total_product_sales, 0 ,',','.') }}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>

                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-red"><i class="fa fa-dollar"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Total Ventas</span>
                            <span class="info-box-number">{{ number_format($total_order_count, 0 ,',','.') }}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>


            </div>

            <div class="box box-primary">
                <div class="box-body">

                </div>
            </div>
        </div>
    </div>

@endsection

@section('styles')

@endsection

@section('scripts')

@endsection
