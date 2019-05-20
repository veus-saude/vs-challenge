@component('mail::message')

    <table>
        <caption style="color: #003366; font-size: 20px;">
            <h3>Agendamento de visita</h3>
        </caption>
        <tbody>
        @foreach ($campos as $campo => $valor)
            <tr>
                <td>{{ $campo }}</td>
                <td>{{ $valor }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endcomponent
