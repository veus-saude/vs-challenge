<?php

namespace App\Http\Controllers\Panel;

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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $list = $this->model->all();
        return view($this->request->route()->getName(), compact('list'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view($this->request->route()->getName());
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
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $item = $this->model->find($id);
        return view($this->request->route()->getName(), compact('item'));
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
