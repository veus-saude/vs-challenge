<div class="overflow-hidden content-section" id="content-get-characters">
    <h2 id="product-index">Busca de Produtos</h2>
    <pre>
    <code class="bash">
    # Exemplo de Requisição em PHP ("http://teste-veus/api/product/seringa/brand:bunzl")
    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL => "http://teste-veus/api/product/{product_name}/{column}:{search}",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "GET",
      CURLOPT_HTTPHEADER => array(
        "Authorization: Bearer {token}"
      ),
    ));
    $response = curl_exec($curl);
    curl_close($curl);
    echo $response;
    </code>
    </pre>
    <p>
        (GET) A URL de requisição para está ação é :<br>
        <code class="higlighted">{{ route("product.index") }}</code>
    </p>
    <br>
    <pre>
    <code class="json">
    Resultado Esperado :

    {
        "code": 20004,
        "status": "success",
        "message": "Lista de Produtos mostrada com sucesso!",
        "data": {
            "current_page": 1,
            "data": [
                {
                    "id": 1,
                    "name": "Seringa",
                    "brand": "Bunzl",
                    "price": "15",
                    "stock": "30",
                    "created_at": "2020-12-21T15:44:43.000000Z",
                    "updated_at": "2020-12-21T15:44:43.000000Z"
                }
            ],
            "first_page_url": "http://teste-veus/api/product/seringa/brand:bunzl?page=1",
            "from": 1,
            "last_page": 1,
            "last_page_url": "http://teste-veus/api/product/seringa/brand:bunzl?page=1",
            "next_page_url": null,
            "path": "http://teste-veus/api/product/seringa/brand:bunzl",
            "per_page": 3,
            "prev_page_url": null,
            "to": 1,
            "total": 1
        },
        "url": "http://teste-veus/product/index"
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
            <td>name</td>
            <td>Body</td>
            <td>(Obrigatório) Esté parâmetro é passado no Body | Somente String</td>
        </tr>
        <tr>
            <td>query_filter</td>
            <td>Body</td>
            <td>(Obrigatório) Esté parâmetro é passado no Body | Somente String | Coluna da Tabela</td>
        </tr>
        </tbody>
    </table>
</div>
