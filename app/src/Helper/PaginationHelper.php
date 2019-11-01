<?php 

namespace App\Helper;

use Symfony\Component\HttpFoundation\Request;

class PaginationHelper
{
    public function search(Request $request)
    {
        $data = $request->query->all();
        $queryString = array_key_exists('q', $data)
            ? $data['q']
            : null;
        $filters = array_key_exists('filter', $data)
            ? $data['filter']
            : null;
        $ordenationData = array_key_exists('sort', $data)
            ? $data['sort']
            : null;
        $atualPage = array_key_exists('page', $data)
            ? $data['page']
            : 1;
        $pageItens = array_key_exists('size', $data)
            ? $data['size']
            : 10;
        $data = null;    
        
        return [$queryString, $filters, $ordenationData, $atualPage, $pageItens];
    }

    public function getQueryString(Request $request)
    {
        [$query] = $this->search($request);
        return $query;
    }

    public function getFilter(Request $request)
    {
        [, $filter] = $this->search($request);
        return $filter;
    }

    public function getOrdenation(Request $request)
    {
        [, , $ordenation] = $this->search($request);
        return $ordenation;
    }

    public function getPagination(Request $request)
    {
        [, , , $atualPage, $pageItens] = $this->search($request);
        return [$atualPage, $pageItens];
    }

}