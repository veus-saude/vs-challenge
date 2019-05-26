<?php

namespace app\model;

class validateModel {
    
    public function obrigatoriedadeCampos($campos, $table) {
        
        $resposta = [
            'status' => false,
            'mensagem' => []
        ];
        $msgErro = [];
        
        /* Campos obrigatórios da tabela */
        switch ($table) {
            case 'produto':
                $required = ['name', 'brand', 'value', 'quantity'];
                break;
        }
        
        foreach ($required as $valor) {
            if (!array_key_exists($valor, $campos)) {
                $msgErro[] = 'Campo "' . $valor . '" não foi enviado';
            }
        }
        

        if (count($msgErro) == 0) {
            $resposta['status'] = true;
        } else {
            $resposta['mensagem'] = implode(', ', $msgErro) . '.';
        }
        
        return $resposta;
    }

    public function validarCampos($campos) {

        $resposta = [
            'status' => false,
            'mensagem' => []
        ];

        foreach ($campos as $chave => $valor) {
            switch ($chave) {
                case 'name':

                    $len = strlen($valor);

                    if ($len < 3) {

                        $resposta['mensagem'][$chave] = 'Nome digitado com menos de 3 caracteres.';
                    } else if ($len > 60) {

                        $resposta['mensagem'][$chave] = 'Nome digitado com mais de 60 caracteres.';
                    }
                    break;
                case 'brand':

                    $len = strlen($valor);

                    if ($len < 3) {

                        $resposta['mensagem'][$chave] = 'Marca digitada com menos de 3 caracteres.';
                    } else if ($len > 60) {

                        $resposta['mensagem'][$chave] = 'Marca digitada com mais de 60 caracteres.';
                    }
                    break;
                    
                case 'value':
                    
                    $msgValor = '';
                    $len = strlen($valor);

                    if ($len != 0) {
                        if ($len < 7) {

                            $msgValor[] = 'Valor digitado incorretamente';
                        } else if ($len > 20) {

                            $msgValor[] = 'Valor digitado com mais de 20 caracteres';
                        }

                        if (substr($valor, 0, 3) != 'R$ ') {
                            $msgValor[] = 'Valor fora do padrão esperado [R$ #,##]';
                        }
                    }

                    if (!empty($msgValor)) {
                        $resposta['mensagem'][$chave] = implode(', ', $msgValor) . '.';
                    }
                    break;

                case 'quantity':

                    $msgQuantidade = '';
                    $len = strlen($valor);

                    if ($len > 4) {

                        $msgQuantidade[] = 'Quantidade digitado com mais de 4 caracteres';
                    }

                    if (!is_numeric($valor)) {
                        $msgQuantidade[] = 'Quantidade com digitos não numéricos';
                    }

                    if (!empty($msgQuantidade)) {
                        $resposta['mensagem'][$chave] = implode(', ', $msgQuantidade) . '.';
                    }
                    break;

                case 'id':

                    if (!is_numeric($valor)) {
                        $resposta['mensagem'][$chave] = 'ID não numérico';
                    }
                    break;
            }
        }

        if (count($resposta['mensagem']) == 0) {
            $resposta['status'] = true;
        }

        return $resposta;
    }

}
