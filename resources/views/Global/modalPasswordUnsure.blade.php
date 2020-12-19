<div id="verticalcenter" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="vcenter" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="vcenter">Informação do Sistema</h4>
                <!--<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>-->
            </div>
            <form method="POST" action="{{ route("panel.user.permissionToExchangePassword") }}">
                @csrf
                <input type="hidden" name="id" value="{{ auth()->user()->id }}">
                <input type="hidden" name="first_name" value="{{ auth()->user()->first_name }}">
                <input type="hidden" name="last_name" value="{{ auth()->user()->last_name }}">
                <input type="hidden" name="email" value="{{ auth()->user()->email }}">
                <input type="hidden" name="cpf" value="{{ auth()->user()->cpf }}">
                <input type="hidden" name="permissionToExchangePassword" value="yes">
                <div class="modal-body">
                    <h4>Sua senha é insegura!</h4>
                    <p>
                    Por favor insira uma senha mais segura e clique em trocar!!
                    </p>
                    <div class="form-group col-md-12">
                        <input type="password" class="form-control" name="password" id="password" placeholder="Digite a nova senha..." value="" required><label for="password"></label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success waves-effect">Trocar</button>
                 </div>
            </form>
        </div>
    </div>
</div>
<a href="#" data-toggle="modal" data-target="#verticalcenter" class="click-password-unsure"></a>
