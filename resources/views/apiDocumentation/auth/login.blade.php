<div class="overflow-hidden content-section" id="content-get-characters">
    <h2 id="login">Login</h2>
    <pre>
    <code class="bash">
    # Exemplo de Requisição em PHP
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => "http://teste-box/api/auth/login",
        CURLOPT_RETURNTRANSFER       => true,
        CURLOPT_ENCODING             => "",
        CURLOPT_MAXREDIRS            => 10,
        CURLOPT_TIMEOUT              => 0,
        CURLOPT_FOLLOWLOCATION       => true,
        CURLOPT_HTTP_VERSION         => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST        => "POST",
        CURLOPT_POSTFIELDS => array(
            'cpf'           => '{cpf}',
            'password'      => '{senha}'
        ),
    ));
    $response = curl_exec($curl);
    curl_close($curl);
    echo $response;
    </code>
    </pre>
    <p>
        (POST) A URL de requisição para está ação é :<br>
        <code class="higlighted">{{ route("auth.login") }}</code>
    </p>
    <br>
    <pre>
    <code class="json">
    Resultado Esperado :

    {
        code: 50000,
        status: "success",
        message: "Logado com sucesso!",
        data: {
            access_token: "{token}",
            token_type: "bearer",
            expires_in: 3600
        },
        url: "panel.main.index"
    }
    </code>
    </pre>
    <h4>Parâmetros para esta requisição</h4>
    <table>
        <thead>
        <tr>
            <th>Campo</th>
            <th>Tipo</th>
            <th>Descrição</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>CPF</td>
            <td>String</td>
            <td>(Obrigatório) Campo CPF é também o usuário do sistema</td>
        </tr>
        <tr>
            <td>password</td>
            <td>String</td>
            <td>(Obrigatório) Campo senha do usuário</td>
        </tr>
        </tbody>
    </table>
</div>
