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
                {{--@if(count($product->category_attributes))--}}
                {{--@foreach($product->category_attributes as $category)--}}
                {{--<select name="attribute_id" id="">--}}
                {{--@foreach($category->attributes as $attr)--}}
                {{--<option value="{{ $attr->id }}">{{ $attr->name }}</option>--}}
                {{--@endforeach--}}
                {{--</select>--}}
                {{--@endforeach--}}

                {{--@endif--}}

                @if(count($product->category_attributes))
                    <div onclick="showProductCarta('{{ $product->id }}')" class="add-pedido"></div>
                @else
                    <div onclick="addToCart('{{ $product->id }}')" class="add-pedido"></div>
                @endif
                {{--@if($product->has('attributes'))--}}
                {{--<div onclick="showProductCarta('{{ $product->id }}')" class="add-pedido"></div>--}}
                {{--@else--}}
                {{--<div onclick="addToCart('{{ $product->id }}')" class="add-pedido"></div>--}}
                {{--@endif--}}

                {{--<a href="" class="right">--}}
                {{--<img class="add-pedido" src="/tva/images/bt-agregar-menu.svg" alt="TVA" width="" height="55">--}}
                {{--</a>--}}
            </div>
        </div>
    </div>
</div>