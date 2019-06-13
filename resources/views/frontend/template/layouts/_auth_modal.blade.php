
<button type="button" class="btn btn-link p-0" data-asmodal="modal-login"
        style="cursor: pointer;">
    <img src="/tva/images/ic-user.svg" alt="TVA" width="" height="30"
         style="margin-top: 4px; margin-right: 12px;">
</button>

<!-- Modal -->
<div id="modal-login" class="as-modal">
    <div class="close-as-modal"><i class="fas fa-times"></i></div>
    <div class="as-modal-content">
        <h3 class="light text-center">Inicia tu sesión</h3>
        <div class="as-modal-body">
            <div class="login-content p-4">
                <form action="{{ route('login') }}" method="POST">
                    @csrf()
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="email"><i class="far fa-envelope"></i> Email</label>
                                <input type="text" class="form-control" name="email" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="password"><i class="fas fa-key"></i>
                                    Contraseña</label>
                                <input type="password" class="form-control" name="password"
                                       required>
                            </div>
                        </div>
                        <div class="col-md-12 mt-4 text-center">
                            <button type="submit" class="btn btn-lg main-bg p-0 btn-modal bold">
                                <div class="left text-left text-button px-3 py-2">
                                    Iniciar Sesión
                                </div>
                                <div class="right icon-button px-3 py-2"
                                     style="background: #ddd;">
                                    <i class="fas fa-chevron-right"></i>
                                </div>
                            </button>
                        </div>
                        <div class="col-md-12 mt-5">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="text-center text-md-left text-white">
                                        ¿Olvidaste tu contraseña?<br>
                                        <span class="semibold" style="cursor:pointer;" onclick="location.href = '{{route('profile.recovery-password')}}'">Recuperala AQUÍ</span>
                                    </div>
                                </div>
                                <div class="col-md-6 mt-4 mt-md-0">
                                    <div class="text-center text-md-right text-white">
                                        ¿No estas registrado?<br>
                                        <span class="semibold" style="cursor:pointer;" onclick="location.href = '{{route('profile.create-account')}}'">Registrate AQUÍ</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>