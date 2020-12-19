<div class="overflow-hidden content-section" id="content-get-characters">
    <h2 id="user-store">Cadastro de Usuários</h2>
    <pre>
    <code class="bash">
    # Exemplo de Requisição em PHP
    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL => 'http://teste-box/api/user/store',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS => array(
        'first_name'            => '{Primeiro Nome}',
        'last_name'             => '{Sobrenome}',
        'email'                 => '{email}',
        'cpf'                   => '{CPF | Sem pontos ou traços}',
        'password'              => '{Senha | Mínimo 4 chars}',
        'password_confirmation' => '{Corfirmação de Senha | Mínimo 4 chars}',
        'terms'                 => 'Termos de Uso | Checkbox = on',
        'use_api'               => '{ Usar API | Boolean }'
      ),
      CURLOPT_HTTPHEADER => array(
        'Authorization: Bearer {token}'
      ),
    ));
    $response = curl_exec($curl);
    curl_close($curl);
    echo $response;
    </code>
    </pre>
    <p>
        (POST) A URL de requisição para está ação é :<br>
        <code class="higlighted">{{ route("user.store") }}</code>
    </p>
    <br>
    <pre>
    <code class="json">
    Resultado Esperado :

    {
        "code": 20000,
        "status": "success",
        "message": "Cadastro de Usuário realizado com sucesso!",
        "data": {
            "first_name"      : "Primeiro nome",
            "last_name"       : "segundo nome",
            "email"           : "teste@teste",
            "cpf"             : "99999999999",
            "terms"           : 1,
            "system"          : 0,
            "institution_id"  : 9,
            "updated_at"      : "2020-12-10T13:41:13.000000Z",
            "created_at"      : "2020-12-10T13:41:13.000000Z",
            "id": 15,
            "roles": []
        },
        "url": "panel.main.index"
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
            <td>Autorization</td>
            <td>Header</td>
            <td>(Obrigatório) Esté parâmetro é passado no Header (Bearer {token}) | Expira em 1 hora</td>
        </tr>
        <tr>
            <td>first_name</td>
            <td>string</td>
            <td>(Obrigatório) Parâmetro Primeiro nome é obrigatório</td>
        </tr>
        <tr>
            <td>last_name</td>
            <td>string</td>
            <td>(Obrigatório) Parâmetro Sobrenome é obrigatório</td>
        </tr>
        <tr>
            <td>email</td>
            <td>email</td>
            <td>(Obrigatório) Parâmetro E-mail é obrigatório</td>
        </tr>
        <tr>
            <td>cpf</td>
            <td>string</td>
            <td>(Obrigatório) Parâmetro CPF é obrigatório</td>
        </tr>
        <tr>
            <td>terms</td>
            <td>boolean</td>
            <td>(Obrigatório) Parâmetro Termos de Uso é obrigatório</td>
        </tr>
        <tr>
            <td>email</td>
            <td>string</td>
            <td>(Obrigatório) Parâmetro E-mail é obrigatório</td>
        </tr>
        <tr>
            <td>password</td>
            <td>password</td>
            <td>(Obrigatório) Parâmetro Senha é obrigatório</td>
        </tr>
        <tr>
            <td>password_confirmation</td>
            <td>password</td>
            <td>(Obrigatório) Parâmetro Confirmação de Senha é obrigatório</td>
        </tr>
        <tr>
            <td>use_api</td>
            <td>boolean</td>
            <td>(Obrigatório) Parâmetro Uso de API é obrigatório</td>
        </tr>
        </tbody>
    </table>
</div>
