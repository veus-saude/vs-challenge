<div class="overflow-hidden content-section" id="content-get-characters">
    <h2 id="user-index">Lista de Usuários</h2>
    <pre>
    <code class="bash">
    # Exemplo de Requisição em PHP
    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL => 'http://teste-box/api/user/index',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'GET',
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
        (GET) A URL de requisição para está ação é :<br>
        <code class="higlighted">{{ route("user.index") }}</code>
    </p>
    <br>
    <pre>
    <code class="json">
    Resultado Esperado :

    {
        "code": 50000,
        "status": "success",
        "message": "Lista de Usuários mostrada com sucesso!",
        "data": {
            "current_page": 1,
            "data": [
                {
                    "id": 7,
                    "first_name": "{first_name}",
                    "last_name": "{last_name}",
                    "email": "{email}",
                    "cpf": "{cpf}",
                    "email_verified_at": "{email_verified_at}",
                    "birth": "{birth}",
                    "gender": "{gender}",
                    "avatar": "{avatar}",
                    "system": 1,
                    "terms": 1,
                    "status": 1,
                    "institution_id": 1,
                    "created_at": "2020-12-10T07:30:40.000000Z",
                    "updated_at": "2020-12-10T07:30:40.000000Z",
                    "deleted_at": null
                },
            ],
            "first_page_url": "http://teste-box/api/user/index?page=1",
            "from": 1,
            "last_page": 1,
            "last_page_url": "http://teste-box/api/user/index?page=1",
            "next_page_url": null,
            "path": "http://teste-box/api/user/index",
            "per_page": 20,
            "prev_page_url": null,
            "to": 3,
            "total": 3
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
        </tbody>
    </table>
</div>
