<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Response\Error;
use App\Response\Success;
use Illuminate\Http\Request;

/**
 * Class ProductController
 * @package App\Http\Controllers\panel
 */
class ProductController extends Controller
{
    /**
     * @var Request
     */
    protected $request;

    /**
     * @var Product
     */
    protected $model;

    /**
     * RoleController constructor.
     * @param Request $request
     * @param Product $model
     */
    public function __construct
    (
        Request $request,
        Product $model
    )
    {
        $this->request = $request;
        $this->model = $model;
        $this->request["model"] = $this->model;
    }

    /**
     * @return bool|\Illuminate\Http\RedirectResponse|void
     */
    public function index($name=null, $query_filter=null)
    {
        $search = explode(":", $query_filter)[1];
        if ($name!=null && strpos($query_filter, 'brand') !== false)
        {
            $list = $this->model
                ->where("name", "like", "%".$name."%")
                ->where("brand", "like", "%".$search."%")
                ->paginate(3);
        }
        elseif ($name!=null && strpos($query_filter, 'price') !== false)
        {
            $list = $this->model
                ->where("name", "like", "%".$name."%")
                ->where("price", "like", "%".$search."%")
                ->paginate(3);
        }
        elseif ($name!=null && strpos($query_filter, 'stock') !== false)
        {
            $list = $this->model
                ->where("name", "like", "%".$name."%")
                ->where("stock", "like", "%".$search."%")
                ->paginate(3);
        }
        else
        {
            $list = $this->model->paginate(3);
        }
        if($list)
            return Success::generic(
                $list,
                messageSuccess(20004, "Produtos"),
                $this->request["routeType"],
                route("panel.product.index")
            );

        return Error::generic(
            null,
            messageErrors(4003, "Erro ao mostrar Lista de Produtos"),
            "web"
        );
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store()
    {
        $store = $this->model->create($this->request->all());
        if($store)
            return Success::generic(
                null,
                messageSuccess(20000, "Produtos"),
                $this->request["routeType"],
                route("panel.product.index")
            );

        return Error::generic(
            null,
            messageErrors(1000, "Produtos"),
            "web"
        );
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update()
    {
        $item = $this->model->find($this->request['id']);
        $update = $item->update($this->request->all());
        if($update)
            return Success::generic(
                null,
                messageSuccess(20001, "Produtos"),
                $this->request["routeType"],
                route("panel.product.index")
            );

        return Error::generic(
            null,
            messageErrors(1001, "Produtos"),
            $this->request["routeType"]
        );
    }


    /**
     * @param $id
     * @return bool|\Illuminate\Http\RedirectResponse|void
     */
    public function delete($id)
    {
        $delete = $this->model->destroy($id);
        if($delete)
            return Success::generic(
                null,
                messageSuccess(20002, "Produtos"),
                $this->request["routeType"],
                route("panel.product.index")
            );

        return Error::generic(
            null,
            messageErrors(1002, "Produtos"),
            $this->request["routeType"]
        );
    }
}
