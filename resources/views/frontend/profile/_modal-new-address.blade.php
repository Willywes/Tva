
<div class="modal" id="modal-new-address">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Nueva Dirección</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12" id="new-address-message"></div>
                </div>
                <form action="" id="form-new-address">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="add-address">Nombre</label>
                                <input type="text" name="name" id="new-address-name" class="form-control" placeholder="Ej. Casa, Oficina.">
                            </div>
                            <div class="form-group">
                                <label for="add-address">Dirección</label>
                                <input type="text" id="new-address" name="address" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button type="button" class="btn btn-dark main-bg right" onclick="newAddress('new-address');">Guardar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>