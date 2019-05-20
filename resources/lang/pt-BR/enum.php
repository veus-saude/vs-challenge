<?php
return [
    'imovel' => [
        'pretensao' => [
            'VENDA' => [
                'nome' => 'Venda',
                'acao' => 'Comprar',
                'descricao' => 'à venda',
                'coluna_valor' => 'valor_venda',
                'pretensao_cliente' => 'COMPRAR'
            ],
            'LOCACAO' => [
                'nome' => 'Locação',
                'acao' => 'Alugar',
                'descricao' => 'locação',
                'coluna_valor' => 'valor_locacao',
                'pretensao_cliente' => 'ALUGAR'
            ]
        ],
        'status' => [
            '1' => 'Ativo',
            '2' => 'Ficha',
            '3' => 'Provisório',
            '4' => 'Locado',
            '5' => 'Vendido',
            '6' => 'Cancelado',
            '7' => 'Suspenso'
        ],
        'tipolocacao' => [
            'Mensal' => 'Mensal',
            'Anual' => 'Anual',
            'Diária' => 'Diária',
            'Não Informado' => 'Não Informado'
        ],
        'tipocondominio' => [
            'Edifício ou Prédio de torre única' => 'Edifício ou Prédio de torre única',
            'Condomínio de Casas, Prédios com mais de uma torre, Loteamentos e Outros' => 'Condomínio de Casas, Prédios com mais de uma torre, Loteamentos e Outros'
        ],
        'statuscomercial' => [
            'Condomínios (Imóveis terceiros)' => 'Condomínios (Imóveis terceiros)',
            'Lançamentos (Imóveis novos)' => 'Lançamentos (Imóveis novos)'
        ],
        'statuslancamento' => [
            'Padrão' => 'Padrão',
            'Futuro lançamento' => 'Futuro lançamento',
            'Pré-lançamento' => 'Pré-lançamento',
            'Lançamento' => 'Lançamento',
            'Pronto para Morar' => 'Pronto para Morar',
            'Últimas unidades' => 'Últimas unidades',
            'Revenda' => 'Revenda',
        ],
        'condicaoPagIptu' => [
            'Mensal' => 'Mensal',
            'Anual' => 'Anual'
        ],
        'padrao' => [
            'Não informado' => 'Não informado',
            'Alto' => 'Alto',
            'Médio' => 'Médio',
            'Regular' => 'Regular',
            'Baixo' => 'Baixo'
        ],
        'padraoLocal' => [
            'Não informado' => 'Não informado',
            'Privilegiada' => 'Privilegiada',
            'Ótima' => 'Ótima',
            'Média' => 'Média',
            'Regular' => 'Regular',
            'Boa' => 'Boa'
        ],
        'situacao' => [
            'Não informado' => 'Não informado',
            'Desocupado' => 'Desocupado',
            'Ocupado' => 'Ocupado',
            'Reservado' => 'Reservado',
            'Em construção' => 'Em construção',
            'Lançamento' => 'Lançamento'
        ],
        'ocupadoPor' => [
            'Proprietário' => 'Proprietário',
            'Inquilino' => 'Inquilino'
        ],
        'baseImovel' => [
            'corretor' => [
                '1' => 'Corretor',
                '0' => 'Comunidade ImobOn'
            ],
            'imobiliaria' => [
                '1' => 'Imobiliária',
                '0' => 'Comunidade ImobOn'
            ]
        ],
        'localChave' => [
            'Não informado',
            'Corretor',
            'Imobiliária',
            'Proprietário',
            'Outro'
        ],
        'formaPagamento' => [
            'Anual',
            'Financiamento bancário',
            'Intermediária',
            'Mensais',
            'Semestral'
        ],
        'imovelDetalhe' => [
            'metragemMedida' => [
                'M²',
                'Alqueires Paulista',
                'Hectares',
                'Alqueires Goiano',
                'Alqueires Mineiro',
                'Alqueire do Norte',
                'Alqueire Baiano'
            ],
            'metragemIsolamento' => [
                'Geminada',
                'Isolada',
                'Semi-isolada'
            ],
            'metragemModoIsolamento' => [
                'Frente',
                'Fundos',
                'Lateral'
            ],
            'metragemPosicaoSolar' => [
                'Leste',
                'Manhã',
                'Norte',
                'Oeste',
                'Sul',
                'Tarde'
            ],
            'metragemPosicao' => [
                'Frente',
                'Fundos',
                'Lateral'
            ],
            'metragemTopologia' => [
                'Plano',
                'Aclive',
                'Declive'
            ]
        ]
    ],
    'options' => [
        'optionsYesOrNo' => [
            '2' => 'Indiferente',
            '1' => 'Sim',
            '0' => 'Não'
        ],
        'yesOrNo' => [
            '0' => 'Não',
            '1' => 'Sim'
        ],
        'apartirde' => [
            '0' => 'Todos',
            '1' => 'À partir de 1',
            '2' => 'À partir de 2',
            '3' => 'À partir de 3',
            '4' => 'À partir de 4',
            '5' => 'À partir de 5'
        ],
        'status' => [
            '' => 'Status',
            '1' => 'Ativo',
            '0' => 'Inativo'
        ],
        'escolaridade' => [
            'Não especificado' => 'Não especificado',
            'Ensino Fundamental Incompleto' => 'Ensino Fundamental Incompleto',
            'Ensino Fundamental Completo' => 'Ensino Fundamental Completo',
            'Ensino Médio Incompleto' => 'Ensino Médio Incompleto',
            'Ensino Médio Completo' => 'Ensino Médio Completo',
            'Superior Incompleto' => 'Superior Incompleto',
            'Superior Completo' => 'Superior Completo',
            'Pós-graduação Incompleto' => 'Pós-graduação Incompleto',
            'Pós-graduação Completo' => 'Pós-graduação Completo',
            'Mestrado Incompleto' => 'Mestrado Incompleto',
            'Mestrado' => 'Mestrado',
            'Doutorado Incompleto' => 'Doutorado Incompleto',
            'Doutorado' => 'Doutorado'
        ],
        'faixavalor' => [
            '10' => '10%',
            '20' => '20%',
            '30' => '30%',
            '40' => '40%',
            '50' => '50%'
        ],
        'estados' => [
            '' => 'Selecione',
            "AC" => 'Acre',
            "AL" => 'Alagoas',
            "AP" => 'Amapá',
            "AM" => 'Amazonas',
            "BA" => 'Bahia',
            "CE" => 'Ceará',
            "DF" => 'Distrito Federal',
            "ES" => 'Espírito Santo',
            "GO" => 'Goiás',
            "MA" => 'Maranhão',
            "MT" => 'Mato Grosso',
            "MS" => 'Mato Grosso do Sul',
            "MG" => 'Minas Gerais',
            "PA" => 'Pará',
            "PB" => 'Paraíba',
            "PR" => 'Paraná',
            "PE" => 'Pernambuco',
            "PI" => 'Piauí',
            "RJ" => 'Rio de Janeiro',
            "RN" => 'Rio Grande do Norte',
            "RS" => 'Rio Grande do Sul',
            "RO" => 'Rondônia',
            "RR" => 'Roraima',
            "SC" => 'Santa Catarina',
            "SP" => 'São Paulo',
            "SE" => 'Sergipe',
            "TO" => 'Tocantins'
        ],
        'permissaoArquivo' => [
            1 => 'Apenas p/ a direção', 
            2 => 'Todos'
        ]
    ],
    'cliente' => [
        'tipo' => [
            '1' => 'Interessado',
            '2' => 'Proprietário'
        ],
        'tipotelefone' => [
            '1' => 'Tel. Residencial',
            '2' => 'Tel. Comercial',
            '3' => 'Celular',
            '4' => 'Rádio'
        ],
        'periodoNotificacaoImovelEmail' => [
            '0' => 'Não enviar', 
            '15' => 'A cada 15 dias', 
            '30' => 'Mensalmente', 
            '' => 'Definir período'
        ],
        'pretensao' => [
            'COMPRAR' => [
                'nome' => 'Compra',
                'verbalizado' => 'Comprar',
                'pretensaoImovel' => 'VENDA',
                'campo_valor_radar' => 'valor_compra',
                'faixa_valor_radar' => 'faixa_valor_compra',
                'campo_valor_imovel' => 'valor_venda'
            ],
            'ALUGAR' => [
                'nome' => 'Locação',
                'verbalizado' => 'Alugar',
                'pretensaoImovel' => 'LOCACAO',
                'campo_valor_radar' => 'valor_locacao',
                'faixa_valor_radar' => 'faixa_valor_locacao',
                'campo_valor_imovel' => 'valor_locacao'
            ],
            'VENDER' => [
                'nome' => 'Venda',
                'verbalizado' => 'Vender',
                'pretensaoImovel' => 'VENDA',
                'campo_valor_radar' => '',
                'faixa_valor_radar' => '',
                'campo_valor_imovel' => ''
            ],
            'LOCAR' => [
                'nome' => 'Locação',
                'verbalizado' =>'Locar',
                'pretensaoImovel' => 'LOCACAO',
                'campo_valor_radar' => '',
                'faixa_valor_radar' => '',
                'campo_valor_imovel' => ''
            ]
        ],
        'estadocivil' => [
            'NAO_INFORMADO' => 'Não informado',
            'SOLTEIRO'      => 'Solteiro(a)',
            'CASADO'        => 'Casado(a)',
            'DIVORCIADO'    => 'Divorciado(a)',
            'VIUVO'         => 'Viúvo(a)',
            'UNIAO_ESTAVEL' => 'União estável'
        ]
    ],
    'atendimento' => [
        'status' => [
            '1' => 'Em atendimento',
            '2' => 'Finalizado'
        ],
        'prioridades' => [
            '2' => 'Alta',
            '1' => 'Média',
            '0' => 'Baixa'
        ]
    ],
    'proposta' => [
        'status' => [
            'APROVADA_PROPRIETARIO' => [
                'nome' => 'Aprovada pelo proprietário',
                'icone' => 'fa fa-thumbs-o-up',
                'color' => '#3d9e3f'
            ],
            'RECUSADA_PROPRIETARIO' => [
                'nome' => 'Recusada pelo proprietário',
                'icone' => 'fa fa-thumbs-o-down',
                'color' => '#d1d1d1'
            ],
            'CANCELADA' => [
                'nome' => 'Cancelada',
                'icone' => 'fa fa-times',
                'color' => '#da534f'
            ],
            'PENDENTE' => [
                'nome' => 'Pendente',
                'icone' => 'fa fa-exclamation-circle',
                'color' => '#2d88ce'
            ],
            'EMFILA' => [
                'nome' => 'Em fila',
                'icone' => 'fa fa-sort-numeric-asc',
                'color' => '#2d88ce'
            ],
            'VENCIDA' => [
                'nome' => 'Vencida',
                'icone' => 'clock-o',
                'color' => '#da534f'
            ]
        ],
        'negociacao' => [
            'status' => [
                'EM_ANDAMENTO' => [
                    'nome' => 'Em andamento',
                    'icone' => 'fa fa-exclamation-circle',
                    'color' => '#2d88ce'
                ],
                'COMPRADOR_DESISTIU' => [
                    'nome' => 'Comprador desistiu',
                    'icone' => 'fa fa-thumbs-o-down',
                    'color' => '#d1d1d1'
                ],
                'VENDEDOR_DESISTIU' => [
                    'nome' => 'Vendedor desistiu',
                    'icone' => 'fa fa-thumbs-o-down',
                    'color' => '#d1d1d1'
                ],
                'DOCUMENTACAO_INCOMPLETA' => [
                    'nome' => 'Documentação incompleta',
                    'icone' => 'fa fa-thumbs-o-down',
                    'color' => '#d1d1d1'
                ],
                'CONCLUIDA' => [
                    'nome' => 'Negociação concluída',
                    'icone' => 'fa fa-thumbs-o-up',
                    'color' => '#3d9e3f'
                ]
            ]
        ]
    ],
    'contrato' => [
        'comercializado_por' => [
            'TERCEIROS' => 'Comercializado por terceiros',
            'IMOBILIARIA' => 'Comercializado pela imobiliária'
        ],
        'tipo_fianca' => [
            'ALUGUEL_ANTECIPADO' => 'Aluguel antecipado',
            'CAPTALIZACAO' => 'Capitalização',
            'CARTA_FIANCA' => 'Carta Fiança',
            'CAUCAO' => 'Caução',
            'FIADOR' => 'Fiador',
            'FIANCA_EMPRESARIAL' => 'Fiança empresarial',
            'NAO_INFORMADO' => 'Não informado',
            'SEGURO_FIANCA' => 'Seguro Fiança',
        ],
        'tipo_locacao' => [
            'ANUAL' => 'Anual',
            'MENSAL' => 'Mensal',
            'DIARIA' => 'Diária',
            'NAO_INFORMADO' => 'Não informado'
        ]
    ],
    'roteiro_visitas' => [
        'status' => [
            'AGUARDANDO' => 'Aguardando',
            'CONCLUIDO' => 'Concluído',
            'CANCELADO' => 'Cancelado'
        ],
        'imovel' => [
            'status' => [
                'NAO_INTERESSOU' => 'Não interessou',
                'INTERESSOU' => 'Interessou',
                'INTERESSOU_GEROU_PROPOSTA' => 'Interessou e gerou proposta'
            ]
        ]

    ]

];