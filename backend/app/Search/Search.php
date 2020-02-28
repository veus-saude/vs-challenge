<?php

namespace App\Search;

use App\Search\SearchEngine;

class Search
{
    /**
     * Inicializa e retorna a Engine de Pesquisa de produtos
     *
     * @param $term
     * @return \App\Search\SearchEngine
     */
    public static function find($term)
    {
        $engine = new SearchEngine($term);
        return $engine;
    }
}
