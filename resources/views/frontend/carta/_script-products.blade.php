<script>
    // CARTA PRODUCTOS
    function showProductCarta(id) {

        $('#modalProduct').modal();

        var url = '{{ route('ajax.product.show', ['id' => ':id']) }}';
        url = url.replace(':id', id);
        $.ajax({
            type: 'get',
            url: url,
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function (response) {
                if (response.status == 'success') {
                    setModalProduct(response.data);
                }
            },
            error: function (error) {
                showToastError('Error inesperado, por favor inténtalo denuevo mas tarde.');
            }
        });

    }

    function setModalProduct(product) {
        // console.log(product);
        $('#modalProduct .modal-title').html(product.name);
        $('#modalProduct .modal-body').html('');

        var normal;
        var current;
        if (product.offer_price != null) {
            normal = '$ ' + product.price.toLocaleString('es-CL');
            current = '$ ' + product.offer_price.toLocaleString('es-CL');
        } else {
            normal = '';
            current = '$ ' + product.price.toLocaleString('es-CL');
        }

        if (product.category_attributes.length) {

            var categories = $('<div"></div>');

            product.category_attributes.forEach(function (cat) {

                var select = $('<select name="attributes[]" class="attributes form-control"></select>');
                cat.attributes.forEach(function (attr, index) {
                    console.log(attr);
                    if(index == 0){
                        select.append($('<option value="' + attr.product_attribute.id + '" selected>' + attr.name + '</option>'));
                        current = attr.product_attribute.price ? attr.product_attribute.price : current;

                    }else{
                        select.append($('<option value="' + attr.product_attribute.id + '">' + attr.name + '</option>'));
                    }

                });
                categories.append($('<label>' + cat.name + '</label>'));
                categories.append(select);
            });

            var element = $('<form id="form-attr"><input type="hidden" name="product_id" value="' + product.id + '"><div class="row">' +
                '<div class="col-md-5"><div class="product-image"><img class="img-fluid" style="border-radius: 5px;" src="' + product.image + '"></div></div>' +
                '<div class="col-md-7 content-modal-show">' +
                '<p>' + product.description + '</p>' +
                '<div class="product-prices row">' +
                '       <div class="col-12" id="list-attributes" onchange="setPrices();">' + categories.html() + '</div>' +
                '        <div class="col-8">' +
                '            <div class="normal-price normal-select">' + normal + '</div>' +
                '            <div class="current-price current-select">' + current + '</div>' +
                '        </div>' +
                '        <div class="col-4">' +
                '            <div onclick="setToCart()" class="add-pedido"></div>' +
                '        </div>' +
                '    </div>' +
                '</div>' +
                '</div></form>');
        } else {
            var element = $('<div class="row">' +
                '<div class="col-md-5"><div class="product-image"><img class="img-fluid" style="border-radius: 5px;" src="' + product.image + '"></div></div>' +
                '<div class="col-md-7 content-modal-show">' +
                '<p>' + product.description + '</p>' +
                '<div class="product-prices row">' +
                '        <div class="col-8">' +
                '            <div class="normal-price">' + normal + '</div>' +
                '            <div class="current-price">' + current + '</div>' +
                '        </div>' +
                '        <div class="col-4">' +
                '            <div onclick="addToCart(' + product.id + ')" class="add-pedido"></div>' +
                '        </div>' +
                '    </div>' +
                '</div>' +
                '</div>');

        }

        $('#modalProduct .modal-body').html(element);

        setPrices();

    }

    function setToCart(){
        var data = $('#form-attr').serialize();
        addToCart(data, true);
    }

    $('.attributes').change(function () {
        setPrices();
    });

    function setPrices(){
        var options  = $('.attributes').find(':selected').val();
        // console.log(options);
        // options.forEach(function (opt) {
        //     console.log(opt);
        // })
        // var normal;
        var current;

    }
</script>