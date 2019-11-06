<?php


namespace App\Models\QueryFilter;


use App\Models\Produtos;

class ProdutosQueryFilter extends AbstractQueryFilter
{
    /**
     * ProdutosQueryFilter constructor.
     * @param array $campos
     */
    public function __construct(array $campos)
    {
        $produtos = new Produtos();
        parent::__construct($campos, $produtos->getTable());
    }

    public function apply()
    {
        parent::apply();
        return $this->builder;
    }

    public function q(string $nome)
    {
        $this->builder->where('nome', 'LIKE', "%$nome%");
    }

    public function brand(string $nome)
    {
        $this->builder->where('marca', 'LIKE', "%$nome%");
    }
}
