<div class="dropdown">
    <button class="btn btn-link nav-link p-0  dropdown-toggle" type="button" id="cartDrowpdown"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <img src="/tva/images/ic-pedido3.svg" alt="TVA" width="" height="40"
             style="margin-right: -10px;">
        <div id="items-count-content" style="display: none;" class="cart-badge">
            <span id="items-count"
                  class="main-color
                  font-14">10
            </span>
        </div>
    </button>

    <div class="dropdown-menu dropdown-menu-right" id="cartDrowpdownContent"
         aria-labelledby="cartDrowpdown">
        @if(auth()->guard('customer')->user())
            <form id="form-mini-cart" action="">
                <div class="row" id="mini-cart-list"></div>

                <div class="row">
                    <div class="col-md-12">
                       <div class="p-2 m-0 mt-2 text-center font-19 bold text-white" style="border-radius: 5px; background: #bc2d27;"> Total : <span class="totals"></span></div>
                    </div>
                    <div class="col-md-12">
                        <hr>
                    </div>
                    <div class="col-md-12">
                        <div class="custom-control custom-checkbox mb-2">
                            <input type="checkbox" class="custom-control-input send wasabi" id="wasabi"
                                   name="wasabi">
                            <label class="custom-control-label" for="wasabi">Wasabi</label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="custom-control custom-checkbox mb-2">
                            <input type="checkbox" class="custom-control-input send ginger"
                                   id="ginger"
                                   name="ginger">
                            <label class="custom-control-label" for="ginger">Jengibre</label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-6">
                                <div class="custom-control custom-checkbox mb-2">
                                    <input type="checkbox" class="custom-control-input send sticks"
                                           id="sticks"
                                           name="sticks">
                                    <label class="custom-control-label" for="sticks">Palitos
                                        para</label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="number-input" style="position: absolute; right: 15px;">
                                    <button type="button"
                                            onclick="oneLessCart(this.parentNode.querySelector('input[type=number]'))">
                                        -
                                    </button>
                                    <input class="quantity sticks_quantity" min="1" name="sticks_quantity"
                                           value="1" type="number">
                                    <button type="button"
                                            onclick="oneMoreCart(this.parentNode.querySelector('input[type=number]'))"
                                            class="plus">+
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 pt-3">
                                <button type="button" onclick="location.href='{{route('cart')}}'" style="width: 100%"
                                        class="btn btn-lg main-bg p-0 text-white">
                                    <div class="left text-left text-button px-3 py-2">
                                        Finalizar pedido
                                    </div>
                                    <div class="right icon-button px-3 py-2 ">
                                        <i class="fas fa-check"></i>
                                    </div>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        @else
            <div class="row cart-list" >
                <div class="col-md-12">
                    Por favor inicie sesión
                </div>
            </div>
        @endif
    </div>
</div>
