<?php
function limita_texto($texto1, $limite, $quebra = true) {
    $tamanho = strlen($texto1);

    // Verifica se o tamanho do texto Ã© menor ou igual ao limite
    if ($tamanho <= $limite) {
        $novo_texto1 = $texto1;
    // Se o tamanho do texto for maior que o limite
    } else {
        // Verifica a opÃ§Ã£o de quebrar o texto
        if ($quebra == true) {
            $novo_texto1 = trim(substr($texto1, 0, $limite)).'...';
        // Se nÃ£o, corta $texto na Ãºltima palavra antes do limite
        } else {
            // Localiza o Ãºtlimo espaÃ§o antes de $limite
            $ultimo_espaco = strrpos(substr($texto1, 0, $limite), ' ');
            // Corta o $texto atÃ© a posiÃ§Ã£o localizada
            $novo_texto1 = trim(substr($texto1, 0, $ultimo_espaco)).'...';
        }
    }

    // Retorna o valor formatado
    return $novo_texto1;
}


function slugify($text)
{
  // replace non letter or digits by -
  $text = preg_replace('~[^\pL\d]+~u', '-', $text);

  // transliterate
  $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

  // remove unwanted characters
  $text = preg_replace('~[^-\w]+~', '', $text);

  // trim
  $text = trim($text, '-');

  // remove duplicate -
  $text = preg_replace('~-+~', '-', $text);

  // lowercase
  $text = strtolower($text);

  if (empty($text)) {
    return 'n-a';
  }

  return $text;
}
?>
