<div class="left-menu">
    <div class="content-logo">
        <img alt="platform by Emily van den Heever from the Noun Project" title="platform by Emily van den Heever from the Noun Project" src="{{ asset("ApiP/images/logo.png") }}" height="32" />
        <span>{{ $title ?? "API Teste-Box" }}</span>
    </div>
    <div class="content-menu">
        <ul>
            <h3 style="padding-left: 20px;">Informações Iniciais</h3>
            <li class="scroll-to-link active" data-target="get-started">
                <a>Get Started</a>
            </li>
            <hr>
            <h3 style="padding-left: 20px;">Rotas para Autenticação</h3>
            <li class="scroll-to-link" data-target="login">
                <a>Logar na API</a>
            </li>
            <li class="scroll-to-link" data-target="logout">
                <a>Deslogar na API</a>
            </li>
            <li class="scroll-to-link" data-target="refresh">
                <a>Renovar Token</a>
            </li>
            <hr>
            <h3 style="padding-left: 20px;">Rotas para Usuários</h3>
            <li class="scroll-to-link" data-target="user-index">
                <a>Lista de Usuários</a>
            </li>
            <li class="scroll-to-link" data-target="user-store">
                <a>Cadastro de Usuários</a>
            </li>
            <hr>
            <li class="scroll-to-link" data-target="returns-errors">
                <a>Retornos de Erros</a>
            </li>
        </ul>
    </div>
</div>
