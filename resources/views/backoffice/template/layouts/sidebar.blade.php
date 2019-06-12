<aside class="main-sidebar">
    <section class="sidebar">

        <div class="user-panel">
            <div class="pull-left image">
                <img src="/back-office/images/user.png" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>Administrador</p>
                {{--<a href="#"><i class="fa fa-circle text-success"></i> Online</a>--}}
            </div>
        </div>

        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">HEADER</li>
            <!-- Optionally, you can add icons to the links -->

            <li {{ (Request::is('backoffice/pedidos') ? 'class=active' : '') }} >
                <a href="{{ route('backoffice.pedidos.index') }}">
                    <i class="fa fa-file-text-o"></i>
                    <span>Pedidos</span>
                </a>
            </li>

            <!-- Catálogo -->
            <li class="treeview {{ (Request::is('backoffice/catalogo*') ? 'active' : '') }}">
                <a href="#">
                    <i class="fa fa-book"></i> <span>Catálogo</span>
                    <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
                </a>


                <ul class="treeview-menu">

                    <li class="treeview {{ (Request::is('backoffice/catalogo/categorias*') ? 'active' : '') }}">
                        <a href="#">
                            <i class="fa fa-angle-right"></i> <span>Categorías</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">

                            <li {{ (Request::is('backoffice/catalogo/categorias') ? 'class=active' : '') }} >
                                <a href="{{ route('backoffice.catalogo.categorias.index') }}">
                                    <i class="fa fa-reorder"></i>
                                    Todas las Categorías
                                </a>
                            </li>

                            <li {{ (Request::is('backoffice/catalogo/categorias/crear') ? 'class=active' : '') }} >
                                <a href="{{ route('backoffice.catalogo.categorias.create') }}">
                                    <i class="fa fa-plus"></i>
                                    Crear Categoría
                                </a>
                            </li>

                        </ul>

                    </li>

                    <li class="treeview {{ (Request::is('backoffice/catalogo/productos*') ? 'active' : '') }}">
                        <a href="#">
                            <i class="fa fa-angle-right"></i> <span>Productos</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li {{ (Request::is('backoffice/catalogo/productos') ? 'class=active' : '') }} >
                                <a href="{{ route('backoffice.catalogo.productos.index') }}">
                                    <i class="fa fa-reorder"></i>
                                    Todos los Productos
                                </a>
                            </li>

                            <li {{ (Request::is('backoffice/catalogo/productos/crear') ? 'class=active' : '') }} >
                                <a href="{{ route('backoffice.catalogo.productos.create') }}">
                                    <i class="fa fa-plus"></i>
                                    Crear Producto
                                </a>
                            </li>

                        </ul>

                    </li>

                </ul>
            </li>

        </ul>

    </section>

</aside>