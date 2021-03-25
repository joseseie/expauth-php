
<div class="modal fade register-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centere" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Bem Vindo a eVcourse</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="login-main-left">
                <div class="text-center mb-5 login-main-left-header pt-4">
                    <img src="https://online.explicador.co.mz/assets/img/logo-ev.png" class="img-fluid" alt="LOGO" style="width: 100px;">
                    <h5 class="mt-3 mb-3">Regista-se no eVcourses</h5>
                    <p>It is a long established fact that a reader <br> will be distracted by the readable.</p>
                </div>
                @include('exp-auth.social-logins-options')
                <form action="#">
                    <div class="form-group">
                        <label>Numero de Celular ou Email</label>
                        <input type="text" class="form-control" placeholder="Enter mobile number">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" placeholder="Password">
                    </div>
                    <div class="mt-4">
                        <div class="row">
                            <div class="col-6">
                                <button type="submit" class="btn btn-outline-primary btn-block btn-lg">Entrar</button>
                            </div>
                            <div class="col-6">
                                <button type="submit" class="btn btn-outline-primary btn-block btn-lg">Cancelar</button>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="text-center mt-5">
                    <p class="light-gray">Já tem conta? <a href="register.html">Entrar</a></p>
                </div>
            </div>
        </div>
    </div>
</div>

