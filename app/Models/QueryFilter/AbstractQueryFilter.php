<?php


namespace App\Models\QueryFilter;


use Illuminate\Support\Facades\DB;

class AbstractQueryFilter
{
    /** @var array */
    protected $campos;

    /** @var \Illuminate\Database\Query\Builder */
    protected $builder;

    /**
     * AbstractQueryFilter constructor.
     * @param array $campos
     * @param string $nomeTabela
     */
    public function __construct(array $campos, string $nomeTabela)
    {
        $this->campos = $campos;
        $this->builder = DB::table($nomeTabela);
    }

    public function apply()
    {
        foreach ($this->campos as $campo => $params) {
            if (method_exists($this, $campo)){
                if ($params){
                    $this->$campo($params);
                }
            }
        }
    }
}
