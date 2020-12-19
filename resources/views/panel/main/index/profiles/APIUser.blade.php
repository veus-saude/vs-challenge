<div class="row">
    <div class="col-md-12">
        <div class="card text-center">
            <div class="card-header">
                Avisos
            </div>
            <div class="card-body">
                <h4 class="card-title">Seja Bem-vindo!</h4>
                <p class="card-text">
                    Usuário para API, Este Usuário só tem permissão para ver lista de filmes ou qualquer outras funcionalidade, através
                    das funções criadas para a API, veja <a href="{{ route("apiDocumentation.main.index") }}" target="_blank">Documentação da API</a>
                </p>
            </div>
            <div class="card-footer text-muted">
                {{ \Illuminate\Support\Carbon::now()->format('d/m/Y H:i:s') }}
            </div>
        </div>
    </div>
</div>


