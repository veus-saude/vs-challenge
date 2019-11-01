<?php

namespace App\Repository;

interface RepositoryInterface
{
    public function criteriaPagination($queryString, $filter, $order,int $page,int $size);
}