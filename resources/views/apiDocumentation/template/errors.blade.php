<div class="overflow-hidden content-section" id="content-errors">
    <h2 id="returns-errors">Retornos de Erros</h2>
    <p>
        Atenção aos códigos de retorno de erros:
    </p>
    <table>
        <thead>
        <tr>
            <th>Code</th>
            <th>Tipo</th>
            <th>Descrição</th>
        </tr>
        </thead>
        <tbody>
        @foreach($messagesErrors as $index => $msgError)
            @if($index >= 5001 && $index <= 5010)
                <tr>
                    <td>{{ $index }}</td>
                    <td>ERROR</td>
                    <td>
                        {{ $msgError }}
                    </td>
                </tr>
            @endif
        @endforeach
        <tr>
            <td>301</td>
            <td>ERROR</td>
            <td>
                Validação de Campos não passou!!
            </td>
        </tr>
        </tbody>
    </table>
</div>
