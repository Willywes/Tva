<section>
    <div class="container mb-5" id="tiendas">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-awesome">
                    <div class="card-body p-3 py-md-4 px-md-5">
                        <h3 class="card-title text-center mb-3">Tiendas</h3>
                        <div class="row">
                            @foreach($shops as $shop)
                                <div class="col-md-3 mb-4 text-center">
                                    <div class="box-pro-cat card-shop">
                                        <a href="{{ route('shop', [ 'id' => $shop->slug ] ) }}"
                                           class=""><img src="{{ $shop->logo }}" class="img-fluid" style="background: white;"></a>
                                        <h3 class="light text-center my-3">{{ $shop->shop_name }}</h3>
                                        <a href="{{ route('shop', [ 'id' => $shop->slug ] ) }}"
                                           class="text-center btn btn-dark main-bg btn">Visitar</a>
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

<script>

</script>