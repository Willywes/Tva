<div class="box-pro-cat" style="height: 100%;">
    <div class="product-card">
        <div class="product-image" onclick="showProductCarta('{{ $product->id }}')">
            <img class="img-fluid"
                 src="{{ $product->image }}">
        </div>
        <div class="product-title" style="min-height: 58px;">
            <h4>{{$product->name}}</h4>
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
                {{--@if($product->has('attributes'))--}}
                    {{--<div onclick="showProductCarta('{{ $product->id }}')" class="add-pedido"></div>--}}
                {{--@else--}}
                    {{--<div onclick="addToCart('{{ $product->id }}')" class="add-pedido"></div>--}}
                {{--@endif--}}

                {{--<a href="" class="right">--}}
                {{--<img class="add-pedido" src="/hsushi/images/bt-agregar-menu.svg" alt="Hollywood Sushi" width="" height="55">--}}
                {{--</a>--}}
            </div>
        </div>
    </div>
</div>