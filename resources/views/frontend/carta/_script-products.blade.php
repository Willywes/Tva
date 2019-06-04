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
        console.log(product);
        $('#modalProduct .modal-title').html(product.name);
        var normal;
        var current;
        if (product.offer_price != null) {
            normal = '$ ' + product.price.toLocaleString('es-CL');
            current = '$ ' + product.offer_price.toLocaleString('es-CL');
        } else {
            normal = '';
            current = '$ ' + product.price.toLocaleString('es-CL');
        }
        //
        // var off = product.offer_price ? '$ ' + product.offer_price.toLocaleString('es-CL') : '';
        // var price = product.price ? '$ ' +  product.price.toLocaleString('es-CL');

        // var select = null;
        // if(product.attributes){
        //
        //     product.attributes.forEach(function (attributes) {
        //         var select = $('<select class="from-control" name="attribute"></select>');
        //         select.append($('<option value="">' + attributes.name +'</option>'));
        //         attributes.attributes.forEach(function (attr) {
        //             select.append($('<option value="' + attr.id+ '">' + attr.name +'</option>'));
        //         });
        //         console.log(select);
        //     });
        // }

        var element = $('<div class="row">' +
            '<div class="col-md-5"><div class="product-image"><img class="img-fluid" style="border-radius: 5px;" src="' + product.image + '"></div></div>' +
            '<div class="col-md-7">' +
            // '<p class="semibold">' + $.parseHTML(select) + '</p>' +
            '<p>' + product.description + '</p>' +
            '<div class="product-prices row">' +
            '        <div class="col-8">' +
            '            <div class="normal-price">' + normal + '</div>' +
            '            <div class="current-price">' + current + '</div>' +
            '        </div>' +
            '        <div class="col-4">' +
            '            <div onclick="addToCart('+ product.id +')" class="add-pedido"></div>' +
            '        </div>' +
            '    </div>' +
            '</div>' +
            '</div>');

        $('#modalProduct .modal-body').html(element);

    }
</script>