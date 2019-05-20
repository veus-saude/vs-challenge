@component('mail::message')
    
    <table border="0" width="500" cellpadding="0" cellspacing="1">
        <caption><h3>Novos imóveis cadastrados compatíveis com o perfil do cliente: <strong>{{$cliente->nome}}</strong></h3></caption>
        @foreach($imoveis as $imovel)
        <tr>
            <td width="60" style="border-bottom: 1px solid #ccc; border-top: 1px solid #ccc; text-align: center;">
                <?php
                if(!empty($imovel->foto_capa))
                {
                    $img_file = public_path($imovel->foto_capa);
                }else
                {
                    $img_file = public_path('img/imovel-sem-foto.jpeg');
                }

                $imgData = base64_encode(file_get_contents($img_file));
                $src = 'data: '.mime_content_type($img_file).';base64,'.$imgData;
                ?>
                <img src="{{$src}}" width="80">
            </td>
            <td valign="middle" style="border-bottom: 1px solid #ccc; border-top: 1px solid #ccc; padding: 3px 5px; color: #222">
                <p>
                    <strong>{{$imovel->referencia}} - {{$imovel->endereco->bairro->nome}}</strong><br>
                    @if(!empty((double)$imovel->valor_venda))
                        Venda: R$ {{formatDecimalToView($imovel->valor_venda)}}</br>
                    @endif
                    @if(!empty((double)$imovel->valor_locacao))
                        Locação: R$ {{formatDecimalToView($imovel->valor_locacao)}}</br>
                    @endif
                </p>
            </td>
        </tr>
        @endforeach

        
    </table>
    

    

@endcomponent
