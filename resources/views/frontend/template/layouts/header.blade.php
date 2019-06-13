<section id="header">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top">
        <div class="container">
            <ul class="nav navbar-nav pull-sm-left">
                <li class="nav-item">
                    <div class="nav-link p-0 md-trigger" data-asmodal="modal-menu" style="cursor: pointer;"><img
                                src="/tva/images/ic-menu.svg"
                                alt="TVA" width=""
                                height="40"></div>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-logo mx-auto">
                <li class="nav-item">
                    <a class="nav-link p-0 logo" href="/" style="margin-right: -22px;"><img
                                src="/tva/images/tva.png" alt="TVA"
                                width="" height="50"></a>
                </li>
            </ul>
            <ul class="nav navbar-nav pull-sm-right" style="display: contents;">
                <li class="nav-item">
                    @if(auth()->guard('customer')->user())
                        <div class="dropdown">
                            <button class="btn btn-white main-color dropdown-toggle p-0" type="button"
                                    id="profileButton" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                <span class="d-none d-md-inline-block">{{ auth()->guard('customer')->user()->fullname }}</span>
                                <img class="d-inline-block d-md-none" src="/tva/images/ic-user.svg" alt="TVA" width="" height="30"
                                     style="margin-top: 4px; margin-right: 0px;">
                            </button>
                            <div class="dropdown-menu dropdown-menu-right" style="margin-top: 22px;"
                                 aria-labelledby="profileButton">
                                <a class="dropdown-item" href="{{ route('profile.my-profile') }}">
                                    <i class="fas fa-user"></i> Mi Perfil
                                </a>
                                <a class="dropdown-item" href="{{ route('profile.change-password') }}">
                                    <i class="fas fa-key"></i> Cambiar contraseña
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
                        @include('frontend.template.layouts._auth_modal')
                    @endif
                </li>
                <li class="nav-item">
                    @include('frontend.cart._mini-cart')
                </li>
            </ul>
        </div>
    </nav>

</section>