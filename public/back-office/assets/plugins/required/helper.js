
toastr.options = {
    "closeButton": true,
    "debug": false,
    "newestOnTop": true,
    "progressBar": false,
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

// $(document).ready(function () {
//     $('.sidebar-menu').tree()
// });

$(document).ready(function () {
    $('#loading').hide()
});

function showLoading() {
    $('#loading').show()
}

function hideLoading() {
    $('#loading').hide()
}

//lock and unlock submit
function lockSubmit() {
    $(":submit").attr("disabled", true);
}

function unlockSubmit() {
    $(":submit").attr("disabled", false);
}

// zoom letra

var zoom = 100;

function zoomIn() {
    zoom += 10;
    document.body.style.zoom = zoom + "%";
}

// funcion para disminuir la fuente
function zoomOut() {
    zoom -= 10;
    document.body.style.zoom = zoom + "%";
}

function resetZoom() {
    zoom = 100;
    document.body.style.zoom = zoom + "%";
}

function string_to_slug(str) {
    str = str.replace(/^\s+|\s+$/g, ''); // trim
    str = str.toLowerCase();

    // remove accents, swap ñ for n, etc
    var from = "àáäâèéëêìíïîòóöôùúüûñç·/_,:;";
    var to = "aaaaeeeeiiiioooouuuunc------";
    for (var i = 0, l = from.length; i < l; i++) {
        str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
    }

    str = str.replace(/[^a-z0-9 -]/g, '') // remove invalid chars
        .replace(/\s+/g, '-') // collapse whitespace and replace by -
        .replace(/-+/g, '-'); // collapse dashes

    return str;
}

function dateFormatChile(value) {

    var date = new Date(value);

    var day = date.getDate().toString();
    day = day.length > 1 ? day : '0' + day;

    var month = (1 + date.getMonth()).toString();
    month = month.length > 1 ? month : '0' + month;

    var hours = date.getHours().toString();
    hours = hours.length > 1 ? hours : '0' + hours;

    var minutes = date.getMinutes().toString();
    minutes = minutes.length > 1 ? minutes : '0' + minutes;

    var seconds = date.getSeconds().toString();
    seconds = seconds.length > 1 ? seconds : '0' + seconds;

    return day + '/' + month + '/' + date.getFullYear(); //+ "  " + hours + ":" + minutes;
}
