@extends('frontend.template.base')

@section('content')

    <section>
        <div class="container" style="margin-top: 140px;">
            <div class="row">
                <div class="col-md-12 text-center mb-3">
                    <h3 class="main-color">{{ $title ?? 'Advertencia' }}</h3>
                </div>
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-10 offset-1">
                            <div class="row">
                                <div class="col-md-12 red-banner">
                                    <div class="p-2 font-18 semibold text-center">
                                        {{ $subtitle ?? 'Mensaje del Administrador.' }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card card-awesome">
                        <div class="card-body p-3 py-md-4 px-md-5">
                            <div class="row" style="padding: 40px 10px; ">
                                <div class="col-md-12 text-center">
                                    <h3 class="mb-4">{{ $message ?? 'Acción no válida.' }}</h3>
                                    <button type="button" onclick="location.href = '{{route('init')}}'"
                                            class="btn btn-lg main-bg p-0 text-white">
                                        <div class="left text-left text-button px-3 py-2">
                                            Volver al inicio
                                        </div>
                                        <div class="right icon-button px-3 py-2 ">
                                            <i class="fas fa-home"></i>
                                        </div>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('styles')

@endsection

@section('scripts')

@endsection