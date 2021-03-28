<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div>
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Inicia a sessão na {{env('APP_NAME')}}</h5>
                      
                    </div>
        
                    <div class="login-main-left">
        
                        <div class="text-center mb-5 login-main-left-header pt-4">
                            <img src="https://online.explicador.co.mz/assets/img/logo-ev.png" class="img-fluid" alt="LOGO" style="width: 100px;">
                            <h5 class="mt-3 mb-3">Bem Vindos</h5>
                           
                        </div>
        
                        @include('expauth::social-logins-options')
              
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
