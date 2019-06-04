<section id="header">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top">
        <div class="container">
            <ul class="nav navbar-nav pull-sm-left">
                <li class="nav-item">
                    <div class="nav-link p-0 md-trigger" data-asmodal="modal-menu" style="cursor: pointer;"><img
                                src="/hsushi/images/ic-menu.svg"
                                alt="Hollywood Sushi" width=""
                                height="40"></div>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-logo mx-auto">
                <li class="nav-item">
                    <a class="nav-link p-0" href="/" style="margin-right: -22px;"><img
                                src="/hsushi/images/logo-negro.svg" alt="Hollywood Sushi"
                                width="" height="50"></a>
                </li>
            </ul>
            <ul class="nav navbar-nav pull-sm-right" style="display: contents;">
                <li class="nav-item">
                    @if(auth()->guard('customer')->user())
                        <div class="dropdown">
                            <button class="btn btn-white main-color dropdown-toggle" type="button"
                                    id="profileButton" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                {{ auth()->guard('customer')->user()->fullname }}
                            </button>
                            <div class="dropdown-menu dropdown-menu-right" style="margin-top: 16px;"
                                 aria-labelledby="profileButton">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user"></i> Mi Perfil
                                </a>
                                <a class="dropdown-item" href="{{ route('profile.addresses') }}">
                                    <i class="fas fa-address-book"></i>
                                    Mis direcciones
                                </a>
                                <a class="dropdown-item" href="{{ route('profile.orders') }}">
                                    <i class="fas fa-list-ul"></i>
                                    Mis pedidos
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('logout') }}"><i
                                            class="fas fa-sign-out-alt"></i> Salir</a>
                            </div>
                        </div>
                    @else
                        <button type="button" class="btn btn-link p-0" data-asmodal="modal-login"
                                style="cursor: pointer;">
                            <img src="/hsushi/images/ic-user.svg" alt="Hollywood Sushi" width="" height="30"
                                 style="margin-top: 4px; margin-right: 12px;">
                        </button>


                        <!-- Modal -->
                        <div id="modal-login" class="as-modal">
                            <div class="close-as-modal"><i class="fas fa-times"></i></div>
                            <div class="as-modal-content">
                                <h3 class="light text-center">Inicia tu sesión</h3>
                                <div class="as-modal-body ">
                                    <form action="{{ route('login') }}" method="POST">
                                        @csrf()
                                        <div class="row">
                                            <div class="col-md-10 offset-1">
                                                <div class="form-group">
                                                    <label for="email"><i class="far fa-envelope"></i> Email</label>
                                                    <input type="text" class="form-control" name="email" required>
                                                </div>
                                            </div>
                                            <div class="col-md-10 offset-1">
                                                <div class="form-group">
                                                    <label for="password"><i class="fas fa-key"></i>
                                                        Contraseña</label>
                                                    <input type="password" class="form-control" name="password"
                                                           required>
                                                </div>
                                            </div>
                                            <div class="col-md-10 offset-1 mt-4 text-center">
                                                <button type="submit" class="btn btn-lg main-bg p-0 btn-modal bold">
                                                    <div class="left text-left text-button px-3 py-2">
                                                        Iniciar Sesión
                                                    </div>
                                                    <div class="right icon-button px-3 py-2"
                                                         style="background: #ddd;">
                                                        <i class="fas fa-chevron-right"></i>
                                                    </div>
                                                </button>
                                            </div>
                                            <div class="col-md-10 offset-1 mt-5">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="left text-white">
                                                            ¿Olvidaste tu contraseña?<br>
                                                            <span class="semibold">Recuperala AQUÍ</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="text-right text-white">
                                                            ¿No estas registrado?<br>
                                                            <span class="semibold">Registrate AQUÍ</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endif
                </li>
                <li class="nav-item">
                    @include('frontend.cart._mini-cart')
                </li>
            </ul>
        </div>
    </nav>

</section>