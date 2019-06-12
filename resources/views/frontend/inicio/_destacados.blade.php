@if($destacados)

    <section>
        <div class="container" id="destacados">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-10 offset-1">
                            <div class="row">
                                <div class="col-md-12 red-banner">
                                    <div class="p-2 font-18 thin">
                                        <div class="row">
                                            <div class="col-md-4 text-center text-md-left">
                                                <i class="fas fa-store-alt"></i> Retiro en local :
                                                <span class="semibold mr-3 d-none d-md-inline-block">20 Minutos</span>
                                                <span class="semibold mr-3 d-inline-block d-md-none">20 Min</span>
                                            </div>
                                            <div class="col-md-4 text-center">
                                                <i class="fas fa-motorcycle"></i> Entrega :
                                                <span class="semibold mr-3 d-none d-md-inline-block">45 Minutos</span>
                                                <span class="semibold mr-3 d-inline-block d-md-none">45 Min</span>
                                            </div>
                                            <div class="col-md-4 text-center text-md-right">
                                                <i class="fas fa-phone"></i> Teléfono : <span class="semibold mr-3"><a class="text-white" style="text-decoration: none;" target="_blank" href="tel:+56222163171">2 2216 3171</a></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card card-awesome">
                        <div class="card-body">
                            <h3 class="card-title text-center">Promociones</h3>
                            <div class="row products-list mx-0 mx-md-4">
                                @foreach($destacados as $product)
                                    <div class="col-md-2 product-card">
                                        <div class="product-image" onclick="showProductCarta('{{ $product->id }}')">
                                            <img class="img-fluid"
                                                 src="{{ $product->image }}">
                                        </div>
                                        <div class="product-title">
                                            <h4>{{ $product->name }}</h4>
                                        </div>
                                        <div class="product-prices row">
                                            <div class="col-8">
                                                @if($product->offer_price)
                                                    <div class="normal-price">
                                                        $ {{ number_format($product->price,0,',','.') }}
                                                    </div>
                                                    <div class="current-price">
                                                        $ {{ number_format($product->offer_price,0,',','.') }}
                                                    </div>
                                                @else
                                                    <div class="normal-price"></div>
                                                    <div class="current-price">
                                                        $ {{ number_format($product->price,0,',','.') }}
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="col-4">
                                                <div onclick="addToCart('{{ $product->id }}')" class="add-pedido"></div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif

