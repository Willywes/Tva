<section>
    <div class="container" id="carta">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-awesome">
                    <div class="card-body py-3 px-2 p-md-5">
                        <h3 class="card-title">Nuestra Carta</h3>
                        <div id="accordion-carta">
                            @foreach($products_categories as $pc)
                                <div class="card card-carta">
                                    <div class="card-header" id="heading_cat_{{$pc->id}}">
                                        <div onclick="accordionToTop('heading_cat_{{$pc->id}}')"
                                             data-toggle="collapse"
                                             data-target="#collapse_cat_{{$pc->id}}" aria-expanded="false"
                                             aria-controls="collapse_cat_{{$pc->id}}" class="collapse-cat">
                                            <h4 class="mb-0 light">
                                                {{$pc->name}}
                                                <button class="btn btn-link right bold font-24 btn-collapse-cat"
                                                        style="color:#bb2f26;">
                                                    <i class="fas"></i>
                                                </button>
                                            </h4>
                                        </div>

                                    </div>
                                    <div id="collapse_cat_{{$pc->id}}" class="collapse"
                                         aria-labelledby="heading_cat_{{$pc->id}}" data-parent="#accordion-carta">
                                        <div class="card-body p-2 p-md-0">
                                            <div class="row equal">
                                                @foreach($pc->products as $product)
                                                    <div class="col-6 col-md-3">
                                                        @include('frontend.carta._product')
                                                    </div>
                                                @endforeach
                                            </div>
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

<div class="modal fade" id="modalProduct" tabindex="-1" role="dialog" aria-labelledby="modalProductLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title light" id="modalProductLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-center p-5">
                    <div class="spinner-border text-danger" role="status">
                        <span class="sr-only">Cargando...</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

</script>