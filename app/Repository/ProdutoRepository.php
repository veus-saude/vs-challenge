<?php


namespace App\Repository;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class ProdutoRepository
{
    /**
     * @var Model
     */
    private $model;
    /**
     * @var Request
     */
    private $request;

    public function __construct(Model $model, Request $request)
    {

        $this->model = $model;
        $this->request = $request;
    }

    public function selectFilter(){
        $dados = '';

            $fields = $this->request->get('fields');
            $dados = $this->model->selectRaw($fields);

        return $dados;
    }
}
