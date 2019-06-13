toastr.options = {
    "closeButton": true,
    "debug": false,
    "newestOnTop": true,
    "progressBar": false,
    // "positionClass": "toast-top-center",
    "positionClass": "toast-bottom-right",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "5000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
};

// mostrar mensaje de exito
function showToastSuccess(message, title) {
    toastr.success(message, title ? title : 'Operación Éxitosa');
}

// mostrar mensaje de error
function showToastError(message, title) {
    toastr.error(message, title ? title : 'Error!');
}

// mostrar info de error
function showToastInfo(message, title) {
    toastr.info(message, title ? title : 'Información!');
}

// mostrar warning de error
function showToastWarning(message, title) {
    toastr.warning(message, title ? title : 'Advertencia!');
}


$(document).ready(function () {
    $("#collapse_cat_2").click();
});


$('[data-asmodal]').click(function (e) {

    console.log('si');
    var data = $(this).data('asmodal');
    $('#' + data).addClass('active ultra-faster');
    animateCSS('#' + data, 'zoomIn');
    e.preventDefault();
});

$('.close-as-modal').click(function (e) {

    var element = $(this).parent('.as-modal');
    element.removeClass('ultra-faster');
    animateCSS('#' + element.attr('id'), 'bounceOutUp', function () {
        element.removeClass('active');
    });

    e.preventDefault();
});

function closeASModal(modal) {
    var element = $('#' + modal);
    element.removeClass('ultra-faster');
    animateCSS('#' + element.attr('id'), 'bounceOutUp', function () {
        element.removeClass('active');
    });

    e.preventDefault();
}

function animateCSS(element, animationName, callback) {
    const node = document.querySelector(element);
    node.classList.add('animated', animationName);

    function handleAnimationEnd() {
        node.classList.remove('animated', animationName)
        node.removeEventListener('animationend', handleAnimationEnd)

        if (typeof callback === 'function') callback()
    }

    node.addEventListener('animationend', handleAnimationEnd)
}


// CAROUSEL
$('.carousel').carousel({
    interval: 2000
});

// SLICK
$('.products-list').slick({
    slidesToShow: 5,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 1000,
    adaptiveHeight: true,
    responsive: [
        {
            breakpoint: 768,
            settings: {
                arrows: false,
                centerMode: false,
                centerPadding: '40px',
                slidesToShow: 3
            }
        },
        {
            breakpoint: 480,
            settings: {
                arrows: false,
                centerMode: true,
                centerPadding: '40px',
                slidesToShow: 1
            }
        }
    ]
}).on('setPosition', function (event, slick) {
    slick.$slides.css('height', slick.$slideTrack.height() + 'px');
});

// DROPDOWN CATEGORIAS DE PRODUCTOS
$('.dropdown').on('show.bs.dropdown', function (e) {
    $(this).find('.dropdown-menu').first().stop(true, true).slideDown(300);
});

$('.dropdown').on('hide.bs.dropdown', function (e) {
    $(this).find('.dropdown-menu').first().stop(true, true).slideUp(200);
});

$('.dropdown-menu').click(function (e) {
    e.stopPropagation();
});

function accordionToTop(id) {
    $('#accordion-carta').on('shown.bs.collapse', function () {
        $('html, body').animate({
            scrollTop: $('#' + id).offset().top - 70
        }, 50);
    })
}


function goGoogleMaps() {
    window.open('https://www.google.com/maps/dir//Hollywood+Sushi+-+Padre+Alfredo+Arteaga+Barros+1929,+Lo+Barnechea,+Regi%C3%B3n+Metropolitana/@-33.3524251,-70.5125414,17z/data=!4m9!4m8!1m0!1m5!1m1!1s0x9662cbc47266550b:0xcb1b22bf606f8c8d!2m2!1d-70.5103527!2d-33.3524296!3e0');
    return false;
}

/*
 * CARRITO
 */


$(document).ready(function () {
    $.xhrPool = [];

    function abortAll() {
        $.xhrPool.forEach(function (jqXHR) {
            jqXHR.abort();
        });
    }

    $.ajaxSetup({
        beforeSend: function (jqXHR) {
            $.xhrPool.push(jqXHR);
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    getCart();
});

function getCart() {
    var url = '/cart/get-cart';
    $.ajax({
        type: 'get',
        url: url,
        success: function (response) {
            if (response.status == 'success') {
                renderCart(response.data)
            }
        },
        error: function (error) {
            showToastError('Error inesperado, por favor inténtalo denuevo mas tarde.');
        }
    });
}

function addToCart(product_id, attributes = null) {

    var data = {
        product_id: product_id
    };

    if (attributes) {
        data = product_id;
        console.log(data);
    }

    if (validateLogin()) {
        var url = '/cart/add-cart';
        $.ajax({
            type: 'post',
            url: url,
            data: data,
            success: function (response) {
                if (response.status == 'success') {
                    getCart();
                    showToastSuccess('Se ha agregado ' + response.data.name, 'De acuerdo');
                } else {
                    showToastError(response.message, response.status);
                }
            },
            error: function (error) {
                showToastError('Error inesperado, por favor inténtalo denuevo mas tarde.');
            }
        });
    }
}

function updateCart(data) {
    var url = '/cart/update-cart';
    $.ajax({
        type: 'post',
        url: url,
        data: data,
        success: function (response) {
            if (response.status == 'success') {
                getCart();
            }
        },
        error: function (error) {
            showToastError('Error inesperado, por favor inténtalo denuevo mas tarde.');
        }
    });

}

function removeFromCart(id) {
    var url = '/cart/remove-from-cart';
    $.ajax({
        type: 'post',
        url: url,
        data: {
            id: id,
        },
        success: function (response) {

            if (response.status == 'success') {
                getCart();
            }
        },
        error: function (error) {
            showToastError('Error inesperado, por favor inténtalo denuevo mas tarde.');
        }
    });
}

function oneLessCart(input) {
    input.stepDown();
    var name = input['name'];
    var value = input['value'];
    var data = {[name]: value};
    updateCart(data);
    //showToastSuccess('Se ha rebajado la cantidad.', 'De Acuerdo')
}

function oneMoreCart(input) {
    input.stepUp();
    var name = input['name'];
    var value = input['value'];
    var data = {[name]: value};
    updateCart(data);
    //showToastSuccess('Se ha aumentado la cantidad.', 'De Acuerdo')
}


function renderCart(cart) {
    // cart.wasabi ? $('.wasabi').prop('checked', 'checked') : $('.wasabi').prop('checked', '');
    // cart.ginger ? $('.ginger').prop('checked', 'checked') : $('.ginger').prop('checked', '');
    // cart.sticks ? $('.sticks').prop('checked', 'checked') : $('.sticks').prop('checked', '');
    // if ($('.sticks').prop('checked')) {
    //     $('.sticks_quantity').parent('.number-input').show();
    //     $('.sticks_quantity').val(cart.sticks_quantity);
    // } else {
    //     $('.sticks_quantity').parent('.number-input').hide();
    //     $('.sticks_quantity').val(1);
    // }
    $('.totals').html(cart.total.toLocaleString('es-CL'));

    if (cart.items.length > 0) {
        $('#items-count-content').show();
        $('#items-count').html(cart.total_items);

    } else {
        $('#items-count-content').hide();
        $('#items-count').html('0');
    }

    renderMiniCart(cart);
    renderFullCart(cart);

}

function renderMiniCart(cart) {

    var cartList = $('#mini-cart-list');

    cartList.html('');

    if (cart.items.length > 0) {

        cart.items.forEach(function (item) {

            var normal;
            var current;

            if (item.product.offer_price != null) {
                normal = '$ ' + item.product.price.toLocaleString('es-CL');
                current = '$ ' + item.product.offer_price.toLocaleString('es-CL');
            } else {
                normal = '';
                current = '$ ' + item.product.price.toLocaleString('es-CL');
            }

            var extras = '';

            if (item.product_attributes.length) {

                if (item.offer_price != null) {
                    normal = '$ ' + item.price.toLocaleString('es-CL');
                    current = '$ ' + item.offer_price.toLocaleString('es-CL');
                } else {
                    normal = '';
                    current = '$ ' + item.price.toLocaleString('es-CL');
                }

                var extras = $('<div"></div>');
                item.product_attributes.forEach(function (product_attribute) {
                    extras.append($('<strong>' + product_attribute.attribute.attribute_category.name + ': </strong><span> ' + product_attribute.attribute.name + '</span><br>'));
                });
                var row = $('<div class="col-md-12">' +
                    '<div class="row no-gutters">' +
                    '   <div class="col-5 mr-0 pr-0">' +
                    '       <img style="border-radius: 5px;" src="' + item.product.image + '" class="img-fluid">' +
                    '   </div>' +
                    '   <div class="col-7 pl-2 mc-row-box">' +
                    '       <div class="product-title">' +
                    '           <h4>' + item.product.name + '</h4>' +
                    '<div class="extra-line">' + extras.html() + '</div> ' +
                    '<div class="text-center remove-cart-icon">' +
                    '<button type="button" class="btn btn-rounded btn-times light p-0" onclick="removeFromCart(' + item.id + ');">                <img title="Quitar producto del carro" src="/tva/images/ic-times.svg" height="20px" width="20px">' +
                    '</button>' +
                    '</div>' +

                    '       </div>' +
                    '       <div class="row no-gutters mc-to-bottom">' +
                    '          <div class="col-5">' +
                    '            <div class="line-through font-13">' + normal + '</div>' +
                    '            <div class="semibold">' + current + '</div>' +
                    '           </div>' +
                    '           <div class="col-7">' +
                    '              <div class="number-input">' +
                    '                   <button type="button" onclick="oneLessCart(this.parentNode.querySelector(\'input[type=number]\'))">-</button>' +
                    '                   <input class="quantity" min="0" name="items[' + item.id + ']" id="item_' + item.id + '" value="' + item.quantity + '" type="number">' +
                    '                   <button type="button"  onclick="oneMoreCart(this.parentNode.querySelector(\'input[type=number]\'))" class="plus">+</button>' +
                    '               </div>' +
                    '           </div>' +
                    '       </div>' +
                    '   </div>' +
                    '</div>' +
                    '</div>');
            }else{
                var row = $('<div class="col-md-12">' +
                    '<div class="row no-gutters">' +
                    '   <div class="col-5 mr-0 pr-0">' +
                    '       <img style="border-radius: 5px;" src="' + item.product.image + '" class="img-fluid">' +
                    '   </div>' +
                    '   <div class="col-7 pl-2 mc-row-box">' +
                    '       <div class="product-title">' +
                    '           <h4>' + item.product.name + '</h4>' +
                    '<div class="text-center remove-cart-icon">' +
                    '<button type="button" class="btn btn-rounded btn-times light p-0" onclick="removeFromCart(' + item.id + ');">                <img title="Quitar producto del carro" src="/tva/images/ic-times.svg" height="20px" width="20px">' +
                    '</button>' +
                    '</div>' +

                    '       </div>' +
                    '       <div class="row no-gutters mc-to-bottom">' +
                    '          <div class="col-5">' +
                    '            <div class="line-through font-13">' + normal + '</div>' +
                    '            <div class="semibold">' + current + '</div>' +
                    '           </div>' +
                    '           <div class="col-7">' +
                    '              <div class="number-input">' +
                    '                   <button type="button" onclick="oneLessCart(this.parentNode.querySelector(\'input[type=number]\'))">-</button>' +
                    '                   <input class="quantity" min="0" name="items[' + item.id + ']" id="item_' + item.id + '" value="' + item.quantity + '" type="number">' +
                    '                   <button type="button"  onclick="oneMoreCart(this.parentNode.querySelector(\'input[type=number]\'))" class="plus">+</button>' +
                    '               </div>' +
                    '           </div>' +
                    '       </div>' +
                    '   </div>' +
                    '</div>' +
                    '</div>');

            }


            cartList.append(row);
        });
    } else {
        cartList.append($('<div class="col-md-12"><div class="text-center semibold">Su carrito esta vacio.</div></div>'));
    }


}

function renderFullCart(cart) {

    var cartList = $('#cart-list');

    $('#comments').val(cart.comments);

    cartList.html('');

    if (cartList.length) {

        if (cart.items.length > 0) {
            cart.items.forEach(function (item) {

                var normal;
                var current;

                if (item.product.offer_price != null) {
                    normal = '$ ' + item.product.price.toLocaleString('es-CL');
                    current = '$ ' + item.product.offer_price.toLocaleString('es-CL');
                } else {
                    normal = '';
                    current = '$ ' + item.product.price.toLocaleString('es-CL');
                }

                var extras = '';

                if (item.product_attributes.length) {

                    if (item.offer_price != null) {
                        normal = '$ ' + item.price.toLocaleString('es-CL');
                        current = '$ ' + item.offer_price.toLocaleString('es-CL');
                    } else {
                        normal = '';
                        current = '$ ' + item.price.toLocaleString('es-CL');
                    }

                    var extras = $('<div"></div>');
                    item.product_attributes.forEach(function (product_attribute) {
                        extras.append($('<strong>' + product_attribute.attribute.attribute_category.name + ': </strong><span> ' + product_attribute.attribute.name + '</span><br>'));
                    });

                    var row = $('<tr>' +
                        '    <td class="no-wrap-td">' +
                        '        <img src="' + item.product.image + '" class="img-product-table"></td>' +
                        '    <td style="width: 30%;">' +
                        '        <div class="product-title">' +
                        '            <h4>' + item.product.name + '</h4>' +
                        '        </div>' +
                        '        <div class="font-12 italic">' + extras.html() + '</div>' +
                        '    </td>' +
                        '    <td class="no-wrap-td text-center">' +
                        '        <div class="line-through font-13"> ' + normal + '</span></div>' +
                        '        <div class="semibold">' + current + '</span></div>' +
                        '    </td>' +
                        '    <td class="no-wrap-td text-center">' +
                        '        <div style="width: 100%;" class="text-center">' +
                        '            <div class="number-input">' +
                        '                <button type="button" onclick="oneLessCart(this.parentNode.querySelector(\'input[type=number]\'))"> - </button>' +
                        '                <input class="quantity" min="1"' +
                        '                       name="items[' + item.id + ']"' +
                        '                       id="item_' + item.id + '"' +
                        '                       value="' + item.quantity + '" type="number">' +
                        '                <button type="button" onclick="oneMoreCart(this.parentNode.querySelector(\'input[type=number]\'))" class="plus"> + </button>' +
                        '            </div>' +
                        '        </div>' +
                        '    </td>' +
                        '    <td class="no-wrap-td bold main-color">' +
                        '        $<span class="right">' + item.total.toLocaleString('es-CL') + '</td>' +
                        '    <td class="no-wrap-td">' +
                        '        <div class="text-center">' +
                        '            <button type="button" class="btn btn-link btn-times light" onclick="removeFromCart(' + item.id + ');">' +
                        '                <img title="Quitar producto del carro" src="/tva/images/ic-times.svg" width="36px">' +
                        '            </button>' +
                        '        </div>' +
                        '    </td>' +
                        '</tr>');

                }else{
                    var row = $('<tr>' +
                        '    <td class="no-wrap-td">' +
                        '        <img src="' + item.product.image + '" class="img-product-table"></td>' +
                        '    <td style="width: 30%;">' +
                        '        <div class="product-title">' +
                        '            <h4>' + item.product.name + '</h4>' +
                        '        </div>' +
                        '        <div class="font-12 italic">' + /*item.product.description*/ '' + '</div>' +
                        '    </td>' +
                        '    <td class="no-wrap-td text-center">' +
                        '        <div class="line-through font-13"> ' + normal + '</span></div>' +
                        '        <div class="semibold">' + current + '</span></div>' +
                        '    </td>' +
                        '    <td class="no-wrap-td text-center">' +
                        '        <div style="width: 100%;" class="text-center">' +
                        '            <div class="number-input">' +
                        '                <button type="button" onclick="oneLessCart(this.parentNode.querySelector(\'input[type=number]\'))"> - </button>' +
                        '                <input class="quantity" min="1"' +
                        '                       name="items[' + item.id + ']"' +
                        '                       id="item_' + item.id + '"' +
                        '                       value="' + item.quantity + '" type="number">' +
                        '                <button type="button" onclick="oneMoreCart(this.parentNode.querySelector(\'input[type=number]\'))" class="plus"> + </button>' +
                        '            </div>' +
                        '        </div>' +
                        '    </td>' +
                        '    <td class="no-wrap-td bold main-color">' +
                        '        $<span class="right">' + item.total.toLocaleString('es-CL') + '</td>' +
                        '    <td class="no-wrap-td">' +
                        '        <div class="text-center">' +
                        '            <button type="button" class="btn btn-link btn-times light" onclick="removeFromCart(' + item.id + ');">' +
                        '                <img title="Quitar producto del carro" src="/tva/images/ic-times.svg" width="36px">' +
                        '            </button>' +
                        '        </div>' +
                        '    </td>' +
                        '</tr>');
                }

                cartList.append(row);
            });
        } else {
            cartList.append($('<tr><td colspan="6"><div class="text-center semibold"> Su carrito esta vacio</div></td></tr>'));
        }
    }
}


$('.send').click(function () {
    var name = $(this).prop('name');
    var value = $(this).prop('checked') ? 1 : 0;
    var data = {[name]: value};
    updateCart(data);
});

$('#comments').change(function () {
    updateCart({comments: $(this).val()});
});

// DIRECCIONES

function getAddresses(callback) {
    var url = '/perfil/get-addresses';
    $.ajax({
        type: 'get',
        url: url,
        success: function (response) {
            if (response.status == 'success') {
                callback(response.data);
            }
        },
        error: function (error) {
            showToastError('Error inesperado, por favor inténtalo denuevo mas tarde.');
        }
    });
}

function renderAddresses(addresses) {

    if (addresses) {
        $('.body-addresses').html('');
        addresses.forEach(function (address) {

            $('.body-addresses').append($('<tr>' +
                '        <td>' + address.name + '</td>' +
                '        <td>' + address.address + '</td>' +
                '        <td>' +
                '            <div>' +
                '                <button class="btn btn-danger btn-sm"' +
                '                        title="Eliminar dirección ' + address.name + '">' +
                '                    <i class="fas fa-trash"></i>' +
                '                </button>' +
                '            </div>' +
                '        </td>' +
                '    </tr>'));
        });
    } else {
        $('.body-addresses').html('');
        $('.body-addresses').append($('<tr><td colspan="3">' +
            '<div class="text-center"> Sin direcciones registradas.</div>' +
            '</td></tr>'));
    }
}

function newAddress(input) {
    var address = $('#' + input).val();
    if (address) {
        validateAddress(input, function (response) {
            if (response.status == 'success') {
                addAddress();
            } else {
                renderMessage(input, response.title, response.message, response.alert);
            }
        });
    } else {
        renderMessage(input, '¡Error!', 'Ingrese una direccion.', 'danger');
    }
}

function addAddress() {
    var url = '/perfil/add-address';
    data = $('#form-new-address').serialize();
    $.ajax({
        type: 'post',
        url: url,
        data: data,
        success: function (response) {
            if (response.status == 'success') {
                runAddress();
                $("#modal-new-address").modal('hide');
                showToastSuccess('Dirección agregada correctamente.');
            }
            if (response.status == 'error' && response.code != 409) {
                showToastError(response.message);
            }

            if (response.code == 409) {
                $("#modal-new-address").modal('hide');
                showToastWarning(response.message);
            }
        },
        error: function (error) {
            showToastError('Error inesperado al añadir una nueva dirección, por favor inténtalo denuevo mas tarde.');
        }
    });
}

// mini - carrito

// $('#sticks').change(function () {
//     if ($(this).prop('checked')) {
//         $('#sticks_quantity').val(1);
//         $('#palitosCounter').show();
//     } else {
//         $('#palitosCounter').hide();
//         $('#sticks_quantity').val(1);
//     }
// });

// function oneLessCart(input) {
//     input.stepDown();
//     $('#cart-list').ready(function () {
//         updateCart();
//     });
//     showToastSuccess('Se ha rebajado la cantidad.', 'De Acuerdo')
// }
//
// function oneMoreCart(input) {
//     input.stepUp();
//     $('#cart-list').ready(function () {
//         updateCart();
//     });
//     showToastSuccess('Se ha aumentado la cantidad.', 'De Acuerdo')
// }
//
// $('#form-mini-cart').on('input', function () {
//     $('#cart-list').ready(function () {
//         updateCart();
//     })
// });
//
// $(document).ready(function () {
//     $.xhrPool = [];
//     function abortAll() {
//         $.xhrPool.forEach(function (jqXHR) {
//             jqXHR.abort();
//         });
//     }
//
//     $.ajaxSetup({
//         beforeSend: function (jqXHR) {
//             $.xhrPool.push(jqXHR);
//         },
//         headers: {
//             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//         }
//     });
//     loadCart();
// });
//

//
// function updateCart() {
//     if ($('#form-mini-cart').length) {
//         var serialized = $('#form-mini-cart').serialize();
//         var url = '/ajax/update-cart';
//         $.ajax({
//             type: 'post',
//             url: url,
//             data: serialized,
//             success: function (response) {
//                 if (response.status == 'success') {
//                     loadCart();
//                 }
//             },
//             error: function (error) {
//                 showToastError('Error inesperado, por favor inténtalo denuevo mas tarde.');
//             }
//         });
//     }
//
// }
//
// function loadCart() {
//     var url = '/cart/get-cart';
//     $.ajax({
//         type: 'get',
//         url: url,
//         success: function (response) {
//             if (response.status == 'success') {
//                 getCart(response.data);
//             }
//         },
//         error: function (error) {
//             showToastError('Error inesperado, por favor inténtalo denuevo mas tarde.');
//         }
//     });
// }


// var xResponse = function() {
//     // local var
//     var theResponse = null;
//     // jQuery ajax
//     var url = '/cart/get-cart';
//     $.ajax({
//         type: 'get',
//         url: url,
//         success: function (response) {
//             if (response.status == 'success') {
//                 theResponse = response;
//             }
//         },
//         error: function (error) {
//             showToastError('Error inesperado, por favor inténtalo denuevo mas tarde.');
//         }
//     });
//     // Return the response text
//     return theResponse;
// }


//
// function getCart(cart) {
//
//
//     if ($('#form-mini-cart').length && cart != null) {
//
//         $('.sticks_quantity').val(cart.sticks_quantity);
//
//         $('#items-count').html(cart.items_count);
//
//         cart.sticks ? $('.sticks').prop('checked', 'checked') : $('.sticks').prop('checked', '');
//         cart.ginger ? $('.ginger').prop('checked', 'checked') : $('.ginger').prop('checked', '');
//         cart.wasabi ? $('.wasabi').prop('checked', 'checked') : $('.wasabi').prop('checked', '');
//
//         // cart.sticks ? showToastSuccess('Ha añadidos palitos') : showToastSuccess('Ha quitados los palitos');
//         // cart.ginger ? showToastSuccess('Ha añadidos jengigre') : showToastSuccess('Ha quitados el jengibre');
//         // cart.wasabi ? showToastSuccess('Ha añadidos wasabi') : showToastSuccess('Ha quitados el wasabi');
//
//         if (cart.items_count > 0) {
//
//             $('#items-count-content').show();
//
//             var cartList = $('#cart-list');
//
//             cartList.html('');
//
//             cart.items.forEach(function (item) {
//
//                 var normal;
//                 var current;
//
//                 if (item.product.offer_price != null) {
//                     normal = '$ ' + item.product.price.toLocaleString('es-CL');
//                     current = '$ ' + item.product.offer_price.toLocaleString('es-CL');
//                 } else {
//                     normal = '';
//                     current = '$ ' + item.product.price.toLocaleString('es-CL');
//                 }
//
//                 var row = $('<div class="col-md-12">' +
//                     '<div class="row">' +
//                     '   <div class="col-5 mr-0 pr-0 mb-2">' +
//                     '       <img style="border-radius: 5px;" src="' + item.product.image + '" class="img-fluid">' +
//                     '   </div>' +
//                     '   <div class="col-7 mc-row-box">' +
//                     '       <div class="product-title">' +
//                     '           <h4>' + item.product.name + '</h4>' +
//                     '       </div>' +
//                     '       <div class="row no-gutters mc-to-bottom">' +
//                     '          <div class="col-5">' +
//                     '            <div class="normal-price">' + normal + '</div>' +
//                     '            <div class="current-price">' + current + '</div>' +
//                     '           </div>' +
//                     '           <div class="col-7">' +
//                     '              <div class="number-input" id="">' +
//                     '                   <button type="button" onclick="oneLessCart(this.parentNode.querySelector(\'input[type=number]\'))">-</button>' +
//                     '                   <input class="quantity" min="1" name="products[' + item.product.id + ']" id="product_' + item.product.id + '" value="' + item.quantity + '" type="number">' +
//                     '                   <button type="button"  onclick="oneMoreCart(this.parentNode.querySelector(\'input[type=number]\'))" class="plus">+</button>' +
//                     '               </div>' +
//                     '           </div>' +
//                     '       </div>' +
//                     '   </div>' +
//                     '</div>' +
//                     '</div>');
//                 cartList.append(row);
//             });
//
//         }
//
//     } else {
//         $('#items-count-content').hide();
//         $('#cart-list').html($('<div class="col-md-12">Su carrito esta vacio.</div>'))
//     }
// }




