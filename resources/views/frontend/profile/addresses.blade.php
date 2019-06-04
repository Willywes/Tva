@extends('frontend.template.base')

@section('content')
    <section>
        <div class="container" id="direcciones">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-awesome">
                        <div class="card-body p-3 py-md-4 px-md-4">
                            <div class="row">
                                <div class="col-md-12">
                                    <h3 class="card-title left ml-2">Mis Direcciones</h3>
                                    <button type="button" onclick="window.location='{{ route('init') }}'" class="btn  text-red m-0 mt-0 right">
                                        <i class="fas fa-times"></i> Salir
                                    </button>
                                </div>
                                <div class="col-md-12">
                                    <button type="button" class="btn btn-dark main-bg m-2"
                                            data-toggle="modal" data-target="#modal-new-address">
                                        <i class="fas fa-plus"></i> Nueva Dirección
                                    </button>
                                    <table class="table table-borderless table-cart">
                                        <thead>
                                        <tr>
                                            <th>NOMBRE</th>
                                            <th>DIRECCIÓN</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody class="body-addresses"></tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('frontend.profile._modal-new-address')

@endsection

@section('styles')

@endsection

@section('scripts')
    <script>
        $('#modal-new-address').on('hidden.bs.modal', function () {
            $('#new-address-name').val('');
            $('#new-address').val('');
            $('#new-address-message').html('');
        });


        $(document).ready(function () {
            runAddress();
        });

        function runAddress(){
            getAddresses(function (response) {
                renderAddresses(response);
            });
        }


    </script>

@endsection