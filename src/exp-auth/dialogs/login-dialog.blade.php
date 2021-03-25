<div class="modal fade exp-auth-dialog" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centere" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Inicia a sessão - {{env('APP_NAME')}}</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="login-main-left">

                <div class="text-center mb-5 login-main-left-header pt-4">
                    <img src="{{env('LOGO_PATH')}}" class="img-fluid" alt="LOGO" style="width: 100px;">
                    <h5 class="mt-3 mb-3">Bem Vindos</h5>
                    <p>It is a long established fact that a reader <br> will be distracted by the readable.</p>
                </div>

                @include('expauth::social-logins-options')
              
               

            </div>
        </div>
    </div>
</div>

