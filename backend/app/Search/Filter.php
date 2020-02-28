<?php

namespace App\Search;

use Illuminate\Support\Facades\DB;

abstract class Filter
{
    protected $table;
    protected $column;
    private $encoding = 'UTF-8';
    protected $pagination = 4;
    protected $searhfilter;
    protected $term;

    /**
     * Transforma o termo da pesquisa em UpperCase
     *
     * @return string
     */
    private function toUpperCase(): string
    {
        return mb_strtoupper($this->term, $this->encoding);
    }

    /**
     * Transforma o termo da pesquisa em lowercase
     *
     * @return string
     */
    private function toLowerCase(): string
    {
        return mb_strtolower($this->term, $this->encoding);
    }

    /**
     * Transforma o termo da pesquisa em CamelCase
     *
     * @return string
     */
    private function toUcwords(): string
    {
        return ucwords($this->term);
    }

    /**
     * Extrai o filtro para realização das consultas
     *
     * @return array
     */
    protected function extractFilter()
    {
        $filterArray = explode(':', $this->searhfilter);
        return $filterArray;
    }

    /**
     * Realiza a pesquisa junto com o filtro
     *
     * @return \Illuminate\Database\Query\Builder
     */
    protected function withFilter()
    {
        $withFilter = DB::table($this->table)
            ->where([
                [$this->column, 'LIKE', '%' . $this->toUcwords() . '%'],
                [$this->extractFilter()[0], '=', $this->extractFilter()[1]]
            ])
            ->orWhere([
                [$this->column, 'LIKE', '%' . $this->toLowerCase() . '%'],
                [$this->extractFilter()[0], '=', $this->extractFilter()[1]]
            ])
            ->orWhere([
                [$this->column, 'LIKE', '%' . $this->toUpperCase() . '%'],
                [$this->extractFilter()[0], '=', $this->extractFilter()[1]]
            ]);

        return $withFilter;
    }

    /**
     * Realiza uma pesquisa sem filtro por BRAND
     *
     * @return \Illuminate\Database\Query\Builder
     */
    protected function normalFilter()
    {
        $normalFilter = DB::table($this->table)
            ->where($this->column, 'LIKE', '%' . $this->toUcwords() . '%')
            ->orWhere($this->column, 'LIKE', '%' . $this->toLowerCase() . '%')
            ->orWhere($this->column, 'LIKE', '%' . $this->toUpperCase() . '%');

        return $normalFilter;
    }
}
