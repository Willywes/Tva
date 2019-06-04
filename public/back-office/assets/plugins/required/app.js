var items = [];

var config = {
    csrf_token      : '',
    urlGetAll       : '',
    urlStore        : '',
    urlUpdate       : '',
    urlShow         : '',
    urlDestroy      : '',
    urlChangeStatus : '',
    table           : $('#table'),
    formCreate      : $('#form-create'),
    formEdit        : $('#form-edit'),
    modalCreate     : $('#modal-create'),
    modalEdit       : $('#modal-edit'),
    rowTitles       : [
        {id: 'id', name: 'Id'},
        {id: 'name' , name : 'Nombre'},
        {id: 'created_at', name: 'Creado'},
        {id: 'updated_at', name: 'Modificado'}
    ],
    errorsCreateValidate : [],
    errorsEditValidate   : []

};

/* boostrap table load data */
function ajaxRequest(params){

    $.ajax({
        type: "GET",
        contentType : "application/json",
        url: config.urlGetAll,
        success: function(data) {
            params.success(data);
            items = data;
        }
    });
}

// funcion crear
$(function () {
    config.formCreate.submit(function (e) {

        lockSubmit();
        hideInputError(config.errorsCreateValidate);
        var dataForm = new FormData(config.formCreate[0]);

        e.preventDefault();
        $.ajax({
            type: 'post',
            url: config.urlStore,
            data: dataForm,
            processData: false,
            contentType: false,
            success: function (data) {

            if (data.errors) {
                showInputError(data.errors, config.errorsCreateValidate);
            }
            if(data.status === 'success'){
                showToastSuccess(data.message);
                dissmisModal(config.formCreate, config.modalCreate);
                config.table.bootstrapTable('refresh');
                unlockSubmit();
            }
        },
        error: function (error) {
            showToastError('Error inesperado, por favor inténtalo denuevo mas tarde.');
            dissmisModal(config.formCreate, config.modalCreate);
        }
    });
        unlockSubmit();
    });
});

// funcion de editar
$(function () {
    config.formEdit.submit(function (e) {

        lockSubmit();
        hideInputError(config.errorsEditValidate);

        var dataForm = new FormData(config.formEdit[0]);

        // var dataForm = $('#form-edit').serialize();

        e.preventDefault();

        $.ajax({
            type: 'POST',
            url: config.urlUpdate,
            data: dataForm,
            processData: false,
            contentType: false,
            success: function (data) {

                if (data.errors) {
                    showInputError(data.errors, config.errorsEditValidate);
                }
                if(data.status === 'success'){
                    showToastSuccess(data.message);
                    showToastWarning('Tenga en cuenta que el elemento que ha modificado puede estar siendo utilizado por otros elementos del software y este cambio será reflejado en estos.');
                    dissmisModal(config.modalEdit , config.modalEdit);
                    updateRow(items.findIndex(item => item.id == data.entity.id), data.entity);

                }
            },
            error: function (error) {
                showToastError('Error inesperado, por favor inténtalo denuevo mas tarde.');
                dissmisModal(config.modalEdit , config.modalEdit);
            }
        });

        unlockSubmit();

    });
});

// cambia el estado del item ( activar y desactivar )
function changeStatusToggle(rowId){

    var item = items.filter(item => item.id === rowId)[0];
    var itemStatus = item.active == 1 ? 0 : 1;

    $.ajax({
        type: 'POST',
        url: config.urlChangeStatus,
        data: {
        _token : config.csrf_token,
            id : item.id,
            active : itemStatus
    },
    success: function (data) {
        if (data.errors) {
            showToastError(data.errors.message ? data.errors.message : null);
        }
        if(data.status === 'success'){
            var name ='';
            if (data.entity.firstname) {
                name = data.entity.firstname;
            }else{
                name = data.entity.name;
            }
            var status = data.entity.active == 1 ? "activado" : "desactivado";
            showToastSuccess('Se ha ' + status + ' el elemento ' + name);
            if(status == 'desactivado'){
                showToastWarning('Tenga en cuenta que el elemento que ha deshabilitado puede estar siendo utilizado por elementos del software y este dejará de aparecer como una opción seleccionable.');
            }
            updateRow(items.findIndex(item => item.id == data.entity.id), data.entity);
        }
    },
    error: function (error) {
        showToastError('Error inesperado, por favor inténtalo denuevo mas tarde.');
    }
});

}

// eliminar registro
function remove(id){

    swal({
        title: '¿Estas seguro?',
        text: "Si eliminas este elemento, se perderán las relaciones actuales referenciadas a este elemento.",
        type: 'question',
        showCancelButton: true,
        confirmButtonText: 'Si, Eliminar',
        cancelButtonText: 'No, Cancelar',
        confirmButtonClass: 'btn btn-success',
        cancelButtonClass: 'btn btn-danger',
        buttonsStyling: false,
        reverseButtons: true
    }).then(function(result){

        if (result.value) {

            var url = config.urlDestroy;
            $.ajax({
                type: 'POST',
                url: url,
                data: {
                    _token : config.csrf_token,
                    id : id
                },
                success: function (data) {

                    if (data.errors) {
                        showToastError(data.errors.message ? data.errors.message : null);
                    }
                    if(data.status === 'success'){
                        showToastSuccess(data.message);
                        showToastWarning('Tenga en cuenta que el elemento que ha eliminado ya no puede ser referenciado.');
                        config.table.bootstrapTable('refresh');
                    }
                },
                error: function (error) {
                    showToastError('Error inesperado, por favor inténtalo denuevo mas tarde.');
                    dissmisModal('#modal-create','#modal-edit');
                }
            });

            unlockSubmit();

        } else if (result.dismiss === swal.DismissReason.cancel) {
            swal({
                title: 'Cancelado',
                text: 'Acción Cancelada.',
                type: 'error',
                confirmButtonText: 'De acuerdo',
                confirmButtonClass: 'btn btn-primary',
                buttonsStyling: false
            });
        }

    });

}

/* password generator */
function generatePassword() {
    var pass = Math.random().toString(36).substring(2);
    $('#password').val(pass);
}

/* boostrap table date and time formartter */
function dateFormat(value, row, index) {

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

    return '<span>' + day + '-' + month + '-' + date.getFullYear() + '</span><br>' +
        '<span>' + hours + ':' + minutes + ':' + seconds + '</span>';
}

// boton de editar
function operateFormatterControls(value, row, index){
    return ['<button onclick="showDataToEdit(' + row.id +')" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i></button>',
        '<button onclick="remove(' + row.id +')" class="btn btn-danger btn-sm"><i class="fa fa-remove"></i></button>'
    ].join('  ');
}

// boton de activar y desactivar item
function operateFormatterActive(value, row, index){

    var activeButton = '';

    if(row.active == 1){
        activeButton = 'checked';
    }

    return ['<label class="switch"><input id="switch" type="checkbox" onclick="changeStatusToggle(' + row.id + ')" ' + activeButton + ' id="togBtn"><div class="slider round"><span class="on">Activado</span><span class="off">Desactivado</span></div></label>'].join('');
}

/* cambiar nombre a español de atributos de tabla*/
function detailFormatter(index, row) {

    var html = [];

    $.each(row, function (key, value) {

        var title = config.rowTitles.find(title => title.id === key);
        if (title) {

            if(title.id === 'active'){
                value = value == 1 ? "Activado" : "Desactivado";
            }

            value = value ? value : "-";

            html.push('' +
                '<div style=" width: 15%; float: left;">' +
                '<b>' + title.name + ' </b></div>' +
                '<div style=" width: 85%; float: left; clear: right;">' + value  + '</div>');
        }
    });
    return html.join('');
}

// atributos de filas nowrap
function cellStyle(value, row, index, field) {
    return {
        css: {"white-space": "nowrap"}
    };
}

// actualizacion de filas
function updateRow(index, entity){

    // console.log(entity);
    // var row = {};
    // Object.getOwnPropertyNames(entity).forEach(function(val, idx, array) {
    //     row[val] = entity[val];
    // });

    // console.log(row);
    config.table.bootstrapTable('updateRow', {
        index: index,
        row: entity
    });

    items[items.findIndex(item => item.id == entity.id)] = entity;
}

// mostrar errores de input formulario
function showInputError(errors, errorView){
    Object.keys(errors).forEach(function(key) {
        var res = errorView[errorView.findIndex(item => item.name === key)];
        $(res.label).html(errors[key]);
        $(res.group).addClass('has-error');
    });
}

// limpiar errores de input formulario
function hideInputError(errorsCreateValidate){
    errorsCreateValidate.forEach(function(res) {
        $(res.label).html('');
        $(res.group).removeClass('has-error');
    });
}

// limpiar input formularion crear
function clearInputs(form){
    $(form).trigger('reset');
}

// esconder modal crear
function hideModal(modal){
    $(modal).modal('hide');
}

// show modal crear
function showModal(modal){
    $(modal).modal('show');
}

// cerrar y limpiar modal crear
function dissmisModal(form, modal){
    clearInputs(form);
    hideModal(modal);
    if ($('.select2')) {
      $('.select2').val(null).trigger('change');
    }
    $('#image-avatar').attr('src', 'storage/avatars/user-default.png');
    $('#file').val('');
}

// limpia el campo de error cuando se escribe denuevo create
$('#form-create').find('#name').keyup(function () {
    if($('#form-create').find('#name').val().length > 1){
        hideInputError('#error-name-create','#group-error-name-create');
    }
});

// limpia el campo de error cuando se escribe denuevo edit
$('#form-edit').find('#name').keyup(function () {
    if($('#form-edit').find('#name').val().length > 1){
        hideInputError('#error-name-edit','#group-error-name-edit');
    }
});
