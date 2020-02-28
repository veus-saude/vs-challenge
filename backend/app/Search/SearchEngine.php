<?php

namespace App\Search;

class SearchEngine extends Filter
{
    /**
     * Método construtor
     */
    public function __construct($term='')
    {
        $this->term = $term;
        $this->column = 'nome';
        $this->table = 'products';
    }

    /**
     * Inicia e verifica os filtros da pesquisa
     *
     * @return \Illuminate\Database\Query\Builder
     */
    private function initSearch()
    {
        if(is_null($this->searhfilter))
            $searh = $this->normalFilter();
        else
            $searh = $this->withFilter();

        return $searh;
    }

    /**
     * Seta o nome da tabela para a pesquisa
     *
     * @param $table
     * @return $this
     */
    public function setTable($table)
    {
        $this->table = $table;
        return $this;
    }

    /**
     * Seta o nome da coluna para pesquisa
     *
     * @param string $column
     * @return $this
     */
    public function setColumn(string $column)
    {
        $this->column = $column;
        return $this;
    }

    /**
     * Seta o total de items por páginas
     *
     * @param $perPage
     * @return $this
     */
    public function setPagination($perPage)
    {
        $this->pagination = $perPage;
        return $this;
    }

    /**
     * Adiciona o Fitro na Pesquisa
     * @param $filter
     * @return $this
     */
    public function filter($filter)
    {
        $this->searhfilter = $filter;
        return $this;
    }

    /**
     * Retorna os resultados da pesquisa
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function results()
    {
        return $this->initSearch()->paginate($this->pagination);
    }
}
