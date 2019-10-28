<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ProductsModel;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function findAll()
    {
        $result = ProductsModel::paginate(10);

        return response([
            "status" => (!$result) ? "error" : "success",
            "message" => "",
            "data" => $result
        ]);
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function findByFilter(Request $request)
    {
        $sql = "";
        if ($request->has('q') && $request->get('q') != '') {
            $query = $request->get('q');
            $sql = "name LIKE '%" . $query . "%'";
        }

        if ($request->has('filter') && $request->get('filter') != '') {
            $filter = $request->get('filter');
            $filter = explode(":", $filter);

            $connector = (strlen($sql) > 5) ? " or " : "";

            $sql .= $connector . $filter[0] . " LIKE '%" . $filter[1] . "%'";
        }

        $result = ProductsModel::whereRaw("$sql")->paginate(15);

        if (!$result) {
            return response([
                "status" => (!$result) ? "error" : "success",
                "message" => "Product not found",
                "data" => []
            ], 200);
        }

        return response([
            "status" => "success",
            "data" => $result
        ], 200);
    }

    /**
     * @param $id object identifier
     */
    public function findById(int $id)
    {
        $result = ProductsModel::find($id);

        if (!$result) {
            return response([
                "message" => "Product not found",
                "status" => "error",
                "data" => []
            ], 200);
        }

        return response([
            "status" => "succcess",
            "message" => "",
            "data" => $result
        ], 200);
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function create(Request $request)
    {
        $model = new ProductsModel();
        return $model->register($request);
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function update(Request $request, int $id)
    {
        $model = new ProductsModel();
        return $model->edit($request, $id);
    }

    public function destroy($id)
    {
        $product = ProductsModel::find($id);

        if (!$product) {
            return response([
                "message" => "Product not found",
                "status" => "error",
                "data" => []
            ], 200);
        }

        $product->delete();

        return response([
            "status" => "success",
            "message" => "",
            "data" => []
        ], 200);
    }
}
