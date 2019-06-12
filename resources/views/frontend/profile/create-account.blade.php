@extends('frontend.template.base')

@section('content')
    <section>
        <div class="container" id="mi-perfil">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-awesome">
                        <div class="card-body p-3 py-md-4 px-md-4">
                            <div class="row">
                                <div class="col-md-12">

                                    <button type="button" onclick="window.location='{{ route('init') }}'"
                                            class="btn  text-red m-0 mt-0 right">
                                        <i class="fas fa-times"></i> Salir
                                    </button>

                                    <h3 class="card-title text-center ml-2">Nueva cuenta</h3>

                                </div>
                                <div class="col-md-12 pt-4">
                                    @if ($errors->any())
                                        <div class="alert alert-danger alert-dismissible">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                                                &times;
                                            </button>
                                            <h4><i class="icon fa fa-exclamation"></i> Error</h4>
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    @if(session()->has('success'))
                                        <div class="alert alert-success alert-dismissible">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                                                &times;
                                            </button>
                                            <h4><i class="icon fa fa-check"></i> Operación Exitosa</h4>
                                            <p>{{ session()->get('success') }}</p>
                                        </div>
                                    @endif
                                    <form action="{{ route('profile.register-account') }}" method="post">
                                        @csrf()

                                        <div class="row">
                                            <div class="col-md-8 offset-md-2">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label for="firstname">Nombres (*)</label>
                                                            <input class="form-control" type="text" name="firstname"
                                                                   id="firstname" value="{{ old('firstname') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label for="lastname">Apellidos (*)</label>
                                                            <input class="form-control" type="text" name="lastname"
                                                                   id="lastname" value="{{ old('lastname') }}">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label for="phone">Télefono (*)</label>
                                                            <input class="form-control" type="number" name="phone"
                                                                   id="phone" value="{{ old('phone') }}">
                                                            <small id="emailHelp" class="form-text text-muted">Ingrese los 9 digitos</small>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label for="email">Email (*)</label>
                                                            <input class="form-control" type="email" name="email"
                                                                   id="email"  value="{{ old('email') }}">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="password">Contraseña (*)</label>
                                                            <input class="form-control" type="password" name="password"
                                                                   id="password">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="password_confirmation">Confirme Contraseña
                                                                (*)</label>
                                                            <input class="form-control" type="password"
                                                                   name="password_confirmation"
                                                                   id="password_confirmation">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-12 text-center mt-4">
                                                        <button type="submit"
                                                                class="btn btn-lg main-bg p-0 text-white">
                                                            <div class="left text-left text-button px-3 py-2">
                                                                Crear Cuenta
                                                            </div>
                                                            <div class="right icon-button px-3 py-2 ">
                                                                <i class="fas fa-plus"></i>
                                                            </div>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </form>
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